<?php
	require_once ('jpgraph/src/jpgraph.php');
	require_once ('jpgraph/src/jpgraph_bar.php');
	require_once ('PHPExcel/PHPExcel.php');





	// Se define el array de datos
/*$datosy=array(25,16,24,5,8,31);
 
// Creamos el grafico
$grafico = new Graph(500,250);
$grafico->SetScale('textlin');
 
// Ajustamos los margenes del grafico-----    (left,right,top,bottom)
$grafico->SetMargin(40,30,30,40);
 
// Creamos barras de datos a partir del array de datos
$bplot = new BarPlot($datosy);
 
// Configuramos color de las barras
$bplot->SetFillColor('#479CC9');

//Añadimos barra de datos al grafico
$grafico->Add($bplot);
 
// Queremos mostrar el valor numerico de la barra
$bplot->value->Show();
 
// Configuracion de los titulos
$grafico->title->Set('Mi primer grafico de barras');
$grafico->xaxis->title->Set('Titulo eje X');
$grafico->yaxis->title->Set('Titulo eje Y');
 
$grafico->title->SetFont(FF_FONT1,FS_BOLD);
$grafico->yaxis->title->SetFont(FF_FONT1,FS_BOLD);
$grafico->xaxis->title->SetFont(FF_FONT1,FS_BOLD);
 
// Se muestra el grafico
$grafico->Stroke();*/

	// Some random data to plot
	/*$datay=array(12,26,9,17,31,8,9);

	// Create the graph.
	$graph = new Graph(440,440,'auto');
	$graph->SetScale("textlin");

	// Create a bar pot
	$bplot = new BarPlot($datay);

	// Create targets for the image maps so that the details are o*****d in a separate window
	$fmtStr = "javascript:window.open('barcsim_details.php?id=%d ','_new','width=500,height=300');void(0)";
	$n = count($datay);
	$targ=array();
	$alts=array();
	for($i=0; $i < $n; ++$i) {
	$targ[$i] = sprintf($fmtStr,$i+1);
	$alts[$i] = 'val=%d';
	// Note: The format placeholder val=%d will be replaced by the actual value in the ouput HTML by the
	// library so that when the user hoovers the mouse over the bar the actual numerical value of the bar
	// will be dísplayed
	}
	$bplot->SetCSIMTargets($targ,$alts);

	// Add plot to graph
	$graph->Add($bplot);

	// Setup the title, also wih a CSIM area
	$graph->title->Set("CSIM with popup windows");
	$graph->title->SetFont(FF_FONT2,FS_BOLD);
	// Assume we can give more details on the graph
	$graph->title->SetCSIMTarget(sprintf($fmtStr,-1),'Title for Bar');

	// Send back the HTML page which will call this script again to retrieve the image.
	$graph->StrokeCSIM();*/


	// Se define el array de datos
	/*$datosy=array(28,16,24,8);
	$datosz=array(10,16,21,5);

	// Creamos el grafico
	//ancho x,y
	$grafico = new Graph(600,400);
	$grafico->SetScale('textlin');

	// Ajustamos los margenes del grafico-----    (left,right,top,bottom)
	$grafico->SetMargin(40,30,30,40);

	//Asigna el titulo al grafico 
	$grafico->title->Set("Resumen Anual de Denuncias - ".date("Y"));

	//Asigna el titulo al eje x
	$grafico->xaxis->SetTitle("Meses");

	//Asigna el titulo y alineacion al eje y
	$grafico->yaxis->SetTitle("Resumen","middle");

	//Asigna las etiquetas para los valores del eje x
	$grafico->xaxis->SetTickLabels(array("Mes1","Mes1","Mes1","Mes1"));

	// Creamos barras de datos a partir del array de datos
	$bplot = new BarPlot($datosy);
	// Configuramos color de las barras
	$bplot->SetFillColor('#479CC9');
	$bplot->SetLegend("datosy");

	// Creamos barras de datos a partir del array de datos
	$bplotz = new BarPlot($datosz);
	// Configuramos color de las barras
	$bplotz->SetFillColor('#479CC9');
	//Añadimos barra de datos al grafico
	//$grafico->Add($bplotz);
	// Queremos mostrar el valor numerico de la barra
	$bplotz->SetLegend("datosz");

	// agrupa las series del grafico
	$todos = new GroupBarPlot(array($bplot,$bplotz));

	//agrega al grafico el grupo de series
	$grafico->Add($todos);

	// Queremos mostrar el valor numerico de la barra
	$bplot->value->Show();
	$bplotz->value->Show();

	$grafico->Stroke();
	//$grafico->Stroke("PHPExcel/nombre.jpg");
	
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
	$objDrawing->setName('PHPExcel/nombre.jpg');
	$objDrawing->setDescription('Logo');
	$logo = 'PHPExcel/nombre.jpg'; // Provide path to your logo file
	$objDrawing->setPath($logo);  //setOffsetY has no effect
	$objDrawing->setCoordinates('E12');
	$objDrawing->setHeight(200); // logo height
	$objDrawing->setWorksheet($excel->getActiveSheet()); 

	// Do your stuff here

	$writer = PHPExcel_IOFactory::createWriter($excel, 'Excel5');

	// This line will force the file to download
	$writer->save('php://output');*/


