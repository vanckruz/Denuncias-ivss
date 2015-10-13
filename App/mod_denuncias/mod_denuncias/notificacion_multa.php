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
/*------------------------------------ NUMERO FORMA -------------------------------------------*/
/*$pdf->SetFont('Arial','B',8);
$pdf->setXY(180,10);
$pdf->MultiCell(0,0,utf8_decode('Pág. 1'));*/
/*------------------------------------ NUMERO FORMA -------------------------------------------*/
/*---------------------------------------------------------------------------------------------*/
/*-------------------------------- NUMERO DEL DOCUMENTO ---------------------------------------*/
$pdf->SetFont('Arial','B',10);
$pdf->setXY(20,30);
$pdf->MultiCell(0,0,utf8_decode('N°: OAPOZ-N-DGF-2015-_____________'));
/*-------------------------------- NUMERO DEL DOCUMENTO ---------------------------------------*/
/*---------------------------------------------------------------------------------------------*/
/*--------------------------------------- FECHA -----------------------------------------------*/
$pdf->SetFont('Arial','B',8);
$pdf->setXY(102,40);
$pdf->MultiCell(0,0,utf8_decode('_____________________, ____ de __________________ del 2015.'));
/*--------------------------------------- FECHA ------------------------------------------------*/
/*----------------------------------------------------------------------------------------------*/
/*----------------------------------- CUADRO SUPERIOR  -----------------------------------------*/
$pdf->SetXY(20,50);
$pdf->MultiCell(26,5,utf8_decode('Razon Social'),1,'L',0);
$pdf->Rect(46,50,145,5,'D');
$pdf->SetXY(20,55);
$pdf->MultiCell(26,5,utf8_decode('RIF'),1,'L',0);
$pdf->Rect(46,55,145,5,'D');
$pdf->SetXY(20,60);
$pdf->MultiCell(26,5,utf8_decode('Numero Patronal'),1,'L',0);
$pdf->Rect(46,60,145,5,'D');
$pdf->SetXY(20,65);
$pdf->MultiCell(26,5,utf8_decode('Dirección'),1,'L',0);
$pdf->Rect(46,65,145,5,'D');

/*----------------------------------- CUADRO SUPERIOR  -----------------------------------------*/
/*----------------------------------------------------------------------------------------------*/
/*-------------------------------- TITULO DEL DOCUMENTO ----------------------------------------*/
$pdf->SetFont('Arial','B',10);
$pdf->setXY(20,75);
$pdf->SetRightMargin(25.0);
$pdf->MultiCell(0,4,utf8_decode('NOTIFICACIÓN DE MULTA'),0,'C');
/*-------------------------------- TITULO DEL DOCUMENTO ---------------------------------------*/
/*---------------------------------------------------------------------------------------------*/
/*-------------------------------- CUERPO DEL DOCUMENTO----------------------------------------*/
$pdf->setXY(20,85);
$pdf->SetFont('Arial','','8');
$pdf->MultiCell(0,4,utf8_decode('Quien suscribe, Roselia Uzcategui Pérez, venezolana, mayor de edad, de este domicilio, titular de la cédula de identidad número V-14.346.592, procediendo en este acto en mi carácter de Jefe de Oficina Administrativa Puerto Ordaz del Instituto Venezolano de los Seguros Sociales, Instituto Autónomo con personalidad jurídica y patrimonio propio e independiente de la Nación, creado por la Ley del Seguro Social Obligatorio, publicada en la Gaceta Oficial Extraordinaria de los Estados Unidos de Venezuela, el 24 de julio de 1940, adoptada su actual denominación según Decreto Número 239, publicado en la Gaceta Oficial de los Estados Unidos de Venezuela Número 21.978, el día 06 de abril de 1946, carácter que consta en Resolución distinguida con las siglas DGRHYAP-DAPRC/10 Nº 00361, de fecha 12 de Enero de 2010,  suscrita por el Presidente del IVSS; por medio de la presente hago de su conocimiento, que esta Oficina Administrativa, mediante Decisión de Multa por Incumplimiento de Obligaciones con el Instituto Venezolano de los Seguros Sociales, signada con N°: OAPOZ-D-DGF-2015-________, de fecha __ de _______________ del 2015; impuso al empleador: ____________________________________ identificado con el Registro de Información Fiscal (RIF), Número: _____________________, e inscrito en el IVSS, bajo el Número Patronal: _______________,  las siguientes sanciones:'));

