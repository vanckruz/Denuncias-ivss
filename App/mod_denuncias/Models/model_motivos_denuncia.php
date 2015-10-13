<?php
class MotivoDenunciaDAO
{
	private $conex;
	 
	//Constructor NO PDO para uso con orcl_conex.php
	public function __construct(){
			
		}
	public function listar() 
	{	
		$this->conex = DataBase::getInstance();
		// Preparar la sentencia
		$stid = oci_parse($this->conex, "SELECT * FROM FISC_MOTIVOS");
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
	public function getById($id_mot)
	{	
		$this->conex = DataBase::getInstance();
		$stid = oci_parse($this->conex, "SELECT * FROM FISC_MOTIVOS WHERE ID_MOTIVO=:id_mot");
		if (!$stid){
    		$e = oci_error($this->conex);
    		trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
		}
		// Realizar la lógica de la consulta
		oci_bind_by_name($stid, ':id_mot', $id_mot);
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
	
	public function eliminar($id_mot)
	{
		$this->conex = DataBase::getInstance();
		$consulta = "DELETE FROM FISC_MOTIVOS WHERE ID_MOTIVO = :id_mot";
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
		oci_bind_by_name($stid_del_mot, ':id_mot', $id_mot);
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
	public function actualizar(MotivoDenuncia $data)
	{
		$id_mot=$data->__GET('id_motivo');
		$descripcion = $data->__GET('descripcion');

		$this->conex = DataBase::getInstance();
		$stid = oci_parse($this->conex, "UPDATE FISC_MOTIVOS SET 
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
public function agregar(&$motivos)
{	
	$this->conex  = DataBase::getInstance();
		foreach($motivos as $motivo)
		{

			//echo $motivo->__GET('descripcion');
			$consulta = "INSERT INTO FISC_MOTIVOS (
			ID_MOTIVO, 
 			DESCRIPCION)
			values
			(
				:id_mot,
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
			$id_mot        = $motivo->__GET('id_motivo');
			$descripcion   = $motivo->__GET('descripcion');
			oci_bind_by_name($stid, ':id_mot', $id_mot);
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

		//Actualizar el próximo id_documento en la tabla ID_TABLAS
		/*********************************************************/
		$upd_motivo = "UPDATE ID_TABLAS SET 
						MOTIVO_DENUNCIA=:motivo";
		$stid_motivo = oci_parse($this->conex, $upd_motivo);
		if (!$stid_motivo)
		{
			oci_free_statement($stid_motivo);
			oci_rollback($this->conex);
			oci_close($this->conex);
			return false;
		}

		// Realizar la lógica de la consulta
		$id_motivo = $id_mot + 1;
		oci_bind_by_name($stid_motivo, ':motivo', $id_motivo);

		$r = oci_execute($stid_motivo, OCI_NO_AUTO_COMMIT);
		if (!$r)
		{
			oci_free_statement($stid_motivo);
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
