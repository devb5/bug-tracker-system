<?php

require_once('tcpdf/tcpdf.php');

include 'config/database.php';

$pdf = new TCPDF();

$pdf->AddPage();

$pdf->SetFont('helvetica', '', 12);

$pdf->Cell(190,10,
'Projects Report',
0,1,'C');

$query = mysqli_query($conn,
"SELECT * FROM projects");

while($row = mysqli_fetch_assoc($query)){

$pdf->Cell(190,10,
$row['project_name'],
1,1);

}

$pdf->Output();

?>