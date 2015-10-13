<?php 

	require_once ('PHPExcel/PHPExcel.php');
	/*
	$objPHPExcel = new PHPExcel();
	// Set properties
	$objPHPExcel->getProperties()->setCreator("Jobin Jose");
	$objPHPExcel->getProperties()->setLastModifiedBy("Jobin Jose");
	$objPHPExcel->getProperties()->setTitle("Office 2007 XLSX Test Document");
	$objPHPExcel->getProperties()->setSubject("Office 2007 XLSX Test Document");
	$objPHPExcel->getProperties()->setDescription("Test document for Office 2007 XLSX, generated using PHPExcel classes.");
	// Add some data
	// echo date('H:i:s') . " Add some data\n";
	$objPHPExcel->setActiveSheetIndex(0);
	$objPHPExcel->getActiveSheet()->setTitle('Simple');
	$gdImage = imagecreatefromjpeg('PHPExcel/nombre.jpg');
	// Add a drawing to the worksheetecho date('H:i:s') . " Add a drawing to the worksheet\n";
	$objDrawing = new PHPExcel_Worksheet_MemoryDrawing();
	$objDrawing->setName('Sample image');
	$objDrawing->setDescription('Sample image');
	$objDrawing->setImageResource($gdImage);
	$objDrawing->setRenderingFunction(PHPExcel_Worksheet_MemoryDrawing::RENDERING_JPEG);
	$objDrawing->setMimeType(PHPExcel_Worksheet_MemoryDrawing::MIMETYPE_DEFAULT);
	$objDrawing->setHeight(150);
	$objDrawing->setCoordinates('C1');
	$objDrawing->setWorksheet($objPHPExcel->getActiveSheet());
	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');

	//guardar archivo excel en carpeta
	$objWriter->save(str_replace('.php', '.xlsx', __FILE__));
	
	// Echo done
	echo date('H:i:s') . " Done writing file.\r\n";
	*/

$excel = new PHPExcel();
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="your_name.xls"');
header('Cache-Control: max-age=0');

$excel->setActiveSheetIndex(0)
        ->setCellValue('A1', 'Hello')
        ->setCellValue('B2', 'world!')
        ->setCellValue('C1', 'Hello')
        ->setCellValue('D2', 'world!');

$objDrawing = new PHPExcel_Worksheet_Drawing();
$objDrawing->setName('Logo');
$objDrawing->setDescription('Logo');
$logo = 'PHPExcel/nombre.jpg'; // Provide path to your logo file
$objDrawing->setPath($logo);  //setOffsetY has no effect
$objDrawing->setCoordinates('E1');
$objDrawing->setHeight(200); // logo height
$objDrawing->setWorksheet($excel->getActiveSheet()); 

// Do your stuff here

$writer = PHPExcel_IOFactory::createWriter($excel, 'Excel5');

// This line will force the file to download
$writer->save('php://output');

 ?>