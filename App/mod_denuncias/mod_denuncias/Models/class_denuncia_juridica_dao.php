<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
class DenunciaJuridicaDAO
{
	private $conex;

	//Constructor NO PDO para uso con orcl_conex.php
	public function __construct(){

	}

	public function listar() 
	{	
		$this->conex = DataBase::getInstance();
		// Preparar la sentencia
		$stid = oci_parse($this->conex, "SELECT * FROM FISC_DENUNCIAS_JURIDICAS");
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

	}//FIN LISTAR

	public function getMotivos(&$denuncia)
	{
		$this->conex = DataBase::getInstance();
		$result = array();
		$id_den = $denuncia->__GET('id_denuncia');
		$consulta = "SELECT * FROM FISC_MOT_QUEJAS fmq JOIN FISC_MOTIVOS_QUEJAS mq
		on(fmq.ID_MOTIVO=mq.ID_MOTIVO) WHERE fmq.ID_DENUNCIA=:id_den";
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
		//Libera los recursos
		oci_free_statement($stid);
		// Cierra la conexión Oracle
		oci_close($this->conex);
		//retorna el resultado de la consulta
		return $result; 

	}//FIN getMotivos

	public function getByIC($id_ciu)
	{	
		$this->conex = DataBase::getInstance();
		$stid = oci_parse($this->conex, "SELECT * FROM FISC_DENUNCIAS_JURIDICAS WHERE ID_DENUNCIADO=:id_ciu");
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
	}//FIN getByIC

	public function getByID($id)
	{
		$this->conex = DataBase::getInstance();
		$stid = oci_parse($this->conex, "SELECT * FROM FISC_DENUNCIAS_JURIDICAS WHERE ID_DENUNCIA=:id_den");
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
		$alm = new DenunciaJuridica();
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
	}//FIN getByID

	public function getByIdEmp($id_emp)
	{
		$this->conex = DataBase::getInstance();
		$stid = oci_parse($this->conex, "SELECT * FROM FISC_DENUNCIAS_JURIDICAS WHERE ID_EMPRESA=:id_emp");
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

		// Obtener los resultados de la consulta
		$result = Array();
		$alm = new DenunciaJuridica();
		while ($fila = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)){
			$it = new ArrayIterator($fila);
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

	}//FIN getByIdEmp

	public function getByMotivo($id_motivo)
	{
		$this->conex = DataBase::getInstance();
		$stid = oci_parse($this->conex, "SELECT count(*) as motivos FROM FISC_MOT_Quejas WHERE ID_MOTIVO=:id_mot");
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
	}//FIN getByMotivo

	public function getByDocumentos($id_documento)
	{
		$this->conex = DataBase::getInstance();
		$consulta = "SELECT count(*) as documentos FROM FISC_DOC_QUEJAS WHERE ID_DOCUMENTO=:id_doc";
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
	}// getByDocumentos

	public function eliminar($id)
	{
		$this->conex = DataBase::getInstance();
		$consulta = "DELETE FROM FISC_DENUNCIAS_JURIDICAS WHERE ID_DENUNCIA = :id_den";
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

		/*
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
		*/
		$r = oci_commit($this->conex);
		if(!$r) 
		{
			oci_free_statement($stid_del_den);
			oci_close($this->conex);
			return false;
		}
		//Libera los recursos
		oci_free_statement($stid_del_den);
		//oci_free_statement($stid_del_doc);
		// Cierra la conexión Oracle
		oci_close($this->conex);
		return true;
	}//FIN eliminar

