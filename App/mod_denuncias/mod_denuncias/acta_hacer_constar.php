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
$pdf->Image('../../public_html/imagenes/logoclaro.png',40,60,120);
$pdf->SetTitle("Notificación al denunciante",true);

$pdf->Image('../../public_html/imagenes/logoivss.png',20,7,13);
$pdf->SetFont('Arial','',6);
$pdf->Text(40,10,utf8_decode('REPÚBLICA BOLIVARIANA DE VENEZUELA'));
$pdf->Text(40,13,utf8_decode('MINISTERIO DEL PODER POPULAR PARA EL TRABAJO Y SEGURIDAD SOCIAL'));
$pdf->Text(40,16,utf8_decode('INSTITUTO VENEZOLANO DE LOS SEGUROS SOCIALES'));
$pdf->Text(40,19,utf8_decode('DIRECCIÓN GENERAL DE FISCALIZACIÓN'));


$pdf->SetFont('Arial','B',8);
$pdf->Text(20,31,utf8_decode('Nº DGF-DFROR-AHC-2015-XXXXXX'));
$pdf->SetFont('Arial','B',10);
$pdf->SetRightMargin(25.0);
$pdf->Text(85,45,utf8_decode('ACTA DE HACER CONSTAR'));

$pdf->SetXY(20,50);
$pdf->SetFont('Arial','',8);
$pdf->MultiCell(0,4,utf8_decode('Se levanta el presente acta, a fin de dejar constancia de los aspectos determinados a través de la documentación consignada por la sociedad mercantil______________________, identificada con el Registro de Información Fiscal (RIF) número ________________ e inscrita en el IVSS, bajo el número patronal ________________, con el objeto de que el Servidor Público Actuante, debidamente autorizado mediante Providencia Administrativa, signada con N° DGF-DFROR-PA-2015-XXXXXXX, de fecha ____ de __________ de 2015, llevará a cabo el procedimiento de verificación contenido en los artículos 182, 183, 184,185 y 186 del Código Orgánico Tributario, a saber :'));

$pdf->SetXY(20,160);
$pdf->SetFont('Arial','',8);
$pdf->MultiCell(0,4,utf8_decode('Se emiten dos (2) ejemplares de un mismo tenor y a un solo efecto, uno de los cuales quedará en poder de "El Empleador". En la Ciudad de ______________, _______ de __________________  de 2015. Es todo, terminó, se leyó y en señal de conformidad con el contenido firman.'));

/********************************************************************/
/*$pdf->SetFillColor(35,65,129);
$pdf->SetFont('Arial','B',8);
$pdf->Rect(60,181,90,7,'FD');
$pdf->Rect(60,188,90,30,'fill');
$pdf->Rect(60,211,90,7,'fill');
$pdf->Rect(60,218,90,10,'fill');
$pdf->setTextColor(255,255,255);
$pdf->Text(80,185,utf8_decode('SERVIDOR PÚBLICO ACTUALMENTE'));
$pdf->setTextColor(0,0,0);
$pdf->Text(100,215,utf8_decode('FIRMA'));
$pdf->Text(63,223,utf8_decode('Cédula de Identidad Número: '));*/
/********************************************************************/

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

/***********************************************************************/
/*
$pdf->setTextColor(255,255,255);
$pdf->Rect(20,240,80,7,'FD');
$pdf->Rect(110,240,80,7,'FD');
$pdf->Rect(20,247,80,7,'D');
$pdf->Text(45,244,utf8_decode('POR EL EMPLEADOR:'));
$pdf->Text(135,244,utf8_decode('POR EL TESTIGO:'));
*/
/***********************************************************************/


/******************************Pie*************************/
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
/******************************Pie*************************/




$pdf->Output('Multa por incumplimiento de obligaciones.pdf','I');
?>

