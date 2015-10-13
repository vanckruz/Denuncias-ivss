<?php
session_start();
include('../librerias/fpdf/fpdf.php');
include('../../resources/orcl_conex.php');
include('../../resources/select/funciones.php');
include('Models/class.Denuncia.php');
include('Models/class.DenunciaDAO.php');
include('../mod_ciudadanos/Models/class_fisc_ciudadano.php');
include('../mod_ciudadanos/Models/class_fisc_ciudadanoDAO.php');
include('../mod_empresas/Models/class_fisc_empresa.php');
include('../mod_empresas/Models/class_fisc_empresaDAO.php');

#$id_denuncia = $_GET['id_denuncia'];
/*
$modelo = new DenunciaDAO();

$denuncia = $modelo->getByID($id_denuncia);

$estatus = $denuncia->__GET('estatus_denuncia');

$modelo = new FiscCiudadanoDAO();

$ciudadano = $modelo->getById($denuncia->__GET('id_ciudadano'));

$modelo = new FiscEmpresaDAO();

$empresa = $modelo->queryByPatrono($denuncia->__GET('id_empresa'));

$denunciante = $ciudadano->__GET('apellidos'). "  ".$ciudadano->__GET('nombres');
$cedula_denunciante = $ciudadano->__GET('id_ciudadano');
$motivos = dameMotivos();
$motivo = $denuncia->__GET('motivo_denuncia')-1;
$motivo_denuncia = $motivos[$motivo]['DESCRIPCION'];
*/
$id_denuncia='DGI301593ivss';
$denunciante="pepe";
$motivo_denuncia="jdfngjknsdfg";



$pdf = new  FPDF('P','mm','legal');
$pdf->AddPage();
$pdf->Image('../../public_html/imagenes/logoclaro.png',40,100	,130);
$pdf->SetTitle("Notificación al denunciante",true);
/*--------------------------------------- HEADER ----------------------------------------------*/
$pdf->Image('../../public_html/imagenes/logoivss.png',20,7,13);
$pdf->SetFont('Arial','',8);
$pdf->Text(40,10,utf8_decode('REPÚBLICA BOLIVARIANA DE VENEZUELA'));
$pdf->Text(40,13,utf8_decode('MINISTERIO DEL PODER POPULAR PARA EL TRABAJO Y SEGURIDAD SOCIAL'));
$pdf->Text(40,16,utf8_decode('INSTITUTO VENEZOLANO DE LOS SEGUROS SOCIALES'));
$pdf->Text(40,19,utf8_decode('DIRECCIÓN GENERAL DE FISCALIZACIÓN'));
/*--------------------------------------- HEADER ----------------------------------------------*/
/*---------------------------------------------------------------------------------------------*/
/*---------------------------------------------------------------------------------------------*/
/*-------------------------------- TITULO DEL DOCUMENTO ---------------------------------------*/
$pdf->SetFont('Arial','B',10);
$pdf->setXY(20,38);
$pdf->SetRightMargin(25.0);
$pdf->MultiCell(0,4,utf8_decode('ACTA DE REQUERIMIENTO DE DOCUMENTOS'),0,'C');
/*-------------------------------- TITULO DEL DOCUMENTO ---------------------------------------*/
/*---------------------------------------------------------------------------------------------*/
/*-------------------------------- NUMERO DEL DOCUMENTO ---------------------------------------*/
$pdf->SetFont('Arial','B',10);
$pdf->setXY(20,30);
$pdf->MultiCell(0,0,utf8_decode('N° DGF-DFROR-AIP-2015-00XXXX'));
/*-------------------------------- NUMERO DEL DOCUMENTO ---------------------------------------*/
/*---------------------------------------------------------------------------------------------*/
/*-------------------------------- CUERPO DEL DOCUMENTO----------------------------------------*/

