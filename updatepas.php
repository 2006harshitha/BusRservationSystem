<?php
session_start();

// Retrieve POST data
$bus_id = $_POST['bus_id'];
$passenger_count = (int) $_POST['passenger_count'];
$from = $_POST['from'];
$to = $_POST['to'];

// Database connection
$conn = new mysqli("localhost", "root", "", "bus");

// Check for connection error
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Update total seats safely using prepared statement
$stmt = $conn->prepare("UPDATE bus_details SET total_seats = total_seats - ? WHERE bus_id = ?");
$stmt->bind_param("is", $passenger_count, $bus_id);
$stmt->execute();
$stmt->close();

// Save entire POST data to session for PDF generation
$_SESSION['passenger_data'] = $_POST;

// Store from/to/bus_id separately for clarity
$_SESSION['bus_id'] = $bus_id;
$_SESSION['from'] = $from;
$_SESSION['to'] = $to;

// Redirect to confirmation page
header("Location: tdone.html");
exit();
?>
