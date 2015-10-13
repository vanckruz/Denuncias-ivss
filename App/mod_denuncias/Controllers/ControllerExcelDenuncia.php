<?php 
	error_reporting(E_ALL);
	ini_set("display_errors", 1);
	date_default_timezone_set('America/Caracas');
	include("../../config/config.php");
	require_once '../../librerias/PHPExcel/Classes/PHPExcel.php';
	require('../../../resources/orcl_conex.php'); 


	//var_dump($_POST); exit();
	if(!empty($_POST['query'])){
		$denuncias = dameDenunciasFiltro($_POST['query']);
		//echo "1"; exit();
	}else
	{
		$denuncias = sql();
		$denuncias = dameDenunciasFiltro($denuncias);
		//echo "2"; exit();
	}


	// Se crea el objeto PHPExcel
		$objPHPExcel = new PHPExcel();

		// Se asignan las propiedades del libro
		$objPHPExcel->getProperties()->setCreator("Edwin Garcia") //Autor
							 ->setLastModifiedBy("Edwin Garcia") //Ultimo usuario que lo modificó
							 ->setTitle("Ivss")
							 ->setSubject("Ivss")
							 ->setDescription("Reporte")
							 ->setKeywords("Reportes")
							 ->setCategory("Reporte Excel");

		$titulosColumnas = array('DENUNCIA','NOMBRE DEL DENUNCIANTE','CEDULA','DESCRIPCION','FECHA DENUNCIA','EMPRESA','N° PATRONAL','ESTATUS','DIRECCION','FECHA ASIGNADA','FECHA CIERRE'); 
		
		// Se agregan los titulos del reporte
		$objPHPExcel->setActiveSheetIndex(0)
        		    ->setCellValue('A1',  $titulosColumnas[0])
		            ->setCellValue('B1',  $titulosColumnas[1])
        		    ->setCellValue('C1',  $titulosColumnas[2])
        		    ->setCellValue('D1',  $titulosColumnas[3])
        		    ->setCellValue('E1',  $titulosColumnas[4])
        		    ->setCellValue('F1',  $titulosColumnas[5])
        		    ->setCellValue('G1',  $titulosColumnas[6])
        		    ->setCellValue('H1',  $titulosColumnas[7])
        		    ->setCellValue('I1',  $titulosColumnas[8])
        		    ->setCellValue('J1',  $titulosColumnas[9])        		    
			    ->setCellValue('K1',  $titulosColumnas[10]);
       	
       	/*
			AGREGAR DATA AL REPORTE
       	*/

		if(count($denuncias)!=0)
		{	
			$i=2;
			foreach ($denuncias as $key => $fila) 
			{
				if(!isset($fila['NOMBRE_DIRECCION']))
				{
					$nombre= "N/A";
				}else{
					$nombre=$fila['NOMBRE_DIRECCION'];
				}			

				if(!isset($fila['FECHA_ASIGNACION']))
				{
					$fecha= "N/A";
				}else{
					$fecha = $fila['FECHA_ASIGNACION'];
				}

				$objPHPExcel->setActiveSheetIndex(0)
    		    ->setCellValue('A'.$i, $fila['ID_DENUNCIA'])
	            ->setCellValue('B'.$i, html_entity_decode($fila['DATOS_CIUDADANO']) )
    		    ->setCellValue('C'.$i, $fila['ID_CIUDADANO'])
        		->setCellValue('D'.$i, html_entity_decode($fila['DESCRIPCION']) )
        		->setCellValue('E'.$i, $fila['FECHA_DENUNCIA'])
        		->setCellValue('F'.$i, $fila['NOMBRE_EMPRESA'])
        		->setCellValue('G'.$i, html_entity_decode($fila['ID_EMPRESA']) )
        		->setCellValue('H'.$i, $fila['TIPO'])
        		->setCellValue('I'.$i, $nombre)
        		->setCellValue('J'.$i, $fecha)
		        ->setCellValue('K'.$i, $fila['FECHA_CIERRE']);

        		for($j = 'A'; $j <= 'K'; $j++)
        		{
					$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension($j)->setAutoSize(TRUE);
				}
        		$i++;
			}
		}else
		{
			echo "no hay";
		}

		$estiloTituloReporte = array(
        	'font' => array(
	        	'name'      => 'Calibri',
    	        'bold'      => true,
        	    'italic'    => false,
                'strike'    => false,
               	'size' =>10
            ), // fondo de la cabecera
            'fill' => array(
                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                'color' => array('rgb'=>'00B4F2'),
                ),
        );
		//agergar estilo a la cabecera
		$objPHPExcel->getActiveSheet()->getStyle('A1:K1')->applyFromArray($estiloTituloReporte);

		$objPHPExcel->getActiveSheet()->setTitle("Denuncias");

		$nombre = "ReporteDenuncias".date('m-d-Y');

		// Se manda el archivo al navegador web, con el nombre que se indica (Excel2007)
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="'.$nombre.'".xlsx');
		header('Cache-Control: max-age=0');

		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
		$objWriter->save('php://output');
		exit;



	function conectaBaseDatos(){
		return DataBase::getInstance();
	}

	function dameDenunciasFiltro($sql)
	{
		$resultado = false;
		$conex =  conectaBaseDatos();
		$stid = oci_parse($conex, $sql);
		if (!$stid){
			$e = oci_error($this->conex);
			trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
		}
		$r = oci_execute($stid);
		if (!$r)
		{
			$e = oci_error($stid);
			trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
		}

		// Obtener los resultados de la consulta
		while ($fila = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)){
			$resultado[] = $fila;
		}
		//Libera los recursos
		oci_free_statement($stid);
		// Cierra la conexión Oracle
		oci_close($conex);

		return $resultado;
	}

	function sql()
	{
		return "SELECT fd.ID_DENUNCIA as ID_DENUNCIA,  fd.ID_CIUDADANO as ID_CIUDADANO,fc.NOMBRES|| ' ' ||fc.APELLIDOS as DATOS_CIUDADANO,fd.FECHA_DENUNCIA as FECHA_DENUNCIA, fd.DESCRIPCION as DESCRIPCION, fd.ID_EMPRESA as ID_EMPRESA,fe.NOMBRE_FISC_EMPRESA as NOMBRE_EMPRESA, fmd.ID_MOTIVO as ID_MOTIVO,fm.DESCRIPCION as MOTIVOS,
		 	CASE fd.ESTATUS_DENUNCIA WHEN 0 THEN 'PROCEDENTE'
		  	WHEN 1 THEN 'NO PROCEDENTE'
		    ELSE 'CERRADO' END AS TIPO,
		fd.FECHA_CIERRE as FECHA_CIERRE,
		fd.ESTATUS_DENUNCIA AS ID_ESTATUS
		FROM FISC_DENUNCIAS fd 
		LEFT JOIN FISC_CIUDADANO fc on(fc.ID_CIUDADANO=fd.ID_CIUDADANO)
		LEFT JOIN FISC_MOT_DEN fmd on(fmd.ID_DENUNCIA=fd.ID_DENUNCIA) 
		LEFT JOIN FISC_MOTIVOS fm on(fm.ID_MOTIVO=fmd.ID_MOTIVO)
		LEFT JOIN FISC_EMPRESA fe on (fe.ID_FISC_EMPRESA=fd.ID_EMPRESA)";

	}




 ?>
