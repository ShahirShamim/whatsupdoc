const express = require('express');
const router = express.Router();
const pool = require('../db');

// Get all doctors with their details
router.get('/', async (req, res) => {
    try {
        const [doctors] = await pool.query(`
      SELECT u.id, u.name, u.email, d.phone, d.city, d.bio, d.experience_years, s.name as specialization
      FROM doctors d
      JOIN users u ON d.user_id = u.id
      LEFT JOIN specializations s ON d.specialization_id = s.id
    `);
        res.json(doctors);
    } catch (error) {
        console.error(error);
        res.status(500).json({ error: 'Failed to fetch doctors' });
    }
});

// Get slots for a doctor
router.get('/:id/slots', async (req, res) => {
    const { id } = req.params;
    const { date } = req.query; // Optional filter by date

    try {
        let query = 'SELECT * FROM slots WHERE doctor_id = ? AND is_booked = 0';
        const params = [id];

        if (date) {
            query += ' AND slot_date = ?';
            params.push(date);
        }

        const [slots] = await pool.query(query, params);
        res.json(slots);
    } catch (error) {
        console.error(error);
        res.status(500).json({ error: 'Failed to fetch slots' });
    }
});

// Add a slot (Doctor only - middleware would check this normally)
router.post('/slots', async (req, res) => {
    const { doctor_id, slot_date, start_time, end_time } = req.body;
    try {
        await pool.query(
            'INSERT INTO slots (doctor_id, slot_date, start_time, end_time) VALUES (?, ?, ?, ?)',
            [doctor_id, slot_date, start_time, end_time]
        );
        res.status(201).json({ message: 'Slot created successfully' });
    } catch (error) {
        console.error(error);
        res.status(500).json({ error: 'Failed to create slot' });
    }
});

module.exports = router;
