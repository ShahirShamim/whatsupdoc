const express = require('express');
const router = express.Router();
const pool = require('../db');

// Book an appointment (Atomic transaction)
router.post('/book', async (req, res) => {
    const { slot_id, patient_id } = req.body;
    const conn = await pool.getConnection();

    try {
        await conn.beginTransaction();

        // Check availability
        const [slots] = await conn.query('SELECT * FROM slots WHERE id = ? FOR UPDATE', [slot_id]);
        if (slots.length === 0 || slots[0].is_booked) {
            await conn.release();
            return res.status(400).json({ error: 'Slot not available' });
        }

        // Mark slot as booked
        await conn.query('UPDATE slots SET is_booked = 1 WHERE id = ?', [slot_id]);

        // Create appointment
        const [result] = await conn.query(
            'INSERT INTO appointments (slot_id, patient_id, status) VALUES (?, ?, "scheduled")',
            [slot_id, patient_id]
        );

        await conn.commit();
        res.status(201).json({ message: 'Appointment booked successfully', appointmentId: result.insertId });
    } catch (error) {
        await conn.rollback();
        console.error(error);
        res.status(500).json({ error: 'Booking failed' });
    } finally {
        conn.release();
    }
});

// Get user appointments (Patient or Doctor)
router.get('/user/:userId', async (req, res) => {
    const { userId } = req.params;
    const { role } = req.query; // 'patient' or 'doctor'

    try {
        let query = '';
        if (role === 'patient') {
            query = `
        SELECT a.id, a.status, s.slot_date, s.start_time, u.name as doctor_name, sp.name as specialization
        FROM appointments a
        JOIN slots s ON a.slot_id = s.id
        JOIN doctors d ON s.doctor_id = d.user_id
        JOIN users u ON d.user_id = u.id
        LEFT JOIN specializations sp ON d.specialization_id = sp.id
        WHERE a.patient_id = ?
        ORDER BY s.slot_date DESC, s.start_time DESC
      `;
        } else if (role === 'doctor') {
            query = `
        SELECT a.id, a.status, s.slot_date, s.start_time, u.name as patient_name
        FROM appointments a
        JOIN slots s ON a.slot_id = s.id
        JOIN users u ON a.patient_id = u.id
        WHERE s.doctor_id = ?
        ORDER BY s.slot_date DESC, s.start_time DESC
      `;
        } else {
            return res.status(400).json({ error: 'Role required' });
        }

        const [appointments] = await pool.query(query, [userId]);
        res.json(appointments);
    } catch (error) {
        console.error(error);
        res.status(500).json({ error: 'Failed to fetch appointments' });
    }
});

module.exports = router;
