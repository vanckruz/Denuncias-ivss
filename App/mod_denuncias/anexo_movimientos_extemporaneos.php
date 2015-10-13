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
$pdf->MultiCell(0,0,utf8_decode('Nº DGF-DFROR-AME-2015-000625'));
/*-------------------------------- NUMERO DEL DOCUMENTO ---------------------------------------*/
/*---------------------------------------------------------------------------------------------*/
/*-------------------------------- TITULO DEL DOCUMENTO ---------------------------------------*/
$pdf->SetFont('Arial','B',10);
$pdf->setXY(20,38);
$pdf->SetRightMargin(25.0);
$pdf->MultiCell(0,4,utf8_decode('ANEXO DE MOVIMIENTOS EXTEMPORÁNEOS'),0,'C');
/*-------------------------------- TITULO DEL DOCUMENTO ---------------------------------------*/
/*---------------------------------------------------------------------------------------------*/
/*-------------------------------- CUERPO DEL DOCUMENTO----------------------------------------*/
$pdf->setXY(20,50);
$pdf->SetFont('Arial','','8');
$pdf->MultiCell(0,4,utf8_decode("Se levanta el presente anexo, una vez realizada la revisión de los movimientos de Egresos e Ingresos de trabajadores por parte del Empleador  K'NDELA C. A. inscrito en el IVSS, bajo el número patronal O21073432, se identificaron en el sistema informático del seguro social los siguientes movimientos:"));
/*---------------------------------------------------------------------------------------------*/
/*---------------------------------------------------------------------------------------------*/
$pdf->setXY(20,172);
$pdf->MultiCell(0,6,utf8_decode('La información antes descrita fue constatada conjuntamente con "El Empleador" durante la verificación llevada a cabo en la ciudad de PUERTO ORDAZ, _______ de __________________  de 2015. Es todo, terminó, se leyó y en señal de conformidad con el contenido firman.'),0,'J');
/*--------------------------------------- FIRMAS ----------------------------------------------*/
/*----------------  El Empleador --------------------*/
$pdf->SetFillColor(35,65,129);
$pdf->setDrawColor('0','0','0');
$pdf->setTextColor('255','255','255');
$pdf->SetFont('Arial','',8);
$pdf->SetXY(20,200);
$pdf->MultiCell(78,6,utf8_decode('EL EMPLEADOR'),1,'C',1);
$pdf->setTextColor('0','0','0');

$pdf->SetFont('Arial','',7);
$pdf->Rect(20,206,78,10,'D');
$pdf->Text(21,208.6,utf8_decode('Nombres y Apellidos:'));
$pdf->setDrawColor('178','178','178');
$pdf->Line(20.2,209.3,97.8,209.3);
$pdf->setDrawColor('0','0','0');
$pdf->Rect(67,206,31,10,'D');
$pdf->Text(68,208.6,utf8_decode('Cédula de Identidad:'));

$pdf->Rect(20,216,78,10,'D');
$pdf->Text(21,218.6,utf8_decode('Cargo:'));
$pdf->setDrawColor('178','178','178');
$pdf->Line(20.2,219.3,97.8,219.3);
$pdf->setDrawColor('0','0','0');

$pdf->Rect(20,226,78,10,'D');
$pdf->Text(21,228.6,utf8_decode('Fecha:'));
$pdf->setDrawColor('178','178','178');
$pdf->Line(20.2,229.3,97.8,229.3);
$pdf->setDrawColor('0','0','0');
$pdf->Rect(67,226,31,10,'D');
$pdf->Text(68,228.6,utf8_decode('Teléfonos de Contacto:'));

$pdf->Rect(20,236,78,15,'D');
$pdf->Text(21,238.6,utf8_decode('Firma y Sello:'));
$pdf->setDrawColor('178','178','178');
$pdf->Line(20.2,239.3,97.8,239.3);
$pdf->setDrawColor('0','0','0');

/*---------------- Servidor Publico Actuante --------------------*/
$pdf->SetFillColor(35,65,129);
$pdf->setDrawColor('0','0','0');
$pdf->setTextColor('255','255','255');
$pdf->SetXY(112,200);
$pdf->SetFont('Arial','',8);
$pdf->MultiCell(78,6,utf8_decode('SERVIDOR PUBLICO ACTUANTE'),1,'C',1);
$pdf->setTextColor('0','0','0');

$pdf->SetFont('Arial','',7);
$pdf->Rect(112,206,78,10,'D');
$pdf->Text(113,208.6,utf8_decode('Nombres y Apellidos:'));
$pdf->SetFont('Arial','B',8);
$pdf->Text(113,213.6,utf8_decode('CARMEN L. BRAVO M.'));
$pdf->setDrawColor('178','178','178');
$pdf->Line(112.2,209.3,189.8,209.3);
$pdf->setDrawColor('0','0','0');
$pdf->Rect(159,206,31,10,'D');
$pdf->SetFont('Arial','',7);
$pdf->Text(160,208.6,utf8_decode('Cédula de Identidad:'));
$pdf->SetFont('Arial','B',8);
$pdf->Text(160.5,213.6,utf8_decode('V-14.394.714'));

$pdf->SetFont('Arial','',7);
$pdf->Rect(112,216,78,10,'D');
$pdf->Text(113,218.6,utf8_decode('Cargo:'));
$pdf->SetFont('Arial','B',8);
$pdf->Text(113,223.6,utf8_decode('Supervisor de Inspección de Seguridad Social'));
$pdf->SetFont('Arial','',7);
$pdf->setDrawColor('178','178','178');
$pdf->Line(112.2,219.3,189.8,219.3);
$pdf->setDrawColor('0','0','0');

$pdf->Rect(112,226,78,10,'D');
$pdf->Text(113,228.6,utf8_decode('Fecha:'));
$pdf->setDrawColor('178','178','178');
$pdf->Line(112.2,229.3,189.8,229.3);
$pdf->setDrawColor('0','0','0');
//$pdf->Rect(159,126,31,10,'D');
//$pdf->Text(160,128.6,utf8_decode('Teléfonos de Contacto:'));

$pdf->Rect(112,236,78,15,'D');
$pdf->Text(113,238.6,utf8_decode('Firma:'));
$pdf->setDrawColor('178','178','178');
$pdf->Line(112.2,239.3,189.8,239.3);
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