$pdf->setXY(20,50);
$pdf->SetFont('Arial','','8');
$pdf->MultiCell(0,4,utf8_decode('Hoy, _______________________________________encontrándonos en el domicilio de la sociedad mercantil ____________________, identificada con el Registro de Información Fiscal (RIF) número __________________ e inscrita en el IVSS, bajo el número patronal _____________, se levanta la presente Acta de Requerimiento de Documentos, a fin de solicitar al aludido empleador, la documentación necesaria para llevar a cabo el procedimiento de verificación iniciado a través del Acta de Inicio de Procedimiento, identificada con la nomenclatura DGF-DFROR-AIP-2015-000001, de fecha ___ de _________ de 2015, en atención a ello, la citada sociedad mercantil, deberá entregar al Servidor Público Actuante debidamente autorizado, mediante Providencia Administrativa signada DGF-DFROR-PA-2015-000001, de fecha ____ de __________ de 2015, la siguiente documentación:'));
$pdf->SetFont('Arial','B','8');
$pdf->setXY(30,85);
$pdf->MultiCell(0,4,utf8_decode('1. 		Forma (14-01) "Cédula del Patrono o Empresa" y/o Registro al Sistema de Gestión y Autoliquidación de Empresas "TIUNA".'));
$pdf->setXY(30,94);
$pdf->MultiCell(0,4,utf8_decode('2. 		Nóminas de Trabajadores de la Empresa para el período comprendido entre Febrero 2015 hasta Abril 2015.'));
$pdf->setXY(30,99);
$pdf->MultiCell(0,4,utf8_decode('3. 		Acta Constitutiva, más últimas Actas de Asamblea Estatutarias (Modificaciones).'));
$pdf->setXY(30,104);
$pdf->MultiCell(0,4,utf8_decode('4. 		Registro de Información Fiscal (RIF).'));
$pdf->SetFont('Arial','','8');
$pdf->setXY(20,114);
$pdf->MultiCell(0,4,utf8_decode('Se emiten dos (2) ejemplares de un mismo tenor y a un solo efecto, uno de los cuales quedará en poder de "El Empleador". Es todo, terminó, se leyó y en señal de conformidad firman.'));



/*$pdf->setXY(20,140);
$pdf->MultiCell(0,4,utf8_decode('Se emiten dos (2) ejemplares de un mismo tenor y a un solo efecto, uno de los cuales quedará en poder de “El Empleador”. En la Ciudad de ____________________, _______ de ____________ de 2015. Se notifica a la citada empresa de conformidad con lo establecido en los artículos 172, 175 y 178 del Código Orgánico Tributario.'));
*/
/*-------------------------------- CUERPO DEL DOCUMENTO----------------------------------------*/
/*---------------------------------------------------------------------------------------------*/
/*--------------------------------------- FIRMAS ----------------------------------------------*/
/*---------------- Servidor Público Actuante --------------------*/
$pdf->SetFillColor(35,65,129);
$pdf->setDrawColor('0','0','0');
$pdf->setTextColor('255','255','255');
$pdf->SetFont('Arial','',8);
$pdf->SetXY(20,260);
$pdf->MultiCell(78,6,utf8_decode('Por El Servidor Publico Actuante:'),1,'C',1);
$pdf->setTextColor('0','0','0');

$pdf->SetFont('Arial','',7);
$pdf->Rect(20,266,78,10,'D');
$pdf->Text(21,268.6,utf8_decode('Nombres y Apellidos:'));
$pdf->setDrawColor('178','178','178');
$pdf->Line(20.2,269.3,97.8,269.3);
$pdf->setDrawColor('0','0','0');
$pdf->Rect(67,266,31,10,'fill');
$pdf->Text(68,268.6,utf8_decode('Cédula de Identidad:'));


$pdf->Rect(20,276,78,20,'fill');
$pdf->Text(21,278.6,utf8_decode('Cargo:'));
$pdf->setDrawColor('178','178','178');
$pdf->Line(20.2,279.3,97.8,279.3);
$pdf->setDrawColor('0','0','0');

