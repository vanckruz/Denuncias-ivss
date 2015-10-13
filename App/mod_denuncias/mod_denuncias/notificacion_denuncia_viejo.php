<?php
session_start();
include('../librerias/fpdf/fpdf.php');
include('../../resources/orcl_conex.php');
include('Models/class.Denuncia.php');
include('Models/class.DenunciaDAO.php');
include('../mod_ciudadanos/Models/class_fisc_ciudadano.php');
include('../mod_ciudadanos/Models/class_fisc_ciudadanoDAO.php');
$id_denuncia = $_GET['id_denuncia'];

$modelo = new DenunciaDAO();

$denuncia = $modelo->getByID($id_denuncia);

$estatus = $denuncia->__GET('estatus_denuncia');

$modelo = new FiscCiudadanoDAO();

$ciudadano = $modelo->getById($denuncia->__GET('id_ciudadano'));

$denunciante = $ciudadano->__GET('apellidos'). "  ".$ciudadano->__GET('nombres');
$cedula_denunciante = $ciudadano->__GET('id_ciudadano');

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

$pdf->SetFont('Arial','B',10);
$pdf->Text(20,31,utf8_decode('NOTIFICACIÓN AL DENUNCIANTE'));

$pdf->SetXY(95,22);
$pdf->SetFillColor(35,65,129);
$pdf->SetFont('Arial','',6);
$pdf->setTextColor(255,255,255);
$pdf->Cell(25,4,utf8_decode('LUGAR'),1, 0 , 'C' , true);
$pdf->Cell(25,4,utf8_decode('FECHA'),1, 0 , 'C' , true);
$pdf->Cell(40,4,utf8_decode('N° DE DENUNCIA'),1, 0 , 'C' , true);
$pdf->Ln();

$pdf->SetXY(95,26);
$pdf->setTextColor(0,0,0);
$pdf->Cell(25,6,'',1, 0 , 'C' , FALSE);
$pdf->Cell(25,6,date('Y/m/d'),1, 0 , 'C' , FALSE);
$pdf->Cell(40,6,$id_denuncia,1, 0 , 'C' , FALSE);
$pdf->Ln();

$pdf->SetXY(20,40);
$pdf->SetFillColor(35,65,129);
$pdf->SetFont('Arial','',6);
$pdf->setTextColor(255,255,255);
$pdf->Cell(70,6,utf8_decode('APELLIDOS Y NOMBRES DEL DENUNCIANTE'),1,0,'C',TRUE);
$pdf->setTextColor(0,0,0);
$pdf->Cell(95,6,$denunciante,1, 0 , 'C' , FALSE);
$pdf->Ln();

$pdf->SetXY(20,50);
$pdf->SetFont('Arial','B',8);
#$pdf->SetTopMargin(2.0);
#$pdf->SetLeftMargin(20.0);
$pdf->SetRightMargin(20.0);
$pdf->setTextColor(0,0,0);
$pdf->MultiCell(0,4,utf8_decode('El instituto Venezolano de los Seguros Sociales, por medio de la presente comunicación, se permite notificarle que su denuncia se encuentra en la siguiente situación o estatus:'));
$pdf->Ln();

$pdf->SetFont('Arial','',8);

$pdf->SetXY(20,63);
$pdf->Cell(10,5,($estatus=='3'?'X':''),1,0,'C',FALSE);

$pdf->SetXY(20,70);
$pdf->Cell(10,5,($estatus=='1'?'X':''),1,0,'C',FALSE);

$pdf->SetXY(20,77);
$pdf->Cell(10,5,($estatus=='2'?'X':''),1,0,'C',FALSE);

$pdf->SetXY(20,84);
$pdf->Cell(10,5,($estatus=='0'?'X':''),1,0,'C',FALSE);

$pdf->SetXY(20,91);
$pdf->Cell(10,5,($estatus=='4'?'X':''),1,0,'C',FALSE);


$pdf->Text(35,66,utf8_decode('PROCESADA'));
$pdf->Text(35,73,utf8_decode('PROCEDENTE'));
$pdf->Text(35,80,utf8_decode('IMPROCEDENTE'));
$pdf->Text(35,87,utf8_decode('EN PROCESO'));
$pdf->Text(35,94,utf8_decode('OTRO'));
$pdf->Line(45,94,190,94);

$pdf->Rect(20,104,170,25,'fill');
$pdf->Text(22,108,utf8_decode('OBSERVACIONES:'));

$pdf->SetXY(20,140);
$pdf->setTextColor(255,255,255);
$pdf->SetFont('Arial','B',6);
$pdf->Cell(85,5,utf8_decode('ELABORADO POR: (FUNCIONARIO(A)'),1,0,'C',TRUE);
$pdf->Cell(85,5,utf8_decode('RECIBE CONFORME: DENUNCIANTE)'),1,0,'C',TRUE);
$pdf->Ln();

$pdf->setTextColor(0,0,0);
$pdf->Rect(20,140,85,28,'fill');
$pdf->Rect(105,140,85,28,'fill');
$pdf->Text(22,150,utf8_decode('FIRMA:'));
$pdf->Text(107,150,utf8_decode('FIRMA:'));

$pdf->SetXY(20,168);
$pdf->Cell(85,5,utf8_decode('NOMBRES Y APELLIDOS:  '.$_SESSION['USUARIO']['nombre']." ".$_SESSION['USUARIO']['apellido']),1,0,'L',FALSE);
$pdf->Cell(85,5,utf8_decode('NOMBRES Y APELLIDOS:  '.$denunciante),1,0,'L',FALSE);
$pdf->Ln();
$pdf->SetX(20);
$pdf->Cell(85,5,utf8_decode('C.I N°:  '.$_SESSION['USUARIO']['cedula']),1,0,'L',FALSE);
$pdf->Cell(85,5,utf8_decode('C.I N°:  '.$cedula_denunciante),1,0,'L',FALSE);

$pdf->Ln();

$pdf->Output('Notificación al denunciante.pdf','I');

?>