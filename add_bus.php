<?php
header("Content-Type: application/json");

// Read input JSON
$data = json_decode(file_get_contents("php://input"), true);

// Connect to MySQL
$conn = new mysqli("localhost", "root", "", "bus");
if ($conn->connect_error) {
    echo json_encode(["success" => false, "message" => "Database connection failed."]);
    exit;
}

// Prepare and bind
$stmt = $conn->prepare("INSERT INTO bus_details (bus_id, bus_name, origin, destination, stops, start_time, end_time, bus_type, seat_type, day, total_seats, base_price) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param(
    "isssssssssii",
    $data["bus_id"],
    $data["bus_name"],
    $data["origin"],
    $data["destination"],
    $data["stops"],
    $data["start_time"],
    $data["end_time"],
    $data["bus_type"],
    $data["seat_type"],
    $data["day"],
    $data["total_seats"],
    $data["base_price"]
);

if ($stmt->execute()) {
    echo json_encode(["success" => true, "message" => "Bus added successfully!"]);
} else {
    echo json_encode(["success" => false, "message" => "Failed to add bus: " . $stmt->error]);
}

$stmt->close();
$conn->close();
?>
