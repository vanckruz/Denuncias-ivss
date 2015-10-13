<?php 
require('../../../resources/orcl_conex.php'); 

$sql = "SELECT dj.ID_DENUNCIA as ID_DENUNCIA, dj.ID_EMPRESA as ID_EMPRESA, dj.FECHA_DENUNCIA as FECHA_DENUNCIA,
dj.ESTATUS_DENUNCIA as ESTATUS_DENUNCIA, fmqc.DESCRIPCION as DESCRIPCION,

CASE dj.ESTATUS_DENUNCIA WHEN 0 THEN 'PROCEDENTE'
WHEN 2 THEN 'CERRADO'
ELSE 'NO PROCEDENTE' END AS TIPO,

LISTAGG(e.NOMBRE_FISC_EMPRESA, '-') WITHIN GROUP (ORDER BY e.NOMBRE_FISC_EMPRESA) 
as NOMBRE_EMPRESA,

dj.FECHA_CIERRE as FECHA_CIERRE,

fmqc.DESCRIPCION AS DESCRIPCION
FROM FISC_DENUNCIAS_JURIDICAS dj
JOIN FISC_MOT_QUEJAS fmq on(dj.ID_DENUNCIA=fmq.ID_DENUNCIA)
JOIN FISC_MOTIVOS_QUEJAS fmqc on (fmqc.ID_MOTIVO=fmq.ID_MOTIVO)
LEFT JOIN TBL_ASIGNACIONQUEJA aq on(aq.STR_ID_DENUNCIA=dj.ID_DENUNCIA)
LEFT JOIN DIRECCIONES_ASIGNACION dg on(dg.ID_DIRECCION=aq.INT_ID_DIRECCION)
LEFT JOIN FISC_EMPRESA e on(e.ID_FISC_EMPRESA = dj.ID_EMPRESA) WHERE
";

	//si hay direcciones agregadas.
$boo = FALSE;

if(isset($_POST['direcciones']) && !empty($_POST['direcciones']) &&  count($_POST['direcciones'])!=0)
{
	$direcciones = $_POST['direcciones'];
	$boo = TRUE;
	$sql.="dg.ID_DIRECCION IN(".transformarArray($direcciones,",").")";
}
	//motivos
if(isset($_POST['motivos']) && !empty($_POST['motivos']) &&  count($_POST['motivos'])!=0)
{
	$motivos = $_POST['motivos'];
	if($boo) $sql.=" AND ";
	$sql.="fmq.ID_MOTIVO IN(".transformarArray($motivos,",").")";	
	$boo = TRUE;	
}

	//procedente
