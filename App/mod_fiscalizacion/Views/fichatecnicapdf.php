<?
//session_start();
//error_reporting(E_ALL);
error_reporting(E_ALL);
ini_set("display_errors", 1);
include('../../librerias/fpdf/fpdf.php');

$pdf=new FPDF('P');
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);
$pdf->Cell(40,10,'¡Mi primera página pdf con FPDF!');
$pdf->Output();
?>