//--------------------------------------         a
$pdf->setXY(20,135);
$pdf->SetFont('Arial','B','8');
$pdf->MultiCell(0,4,utf8_decode(('a.')));
$pdf->setXY(25,135);
$pdf->SetFont('Arial','','8');
$pdf->MultiCell(0,4,utf8_decode('Por incurrir en la Infracción Leve, según se detalla en el aparte _____ de la sección _______ de la Decisión de Multa signada con N°: OAPOZ-D-DGF-2015-___________, de fecha _____ de _________________ de 2015, por la cantidad de: ____________________ BOLÍVARES CON CERO CÉNTIMOS (Bs. _________,00).'));
//--------------------------------------         b
$pdf->setXY(20,150);
$pdf->SetFont('Arial','B','8');
$pdf->MultiCell(0,4,utf8_decode(('b.')));
$pdf->setXY(25,150);
$pdf->SetFont('Arial','','8');
$pdf->MultiCell(0,4,utf8_decode('Por incurrir en la Infracción Grave, contenida en el numeral 1 del literal B del artículo 86 de la Ley del Seguro Social y de conformidad con lo previsto en el artículo 87 numeral 2 ejusdem, se impone multa equivalente a CINCUENTA UNIDADES TRIBUTARIAS (50 U.T.), cada una a razón del valor previsto al momento de cometer la señalada infracción administrativa, en el presente caso, la cantidad de Bs. ________,00, para un total de: ____________________ BOLÍVARES CON CERO CÉNTIMOS (Bs. _________,00).'));
//--------------------------------------         c
$pdf->setXY(20,173);
$pdf->SetFont('Arial','B','8');
$pdf->MultiCell(0,4,utf8_decode(('c.')));
$pdf->setXY(25,173);
$pdf->SetFont('Arial','','8');
$pdf->MultiCell(0,4,utf8_decode('Por incurrir en la Infracción Grave, contenida en el numeral 2 del literal B del artículo 86 de la Ley del Seguro Social y de conformidad con lo previsto en el artículo 87 numeral 2 ejusdem, se impone multa equivalente a CINCUENTA UNIDADES TRIBUTARIAS (50 U.T.), cada una a razón del valor previsto al momento de cometer la señalada infracción administrativa, en el presente caso, la cantidad de Bs. ________,00, para un total de: ____________________ BOLÍVARES CON CERO CÉNTIMOS (Bs. _________,00).'));
//-------------------------------------         d
$pdf->setXY(20,196);
$pdf->SetFont('Arial','B','8');
$pdf->MultiCell(0,4,utf8_decode(('d.')));
$pdf->setXY(25,196);
$pdf->SetFont('Arial','','8');
$pdf->MultiCell(0,4,utf8_decode('Por incurrir en la Infracción Grave, según se detalla en el aparte _____ de la sección ______ de la Decisión de Multa signada con N°: OAPOZ-D-DGF-2015-___________, de fecha _____ de _________________ de 2015, por la cantidad de: ____________________ BOLÍVARES CON CERO CÉNTIMOS (Bs. _________,00).'));
//-------------------------------------         e
$pdf->setXY(20,210);
$pdf->SetFont('Arial','B','8');
$pdf->MultiCell(0,4,utf8_decode(('e.')));
$pdf->setXY(25,210);
$pdf->SetFont('Arial','','8');
$pdf->MultiCell(0,4,utf8_decode('Por incurrir en la Infracción Muy Grave, contenida en el numeral 2 del literal C del artículo 86 de la Ley del Seguro Social y de conformidad con lo previsto en el artículo 87 numeral 3 ejusdem, se impone multa equivalente a  CIEN  UNIDADES  TRIBUTARIAS (100 U.T.), cada una a razón del valor previsto al momento de cometer la señalada infracción administrativa, en el presente caso, la cantidad de Bs. ________,00, para un total de: ____________________ BOLÍVARES CON CERO CÉNTIMOS (Bs. _________,00).'));

