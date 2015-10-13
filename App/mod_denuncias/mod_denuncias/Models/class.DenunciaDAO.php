<?php
class DenunciaDAO
{
	private $conex;

	//Constructor NO PDO para uso con orcl_conex.php
	public function __construct(){

	}

	public function listar()
	{	
		$this->conex = DataBase::getInstance();
		// Preparar la sentencia
		$stid = oci_parse($this->conex, "SELECT * FROM FISC_DENUNCIAS");
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
	public function getByIC($id_ciu)
	{	
		$this->conex = DataBase::getInstance();
		$stid = oci_parse($this->conex, "SELECT * FROM FISC_DENUNCIAS WHERE ID_CIUDADANO=:id_ciu");
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
	*
	**/
	
	public function getByID($id)
	{
		$this->conex = DataBase::getInstance();
		$stid = oci_parse($this->conex, "SELECT * FROM FISC_DENUNCIAS WHERE ID_DENUNCIA=:id_den");
		if (!$stid){
			$e = oci_error($this->conex);
			trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
		}
		// Realizar la lógica de la consulta
		oci_bind_by_name($stid, ':id_den', $id);
		$r = oci_execute($stid);
		if (!$r){
			$e = oci_error($stid);
			trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
		}

		// Obtener los resultados de la consulta
		$alm = new Denuncia();
		while ($fila = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)){
			$it = new ArrayIterator($fila);
			while($it->valid()){
				$alm->__SET(strtolower($it->key()),$it->current());
				$it->next();
			}
		}
		//Libera los recursos
		oci_free_statement($stid);
		// Cierra la conexión Oracle
		oci_close($this->conex);
		//retorna el resultado de la consulta
		return $alm;
	}

	public function getByIdEmp($id_emp)
	{
		$this->conex = DataBase::getInstance();
		$stid = oci_parse($this->conex, "SELECT * FROM FISC_DENUNCIAS WHERE ID_EMPRESA=:id_emp");
		if (!$stid){
			$e = oci_error($this->conex);
			trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
		}
		// Realizar la lógica de la consulta
		oci_bind_by_name($stid, ':id_emp', $id_emp);
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
	*
	**/

	public function getByID_ced($id,$ced)
	{
		$this->conex = DataBase::getInstance();
		$stid = oci_parse($this->conex, "SELECT count(*) as pepe FROM FISC_DENUNCIAS WHERE ID_EMPRESA='$id' AND ID_CIUDADANO='$ced' AND ESTATUS_DENUNCIA=0 ");
		if (!$stid){
			$e = oci_error($this->conex);
			trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
		}
		// Realizar la lógica de la consulta
		//oci_bind_by_name($stid, ':id_den', $id);
		//oci_bind_by_name($stid, ':id_ciu', $ced);

		$r = oci_execute($stid);
		if (!$r){
			$e = oci_error($stid);
			trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
		}

		// Obtener los resultados de la consulta
		/*$alm = new Denuncia();
		$fila = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)){
			$it = new ArrayIterator($fila);
			while($it->valid()){
				$alm->__SET(strtolower($it->key()),$it->current());
				$it->next();
			}
		}*/
		$resultado = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS);
		//Libera los recursos
		oci_free_statement($stid);
		// Cierra la conexión Oracle
		oci_close($this->conex);
		//retorna el resultado de la consulta
		return $resultado;
	}

	public function getByMotivo($id_motivo)
	{
		$this->conex = DataBase::getInstance();
		$stid = oci_parse($this->conex, "SELECT count(*) as motivos FROM FISC_MOT_DEN WHERE ID_MOTIVO=:id_mot");
		if (!$stid){
			$e = oci_error($this->conex);
			trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
		}
		// Realizar la lógica de la consulta
		oci_bind_by_name($stid, ':id_mot', $id_motivo);
		$r = oci_execute($stid);
		if (!$r){
			$e = oci_error($stid);
			trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
		}

		// Obtener los resultados de la consulta
		//$alm = new Denuncia();
		$fila = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS);
		//Libera los recursos
		oci_free_statement($stid);
		// Cierra la conexión Oracle
		oci_close($this->conex);
		//retorna el resultado de la consulta
		return $fila;
	}

