<?php
// Database credentials
$host = "localhost";
$user = "root";
$pass = "";
$db   = "cee_db";
$conn = null;

// Create connection
$conn = new mysqli($host, $user, $pass, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>