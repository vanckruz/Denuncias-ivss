<?php

	include('../librerias/fpdf/fpdf.php');
	include('../../resources/orcl_conex.php');

	$id_denuncia = "D-DGF-20150605-V018267865-001";	
	$pdf = new  FPDF('P');
	$conex = DataBase::getInstance();

	$consulta = "SELECT * FROM FISC_DENUNCIAS WHERE ID_DENUNCIA= '".$id_denuncia."'";
	$stid = oci_parse($conex, $consulta);

	if(!$stid)
	{
		echo "Error";
	}

	$r = oci_execute($stid);

	if(!$r)
	{
		echo "Error";
	}

	$resultado = oci_fetch_assoc($stid);
/*Segunda consulta*/
	$id_ciudadano ='V018267865';
	$consulta2 = "SELECT * FROM CIUDADANO WHERE ID_CIUDADANO= '".$id_ciudadano."'";
	$stid2 = oci_parse($conex, $consulta2);

	if(!$stid2)
	{
		echo "Error";
	}

	$r2 = oci_execute($stid2);

	if(!$r2)
	{
		echo "Error";
	}

	$resultado2 = oci_fetch_assoc($stid2);



	$pdf->AddPage();
	$pdf->SetTitle("Constancia de denuncia",true);
	$pdf->SetFont('Arial','B',14);
	$pdf->Text(80,30,'Planilla de denuncia');


	$pdf->AliasNbPages();
	$pdf->SetSubject("Planilla de denuncia");

	$pdf->Image('../../public_html/imagenes/banner_institucional.png',20,6,170);
	$pdf->Image('../../public_html/imagenes/logoclaro.png',40,50,120);

	$pdf->SetXY(10,100); 
	$pdf->SetFont('Arial','',10);


  $pdf->SetXY(20,40);  
  $pdf->SetTextColor(255,255,255); 
  $pdf->SetFillColor(18,4,155);
  $pdf->SetFillColor(35,65,129);
  $pdf->SetFont('Arial','B',9);
  $pdf->Cell(170,7,utf8_decode('Datos del Trabajador'),1, 0 , 'C' , true);
  $pdf->Ln();


 $pdf->SetXY(20,47);  
 $pdf->SetTextColor(0,0,0);
 $pdf->SetFillColor(255,255,255,false);
 $pdf->Cell(40,7,utf8_decode('Cédula'),1, 0 , 'C' , false);   
 $pdf->Cell(65,7,utf8_decode('Nombres'),1, 0 , 'C' , false);  
 $pdf->Cell(65,7,utf8_decode('Apellidos'),1, 0 , 'C' , false); 
 $pdf->Ln();

 /*Fila de los datos*/
$pdf->SetXY(20,54);
$pdf->SetFont('Arial','',10);
$pdf->Cell(40,7,utf8_decode($resultado['ID_CIUDADANO']),1, 0 , 'C' , false);   
$pdf->Cell(65,7,utf8_decode(ucfirst(strtolower($resultado2['PRIMER_NOMBRE']))." ".ucfirst(strtolower($resultado2['SEGUNDO_NOMBRE']))),1, 0 , 'C' , false);  
$pdf->Cell(65,7,utf8_decode(ucfirst(strtolower($resultado2['PRIMER_APELLIDO']))." ".ucfirst(strtolower($resultado2['SEGUNDO_APELLIDO']))),1, 0 , 'C' , false); 
$pdf->Ln();
 /*Fila de los datos*/

$pdf->SetXY(20,61); 
$pdf->SetFont('Arial','B',9);
$pdf->Cell(40,7,utf8_decode('Tel. de Habitación'),1, 0 , 'C' , false);   
$pdf->Cell(65,7,utf8_decode('Tel. Móvil'),1, 0 , 'C' , false);  
$pdf->Cell(65,7,utf8_decode('Correo Electrónico'),1, 0 , 'C' , false); 
$pdf->Ln();

 /*Fila de los datos*/
$pdf->SetXY(20,68);
$pdf->SetFont('Arial','',9);
$pdf->Cell(40,7,utf8_decode('02125487895'),1, 0 , 'C' , false);   
$pdf->Cell(65,7,utf8_decode('04148575292'),1, 0 , 'C' , false);  
$pdf->Cell(65,7,utf8_decode('arredondopedro87@gmail.com'),1, 0 , 'C' , false); 
$pdf->Ln();
/*Fila de los datos*/

$pdf->SetXY(20,75);
$pdf->SetFont('Arial','B',9);
$pdf->Cell(40,7,utf8_decode('Dirección'),1, 0 , 'C' , false);
$pdf->SetFont('Arial','',9);
$pdf->Cell(130,7,utf8_decode('Miranda Sucre Petare La Urbina Residencias Antonieta Apto 1B'),1, 0 , 'C' , false);
$pdf->Ln();


