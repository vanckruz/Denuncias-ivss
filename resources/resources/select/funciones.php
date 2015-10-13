<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
/* Archivo para funciones */

function conectaBaseDatos(){
	return DataBase::getInstance();
}

function dameCodigosEstados($id_estado)
{
	$resultado = false;
	$conex = conectaBaseDatos();
	$stid = oci_parse($conex, "SELECT * FROM FISC_CODIGOS_TELEFONO WHERE ID_ESTADO = :id_edo");
	if (!$stid){
		$e = oci_error($this->conex);
		trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
	}
	oci_bind_by_name($stid, ':id_edo', $id_estado);
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

function dameCodigosTelefono()
{
	$resultado = false;
	$conex = conectaBaseDatos();
	$stid = oci_parse($conex, "SELECT DISTINCT CODIGO_AREA FROM FISC_CODIGOS_TELEFONO ORDER BY CODIGO_AREA");
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

function dameDenuncias()
{
	$resultado = false;
	$conex = conectaBaseDatos();
	$stid = oci_parse($conex, "SELECT * FROM FISC_DENUNCIAS ");
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

function dameDenunciasProceso()
{
	$resultado = false;
	$conex = conectaBaseDatos();
	$stid = oci_parse($conex, "SELECT * FROM FISC_DENUNCIAS WHERE ESTATUS_DENUNCIA=0 AND ASIGNACION = 0");
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

function dameEstatusDenuncia()
{
	$resultado = false;
	$conex = conectaBaseDatos();
	$stid = oci_parse($conex, "SELECT * FROM FISC_ESTATUS_DENUNCIA");
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

function dameQuejas($id=null)
{
	$resultado = false;
	$conex = conectaBaseDatos();

	if($id==null){
		$stid = oci_parse($conex, "SELECT * FROM FISC_DENUNCIAS_JURIDICAS");
	}else{
		$stid = oci_parse($conex, "SELECT dj.ID_DENUNCIA, dj.ID_EMPRESA, dj.DESCRIPCION_DENUNCIA as DESCRIPCION,
			(SELECT DIRECCION_FISC_EMPRESA FROM FISC_EMPRESA fe WHERE fe.ID_FISC_EMPRESA=dj.ID_EMPRESA) as DIRECCION_EMPRESA,

			(SELECT PUNTO_REF_FISC_EMPRESA FROM FISC_EMPRESA fe WHERE fe.ID_FISC_EMPRESA=dj.ID_EMPRESA) as PUNTO_REF_FISC_EMPRESA
			FROM FISC_DENUNCIAS_JURIDICAS dj WHERE ID_DENUNCIA=:id");
		oci_bind_by_name($stid, ':id', $id);
	}
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

function dameOficinasFiscalizacion()
{
	$resultado = false;
	$conex = conectaBaseDatos();
	$stid = oci_parse($conex, "SELECT * FROM FISC_OFICINA_ADMINISTRATIVA");
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

function dameEstadosRegion($id_region)
{
	$resultado = false;
	$conex = conectaBaseDatos();
	$stid = oci_parse($conex, "SELECT * FROM ESTADO WHERE (NOMBRE_ESTADO != 'SIN ASIGNAR' AND ID_ESTADO!='DF' AND ID_UBICACION_GEO =:id_ubicacion) ORDER BY NOMBRE_ESTADO");
	if (!$stid){
		$e = oci_error($this->conex);
		trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
	}
		// Realizar la lógica de la consulta
	oci_bind_by_name($stid, ':id_ubicacion', $id_region);
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

function dameEstadoById($id_estado)
{
	$resultado = false;
	$conex = conectaBaseDatos();
	$stid = oci_parse($conex, "SELECT * FROM SIRA.ESTADO WHERE ID_ESTADO =:id_estado");
	if (!$stid){
		$e = oci_error($this->conex);
		trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
	}
		// Realizar la lógica de la consulta
	oci_bind_by_name($stid, ':id_estado', $id_estado);
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

/*
*/
function dameNombreJefe($id)
{
	$resultado = false;
	$conex = conectaBaseDatos();
	$consulta = "SELECT PRIMER_NOMBRE, SEGUNDO_NOMBRE, PRIMER_APELLIDO, SEGUNDO_APELLIDO FROM FISC_JEFE_OFICINA WHERE ID_JEFE = :id_jefe";
	$stid = oci_parse($conex, $consulta);
	if (!$stid)
	{
		$e = oci_error($this->conex);
		trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
	}
		// Realizar la lógica de la consulta
	oci_bind_by_name($stid, ':id_jefe', $id);
	$r = oci_execute($stid);
	if (!$r)
	{
		$e = oci_error($stid);
		trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
	}

		// Obtener los resultados de la consulta
	while ($fila = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS))
	{
		$resultado[] = $fila;
	}
		//Libera los recursos
	oci_free_statement($stid);
		// Cierra la conexión Oracle
	oci_close($conex);
	$nombre = $resultado[0]['PRIMER_NOMBRE']." ".$resultado[0]['SEGUNDO_NOMBRE']; 
	return $nombre;
}

/* ̈́̈́̈́̈́̈́̈́̈́̈́̈́̈́̈́̈́̈́̈́̈́̈́̈́̈́̈́̈́̈́̈́̈́ ̈́̈́̈́̈́̈́̈́̈́̈́̈́̈́̈́̈́̈́̈́̈́̈́̈́̈́̈́̈́̈́̈́̈́ ̈́̈́̈́̈́̈́̈́̈́̈́̈́̈́̈́̈́̈́̈́̈́̈́̈́̈́̈́̈́̈́̈́̈́*/


function dameJefeOficina($id)
{
	$resultado = false;
	$conex = conectaBaseDatos();
	$consulta = "SELECT * FROM FISC_JEFE_OFICINA WHERE ID_JEFE = :id_jefe";
	$stid = oci_parse($conex, $consulta);
	if (!$stid)
	{
		$e = oci_error($this->conex);
		trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
	}
		// Realizar la lógica de la consulta
	oci_bind_by_name($stid, ':id_jefe', $id);
	$r = oci_execute($stid);
	if (!$r)
	{
		$e = oci_error($stid);
		trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
	}

		// Obtener los resultados de la consulta
	while ($fila = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS))
	{
		$resultado[] = $fila;
	}
		//Libera los recursos
	oci_free_statement($stid);
		// Cierra la conexión Oracle
	oci_close($conex);
	#$nombre = $resultado[0]['PRIMER_NOMBRE']." ".$resultado[0]['SEGUNDO_NOMBRE']; 
	return $resultado;
}

/* ̈́̈́̈́̈́̈́̈́̈́̈́̈́̈́̈́̈́̈́̈́̈́̈́̈́̈́̈́̈́̈́̈́̈́ ̈́̈́̈́̈́̈́̈́̈́̈́̈́̈́̈́̈́̈́̈́̈́̈́̈́̈́̈́̈́̈́̈́̈́ ̈́̈́̈́̈́̈́̈́̈́̈́̈́̈́̈́̈́̈́̈́̈́̈́̈́̈́̈́̈́̈́̈́̈́*/

function dameCiudadano($nac, $id)
{
	if(strlen ($id)<9)
	{
		$ceros = 9-strlen($id);
		$aux = $id;
		$id="";
		for($i=0;$i<$ceros;$i++)
		{
			$id.=0;
		}
		$id.=$aux;
	}
	$id_ciudadano = $nac.$id;

	$resultado = false;
	$conex = conectaBaseDatos();
	$consulta = "SELECT * FROM SIRA.CIUDADANO WHERE ID_CIUDADANO = :id_ciudadano";
	$stid = oci_parse($conex, $consulta);
	if (!$stid)
	{
		$e = oci_error($this->conex);
		trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
	}
		// Realizar la lógica de la consulta
	oci_bind_by_name($stid, ':id_ciudadano', $id_ciudadano);
	$r = oci_execute($stid);
	if (!$r)
	{
		$e = oci_error($stid);
		trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
	}

		// Obtener los resultados de la consulta
	while ($fila = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS))
	{
		$resultado[] = $fila;
	}
		//Libera los recursos
	oci_free_statement($stid);
		// Cierra la conexión Oracle
	oci_close($conex);

	return $resultado;
}

/* ̈́̈́̈́̈́̈́̈́̈́̈́̈́̈́̈́̈́̈́̈́̈́̈́̈́̈́̈́̈́̈́̈́̈́ ̈́̈́̈́̈́̈́̈́̈́̈́̈́̈́̈́̈́̈́̈́̈́̈́̈́̈́̈́̈́̈́̈́̈́ ̈́̈́̈́̈́̈́̈́̈́̈́̈́̈́̈́̈́̈́̈́̈́̈́̈́̈́̈́̈́̈́̈́̈́*/

function dameUsuario($nac, $id){

	$resultado = false;
	$conex = conectaBaseDatos();
	$consulta = "SELECT * FROM FISC_USERS WHERE ID_USER = :id";;
	$stid = oci_parse($conex, $consulta);
	if (!$stid)
	{
		$e = oci_error($this->conex);
		trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
	}
		// Realizar la lógica de la consulta
	oci_bind_by_name($stid, ':id', $id);
	$r = oci_execute($stid);
	if (!$r)
	{
		$e = oci_error($stid);
		trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
	}

		// Obtener los resultados de la consulta
	while ($fila = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS))
	{
		$resultado[] = $fila;
	}
		//Libera los recursos
	oci_free_statement($stid);
		// Cierra la conexión Oracle
	oci_close($conex);

	return $resultado;

}

/* ̈́̈́̈́̈́̈́̈́̈́̈́̈́̈́̈́̈́̈́̈́̈́̈́̈́̈́̈́̈́̈́̈́̈́ ̈́̈́̈́̈́̈́̈́̈́̈́̈́̈́̈́̈́̈́̈́̈́̈́̈́̈́̈́̈́̈́̈́̈́ ̈́̈́̈́̈́̈́̈́̈́̈́̈́̈́̈́̈́̈́̈́̈́̈́̈́̈́̈́̈́̈́̈́̈́*/


function dameEstado(){
	$resultado = false;
	$conex = conectaBaseDatos();
	$stid = oci_parse($conex, "SELECT * FROM ESTADO WHERE (NOMBRE_ESTADO != 'SIN ASIGNAR' AND ID_ESTADO!='DP' AND ID_ESTADO!='DF') ORDER BY NOMBRE_ESTADO");
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

function dameMotivos($id=null){

	$conex = conectaBaseDatos();
	$resultado = false;
	if($id!=null){
		
		$consulta = "SELECT * FROM FISC_MOT_DEN WHERE ID_DENUNCIA = :id ";
		$stid = oci_parse($conex, $consulta);
		oci_bind_by_name($stid,':id', $id);
	}
	else {
		
		$consulta = "SELECT * FROM FISC_MOTIVOS ORDER BY ID_MOTIVO";
		$stid = oci_parse($conex, $consulta);

	}
	
	//$stid = oci_parse($conex, $consulta);
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


function dameNombreMotivos($id=null){

	$conex = conectaBaseDatos();
	$resultado = false;
	if($id!=null){
		
		$consulta = "select DESCRIPCION from fisc_motivos where id_motivo in (select id_motivo from fisc_mot_den where id_denuncia = :id)";
		$stid = oci_parse($conex, $consulta);
		oci_bind_by_name($stid,':id', $id);
	}
	else {
		
		$consulta = "SELECT * FROM FISC_MOTIVOS";
		$stid = oci_parse($conex, $consulta);

	}
	
	//$stid = oci_parse($conex, $consulta);
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



function dameMotivosQuejas(){
	$conex = conectaBaseDatos();
	$resultado = false;
	$consulta = "SELECT * FROM FISC_MOTIVOS_QUEJAS";
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

function documentosConsignadosQuejas($id_queja){
	$sts=1;
	$resultado = false;
	$consulta = "SELECT * FROM FISC_DOCUMENTOS_QUEJAS INNER JOIN FISC_DOC_QUEJAS ON (FISC_DOCUMENTOS_QUEJAS.ID_DOCUMENTO=FISC_DOC_QUEJAS.ID_DOCUMENTO) AND (FISC_DOC_QUEJAS.ID_DENUNCIA=:id) ORDER BY FISC_DOC_QUEJAS.ID_DOCUMENTO";
	$conex = conectaBaseDatos();
	$stid = oci_parse($conex, $consulta);
	if (!$stid){
		$e = oci_error($this->conex);
		trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
	}
		// Realizar la lógica de la consulta
	oci_bind_by_name($stid, ':id', $id_queja);
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
	/*$consulta = "SELECT FISC_DOCUMENTOS.ID_DOCUMENTO, FISC_DOCUMENTOS.DESCRIPCION FROM FISC_DOCUMENTOS INNER JOIN FISC_DOC_DEN ON FISC_DOCUMENTOS.ID_DOCUMENTO != FISC_DOC_DEN.ID_DOCUMENTO and FISC_DOC_DEN.ID_DENUNCIA=:id";*/
	$consulta = "SELECT FISC_DOCUMENTOS.ID_DOCUMENTO,FISC_DOCUMENTOS.DESCRIPCION FROM FISC_DOCUMENTOS 
	LEFT JOIN FISC_DOC_DEN ON 
	FISC_DOC_DEN.ID_DOCUMENTO = FISC_DOCUMENTOS.ID_DOCUMENTO
	AND FISC_DOC_DEN.ID_DENUNCIA = :id
	WHERE FISC_DOC_DEN.ID_DOCUMENTO IS NULL order by FISC_DOCUMENTOS.ID_DOCUMENTO";
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
	$consulta = "SELECT * FROM FISC_DOCUMENTOS WHERE INTBORRADO=0";
	
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


function getDocumentosQuejas(){
	$resultado = false;
	$consulta = "SELECT * FROM FISC_DOCUMENTOS_QUEJAS ORDER BY ID_DOCUMENTO";
	
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

function dameEmpresa($filtro, $valor)
{
	$resultado = false;
	$filtro = strtoupper($filtro);
	$valor = strtoupper($valor);
	//$consulta = "SELECT * FROM EMPRESA WHERE ".$filtro."=:valor";
	//SELECT * FROM SIRA.EMPRESA WHERE NOMBRE_EMPRESA LIKE '%STARVE%';
	$consulta = "SELECT * FROM SIRA.EMPRESA WHERE $filtro LIKE '%$valor%'";
	
	$conex = conectaBaseDatos();
	$stid = oci_parse($conex, $consulta);
	if (!$stid){
		$e = oci_error($this->conex);
		trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
	}
		// Realizar la lógica de la consulta
		//oci_bind_by_name($stid, ':valor', $valor);
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


function dameEmpresasCompletas()
{
	$resultado = false;
	//$filtro = strtoupper($filtro);
	//$valor = strtoupper($valor);
	//$consulta = "SELECT * FROM EMPRESA WHERE ".$filtro."=:valor";
	//SELECT * FROM SIRA.EMPRESA WHERE NOMBRE_EMPRESA LIKE '%STARVE%';
	$consulta = "SELECT * FROM SIRA.EMPRESA";
	
	$conex = conectaBaseDatos();
	$stid = oci_parse($conex, $consulta);
	if (!$stid){
		$e = oci_error($this->conex);
		trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
	}
		// Realizar la lógica de la consulta
		//oci_bind_by_name($stid, ':valor', $valor);
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

function dameDirecciones($ids=null)
{
	$conex = conectaBaseDatos();
	
	if($ids!=null) 
	{
		$consulta = "SELECT * FROM DIRECCIONES_ASIGNACION WHERE INTBORRADO=0";
	}else
	{
		$consulta = "SELECT * FROM DIRECCIONES_GENERALES ORDER BY ID_DIRECCION";
	}

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
function dameDireccionesLinea($id)
{
	$resultado = false;

	$conex = conectaBaseDatos();	
	
	$consulta ="SELECT * FROM DIRECCIONES_LINEA WHERE ID_DIRECCION_GENERAL =:id";
	
	$stid = oci_parse($conex, $consulta);
	if (!$stid){
		$e = oci_error($this->conex);
		trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
	}
		// Realizar la lógica de la consulta
	oci_bind_by_name($stid, ':id', $id);
	$r = oci_execute($stid);
	if (!$r){
		$e = oci_error($stid);
		trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
	}

		// Obtener los resultados de la consulta

	while ($fila = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)){
		$resultado[] = $fila;
	}

	if(count($resultado)==0){
		$resultado = false;
	}


		//Libera los recursos
	oci_free_statement($stid);
		// Cierra la conexión Oracle
	oci_close($conex);
	return $resultado;
}
function ponomep($nombre,$num_pags,$direccion){
	$empresao = new EmpresaDAO();
	$resultado = $empresao->queryByNombre($nombre,$num_pags);
}

function dameRepresentante($id_empresa)
{
	$resultado = false;
	$conex = conectaBaseDatos();
	$consulta = "SELECT * FROM SIRA.CIUDADANO WHERE ID_CIUDADANO IN (SELECT ID_CIUDADANO FROM SIRA.REPRESENTANTE WHERE ID_EMPRESA =:id_empresa)";
	$stid = oci_parse($conex, $consulta);
	if (!$stid){
		$e = oci_error($this->conex);
		trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
	}
		// Realizar la lógica de la consulta
	oci_bind_by_name($stid, ':id_empresa', $id_empresa);
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

function consultarDenuncia($filtro, $valor)
{
	//$resultado = new DenunciaJuridica();
	$filtro = strtoupper($filtro);
	$valor = strtoupper($valor);
	//$consulta = "SELECT * FROM EMPRESA WHERE ".$filtro."=:valor";
	//SELECT * FROM SIRA.EMPRESA WHERE NOMBRE_EMPRESA LIKE '%STARVE%';
	$consulta = "SELECT * FROM FISC_DENUNCIAS_JURIDICAS WHERE $filtro LIKE '%$valor%'";
	
	$conex = conectaBaseDatos();
	$stid = oci_parse($conex, $consulta);
	if (!$stid){
		$e = oci_error($this->conex);
		trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
	}
		// Realizar la lógica de la consulta
		//oci_bind_by_name($stid, ':valor', $valor);
	$r = oci_execute($stid);
	if (!$r){
		$e = oci_error($stid);
		trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
	}

		// Obtener los resultados de la consulta
	$resultado = Array();

	while ($fila = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS))
	{
		$alm = new DenunciaJuridica();
		$it = new ArrayIterator($fila);
		while($it->valid()){
			$alm->__SET(strtolower($it->key()),$it->current());
			$it->next();

		}
		$resultado[] = $alm;
	}


		//Libera los recursos
	oci_free_statement($stid);
		// Cierra la conexión Oracle
	oci_close($conex);
	return $resultado;
}

function dameOficinas($letra)
{
	$consulta = "select o.ID_OFICINA_IVSS, o.NOMBRE_OFICINA, o.CODIGO_OFICINA_CHAR 
	from sira.oficina_ivss o where
	substr(o.CODIGO_OFICINA_CHAR, 1, 1) = (select 
		DISTINCT(e.inicial_numero_empresa) from sira.estado e where 
		e.inicial_numero_empresa = :letra) order by id_oficina_ivss";

$conex = conectaBaseDatos();
$stid = oci_parse($conex, $consulta);
if (!$stid){
	$e = oci_error($this->conex);
	trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}
		// Realizar la lógica de la consulta
oci_bind_by_name($stid, ':letra', $letra);
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

function dameId(){
	$resultado = false;
	$conex = conectaBaseDatos();
	$stid = oci_parse($conex, "SELECT * FROM ID_TABLAS");
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


/*FUNCION PARA AGREGAR EN EL CUERPO DEL CORREO*/


function dameDenunciasCorreo($id)
{
	$resultado = false;
	$conex = conectaBaseDatos();

	$consulta = "SELECT fd.ID_DENUNCIA, fd.ID_CIUDADANO, fd.ID_EMPRESA,
	fd.DESCRIPCION, 
	(SELECT DIRECCION_FISC_EMPRESA FROM FISC_EMPRESA fe WHERE fe.ID_FISC_EMPRESA=fd.ID_EMPRESA) as DIRECCION_EMPRESA,

	(SELECT PUNTO_REF_FISC_EMPRESA FROM FISC_EMPRESA fe WHERE fe.ID_FISC_EMPRESA=fd.ID_EMPRESA) as PUNTO_REF_FISC_EMPRESA
	FROM FISC_DENUNCIAS fd WHERE fd.ID_DENUNCIA = :id";

	$stid = oci_parse($conex, $consulta);

	if (!$stid){
		$e = oci_error($conex);
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
	$fila = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS);

	//Libera los recursos
	oci_free_statement($stid);
		// Cierra la conexión Oracle
	oci_close($conex);

	return $fila;
}


function dameMotivosCorreo($id)
{
	$resultado = "";
	$conex = conectaBaseDatos();

	$consulta = "SELECT *
	FROM  FISC_DENUNCIAS FD
	JOIN  FISC_MOT_DEN FMD ON(FD.ID_DENUNCIA=FMD.ID_DENUNCIA)
	JOIN  FISC_MOTIVOS FM ON (FMD.ID_MOTIVO=FM.ID_MOTIVO)
	WHERE FD.ID_DENUNCIA = :id  ";

	$stid = oci_parse($conex, $consulta);

	if (!$stid){
		$e = oci_error($conex);
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

		$resultado.= utf8_decode($fila['DESCRIPCION'])."<br>";
	}

	//Libera los recursos
	oci_free_statement($stid);
		// Cierra la conexión Oracle
	oci_close($conex);

	return $resultado;
}


function dameMotivosQuejaCadena($id)
{
	$resultado = "";
	$conex = conectaBaseDatos();

	$consulta = "SELECT  fm.DESCRIPCION as DESCRIPCION
	FROM  FISC_DENUNCIAS_JURIDICAS dj
	JOIN  FISC_MOT_QUEJAS fmq ON(dj.ID_DENUNCIA=fmq.ID_DENUNCIA)
	JOIN  FISC_MOTIVOS_QUEJAS fm ON(fm.ID_MOTIVO=fmq.ID_MOTIVO) WHERE dj.ID_DENUNCIA = :id ";

	$stid = oci_parse($conex, $consulta);

	if (!$stid){
		$e = oci_error($conex);
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

		$resultado.= "<li>".($fila['DESCRIPCION'])."</li><br>";
	}

	//Libera los recursos
	oci_free_statement($stid);
		// Cierra la conexión Oracle
	oci_close($conex);

	return $resultado;
}



/*
	llamado a la vista
*/
	function dameDenunciasEspecificas()
	{
		$resultado = false;
		$conex = conectaBaseDatos();
		$stid = oci_parse($conex, "SELECT * FROM REPORTES_DENUNCIAS WHERE ROWNUM <=10 ORDER BY FECHA_DENUNCIA DESC");
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

	/*
	llamado al filtro de denuncias
	*/
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


	function dameQuejasProceso()
	{
		$resultado = false;
		$conex = conectaBaseDatos();
		$stid = oci_parse($conex, "SELECT * FROM FISC_DENUNCIAS_JURIDICAS WHERE ASIGNADA = 0");
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

	function dameQuejasDescripcion($id)
	{
		$resultado = false;
		$conex = conectaBaseDatos();
		$stid = oci_parse($conex, "SELECT DESCRIPCION FROM  FISC_MOTIVOS_QUEJAS WHERE ID_MOTIVO IN (SELECT ID_MOTIVO FROM  FISC_MOT_QUEJAS WHERE ID_DENUNCIA=:id)");
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

	function dameQuejasPanelReporte()
	{
		$resultado = false;
		$conex = conectaBaseDatos();
		$stid = oci_parse($conex, "SELECT * FROM FISC_DENUNCIAS_JURIDICAS dj WHERE ROWNUM <=10 ORDER BY dj.FECHA_DENUNCIA DESC");

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

	function dameMotivosQuejasDescripcion()
	{
		$resultado = false;
		$conex = conectaBaseDatos();
		$stid = oci_parse($conex, "SELECT * FROM FISC_MOTIVOS_QUEJAS");

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


	function dameUsuarios($cedula)
	{
		$resultado = false;
		$conex = conectaBaseDatos();
		$stid = oci_parse($conex, "select * from  fisc_users where id_user='$cedula'");
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


	function dameUsuario_correo($cedula)
	{
		$resultado = false;
		$conex = conectaBaseDatos();
		$stid = oci_parse($conex, "select * from  fisc_users where id_user='$cedula'");
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

	function dameArchivosDenuncia($id_denuncia){
		$resultado = false;
		$consulta = "SELECT * FROM TBL_ARCHIVOS_DENUNCIAS WHERE ID_DENUNCIA=:id";

		$conex = conectaBaseDatos();
		$stid = oci_parse($conex, $consulta);
		if (!$stid){

			$e = oci_error($this->conex);
			trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
			oci_free_statement($stid);
		// Cierra la conexión Oracle
			oci_close($conex);
		}
		// Realizar la lógica de la consulta
		oci_bind_by_name($stid, ':id', $id_denuncia);
		$r = oci_execute($stid);
		if (!$r){

			$e = oci_error($stid);
			trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
			oci_free_statement($stid);
		// Cierra la conexión Oracle
			oci_close($conex);
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

	function dameArchivosQueja($id_queja){
		$consulta = "SELECT * FROM TBL_ARCHIVOS_QUEJAS WHERE ID_QUEJA=:id";
		$resultado = false;
		$conex = conectaBaseDatos();
		$stid = oci_parse($conex, $consulta);
		if (!$stid){

			$e = oci_error($this->conex);
			trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
			oci_free_statement($stid);
		// Cierra la conexión Oracle
			oci_close($conex);
		}
		// Realizar la lógica de la consulta
		oci_bind_by_name($stid, ':id', $id_queja);
		$r = oci_execute($stid);
		if (!$r){

			$e = oci_error($stid);
			trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
			oci_free_statement($stid);
		// Cierra la conexión Oracle
			oci_close($conex);
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



	function dameDireccionesAsignacion($id_denuncia)
	{
		$consulta = "SELECT A.FECHA_ASIGNACION, (SELECT NOMBRE FROM DIRECCIONES_ASIGNACION WHERE ID_DIRECCION = A.INT_ID_DIRECCION) AS NOMBRE FROM TBLASIGNACIONDENUNCIAS A WHERE A.STR_ID_DENUNCIA = :id";
		$resultado = false;
		$conex = conectaBaseDatos();
		$stid = oci_parse($conex, $consulta);
		if (!$stid){

			$e = oci_error($this->conex);
			trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
			oci_free_statement($stid);
		// Cierra la conexión Oracle
			oci_close($conex);
		}
		// Realizar la lógica de la consulta
		oci_bind_by_name($stid, ':id', $id_denuncia);
		$r = oci_execute($stid);
		if (!$r){

			$e = oci_error($stid);
			trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
			oci_free_statement($stid);
		// Cierra la conexión Oracle
			oci_close($conex);
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

	function dameDireccionesAsignacionQueja($id_denuncia)
	{
		$consulta = "SELECT A.FECHA_ASIGNACION, (SELECT NOMBRE FROM DIRECCIONES_ASIGNACION WHERE ID_DIRECCION = A.INT_ID_DIRECCION) AS NOMBRE FROM TBL_ASIGNACIONQUEJA A WHERE A.STR_ID_DENUNCIA = :id";
		$resultado = false;
		$conex = conectaBaseDatos();
		$stid = oci_parse($conex, $consulta);
		if (!$stid){

			$e = oci_error($this->conex);
			trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
			oci_free_statement($stid);
		// Cierra la conexión Oracle
			oci_close($conex);
		}
		// Realizar la lógica de la consulta
		oci_bind_by_name($stid, ':id', $id_denuncia);
		$r = oci_execute($stid);
		if (!$r){

			$e = oci_error($stid);
			trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
			oci_free_statement($stid);
		// Cierra la conexión Oracle
			oci_close($conex);
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

	function dameRoles(){
		$consulta = "SELECT * FROM TBL_ROLES";
		$resultado = false;
		$conex = conectaBaseDatos();
		$stid = oci_parse($conex, $consulta);
		if (!$stid){

			$e = oci_error($this->conex);
			trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
			oci_free_statement($stid);
		// Cierra la conexión Oracle
			oci_close($conex);
		}
		// Realizar la lógica de la consulta
		$r = oci_execute($stid);
		if (!$r){

			$e = oci_error($stid);
			trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
			oci_free_statement($stid);
		// Cierra la conexión Oracle
			oci_close($conex);
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
