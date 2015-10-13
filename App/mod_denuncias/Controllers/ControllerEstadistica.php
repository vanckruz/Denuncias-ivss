<?php 
error_reporting(E_ALL);
ini_set("display_errors", 1);
require_once('../../../resources/orcl_conex.php');
require_once ('../../../resources/select/funciones.php');

	//var_dump("llegue"); exit();

if (isset($_POST['generar']))
{
		$fechaInicio = "01-".$_POST['fechaInicio']; //"2010-12-29";
		$fechaFin = "01-".$_POST['fechaFin'];  //"2011-01-12";

		//cambiar separador de fechas para la consulta
		$fechaInicio = cambiarSeparador($fechaInicio,"/","-");
		$fechaFin = cambiarSeparador($fechaFin,"/","-");

		//dame la diferencia de meses de las fechas para saber que rango es el reporte
		$rango = dameRango($fechaInicio,$fechaFin);

		//obtener rango de fechas
		$arrayFechas=rangoFechas($fechaInicio, $fechaFin);

		//Query
		list($consulta,$cont) = generarQuery($arrayFechas);

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
					    //busco el nombre del mes
		    			list($mes,$aa) = dameMes($arrayFechas[$fech]['Inicio']);	
					    //nombre del mes
		    			$mmm = nombreMes($mes);	 
					    //guardar datos para la imagen
		    			$data[$i]['PROC'] = $fila['TOTALPROC_X'.$i];
		    			$data[$i]['NOPROC'] = $fila['TOTALNOPROC_X'.$i];
		    			$data[$i]['CERRADOS'] = $fila['CERRADOS_X'.$i];
		    			$data[$i]['TOTAL'] = $fila['TOTAL_X'.$i] ;
		    			$data[$i]['MES'] = $mmm;
		    			$data[$i]['AA'] = $aa;
		    			$fech++;
		    		}
		    	}
		    }


		    $grafico = new Graph(700,600);
		    $grafico->SetScale('textlin');

		// Ajustamos los margenes del grafico-----(left,right,top,bottom)
		    $grafico->img->SetMargin(40,10,0,0);

		//Asigna el titulo al grafico 
		    $grafico->title->Set("Estadisticas Denuncias");

		//if(count($data)==12) $n = 1;
		//else $n = 13;

		    foreach ($data as $key => $value)
		    {
		    	$arrayBarras=array($value['PROC'],$value['NOPROC'],$value['CERRADOS'],$value['TOTAL']); 
		    	$bplot[$key] = new BarPlot($arrayBarras);
		    	$bplot[$key]->SetWidth(13);
		    }

	    // 0 es mensual 
		// 1 bimestral
		// 2 trimestral
		// 5 semestre
		//11 anual
		    
	    if($rango == 0) //mensual 
	    {
	    	$grafico->xaxis->SetTitle($data[0]['MES']."-".$data[0]['AA']); //nombre del mes
	    	$grafico->xaxis->SetTickLabels(array("PROCEDENTES","NO PROCEDENTES","CERRADOS","TOTAL"));
	    	$todos = new GroupBarPlot(array($bplot[0]));	
	    	$num = 0;
	    }elseif($rango == 1) // bimestral
	    {
	    	$grafico->xaxis->SetTickLabels(array("PROCEDENTES","NO PROCEDENTES","CERRADOS","TOTAL"));
	    	$todos = new GroupBarPlot(array($bplot[0],$bplot[4]));	
	    	$num = 4;
	    }
	    elseif($rango == 2) //trimestal
	    {
	    	$grafico->xaxis->SetTickLabels(array("PROCEDENTES","NO PROCEDENTES","CERRADOS","TOTAL"));
	    	$todos = new GroupBarPlot(array($bplot[0],$bplot[4],$bplot[8]));	
	    	$num = 8;
	    }elseif($rango == 5) //semestre
	    { 
	    	$grafico->xaxis->SetTickLabels(array("PROCEDENTES","NO PROCEDENTES","CERRADOS","TOTAL"));
	    	$todos = new GroupBarPlot(array($bplot[0],$bplot[4],$bplot[8],$bplot[12],$bplot[16],$bplot[20]));	
	    	$num = 20;
	    }else
	    {
	    	$grafico->xaxis->SetTickLabels(array("PROCEDENTES","NO PROCEDENTES","CERRADOS","TOTAL"));
	    	$todos = new GroupBarPlot(array($bplot[0],$bplot[4],$bplot[8],$bplot[12],$bplot[16],$bplot[20],$bplot[24],$bplot[28],$bplot[32]
	    		,$bplot[36],$bplot[40],$bplot[44] ));	
	    	$num = 44;
	    }

	    $grafico->Add($todos);
	    $grafico->yaxis->SetTitle("Denuncias","middle");


		//mostrar los valores
	    foreach ($bplot as $key => $plot)
	    {
	    	$plot->value->Show();
	    	$plot->SetLegend($data[$key]['MES']);
	    }
	    
	    $nombre = "../../../public_html/archivos/Estadistica-M-".$data[0]['MES']."-".$data[$num]['MES']."-".$data[$num]['AA'];

	    $grafico->Stroke($nombre);

	    $json['query'] = $consulta;

	    $json['nombre'] = $nombre;

	    $json['fechaInicio'] = $fechaInicio;

	    $json['fechaFin'] = $fechaFin;

	    $json['cont'] = $cont;

	    echo json_encode($json);

	}
}elseif(isset($_POST['q']) && !empty($_POST['q']))
{
	$fechaInicio = $_POST['i'];
	$fechaFin = $_POST['f'];
	$consulta = $_POST['q'];
	$foto = $_POST['n'];
	$cont = $_POST['c'];

	$resultado = dameDenunciasFiltro($consulta);
	if(count($resultado)>0)
	{
		require_once '../../librerias/PHPExcel/Classes/PHPExcel.php';
		$nombreExcel = "Denuncias-".$fechaInicio." - ".$fechaFin;

			// Se crea el objeto PHPExcel
		$objPHPExcel = new PHPExcel();
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="'.$nombreExcel.'".xls ');
		header('Cache-Control: max-age=0');


		$fechaInicio = cambiarSeparador($fechaInicio,"/","-");
		$fechaFin = cambiarSeparador($fechaFin,"/","-");

		$arrayFechas=rangoFechas($fechaInicio, $fechaFin);

			$objPHPExcel->getProperties()->setCreator("Edwin Garcia") //Autor
							 ->setLastModifiedBy("Edwin Garcia") //Ultimo usuario que lo modificó
							 ->setTitle("Ivss")
							 ->setSubject("Ivss")
							 ->setDescription("Estadisticas")
							 ->setKeywords("Estadisticass")
							 ->setCategory("Estadisticas Excel");	

							 $objPHPExcel->getActiveSheet(0)->setTitle("Estadisticas Denuncias");

			/*
				ESTILOS PARA EL ENCABEZADO DEL REPORTE
			*/
				$estiloTituloTexto = array(
					'alignment' => array(
						'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
						),
					'font' => array(
						'bold' => true,
						'size'  => 9,
						'name'  => 'Calibri'
						),
					'borders' => array(
						'allborders' => array(
							'style' => PHPExcel_Style_Border::BORDER_THIN,
							'color' => array('argb' => 'FF000000'),
							)
						),
					);
		   	/*
				ESTILOS PARA LOS TITULOS DEL REPORTE
			*/
				$estiloCabecera = array(
					'alignment' => array(
						'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
						),
					'font' => array(
						'bold' => true,
						'size'  => 9,
						'name'  => 'Calibri',
						'color' => array('rgb' => 'FFFFFF'),
						),
					'fill' => array(
						'type' => PHPExcel_Style_Fill::FILL_SOLID,
						'color' => array('rgb' => 'FF0000')
						),
					'borders' => array(
						'allborders' => array(
		          'style' => PHPExcel_Style_Border::BORDER_THIN, //BORDER_THICK
		          'color' => array('argb' => 'FF000000'),
		          )
						),
					);

				$estiloInfo = array(
					'alignment' => array(
						'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
						),
					'font' => array(
						'bold' => true,
						'size'  => 9,
						'name'  => 'Calibri',
						'color' => array('rgb' => '000000'),
						),
					'fill' => array(
						'type' => PHPExcel_Style_Fill::FILL_SOLID,
						'color' => array('rgb' => 'FFFFFF')
						),
					'borders' => array(
						'allborders' => array(
		          'style' => PHPExcel_Style_Border::BORDER_THIN, //BORDER_THICK
		          'color' => array('argb' => 'FF000000'),
		          )
						),
					);

		    //ENCABEZADO
				encabezadoExcel($objPHPExcel,$estiloTituloTexto,$arrayFechas);	
		     //ARMA LOS TITULOS 
				titulosExcel($objPHPExcel,$estiloCabecera);

		    $cell = 11; // se setea el valor de celda que sigue despues del encabezado
		    $fech = 0;
		    foreach ($resultado as $key => $fila)
		    {
		    	for ($i=0; $i <=$cont ; $i=$i+4)
		    	{ 
		    		if(isset($fila['TOTALPROC_X'.$i]))
		    		{
		    			//mes
		    			$objPHPExcel->setActiveSheetIndex(0)
		    			->mergeCells('A'.$cell.':B'.$cell)
		    			->mergeCells('A'.($cell+1).':B'.($cell+1))
		    			->mergeCells('A'.($cell+2).':B'.($cell+2));

		    			$objPHPExcel->getActiveSheet()->getStyle('A'.$cell.':B'.$cell)->applyFromArray($estiloCabecera);
		    			$objPHPExcel->getActiveSheet()->getStyle('A'.($cell+1).':B'.($cell+1))->applyFromArray($estiloCabecera);
		    			$objPHPExcel->getActiveSheet()->getStyle('A'.($cell+2).':B'.($cell+2))->applyFromArray($estiloCabecera);

					    //busco el nombre del mes
		    			list($mes,$aa) = dameMes($arrayFechas[$fech]['Inicio']);		 
		    			
		    			$objPHPExcel->getActiveSheet()->getStyle('B'.($cell+1).':H'.($cell +1))->applyFromArray($estiloInfo);
		    			$objPHPExcel->getActiveSheet()->getStyle('I'.($cell+1).':J'.($cell +1))->applyFromArray($estiloCabecera);
		    			
					    //nombre del mes
		    			$mmm = nombreMes($mes);

		    			$objPHPExcel->getActiveSheet()
		    			->getCell('A'.($cell+1))
		    			->setValue($mmm." - ".$aa);

					   //PROC				    
		    			$objPHPExcel->getActiveSheet()
		    			->getCell('C'.($cell+1))
		    			->setValue($fila['TOTALPROC_X'.$i]);

					    //NO PROC
		    			$objPHPExcel->getActiveSheet()
		    			->getCell('E'.($cell+1))
		    			->setValue($fila['TOTALNOPROC_X'.$i]);			

					    //NO PROC
		    			$objPHPExcel->getActiveSheet()
		    			->getCell('G'.($cell+1))
		    			->setValue($fila['CERRADOS_X'.$i]);

					    //total
		    			$objPHPExcel->getActiveSheet()
		    			->getCell('I'.($cell+1))
		    			->setValue($fila['TOTAL_X'.$i]);

					    //color para el total dinamico
		    			$objPHPExcel->getActiveSheet()->getStyle('I'.$cell.':I'.($cell +1))->applyFromArray($estiloCabecera);
		    			$objPHPExcel->getActiveSheet()->getStyle('J'.$cell.':J'.($cell +1))->applyFromArray($estiloCabecera);
		    			$objPHPExcel->getActiveSheet()->getStyle('I'.$cell.':I'.($cell +2))->applyFromArray($estiloCabecera);
		    			$objPHPExcel->getActiveSheet()->getStyle('J'.$cell.':J'.($cell +2))->applyFromArray($estiloCabecera);

		    			$cell = $cell +3;
		    			$fech = $fech +1;

		    		}
		    	}
		    }

		    //COLOCAR TOTALES
		    $cell = $cell +1;
		    totalesSum($objPHPExcel,$estiloCabecera,$cell);

		     //CREAR PESTAÑA PARA AGREGAR GRAFICAS
		    $objPHPExcel->createSheet(1); 
			$objPHPExcel->setActiveSheetIndex(1); //Seleccionar la pestaña deseada
			$objPHPExcel->getActiveSheet()->setTitle("Graficas"); //Establecer nombre para la pestaña
			//reiniciar cell en la nueva pestaña
			$cell = 2;

			// objeto PHPExcel_Worksheet_Drawing para agregar la imagen
			$objDrawing = new PHPExcel_Worksheet_Drawing();
			$objDrawing->setName($foto);
			$objDrawing->setDescription('Logo');
			$logo = $foto; // Provide path to your logo file
			$objDrawing->setPath($logo);  //setOffsetY has no effect
			$objDrawing->setCoordinates('B'.$cell );
			$objDrawing->setHeight(500); // logo height
			$objDrawing->setWorksheet($objPHPExcel->getActiveSheet());   
			$cell = $cell + 14; 

			// Se activa la hoja 0 de Empresas para mostrar como principal
			$objPHPExcel->setActiveSheetIndex(0);

			//FIN EXCEL
			$writer = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
			// This line will force the file to download
			$writer->save('php://output');

		}else
		{
			echo "no hay data";
		}

		
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

function dameRango($fechaInicio,$fechaFin)
{
	$inic = explode("-", $fechaInicio);
	$fin = explode("-", $fechaFin);
	return $fin[1] - $inic[1];
}





?>