	public function getByDocumentos($id_documento)
	{
		$this->conex = DataBase::getInstance();
		$consulta = "SELECT count(*) as documentos FROM FISC_DOC_DEN WHERE ID_DOCUMENTO=:id_doc";
		$stid = oci_parse($this->conex, $consulta);
		if (!$stid){
			$e = oci_error($this->conex);
			trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
		}
		// Realizar la lógica de la consulta
		oci_bind_by_name($stid, ':id_doc', $id_documento);
		$r = oci_execute($stid);
		if (!$r){
			$e = oci_error($stid);
			trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
		}

		// Obtener los resultados de la consulta
		//$alm = new Denuncia();
		$fila = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS);
		//Libera los recursos
		oci_free_statement($stid);
		// Cierra la conexión Oracle
		oci_close($this->conex);
		//retorna el resultado de la consulta
		return $fila;
	}

	public function getByEstatus($id_estatus)
	{
		$this->conex = DataBase::getInstance();
		$stid = oci_parse($this->conex, "SELECT count(*) as estatus FROM FISC_DENUNCIAS WHERE ESTATUS_DENUNCIA=:id_estatus");
		if (!$stid){
			$e = oci_error($this->conex);
			trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
		}
		// Realizar la lógica de la consulta
		oci_bind_by_name($stid, ':id_estatus', $id_estatus);
		$r = oci_execute($stid);
		if (!$r){
			$e = oci_error($stid);
			trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
		}

		// Obtener los resultados de la consulta
		//$alm = new Denuncia();
		$fila = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS);
		//Libera los recursos
		oci_free_statement($stid);
		// Cierra la conexión Oracle
		oci_close($this->conex);
		//retorna el resultado de la consulta
		return $fila;
	}

	public function getDocumentos(&$denuncia)
	{
		$this->conex = DataBase::getInstance();
		$result = array();

		$id_den = $denuncia->__GET('id_denuncia');
		$consulta = "SELECT * FROM FISC_DOC_DEN WHERE ID_DENUNCIA=:id_den";
		$stid = oci_parse($this->conex, $consulta);
		if (!$stid)
		{
			$e = oci_error($this->conex);
			trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
		}
		// Realizar la lógica de la consulta
		oci_bind_by_name($stid, ':id_den', $id_den);
		$r = oci_execute($stid);
		if (!$r)
		{
			$e = oci_error($stid);
			trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
		}

		// Obtener los resultados de la consulta
		while($fila = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS))
		{
			$result[] = $fila;	
		}
		/*
		foreach($denuncias as $denuncia)
		{
			$id_den = $denuncia->__GET('id_denuncia');
			$consulta = "SELECT * FROM FISC_DOC_DEN WHERE ID_DENUNCIA=:id_den";
			$stid = oci_parse($this->conex, $consulta);
			if (!$stid)
			{
    			$e = oci_error($this->conex);
    			trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
			}
			// Realizar la lógica de la consulta
			oci_bind_by_name($stid, ':id_den', $id_den);
			$r = oci_execute($stid);
			if (!$r)
			{
    			$e = oci_error($stid);
    			trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
			}

			// Obtener los resultados de la consulta
			while($fila = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS))
			{
				$result[] = $fila;	
			}
		}
		*/
		//Libera los recursos
		oci_free_statement($stid);
		// Cierra la conexión Oracle
		oci_close($this->conex);
		//retorna el resultado de la consulta
		return $result; 
	}

	public function getMotivos(&$denuncia)
	{
		$this->conex = DataBase::getInstance();
		$result = array();
		$id_den = $denuncia->__GET('id_denuncia');
		$consulta = "SELECT * FROM FISC_MOT_DEN fmd JOIN FISC_MOTIVOS fm
		on(fmd.ID_MOTIVO=fm.ID_MOTIVO) WHERE fmd.ID_DENUNCIA=:id_den";
		$stid = oci_parse($this->conex, $consulta);
		if (!$stid)
		{
			$e = oci_error($this->conex);
			trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
		}
		// Realizar la lógica de la consulta
		oci_bind_by_name($stid, ':id_den', $id_den);
		$r = oci_execute($stid);
		if (!$r)
		{
			$e = oci_error($stid);
			trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
		}

		// Obtener los resultados de la consulta
		while($fila = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS))
		{
			$result[] = $fila;	
		}
		/*
		foreach($denuncias as $denuncia)
		{
			$id_den = $denuncia->__GET('id_denuncia');
			$consulta = "SELECT * FROM FISC_MOT_DEN WHERE ID_DENUNCIA=:id_den";
			$stid = oci_parse($this->conex, $consulta);
			if (!$stid)
			{
    			$e = oci_error($this->conex);
    			trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
			}
			// Realizar la lógica de la consulta
			oci_bind_by_name($stid, ':id_den', $id_den);
			$r = oci_execute($stid);
			if (!$r)
			{
    			$e = oci_error($stid);
    			trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
			}

			// Obtener los resultados de la consulta
			while($fila = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS))
			{
				$result[] = $fila;	
			}
		}
		*/
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
		$consulta = "DELETE FROM FISC_DENUNCIAS WHERE ID_DENUNCIA = :id_den";
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
		oci_bind_by_name($stid_del_den, ':id_den', $id);
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

		//Si se eliminan los datos de la tabla denuncia
		//Eliminamos los documentos asociados a dicha denuncia
		$consulta = "DELETE FROM FISC_DOC_DEN WHERE ID_DENUNCIA = :id_den";
		$stid_del_doc = oci_parse($this->conex, $consulta);
		if (!$stid_del_doc){
    		//$e = oci_error($this->conex);
    		//trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
    		//Revertir los cambios
			oci_rollback($this->conex);
			//Libera los recursos
			oci_free_statement($stid_del_doc);
			// Cierra la conexión Oracle
			oci_close($this->conex);
			return false;
		}
		// Realizar la lógica de la consulta
		oci_bind_by_name($stid_del_doc, ':id_den', $id);
		$exec_del_doc = oci_execute($stid_del_doc, OCI_NO_AUTO_COMMIT);
		if (!$exec_del_doc){
    		//$e = oci_error($stid);
    		//trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
    		//Revertir los cambios
			oci_rollback($this->conex);
			//Libera los recursos
			oci_free_statement($stid_del_doc);
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

	/**
	*
	*
	**/
	public function actualizar(&$data)
	{
		$id_den              = $data->__GET('id_denuncia');
		$sts                 = $data->__GET('estatus_denuncia');
		//$descripcion         = $data->__GET('descripcion');
		$descripcion_estatus = $data->__GET('descripcion_estatus');
		$fecha_cierre= $data        ->__GET('fecha_cierre');
		$cerradopor = $_SESSION['USUARIO']['codigo_usuario'];

		//$responsable         = $data->__GET('responsable');

		$this->conex = DataBase::getInstance();
		$consulta = "UPDATE FISC_DENUNCIAS SET 
		estatus_denuncia=:sts,
		descripcion_estatus=:estatus_descripcion,
		cerradopor = :cerradopor,
		fecha_cierre = :fecha_cierre
		WHERE id_denuncia=:id_den";
		$stid = oci_parse($this->conex, $consulta);
		if (!$stid)
		{
			oci_free_statement($stid);
			oci_close($this->conex);
			return false;
		}

		// Realizar la lógica de la consulta
		oci_bind_by_name($stid, ':sts', $sts);
		oci_bind_by_name($stid, ':estatus_descripcion', $descripcion_estatus);
		oci_bind_by_name($stid, ':cerradopor', $cerradopor);
		oci_bind_by_name($stid, ':fecha_cierre', $fecha_cierre);
		//oci_bind_by_name($stid, ':responsable', $responsable);
		oci_bind_by_name($stid, ':id_den', $id_den);

		$r = oci_execute($stid, OCI_NO_AUTO_COMMIT);
		if (!$r)
		{
			oci_free_statement($stid);
			oci_close($this->conex);
			return false;
		}

		$documentos = $data->__GET('documentos');
		if(!empty($documentos))
		{
			for($i=0;$i<count($documentos);$i++)
			{
				$consulta = "INSERT INTO FISC_DOC_DEN(
					id_denuncia,
					id_documento)
values(:id_den,:id_doc)";
$stid = oci_parse($this->conex, $consulta);

if (!$stid)
{
	oci_rollback($this->conex);
	oci_free_statement($stid);
					// Cierra la conexión Oracle
	oci_close($this->conex);
	return false;
}

oci_bind_by_name($stid, ':id_den', $id_den);
oci_bind_by_name($stid, ':id_doc', $documentos[$i]);
$r = oci_execute($stid, OCI_NO_AUTO_COMMIT);
if (!$r)
{
	oci_rollback($this->conex);
	oci_free_statement($stid);
    				//$e = oci_error($stid);
    				//trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
					//Libera los recursos
					// Cierra la conexión Oracle
	oci_close($this->conex);
	return false;
}
}
}

/*******************INSERTAR ARCHIVOS SI EXISTEN***********************/
$archivos = $data->__GET('archivos_denuncia');

if(!empty($archivos))
{
	for($i=0;$i<count($archivos);$i++)
	{
		$consulta = "INSERT INTO TBL_ARCHIVOS_DENUNCIAS(
			ID_DENUNCIA,
			STR_NOMBRE_ARCHIVO)
values (
	:id_den,:nombre)";
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

oci_bind_by_name($stid, ':id_den', $id_den);
oci_bind_by_name($stid, ':nombre', $archivos[$i]);
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
}
}
/*INSERTRA ARCHIVOS SI EXISTEN*/


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
	public function registrar(Denuncia $data, FiscEmpresa $empresa, FiscCiudadano $ciudadano)
	{
		$this->conex  = DataBase::getInstance();
		/*Consultar ciudadano*/
		$id_emp     = $empresa ->__GET('id_fisc_empresa');
		$id_ciudadano  = $ciudadano ->__GET('id_ciudadano');
		$nombres = $ciudadano ->__GET('nombres');
		$apellidos = $ciudadano ->__GET('apellidos');
		$direccion = $ciudadano ->__GET('direccion');
		$tel_mov = $ciudadano ->__GET('telefono_movil');
		$tel_hab = $ciudadano ->__GET('telefono_habitacion');
		$correo = $ciudadano ->__GET('correo');

		$consulta_cedula = "SELECT * FROM FISC_CIUDADANO WHERE ID_CIUDADANO= '".$id_ciudadano."'";
		$stid2 = oci_parse($this->conex, $consulta_cedula);

		if(!$stid2)
		{
			return false;
		}

		$r2 = oci_execute($stid2);

		if(!$r2)
		{
			return false;
		}

		$ciudadano_result = oci_fetch_assoc($stid2);
		/*Consultar ciudadano*/

		/*Consultar Apoderado*/
		$id_apoderado  = $data ->__GET('apoderado');
		if(!empty($id_apoderado))
		{
			$consulta_apoderado = "SELECT * FROM FISC_APODERADO WHERE ID_APODERADO = :id_apoderado";
			$con_apo = oci_parse($this->conex, $consulta_apoderado);

			if(!$con_apo)
			{
				return false;
			}
			oci_bind_by_name($con_apo, ':id_apoderado', $id_apoderado);
			$execute_apo = oci_execute($con_apo);

			if(!$execute_apo)
			{
				return false;
			}

			$apoderado_result = oci_fetch_assoc($con_apo);
		}
		/*Consultar Apoderado*/


		/*Verificar existencia del ciudadano*/
		if( !isset($ciudadano_result['ID_CIUDADANO'])  ){
	//echo "Se encontró registro";

			$insertciu = "INSERT INTO FISC_CIUDADANO (
				ID_CIUDADANO, 
				NOMBRES,
				APELLIDOS, 
				DIRECCION, 
				TELEFONO_MOVIL, 
				TELEFONO_HABITACION, 
				CORREO)
values
(
	:id_ciudadano,
	:nombres,
	:apellidos,
	:direccion, 
	:telefono_movil,
	:telefono_habitacion,
	:email
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

oci_bind_by_name($stci, ':id_ciudadano', $id_ciudadano);
oci_bind_by_name($stci, ':nombres', $nombres);
oci_bind_by_name($stci, ':apellidos', $apellidos);
oci_bind_by_name($stci, ':direccion', $direccion);
oci_bind_by_name($stci, ':telefono_movil', $tel_mov);
oci_bind_by_name($stci, ':telefono_habitacion', $tel_hab);
oci_bind_by_name($stci, ':email', $correo);

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

}
/*Verificar existencia del ciudadano*/

/*Insertando en la tabla FISC_EMPRESA*/
$fisc_empresa = $empresa ->__GET('fisc_empresa');
$id_emp       = $empresa ->__GET('id_fisc_empresa');
$rif          = $empresa ->__GET('rif_fisc_empresa');
$nombre       = $empresa ->__GET('nombre_fisc_empresa');
$telefono     = $empresa ->__GET('telefono_fisc_empresa');
$email        = $empresa ->__GET('email_fisc_empresa');
$direccion    = trim($empresa ->__GET('direccion_fisc_empresa'));
$estado       = $empresa ->__GET('estado');
$municipio    = $empresa ->__GET('municipio');
$parroquia    = $empresa ->__GET('parroquia');
$calle        = $empresa ->__GET('calle');
$edificio     = $empresa ->__GET('edificio');
$casa         = $empresa ->__GET('casa');
$referencia   = $empresa ->__GET('punto_ref_fisc_empresa');

//$denuncias  = 1;//clave foranea de tabla denuncia
//$fiscalizaciones =3;//clave foranea de tabla fiscalizaciones

$consulta = "INSERT INTO FISC_EMPRESA (
	FISC_EMPRESA,
	ID_FISC_EMPRESA, 
	RIF_FISC_EMPRESA,
	NOMBRE_FISC_EMPRESA, 
	TELEFONO_FISC_EMPRESA, 
	EMAIL_FISC_EMPRESA, 
	DIRECCION_FISC_EMPRESA,
	ESTADO,
	MUNICIPIO,
	PARROQUIA,
	CALLE,
	EDIFICIO,
	CASA,
	DENUNCIAS_FISC_EMPRESA, 
	PUNTO_REF_FISC_EMPRESA, 
	FISCALIZACIONES_FISC_EMPRESA)
