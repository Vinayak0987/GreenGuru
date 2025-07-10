const express = require('express');
const mysql = require('mysql');
const bodyParser = require('body-parser');
const path = require('path');

const app = express();
const PORT = process.env.PORT || 3000;

// Middleware
app.use(bodyParser.urlencoded({ extended: true }));
app.use(bodyParser.json());

// Serve static files from the 'public' directory
app.use(express.static(path.join(__dirname, 'public')));

// MySQL Connection
const connection = mysql.createConnection({
    host: 'localhost',
    user: 'vedant', // replace with your MySQL username
    password: 'Vedant@47', // replace with your MySQL password
    database: 'greenguru' // replace with your database name
});

connection.connect((err) => {
    if (err) {
        console.error('Error connecting to the database:', err);
    } else {
        console.log('Connected to the database');
    }
});

// Route to handle form submission
app.post('/submit', (req, res) => {
    const { fullName, email, address, city, country, postalCode, cardNumber, expiryDate, cvv } = req.body;

    const query = `INSERT INTO billing_info (full_name, email, address, city, country, postal_code, card_number, expiry_date, cvv)
                   VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)`;

    connection.query(query, [fullName, email, address, city, country, postalCode, cardNumber, expiryDate, cvv], (err, results) => {
        if (err) {
            console.error(err);
            return res.status(500).send('Error inserting data.');
        }
        res.send({ success: true, message: 'Order placed successfully!' });
    });
});

app.listen(PORT, () => {
    console.log(`Server is running on http://localhost:${PORT}`);
});
