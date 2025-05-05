<?php
require 'db.php';

$data = json_decode(file_get_contents("php://input"), true);
$busId = $data['bus_id'];
$seatType = $data['seat_type'];
if ($seatType === "sleeper") {
    $query = "UPDATE bus_details SET total_seats = total_seats - 1 WHERE bus_id = ? AND seat_type = 'Sleeper' AND total_seats > 0";
  } else {
    $query = "UPDATE bus_details SET total_seats = total_seats - 1 WHERE bus_id = ? AND seat_type = 'Seater' AND total_seats > 0";
  }
  

$stmt = $conn->prepare($query);
$stmt->bind_param("i", $busId);
$stmt->execute();

if ($stmt->affected_rows > 0) {
    echo json_encode(["status" => "success"]);
} else {
    echo json_encode(["status" => "failed"]);
}
?>