$pdf->SetXY(20,82);
$pdf->SetTextColor(255,255,255); 
$pdf->SetFillColor(18,4,155);
$pdf->SetFillColor(35,65,129);
$pdf->SetFont('Arial','B',9);
$pdf->Cell(170,7,utf8_decode('Datos de la Empresa'),1, 0 , 'C' , true);
$pdf->Ln();

$pdf->SetXY(20,89); 
$pdf->SetTextColor(0,0,0); 
$pdf->SetFillColor(255,255,255);
$pdf->SetFont('Arial','B',9);
$pdf->Cell(40,7,utf8_decode('Razón Social'),1, 0 , 'C' , false);   
$pdf->Cell(65,7,utf8_decode('Rif'),1, 0 , 'C' , false);  
$pdf->Cell(65,7,utf8_decode('N° Patronal'),1, 0 , 'C' , false); 
$pdf->Ln();

 /*Fila de los datos*/
$pdf->SetXY(20,96);
$pdf->SetFont('Arial','',9);
$pdf->Cell(40,7,utf8_decode('Empresas Polar'),1, 0 , 'C' , false);   
$pdf->Cell(65,7,utf8_decode('J000244889'),1, 0 , 'C' , false);  
$pdf->Cell(65,7,utf8_decode('D00456979'),1, 0 , 'C' , false); 
$pdf->Ln();
/*Fila de los datos*/

$pdf->SetXY(20,103);
$pdf->SetFont('Arial','B',9);
$pdf->Cell(40,7,utf8_decode('Teléfono de la empresa'),1, 0 , 'C' , false);   
$pdf->Cell(65,7,utf8_decode('Correo Electrónico'),1, 0 , 'C' , false);  
$pdf->Cell(65,7,utf8_decode('Punto de referencia'),1, 0 , 'C' , false); 
$pdf->Ln();

 /*Fila de los datos*/
$pdf->SetXY(20,110);
$pdf->SetFont('Arial','',9);
$pdf->Cell(40,7,utf8_decode('02121234567'),1, 0 , 'C' , false);   
$pdf->Cell(65,7,utf8_decode('polar@polar.com'),1, 0 , 'C' , false);  
$pdf->Cell(65,7,utf8_decode('Frente a la mata de platano'),1, 0 , 'C' , false); 
$pdf->Ln();
/*Fila de los datos*/

$pdf->SetXY(20,117);
$pdf->SetFont('Arial','B',9);
$pdf->Cell(40,7,utf8_decode('Dirección'),1, 0 , 'C' , false);
$pdf->SetFont('Arial','',9);
$pdf->Cell(130,7,utf8_decode('Miranda Sucre Petare La Urbina Residencias Antonieta Apto 1B'),1, 0 , 'C' , false);
$pdf->Ln();


$pdf->SetXY(20,124);
$pdf->SetTextColor(255,255,255); 
$pdf->SetFillColor(18,4,155);
$pdf->SetFillColor(35,65,129);
$pdf->SetFont('Arial','B',9);
$pdf->Cell(170,7,utf8_decode('Datos de la Denuncia'),1, 0 , 'C' , true);
$pdf->Ln();

$pdf->SetXY(20,131);
$pdf->SetTextColor(0,0,0); 
$pdf->SetFillColor(255,255,255);
$pdf->SetFont('Arial','B',9);
$pdf->Cell(40,7,utf8_decode('Fecha'),1, 0 , 'C' , false);   
$pdf->Cell(65,7,utf8_decode('N° de Denuncia'),1, 0 , 'C' , false);  
$pdf->Cell(65,7,utf8_decode('Estatus'),1, 0 , 'C' , false); 
$pdf->Ln();

 /*Fila de los datos*/
$pdf->SetXY(20,138);
$pdf->SetFont('Arial','',9);
$pdf->Cell(40,7,utf8_decode('08/06/15'),1, 0 , 'C' , false);   
$pdf->Cell(65,7,utf8_decode('D-DGF-20150608-V018934411-001'),1, 0 , 'C' , false);  
$pdf->Cell(65,7,utf8_decode('En proceso'),1, 0 , 'C' , false); 
$pdf->Ln();
/*Fila de los datos*/

$pdf->SetXY(20,145);
$pdf->SetFont('Arial','B',9);
$pdf->Cell(40,7,utf8_decode('Motivo'),1, 0 , 'C' , false);
$pdf->SetFont('Arial','',9);
$pdf->Cell(130,7,utf8_decode('Cotizaciones no reportadas por el Empleador en el IVSS.'),1, 0 , 'C' , false);
$pdf->Ln();

$pdf->SetXY(20,152);
$pdf->SetFont('Arial','B',9);
$pdf->Cell(40,7,utf8_decode('Descripción'),1, 0 , 'C' , false);
$pdf->SetFont('Arial','',9);
$pdf->Cell(130,7,utf8_decode('Cotizaciones no reportadas por el Empleador en el IVSS.'),1, 0 , 'C' , false);
$pdf->Ln();



/*tabla fin*/


$pdf->Text(75,268,utf8_decode("Documento generado en fecha ".date('d-m-Y')) );
$pdf->Output('detalle_denuncia','I');
?>