	public function registrar(&$data, &$empresa, &$representante)
	{
		$this->conex = DataBase::getInstance();
		/*INICIO datos de la empresa denunciante*/

		$fisc_empresa           = $empresa ->__GET('fisc_empresa');
		$id_empresa             = $empresa ->__GET('id_empresa');
		$rif                    = $empresa ->__GET('rif');
		$nombre_empresa         = $empresa ->__GET('nombre_empresa');
		$direccion_empresa      = $empresa ->__GET('direccion_empresa');
		$punto_referencia       = $empresa ->__GET('punto_referencia');
		$telefono_empresa       = $empresa ->__GET('telefono_empresa');
		$email_empresa          = $empresa ->__GET('email_empresa');
		/*FIN datos de la empresa denunciante*/

		/*INICIO datos del representante de la empresa*/
		$clv_representante = $representante ->__GET('clv_representante');
		$str_nombres       = $representante ->__GET('str_nombres');
		$str_apellidos     = $representante ->__GET('str_apellidos');
		$str_telefono1     = $representante ->__GET('str_telefono1');
		$str_telefono2     = $representante ->__GET('str_telefono2');
		$str_email         = $representante ->__GET('str_email');
		$str_direccion     = $representante ->__GET('str_direccion');
		/*FIN datos del representante de la empresa*/

		/*datos de la denuncia*/
		$id_denuncia           = $data ->__GET('id_denuncia');
		$fecha_denuncia        = $data ->__GET('fecha_denuncia');
		$estatus_denuncia      = $data ->__GET('estatus_denuncia');
		$descripcion_denuncia  = $data ->__GET('descripcion_denuncia');
		$responsable_denuncia  = $data ->__GET('responsable_denuncia');
		$creador               = $_SESSION['USUARIO']['codigo_usuario'];
		/*datos de la denuncia*/

		/*CONSULTAR REPRESENTANTE*/

		$consulta_representante = "SELECT * FROM TBL_REPRESENTANTEEMPRESAS WHERE CLV_REPRESENTANTE = :id_representante";

		$stid_representante = oci_parse($this->conex, $consulta_representante);
		if (!$stid_representante){
			oci_free_statement($stid_representante);
			// Cierra la conexión Oracle
			oci_close($this->conex);
			return false;
			
		}
		// Realizar la lógica de la consulta
		oci_bind_by_name($stid_representante, ':id_representante', $clv_representante);

		$exec_consulta_representante = oci_execute($stid_representante);
		if (!$exec_consulta_representante)
		{
			//Libera los recursos
			oci_free_statement($stid_representante);
			// Cierra la conexión Oracle
			oci_close($this->conex);
			return false;
		}

		$representante_result = oci_fetch_assoc($stid_representante);
		
		/*FIN CONSULTAR REPRESENTANTE*/

		/*INSERTANDO EN LA TABLA REPRESENTANTE*/
		if(empty($representante_result))
		{
			$consulta = "INSERT INTO TBL_REPRESENTANTEEMPRESAS(
				CLV_REPRESENTANTE,
				STR_NOMBRES,
				STR_APELLIDOS,
				STR_TELEFONO1,
				STR_TELEFONO2,
				STR_EMAIL,
				STR_DIRECCION
				)
VALUES(
	:clv_representante,
	:str_nombres,
	:str_apellidos,
	:str_telefono1,
	:str_telefono2,
	:str_email,
	:str_direccion
	)";

$stid = oci_parse($this->conex,$consulta);
if (!$stid)
{
	//Libera los recursos
	oci_free_statement($stid);
	// Cierra la conexión Oracle
	oci_close($this->conex);
	return false;
}

oci_bind_by_name($stid, ':clv_representante', $clv_representante);
oci_bind_by_name($stid, ':str_nombres', $str_nombres);
oci_bind_by_name($stid, ':str_apellidos', $str_apellidos);
oci_bind_by_name($stid, ':str_telefono1', $str_telefono1);
oci_bind_by_name($stid, ':str_telefono2', $str_telefono2);
oci_bind_by_name($stid, ':str_email', $str_email);
oci_bind_by_name($stid, ':str_direccion', $str_direccion);

$r = oci_execute($stid, OCI_NO_AUTO_COMMIT);
if (!$r)
{
	oci_rollback($this->conex);
	oci_free_statement($stid);
	// Cierra la conexión Oracle
	oci_close($this->conex);
	return false;
}

}//FIN EMPTY REPRESENTANTE_RESULT

/*****************INSERTANDO EN LA TABLA FISC_EMPRESA****************************/
$consulta = "INSERT INTO FISC_EMPRESA(
	FISC_EMPRESA,
	ID_FISC_EMPRESA,
	RIF_FISC_EMPRESA,
	NOMBRE_FISC_EMPRESA,
	TELEFONO_FISC_EMPRESA,
	EMAIL_FISC_EMPRESA,
	DIRECCION_FISC_EMPRESA,
	PUNTO_REF_FISC_EMPRESA,
	ID_REPRESENTANTE
	)
VALUES(
	:fisc_empresa,
	:id_fisc_empresa,
	:rif_fisc_empresa,
	:nombre_fisc_empresa,
	:telefono_fisc_empresa,
	:email_fisc_empresa,
	:direccion_fisc_empresa,
	:punto_ref_fisc_empresa,
	:id_representante
	)";

