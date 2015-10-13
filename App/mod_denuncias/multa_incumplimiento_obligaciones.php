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

$pdf = new  FPDF('P');
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
#$pdf->Text(20,38,utf8_decode('NOTIFICACIÓN DE CIERRE DE DENUNCIAS, QUEJAS Y/O RECLAMOS PRESENTADA POR AL EMPLEADOR(A) ANTE EL IVSS'));
$pdf->SetRightMargin(25.0);
$pdf->Text(60,45,utf8_decode('DECISIÓN DE MULTA POR INCUMPLIMIENTO DE OBLIGACIONES '));

$pdf->SetXY(20,55);
$pdf->SetFont('Arial','',8);
$pdf->Cell(35,5,utf8_decode('RAZÓN SOCIAL:'),1,0,'L',false);
$pdf->Cell(125,5,'',1,0,'L',false);

$pdf->SetXY(20,60);
$pdf->Cell(35,5,utf8_decode('R.I.F:'),1,0,'L',false);
$pdf->Cell(125,5,'',1,0,'L',false);

$pdf->SetXY(20,65);
$pdf->Cell(35,5,utf8_decode('NÚMERO PATRONAL:'),1,0,'L',false);
$pdf->Cell(125,5,'',1,0,'L',false);

$pdf->SetXY(20,70);
$pdf->Cell(35,5,utf8_decode('DIRECCIÓN'),1,0,'L',false);
$pdf->Cell(125,5,'',1,0,'L',false);

$pdf->SetXY(20,80);
$pdf->MultiCell(0,4,utf8_decode('Quien suscribe, Roselia Uzcategui Pérez, venezolana, mayor de edad, de este domicilio, titular de la cédula de identidad número V-14.346.592,  procediendo en este acto en mi carácter de Jefa de Oficina Administrativa Puerto Ordaz, ubicada en la Urbanización Campo B2 de Ferrominera, Calle Argentina con Carrera Ecuador, cruce con Avenida Vía Venezuela. Edificio Sede Oficina Administrativa IVSS, Parroquia Cachamay, Municipio Caroní, Puerto Ordaz, Estado Bolívar, adscrita a la Dirección General de Afiliación y Prestaciones en Dinero del Instituto Venezolano de los Seguros Sociales, Instituto Autónomo con personalidad jurídica y patrimonio propio e independiente de la Nación, creado por la Ley del Seguro Social Obligatorio, publicada en la Gaceta Oficial Extraordinaria de los Estados Unidos de Venezuela, el 24 de julio de 1940, adoptada su actual denominación según Decreto Número: 239, publicado en la Gaceta Oficial de los Estados Unidos de Venezuela Número: 21.978, el día 06 de abril de 1946, carácter que consta en Resolución distinguida con las siglas DGRHYAP-DAPRC/10 Nº 00361, de fecha 12 de Enero de 2010, suscrita por el Presidente del IVSS y ampliamente autorizada para este acto según lo dispuesto en el numeral 3 del artículo 90 de la Ley del Seguro Social, procedo a emitir la presente Decisión Administrativa:'));

