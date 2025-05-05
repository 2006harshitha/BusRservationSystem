<?php
require 'db.php';
header('Content-Type: application/json');

$data = json_decode(file_get_contents("php://input"), true);

// Logging
file_put_contents(__DIR__ . "/debug_input.txt", "RAW INPUT:\n" . file_get_contents("php://input") . "\n", FILE_APPEND);
file_put_contents(__DIR__ . "/debug_data.txt", "DECODED DATA:\n" . print_r($data, true), FILE_APPEND);

$from = ucfirst(strtolower($data['from'] ?? ''));
$to = ucfirst(strtolower($data['to'] ?? ''));
$day = ucfirst(strtolower($data['day'] ?? ''));
$filters = $data['filters'] ?? [];

$query = "SELECT * FROM bus_details WHERE day = ?";
$params = [$day];
$types = "s";

// Filters
$conditions = [];
if (isset($filters['ac']) && $filters['ac']) $conditions[] = "bus_type = 'AC'";
if (isset($filters['nonAc']) && $filters['nonAc']) $conditions[] = "bus_type = 'Non-AC'";
if (isset($filters['sleeper']) && $filters['sleeper']) $conditions[] = "seat_type = 'Sleeper'";
if (isset($filters['seater']) && $filters['seater']) $conditions[] = "seat_type = 'Seater'";

if (!empty($conditions)) {
    $query .= " AND (" . implode(" OR ", $conditions) . ")";
}

file_put_contents(__DIR__ . "/debug_query.txt", "Query: $query\n", FILE_APPEND);

// Prepare statement
$stmt = $conn->prepare($query);
$stmt->bind_param($types, ...$params);
$stmt->execute();

if ($stmt->error) {
    file_put_contents(__DIR__ . "/debug_error.txt", "SQL Error: " . $stmt->error, FILE_APPEND);
}

$result = $stmt->get_result();

$buses = [];
while ($row = $result->fetch_assoc()) {
    $stops = array_map('trim', explode(',', $row['stops']));

    $fromIndex = array_search($from, $stops);
    $toIndex = array_search($to, $stops);

    if ($fromIndex !== false && $toIndex !== false && $toIndex > $fromIndex) {
        $buses[] = $row;
    }
}

file_put_contents(__DIR__ . "/debug_filtered_buses.txt", print_r($buses, true));

echo json_encode($buses);
?>