values
(
	:fisc_empresa,
	:id_emp,
	:rif_emp,
	:nombre, 
	:telefono,
	:email,
	:direccion,
	:estado,
	:municipio,
	:parroquia,
	:calle,
	:edificio,
	:casa,
	:denuncias,
	:ref,
	:fiscalizaciones
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

oci_bind_by_name($stid, ':fisc_empresa', $fisc_empresa);
oci_bind_by_name($stid, ':id_emp', $id_emp);
oci_bind_by_name($stid, ':rif_emp', $rif);
oci_bind_by_name($stid, ':nombre', $nombre);
oci_bind_by_name($stid, ':telefono', $telefono);
oci_bind_by_name($stid, ':email', $email);
oci_bind_by_name($stid, ':direccion', $direccion);

oci_bind_by_name($stid, ':estado', $estado);
oci_bind_by_name($stid, ':municipio', $municipio);
oci_bind_by_name($stid, ':parroquia', $parroquia);
oci_bind_by_name($stid, ':calle', $calle);
oci_bind_by_name($stid, ':edificio', $edificio);
oci_bind_by_name($stid, ':casa', $casa);

oci_bind_by_name($stid, ':denuncias', $denuncias);
oci_bind_by_name($stid, ':ref', $referencia);
oci_bind_by_name($stid, ':fiscalizaciones', $fiscalizaciones);

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
/*Insertando en la tabla FISC_EMPRESA*/

//Actualizar el próximo id_empresa en la tabla ID_TABLAS
/*********************************************************/
$upd_documento = "UPDATE ID_TABLAS SET 
FISC_EMPRESA=:fisc_empresa";
$stid_empresa_id = oci_parse($this->conex, $upd_documento);
if (!$stid_empresa_id)
{
	oci_free_statement($stid_empresa_id);
	oci_rollback($this->conex);
	oci_close($this->conex);
	return false;
}

		// Realizar la lógica de la consulta
$fisc_empresa_id = $fisc_empresa + 1;
oci_bind_by_name($stid_empresa_id, ':fisc_empresa', $fisc_empresa_id);

$r = oci_execute($stid_empresa_id, OCI_NO_AUTO_COMMIT);
if (!$r)
{
	oci_free_statement($stid_empresa_id);
	oci_rollback($this->conex);
	oci_close($this->conex);
	return false;
}
/*********************************************************/


/*Insertando en la tabla FISC_DENUNCIAS*/
$id_den=$data->__GET('id_denuncia');
$id_ciu=$data->__GET('id_ciudadano');
$sts = $data->__GET('estatus_denuncia');
$fecha = $data->__GET('fecha_denuncia');
$hora  = $data->__GET('hora_denuncia');
$rif = $data->__GET('rif');
$descripcion = $data->__GET('descripcion');
$responsable = $data->__GET('responsable');
$apoderado   = $data->__GET('apoderado');
$creador     = $_SESSION['USUARIO']['codigo_usuario'];




$consulta = "INSERT INTO FISC_DENUNCIAS(
	id_denuncia,
	id_ciudadano,
	rif,
	estatus_denuncia,
	fecha_denuncia,
	hora_denuncia,
	descripcion, 
	responsable,
	apoderado,
	id_empresa,
	creadopor,
	fisc_empresa)
