<?php
session_start();
error_reporting(E_ALL);
ini_set("display_errors", 1);

include('../librerias/fpdf/fpdf.php');
include('../../resources/orcl_conex.php');
include('Models/class.Denuncia.php');
include('Models/class.DenunciaDAO.php');
include('Models/class_denuncia_juridica_dao.php');
include('Models/class_denuncia_juridica.php');
include('../mod_ciudadanos/Models/class_fisc_ciudadano.php');
include('../mod_ciudadanos/Models/class_fisc_ciudadanoDAO.php');

$id_denuncia = $_GET['id_denuncia'];
//$tipo = $_GET['tipo_denuncia'];


//$id_denuncia = $num_den;
$modelo = new DenunciaDAO();
$denuncia = $modelo->getByID($id_denuncia);
$time = $denuncia->__GET('hora_denuncia');//date("h:m:s");
$fecha = $denuncia->__GET('fecha_denuncia');
if($denuncia->__GET('id_denuncia') == NULL)
{
	$modelo_queja = new DenunciaJuridicaDAO();
	$queja = $modelo_queja->getByID($id_denuncia);
	$time = $queja->__GET('hora_denuncia');//date("h:m:s");
	$fecha = $queja->__GET('fecha_denuncia');
	$tipo ="Q";
}
else{$tipo ="D";}

if($tipo=="Q")
{
	$cabecera_numero ="N° DE QUEJA Y/O RECLAMO";
	$titulo ="COMPROBANTE DE RECEPCIÓN DE QUEJA Y/O RECLAMO";
	$mensaje = "Procesar su queja y/o reclamo involucra a varias unidades administrativas adscritas al IVSS y activa procedimientos necesarios para la solución del problema, por lo cual requiere de un lapso de (60) días para su proceso, es por ello que agradecemos esperar a ser contactado por vía telefónica o cualquier otro medio para informarle del estatus y/o resultado de su Queja y/o Reclamo.";
}
else
{
	$cabecera_numero = "N° DE DENUNCIA";
	$titulo ="COMPROBANTE DE RECEPCIÓN DE DENUNCIA";
	$mensaje = "Procesar su denuncia involucra a varias unidades administrativas adscritas al IVSS y activa procedimientos necesarios para la solución del problema, por lo cual requiere de un lapso de (60) días para su proceso, es por ello que agradecemos esperar a ser contactado por vía telefónica o cualquier otro medio para informarle del estatus y/o resultado de su Denuncia.";	
}
$estatus = $denuncia->__GET('estatus_denuncia');

$modelo = new FiscCiudadanoDAO();

$ciudadano = $modelo->getById($denuncia->__GET('id_ciudadano'));

$denunciante = $ciudadano->__GET('apellidos'). "  ".$ciudadano->__GET('nombres');

$cedula_denunciante = $ciudadano->__GET('id_ciudadano');



//var_dump($queja->__GET('hora_denuncia'), $queja->__GET('fecha_denuncia'));
//exit();

$pdf = new  FPDF('P','mm','letter');
$pdf->AddPage();
$pdf->Image('../../public_html/imagenes/logoclaro.png',40,50,120);
$pdf->SetTitle("Notificación al denunciante",true);

$pdf->Image('../../public_html/imagenes/logoivss.png',20,7,13);

$pdf->SetFont('Arial','',6);
$pdf->Text(40,10,utf8_decode('REPÚBLICA BOLIVARIANA DE VENEZUELA'));
$pdf->Text(40,13,utf8_decode('MINISTERIO DEL PODER POPULAR PARA EL PROCESO SOCIAL DE TRABAJO'));
$pdf->Text(40,16,utf8_decode('INSTITUTO VENEZOLANO DE LOS SEGUROS SOCIALES'));
$pdf->Text(40,19,utf8_decode('DIRECCIÓN GENERAL DE FISCALIZACIÓN'));

$pdf->SetXY(20,26);
$pdf->SetFillColor(35,65,129);
$pdf->SetFont('Arial','B',8);
$pdf->setTextColor(255,255,255);
$pdf->Cell(50,6,utf8_decode($cabecera_numero),1, 0 , 'C' ,TRUE);
$pdf->SetXY(20,32);
$pdf->setTextColor(0,0,0);
$pdf->Cell(50,6,$id_denuncia,1, 0 , 'C' , FALSE);

$pdf->setTextColor(0,0,0);
$pdf->SetFont('Arial','B',10);
$pdf->Text(50,50,utf8_decode($titulo));

$pdf->SetXY(20,52);
$pdf->SetFont('Arial','B',8);
$pdf->setTextColor(255,255,255);
$pdf->Cell(50,6,utf8_decode('FECHA DE PRESENTACIÓN'),1, 0 , 'C' ,TRUE);
$pdf->setTextColor(0,0,0);
$pdf->Cell(35,6,$fecha,1, 0 , 'C' ,FALSE);
$pdf->setTextColor(255,255,255);
$pdf->Cell(50,6,utf8_decode('HORA DE PRESENTACIÓN'),1, 0 , 'C' ,TRUE);
$pdf->setTextColor(0,0,0);
$pdf->Cell(35,6,$time,1, 0 , 'C' ,FALSE);

$pdf->setTextColor(255,255,255);
$pdf->Rect(20,60,110,30,'FD');
$pdf->Rect(20,90,110,30,'FILL');
$pdf->Rect(20,120,110,30,'FILL');

$pdf->Rect(130,60,60,90,'FILL');

$pdf->Text(55,75,utf8_decode('FUNCIONARIO(A) RECEPTOR'));
$pdf->setTextColor(0,0,0);
$pdf->SetFont('Arial','',8);
$pdf->Text(23,105,utf8_decode('CÓDIGO DEL FUNCIONARIO: '.strtoupper($_SESSION['USUARIO']['codigo_usuario'])));

$pdf->SetFont('Arial','B',8);
$pdf->Text(70,148,utf8_decode('FIRMA'));

$pdf->Text(155,105,utf8_decode('SELLO'));

$pdf->Rect(20,152,170,30,'FILL');

$pdf->Text(22,158,utf8_decode('NOTA IMPORTANTE:'));
$pdf->SetXY(22,160);
$pdf->SetFont('Arial','',8);
$pdf->SetRightMargin(27.0);
$pdf->MultiCell(0,4,utf8_decode($mensaje));

$pdf->Output('Denuncia_'.$id_denuncia.'.pdf','D');

?>