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

$id_denuncia='DGI301593ivss';
$denunciante="pepe";
$motivo_denuncia="jdfngjknsdfg";

$pdf = new  FPDF('P','mm','legal');
$pdf->AddPage('','','','');
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
/*-------------------------------- NUMERO DEL DOCUMENTO ---------------------------------------*/
$pdf->SetFont('Arial','B',12);
$pdf->setXY(20,30);
$pdf->MultiCell(0,0,utf8_decode('N° DGF-DFROR-AIP-2015-00XXXX'));
/*-------------------------------- NUMERO DEL DOCUMENTO ---------------------------------------*/
/*---------------------------------------------------------------------------------------------*/
/*-------------------------------- TITULO DEL DOCUMENTO ---------------------------------------*/
$pdf->SetFont('Arial','B',10);
$pdf->setXY(20,38);
$pdf->SetRightMargin(25.0);
$pdf->MultiCell(0,4,utf8_decode('ACTA DE RECEPCIÓN DE DOCUMENTOS'),0,'C');
/*-------------------------------- TITULO DEL DOCUMENTO ---------------------------------------*/
/*---------------------------------------------------------------------------------------------*/
/*-------------------------------- CUERPO DEL DOCUMENTO----------------------------------------*/

$pdf->setXY(20,50);
$pdf->SetFont('Arial','','8');
$pdf->MultiCell(0,6,utf8_decode('En atención a la solicitud realizada a la sociedad mercantil ­­­­_____________________,  identificada con el Registro de Información Fiscal (RIF) número ___________________ e inscrita en el IVSS, bajo el número patronal __________________, mediante el Acta de Requerimiento de Documentos, identificada con el N° DGF-DFROR-ARD-2015-00XXXX , de fecha _____ de ___________de 2015, por medio de la presente, se deja constancia de cuál fue la documentación consignada por el aludido empleador, para llevar a cabo el procedimiento de verificación iniciado a través del Acta de Inicio de Procedimiento, signada con la nomenclatura N° DGF-DFROR-AIP-2015-00XXXX, de fecha ____ de __________de 2015,  a saber:'));
/*----------------- CUADRO DE DOCUMENTOS ------------------------*/
//$pdf->setXY(20,80);
//-----------Cabecera
$pdf->SetFillColor(35,65,129);
$pdf->setTextColor(255,255,255);
$pdf->Rect(21,90,6,6,'DF');
$pdf->Text(22.8,94,utf8_decode('N°'));
$pdf->Rect(27,90,100,6,'DF');
$pdf->Text(61,94,utf8_decode('Documentos Requeridos'));
$pdf->Rect(127,90,18,6,'DF');
$pdf->Text(128,94,utf8_decode('Consignados'));
$pdf->Rect(145,90,45,6,'DF');
$pdf->Text(157,94,utf8_decode('Observaciones'));
//-----------DOCUMENTOS
$pdf->setTextColor(0,0,0);
$pdf->SetFillColor(255,255,255);
//-----------1
$pdf->Rect(21,96,6,10,'D');
$pdf->Text(23.2,101.5,utf8_decode('1'));
$pdf->Rect(27,96,100,10,'D');
$pdf->setXY(28,97.5);
$pdf->MultiCell(98,3.5,utf8_decode('Forma (14-01) "Cédula del Patrono o Empresa" y/o Registro al Sistema de Gestión y Autoliquidación de Empresas "TIUNA".'),0,'J');
$pdf->setXY(20,50);
$pdf->Rect(127,96,18,10,'D');
$pdf->Rect(145,96,45,10,'D');
//----------2
$pdf->Rect(21,106,6,10,'D');
$pdf->Text(23.2,111.8,utf8_decode('2'));
$pdf->Rect(27,106,100,10,'D');
$pdf->setXY(28,107.5);
$pdf->MultiCell(98,3.5,utf8_decode('Nóminas de Trabajadores de la Empresa para el período comprendido entre Febrero 2015 hasta Abril 2015'),0,'J');
$pdf->Rect(127,106,18,10,'D');
$pdf->Rect(145,106,45,10,'D');
//---------3
$pdf->Rect(21,116,6,10,'D');
$pdf->Text(23.2,122,utf8_decode('3'));
$pdf->Rect(27,116,100,10,'D');
$pdf->setXY(28,117.5);
$pdf->MultiCell(81,3.5,utf8_decode('Acta Constitutiva, más últimas Actas de Asamblea Estatutarias (Modificaciones)'),0,'J');
$pdf->Rect(127,116,18,10,'D');
$pdf->Rect(145,116,45,10,'D');
//---------4
$pdf->Rect(21,126,6,6,'D');
$pdf->Text(23.2,129.8,utf8_decode('4'));
$pdf->Rect(27,126,100,6,'D');
$pdf->setXY(28,127.5);
$pdf->MultiCell(78.3,3.5,utf8_decode('Registro de Información Fiscal (RIF)'),0,'J');
$pdf->Rect(127,126,18,6,'D');
$pdf->Rect(145,126,45,6,'D');
//---------5
$pdf->Rect(21,132,6,35,'D');
$pdf->Text(23.2,149.8,utf8_decode('5'));
$pdf->Rect(27,132,100,35,'D');
$pdf->setXY(28,147.2);
$pdf->MultiCell(78.3,3.5,utf8_decode('Documentos Adicionales presentados por el Empleador'),0,'J');
$pdf->Rect(127,132,18,35,'D');
$pdf->Rect(145,132,45,35,'D');
/*----------------- CUADRO DE DOCUMENTOS ------------------------*/
$pdf->setXY(20,172);
$pdf->MultiCell(0,6,utf8_decode('Se hacen dos (2) ejemplares de un mismo tenor y a un solo efecto, uno de los cuales quedará en poder de "El Empleador". En la ciudad de __________________, a los ____ días  de _____________ de 2015. Es todo, terminó, se leyó y en señal de conformidad con el contenido firman.'),0,'J');
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
/*----------------------------------------------------------------------------------------------------*/
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

$pdf->Output('Acta de Inicio de Procedimiento.pdf','I');
?>