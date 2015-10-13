<?php
class JefeOficinaDAO
{
	private $conex;
	 
	//Constructor NO PDO para uso con orcl_conex.php
	public function __construct(){
			
		}
	public function listar() 
	{	
		$this->conex = DataBase::getInstance();
		// Preparar la sentencia
		$stid = oci_parse($this->conex, "SELECT * FROM FISC_JEFE_OFICINA");
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
	public function getById($id_jefe)
	{	
		$this->conex = DataBase::getInstance();
		
		//Consulta SQL
		$consulta    = "SELECT * FROM FISC_JEFE_OFICINA WHERE 
						ID_JEFE=:id_jefe";

		$stid = oci_parse($this->conex, $consulta);
		if (!$stid){
    		$e = oci_error($this->conex);
    		trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
		}
		// Realizar la lógica de la consulta
		oci_bind_by_name($stid, ':id_jefe', $id_jefe);
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
	
	public function eliminar($id_jefe)
	{
		$this->conex = DataBase::getInstance();
		$consulta = "DELETE FROM FISC_JEFE_OFICINA WHERE ID_JEFE = :id_jefe";
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
		oci_bind_by_name($stid, ':id_jefe', $id_jefe);
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
	public function actualizar(&$jefe)
	{
		$id_jefe                  = $jefe->__GET('id_jefe');
		$nacionalidad             = $jefe->__GET('nacionalidad');
		$primer_nombre            = $jefe->__GET('primer_nombre');
		$segundo_nombre           = $jefe->__GET('segundo_nombre');
		$primer_apellido          = $jefe->__GET('primer_apellido');
		$segundo_apellido         = $jefe->__GET('segundo_apellido');
		$tratamineto_protocolar   = $jefe->__GET('tratamineto_protocolar');
		$numero_resolucion        = $jefe->__GET('numero_resolucion');
		$fecha_resolucion         = $jefe->__GET('fecha_resolucion');
		
		//Consulta SQL
		$consulta    = "UPDATE FISC_JEFE_OFICINA SET
						nacionalidad           = :nacionalidad,
						primer_nombre          = :primer_nombre,
						segundo_nombre         = :segundo_nombre,
						primer_apellido        = :primer_apellido,
						segundo_apellido       = :segundo_apellido,
						tratamineto_protocolar = :tratamineto_protocolar, 
						numero_resolucion      = :numero_resolucion,
						fecha_resolucion       = :fecha_resolucion,
				        WHERE id_jefe= :id_jefe";
		
		$this->conex = DataBase::getInstance();
		$stid = oci_parse($this->conex, $consulta);
		if (!$stid)
		{
			oci_free_statement($stid);
			oci_close($this->conex);
			return false;
		}

		// Realizar la lógica de la consulta
		oci_bind_by_name($stid, ':nacionalidad',  $nacionalidad );
		oci_bind_by_name($stid, ':primer_nombre',  $primer_nombre);
		oci_bind_by_name($stid, ':segundo_nombre'  ,  $segundo_nombre);
		oci_bind_by_name($stid, ':primer_apellido'   ,  $primer_apellido);
		oci_bind_by_name($stid, ':segundo_apellido'   ,  $segundo_apellido);
		oci_bind_by_name($stid, ':tratamineto_protocolar',  $tratamineto_protocolar);
		oci_bind_by_name($stid, ':numero_resolucion',  $numero_resolucion);
		oci_bind_by_name($stid, ':fecha_resolucion',  $fecha_resolucion);
		oci_bind_by_name($stid, ':id_jefe',  $id_jefe);

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
public function agregar(&$jefe)
{	
	$this->conex  = DataBase::getInstance();
	$consulta = "INSERT INTO FISC_JEFE_OFICINA (
			id_jefe,
			nacionalidad,
			primer_nombre,
			segundo_nombre,
			primer_apellido ,
			segundo_apellido,
			tratamineto_protocolar,
			numero_resolucion,
			fecha_resolucion
 		)
			values
			(
				:id_jefe,
				:nacionalidad,
				:primer_nombre,
				:segundo_nombre
				:primer_apellido
				:segundo_apellido
				:tratamineto_protocolar,
				:numero_resolucion,
				:fecha_resolucion
			)";

		foreach($jefes as $jefe)
		{
			
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

			$id_jefe                  = $jefe->__GET('id_jefe');
			$nacionalidad             = $jefe->__GET('nacionalidad');
			$primer_nombre            = $jefe->__GET('primer_nombre');
			$segundo_nombre           = $jefe->__GET('segundo_nombre');
			$primer_apellido          = $jefe->__GET('primer_apellido');
			$segundo_apellido         = $jefe->__GET('segundo_apellido');
			$tratamineto_protocolar   = $jefe->__GET('tratamineto_protocolar');
			$numero_resolucion        = $jefe->__GET('numero_resolucion');
			$fecha_resolucion         = $jefe->__GET('fecha_resolucion');

			// Realizar la lógica de la consulta
			oci_bind_by_name($stid, ':id_jefe',  $id_jefe);
			oci_bind_by_name($stid, ':nacionalidad',  $nacionalidad );
			oci_bind_by_name($stid, ':primer_nombre',  $primer_nombre);
			oci_bind_by_name($stid, ':segundo_nombre'  ,  $segundo_nombre);
			oci_bind_by_name($stid, ':primer_apellido'   ,  $primer_apellido);
			oci_bind_by_name($stid, ':segundo_apellido'   ,  $segundo_apellido);
			oci_bind_by_name($stid, ':tratamineto_protocolar',  $tratamineto_protocolar);
			oci_bind_by_name($stid, ':numero_resolucion',  $numero_resolucion);
			oci_bind_by_name($stid, ':fecha_resolucion',  $fecha_resolucion);
		
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