$pdf->SetXY(20,130);
$pdf->MultiCell(0,4,utf8_decode('1. INICIO DEL PROCEDIMIENTO
Mediante Providencia Administrativa, identificada con las siglas DGF-DFROR-PA-2015-___________, de fecha 13 de Abril de 2015, se autorizó a: ___________________________, titular de la cédula de identidad número V-____________, para llevar a cabo el procedimiento de verificación contenido en los artículos 182, 183, 184, 185 y 186 del Código Orgánico Tributario, a los fines de constatar el oportuno cumplimiento de las obligaciones ante el Instituto Venezolano de los Seguros Sociales (IVSS), por parte del empleador: __________________________________, identificado con el Registro de Información Fiscal (RIF) Número: ________________________, e inscrito en el IVSS, bajo el Número Patronal: _______________, establecidas en la Ley del Seguro Social y su Reglamento General, entre ella:  Haberse inscrito oportunamente en el Instituto Venezolano de los Seguros Sociales, haber informado si fuere el caso sobre la cesación de actividades, cambios de razón social, traspaso del dominio a cualquier título, y en general, otras circunstancias relativas a las actividades de la empresa, establecimiento, explotación o faena; de igual modo verificar, el periodo comprendido desde el mes de Enero de  2015 hasta Marzo de 2015, si el citado empleador, cumplió con la obligación de inscribir a sus trabajadores dentro de los  tres (3) días hábiles siguientes al de su ingreso al trabajo y el deber de comunicar al Instituto el despido o retiro de los trabajadores dentro de los tres (3) días hábiles siguientes a aquel en el que se produzca tal hecho. En atención a ello, el Servidor Público, antes identificado, en fecha ____ de _____________  de 2015, levantó en el domicilio del aludido empleador, Acta de Inicio del Procedimiento, distinguida con N°: DGF-DFROR-AIP-2015-_________,  Acta de Requerimiento de Documentos, signada con N°: DGF-DFROR-ARD-2015-_________, a través de la cual se le requirió al prenombrado empleador la información necesaria para llevar a cabo la verificación ordenada por el IVSS, levantándose en esa misma oportunidad, Acta de Recepción de Documentos, identificada con las siglas N°: DGF-DFROR-AR-2015-_________, y Acta de Hacer Constar, señalada con la nomenclatura N°: DGF-DFROR-AHC-2015-_________, mediante la cual, el Servidor Público Actuante dejó constancia de la documentación aportada por la empresa.'));

$pdf->SetXY(20,220);
$pdf->MultiCell(0,4,utf8_decode('2. REVISIÓN DE LA DOCUMENTACIÓN Y DETERMINACIÓN DE LAS INFRACCIONES ADMINISTRATIVAS
De la revisión realizada a los documentos presentados por el empleador:  ____________________________________, identificado con el Registro de Información Fiscal (RIF) Número: ___________, e inscrito en el IVSS, bajo el Número Patronal: _________, mediante el Acta de Recepción de Documentos, identificada con las siglas N°: DGF- DFROR-AR-2015-_________, y la arrojada por los reportes de movimientos efectuados por la citada empresa, a través del Sistema de Gestión y Autoliquidación de empresas que maneja el IVSS, se constataron los siguientes aspectos:'));

$pdf->SetXY(20,250);
$pdf->MultiCell(0,4,utf8_decode('2.1. El empleador NO cumplió con la obligación de comunicar al Instituto el despido o retiro dentro de los tres (3) días hábiles siguientes a aquel en el que se produzca tal hecho de los siguientes trabajadores:'));

/***************Pie******************************************/
/*
$pdf->setDrawColor('0','0','0');
$pdf->setTextColor('0','0','0');
$pdf->SetFont('Arial','B',7);
$pdf->Line(20,265,185,265);
$pdf->setXY(20,268);
$pdf->MultiCell(0,0,utf8_decode('DIRECCION GENERAL DE FISCALIZACION'),0,'C');
$pdf->SetFont('Arial','',7);
$pdf->setXY(20,271);
$pdf->MultiCell(0,0,utf8_decode('Dirección: Av. Urdaneta Esquina de Veroes con Boulevard Panteón, Edificio Lecuna, al lado del Banco de Venezuela,'),0,'C');
$pdf->setXY(20,274);
$pdf->MultiCell(0,0,utf8_decode('Parroquia Altagracia, Municipio Libertador, Distrito Capital-Venezuela. Código Postal 1010.'),0,'C');
$pdf->setXY(20,277);
$pdf->MultiCell(0,0,utf8_decode('Teléfonos: 0212- 8635567- 8635716-8635429-8635161 (TELEFAX)'),0,'C');
*/
$pdf->Output('Multa por incumplimiento de obligaciones.pdf','I');
?>

