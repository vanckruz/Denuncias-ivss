<?php 
//phpinfo();

/*lineplot*/
include ("jpgraph/src/jpgraph.php");
include ("jpgraph/src/jpgraph_line.php");

#$ydata = array(11.5,3,8,12,5,1,9,13,5,7);
$ydata = array(0,7,9,12,15,21,19,13,5,7);
// Create the graph. These two calls are always required
$graph = new Graph(800,600,"auto");
$graph->SetScale("textlin");
$graph->img->SetAntiAliasing();
$graph->xgrid->Show();

// Create the linear plot
$lineplot=new LinePlot($ydata);
$lineplot->SetColor("black");
$lineplot->SetWeight(2);
$lineplot->SetLegend("Salario");

// Setup margin and titles
$graph->img->SetMargin(40,20,20,40);
$graph->title->Set("Ejemplo: Horas de Trabajo"); //título del gráfico
$graph->xaxis->title->Set("Salario"); //eje X
$graph->yaxis->title->Set("Horas de Trabajo");// EJe Y
$graph->ygrid->SetFill(true,'#EFEFEF@0.5','#F9BB64@0.5');
//$graph->SetShadow();

// Add the plot to the graph
$graph->Add($lineplot);

// Display the graph
$graph->Stroke();


/*torta*/
include ("jpgraph/src/jpgraph.php");
require_once ("jpgraph/src/jpgraph_pie.php");

// Se define el array de valores y el array de la leyenda
$datos = array(40,60,21,33);
$leyenda = array("Morenas","Rubias","Pelirrojas","Otras");

//Se define el grafico
$grafico = new PieGraph(450,300);

//Definimos el titulo
$grafico->title->Set("Mi primer grafico de tarta");
$grafico->title->SetFont(FF_FONT1,FS_BOLD);

//Añadimos el titulo y la leyenda
$p1 = new PiePlot($datos);
$p1->SetLegends($leyenda);
$p1->SetCenter(0.4);

//Se muestra el grafico
$grafico->Add($p1);
$grafico->Stroke();



/*barra*/
include ("jpgraph/src/jpgraph.php");
require_once ("jpgraph/src/jpgraph_bar.php");

$grafica = new Graph(500, 400);
$grafica->img->SetMargin(50,40,20,0);

/*Define el tipo de escala que va a utilizar y el
valor minimo y maximo para el eje y*/
$grafica->SetScale("textlin", 0, 60);

// Asigna el titulo de la gráfica
$grafica->title->Set("Estadísticas del tiempo");

// Asigna el titulo y la alineacion para el eje x
$grafica->xaxis->SetTitle("Dias","middle");

//Asigna el titulo y la alineacion para el eje y
$grafica->yaxis->SetTitle("Grados centigrados","middle");

//Define una serie, en este caso para un grafico de barras
$temperaturas = new BarPlot( array(25,29,26,28,30,29,24) );

//Asigna la leyenda para la serie
$temperaturas->SetLegend('Temperatura');

//agrega la serie temperatura al grafico
$grafica->Add($temperaturas);

//Muestra el grafico
$grafica->Stroke();


?>