$stid = oci_parse($this->conex,$consulta);
if (!$stid)
{

				//Libera los recursos
	oci_free_statement($stid);
				// Cierra la conexión Oracle
	oci_close($this->conex);
	return false;
}

oci_bind_by_name($stid, ':fisc_empresa', $fisc_empresa);
oci_bind_by_name($stid, ':id_fisc_empresa', $id_empresa);
oci_bind_by_name($stid, ':rif_fisc_empresa', $rif);
oci_bind_by_name($stid, ':nombre_fisc_empresa', $nombre_empresa);
oci_bind_by_name($stid, ':telefono_fisc_empresa', $telefono_empresa);
oci_bind_by_name($stid, ':email_fisc_empresa', $email_empresa);
oci_bind_by_name($stid, ':direccion_fisc_empresa', $direccion_empresa);
oci_bind_by_name($stid, ':punto_ref_fisc_empresa', $punto_referencia);
oci_bind_by_name($stid, ':id_representante', $clv_representante);

$r = oci_execute($stid, OCI_NO_AUTO_COMMIT);
if (!$r)
{
	oci_rollback($this->conex);
	oci_free_statement($stid);
	// Cierra la conexión Oracle
	oci_close($this->conex);
	return false;
}

/*********************************************/


//Actualizar el próximo id_empresa en la tabla ID_TABLAS
/*********************************************************/
$upd_id = "UPDATE ID_TABLAS SET 
FISC_EMPRESA=:fisc_empresa";
$stid_empresa_id = oci_parse($this->conex, $upd_id);
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

/*INSERTANDO EN DENUNCIAS JURIDICAS*/
$consulta = "INSERT INTO FISC_DENUNCIAS_JURIDICAS
(
	id_denuncia,
	id_empresa,
	fecha_denuncia,
	hora_denuncia,
	estatus_denuncia,
	descripcion_denuncia,
	responsable_denuncia,
	creador,
	rif, 
	fisc_empresa
	)
values
(
	:id_denuncia,
	:id_empresa,
	:fecha_denuncia,
	:hora_denuncia,
	:estatus_denuncia,
	:descripcion_denuncia,
	:responsable_denuncia,
	:creador,
	:rif,
	:fisc_empresa
	)";

$stid = oci_parse($this->conex,$consulta);
if (!$stid)
{
	
	//Libera los recursos
	oci_free_statement($stid);
	//revertimos los cambios
	oci_rollback($this->conex);
	// Cierra la conexión Oracle
	oci_close($this->conex);

	return false;
}
				// Realizar la lógica de la consulta
$hora=date("h:m");

oci_bind_by_name($stid, ':id_denuncia'          , $id_denuncia);
oci_bind_by_name($stid, ':id_empresa'           , $id_empresa);
oci_bind_by_name($stid, ':fecha_denuncia'       , $fecha_denuncia);
oci_bind_by_name($stid, ':hora_denuncia'        , $hora);
oci_bind_by_name($stid, ':estatus_denuncia'     , $estatus_denuncia);
oci_bind_by_name($stid, ':descripcion_denuncia' , $descripcion_denuncia);
oci_bind_by_name($stid, ':responsable_denuncia' , $responsable_denuncia);
oci_bind_by_name($stid, ':creador'              , $creador);
oci_bind_by_name($stid, ':rif'                  , $rif);
oci_bind_by_name($stid, ':fisc_empresa'         , $fisc_empresa);

$r = oci_execute($stid, OCI_NO_AUTO_COMMIT);
if (!$r)
{
	//Revertimos los cambios
	oci_rollback($this->conex);
	//Libera los recursos
	oci_free_statement($stid);
	// Cierra la conexión Oracle
	oci_close($this->conex);
	return false;
}

/********************************************************************************/
/********************************************************************************/

/*INSERTANDO EN LA TABLA FISC_DOC_QUEJAS*/
$documentos = $data->__GET('documentos');
			//$error = false;
