const express = require('express');
const mysql = require('mysql2/promise');
const app = express();
const port = 3000;

// Create a MySQL connection pool

const pool = mysql.createPool({
  host: 'localhost',
  user: 'root',
  password: 'Deepan@1234',
  database: 'bus',
  waitForConnections: true,
  connectionLimit: 10,
  queueLimit: 0,
});

// Middleware to parse JSON in the request body
app.use(express.json());

app.post('/update-track', async (req, res) => {
  try {
    // Extract data from the request body
    const { id, lat, long } = req.body;

    // Ensure that id, lat, and long are provided and valid
    if (!id || isNaN(id) || !lat || isNaN(lat) || !long || isNaN(long)) {
      return res.status(400).json({ error: 'Invalid input data.' });
    }

    // Create a connection from the pool
    const connection = await pool.getConnection();

    // Update the "track" table
    const sql = 'UPDATE track SET lat = ?, long = ? WHERE id = ?';
    const [results] = await connection.execute(sql, [lat, long, id]);

    // Release the connection back to the pool
    connection.release();

    if (results.affectedRows === 1) {
      res.json({ message: 'Track updated successfully.' });
    } else {
      res.status(404).json({ error: 'Track with the specified ID not found.' });
    }
  } catch (error) {
    console.error('Error:', error);
    res.status(500).json({ error: 'Internal server error.' });
  }
});

app.listen(port, () => {
  console.log(`Server is running on port ${port}`);
});