values (
	:id_den,
	:id_ciu,
	:rif,
	:sts,
	:fec,
	:hora,
	:descrip,
	:responsable,
	:apoderado,
	:id_empresa,
	:creadopor,
	:fisc_empresa)";

$stid = oci_parse($this->conex,$consulta);
				    /*values (
				    	:id_den,:id_ciu,:rif,:mot,:sts,
				    	:fec,:descrp,:creator,:upd)");*/
if (!$stid)
{
	echo "Desde el parse 2"; 
	$e = oci_error($this->conex);
	trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
    		//$e = oci_error($this->conex);
    		//trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
			//Libera los recursos
	oci_free_statement($stid);
			// Cierra la conexión Oracle
	oci_close($this->conex);
	return false;
}

		// Realizar la lógica de la consulta
oci_bind_by_name($stid, ':id_den', $id_den);
oci_bind_by_name($stid, ':id_ciu', $id_ciu);
oci_bind_by_name($stid, ':rif', $rif);
		//oci_bind_by_name($stid, ':mot', $motivo);
oci_bind_by_name($stid, ':sts', $sts);
oci_bind_by_name($stid, ':fec', $fecha);
oci_bind_by_name($stid, ':hora', $hora);
oci_bind_by_name($stid, ':descrip', $descripcion);
oci_bind_by_name($stid, ':responsable', $responsable);
oci_bind_by_name($stid, ':apoderado', $apoderado);
oci_bind_by_name($stid, ':id_empresa', $id_emp);
oci_bind_by_name($stid, ':creadopor', $creador);
oci_bind_by_name($stid, ':fisc_empresa', $fisc_empresa);

		/*
		oci_bind_by_name($stid, ':creator', $data->__GET('createdby'));
		oci_bind_by_name($stid, ':updater', $data->__GET('updatedby'));
		oci_bind_by_name($stid, ':upd', $data->__GET('updatedate'));
		*/
		
		$r = oci_execute($stid, OCI_NO_AUTO_COMMIT);
		if (!$r)
		{
			echo "Desde el execute 2";
			$e = oci_error($this->conex);
			trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
    		//Revertimos los cambios
			oci_rollback($this->conex);
			//Libera los recursos
			oci_free_statement($stid);
			// Cierra la conexión Oracle
			oci_close($this->conex);
			return false;
		}
		//Libera los recursos
		oci_free_statement($stid);
		/*Insertando en la tabla FISC_DENUNCIAS*/

