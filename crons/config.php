<?php

// Database Configuration
$host = '127.0.0.1'; // Database host
$username = 'root';   // Database username
$password = '';   // Database password
$dbname = 'task_manager'; // Database name

// Create a new MySQLi connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

return $conn;
