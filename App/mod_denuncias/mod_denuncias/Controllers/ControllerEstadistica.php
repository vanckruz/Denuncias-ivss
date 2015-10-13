<?php 
	session_start();
	require_once('../../../resources/orcl_conex.php');
	require_once ('../../../resources/select/funciones.php');
	
	$fechaInicio = $_POST['fechaInicio']; //"2010-12-29";
	$fechaFin = $_POST['fechaFin'];  //"2011-01-12";

	//cambiar separador de fechas para la consulta
	$fechaInicio = cambiarSeparador($fechaInicio,"/","-");
	$fechaFin = cambiarSeparador($fechaFin,"/","-");

	//obtener rango de fechas
	$arrayFechas=rangoFechas($fechaInicio, $fechaFin);

	//Query
	list($consulta,$cont) = generarQuery($arrayFechas);
	//echo $consulta; exit();
	//ejecuto el query
	$resultado = dameDenunciasFiltro($consulta);

	if(count($resultado)>0)
	{
		require_once ('../../librerias/jpgraph/src/jpgraph.php');
		require_once ('../../librerias/jpgraph/src/jpgraph_bar.php');

	    $cell = 11; // se setea el valor de celda que sigue despues del encabezado
	    $fech = 0;
	    $data = array();
	    //mostrar data 
	    foreach ($resultado as $key => $fila)
	    {
	    	for ($i=0; $i <=$cont ; $i=$i+4)
	    	{ 
	    		if(isset($fila['TOTALPROC_X'.$i]))
	    		{

	    			list($mes,$aa) = dameMes($arrayFechas[$fech]['Inicio']);
					$mmm = nombreMes($mes);

					//todo del reporte

				    //guardar datos para la imagen
				    $data[$i]['PROC'] = $fila['TOTALPROC_X'.$i];
				    $data[$i]['NOPROC'] = $fila['TOTALNOPROC_X'.$i];
				    $data[$i]['CERRADOS'] = $fila['CERRADOS_X'.$i];
				    $data[$i]['TOTAL'] = $fila['TOTAL_X'.$i] ;
				    $data[$i]['MES'] = $mmm;

				    $cell = $cell +3;
				    $fech = $fech +1;

	    		}
	    	}
	    }

	    //Colocar TOTALES
	    $cell = $cell +1;
	    //generar la imagen

	    //--------------------------------------------------------------------------------------
	    //--------------------------------------------------------------------------------------
	    //--------------------------------------------------------------------------------------
	    $todo = array();
	    foreach ($data as $key => $value)
	    {
	    	$arrayBarras=array($value['PROC'],$value['NOPROC'],$value['CERRADOS'],$value['TOTAL']); 
	    	
	    	$bplot = new BarPlot($arrayBarras);
	    	$bplot->value->Show();
	    	array_push($todo,$bplot);

	    }
	    
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

		$n = 0;

		$todos = new GroupBarPlot( array(

			isset($todo[$n]) ? $todo[$n] : NULL

			) );

		//agrega al grafico el grupo de series
		$grafico->Add($todos);
		$grafico->Stroke();

	}




/*
	TITULOS DEL REPORTE
*/
 function titulosExcel($objPHPExcel,$estiloCabecera)
 {
 	   //MESES
	    $objPHPExcel->setActiveSheetIndex(0)
	    ->mergeCells('A8:B8')
	    ->mergeCells('A9:B9')
	    ->mergeCells('A10:B10')
	    //PROC
	    ->mergeCells('C8:D8')
	    ->mergeCells('C9:D9')
	    ->mergeCells('C10:D10')   
	    //NO PROC
	    ->mergeCells('E8:F8')
	    ->mergeCells('E9:F9')
	    ->mergeCells('E10:F10')	    
	    //CERRADOS
	    ->mergeCells('G8:H8')
	    ->mergeCells('G9:H9')
	    ->mergeCells('G10:H10')   
	    //TOTAL
	    ->mergeCells('I8:J8')
	    ->mergeCells('I9:J9')
	    ->mergeCells('I10:J10');

	    $objPHPExcel->getActiveSheet()->getStyle('A8:B10')->applyFromArray($estiloCabecera);
	    $objPHPExcel->getActiveSheet()->getStyle('C8:D10')->applyFromArray($estiloCabecera);
	    $objPHPExcel->getActiveSheet()->getStyle('E8:F10')->applyFromArray($estiloCabecera);
	    $objPHPExcel->getActiveSheet()->getStyle('G8:H10')->applyFromArray($estiloCabecera);
	    $objPHPExcel->getActiveSheet()->getStyle('I8:J10')->applyFromArray($estiloCabecera);

	    //DEFINICION DE CABECERAS

	     $objPHPExcel->getActiveSheet()
	    ->getCell('A9')
	    ->setValue('MES');

	     $objPHPExcel->getActiveSheet()
	    ->getCell('C9')
	    ->setValue('PROCEDENTES');

	     $objPHPExcel->getActiveSheet()
	    ->getCell('E9')
	    ->setValue('NO PROCEDENTES');

	     $objPHPExcel->getActiveSheet()
	    ->getCell('G9')
	    ->setValue('CERRADAS');

	     $objPHPExcel->getActiveSheet()
	    ->getCell('I9')
	    ->setValue('TOTAL');
 }


