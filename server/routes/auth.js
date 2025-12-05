const express = require('express');
const router = express.Router();
const pool = require('../db');
const bcrypt = require('bcryptjs'); // Will need to install this

// Register
router.post('/register', async (req, res) => {
    const { name, email, password, role, ...other } = req.body;

    if (!['patient', 'doctor'].includes(role)) {
        return res.status(400).json({ error: 'Invalid role' });
    }

    const conn = await pool.getConnection();
    try {
        await conn.beginTransaction();

        // Check if user exists
        const [existing] = await conn.query('SELECT id FROM users WHERE email = ?', [email]);
        if (existing.length > 0) {
            await conn.release();
            return res.status(400).json({ error: 'User already exists' });
        }

        // Hash password (if we were doing real auth, assuming plaintext for now or need bcrypt)
        // Installing bcryptjs is planned.
        const hash = password; // TODO: simple for now, add bcrypt

        // Insert User
        const [userResult] = await conn.query(
            'INSERT INTO users (name, email, password_hash, role) VALUES (?, ?, ?, ?)',
            [name, email, hash, role]
        );
        const userId = userResult.insertId;

        // Insert Profile based on role
        if (role === 'patient') {
            await conn.query(
                'INSERT INTO patients (user_id, phone, address, gender, date_of_birth) VALUES (?, ?, ?, ?, ?)',
                [userId, other.phone, other.address, other.gender, other.date_of_birth]
            );
        } else if (role === 'doctor') {
            await conn.query(
                'INSERT INTO doctors (user_id, specialization_id, phone, city, bio) VALUES (?, ?, ?, ?, ?)',
                [userId, other.specialization_id || null, other.phone, other.city, other.bio]
            );
        }

        await conn.commit();
        res.status(201).json({ message: 'User registered successfully', userId });
    } catch (error) {
        await conn.rollback();
        console.error(error);
        res.status(500).json({ error: 'Registration failed' });
    } finally {
        conn.release();
    }
});

// Login
router.post('/login', async (req, res) => {
    const { email, password } = req.body;
    try {
        const [users] = await pool.query('SELECT * FROM users WHERE email = ?', [email]);
        if (users.length === 0) return res.status(401).json({ error: 'Invalid credentials' });

        const user = users[0];
        // Simple password check for MVP/Legacy-revamp
        if (password !== user.password_hash) {
            return res.status(401).json({ error: 'Invalid credentials' });
        }

        // Return user info (JWT could be added here)
        res.json({
            id: user.id,
            name: user.name,
            role: user.role,
            email: user.email
        });
    } catch (error) {
        console.error(error);
        res.status(500).json({ error: 'Login failed' });
    }
});

module.exports = router;
