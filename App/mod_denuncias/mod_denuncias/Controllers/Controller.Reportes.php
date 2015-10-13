<?php 
	//require_once '../../resources/select/functiones.php';

require('../../../resources/orcl_conex.php'); 

	//verificar direcciones 
$sql = "SELECT DISTINCT(fd.ID_DENUNCIA)  as ID_DENUNCIA,  fd.ID_CIUDADANO as ID_CIUDADANO,fc.NOMBRES|| ' ' ||fc.APELLIDOS as 
DATOS_CIUDADANO,fd.FECHA_DENUNCIA as FECHA_DENUNCIA, fd.DESCRIPCION as DESCRIPCION, fd.ID_EMPRESA as ID_EMPRESA ,
CASE fd.ESTATUS_DENUNCIA WHEN 0 THEN 'PROCEDENTE'
WHEN 1 THEN 'NO PROCEDENTE'
ELSE 'CERRADO' END AS TIPO,
fd.FECHA_CIERRE as FECHA_CIERRE,
/*fmd.ID_MOTIVO as ID_MOTIVO,fm.DESCRIPCION as MOTIVOS,*/
fd.ESTATUS_DENUNCIA AS ID_ESTATUS,
ad.INT_ID_DIRECCION as ID_DIRECCION, ad.FECHA_ASIGNACION AS FECHA_ASIGNACION,
dg.NOMBRE as NOMBRE_DIRECCION, fe.NOMBRE_FISC_EMPRESA as NOMBRE_EMPRESA
FROM FISC_DENUNCIAS fd 
FULL JOIN FISC_CIUDADANO fc on(fc.ID_CIUDADANO=fd.ID_CIUDADANO)
FULL JOIN FISC_MOT_DEN fmd on(fmd.ID_DENUNCIA=fd.ID_DENUNCIA) 
FULL JOIN FISC_MOTIVOS fm on(fm.ID_MOTIVO=fmd.ID_MOTIVO) 
LEFT JOIN TBLASIGNACIONDENUNCIAS ad on(ad.STR_ID_DENUNCIA=fd.ID_DENUNCIA)
LEFT JOIN DIRECCIONES_ASIGNACION dg on(dg.ID_DIRECCION=ad.INT_ID_DIRECCION)
INNER JOIN FISC_EMPRESA fe on (fe.ID_FISC_EMPRESA=fd.ID_EMPRESA) 
WHERE ";

	//si hay direcciones agregadas.
$boo = FALSE;
if(isset($_POST['direcciones']) && !empty($_POST['direcciones']) &&  count($_POST['direcciones'])!=0)
{
	$direcciones = $_POST['direcciones'];
	$boo = TRUE;
	$sql.="ad.INT_ID_DIRECCION IN(".transformarArray($direcciones,",").")";
}

/*if(isset($_POST['motivos']) && !empty($_POST['motivos']) &&  count($_POST['motivos'])!=0)
{
	$motivos = $_POST['motivos'];
	if($boo) $sql.=" AND ";
	$sql.="fmd.ID_MOTIVO IN(".transformarArray($motivos,",").")";	
	$boo = TRUE;	
}*/

