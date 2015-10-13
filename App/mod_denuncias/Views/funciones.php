<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
/* Archivo para funciones */

function conectaBaseDatos(){
	return DataBase::getInstance();
}
	
function dameEstado(){
	$resultado = false;
	$conex = conectaBaseDatos();
	$stid = oci_parse($conex, "SELECT * FROM ESTADO WHERE (NOMBRE_ESTADO != 'SIN ASIGNAR' AND ID_ESTADO!='DF') ORDER BY NOMBRE_ESTADO");
		if (!$stid){
    		$e = oci_error($this->conex);
    		trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
		}
		// Realizar la lógica de la consulta
		$r = oci_execute($stid);
		if (!$r){
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

function dameMunicipio($estado = ''){
	$resultado = false;
	$consulta = "SELECT * FROM SIRA.MUNICIPIO";
	//$consulta = "SELECT * FROM MUNICIPIO";
	
	if($estado != ''){
		$consulta .= " WHERE ID_ESTADO = :estado ORDER BY NOMBRE_MUNICIPIO";
	}
	
	$conex = conectaBaseDatos();
	$stid = oci_parse($conex, $consulta);
		if (!$stid){
    		$e = oci_error($this->conex);
    		trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
		}
		// Realizar la lógica de la consulta
		oci_bind_by_name($stid, ':estado', $estado);
		$r = oci_execute($stid);
		if (!$r){
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
	
function dameLocalidad($municipio = ''){
	$resultado = false;
	$consulta = "SELECT * FROM SIRA.PARROQUIA";
	//$consulta = "SELECT * FROM PARROQUIA";
	if($municipio != ''){
		$consulta .= " WHERE ID_MUNICIPIO = :municipio ORDER BY DESC_PARROQUIA";
	}
	
	$conex = conectaBaseDatos();
	$stid = oci_parse($conex, $consulta);
		if (!$stid){
    		$e = oci_error($this->conex);
    		trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
		}
		// Realizar la lógica de la consulta
		oci_bind_by_name($stid, ':municipio', $municipio);
		$r = oci_execute($stid);
		if (!$r){
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

function dameMotivos(){
	$conex = conectaBaseDatos();
	$resultado = false;
	$consulta = "SELECT * FROM FISC_MOTIVOS";
	$stid = oci_parse($conex, $consulta);
		if (!$stid){
    		$e = oci_error($this->conex);
    		trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
		}
		// Realizar la lógica de la consulta
		$r = oci_execute($stid);
		if (!$r){
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

//Falta modificar a partir de aquí
function documentosConsignados($id_denuncia){
	$sts=1;
	$resultado = false;
	$consulta = "SELECT * FROM FISC_DOCUMENTOS INNER JOIN FISC_DOC_DEN ON (FISC_DOCUMENTOS.ID_DOCUMENTO=FISC_DOC_DEN.ID_DOCUMENTO) AND (FISC_DOC_DEN.ID_DENUNCIA=:id) ORDER BY FISC_DOC_DEN.ID_DOCUMENTO";
	$conex = conectaBaseDatos();
	$stid = oci_parse($conex, $consulta);
		if (!$stid){
    		$e = oci_error($this->conex);
    		trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
		}
		// Realizar la lógica de la consulta
		oci_bind_by_name($stid, ':id', $id_denuncia);
		//oci_bind_by_name($stid, ':sts', $sts);
		$r = oci_execute($stid);
		if (!$r){
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
	
	function documentosNoConsignados($id_denuncia){
	$sts=0;
	$resultado = false;
	$consulta = "SELECT * FROM FISC_DOCUMENTOS INNER JOIN FISC_DOC_DEN ON FISC_DOCUMENTOS.ID_DOCUMENTO!=FISC_DOC_DEN.ID_DOCUMENTO and FISC_DOC_DEN.ID_DENUNCIA!=:id";
	
	$conex = conectaBaseDatos();
	$stid = oci_parse($conex, $consulta);
		if (!$stid){
    		$e = oci_error($this->conex);
    		trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
		}
		// Realizar la lógica de la consulta
		oci_bind_by_name($stid, ':id', $id_denuncia);
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

	function getDocumentos(){
	$resultado = false;
	$consulta = "SELECT * FROM FISC_DOCUMENTOS";
	
	$conex = conectaBaseDatos();
	$stid = oci_parse($conex, $consulta);
		if (!$stid){
    		$e = oci_error($this->conex);
    		trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
		}
		// Realizar la lógica de la consulta
		$r = oci_execute($stid);
		if (!$r){
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

function days_in_month($month, $year){
	$dias = cal_days_in_month(CAL_GREGORIAN, $month, $year); // 31
	return $dias;
}

function dameEmpresa($filtro, $valor)
{
	$resultado = false;
	$consulta = "SELECT * FROM EMPRESA WHERE ".$filtro."=:valor";
	
	$conex = conectaBaseDatos();
	$stid = oci_parse($conex, $consulta);
		if (!$stid){
    		$e = oci_error($this->conex);
    		trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
		}
		// Realizar la lógica de la consulta
		oci_bind_by_name($stid, ':valor', $valor);
		$r = oci_execute($stid);
		if (!$r){
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