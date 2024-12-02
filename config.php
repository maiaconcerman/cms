<?php
// Database connection configuration
$host = 'localhost';
$db = 'sinag';
$user = 'root';
$pass = '';

// Create a new MySQL connection
$conn = new mysqli($host, $user, $pass, $db);

// Check if the connection is successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>