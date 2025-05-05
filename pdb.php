<?php
$servername = "localhost";
$username = "root";
$password = ""; // Default password for XAMPP/WAMP is empty
$database = "bus"; // Name of your database

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