//------------------------------------           f
$pdf->setXY(20,233);
$pdf->SetFont('Arial','B','8');
$pdf->MultiCell(0,4,utf8_decode(('f.')));
$pdf->setXY(25,233);
$pdf->SetFont('Arial','','8');
$pdf->MultiCell(0,4,utf8_decode('Por incurrir en la Infracción Muy Grave, contenida en el numeral 3 del literal C del artículo 86 de la Ley del Seguro Social y de conformidad con lo previsto en el artículo 87 numeral 3 ejusdem, se impone multa equivalente a  CIEN  UNIDADES  TRIBUTARIAS (100 U.T.), cada una a razón del valor previsto al momento de cometer la señalada infracción administrativa, en el presente caso, la cantidad de Bs. ________,00, para un total de: ____________________ BOLÍVARES CON CERO CÉNTIMOS (Bs. _________,00).'));

//-----------------------------------

$pdf->setXY(20,258);
$pdf->MultiCell(0,4,utf8_decode('En consecuencia, esta Autoridad Administrativa, emplaza al empleador _______________________________________, para que dentro del plazo de Quince (15) días hábiles siguientes, contados a partir de la presente notificación, proceda a pagar al Instituto Venezolano de los Seguros Sociales (IVSS), la cantidad de:'));
//-------------------------------- CUADRO DE MONTO TOTAL DE MULTA
$pdf->setXY(35,276);
$pdf->MultiCell(70,5,utf8_decode('MONTO TOTAL DE LA MULTA'),1,'C');
$pdf->setXY(105,276);
$pdf->MultiCell(70,5,utf8_decode('Bs._____________,00'),1,'C');	
$pdf->setXY(35,281);
$pdf->MultiCell(140,5,utf8_decode('Cantidad:  ______________________________ BOLÍVARES CON CERO CÉNTIMOS'),1,'C');

$pdf->setXY(20,292);
$pdf->MultiCell(0,4,utf8_decode('Por último, en caso de considerar que la presente Decisión Administrativa, lesiona sus derechos subjetivos o intereses legítimos, personales y directos, podrá de conformidad con el numeral 3 del artículo 90 de la Ley del Seguro Social, recurrir de la misma ante la Junta Directiva del Instituto Venezolano de los Seguros Sociales, dentro del lapso de quince (15) días hábiles siguientes contados a partir de la presente notificación.'));

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
/*------------------------------------------------------------------------------------------------------*/
/* -------------------------------------- PAGINA 2 -------------------------------------------------*/
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
$pdf->SetXY(20,30);
$pdf->MultiCell(0,4,utf8_decode('En ___________________, ____ de _______________ de 2015, se hacen dos (2) ejemplares de un mismo tenor y a un sólo efecto.'));
$pdf->SetXY(20,36);
$pdf->MultiCell(0,4,utf8_decode('Sírvase firmar y fechar copia de la presente.'));
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
/*------------------------------------------------------------------------------------------------------*/
/*--------------------------------------- FIRMAS ----------------------------------------------*/
/*---------------- Servidor Público Actuante --------------------*/
$pdf->SetFillColor(35,65,129);
$pdf->setTextColor('255','255','255');
$pdf->SetXY(50,50);
$pdf->SetFont('Arial','',8);
$pdf->MultiCell(105,6,utf8_decode('JEFE DE LA OFICINA ADMINISTRATIVA'),1,'C',1);
$pdf->SetFont('Arial','',7);
$pdf->setTextColor('0','0','0');
$pdf->SetFont('Arial','',7);
$pdf->Text(51,59,utf8_decode('Firma y Sello'));
$pdf->Rect(50,56,105,32,'D');
$pdf->SetFont('Arial','B',7);
$pdf->Text(85,84,utf8_decode('ROSELIA UZCATEGUI PÉREZ'));
$pdf->SetFont('Arial','',7);
$pdf->Text(53,87,utf8_decode('Según Resolución  siglas DGRHYAP-DAPRC/10 Nº 00361, de fecha 12 de Enero de 2010'));
$pdf->Rect(50,88,105,4,'D');
$pdf->SetFont('Arial','B',7);
$pdf->Text(81,91,utf8_decode('Cédula de Identidad Nº:'));
$pdf->SetFont('Arial','',7);
$pdf->Text(110,91,utf8_decode('V-14.346.592'));
/*----------------  El Empleador --------------------*/
$pdf->SetFillColor(35,65,129);
$pdf->setDrawColor('0','0','0');
$pdf->setTextColor('255','255','255');
$pdf->SetFont('Arial','',8);
$pdf->SetXY(20,100);
$pdf->MultiCell(78,6,utf8_decode('EL EMPLEADOR'),1,'C',1);
$pdf->setTextColor('0','0','0');

