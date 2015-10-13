<?php
class OficinaDAO
{
	private $conex;

	//Constructor NO PDO para uso con orcl_conex.php
	public function __construct(){

	}
	public function listar() 
	{	
		$this->conex = DataBase::getInstance();
		// Preparar la sentencia
		$stid = oci_parse($this->conex, "SELECT * FROM FISC_OFICINA_ADMINISTRATIVA");
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
	public function getById($id_oficina)
	{	
		$this->conex = DataBase::getInstance();
		
		//Consulta SQL
		$consulta    = "SELECT * FROM FISC_OFICINA_ADMINISTRATIVA WHERE 
		ID_OFICINA=:id_oficina";

		$stid = oci_parse($this->conex, $consulta);
		if (!$stid){
			$e = oci_error($this->conex);
			trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
		}
		// Realizar la lógica de la consulta
		oci_bind_by_name($stid, ':id_oficina', $id_oficina);
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
	
	public function eliminar($id_oficina)
	{
		$this->conex = DataBase::getInstance();
		$consulta = "UPDATE FISC_OFICINA_ADMINISTRATIVA SET  
		intborrado     = :borrado
		WHERE id_oficina= :id_oficina";
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
		$borrado = 1;
		oci_bind_by_name($stid, ':borrado', $borrado);
		oci_bind_by_name($stid, ':id_oficina', $id_oficina);
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
	public function actualizar(&$oficina, &$jefe )
	{
		$id_oficina  = $oficina->__GET('id_oficina');
		$id_region   = $oficina->__GET('id_region');
		$id_estado   = $oficina->__GET('id_estado');
		$id_jefe     = $oficina->__GET('id_jefe');
		$siglas     = $oficina->__GET('siglas');
		$nombre      = $oficina->__GET('nombre');
		$direccion   = $oficina->__GET('direccion');
		
		//Consulta SQL
		$consulta    = "UPDATE FISC_OFICINA_ADMINISTRATIVA SET  
		id_jefe     = :id_jefe,
		siglas      = :siglas,
		nombre      = :nombre,
		direccion   = :direccion
		WHERE id_oficina= :id_oficina";
		
		$this->conex = DataBase::getInstance();
		$stid = oci_parse($this->conex, $consulta);
		if (!$stid)
		{
			oci_free_statement($stid);
			oci_close($this->conex);
			return false;
		}

		// Realizar la lógica de la consulta
		//oci_bind_by_name($stid, ':id_region',  $id_region );
		//oci_bind_by_name($stid, ':id_estado',  $id_estado);
		oci_bind_by_name($stid, ':id_jefe'  ,  $id_jefe);
		oci_bind_by_name($stid, ':siglas'   ,  $siglas);
		oci_bind_by_name($stid, ':nombre'   ,  $nombre);
		oci_bind_by_name($stid, ':direccion',  $direccion);
		oci_bind_by_name($stid, ':id_oficina',  $id_oficina);

		$r = oci_execute($stid, OCI_NO_AUTO_COMMIT);
		if (!$r)
		{
			oci_free_statement($stid);
			oci_close($this->conex);
			return false;
		}


		//Actualizar el jefe de oficina

		$consulta_jefe    = "UPDATE FISC_JEFE_OFICINA SET
		id_jefe=:id_jefe,
		primer_nombre=:primer_nombre,
		segundo_nombre=:segundo_nombre,
		primer_apellido=:primer_apellido,
		segundo_apellido=:segundo_apellido,
		tratamiento_protocolar=:tratamiento_protocolar,
		numero_resolucion=:numero_resolucion,
		fecha_resolucion  =:fecha_resolucion
		WHERE id_jefe= :id_jefe";
		
		$this->conex = DataBase::getInstance();
		$stid_jefe = oci_parse($this->conex, $consulta_jefe);
		if (!$stid)
		{
			oci_free_statement($stid);
			oci_free_statement($stid_jefe);
			oci_close($this->conex);
			return false;
		}

		$id_jefe=$jefe->__GET('id_jefe');
		//$nacionalidad=$jefe->__GET('nacionalidad');
		$primer_nombre=$jefe->__GET('primer_nombre');
		$segundo_nombre=$jefe->__GET('segundo_nombre');
		$primer_apellido=$jefe->__GET('primer_apellido');
		$segundo_apellido=$jefe->__GET('segundo_apellido');
		$tratamiento_protocolar=$jefe->__GET('tratamiento_protocolar');
		$numero_resolucion=$jefe->__GET('numero_resolucion');
		$fecha_resolucion=$jefe->__GET('fecha_resolucion');
		// Realizar la lógica de la consulta
		oci_bind_by_name($stid_jefe, ':id_jefe',  $id_jefe );
		//oci_bind_by_name($stid_jefe, ':nacionalidad',  $nacionalidad);
		oci_bind_by_name($stid_jefe, ':primer_nombre'  ,  $primer_nombre);
		oci_bind_by_name($stid_jefe, ':segundo_nombre'   ,  $segundo_nombre);
		oci_bind_by_name($stid_jefe, ':primer_apellido'   ,  $primer_apellido);
		oci_bind_by_name($stid_jefe, ':segundo_apellido',  $segundo_apellido);
		oci_bind_by_name($stid_jefe, ':tratamiento_protocolar',  $tratamiento_protocolar);
		oci_bind_by_name($stid_jefe, ':numero_resolucion',  $numero_resolucion);
		oci_bind_by_name($stid_jefe, ':fecha_resolucion',  $fecha_resolucion);

		$r = oci_execute($stid_jefe, OCI_NO_AUTO_COMMIT);
		if (!$r)
		{
			oci_free_statement($stid);
			oci_free_statement($stid_jefe);
			oci_close($this->conex);
			return false;
		}
		//Fin Actualizar Jefe de oficina


		$r = oci_commit($this->conex);
		if(!$r)
		{
			oci_free_statement($stid);
			oci_close($this->conex);
			return false;

		}
		oci_free_statement($stid);
		oci_free_statement($stid_jefe);
		// Cierra la conexión Oracle
		oci_close($this->conex);
		return true;
	}
	/**
	* 
	*
	**/
	public function agregar(&$oficina, &$jefe)
	{	

		$this->conex  = DataBase::getInstance();

		/****************INSERTAR EN LA TABLA OFICINA_ADMINISTRATIVA************************/
		$consulta = "INSERT INTO FISC_OFICINA_ADMINISTRATIVA (
			id_oficina,
			id_region,
			id_estado,
			id_jefe,
			siglas,
			nombre,
			direccion
			)
values
(
	:id_oficina,
	:id_region,
	:id_estado,
	:id_jefe,
	:siglas,
	:nombre,
	:direccion
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
$id_oficina         = $oficina->__GET('id_oficina');
$id_region          = $oficina->__GET('id_region');
$id_estado          = $oficina->__GET('id_estado');
$id_jefe            = $oficina->__GET('id_jefe');
$siglas             = $oficina->__GET('siglas');
$nombre             = $oficina->__GET('nombre');
$direccion          = $oficina->__GET('direccion');

oci_bind_by_name($stid, ':id_oficina', $id_oficina);
oci_bind_by_name($stid, ':id_region',  $id_region );
oci_bind_by_name($stid, ':id_estado',  $id_estado);
oci_bind_by_name($stid, ':id_jefe'  ,  $id_jefe);
oci_bind_by_name($stid, ':siglas'   ,  $siglas);
oci_bind_by_name($stid, ':nombre'   ,  $nombre);
oci_bind_by_name($stid, ':direccion',  $direccion);

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

/**************** FIN INSERTAR EN LA TABLA OFICINA_ADMINISTRATIVA************************/

/**************** CONSULTAR JEFE_OFICINA************************/

$stid_jefe = oci_parse($this->conex, "SELECT * FROM FISC_JEFE_OFICINA WHERE ID_JEFE = :id");
if (!$stid_jefe){
	$e = oci_error($this->conex);
	trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}
		// Realizar la lógica de la consulta
oci_bind_by_name($stid_jefe, ':id', $id_jefe );
$r = oci_execute($stid_jefe);
if (!$r){
	$e = oci_error($stid_jefe);
	trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}

		// Obtener los resultados de la consulta
$result_jefe = oci_fetch_array($stid_jefe, OCI_ASSOC+OCI_RETURN_NULLS);


		//Libera los recursos
oci_free_statement($stid_jefe);
		// Cierra la conexión Oracle
		//retorna el resultado de la consulta
/**************** CONSULTAR JEFE_OFICINA************************/
if($result_jefe==false)
{
	/**************** INSERTAR EN LA TABLA JEFE_OFICINA************************/
	$consulta = "INSERT INTO FISC_JEFE_OFICINA (
		ID_JEFE,
		NACIONALIDAD,
		PRIMER_NOMBRE,
		SEGUNDO_NOMBRE,
		PRIMER_APELLIDO,
		SEGUNDO_APELLIDO,
		TRATAMIENTO_PROTOCOLAR,
		NUMERO_RESOLUCION,
		FECHA_RESOLUCION
		)
values
(
	:id_jefe,
	:nacionalidad,
	:primer_nombre,
	:segundo_nombre,
	:primer_apellido,
	:segundo_apellido,
	:tratamiento_protocolar,
	:numero_resolucion,
	:fecha_resolucion
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


$id_jefe                = $jefe->__GET('id_jefe');
$nacionalidad           = $jefe->__GET('nacionalidad');
$primer_nombre          = $jefe->__GET('primer_nombre');
$segundo_nombre         = $jefe->__GET('segundo_nombre');
$primer_apellido        = $jefe->__GET('primer_apellido');
$segundo_apellido       = $jefe->__GET('segundo_apellido');
$tratamiento_protocolar = $jefe->__GET('tratamineto_protocolar');
$numero_resolucion      = $jefe->__GET('numero_resolucion');
$fecha_resolucion       = $jefe->__GET('fecha_resolucion');

oci_bind_by_name($stid, ':id_jefe', $id_jefe);
oci_bind_by_name($stid, ':nacionalidad', $nacionalidad );
oci_bind_by_name($stid, ':primer_nombre', $primer_nombre);
oci_bind_by_name($stid, ':segundo_nombre', $segundo_nombre);
oci_bind_by_name($stid, ':primer_apellido', $primer_apellido);
oci_bind_by_name($stid, ':segundo_apellido', $segundo_apellido);
oci_bind_by_name($stid, ':tratamiento_protocolar', $tratamiento_protocolar);
oci_bind_by_name($stid, ':numero_resolucion', $numero_resolucion);
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
}
/**************** FIN INSERTAR EN LA TABLA JEFE_OFICINA************************/


/**************** CONSOLIDAR LOS CAMBIOS EN LAS TABLAS ************************/
$r = oci_commit($this->conex);
if(!$r) 
{
	oci_free_statement($stid);
	oci_close($this->conex);
	return false;
}
/**************** CONSOLIDAR LOS CAMBIOS EN LAS TABLAS ************************/

oci_free_statement($stid);
oci_close($this->conex);
return true;
}
}
