<?php
class EstatusDenunciaDAO
{
	private $conex;
	 
	//Constructor NO PDO para uso con orcl_conex.php
	public function __construct(){
			
		}
	public function listar() 
	{	
		$this->conex = DataBase::getInstance();
		// Preparar la sentencia
		$stid = oci_parse($this->conex, "SELECT * FROM FISC_ESTATUS_DENUNCIA");
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
	public function getById($id_sts)
	{	
		$this->conex = DataBase::getInstance();
		$stid = oci_parse($this->conex, "SELECT * FROM FISC_ESTATUS_DENUNCIA WHERE ID_ESTATUS=:id_sts");
		if (!$stid){
    		$e = oci_error($this->conex);
    		trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
		}
		// Realizar la lógica de la consulta
		oci_bind_by_name($stid, ':id_sts', $id_sts);
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
	
	public function eliminar($id_sts)
	{
		$this->conex = DataBase::getInstance();
		$consulta = "DELETE FROM FISC_ESTATUS_DENUNCIA WHERE ID_ESTATUS = :id_sts";
		$stid_del_mot = oci_parse($this->conex, $consulta);
		if (!$stid_del_mot){
    		//$e = oci_error($this->conex);
    		//trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
			//Libera los recursos
			oci_free_statement($stid_del_mot);
			// Cierra la conexión Oracle
			oci_close($this->conex);
			return false;
		}
		// Realizar la lógica de la consulta
		oci_bind_by_name($stid_del_mot, ':id_sts', $id_sts);
		$exec_del_mot = oci_execute($stid_del_mot, OCI_NO_AUTO_COMMIT);
		if (!$exec_del_mot)
		{
    		//$e = oci_error($stid);
    		//trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
			//Libera los recursos
			oci_free_statement($stid_del_mot);
			// Cierra la conexión Oracle
			oci_close($this->conex);
			return false;
		}

		$r = oci_commit($this->conex);
		if(!$r)
		{
			oci_free_statement($stid_del_mot);
			oci_close($this->conex);
			return false;

		}
		//Libera los recursos
		oci_free_statement($stid_del_mot);
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
		$id_sts=$data->__GET('id_estatus');
		$descripcion = $data->__GET('descripcion');

		$this->conex = DataBase::getInstance();
		$stid = oci_parse($this->conex, "UPDATE FISC_ESTATUS_DENUNCIA SET 
						descripcion=:descripcion
				    WHERE id_estatus=:id_sts");
		if (!$stid)
		{
			oci_free_statement($stid);
			oci_close($this->conex);
			return false;
		}

		// Realizar la lógica de la consulta
		oci_bind_by_name($stid, ':descripcion', $descripcion);
		oci_bind_by_name($stid, ':id_sts', $id_sts);

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
public function agregar(&$estatus)
{	
	$this->conex  = DataBase::getInstance();
		foreach($estatus as $est)
		{
			$consulta = "INSERT INTO FISC_ESTATUS_DENUNCIA (
			ID_ESTATUS, 
 			DESCRIPCION)
			values
			(
				:id_sts,
				:descripcion
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
			$id_sts        = $est->__GET('id_estatus');
			$descripcion   = $est->__GET('descripcion');
			oci_bind_by_name($stid, ':id_sts', $id_sts);
			oci_bind_by_name($stid, ':descripcion', $descripcion);
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

		//Actualizar el próximo id_estatus en la tabla ID_TABLAS
		/*********************************************************/
		$upd_estatus = "UPDATE ID_TABLAS SET 
						ESTATUS_DENUNCIA=:estatus";
		$stid_estatus = oci_parse($this->conex, $upd_estatus);
		if (!$stid_estatus)
		{
			oci_free_statement($stid_estatus);
			oci_rollback($this->conex);
			oci_close($this->conex);
			return false;
		}

		// Realizar la lógica de la consulta
		$id_estatus = $id_sts + 1;
		oci_bind_by_name($stid_estatus, ':estatus', $id_estatus);

		$r = oci_execute($stid_estatus, OCI_NO_AUTO_COMMIT);
		if (!$r)
		{
			oci_free_statement($stid_estatus);
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
