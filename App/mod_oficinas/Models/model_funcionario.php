<?php
class FuncionarioDAO
{
	private $conex;

	//Constructor NO PDO para uso con orcl_conex.php
	public function __construct(){

	}
	public function listar() 
	{	
		$this->conex = DataBase::getInstance();
		// Preparar la sentencia
		$stid = oci_parse($this->conex, "SELECT * FROM FISC_FUNCIONARIO_OFICINA");
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
			$alm = new Denuncia();
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
	
	/**
	*
	*@param $id_ciu
	*
	*
	**/
	public function getById($id_funcionario)
	{	
		$this->conex = DataBase::getInstance();
		$stid = oci_parse($this->conex, "SELECT * FROM FISC_FUNCIONARIO_OFICINA WHERE ID_FUNCIONARIO=:id_funcionario");
		if (!$stid){
			$e = oci_error($this->conex);
			trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
		}
		// Realizar la lógica de la consulta
		oci_bind_by_name($stid, ':id_funcionario', $id_funcionario);
		$r = oci_execute($stid);
		if (!$r){
			$e = oci_error($stid);
			trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
		}

		$result = array();

		// Obtener los resultados de la consulta
		while ($fila = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)){
			$it = new ArrayIterator($fila);
			$alm = new Denuncia();
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
	
	public function eliminar($id_funcionario)
	{
		$this->conex = DataBase::getInstance();
		$consulta = "DELETE FROM FISC_FUNCIONARIO_OFICINA WHERE ID_funcionario = :id_funcionario";
		$stid= oci_parse($this->conex, $consulta);
		if (!$stid){
    		//$e = oci_error($this->conex);
    		//trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
			//Libera los recursos
			oci_free_statement($stid);
			// Cierra la conexión Oracle
			oci_close($this->conex);
			return false;
		}
		// Realizar la lógica de la consulta
		oci_bind_by_name($stid, ':id_funcionario', $id_funcionario);
		$exec = oci_execute($stid, OCI_NO_AUTO_COMMIT);
		if (!$exec)
		{
    		//$e = oci_error($stid);
    		//trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
			//Libera los recursos
			oci_free_statement($stid);
			// Cierra la conexión Oracle
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
		//Libera los recursos
		oci_free_statement($stid);
		// Cierra la conexión Oracle
		oci_close($this->conex);
		return true;
	}

	/**
	*
	*
	**/
	public function actualizar(&$funcionario)
	{
		$id_funcionario=$funcionario->__GET('id_funcionario');
		$descripcion = $data->__GET('');

		$this->conex = DataBase::getInstance();
		$stid = oci_parse($this->conex, "UPDATE FISC_FUNCIONARIO_OFICINA SET 
			descripcion=:descripcion
			WHERE id_motivo=:id_mot");
		if (!$stid)
		{
			oci_free_statement($stid);
			oci_close($this->conex);
			return false;
		}

		// Realizar la lógica de la consulta
		oci_bind_by_name($stid, ':descripcion', $descripcion);
		oci_bind_by_name($stid, ':id_mot', $id_mot);

		$r = oci_execute($stid, OCI_NO_AUTO_COMMIT);
		if (!$r)
		{
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
	public function agregar(&$funcionario)
	{	
		$this->conex  = DataBase::getInstance();
		$consulta = "INSERT INTO FISC_FUNCIONARIO_OFICINA (
			ID_FUNCIONARIO, 
			ID_OFICINA,
			NACIONALIDAD,
			PRIMER_NOMBRE,
			SEGUNDO_NOMBRE,
			PRIMER_APELLIDO,
			SEGUNDO_APELLIDO,
			CARGO
			)
values
(
	:id_funcionario,
	:id_oficina,
	:nacionalidad,
	:primer_nombre,
	:segundo_nombre,
	:primer_apellido,
	:segundo_apellido,
	:cargo
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

$id_funcionario     = $funcionario->__GET('id_funcionario');
$id_oficina         = $funcionario->__GET('id_oficina');
$nacionalidad       = $funcionario->__GET('nacionalidad');
$primer_nombre      = $funcionario->__GET('primer_nombre');
$segundo_nombre     = $funcionario->__GET('segundo_nombre');
$primer_apellido    = $funcionario->__GET('primer_apellido');
$segundo_apellido   = $funcionario->__GET('segundo_apellido');
		//$codigo_funcionario = $funcionario->__GET('codigo_funcionario');
$cargo              = $funcionario->__GET('cargo');

oci_bind_by_name($stid, ':id_funcionario', $id_funcionario);
oci_bind_by_name($stid, ':id_oficina', $id_oficina);
oci_bind_by_name($stid, ':nacionalidad', $nacionalidad);
oci_bind_by_name($stid, ':primer_nombre', $primer_nombre);
oci_bind_by_name($stid, ':segundo_nombre', $segundo_nombre);
oci_bind_by_name($stid, ':primer_apellido', $primer_apellido);
oci_bind_by_name($stid, ':segundo_apellido', $segundo_apellido);
//oci_bind_by_name($stid, ':codigo_funcionario', $codigo_funcionario);
oci_bind_by_name($stid, ':cargo', $cargo);

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