/*CABECERA DE TOTAL*/
 function totalesSum($objPHPExcel,$estiloCabecera,$cell)
 {

 	$objPHPExcel->setActiveSheetIndex(0)
    ->mergeCells('A'.$cell.':B'.$cell)
    ->mergeCells('A'.($cell+1).':B'.($cell+1));

	$objPHPExcel->getActiveSheet()
    ->getCell('A'.$cell)
    ->setValue('TOTAL');

   $objPHPExcel->getActiveSheet()
	->getCell('C'.$cell) 
	->setValue('=SUM(C11:C'.($cell-2).')');

	$objPHPExcel->getActiveSheet()
	->getCell('E'.$cell) 
	->setValue('=SUM(E11:E'.($cell-2).')');	

	$objPHPExcel->getActiveSheet()
	->getCell('G'.$cell) 
	->setValue('=SUM(G11:G'.($cell-2).')');

	$objPHPExcel->getActiveSheet()
	->getCell('I'.$cell) 
	->setValue('=SUM(I11:I'.($cell-2).')');

	$objPHPExcel->getActiveSheet()->getStyle('A'.$cell.':B'.$cell)->applyFromArray($estiloCabecera);
	$objPHPExcel->getActiveSheet()->getStyle('C'.$cell)->applyFromArray($estiloCabecera);
	$objPHPExcel->getActiveSheet()->getStyle('D'.$cell)->applyFromArray($estiloCabecera);
	$objPHPExcel->getActiveSheet()->getStyle('E'.$cell)->applyFromArray($estiloCabecera);
	$objPHPExcel->getActiveSheet()->getStyle('F'.$cell)->applyFromArray($estiloCabecera);
	$objPHPExcel->getActiveSheet()->getStyle('G'.$cell)->applyFromArray($estiloCabecera);
	$objPHPExcel->getActiveSheet()->getStyle('H'.$cell)->applyFromArray($estiloCabecera);
	$objPHPExcel->getActiveSheet()->getStyle('I'.$cell)->applyFromArray($estiloCabecera);
	$objPHPExcel->getActiveSheet()->getStyle('J'.$cell)->applyFromArray($estiloCabecera);

 }

/*
	ENCABEZADO DEL REPORTE
*/
function encabezadoExcel($objPHPExcel,$estiloTituloTexto,$fecha)
{

		$objPHPExcel->setActiveSheetIndex(0)
	    ->mergeCells('A1:J1')
	    ->mergeCells('A2:J2')
	    ->mergeCells('A3:J3')
	    ->mergeCells('A4:J4')
	    ->mergeCells('A5:J5')
	    ->mergeCells('A6:J6')
	    ->mergeCells('A7:J7');

		$objPHPExcel->getActiveSheet()
	    ->getCell('A1')
	    ->setValue('REPÚBLICA BOLIVARIANA DE VENEZUELA');

	   $objPHPExcel->getActiveSheet()
	    ->getCell('A2')
	    ->setValue('MINISTERIO DEL PODER POPULAR PARA EL TRABAJO Y SEGURIDAD SOCIAL');

	    $objPHPExcel->getActiveSheet()
	    ->getCell('A3')
	    ->setValue('INSTITUTO VENEZOLANO DE LOS SEGUROS SOCIALES');	   

	     $objPHPExcel->getActiveSheet()
	    ->getCell('A4')
	    ->setValue('DIRECCIÓN GENERAL DE FISCALIZACIÓN');	 

	    $objPHPExcel->getActiveSheet()
	    ->getCell('A5')
	    ->setValue('RELACIÓN DE DENUNCIAS DURANTE '.$fecha[0]['Inicio'].' A  '.$fecha[count($fecha)-1]['Fin'].' NIVEL NACIONAL');


	    $objPHPExcel->getActiveSheet()->getStyle('A1')->applyFromArray($estiloTituloTexto);
	    $objPHPExcel->getActiveSheet()->getStyle('A2')->applyFromArray($estiloTituloTexto);
	    $objPHPExcel->getActiveSheet()->getStyle('A3')->applyFromArray($estiloTituloTexto);
	    $objPHPExcel->getActiveSheet()->getStyle('A4')->applyFromArray($estiloTituloTexto);
	    $objPHPExcel->getActiveSheet()->getStyle('A5')->applyFromArray($estiloTituloTexto);
}