//No ocurrió ningún fallo al insertar los datos de la denuncia
		/*Insertando en la tabla FISC_DOCUMENTOS*/
		$documentos = $data->__GET('documentos');
		//$error = false;
		if(!empty($documentos)){
			for($i=0;$i<count($documentos);$i++)
			{
				$consulta = "INSERT INTO FISC_DOC_DEN(
					id_denuncia,

					id_documento)
values (
	:id_den,:id_doc)";
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

oci_bind_by_name($stid, ':id_den', $id_den);
oci_bind_by_name($stid, ':id_doc', $documentos[$i]);
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
}
}
/*Insertando en la tabla FISC_DOCUMENTOS*/

/*Insertando en la tabla FISC_MOT_DEN*/
$motivos = $data->__GET('motivo_denuncia');
		//$error = false;
if(!empty($motivos)){
	for($i=0;$i<count($motivos);$i++)
	{
		$consulta = "INSERT INTO FISC_MOT_DEN(
			id_denuncia,
			id_motivo)
values (
	:id_den,:id_mot)";
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

oci_bind_by_name($stid, ':id_den', $id_den);
oci_bind_by_name($stid, ':id_mot', $motivos[$i]);
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
}
}

/*Insertando en la tabla archivos_denuncia*/
$archivos = $data->__GET('archivos_denuncia');
		//$error = false;
