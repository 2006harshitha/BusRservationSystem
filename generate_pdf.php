<?php
session_start();
require('../fpdf186/fpdf.php');

// Check if session data exists
if (!isset($_SESSION['passenger_data']) || !isset($_SESSION['bus_id'])) {
    die('No data available. Please go back and submit the form.');
}

$data = $_SESSION['passenger_data'];
$bus_id = $_SESSION['bus_id'];
$from = $_SESSION['from'];
$to = $_SESSION['to'];

// Initialize FPDF
$pdf = new FPDF();
$pdf->AddPage();

// Title
$pdf->SetFont('Arial','B',16);
$pdf->Cell(0,10,'Passenger Booking Details',0,1,'C');
$pdf->Ln(10);

// Trip details
$pdf->SetFont('Arial','',12);
$pdf->Cell(0,10,"Bus ID: $bus_id", 0,1);
$pdf->Cell(0,10,"From: $from", 0,1);
$pdf->Cell(0,10,"To: $to", 0,1);

// Table Header
$pdf->SetFont('Arial','B',12);
$pdf->Cell(20,10,'No.', 1, 0, 'C');
$pdf->Cell(50,10,'Name', 1, 0, 'C');
$pdf->Cell(20,10,'Age', 1, 0, 'C');
$pdf->Cell(25,10,'Gender', 1, 0, 'C');
$pdf->Cell(25,10,'Bus ID', 1, 0, 'C');
$pdf->Cell(25,10,'Origin', 1, 0, 'C');
$pdf->Cell(25,10,'Destination', 1, 1, 'C');

// Passenger details
$names = $data['name'];
$ages = $data['age'];
$genders = $data['gender'];

for ($i = 0; $i < count($names); $i++) {
    $pdf->SetFont('Arial','',12);
    $pdf->Cell(20,10,($i+1), 1, 0, 'C');
    $pdf->Cell(50,10,$names[$i], 1, 0, 'C');
    $pdf->Cell(20,10,$ages[$i], 1, 0, 'C');
    $pdf->Cell(25,10,$genders[$i], 1, 0, 'C');
    $pdf->Cell(25,10,$bus_id, 1, 0, 'C');
    $pdf->Cell(25,10,$from, 1, 0, 'C');
    $pdf->Cell(25,10,$to, 1, 1, 'C');
}

$pdf->Output();
?>
