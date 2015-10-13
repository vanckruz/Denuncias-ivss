<?php
class DocumentoQuejaDAO
{
	private $conex;
	 
	//Constructor NO PDO para uso con orcl_conex.php
	public function __construct(){
			
		}

	public function listar() 
	{	
		$this->conex = DataBase::getInstance();
		// Preparar la sentencia
		$stid = oci_parse($this->conex, "SELECT * FROM FISC_DOCUMENTOS_QUEJAS");
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
	public function getById($id_doc)
	{	
		$this->conex = DataBase::getInstance();
		$stid = oci_parse($this->conex, "SELECT * FROM FISC_DOCUMENTOS_QUEJAS WHERE ID_DOCUMENTO=:id_doc");
		if (!$stid){
    		$e = oci_error($this->conex);
    		trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
		}
		// Realizar la lógica de la consulta
		oci_bind_by_name($stid, ':id_doc', $id_doc);
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
	
	public function eliminar($id_doc)
	{
		$this->conex = DataBase::getInstance();
		$consulta = "DELETE FROM FISC_DOCUMENTOS_QUEJAS WHERE ID_DOCUMENTO = :id_doc";
		$stid_del_doc = oci_parse($this->conex, $consulta);
		if (!$stid_del_doc){
    		//$e = oci_error($this->conex);
    		//trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
			//Libera los recursos
			oci_free_statement($stid_del_doc);
			// Cierra la conexión Oracle
			oci_close($this->conex);
			return false;
		}
		// Realizar la lógica de la consulta
		oci_bind_by_name($stid_del_doc, ':id_doc', $id_doc);
		$exec_del_den = oci_execute($stid_del_doc, OCI_NO_AUTO_COMMIT);
		if (!$exec_del_den){
    		//$e = oci_error($stid);
    		//trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
			//Libera los recursos
			oci_free_statement($stid_del_doc);
			// Cierra la conexión Oracle
			oci_close($this->conex);
			return false;
		}

		$r = oci_commit($this->conex);
		if(!$r)
		{
			oci_free_statement($stid_del_doc);
			oci_close($this->conex);
			return false;
		}
		
		//Libera los recursos
		oci_free_statement($stid_del_doc);
		// Cierra la conexión Oracle
		oci_close($this->conex);
		return true;
	}

	/**
	*
	*
	**/
	public function editar(&$documento)
	{
		$id_doc      = $documento->__GET('id_documento');
		$descripcion = $documento->__GET('descripcion');

		$this->conex = DataBase::getInstance();
		$stid = oci_parse($this->conex, "UPDATE FISC_DOCUMENTOS_QUEJAS SET 
						descripcion=:descripcion
				    WHERE id_documento=:id_doc");
		if (!$stid)
		{
			oci_free_statement($stid);
			oci_close($this->conex);
			return false;
		}

		// Realizar la lógica de la consulta
		oci_bind_by_name($stid, ':descripcion', $descripcion);
		oci_bind_by_name($stid, ':id_doc', $id_doc);

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
public function agregar(&$documento)
{
	$this->conex  = DataBase::getInstance();
	$consulta = "INSERT INTO FISC_DOCUMENTOS_QUEJAS (
			ID_DOCUMENTO, 
 			DESCRIPCION)
			values
			(
				:id_doc,
				:descripcion
			)";

			$stid = oci_parse($this->conex, $consulta);
			if(!$stid)
			{
				echo "Desde el parse 1";
				$e = oci_error($this->conex);
    			trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
				//Libera los recursos
				oci_free_statement($stid);
				// Cierra la conexión Oracle
				oci_close($this->conex);
				return false;  
			}

			$id_doc        = $documento->__GET('id_documento');
			$descripcion   = $documento->__GET('descripcion');
			oci_bind_by_name($stid, ':id_doc', $id_doc);
			oci_bind_by_name($stid, ':descripcion', $descripcion);
			$r = oci_execute($stid, OCI_NO_AUTO_COMMIT);
			if (!$r)
			{
				echo "Desde el execute 1";
				$e = oci_error($this->conex);
    			trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
    			//Revertimos los cambios
				//oci_rollback($this->conex);
				//Libera los recursos
				oci_free_statement($stid);
				// Cierra la conexión Oracle
				oci_close($this->conex);
				return false;
			}

	//Actualizar el próximo id_documento en la tabla ID_TABLAS
	/*********************************************************/
		$upd_documento = "UPDATE ID_TABLAS SET 
						DOCUMENTO_QUEJA=:documento";
		$stid_documento = oci_parse($this->conex, $upd_documento);
		if (!$stid_documento)
		{
			oci_free_statement($stid_documento);
			oci_free_statement($stid);
			oci_rollback($this->conex);
			oci_close($this->conex);
			return false;
		}

		// Realizar la lógica de la consulta
		$id_documento = $id_doc + 1;
		oci_bind_by_name($stid_documento, ':documento', $id_documento);

		$r = oci_execute($stid_documento, OCI_NO_AUTO_COMMIT);
		if (!$r)
		{
			oci_free_statement($stid_documento);
			oci_free_statement($stid);
			oci_rollback($this->conex);
			oci_close($this->conex);
			return false;
		}

	/*********************************************************/

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
