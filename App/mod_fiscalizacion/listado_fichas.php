<?php 
/*
$zip = new ZipArchive();
$filename = "./test112.zip";

if ($zip->open($filename, ZipArchive::CREATE)!==TRUE) {
	exit("cannot open <$filename>\n");
}

$zip->addFromString("testfilephp.txt" . time(), "#1 Esto es una cadena de prueba añadida como  testfilephp.txt.\n");
$zip->addFromString("testfilephp2.txt" . time(), "#2 Esto es una cadena de prueba añadida como testfilephp2.txt.\n");
$zip->addFile($thisdir . "/too.php","/testfromfile.php");
echo "numficheros: " . $zip->numFiles . "\n";
echo "estado:" . $zip->status . "\n";
$zip->close();
echo 9;
*/
ini_set("session.auto_start", 0);
error_reporting(E_ALL);
ini_set("display_errors", 1);
include('../librerias/fpdf/fpdf.php');

function generarPdf()
{


	$pdf = new  FPDF('P');
	$pdf->AddPage();
	$pdf->Image('../../public_html/imagenes/logoclaro.png',40,50,120);
	$pdf->SetTitle("Notificación al denunciante",true);
	$pdf->Image('../../public_html/imagenes/logoivss.png',20,7,13);
	$pdf->SetFont('Arial','',6);
		//$pdf->Text(40,10,utf8_decode('hola'));

	//$nombre = "Prob".date('m-d-Y').".pdf";
	$pdf->Output("archivos/actas/Prob.pdf",'F');
}

for ($i=0; $i <=10; $i++) { 
	generarPdf();
}		
?>