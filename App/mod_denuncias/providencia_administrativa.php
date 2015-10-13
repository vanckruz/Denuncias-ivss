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
/*--------------------------------------- HEADER ----------------------------------------------*/
$pdf->Image('../../public_html/imagenes/logoivss.png',20,7,13);
$pdf->SetFont('Arial','',6);
$pdf->Text(40,10,utf8_decode('REPÚBLICA BOLIVARIANA DE VENEZUELA'));
$pdf->Text(40,13,utf8_decode('MINISTERIO DEL PODER POPULAR PARA EL TRABAJO Y SEGURIDAD SOCIAL'));
$pdf->Text(40,16,utf8_decode('INSTITUTO VENEZOLANO DE LOS SEGUROS SOCIALES'));
$pdf->Text(40,19,utf8_decode('DIRECCIÓN GENERAL DE FISCALIZACIÓN'));
/*--------------------------------------- HEADER ----------------------------------------------*/
/*---------------------------------------------------------------------------------------------*/
/*-------------------------------- TITULO DEL DOCUMENTO ---------------------------------------*/
$pdf->SetFont('Arial','B',10);
$pdf->setXY(20,38);
$pdf->SetRightMargin(25.0);
$pdf->MultiCell(0,4,utf8_decode('PROVIDENCIA ADMINISTRATIVA'),0,'C');
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
$pdf->MultiCell(0,4,utf8_decode('Quien suscribe, Jesús Eduardo Tovar Jiménez, venezolano, mayor de edad, civilmente hábil, de este domicilio y titular de la cédula de identidad número V-1.740.259, procediendo en mi condición de Director General de Fiscalización, carácter que consta en Resolución suscrita por el Presidente del IVSS, signada DGRHAP-DAPDRC/10 Número 002093, de fecha 03 de Mayo de 2010 y en uso de las facultades y atribuciones delegadas mediante Providencia Administrativa número 010, de fecha 09 de Agosto de 2010, publicada en la Gaceta Oficial de la República Bolivariana de Venezuela Número 39.551, de fecha 12 de Noviembre del año 2010; por medio del presente acto, designo y autorizo a los Servidores Públicos, ciudadanos:  Ana María Higuera Arévalo, V-15.022.121; Carmen Luisa Bravo Muñoz, V- 14.394.714; Cecilio Enrique Zerpa López, V-13.574.202; Domingo José Ramirez Reyes, V-13.836.194; Eduardo José Morillo Alcalá,  V-18.129.838; Jesús Antonio Vasquez; V-15.586.467; Johana De La Trinidad Malavé, V-10.810.104; Karla Heleydenys María Origûen Gerdel, V-17.389.422; Luis Miguel Marquez Blanco, V-19.754.270; María Isabel Villa Salas,    V-14.287.554; Marialejandra Rodríguez Sosa, V-14.755.807; Marlene De La Cruz Márquez Gil, V-11.555.032; Patricia Del Valle Morales Quereigua, V-15.549.481; Pedro Alexander Alarcón Velasquez, V-16.381.443; Rafael Antonio Gintili Anderson, V-17.705.281, Sandra Milena Celis Soto, V-12.878.449; Sergio Esteban Inojosa Alcalá, V-6.499.959; Ronald Rafael Mora Briceño, V-14.680.782 y Yamileth Aixa Escalona, V-13.533.413; para que de conformidad a lo dispuesto en los artículos 182, 183, 184, 185 y 186 del Código Orgánico Tributario, verifiquen el oportuno cumplimiento de las Obligaciones establecidas en la Ley del Seguro Social, por parte de la sociedad mercantil XXXXXXXXXXXXXXXXXXXXXX inscrita en el IVSS bajo el número patronal XXXXXXXXXXXX,  entre ellas: Haberse inscrito oportunamente en el Instituto Venezolano de los Seguros Sociales, haber informado si fuere el caso sobre la cesación de actividades, cambios de razón social, traspaso del dominio a cualquier título, y en general, otras circunstancias relativas a las actividades de la empresa, establecimiento, explotación o faena; de igual modo verificar, si el citado empleador, cumplió con la obligación de inscribir a sus trabajadores dentro de los tres (3) días hábiles siguientes al de su ingreso al trabajo, para los trabajadores activos en el período comprendido desde el mes de Febrero 2015 hasta Abril 2015 así como el deber de notificar al Instituto el despido o retiro de los trabajadores dentro de los tres (3) días hábiles siguientes a aquel en el que se produzca tal hecho,  para el período comprendido desde el mes de Febrero 2015 hasta Abril 2015.'));