$pdf->SetFont('Arial','B',7);
$pdf->Text(22,285.6,utf8_decode('Cargo:'));
$pdf->SetFont('Arial','',7);
$pdf->Text(30,285.6,utf8_decode('Servidor(a) Público Actuante'));
$pdf->SetFont('Arial','B',7);
$pdf->Text(22,290.6,utf8_decode('Supervisor(a) de Inspección de Seguridad Social'));
$pdf->SetFont('Arial','',7);


$pdf->Rect(20,296,78,15,'fill');
$pdf->Text(21,298.6,utf8_decode('Firma:'));
$pdf->setDrawColor('178','178','178');
$pdf->Line(20.2,299.3,97.8,299.3);
$pdf->setDrawColor('0','0','0');

/*---------------- Empleador --------------------*/
$pdf->SetFillColor(35,65,129);
$pdf->setDrawColor('0','0','0');
$pdf->setTextColor('255','255','255');
$pdf->SetXY(112,260);
$pdf->SetFont('Arial','',8);
$pdf->MultiCell(78,6,utf8_decode('Por El Empleador:'),1,'C',1);
$pdf->setTextColor('0','0','0');

$pdf->SetFont('Arial','',7);
$pdf->Rect(112,266,78,10,'fill');
$pdf->Text(113,268.6,utf8_decode('Nombres y Apellidos:'));
$pdf->setDrawColor('178','178','178');
$pdf->Line(112.2,269.3,189.8,269.3);
$pdf->setDrawColor('0','0','0');
$pdf->Rect(159,266,31,10,'fill');
$pdf->Text(160,268.6,utf8_decode('Cédula de Identidad:'));

$pdf->Rect(112,276,78,20,'fill');
$pdf->Text(113,278.6,utf8_decode('Cargo:'));
$pdf->setDrawColor('178','178','178');
$pdf->Line(112.2,279.3,189.8,279.3);
$pdf->setDrawColor('0','0','0');

$pdf->Rect(112,286,78,10,'fill');
$pdf->Text(113,288.6,utf8_decode('Teléfonos de Contacto:'));
$pdf->setDrawColor('178','178','178');
$pdf->Line(112.2,289.3,189.8,289.3);
$pdf->setDrawColor('0','0','0');

$pdf->Rect(112,296,78,15,'fill');
$pdf->Text(113,298.6,utf8_decode('Firma y Sello:'));
$pdf->setDrawColor('178','178','178');
$pdf->Line(112.2,299.3,189.8,299.3);
$pdf->setDrawColor('0','0','0');

/*----------------------------------------- FIRMAS ---------------------------------------------------*/
/*--------------------------------------- PIE DE PÁGINA ----------------------------------------------*/
$pdf->setDrawColor('0','0','0');
$pdf->setTextColor('0','0','0');
$pdf->SetFont('Arial','B',7);
$pdf->Line(18,322,193,322);
$pdf->setXY(20,324);
$pdf->MultiCell(0,0,utf8_decode('DIRECCIÓN GENERAL DE FISCALIZACIÓN'),0,'C');
$pdf->SetFont('Arial','',7);
$pdf->setXY(20,329);
$pdf->MultiCell(0,0,utf8_decode('Dirección: Av. Urdaneta Esquina de Veroes con Boulevard Panteón, Edificio Lecuna, al lado del Banco de Venezuela,'),0,'C');
$pdf->setXY(20,331.8);
$pdf->MultiCell(0,0,utf8_decode('Parroquia Altagracia, Municipio Libertador, Distrito Capital-Venezuela. Código Postal 1010.'),0,'C');
$pdf->setXY(20,335);
$pdf->MultiCell(0,0,utf8_decode('Teléfonos: 0212- 8635567- 8635716-8635429-8635161 (TELEFAX)'),0,'C');
/*------------------------------------------- OUTPUT ---------------------------------------------------*/
$pdf->Output('Acta de Requerimiento de Documentos.pdf','I');
?>