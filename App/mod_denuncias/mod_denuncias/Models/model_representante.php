<?php
class RepresentanteDAO
{
	private $conex;

	//Constructor NO PDO para uso con orcl_conex.php
	public function __construct(){

	}

	public function listar()
	{	
		$this->conex = DataBase::getInstance();
		// Preparar la sentencia
		$stid = oci_parse($this->conex, "SELECT * FROM TBL_REPRESENTANTEEMPRESAS");
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
			$alm = new RepresentanteEmpresa();
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
	public function queryByIC($id_ciu)
	{	
		$this->conex = DataBase::getInstance();
		$stid = oci_parse($this->conex, "SELECT * FROM TBL_REPRESENTANTEEMPRESAS WHERE CLV_REPRESENTANTE=:id_ciu");
		if (!$stid){
			$e = oci_error($this->conex);
			trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
		}
		// Realizar la lógica de la consulta
		oci_bind_by_name($stid, ':id_ciu', $id_ciu);
		$r = oci_execute($stid);
		if (!$r){
			$e = oci_error($stid);
			trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
		}

		$result = new RepresentanteEmpresa();;

		// Obtener los resultados de la consulta
		while ($fila = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)){
			$it = new ArrayIterator($fila);
			while($it->valid()){
				$result->__SET(strtolower($it->key()),$it->current());
				$it->next();
			}
		}
		//Libera los recursos
		oci_free_statement($stid);
		// Cierra la conexión Oracle
		oci_close($this->conex);
		//retorna el resultado de la consulta
		return $result;
	}
	
	public function eliminar($id)
	{
		$this->conex = DataBase::getInstance();
		$consulta = "DELETE FROM TBL_REPRESENTANTEEMPRESAS WHERE CLV_REPRESENTANTE = :id";
		$stid_del_den = oci_parse($this->conex, $consulta);
		if (!$stid_del_den){
    		//$e = oci_error($this->conex);
    		//trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
			//Libera los recursos
			oci_free_statement($stid_del_den);
			// Cierra la conexión Oracle
			oci_close($this->conex);
			return false;
		}
		// Realizar la lógica de la consulta
		oci_bind_by_name($stid_del_den, ':id', $id);
		$exec_del_den = oci_execute($stid_del_den, OCI_NO_AUTO_COMMIT);
		if (!$exec_del_den){
    		//$e = oci_error($stid);
    		//trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
			//Libera los recursos
			oci_free_statement($stid_del_den);
			// Cierra la conexión Oracle
			oci_close($this->conex);
			return false;
		}

		$r = oci_commit($this->conex);
		if(!$r) 
		{
			return false;

		}
		//Libera los recursos
		oci_free_statement($stid_del_den);
		oci_free_statement($stid_del_doc);
		// Cierra la conexión Oracle
		oci_close($this->conex);
		return true;
	}

	public function registrar(&$data)
	{
		
		$this->conex  = DataBase::getInstance();
		
		$insertciu = "INSERT INTO TBL_REPRESENTANTEEMPRESAS (
			CLV_REPRESENTANTE,
			STR_NOMBRES,
			STR_APELLIDOS,
			STR_TELEFONO1,
			STR_TELEFONO2,
			STR_EMAIL,
			STR_DIRECCION)
values
(
	:clv_representante,
	:str_nombres,
	:str_apellidos,
	:str_telefono1,
	:str_telefono2,
	:str_email,
	:str_direccion
	)";

$stci = oci_parse($this->conex, $insertciu);
if(!$stci)
{
	echo "Desde el parse 1";
	$er = oci_error($this->conex);
	trigger_error(htmlentities($er['message'], ENT_QUOTES), E_USER_ERROR);
				//Libera los recursos
	oci_free_statement($stci);
				// Cierra la conexión Oracle
	oci_close($this->conex);
	return false;  
}

$clv_representante= $data->__GET('clv_representante');
$str_nombres= $data->__GET('str_nombres');
$str_apellidos= $data->__GET('str_apellidos');
$str_telefono1= $data->__GET('str_telefono1');
$str_telefono2= $data->__GET('str_telefono2');
$str_email= $data->__GET('str_email');
$str_direccion= $data->__GET('str_direccion');

oci_bind_by_name($stci, ':clv_representante', $clv_representante);
oci_bind_by_name($stci, ':str_nombres', $str_nombres);
oci_bind_by_name($stci, ':str_apellidos', $str_apellidos);
oci_bind_by_name($stci, ':str_telefono1', $str_telefono1);
oci_bind_by_name($stci, ':str_telefono2', $str_telefono2);
oci_bind_by_name($stci, ':str_email', $str_email);
oci_bind_by_name($stci, ':str_direccion', $str_direccion);

$result_inserciu = oci_execute($stci, OCI_NO_AUTO_COMMIT);
if (!$result_inserciu)
{
	$erciu = oci_error($this->conex);
	trigger_error(htmlentities($erciu['message'], ENT_QUOTES), E_USER_ERROR);
    			//Revertimos los cambios
				//oci_rollback($this->conex);
				//Libera los recursos
	oci_free_statement($stci);
				// Cierra la conexión Oracle
	oci_close($this->conex);
	return false;
}

$r = oci_commit($this->conex);
if(!$r) 
{
	return false;

}
		// Cierra la conexión Oracle
oci_close($this->conex);
return true;
}


}
