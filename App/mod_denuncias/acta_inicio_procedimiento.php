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
/*---------------------------------------------------------------------------------------------*/
/*--------------------------------------- HEADER ----------------------------------------------*/
$pdf->Image('../../public_html/imagenes/logoivss.png',20,7,13);
$pdf->SetFont('Arial','',8);
$pdf->Text(40,10,utf8_decode('REPÚBLICA BOLIVARIANA DE VENEZUELA'));
$pdf->Text(40,13,utf8_decode('MINISTERIO DEL PODER POPULAR PARA EL TRABAJO Y SEGURIDAD SOCIAL'));
$pdf->Text(40,16,utf8_decode('INSTITUTO VENEZOLANO DE LOS SEGUROS SOCIALES'));
$pdf->Text(40,19,utf8_decode('DIRECCIÓN GENERAL DE FISCALIZACIÓN'));
/*--------------------------------------- HEADER ----------------------------------------------*/
/*-------------------------------- TITULO DEL DOCUMENTO ---------------------------------------*/
$pdf->SetFont('Arial','B',10);
$pdf->setXY(20,38);
$pdf->SetRightMargin(25.0);
$pdf->MultiCell(0,4,utf8_decode('ACTA DE INICIO DE PROCEDIMIENTO'),0,'C');
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
$pdf->MultiCell(0,4,utf8_decode('Quien suscribe, _________________________________________________, venezolano, mayor de edad, titular de la cédula de identidad Número__________________, procediendo en mi condición de Servidor Público Actuante, adscrito a la Dirección General de Fiscalización del IVSS, según Resolución de Nombramiento, signada ________________________________________, de fecha ____ de __________ del año____; ampliamente autorizado para este acto según Providencia Administrativa suscrita por el Director General de Fiscalización del IVSS, identificada con las siglas DGF-DFROR-PA-2015-00XXXX, de fecha XX de XXXXXXX del año 2015; por medio del presente acta, se inicia en el domicilio de la sociedad mercantil  XXXXXXXXXXX, identificada con el número patronal XXXXXXXXX, el procedimiento de verificación contenido en los artículos 182, 183, 184, 185 y 186 del Código Orgánico Tributario, a fin de constatar el oportuno cumplimiento de las obligaciones establecidas en la Ley del Seguro Social y su Reglamento General, entre ellas: : Haberse inscrito oportunamente en el Instituto Venezolano de los Seguros Sociales, haber informado si fuere el caso sobre la cesación de actividades, cambios de razón social, traspaso del dominio a cualquier título, y en general, otras circunstancias relativas a las actividades de la empresa, establecimiento, explotación o faena; de igual modo verificar, si el citado empleador, cumplió con la obligación de inscribir a sus trabajadores dentro de los tres (3) días hábiles siguientes al de su ingreso al trabajo, para los trabajadores activos en el período comprendido desde el mes de Febrero 2015 hasta Abril 2015 así como el deber de notificar al Instituto el despido o retiro de los trabajadores dentro de los tres (3) días hábiles siguientes a aquel en el que se produzca tal hecho,  para el período comprendido desde el mes de Febrero 2015  hasta Abril 2015.'));
$pdf->setXY(20,115);
$pdf->MultiCell(0,4,utf8_decode('Asimismo, es menester resaltar, que de conformidad a lo instituido en el numeral 2 del artículo 90 de la Ley del Seguro Social, en concordancia con lo previsto en el artículo 183 del Reglamento General del Seguro Social, los servidores públicos del IVSS, podrán exigir al prenombrado empleador, toda la documentación necesaria para llevar a cabo la gestión encomendada por el IVSS, siendo obligación de éste, presentarla de acuerdo a lo dispuesto en la Providencia Administrativa Número 003, de fecha 20 de septiembre de 2011, publicada en la Gaceta Oficial de la República Bolivariana de Venezuela número 39.788 del 28 de octubre de ese mismo año.'));
$pdf->setXY(20,140);
$pdf->MultiCell(0,4,utf8_decode('Se emiten dos (2) ejemplares de un mismo tenor y a un solo efecto, uno de los cuales quedará en poder de “El Empleador”. En la Ciudad de ____________________, _______ de ____________ de 2015. Se notifica a la citada empresa de conformidad con lo establecido en los artículos 172, 175 y 178 del Código Orgánico Tributario.'));
/*-------------------------------- CUERPO DEL DOCUMENTO----------------------------------------*/
/*---------------------------------------------------------------------------------------------*/
/*--------------------------------------- FIRMAS ----------------------------------------------*/
/*---------------- Servidor Público Actuante --------------------*/
$pdf->SetFillColor(35,65,129);
$pdf->setTextColor('255','255','255');
$pdf->SetXY(65,224);
$pdf->SetFont('Arial','',8);
$pdf->MultiCell(80,6,utf8_decode('Servidor Público Actuante'),1,'C',1);
$pdf->Rect(65,230,80,20,'D');
$pdf->Rect(65,247,80,3,'D');
$pdf->Rect(65,250,80,6,'D');
$pdf->SetFont('Arial','',6);
$pdf->setTextColor('90','90','90');
$pdf->setDrawColor('178','178','178');
$pdf->Line(65.2,250,144.8,250);
$pdf->Text(102,249.2,utf8_decode('Firma'));
$pdf->SetFont('Arial','',7);
$pdf->Text(66,254,utf8_decode('Cédula de Identidad:'));
/*---------------- Servidor El Empleador --------------------*/
$pdf->SetFillColor(35,65,129);
$pdf->setDrawColor('0','0','0');
$pdf->setTextColor('255','255','255');
$pdf->SetFont('Arial','',8);
$pdf->SetXY(20,260);
$pdf->MultiCell(78,6,utf8_decode('Por El Empleador'),1,'C',1);
$pdf->setTextColor('0','0','0');

