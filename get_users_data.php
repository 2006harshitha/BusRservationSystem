<?php
header('Content-Type: application/json');

$connection = new mysqli("localhost", "root", "", "bus");

if ($connection->connect_error) {
    echo json_encode(["success" => false, "message" => "Database connection failed"]);
    exit;
}

$sql = "SELECT * FROM users"; // use actual table name
$result = $connection->query($sql);

$users = [];

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $users[] = $row;
    }
    echo json_encode(["success" => true, "data" => $users]);
} else {
    echo json_encode(["success" => true, "data" => []]);
}

$connection->close();
?>