require_once ('jpgraph/src/jpgraph.php');
require_once ('jpgraph/src/jpgraph_bar.php');

$grafica = new Graph(300, 200);

// Ajustamos los margenes del grafico-----    (left,right,top,bottom)
$grafica->img->SetMargin(50,40,20,0);

//aqui sacar el count y colocarlo en el segundo parametro
$grafica->SetScale("textlin", 5, 10);

//Asigna el titulo al grafico 
$grafica->title->Set("Resumen Anual - ".date("Y"));

//Asigna el titulo al eje x
$grafica->xaxis->SetTitle("Alumnos");

//Asigna el titulo y alineacion al eje y
$grafica->yaxis->SetTitle("Calificaciones","middle");

//Asigna las etiquetas para los valores del eje x
$grafica->xaxis->SetTickLabels(array("Ana","Sonia","Sebastian","Joel"));

//crea una serie para un grafico de barras
$fisica = new BarPlot(array(9,8));


//asigna la leyenda para la serie fisica
$fisica->SetLegend("Fisica");

//asigna el color de relleno de las barras en formato hexadecimal
$fisica->SetFillColor("#E234A9");

//crea una serie para el grafico de barras
$matematicas = new BarPlot(array(8,7));

//asigna la leyenda para la serie matematicas
$matematicas->SetLegend("Matematicas");

//asigna el color de relleno de las barras con el nombre del color
$matematicas->SetFillColor("blue");

// agrupa las series del grafico
$materias = new GroupBarPlot(array($fisica,$matematicas));

//agrega al grafico el grupo de series
$grafica->Add($materias);

//muestra el grafico
$grafica->Stroke();


/*require_once ("jpgraph/src/jpgraph.php");
require_once ("jpgraph/src/jpgraph_pie.php");
 
// Se define el array de valores y el array de la leyenda
$datos = array(40,60,21,33);
$leyenda = array("Morenas","Rubias","Pelirrojas","Otras");
 
//Se define el grafico
$grafico = new PieGraph(450,300);
 
//Definimos el titulo
$grafico->title->Set("Mi primer grafico de tarta");
$grafico->title->SetFont(FF_FONT1,FS_BOLD,25);

 
//Añadimos el titulo y la leyenda
$p1 = new PiePlot($datos);
$p1->SetLegends($leyenda);
$p1->value->SetColor("white");
$p1->SetCenter(0.4);
 
//Se muestra el grafico
$grafico->Add($p1);
$grafico->Stroke();*/

/*
include ("jpgraph/src/jpgraph.php"); 
include ("jpgraph/src/jpgraph_pie.php"); 
include ("jpgraph/src/jpgraph_pie3d.php"); 

$data = array(40,60,21,33); 

$graph = new PieGraph(450,200,"auto"); 
$graph->img->SetAntiAliasing(); 

//$graph->SetMarginColor('gray'); 
//$graph->SetShadow(); 

// Setup margin and titles 
$graph->title->Set("Ejemplo: Horas de Trabajo"); 

$p1 = new PiePlot3D($data); 
$p1->SetSize(0.35); 
$p1->SetCenter(0.5); 

// Setup slice labels and move them into the plot 
$p1->value->SetFont(FF_FONT1,FS_BOLD); 
$p1->value->SetColor("black"); 
$p1->SetLabelPos(0.2); 

$nombres=array("pepe","luis","miguel","alberto"); 
$p1->SetLegends($nombres); 

// Explode all slices 
$p1->ExplodeAll(); 

$graph->Add($p1); 
$graph->Stroke(); 
*/


?>
