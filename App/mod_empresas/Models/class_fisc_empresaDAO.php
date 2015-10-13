<?php

class FiscEmpresaDAO
{
	private $conex;

	public function __construct(){
		
	}
	
	public function listar()
	{
		
		$this->conex = DataBase::getInstance();
		// Preparar la sentencia
		$consulta = "SELECT *
		FROM FISC_EMPRESA";
		$stid = oci_parse($this->conex, $consulta);
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

		// Obtener los resultados de la consulta
		$result = array();
		while ($fila = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS))
		{
			$it = new ArrayIterator($fila);
			$alm = new FiscEmpresa();
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

	public function queryByPatrono($npatronal)
	{
		$this->conex = DataBase::getInstance();
		$consulta = "SELECT * FROM FISC_EMPRESA WHERE ID_FISC_EMPRESA=:id";
		$stid = oci_parse($this->conex, $consulta);
		if (!$stid){
			$e = oci_error($this->conex);
			trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
		}
		// Realizar la lógica de la consulta
		oci_bind_by_name($stid, ':id', $npatronal);
		$r = oci_execute($stid);
		if (!$r){
			$e = oci_error($stid);
			trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
		}

		// Obtener los resultados de la consulta
		$alm = new FiscEmpresa();
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


	public function queryByFisc($fisc)
	{
		
		$this->conex = DataBase::getInstance();
		$consulta = "SELECT * FROM FISC_EMPRESA WHERE FISC_EMPRESA=:fisc";
		$stid = oci_parse($this->conex, $consulta);
		if (!$stid){
			$e = oci_error($this->conex);
			trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
			return false;
		}
		// Realizar la lógica de la consulta
		oci_bind_by_name($stid, ':fisc', $fisc);
		$r = oci_execute($stid);
		if (!$r){
			$e = oci_error($stid);
			trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
			return false;
		}

		// Obtener los resultados de la consulta
		$alm = new FiscEmpresa();
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
	
	public function queryByRif($rif)
	{
		$this->conex = DataBase::getInstance();
		$consulta = "SELECT *
		FROM FISC_EMPRESA 
		WHERE RIF_FISC_EMPRESA = :rif";
		$stid = oci_parse($this->conex, $consulta);
		if (!$stid){
			$e = oci_error($this->conex);
			trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
		}
		// Realizar la lógica de la consulta
		oci_bind_by_name($stid, ':rif', $rif);
		$r = oci_execute($stid);
		if (!$r){
			$e = oci_error($stid);
			trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
		}

		// Obtener los resultados de la consulta
		$fila = oci_fetch_object($stid, OCI_ASSOC+OCI_RETURN_NULLS);
		$alm = new FiscEmpresa();
		try
		{
			$it = new ArrayIterator($fila);
			while($it->valid())
			{
				$alm->__SET(strtolower($it->key()),$it->current());
				$it->next();
			}
		}catch(InvalidArgumentException $e)
		{
		}
		//Libera los recursos
		oci_free_statement($stid);
		// Cierra la conexión Oracle
		oci_close($this->conex);
		//retorna el resultado de la consulta
		return $alm;
	}
	
	public function queryByNombre($nombre,$num_pags)
	{
		$this->conex = DataBase::getInstance();
		
		$consulta = "SELECT * FROM FISC_EMPRESA WHERE NOMBRE_FISC_EMPRESA LIKE '%$nombre%' AND ROWNUM <= $num_pags";

		$stid = oci_parse($this->conex, $consulta);
		if (!$stid){
			$e = oci_error($this->conex);
			trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
		}
		// Realizar la lógica de la consulta
		oci_bind_by_name($stid, ':nombre', $nombre);
		$r = oci_execute($stid);
		if (!$r){
			$e = oci_error($stid);
			trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
		}

		// Obtener los resultados de la consulta
		$result = array();
		while ($fila = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)){
			$it = new ArrayIterator($fila);
			$alm = new FiscEmpresa();
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
	
	public function obtener($clave, $valor)
	{
		$this->conex = DataBase::getInstance();
		$consulta = "SELECT *
		FROM FISC_EMPRESA 
		WHERE ".strtoupper($clave)."= :valor";
		$stid = oci_parse($this->conex, $consulta);
		if (!$stid){
			$e = oci_error($this->conex);
			trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
		}
		// Realizar la lógica de la consulta
		oci_bind_by_name($stid, ':valor', $valor);
		$r = oci_execute($stid);
		if (!$r){
			$e = oci_error($stid);
			trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
		}

		// Obtener los resultados de la consulta
		$result = array();
		while ($fila = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)){
			$it = new ArrayIterator($fila);
			$alm = new FiscEmpresa();
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
	
	/*public function registrar(Empresa $data)
	{
		try 
		{
			$sql = "INSERT INTO empresa (rif, numero_patronal, nombre_empresa, direccion_empresa, telefono_empresa) 
		        VALUES (:rif, :npat, :nombre, :direccion, :telefono)";

			$this->pdo->prepare($sql)
			->execute(
			array(
				':rif'=>$data->__GET('rif'),
				':npat'=>$data->__GET('numeroPatronal'),
				':nombre'=>$data->__GET('nombre'),
				':direccion'=>$data->__GET('direccion'),
				':telefono'=>$data->__GET('telefono')
				)
			);
		} catch (Exception $e) 
		{
			//die($e->getMessage());
			return false;
		}
		return true;
	}*/

	/*
	public function actualizar(Empresa $data)
	{
		try 
		{
			$sql = "UPDATE empresa SET 
						rif= ?,
						numeropatronal= ?, 
						nombreEmpresa= ?,
						direccionEmpresa=?
				    WHERE id = ?";

			$this->pdo->prepare($sql)
			     ->execute(
				array(
					$data->__GET('rif'),
					$data->__GET('numeroPatronal'), 
					$data->__GET('nombreEmpresa'), 
					$data->__GET('direccionEmpresa'),
					$data->__GET('id')
					)
				);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}
	*/
}


