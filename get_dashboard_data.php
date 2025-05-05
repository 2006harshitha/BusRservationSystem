<?php
header('Content-Type: application/json');

// Database configuration
$host = 'localhost';
$username = 'root'; // use your DB username
$password = '';     // use your DB password
$database = 'bus';

// Create connection
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    echo json_encode([
        'success' => false,
        'message' => 'Database connection failed: ' . $conn->connect_error
    ]);
    exit;
}

// Query to fetch all buses
$sql = "SELECT * FROM bus_details";
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    $buses = [];

    while ($row = $result->fetch_assoc()) {
        $buses[] = [
            'bus_id' => $row['bus_id'],
            'bus_name' => $row['bus_name'],
            'origin' => $row['origin'],
            'destination' => $row['destination'],
            'stops' => explode(',', $row['stops']), // Convert stops string to array
            'start_time' => $row['start_time'],
            'end_time' => $row['end_time'],
            'bus_type' => $row['bus_type'],
            'seat_type' => $row['seat_type'],
            'day' => $row['day'],
            'total_seats' => (int)$row['total_seats'],
            'base_price' => (float)$row['base_price']
        ];
    }

    echo json_encode([
        'success' => true,
        'data' => $buses
    ]);
} else {
    echo json_encode([
        'success' => false,
        'message' => 'No buses found'
    ]);
}

$conn->close();
?>