$pdf->setXY(20,145);
$pdf->MultiCell(0,4,utf8_decode('En atención a lo antes expuesto y de conformidad a lo instituido en el numeral 2 del artículo 90 de la Ley del Seguro Social, en concordancia con lo previsto en el artículo 183 del Reglamento General del Seguro Social, los Servidores Públicos antes identificados, podrán exigir al prenombrado empleador, toda la documentación necesaria para llevar a cabo la gestión encomendada a través de la presente Providencia Administrativa, siendo obligación de éste, presentarla de acuerdo a lo dispuesto en la Providencia Administrativa número 003, de fecha 20 de septiembre de 2011, publicada en la Gaceta Oficial de la República Bolivariana de Venezuela número 39.788, de fecha 28 de octubre de 2011 y en caso de incumplir con lo antes expuesto, se aplicaran las sanciones correspondientes. '));

$pdf->setXY(20,175);
$pdf->MultiCell(0,4,utf8_decode('Se emiten dos (2) ejemplares de un mismo tenor y a un sólo efecto, uno de los cuales quedará en poder del la precitada empresa, quién la firmará y en virtud de ello, quedará notificado de conformidad con lo establecido en los artículos 172, 175 y 178 del Código Orgánico Tributario.'));

$pdf->Text(25,215,utf8_decode('POR EL EMPLEADOR:'));
$pdf->Text(122,220,utf8_decode('FIRMA Y SELLO:'));

$pdf->Rect(20,216,50,7,'fill');
$pdf->Rect(70,216,50,7,'fill');
#$pdf->Rect(120,216,65,7,'fill');

$pdf->Rect(120,216,65,21,'fill');
$pdf->Rect(20,216,100,21,'fill');
#$pdf->Rect(102,216,78,10,'fill');

/*
$pdf->Rect(100,206,80,20,'fill');
$pdf->Rect(100,226,80,3,'fill');
$pdf->Rect(100,229,80,6,'fill');
$pdf->SetFont('Arial','',6);
$pdf->setTextColor('90','90','90');
$pdf->setDrawColor('178','178','178');
$pdf->Line(100.2,229,179.8,229);
$pdf->Text(138,228.4,utf8_decode('Firma'));
$pdf->SetFont('Arial','',7);
$pdf->Text(101,233,utf8_decode('Cédula de Identidad:'));*/
/*--------------------------------------- FIRMAS ----------------------------------------------*/
/*---------------------------------------------------------------------------------------------*/
/*--------------------------------------- PIE DE PÁGINA ----------------------------------------------*/
$pdf->setDrawColor('0','0','0');
$pdf->setTextColor('0','0','0');
$pdf->Line(20,260,185,260);
$pdf->setXY(20,263);
$pdf->MultiCell(0,0,utf8_decode('DIRECCION GENERAL DE FISCALIZACION'),0,'C');
$pdf->setXY(20,266);
$pdf->MultiCell(0,0,utf8_decode('Dirección: Av. Urdaneta Esquina de Veroes con Boulevard Panteón, Edificio Lecuna, al lado del Banco de Venezuela,'),0,'C');
$pdf->setXY(20,269);
$pdf->MultiCell(0,0,utf8_decode('Parroquia Altagracia, Municipio Libertador, Distrito Capital-Venezuela. Código Postal 1010.'),0,'C');
$pdf->setXY(20,272);
$pdf->MultiCell(0,0,utf8_decode('Teléfonos: 0212- 8635567- 8635716-8635429-8635161 (TELEFAX)'),0,'C');
$pdf->Output('Acta de Inicio de Procedimiento.pdf','I');
?>