if(!empty($archivos))
{
	for($i=0;$i<count($archivos);$i++)
	{
		$consulta = "INSERT INTO TBL_ARCHIVOS_DENUNCIAS(
			ID_DENUNCIA,
			STR_NOMBRE_ARCHIVO)
values (
	:id_den,:nombre)";
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

oci_bind_by_name($stid, ':id_den', $id_den);
oci_bind_by_name($stid, ':nombre', $archivos[$i]);
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
}
}

//Verificar existencia de Apoderado
if(!empty($id_apoderado)){
	if(empty($apoderado_result))
	{
		/*Insertando en la tabla FISC_APODERADO*/
		$nombres_apoderado    = $data->__GET('nombres_apoderado');
		$apellidos_apoderado  = $data->__GET('apellidos_apoderado');

		$consulta = "INSERT INTO FISC_APODERADO(
			id_apoderado,
			nombres_apoderado,
			apellidos_apoderado)
values (
	:id_apo, :name_apo, :ape_apo)";
$stid_apo = oci_parse($this->conex, $consulta);

if (!$stid_apo)
{
	echo "Desde el parse 4";
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

oci_bind_by_name($stid_apo, ':id_apo', $id_apoderado);
oci_bind_by_name($stid_apo, ':name_apo', $nombres_apoderado);
oci_bind_by_name($stid_apo, ':ape_apo', $apellidos_apoderado);
$execute_apo = oci_execute($stid_apo, OCI_NO_AUTO_COMMIT);
if (!$execute_apo)
{
	echo "Desde el execute 4";
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

/*Insertando en la tabla FISC_APODERADO*/

}//Verificar existencia de Apoderado
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

/****************Función registrar2*********************/

public function registrar2(Denuncia $data, FiscEmpresa $empresa)
{

	$this->conex  = DataBase::getInstance();

	/*Consultar Empresa*/
	$id_empresa  = $empresa ->__GET('id_fisc_empresa');

	$consulta_empresa = "SELECT * FROM FISC_EMPRESA WHERE ID_FISC_EMPRESA= '".$id_empresa."'";
	$compemp = oci_parse($this->conex, $consulta_empresa);

	if(!$compemp)
	{
		return false;
	}

	$exemp = oci_execute($compemp);

	if(!$exemp)
	{
		return false;
	}

	$empresa_result = oci_fetch_assoc($compemp);
	/*Consultar Empresa*/

	/*Verificar existencia de empresa*/
	if( !isset($empresa_result['ID_EMPRESA']) )
	{
		/*Insertando en la tabla FISC_EMPRESA*/
		$id_emp     = $empresa ->__GET('id_fisc_empresa');
		$rif        = $empresa ->__GET('rif_fisc_empresa');
		$nombre     = $empresa ->__GET('nombre_fisc_empresa');
		$telefono   = $empresa ->__GET('telefono_fisc_empresa');
		$email      = $empresa ->__GET('email_fisc_empresa');
		$direccion  = $empresa ->__GET('direccion_fisc_empresa');
		$referencia = $empresa ->__GET('punto_ref_fisc_empresa');
			$denuncias  = 1;//clave foranea de tabla denuncia
			$fiscalizaciones =3;//clave foranea de tabla fiscalizaciones

			$consulta = "INSERT INTO FISC_EMPRESA (
				ID_FISC_EMPRESA, 
				RIF_FISC_EMPRESA,
				NOMBRE_FISC_EMPRESA, 
				TELEFONO_FISC_EMPRESA, 
				EMAIL_FISC_EMPRESA, 
				DIRECCION_FISC_EMPRESA, 
				DENUNCIAS_FISC_EMPRESA, 
				PUNTO_REF_FISC_EMPRESA, 
				FISCALIZACIONES_FISC_EMPRESA)
values
(
	:id_emp,
	:rif_emp,
	:nombre, 
	:telefono,
	:email,
	:direccion,
	:denuncias,
	:ref,
	:fiscalizaciones
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

oci_bind_by_name($stid, ':id_emp', $id_emp);
oci_bind_by_name($stid, ':rif_emp', $rif);
oci_bind_by_name($stid, ':nombre', $nombre);
oci_bind_by_name($stid, ':telefono', $telefono);
oci_bind_by_name($stid, ':email', $email);
oci_bind_by_name($stid, ':direccion', $direccion);
oci_bind_by_name($stid, ':denuncias', $denuncias);
oci_bind_by_name($stid, ':ref', $referencia);
oci_bind_by_name($stid, ':fiscalizaciones', $fiscalizaciones);

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
/*Insertando en la tabla FISC_EMPRESA*/
}
/*Verificar existencia de empresa*/

/*Insertando en la tabla FISC_DENUNCIAS*/
$id_den=$data->__GET('id_denuncia');
$id_ciu=$data->__GET('id_ciudadano');
$motivo = $data->__GET('motivo_denuncia');
$sts = $data->__GET('estatus_denuncia');
$fecha = $data->__GET('fecha_denuncia');
$rif = $data->__GET('rif');
$descripcion = $data->__GET('descripcion');
$responsable = $data->__GET('responsable');
		//$apoderado   = $data->__GET('apoderado');

$consulta = "INSERT INTO FISC_DENUNCIAS(
	id_denuncia,
	id_ciudadano,
	rif,
	motivo_denuncia,
	estatus_denuncia,
	fecha_denuncia,
	descripcion, 
	responsable)
values (
	:id_den,
	:id_ciu,
	:rif,
	:mot,
	:sts,
	:fec,
	:descrip,
	:responsable)";
$stid = oci_parse($this->conex,$consulta);
				    /*values (
				    	:id_den,:id_ciu,:rif,:mot,:sts,
				    	:fec,:descrp,:creator,:upd)");*/
if (!$stid)
{
	echo "Desde el parse 2";
	$e = oci_error($this->conex);
	trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
    		//$e = oci_error($this->conex);
    		//trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
			//Libera los recursos
	oci_free_statement($stid);
			// Cierra la conexión Oracle
	oci_close($this->conex);
	return false;
}
		// Realizar la lógica de la consulta
oci_bind_by_name($stid, ':id_den', $id_den);
oci_bind_by_name($stid, ':id_ciu', $id_ciu);
oci_bind_by_name($stid, ':rif', $rif);
oci_bind_by_name($stid, ':mot', $motivo);
oci_bind_by_name($stid, ':sts', $sts);
oci_bind_by_name($stid, ':fec', $fecha);
oci_bind_by_name($stid, ':descrip', $descripcion);
oci_bind_by_name($stid, ':responsable', $responsable);
		//oci_bind_by_name($stid, ':apoderado', $apoderado);

		/*
		oci_bind_by_name($stid, ':creator', $data->__GET('createdby'));
		oci_bind_by_name($stid, ':updater', $data->__GET('updatedby'));
		oci_bind_by_name($stid, ':upd', $data->__GET('updatedate'));
		*/
		
		$r = oci_execute($stid, OCI_NO_AUTO_COMMIT);
		if (!$r)
		{
			echo "Desde el execute 2";
			$e = oci_error($this->conex);
			trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
    		//Revertimos los cambios
			oci_rollback($this->conex);
			//Libera los recursos
			oci_free_statement($stid);
			// Cierra la conexión Oracle
			oci_close($this->conex);
			return false;
		}
		//Libera los recursos
		oci_free_statement($stid);
		/*Insertando en la tabla FISC_DENUNCIAS*/

//No ocurrió ningún fallo al insertar los datos de la denuncia
/*Insertando en la tabla FISC_DOCUMENTOS
		$documentos = $data->__GET('documentos');
		//$error = false;
		for($i=0;$i<count($documentos);$i++)
		{
			$consulta = "INSERT INTO FISC_DOC_DEN(
						id_denuncia,
			
						id_documento)
						values (
				    	:id_den,:id_doc)";
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

			oci_bind_by_name($stid, ':id_den', $id_den);
			oci_bind_by_name($stid, ':id_doc', $documentos[$i]);
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
		}
		Insertando en la tabla FISC_DOCUMENTOS*/

	//Verificar existencia de Apoderado
   /*
	if( !isset($apoderado_result['ID_APODERADO']))
	{

	//Insertando en la tabla FISC_APODERADO
	$nombres_apoderado    = $data->__GET('nombres_apoderado');
	$apellidos_apoderado  = $data->__GET('apellidos_apoderado');

	$consulta = "INSERT INTO FISC_APODERADO(
						id_apoderado,
						nombres_apoderado,
						apellidos_apoderado)
						values (
				    	:id_apo, :name_apo, :ape_apo)";
			$stid_apo = oci_parse($this->conex, $consulta);
			
			if (!$stid_apo)
			{
				echo "Desde el parse 4";
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

			oci_bind_by_name($stid_apo, ':id_apo', $id_apoderado);
			oci_bind_by_name($stid_apo, ':name_apo', $nombres_apoderado);
			oci_bind_by_name($stid_apo, ':ape_apo', $apellidos_apoderado);
			$execute_apo = oci_execute($stid_apo, OCI_NO_AUTO_COMMIT);
			if (!$execute_apo)
			{
				echo "Desde el execute 4";
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

	//Insertando en la tabla FISC_APODERADO

	}//Verificar existencia de Apoderado
	*/

	$r = oci_commit($this->conex);
	if(!$r) 
	{
		oci_close($this->conex);
		return false;
	}
		// Cierra la conexión Oracle
	oci_close($this->conex);
	return true;
}
/****************Función registrar2*********************/
}
