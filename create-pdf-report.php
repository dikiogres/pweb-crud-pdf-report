<?php

$path =  $_SERVER['DOCUMENT_ROOT'] . '/phpfpdf/fpdf.php';

require($path);

$pdf = new FPDF('l', 'mm', 'A5');

$pdf->AddPage();

$pdf->SetFont('Arial', 'B', 20);
$pdf->Cell(0, 7, 'DAFTAR SISWA PENDAFTAR', 0, 1, 'C');
$pdf->SetFont('Arial', 'B', 20);

$pdf->Ln(7);

$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(8, 15, 'No', 1, 0,  'C');
$pdf->Cell(30, 15, 'Foto', 1, 0,  'C');
$pdf->Cell(25, 15, 'NIS', 1, 0,  'C');
$pdf->Cell(30, 15, 'Nama', 1, 0,  'C');
$pdf->Cell(30, 15, 'Jenis Kelamin', 1, 0,  'C');
$pdf->Cell(30, 15, 'Nomor Telepon', 1, 0,  'C');
$pdf->Cell(35, 15, 'Alamat', 1, 1, 'C');

$pdf->SetFont('Arial', '', 10);

include 'config.php';

$sql = $pdo->prepare("SELECT * FROM registrations");
$sql->execute();

$loop = 1;
while ($student = $sql->fetch()) {
    $pdf->Cell(8, 15, $loop, 1, 0);
    $pdf->Cell(30, 15, 
        $pdf->Image('images/' . $student['photo'], $pdf->GetX() + 9, $pdf->GetY() + 2, 12, 0)
    , 1, 0, 'C', false);
    $pdf->Cell(25, 15, $student['nis'], 1, 0);
    $pdf->Cell(30, 15, $student['name'], 1, 0);
    $pdf->Cell(30, 15, $student['gender'], 1, 0);
    $pdf->Cell(30, 15, $student['phone_number'], 1, 0);
    $pdf->Cell(35, 15, $student['address'], 1, 1);
    
    $loop++;
}

$pdf->Output();