<?php
class CiudadanoDAO
{
	private $pdo;
	private $conex;
	
	/*
	public function __construct()
	{
		try
		{
			$this->pdo = DataBase::getInstance();		        
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}
	*/

	public function __construct(){
			
		}

	public function listar()
	
	{	
		$this->conex = DataBase::getInstance();
		// Preparar la sentencia
		$stid = oci_parse($this->conex, "SELECT 
											ID_CIUDADANO,
											PRIMER_NOMBRE,
											SEGUNDO_NOMBRE,
											PRIMER_APELLIDO,
											SEGUNDO_APELLIDO,
											TELEFONO_HAB,
											TELEFONO_MOVIL,
											FECHA_NACIMIENTO,
											SEXO 
										FROM CIUDADANO");
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
			$alm = new Ciudadano();
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

	public function getById($id)
	{
		$this->conex = DataBase::getInstance();
		$stid = oci_parse($this->conex, "SELECT 
			id_ciudadano,
			primer_nombre,
			segundo_nombre,
			primer_apellido,
			segundo_apellido,
			telefono_hab,
			telefono_movil,
			fecha_nacimiento,
			sexo
			FROM CIUDADANO WHERE ID_CIUDADANO=:id");
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
		$alm = new Ciudadano();
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

	/*public function actualizar(Ciudadano $data)
	{
		try 
		{
			$sql = "UPDATE CIUDADANO SET 
						nacionalidad= ?,
						cedula= ?, 
						nombre_ciudadano= ?,
						apellido_ciudadano=?,
						direccion_ciudadano=?,
						telefono_ciudadano=?
				    WHERE id_ciudadano = ?";

			$this->pdo->prepare($sql)
			     ->execute(
				array(
					$data->__GET('nacionalidad'),
					$data->__GET('cedula'), 
					$data->__GET('nombreCiudadano'), 
					$data->__GET('apellidoCiudadano'),
					$data->__GET('direccionCiudadano'),
					$data->__GET('telefonoCiudadano'),
					$data->__GET('id')
					)
				);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}*/
}
?>