$pdf->SetFont('Arial','',7);
$pdf->Rect(20,266,78,10,'D');
$pdf->Text(21,268.6,utf8_decode('Nombres y Apellidos:'));
$pdf->setDrawColor('178','178','178');
$pdf->Line(20.2,269.3,97.8,269.3);
$pdf->setDrawColor('0','0','0');
$pdf->Rect(67,266,31,10,'D');
$pdf->Text(68,268.6,utf8_decode('Cédula de Identidad:'));

$pdf->Rect(20,276,78,10,'D');
$pdf->Text(21,278.6,utf8_decode('Cargo:'));
$pdf->setDrawColor('178','178','178');
$pdf->Line(20.2,279.3,97.8,279.3);
$pdf->setDrawColor('0','0','0');

$pdf->Rect(20,286,78,10,'D');
$pdf->Text(21,288.6,utf8_decode('Fecha:'));
$pdf->setDrawColor('178','178','178');
$pdf->Line(20.2,289.3,97.8,289.3);
$pdf->setDrawColor('0','0','0');
$pdf->Rect(67,286,31,10,'D');
$pdf->Text(68,288.6,utf8_decode('Teléfonos de Contacto:'));

$pdf->Rect(20,296,78,15,'D');
$pdf->Text(21,298.6,utf8_decode('Firma:'));
$pdf->setDrawColor('178','178','178');
$pdf->Line(20.2,299.3,97.8,299.3);
$pdf->setDrawColor('0','0','0');

/*---------------- Por el Testigo --------------------*/
$pdf->SetFillColor(35,65,129);
$pdf->setDrawColor('0','0','0');
$pdf->setTextColor('255','255','255');
$pdf->SetXY(112,260);
$pdf->SetFont('Arial','',8);
$pdf->MultiCell(78,6,utf8_decode('Por El Testigo:'),1,'C',1);
$pdf->setTextColor('0','0','0');

$pdf->SetFont('Arial','',7);
$pdf->Rect(112,266,78,10,'D');
$pdf->Text(113,268.6,utf8_decode('Nombres y Apellidos:'));
$pdf->setDrawColor('178','178','178');
$pdf->Line(112.2,269.3,189.8,269.3);
$pdf->setDrawColor('0','0','0');
$pdf->Rect(159,266,31,10,'D');
$pdf->Text(160,268.6,utf8_decode('Cédula de Identidad:'));

$pdf->Rect(112,276,78,10,'D');
$pdf->Text(113,278.6,utf8_decode('Cargo:'));
$pdf->setDrawColor('178','178','178');
$pdf->Line(112.2,279.3,189.8,279.3);
$pdf->setDrawColor('0','0','0');

$pdf->Rect(112,286,78,10,'D');
$pdf->Text(113,288.6,utf8_decode('Fecha:'));
$pdf->setDrawColor('178','178','178');
$pdf->Line(112.2,289.3,189.8,289.3);
$pdf->setDrawColor('0','0','0');
$pdf->Rect(159,286,31,10,'D');
$pdf->Text(160,288.6,utf8_decode('Teléfonos de Contacto:'));

$pdf->Rect(112,296,78,15,'D');
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

$pdf->Output('Acta de Inicio de Procedimiento.pdf','I');
?>