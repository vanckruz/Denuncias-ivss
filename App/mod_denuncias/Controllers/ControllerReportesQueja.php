<?php 
	error_reporting(E_ALL);
	ini_set("display_errors", 1);
	date_default_timezone_set('America/Caracas');
	include("../../config/config.php");
	require_once '../../librerias/PHPExcel/Classes/PHPExcel.php';
	require('../../../resources/orcl_conex.php'); 

	//var_dump($_POST); exit();
	if(!empty($_POST['query']))
	{
		$quejas = dameQuejasFiltro($_POST['query']);
	}else
	{
		$query = sql();
		$quejas = dameQuejasFiltro($query);
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

		$titulosColumnas = array('QUEJA Y/O RECLAMOS','N° PATRONAL','NOMBRE DEL REPRESENTANTE','FECHA DENUNCIA','FECHA CIERRE'); 
		
		// Se agregan los titulos del reporte
		$objPHPExcel->setActiveSheetIndex(0)
        		    ->setCellValue('A1',  $titulosColumnas[0])
		            ->setCellValue('B1',  $titulosColumnas[1])
        		    ->setCellValue('C1',  $titulosColumnas[2])
        		    ->setCellValue('D1',  $titulosColumnas[3])
        		    ->setCellValue('E1',  $titulosColumnas[4]);
       	
       	/*
			AGREGAR DATA AL REPORTE
       	*/

		if(count($quejas)!=0)
		{	
			$i=2;
			foreach ($quejas as $key => $fila) 
			{

				$nombre = dameNombreDenuncianteQueja(html_entity_decode($fila['ID_EMPRESA']));
				if($nombre!=NULL){
					foreach ($nombre as $key => $nom){
						$nombre= $nom['NOMBRE'];
					}
				}else $nombre = "";

		       $objPHPExcel->setActiveSheetIndex(0)
    		    ->setCellValue('A'.$i, (html_entity_decode($fila['ID_DENUNCIA']) ) )
	            ->setCellValue('B'.$i, (html_entity_decode($fila['ID_EMPRESA']) ) )
    		    ->setCellValue('C'.$i, $nombre)
        	    ->setCellValue('D'.$i, $fila['FECHA_DENUNCIA'])
                ->setCellValue('E'.$i, $fila['FECHA_CIERRE']);


        		for($j = 'A'; $j <= 'E'; $j++)
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
		$objPHPExcel->getActiveSheet()->getStyle('A1:E1')->applyFromArray($estiloTituloReporte);

		$objPHPExcel->getActiveSheet()->setTitle("Quejas");

		$nombre = "ReporteQuejas".date('m-d-Y');

		// Se manda el archivo al navegador web, con el nombre que se indica (Excel2007)
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="'.$nombre.'".xlsx');
		header('Cache-Control: max-age=0');

		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
		$objWriter->save('php://output');
		exit;


	function dameQuejasFiltro($sql)
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
		return "SELECT dj.ID_DENUNCIA as ID_DENUNCIA, dj.ID_EMPRESA as ID_EMPRESA, dj.FECHA_DENUNCIA as FECHA_DENUNCIA,
			dj.ESTATUS_DENUNCIA as ESTATUS_DENUNCIA, fmqc.DESCRIPCION as DESCRIPCION,

			 CASE dj.ESTATUS_DENUNCIA WHEN 0 THEN 'PROCEDENTE'
		  	WHEN 1 THEN 'IMPROCEDENTE'
		    ELSE 'CERRADO' END AS TIPO,

			 LISTAGG(e.NOMBRE_FISC_EMPRESA, '-') WITHIN GROUP (ORDER BY e.NOMBRE_FISC_EMPRESA) 
			 as NOMBRE_EMPRESA,

			dj.FECHA_CIERRE as FECHA_CIERRE,

			fmqc.DESCRIPCION AS DESCRIPCION
			FROM FISC_DENUNCIAS_JURIDICAS dj
			LEFT JOIN FISC_MOT_QUEJAS fmq on(dj.ID_DENUNCIA=fmq.ID_DENUNCIA)
			LEFT JOIN FISC_MOTIVOS_QUEJAS fmqc on (fmqc.ID_MOTIVO=fmq.ID_MOTIVO)
			LEFT JOIN TBL_ASIGNACIONQUEJA aq on(aq.STR_ID_DENUNCIA=dj.ID_DENUNCIA)
			LEFT JOIN DIRECCIONES_GENERALES dg on(dg.ID_DIRECCION=aq.INT_ID_DIRECCION)
			LEFT JOIN FISC_EMPRESA e on(e.ID_FISC_EMPRESA = dj.ID_EMPRESA)
	    GROUP BY dj.ID_DENUNCIA, dj.ID_EMPRESA, dj.FECHA_DENUNCIA,
	    dj.ESTATUS_DENUNCIA,fmqc.DESCRIPCION, dj.FECHA_CIERRE";
	}

	function conectaBaseDatos(){
		return DataBase::getInstance();
	}



	function dameNombreDenuncianteQueja($id)
	{
		$resultado = false;
		$conex =  conectaBaseDatos();
		$stid = oci_parse($conex, "SELECT  PRIMER_NOMBRE ||' '|| SEGUNDO_NOMBRE || ' ' ||PRIMER_APELLIDO || ' ' ||SEGUNDO_APELLIDO  AS NOMBRE  FROM sira.ciudadano c where c.ID_CIUDADANO = (select r.ID_CIUDADANO from sira.representante r where r.ID_EMPRESA=:id)");
		if (!$stid){
			$e = oci_error($this->conex);
			trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
		}
		oci_bind_by_name($stid, ':id', $id);
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












 ?>
