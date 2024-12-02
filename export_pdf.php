<?php
require('reportmodules/fpdf/fpdf.php');
include('reportmodules/db.php');

$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 16);
$pdf->Cell(0, 10, 'Clicks Report', 1, 1, 'C');

$pdf->SetFont('Arial', '', 12);
$sql = "SELECT item_name, click_count FROM clicks";
$result = $conn->query($sql);

while ($row = $result->fetch_assoc()) {
    $pdf->Cell(95, 10, $row['item_name'], 1);
    $pdf->Cell(95, 10, $row['click_count'], 1, 1);
}

$pdf->Output();
?>
