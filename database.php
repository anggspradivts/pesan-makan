<?php
$servername = "localhost"; // or your server address
$username = "root";        // your database username
$password = "";            // your database password (often empty in Laragon)
$dbname = "pesan_makan";        // your database name

// Create connection using the Object-Oriented style
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  // Stop the script and show an error if the connection fails
  die("Connection failed: " . $conn->connect_error);
}

// Optional: Set character set to utf8mb4 for full emoji and character support
$conn->set_charset("utf8mb4");