/*
	FUNCION PARA GENERAR CONSULTA
*/
function generarQuery($arrayFechas)
{
	$cont = 0;
	$consulta = "";
	$cabecera = "";

	foreach ($arrayFechas as $key => $fecha)
	{	
		$datos = "";
		$fechaInicio = cambiarSeparador($fecha['Inicio'],"-","/");
		$fechaFin = cambiarSeparador($fecha['Fin'],"-","/");

		//$mes = explode("/",$fechaInicio);
		//var_dump(substr($mes[1],1)); exit();
		//$nombre = nombreMes(substr($mes[1],1)-1);
		//echo $nombre; exit();

		// DATOS
		$datos = "x".$cont.".TOTAL AS TOTALPROC_X".$cont." ,"; 
		$datos .= "x".($cont+1).".TOTAL AS TOTALNOPROC_X".$cont." ,"; 
		$datos .= "x".($cont+2).".TOTAL AS TOTAL_X".$cont." ,"; 
		$datos .= "x".($cont+3).".TOTAL AS CERRADOS_X".$cont." ,"; 
		//inserto en un array

		$cabecera .= $datos;

		//CONSULTAS
   		$consulta .= " (SELECT count(*) as TOTAL FROM 
              FISC_DENUNCIAS
              WHERE FECHA_DENUNCIA 
              BETWEEN '".$fechaInicio."' AND '".$fechaFin."' AND ESTATUS_DENUNCIA=0)x".$cont.",

          (SELECT count(*) as TOTAL FROM 
              FISC_DENUNCIAS
              WHERE FECHA_DENUNCIA 
              BETWEEN '".$fechaInicio."' AND '".$fechaFin."' AND ESTATUS_DENUNCIA=1)x".($cont+1).",
          
          (SELECT count(*) as TOTAL FROM 
                    FISC_DENUNCIAS
                    WHERE FECHA_DENUNCIA 
                    BETWEEN '".$fechaInicio."' AND '".$fechaFin."' AND ESTATUS_DENUNCIA IN(0,1))x".($cont+2).",

		  (SELECT count(*) as TOTAL FROM 
                    FISC_DENUNCIAS
                    WHERE FECHA_DENUNCIA 
                    BETWEEN '".$fechaInicio."' AND '".$fechaFin."' AND ESTATUS_DENUNCIA=2 )x".($cont+3).",";

		$cont = ($cont+4);
	}
	//eliminio las (,) de cada cadena
	$consulta = substr ($consulta, 0, -1);
	$cabecera = substr ($cabecera, 0, -1);

	$query = "SELECT ".$cabecera." FROM ".$consulta;
	return array($query,$cont);
}


/*
	Funcion para ordenar las fechas
*/
function rangoFechas($fechaInicio, $fechaFin)
{
	$arrayFechas=array();
	$fechaMostrar = $fechaInicio;
	$cont = 0;
	while(strtotime($fechaMostrar) <= strtotime($fechaFin))
	{
		$fechaInicioExplode = explode("-", $fechaMostrar);

		$arrayFechas[$cont]['Inicio']="01-".$fechaInicioExplode[1]."-".$fechaInicioExplode[2];

		$arrayFechas[$cont]['Fin']=ultimo_dia($fechaInicioExplode[1],$fechaInicioExplode[2])."-".$fechaInicioExplode[1]."-".$fechaInicioExplode[2];

		$cont++;
		$fechaMostrar = date("d-m-Y", strtotime($fechaMostrar . " + 1 Month"));
	}
	return $arrayFechas;
} 

/*
	Funcion que trae el ultimo dia del mes y año indicado
*/
function ultimo_dia($mes,$ano) 
{return strftime("%d", mktime(0, 0, 0, $mes+1, 0, $ano));} 

/*
	funcion para cambiar separador de fechas
*/
function cambiarSeparador($fecha,$buscar,$reemplazo)
{
	$fecha = str_replace($buscar, $reemplazo , $fecha);
	return $fecha;
}

/*
	Funcion para obtener el nombre del mes
*/
function nombreMes($numeroMes)
{
	/*setlocale(LC_TIME, 'spanish');  
	$nombre=strftime("%B",mktime(0, 0, 0, $mes, 1, 2000)); 
	return $nombre;*/

	$meses = array('ENERO','FEBRERO','MARZO','ABRIL','MAYO','JUNIO','JULIO', 'AGOSTO','SEPTIEMBRE','OCTUBRE','NOVIEMBRE','DICIEMBRE');
	return $meses[$numeroMes];
} 

function dameMes($arrayFechas)
{
    $fecha = explode("-", $arrayFechas);
    if($fecha[1][0] == 0)
    {
    	$mes = substr($fecha[1],1);
    }else
    {
    	$mes = $fecha[1];
    }
    return array(($mes-1),$fecha[2]);	
}





 ?>