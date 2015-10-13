<?php
session_start();
include('../librerias/fpdf/fpdf.php');
include('../../resources/orcl_conex.php');
include('Models/class.Denuncia.php');
include('Models/class.DenunciaDAO.php');
include('../mod_ciudadanos/Models/class_fisc_ciudadano.php');
include('../mod_ciudadanos/Models/class_fisc_ciudadanoDAO.php');


$pdf = new  FPDF('P');
$pdf->AddPage();
$pdf->Image('../../public_html/imagenes/logoclaro.png',40,50,120);
$pdf->SetTitle("Notificación al denunciante",true);

$pdf->Image('../../public_html/imagenes/logoivss.png',20,7,13);

$pdf->SetFont('Arial','',6);
$pdf->Text(40,10,utf8_decode('REPÚBLICA BOLIVARIANA DE VENEZUELA'));
$pdf->Text(40,13,utf8_decode('MINISTERIO DEL PODER POPULAR PARA EL TRABAJO Y SEGURIDAD SOCIAL'));
$pdf->Text(40,16,utf8_decode('INSTITUTO VENEZOLANO DE LOS SEGUROS SOCIALES'));
$pdf->Text(40,19,utf8_decode('DIRECCIÓN GENERAL DE FISCALIZACIÓN'));

$pdf->SetXY(20,26);
$pdf->SetFillColor(35,65,129);
$pdf->SetFont('Arial','B',8);
$pdf->setTextColor(255,255,255);
$pdf->Cell(50,6,utf8_decode('N° DE QUEJAS Y/O RECLAMOS'),1, 0 , 'C' ,TRUE);
$pdf->SetXY(20,32);
$pdf->Cell(50,6,'',1, 0 , 'C' ,FALSE);

$pdf->setTextColor(0,0,0);
$pdf->SetFont('Arial','B',8);
$pdf->Text(60,50,utf8_decode('COMPROBANTE DE RECEPCIÓN DE QUEJA Y/O RECLAMO'));

$pdf->SetXY(20,52);
$pdf->SetFont('Arial','B',8);
$pdf->setTextColor(255,255,255);
$pdf->Cell(50,6,utf8_decode('FECHA DE PRESENTACIÓN'),1, 0 , 'C' ,TRUE);
$pdf->Cell(35,6,'',1, 0 , 'C' ,FALSE);
$pdf->Cell(50,6,utf8_decode('HORA DE PRESENTACIÓN'),1, 0 , 'C' ,TRUE);
$pdf->Cell(35,6,'',1, 0 , 'C' ,FALSE);

$pdf->setTextColor(255,255,255);
$pdf->Rect(20,60,110,30,'FD');
$pdf->Rect(20,90,110,30,'FILL');
$pdf->Rect(20,120,110,30,'FILL');

$pdf->Rect(130,60,60,90,'FILL');

$pdf->Text(55,75,utf8_decode('FUNCIONARIO(A) RECEPTOR'));
$pdf->setTextColor(0,0,0);
$pdf->SetFont('Arial','',8);
$pdf->Text(23,105,utf8_decode('APELLIDOS Y NOMBRES:'));

$pdf->SetFont('Arial','B',8);
$pdf->Text(70,148,utf8_decode('FIRMA'));

$pdf->Text(155,105,utf8_decode('SELLO'));

$pdf->Rect(20,152,170,30,'FILL');

$pdf->Text(22,158,utf8_decode('NOTA IMPORTANTE:'));
$pdf->SetXY(22,160);
$pdf->SetFont('Arial','',8);
$pdf->SetRightMargin(20.0);
$pdf->MultiCell(0,4,utf8_decode('Procesar su denuncia incolucra a varias unidades administrativas adscritas al IVSS y activa procedimientos necesarios para la solución del problema, por lo cual requiere de un lapso de (60) días para su proceso, es por ello que agradecemos esperar a ser contacctado por vía telefónica o cualquier otro medio para informarle del estatus y/o resultado de su Denuncia, Queja y/o Reclamo.'));

/***************************************************************************/
$pdf->Output('comprobante_recepcion_queja.pdf','I');
/***************************************************************************/
?>