$pdf->SetFont('Arial','',7);
$pdf->Rect(20,106,78,10,'D');
$pdf->Text(21,108.6,utf8_decode('Nombres y Apellidos:'));
$pdf->setDrawColor('178','178','178');
$pdf->Line(20.2,109.3,97.8,109.3);
$pdf->setDrawColor('0','0','0');
$pdf->Rect(67,106,31,10,'D');
$pdf->Text(68,108.6,utf8_decode('Cédula de Identidad:'));

$pdf->Rect(20,116,78,10,'D');
$pdf->Text(21,118.6,utf8_decode('Cargo:'));
$pdf->setDrawColor('178','178','178');
$pdf->Line(20.2,119.3,97.8,119.3);
$pdf->setDrawColor('0','0','0');

$pdf->Rect(20,126,78,10,'D');
$pdf->Text(21,128.6,utf8_decode('Fecha:'));
$pdf->setDrawColor('178','178','178');
$pdf->Line(20.2,129.3,97.8,129.3);
$pdf->setDrawColor('0','0','0');
$pdf->Rect(67,126,31,10,'D');
$pdf->Text(68,128.6,utf8_decode('Teléfonos de Contacto:'));

$pdf->Rect(20,136,78,15,'D');
$pdf->Text(21,138.6,utf8_decode('Firma y Sello:'));
$pdf->setDrawColor('178','178','178');
$pdf->Line(20.2,139.3,97.8,139.3);
$pdf->setDrawColor('0','0','0');

/*---------------- Servidor Publico Actuante --------------------*/
$pdf->SetFillColor(35,65,129);
$pdf->setDrawColor('0','0','0');
$pdf->setTextColor('255','255','255');
$pdf->SetXY(112,100);
$pdf->SetFont('Arial','',8);
$pdf->MultiCell(78,6,utf8_decode('SERVIDOR PUBLICO ACTUANTE'),1,'C',1);
$pdf->setTextColor('0','0','0');

$pdf->SetFont('Arial','',7);
$pdf->Rect(112,106,78,10,'D');
$pdf->Text(113,108.6,utf8_decode('Nombres y Apellidos:'));
$pdf->setDrawColor('178','178','178');
$pdf->Line(112.2,109.3,189.8,109.3);
$pdf->setDrawColor('0','0','0');
$pdf->Rect(159,106,31,10,'D');
$pdf->Text(160,108.6,utf8_decode('Cédula de Identidad:'));

$pdf->Rect(112,116,78,10,'D');
$pdf->Text(113,118.6,utf8_decode('Cargo:'));
$pdf->SetFont('Arial','B',7);
$pdf->Text(113,123.6,utf8_decode('Supervisor de Inspección de Seguridad Social'));
$pdf->SetFont('Arial','',7);
$pdf->setDrawColor('178','178','178');
$pdf->Line(112.2,119.3,189.8,119.3);
$pdf->setDrawColor('0','0','0');

$pdf->Rect(112,126,78,10,'D');
$pdf->Text(113,128.6,utf8_decode('Fecha:'));
$pdf->setDrawColor('178','178','178');
$pdf->Line(112.2,129.3,189.8,129.3);
$pdf->setDrawColor('0','0','0');
//$pdf->Rect(159,126,31,10,'D');
//$pdf->Text(160,128.6,utf8_decode('Teléfonos de Contacto:'));

$pdf->Rect(112,136,78,15,'D');
$pdf->Text(113,138.6,utf8_decode('Firma:'));
$pdf->setDrawColor('178','178','178');
$pdf->Line(112.2,139.3,189.8,139.3);
$pdf->setDrawColor('0','0','0');
/*----------------------------------------- FIRMAS ---------------------------------------------------*/
/*--------------------------------------- OUTPUT  -----------------------------------------------------*/
$pdf->Output('Notificacion de Multa.pdf','I');
?>