if( isset($_POST['status']) && !empty($_POST['status']) && count($_POST['status'])!=0)
{
	$status = $_POST['status'];
	if($boo) $sql.=" AND ";
	$sql.="dj.ESTATUS_DENUNCIA IN(".transformarArray($status,",").")";		
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

		$sql.="dj.FECHA_DENUNCIA BETWEEN '".$fechaInicio."' AND '".$fechaFin."' ";
		$boo = TRUE;

	}elseif(!empty($_POST['fechaInicio']))
	{
		//$fechaInicio = date("d-m-Y", strtotime($fechaInicio));
		if($boo) $sql.=" AND ";

		$sql.="dj.FECHA_DENUNCIA = '".$fechaInicio."' ";
		$boo = TRUE;
	}elseif(!empty($_POST['fechaFin']))
	{
		//$fechaFin = date("d-m-Y", strtotime($fechaFin));
		if($boo) $sql.=" AND ";
		$sql.="dj.FECHA_DENUNCIA = '".$fechaFin."' ";
		$boo = TRUE;
	}

	if(isset($_POST['asignada']))
	{
		if($boo) $sql.="AND";
		$sql.="dj.ASIGNADA = 1";
		$boo=true;
	}
	
	$limit = " AND ROWNUM <=20 ";

	$order = " ORDER BY dj.FECHA_DENUNCIA DESC ";

	$group = " GROUP BY dj.ID_DENUNCIA, dj.ID_EMPRESA, dj.FECHA_DENUNCIA,
	dj.ESTATUS_DENUNCIA,fmqc.DESCRIPCION,dj.FECHA_CIERRE ";

	if(!$boo)
	{
		$sql = "SELECT dj.ID_DENUNCIA as ID_DENUNCIA, dj.ID_EMPRESA as ID_EMPRESA, dj.FECHA_DENUNCIA as FECHA_DENUNCIA,
		dj.ESTATUS_DENUNCIA as ESTATUS_DENUNCIA, fmqc.DESCRIPCION as DESCRIPCION,

		CASE dj.ESTATUS_DENUNCIA WHEN 0 THEN 'PROCEDENTE'
		WHEN 2 THEN 'CERRADO'
		ELSE 'NO PROCEDENTE' END AS TIPO,

		LISTAGG(e.NOMBRE_FISC_EMPRESA, '-') WITHIN GROUP (ORDER BY e.NOMBRE_FISC_EMPRESA) 
		as NOMBRE_EMPRESA,

		dj.FECHA_CIERRE as FECHA_CIERRE,

		fmqc.DESCRIPCION AS DESCRIPCION
		FROM FISC_DENUNCIAS_JURIDICAS dj
		JOIN FISC_MOT_QUEJAS fmq on(dj.ID_DENUNCIA=fmq.ID_DENUNCIA)
		JOIN FISC_MOTIVOS_QUEJAS fmqc on (fmqc.ID_MOTIVO=fmq.ID_MOTIVO)
		LEFT JOIN TBL_ASIGNACIONQUEJA aq on(aq.STR_ID_DENUNCIA=dj.ID_DENUNCIA)
		LEFT JOIN DIRECCIONES_ASIGNACION dg on(dg.ID_DIRECCION=aq.INT_ID_DIRECCION)
		LEFT JOIN FISC_EMPRESA e on(e.ID_FISC_EMPRESA = dj.ID_EMPRESA)";
	}


	//ejecuta el query con los filtros

	//var_dump($sql.$limit.$group.$order); exit();

	//echo $sql.$limit.$group; exit();

	$quejas = dameQuejasFiltro($sql.$limit.$group.$order);

	$json['query'] = dameQuery($sql.$group);

	$json['tabla'] = tabla_dinamica($quejas);


	//var_dump($json['query']); exit();


	//var_dump($json['tabla']); exit();

	//mando la variable por ajax a la tabla

	echo json_encode($json);

	function transformarArray($array,$sep)
	{
		return implode($sep,$array);
	}

	function conectaBaseDatos(){
		return DataBase::getInstance();
	}

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

	function dameQuery($sql){
		return $sql;
	}

	function tabla_dinamica($sql){
		
		$tabla = "<thead style='font-size: 0.7em;'>
		<tr>
			<th style='text-align:left;'>Queja y/o Reclamos</th>
			<th style='text-align:left;'>Empresa</th>
			<th style='text-align:left;'>Nombre Del Representante</th>
			<th style='text-align:left;'>Fecha</th>          
			<th style='text-align:left;'>Estatus</th>          
			<th style='text-align:left;'>Motivos</th>      
		</tr>
	</thead>
	<tbody style='font-size: 1.1em;'>
		";

		if(empty($sql)){
			$tabla.= "<span style='font-size:0.8em'>No hay registros</span>";
			return $tabla;
		}
		else
		{
			foreach ($sql as $key)
			{

				$nombre = dameNombreDenuncianteQueja($key['ID_EMPRESA']);
				foreach ($nombre as $ke2 => $nom){
					$nombre= $nom['NOMBRE'];
				}

				$tabla.= "
				<tr style='font-size: 0.6em;' data-nacionalidad='' data-cedula=''>    
					
					<td style='width: 90px !important;text-align:left;'> ".$key['ID_DENUNCIA']." </td>

					<td style='width: 90px !important;text-align:left;'>".$key['ID_EMPRESA']." ".$key['NOMBRE_EMPRESA']." </td>

					<td style='width: 90px !important;text-align:left;'> ".$nombre." </td>

					<td style='width: 90px !important;text-align:left;'> ".$key['FECHA_DENUNCIA']." </td>

					<td style='width: 90px !important;text-align:left;'> ".$key['TIPO']." </td>

					<td style='width: 90px !important;text-align:left;'> ".$key['DESCRIPCION']." </td>
				</tr>	
				";
			}

			$tabla.="</tbody>
			<tfoot style='display:none'>
				<tr>
					<th>Queja y/o Reclamos</th>
					<th>Empresa</th>
					<th>Nombre Del Representante</th>
					<th>Fecha</th>          
					<th>Estatus</th>          
					<th>Motivos</th>      
				</tr>
			</tfoot>";
		}

		return $tabla; 

	} // fin funcion




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