if( isset($_POST['status']) && !empty($_POST['status']) && count($_POST['status'])!=0)
{
	$status = $_POST['status'];
	if($boo) $sql.=" AND ";
	$sql.="fd.ESTATUS_DENUNCIA IN(".transformarArray($status,",").")";		
	$boo = TRUE;
}	


	/*
		Reviso fechas
		BETWEEN '16/08/15' and '17/08/15'
	*/

		$fechaInicio = $_POST['fechaInicio'];
		$fechaFin = $_POST['fechaFin'];

		if(!empty($_POST['fechaInicio']) && !empty($_POST['fechaFin']))
		{
		/*if( strtotime($_POST['fechaInicio'])> strtotime($_POST['fechaFin']) )
		{
			$fechaInicio = date("d-m-Y", strtotime($fechaFin));
			$fechaFin = date("d-m-Y", strtotime($fechaInicio));
		}else
		{			
			$fechaInicio = date("d-m-Y", strtotime($fechaInicio));
			$fechaFin = date("d-m-Y", strtotime($fechaFin));
		}*/

		if($boo) $sql.=" AND ";

		$sql.="fd.FECHA_DENUNCIA BETWEEN '".$fechaInicio."' AND '".$fechaFin."' ";
		$boo=TRUE;
	}elseif(!empty($_POST['fechaInicio']))
	{
		//$fechaInicio = date("d-m-Y", strtotime($fechaInicio));
		if($boo) $sql.=" AND ";

		$sql.="fd.FECHA_DENUNCIA = '".$fechaInicio."' ";
	}elseif(!empty($_POST['fechaFin']))
	{
		//$fechaFin = date("d-m-Y", strtotime($fechaFin));
		if($boo) $sql.=" AND ";
		$sql.="fd.FECHA_DENUNCIA = '".$fechaFin."' ";
	}

	//ejecuta el query con los filtros

	//$limit = " AND ROWNUM <=10";
	$limit = " ";

	$order = " order by fd.FECHA_DENUNCIA DESC";


	//var_dump($sqi.$limit.$order); exit();

	$denuncias = dameDenunciasFiltro($sql.$limit.$order);

	$json['query'] = dameQuery($sql);

	$json['tabla'] = tabla_dinamica($denuncias);

	//mando la variable por ajax a la tabla
	//echo tabla_dinamica($denuncias);

	echo json_encode($json);


	/*
		nombre = transformarArray
		param
			*array = array con id
			*sep = separador para la cadena
	*/
			function transformarArray($array,$sep)
			{
				return implode($sep,$array);
			}

			function tabla_dinamica($sql){

				$tabla = "<thead style='font-size: 0.7em;'>
				<tr>
					<th style='    text-align: left;'>Denuncia</th>
					<th style='    text-align: left;'>Nombre Del Denunciante</th>
					<th style='    text-align: left;'>Cédula</th>
					<th style='    text-align: left;'>Descripción</th>          
					<th style='    text-align: left;'>Fecha</th>
					<th style='    text-align: left;'>Empresa</th>
					<th style='    text-align: left;'>N°Patronal</th>      
					<th style='    text-align: left;'>Estatus</th>      
				</tr>
			</thead>
			<tbody style='font-size: 1.1em;text-align:left'>
				";

				if(empty($sql)){
					$tabla.= "<span style='font-size:0.8em'>No hay registros</span>";
					return $tabla;
				}
				else
				{
					foreach ($sql as $key)
					{
						$tabla.= "
						<tr style='font-size: 0.6em;' data-nacionalidad='' data-cedula=''>    
							
							<td style='width: 90px !important;text-align:left;'> ".$key['ID_DENUNCIA']." </td>

							<td style='width: 90px !important;text-align:left;'> ".$key['DATOS_CIUDADANO']." </td>

							<td style='width: 90px !important;text-align:left;'> ".$key['ID_CIUDADANO']." </td>

							<td style='width: 90px !important;text-align:left;'> ".$key['DESCRIPCION']." </td>

							<td style='width: 90px !important;text-align:left;'> ".$key['FECHA_DENUNCIA']." </td>

							<td style='width: 90px !important;text-align:left;'> ".$key['NOMBRE_EMPRESA']." </td>

							<td style='width: 90px !important;text-align:left;'> ".$key['ID_EMPRESA']." </td>

							<td style='width: 90px !important;text-align:left;'> ".$key['TIPO']." </td>
						</tr>	
						";
					}

					$tabla.="</tbody>
					<tfoot style='display:none'>
						<tr>
							<th>Denuncia</th>
							<th>Nombre Del Denunciante</th>
							<th>Cédula</th>
							<th>Descripción</th>          
							<th>Fecha</th>
							<th>Empresa</th>
							<th>N°Patronal</th>      
							<th>Estatus</th>      
						</tr>
					</tfoot>";
				}

				return $tabla; 

	} // fin funcion

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

	function dameQuery($sql){
		return $sql;
	}


	?>
