<?php
class FichaDAO
{
	private $conex;
	 
	//Constructor NO PDO para uso con orcl_conex.php
	public function __construct(){
			
		}

	public function datosTiuna($id_empresa)
	{
		$this->conex = DataBase::getInstance();

		$resultado = false;
		$consulta = "select * from tiuna_request.register_request where ivss_number = :id_empresa";
		$stid = oci_parse($this->conex, $consulta);
		if (!$stid)
		{
    		$e = oci_error($this->conex);
    		trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
		}
		// Realizar la lógica de la consulta
		oci_bind_by_name($stid, ':id_empresa', $id_empresa);
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
		oci_close($this->conex);
		return $resultado;
	}

	public function datosRiesgo($id_riesgo)
	{
		$this->conex = DataBase::getInstance();
		$resul_riesgo = false;
		$consulta = "select * from sira.riesgo where id_riesgo = :id_riesgo";
		$stid = oci_parse($this->conex, $consulta);
		if (!$stid)
		{
    		$e = oci_error($this->conex);
    		trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
		}
		// Realizar la lógica de la consulta
		oci_bind_by_name($stid, ':id_riesgo', $id_riesgo);
		$r = oci_execute($stid);
		if (!$r)
		{
    		$e = oci_error($stid);
    		trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
		}
		// Obtener los resultados de la consulta
		while ($fila = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS))
		{
			$resul_riesgo[] = $fila;
		}
		//Libera los recursos
		oci_free_statement($stid);
		// Cierra la conexión Oracle
		oci_close($this->conex);
		return $resul_riesgo;
	}

	public function datosActividad($id_actividad)
	{
		$this->conex = DataBase::getInstance();
		$resul_actividad = false;
		$consulta = "select * from sira.actividad_economica where id_actividad = :id_actividad";
		$stid = oci_parse($this->conex, $consulta);
		if (!$stid)
		{
    		$e = oci_error($this->conex);
    		trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
		}
		// Realizar la lógica de la consulta
		oci_bind_by_name($stid, ':id_actividad', $id_actividad);
		$r = oci_execute($stid);
		if (!$r)
		{
    		$e = oci_error($stid);
    		trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
		}
		// Obtener los resultados de la consulta
		while ($fila = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS))
		{
			$resul_actividad[] = $fila;
		}
		//Libera los recursos
		oci_free_statement($stid);
		// Cierra la conexión Oracle
		oci_close($this->conex);
		return $resul_actividad;
	}

	public function datosRetencion($id_riesgo)
	{
		$this->conex = DataBase::getInstance();
		$resul_actividad = false;
		$consulta = "select sum(PORC_COTIPATRON + PORC_COTIASEG + PORC_PAROFORZ_PATRON + PORC_PAROFORZ_ASEG) as retencion from SIRA.HISTORICO_PARAMETRO_RIESGO where ID_RIESGO=:id_riesgo and FECHA_HASTA is null";
		$stid = oci_parse($this->conex, $consulta);
		if (!$stid)
		{
    		$e = oci_error($this->conex);
    		trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
		}
		// Realizar la lógica de la consulta
		oci_bind_by_name($stid, ':id_riesgo', $id_riesgo);
		$r = oci_execute($stid);
		if (!$r)
		{
    		$e = oci_error($stid);
    		trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
		}
		// Obtener los resultados de la consulta
		while ($fila = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS))
		{
			$resul_actividad[] = $fila;
		}
		//Libera los recursos
		oci_free_statement($stid);
		// Cierra la conexión Oracle
		oci_close($this->conex);
		return $resul_actividad;
	}

	public function listar() 
	{	
		$this->conex = DataBase::getInstance();
		// Preparar la sentencia
		$stid = oci_parse($this->conex, "SELECT * FROM FISC_FICHA_TECNICA");
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
	public function getByIdFicha($id)
	{	
		$this->conex = DataBase::getInstance();
		$stid = oci_parse($this->conex, "SELECT * FROM FISC_FICHA_TECNICA WHERE ID_FICHA=:id");
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
	
	public function getByIdEmpresa($id)
	{
		$this->conex = DataBase::getInstance();
		$stid = oci_parse($this->conex, "SELECT * FROM FISC_FICHA_TECNICA WHERE ID_EMPRESA=:id");
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

	public function getByOficina($oficina)
	{
		$this->conex = DataBase::getInstance();
		$stid = oci_parse($this->conex, "SELECT * FROM FISC_FICHA_TECNICA WHERE =:oficina");
		if (!$stid){
    		$e = oci_error($this->conex);
    		trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
		}
		// Realizar la lógica de la consulta
		oci_bind_by_name($stid, ':oficina', $oficina);
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
	public function eliminar($id)
	{
		$this->conex = DataBase::getInstance();
		$consulta = "DELETE FROM FISC_FICHA_TECNICA WHERE ID_FICHA = :id";
		$stid= oci_parse($this->conex, $consulta);
		if (!$stid)
		{
    		//$e = oci_error($this->conex);
    		//trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
			//Libera los recursos
			oci_free_statement($stid);
			// Cierra la conexión Oracle
			oci_close($this->conex);
			return false;
		}
		// Realizar la lógica de la consulta
		oci_bind_by_name($stid, ':id', $id);
		$exec= oci_execute($stid, OCI_NO_AUTO_COMMIT);
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
			return false;
		}
		//Libera los recursos
		oci_free_statement($stid);
		oci_free_statement($stid);
		// Cierra la conexión Oracle
		oci_close($this->conex);
		return true;
	}

	/**
	*
	*
	**/
	public function actualizar(Ficha $data)
	{
		$id_den=$data->__GET('id_denuncia');
		$motivo = $data->__GET('motivo_denuncia');
		$sts = $data->__GET('estatus_denuncia');
		$descripcion = $data->__GET('descripcion');

		$this->conex = DataBase::getInstance();
		$stid = oci_parse($this->conex, "UPDATE FISC_DENUNCIAS SET 
						motivo_denuncia=:mot,
						estatus_denuncia=:sts,
						descripcion=:descrip
				    WHERE id_denuncia=:id_den");
		if (!$stid)
		{
			oci_free_statement($stid);
			oci_close($this->conex);
			return false;
		}

		// Realizar la lógica de la consulta
		oci_bind_by_name($stid, ':mot', $motivo);
		oci_bind_by_name($stid, ':sts', $sts);
		oci_bind_by_name($stid, ':descrip', $descripcion);
		oci_bind_by_name($stid, ':id_den', $id_den);

		$r = oci_execute($stid, OCI_NO_AUTO_COMMIT);
		if (!$r)
		{
			oci_free_statement($stid);
			oci_close($this->conex);
			return false;
		}

		$documentos = $data->__GET('documentos');
		if(empty($documentos))
		{
			$r = oci_commit($this->conex);
			if(!$r)
			{
				oci_free_statement($stid);
				oci_close($this->conex);
				return false;

			}
			oci_free_statement($stid);
			oci_close($this->conex);
			return true;
		}
		else
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
	public function registrar(Ficha $data)
	{	
		$this->conex  = DataBase::getInstance();
		/*Datos de la Ficha Técnica*/
		$id_ficha                   =  $data->__GET('id_ficha');
		$fecha_elaboracion          =  $data->__GET('fecha_elaboracion');
		$id_empresa                 =  $data->__GET('id_empresa');
		$rif                        =  $data->__GET('rif');
		$nombre_empresa_ivss        =  $data->__GET('nombre_empresa_ivss');
		$nombre_empresa_seniat      =  $data->__GET('nombre_empresa_seniat');
		$id_representante           =  $data->__GET('id_representante');
		$nombre_representante       =  $data->__GET('nombre_representante');
		$direccion_ivss             =  $data->__GET('direccion_ivss');
		$direccion_fiscalizacion    =  $data->__GET('direccion_fiscalizacion');
		$oficina_registro           =  $data->__GET('oficina_registro');
		$fecha_registro             =  $data->__GET('fecha_registro');
		$numero                     =  $data->__GET('numero');
		$tomo                       =  $data->__GET('tomo');
		$folio                      =  $data->__GET('folio');
		$protocolo                  =  $data->__GET('protocolo');
		$fecha_inicio_actividad     =  $data->__GET('fecha_inicio_actividad');
		$fecha_inscripcion_ivss     =  $data->__GET('fecha_inscripcion_ivss');
		$numero_sucursales          =  $data->__GET('numero_sucursales');
		$denominacion_comercial     =  $data->__GET('denominacion_comercial');
		$email_empresa              =  $data->__GET('email_empresa');
		$telefono_empresa           =  $data->__GET('telefono_empresa');
		$persona_contacto           =  $data->__GET('persona_contacto');
		$registro_ivss              =  $data->__GET('registro_ivss');
		$registro_tiuna             =  $data->__GET('registro_tiuna');
		$nivel_riesgo               =  $data->__GET('nivel_riesgo');
		$retencion                  =  $data->__GET('retencion');
		$actividad_economica        =  $data->__GET('actividad_economica');
		$trabajadores_activos       =  $data->__GET('trabajadores_activos');
		$afiliados_ivss             =  $data->__GET('afiliados_ivss');
		$diferencia_trabajadores    =  $data->__GET('diferencia_trabajadores');
		$forma14_02                 =  $data->__GET('forma14_02');
		$forma14_03                 =  $data->__GET('forma14_03');
		$cambio_salario             =  $data->__GET('cambio_salario');
		$morosidad                  =  $data->__GET('morosidad');
		$observaciones              =  $data->__GET('observaciones');
		$id_funcionario             =  $data->__GET('id_funcionario');
		$nombre_funcionario         =  $data->__GET('nombre_funcionario');
		/*Datos de la Ficha Técnica*/
		$consulta = "INSERT INTO FISC_FICHA_TECNICA (
			ID_FICHA,
			FECHA_ELABORACION,
			ID_EMPRESA,
			RIF,
			NOMBRE_EMPRESA_IVSS,
			NOMBRE_EMPRESA_SENIAT,
			ID_REPRESENTANTE,
			NOMBRE_REPRESENTANTE,
			DIRECCION_IVSS,
			DIRECCION_FISCALIZACION,
			OFICINA_REGISTRO,
			FECHA_REGISTRO,
			NUMERO,
			TOMO,
			FOLIO,
			PROTOCOLO,
			FECHA_INICIO_ACTIVIDAD,
			FECHA_INSCRIPCION_IVSS,
			NUMERO_SUCURSALES,
			DENOMINACION_COMERCIAL,
			EMAIL_EMPRESA,
			TELEFONO_EMPRESA,
			PERSONA_CONTACTO,
			REGISTRO_IVSS,
			REGISTRO_TIUNA,
			NIVEL_RIESGO,
			RETENCION,
			ACTIVIDAD_ECONOMICA,
			TRABAJADORES_ACTIVOS,
			AFILIADOS_IVSS,
			DIFERENCIA_TRABAJADORES,
			FORMA14_02,
			FORMA14_03,
			CAMBIO_SALARIO,
			MOROSIDAD,
			OBSERVACIONES,
			ID_FUNCIONARIO,
			NOMBRE_FUNCIONARIO)
			values
				(
					:id_ficha,
					:fecha_elaboracion,
					:id_empresa,
					:rif,
					:nombre_empresa_ivss,
					:nombre_empresa_seniat,
					:id_representante,
					:nombre_representante,
					:direccion_ivss,
					:direccion_fiscalizacion,
					:oficina_registro,
					:fecha_registro,
					:numero,
					:tomo,
					:folio,
					:protocolo,
					:fecha_inicio_actividad,
					:fecha_inscripcion_ivss,
					:numero_sucursales,
					:denominacion_comercial,
					:email_empresa,
					:telefono_empresa,
					:persona_contacto,
					:registro_ivss,
					:registro_tiuna,
					:nivel_riesgo,
					:retencion,
					:actividad_economica,
					:trabajadores_activos,
					:afiliados_ivss,
					:diferencia_trabajadores,
					:forma14_02,
					:forma14_03,
					:cambio_salario,
					:morosidad,
					:observaciones,
					:id_funcionario,
					:nombre_funcionario
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
		//Preparar lógica de la consulta
		oci_bind_by_name($stid, ':id_ficha', $id_ficha);
		oci_bind_by_name($stid, ':fecha_elaboracion', $fecha_elaboracion);
		oci_bind_by_name($stid, ':id_empresa', $id_empresa);
		oci_bind_by_name($stid, ':rif', $rif);
		oci_bind_by_name($stid, ':nombre_empresa_ivss', $nombre_empresa_ivss);
		oci_bind_by_name($stid, ':nombre_empresa_seniat', $nombre_empresa_seniat);
		oci_bind_by_name($stid, ':id_representante', $id_representante);
		oci_bind_by_name($stid, ':nombre_representante', $nombre_representante);
		oci_bind_by_name($stid, ':direccion_ivss', $direccion_ivss);
		oci_bind_by_name($stid, ':direccion_fiscalizacion', $direccion_fiscalizacion);
		oci_bind_by_name($stid, ':oficina_registro', $oficina_registro);
		oci_bind_by_name($stid, ':fecha_registro', $fecha_registro);
		oci_bind_by_name($stid, ':numero', $numero);
		oci_bind_by_name($stid, ':tomo', $tomo);
		oci_bind_by_name($stid, ':folio', $folio);
		oci_bind_by_name($stid, ':protocolo', $protocolo);
		oci_bind_by_name($stid, ':fecha_inicio_actividad', $fecha_inicio_actividad);
		oci_bind_by_name($stid, ':fecha_inscripcion_ivss', $fecha_inscripcion_ivss);
		oci_bind_by_name($stid, ':numero_sucursales', $numero_sucursales);
		oci_bind_by_name($stid, ':denominacion_comercial', $denominacion_comercial);
		oci_bind_by_name($stid, ':email_empresa', $email_empresa);
		oci_bind_by_name($stid, ':telefono_empresa', $telefono_empresa);
		oci_bind_by_name($stid, ':persona_contacto', $persona_contacto);
		oci_bind_by_name($stid, ':registro_ivss', $registro_ivss);
		oci_bind_by_name($stid, ':registro_tiuna', $registro_tiuna);
		oci_bind_by_name($stid, ':nivel_riesgo', $nivel_riesgo);
		oci_bind_by_name($stid, ':retencion', $retencion);
		oci_bind_by_name($stid, ':actividad_economica', $actividad_economica);
		oci_bind_by_name($stid, ':trabajadores_activos', $trabajadores_activos);
		oci_bind_by_name($stid, ':afiliados_ivss', $afiliados_ivss);
		oci_bind_by_name($stid, ':diferencia_trabajadores', $diferencia_trabajadores);
		oci_bind_by_name($stid, ':forma14_02', $forma14_02);
		oci_bind_by_name($stid, ':forma14_03', $forma14_03);
		oci_bind_by_name($stid, ':cambio_salario', $cambio_salario);
		oci_bind_by_name($stid, ':morosidad', $morosidad);
		oci_bind_by_name($stid, ':observaciones', $observaciones);
		oci_bind_by_name($stid, ':id_funcionario', $id_funcionario);
		oci_bind_by_name($stid, ':nombre_funcionario', $nombre_funcionario);

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
	}
}