if(!empty($documentos))
{
	for($i=0;$i<count($documentos);$i++)
	{
		$consulta = "INSERT INTO FISC_DOC_QUEJAS(
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

oci_bind_by_name($stid, ':id_den', $id_denuncia);
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

/********************************************************************************/
/********************************************************************************/

/*Insertando en la tabla FISC_MOT_QUEJAS*/
$motivos = $data->__GET('motivo_denuncia');
		//$error = false;
if(!empty($motivos))
{
	for($i=0;$i<count($motivos);$i++)
	{
		$consulta = "INSERT INTO FISC_MOT_QUEJAS(
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

oci_bind_by_name($stid, ':id_den', $id_denuncia);
oci_bind_by_name($stid, ':id_mot', $motivos[$i]);
$r = oci_execute($stid, OCI_NO_AUTO_COMMIT);
if (!$r)
{
	
	oci_rollback($this->conex);		
	//Libera los recursos
	oci_free_statement($stid);
	// Cierra la conexión Oracle
	oci_close($this->conex);
	return false;
}
}
}
/*Insertando en la tabla FISC_MOT_QUEJAS*/

/********************************************************/
/*******************************************************/
/*Insertando en la tabla archivos_queja*/
$archivos = $data->__GET('archivos_queja');
		//$error = false;
if(!empty($archivos))
{
	for($i=0;$i<count($archivos);$i++)
	{
		$consulta = "INSERT INTO TBL_ARCHIVOS_QUEJAS(
			ID_QUEJA,
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

oci_bind_by_name($stid, ':id_den', $id_denuncia);
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

/*CONSOLIDANDO LOS DATOS*/
$r = oci_commit($this->conex);
if(!$r) 
{	
	//Libera los recursos
	oci_free_statement($stid);
	// Cierra la conexión Oracle
	oci_close($this->conex);
	return false;
}

//Libera los recursos
oci_free_statement($stid);
// Cierra la conexión Oracle
oci_close($this->conex);
return true;
/*CONSOLIDANDO LOS DATOS*/

}//FIN REGISTRAR


/*******FUNCTION ACTUALIZAR****************************/
public function actualizar(&$data)
{
	
	$id_den=$data->__GET('id_denuncia');
		//$motivo = $data->__GET('motivo_denuncia');
	$sts = $data->__GET('estatus_denuncia');
	$descripcion = $data->__GET('descripcion_estatus');
	$fecha_cierre = date('d/m/Y');
	$cerradopor               = $_SESSION['USUARIO']['codigo_usuario'];
	$this->conex = DataBase::getInstance();
	$stid = oci_parse($this->conex, "UPDATE FISC_DENUNCIAS_JURIDICAS SET 
		estatus_denuncia   =:sts,
		descripcion_estatus=:descrip,
		cerradopor=:cerradopor,
		fecha_cierre = :fecha_cierre
		WHERE id_denuncia=:id_den");
	if (!$stid)
	{
		oci_free_statement($stid);
		oci_close($this->conex);
		return false;
	}

		// Realizar la lógica de la consulta
	oci_bind_by_name($stid, ':sts', $sts);
	oci_bind_by_name($stid, ':descrip', $descripcion);
	oci_bind_by_name($stid, ':cerradopor', $cerradopor);
	oci_bind_by_name($stid, ':fecha_cierre', $fecha_cierre);
	oci_bind_by_name($stid, ':id_den', $id_den);

	$r = oci_execute($stid, OCI_NO_AUTO_COMMIT);
	if (!$r)
	{
		oci_free_statement($stid);
		oci_close($this->conex);
		return false;
	}

	/********************INSERTAR DOCUMENTOS SI EXISTEN************************/
	$documentos = $data->__GET('documentos');
		//$error = false;
	if(!empty($documentos))
	{
		for($i=0;$i<count($documentos);$i++)
		{
			$consulta = "INSERT INTO FISC_DOC_QUEJAS(
				id_denuncia,
				id_documento)
values 
(
	:id_den,:id_doc
	)";
$stid = oci_parse($this->conex, $consulta);

if (!$stid)
{
	echo "Desde el parse 3";
	$e = oci_error($this->conex);
	trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
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
/********************INSERTAR DOCUMENTOS SI EXISTEN************************
***************************************************************************/

/*******************INSERTAR ARCHIVOS SI EXISTEN***********************/
$archivos = $data->__GET('archivos_queja');


if(!empty($archivos))
{
	for($i=0;$i<count($archivos);$i++)
	{
		$consulta = "INSERT INTO TBL_ARCHIVOS_QUEJAS(
			ID_QUEJA,
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
/*****************************************************/


}//FIN CLASS DENUNCIAJURIDICADAO
