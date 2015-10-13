<?php
class DireccionesAsignacionDAO
{
	private $conex;

	//Constructor NO PDO para uso con orcl_conex.php
	public function __construct(){

	}
	/*
	public function listar() 
	{	
		$this->conex = DataBase::getInstance();
		// Preparar la sentencia
		$stid = oci_parse($this->conex, "SELECT * FROM DIRECCIONES_ASIGNACION");
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

		$result = array();

		// Obtener los resultados de la consulta
		while ($fila = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)){
			$it = new ArrayIterator($fila);
			$alm = new DireccionesAsignacion();
			while($it->valid()){
				$alm->__SET(strtolower($it->key()),$it->current());
				$it->next();
			}
			$result[] = $alm;
		}
		//Libera los recursos
		oci_free_statement($stid);
		// Cierra la conexión Oracle
		oci_close($this->conex);
		//retorna el resultado de la consulta
		return $result;
	}
	*/

	public function getAsignadasdenuncias($id_direccion)
	{	
		$this->conex = DataBase::getInstance();
		$stid = oci_parse($this->conex, "SELECT count(*) as ASIGNADA FROM TBLASIGNACIONDENUNCIAS WHERE INT_ID_DIRECCION=:id_direccion");
		if (!$stid){
			$e = oci_error($this->conex);
			trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
		}
		// Realizar la lógica de la consulta
		oci_bind_by_name($stid, ':id_direccion', $id_direccion);
		$r = oci_execute($stid);
		if (!$r){
			$e = oci_error($stid);
			trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
		}

		// Obtener los resultados de la consulta
		$result = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS);
		//Libera los recursos
		oci_free_statement($stid);
		// Cierra la conexión Oracle
		oci_close($this->conex);
		//retorna el resultado de la consulta
		return $result['ASIGNADA'];
	}

	public function getAsignadasQuejas($id_direccion)
	{	
		$this->conex = DataBase::getInstance();
		$stid = oci_parse($this->conex, "SELECT count(*) as ASIGNADA FROM TBL_ASIGNACIONQUEJA WHERE INT_ID_DIRECCION=:id_direccion");
		if (!$stid){
			$e = oci_error($this->conex);
			trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
		}
		// Realizar la lógica de la consulta
		oci_bind_by_name($stid, ':id_direccion', $id_direccion);
		$r = oci_execute($stid);
		if (!$r){
			$e = oci_error($stid);
			trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
		}


		// Obtener los resultados de la consulta
		$result = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS);
		//Libera los recursos
		oci_free_statement($stid);
		// Cierra la conexión Oracle
		oci_close($this->conex);
		//retorna el resultado de la consulta
		return $result['ASIGNADA'];
	}


	public function getById($id_direccion)
	{	
		$this->conex = DataBase::getInstance();
		$stid = oci_parse($this->conex, "SELECT * FROM DIRECCIONES_ASIGNACION WHERE ID_DIRECCION=:id_direccion");
		if (!$stid){
			$e = oci_error($this->conex);
			trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
		}
		// Realizar la lógica de la consulta
		oci_bind_by_name($stid, ':id_direccion', $id_direccion);
		$r = oci_execute($stid);
		if (!$r){
			$e = oci_error($stid);
			trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
		}

		$result = array();

		// Obtener los resultados de la consulta
		while ($fila = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)){
			$it = new ArrayIterator($fila);
			$alm = new DireccionesAsignacion();
			while($it->valid()){
				$alm->__SET(strtolower($it->key()),$it->current());
				$it->next();
			}
			$result[] = $alm;
		}
		//Libera los recursos
		oci_free_statement($stid);
		// Cierra la conexión Oracle
		oci_close($this->conex);
		//retorna el resultado de la consulta
		return $result;
	}
	
	public function eliminar($id_direccion)
	{
		$this->conex = DataBase::getInstance();
		$consulta = "UPDATE DIRECCIONES_ASIGNACION SET
		INTBORRADO=:borrado
		WHERE id_direccion=:id_direccion";
		$stid_del_direccion = oci_parse($this->conex, $consulta);
		if (!$stid_del_direccion){
    		//$e = oci_error($this->conex);
    		//trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
			//Libera los recursos
			oci_free_statement($stid_del_direccion);
			// Cierra la conexión Oracle
			oci_close($this->conex);
			return false;
		}
		// Realizar la lógica de la consulta
		$borrado = 1;
		oci_bind_by_name($stid_del_direccion, ':borrado', $borrado);
		oci_bind_by_name($stid_del_direccion, ':id_direccion', $id_direccion);
		$exec_del_dir = oci_execute($stid_del_direccion, OCI_NO_AUTO_COMMIT);
		if (!$exec_del_dir)
		{
    		//$e = oci_error($stid);
    		//trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
			//Libera los recursos
			oci_free_statement($stid_del_direccion);
			// Cierra la conexión Oracle
			oci_close($this->conex);
			return false;
		}

		$r = oci_commit($this->conex);
		if(!$r)
		{
			oci_free_statement($stid_del_direccion);
			oci_close($this->conex);
			return false;

		}
		//Libera los recursos
		oci_free_statement($stid_del_direccion);
		// Cierra la conexión Oracle
		oci_close($this->conex);
		return true;
	}

	/**
	*
	*
	**/
	public function actualizar(&$data)
	{
		$id_direccion = $data->__GET('id_direccion');
		$nombre       = $data->__GET('nombre');
		$correo       = $data->__GET('correo');


		$this->conex = DataBase::getInstance();
		$stid = oci_parse($this->conex, "UPDATE DIRECCIONES_ASIGNACION SET 
			nombre=:nombre,
			correo=:correo
			WHERE id_direccion=:id_direccion");
		
		if (!$stid)
		{
			$e = oci_error($stid);
			trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
			oci_free_statement($stid);
			oci_close($this->conex);
			return false;
		}

		// Realizar la lógica de la consulta
		oci_bind_by_name($stid, ':nombre', $nombre);
		oci_bind_by_name($stid, ':correo', $correo);
		oci_bind_by_name($stid, ':id_direccion', $id_direccion);

		$r = oci_execute($stid, OCI_NO_AUTO_COMMIT);
		if (!$r)
		{
			$e = oci_error($stid);
			trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
			oci_free_statement($stid);
			oci_close($this->conex);
			return false;
		}

		$r = oci_commit($this->conex);
		if(!$r)
		{
			oci_free_statement($stid);
			oci_close($this->conex);
			return false;

		}
		oci_free_statement($stid);
		// Cierra la conexión Oracle
		oci_close($this->conex);
		return true;
	}
	/**
	* 
	*
	**/
	public function agregar(&$direcciones)
	{	
		$this->conex  = DataBase::getInstance();

		foreach($direcciones as $direccion)
		{

			//echo $documento->__GET('descripcion');
			$consulta = "INSERT INTO DIRECCIONES_ASIGNACION (
				id_direccion, 
				nombre,
				correo)
values
(
	:id_direccion,
	:nombre,
	:correo
	)";
$stid = oci_parse($this->conex, $consulta);

if (!$stid)
{
	echo "Desde el parse 3";
	$e = oci_error($this->conex);
	trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
	oci_rollback($this->conex);
    			//$error = true;
    			//self::eliminar($id_den);
    			//$e = oci_error($this->conex);
    			//trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
				//Libera los recursos
	oci_free_statement($stid);
				// Cierra la conexión Oracle
	oci_close($this->conex);
	return false;
}
$id_direccion        = $direccion->__GET('id_direccion');
$nombre   = $direccion->__GET('nombre');
$correo   = $direccion->__GET('correo');
oci_bind_by_name($stid, ':id_direccion', $id_direccion);
oci_bind_by_name($stid, ':nombre', $nombre);
oci_bind_by_name($stid, ':correo', $correo);
$r = oci_execute($stid, OCI_NO_AUTO_COMMIT);
if (!$r)
{
	echo "Desde el execute 3";
	$e = oci_error($this->conex);
	trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
				//$error = true;
    			//self::eliminar($id_den);
	oci_rollback($this->conex);
    			//$e = oci_error($stid);
    			//trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
				//Libera los recursos
	oci_free_statement($stid);
				// Cierra la conexión Oracle
	oci_close($this->conex);
	return false;
}

		//Actualizar el próximo id_documento en la tabla ID_TABLAS
/*********************************************************/
$upd_direccion = "UPDATE ID_TABLAS SET 
DIRECCION_ASIGNACION=:direccion";
$stid_direccion = oci_parse($this->conex, $upd_direccion);
if (!$stid_direccion)
{
	oci_free_statement($stid_direccion);
	oci_rollback($this->conex);
	oci_close($this->conex);
	return false;
}

		// Realizar la lógica de la consulta
$id_direccion = $id_direccion + 1;
oci_bind_by_name($stid_direccion, ':direccion', $id_direccion);

$r = oci_execute($stid_direccion, OCI_NO_AUTO_COMMIT);
if (!$r)
{
	oci_free_statement($stid_direccion);
	oci_rollback($this->conex);
	oci_close($this->conex);
	return false;
}
/*********************************************************/

		}//END FOREACH
		
		$r = oci_commit($this->conex);
		if(!$r) 
		{
			oci_free_statement($stid);
			oci_close($this->conex);
			return false;
		}
		oci_free_statement($stid);
		// Cierra la conexión Oracle
		oci_close($this->conex);
		return true;
	}
}
