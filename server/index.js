const express = require('express');
const cors = require('cors');
const dotenv = require('dotenv');
const mysql = require('mysql2/promise');

dotenv.config();

const app = express();
const PORT = process.env.PORT || 3000;

app.use(cors());
app.use(express.json());

// Database Connection Pool
const pool = mysql.createPool({
    host: process.env.DB_HOST || 'localhost',
    user: process.env.DB_USER || 'root',
    password: process.env.DB_PASSWORD || 'root',
    database: process.env.DB_NAME || 'whatsupdoc',
    waitForConnections: true,
    connectionLimit: 10,
    queueLimit: 0
});

// Test DB Connection
pool.getConnection()
    .then(conn => {
        console.log("Connected to MySQL Database!");
        conn.release();
    })
    .catch(err => {
        console.error("Error connecting to database:", err);
    });

// Basic Route
app.use('/auth', require('./routes/auth'));
app.use('/doctors', require('./routes/doctors'));
app.use('/appointments', require('./routes/appointments'));

app.get('/', (req, res) => {
    res.send('WhatsUpDoc API is running');
});

app.listen(PORT, () => {
    console.log(`Server running on port ${PORT}`);
});
