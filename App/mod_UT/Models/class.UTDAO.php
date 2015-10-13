<?php
class UTDAO
{
	private $conex;


	public function __construc()
	{

	}

	public function Listar()
	{
		$this->conex = DataBase::getInstance();
		// Preparar la sentencia
		$consulta = "SELECT * FROM FISC_UNIDADTRIBUTARIA";
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

		$result = array();

		// Obtener los resultados de la consulta
		while ($fila = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)){
			$it = new ArrayIterator($fila);
			$alm = new UT();
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

	public function Obtener($id)
	{
		$this->conex = DataBase::getInstance();
		$consulta = "SELECT * FROM FISC_UNIDADTRIBUTARIA WHERE ID_UNIDADT=:id";
		$stid = oci_parse($this->conex, $consulta);
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
		$alm = new UT();
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

	public function Eliminar($id)
	{
		$this->conex = DataBase::getInstance();
		$consulta = "DELETE FROM FISC_UNIDADTRIBUTARIA WHERE ID_UNIDADT= :id";
		$stid = oci_parse($this->conex, $consulta);
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
		oci_bind_by_name($stid, ':id', $id);
		$r = oci_execute($stid);
		if (!$r){
    		//$e = oci_error($stid);
    		//trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
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

	public function actualizar(UT $data)
	{
		$this->conex = DataBase::getInstance();
		$consulta = "UPDATE FISC_UNIDADTRIBUTARIA 
			SET 
				yinicio= :yin,
				minicio= :min,
				dinicio= :din,
				yfin= :yfn,
				mfin= :mfn,
				dfin= :dfn,
				valor= :val 
			WHERE 
				id_unidadt = :id";

		$stid = oci_parse($this->conex, $consulta);

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
		oci_bind_by_name($stid, ':yin', $data->__GET('yinicio'));
		oci_bind_by_name($stid, ':min', $data->__GET('minicio'));
		oci_bind_by_name($stid, ':din', $data->__GET('dinicio'));
		oci_bind_by_name($stid, ':yfn', $data->__GET('yfin'));
		oci_bind_by_name($stid, ':yin', $data->__GET('mfin'));
		oci_bind_by_name($stid, ':yin', $data->__GET('dfin'));
		oci_bind_by_name($stid, ':id', $data->__GET('id_unidadt'));
	}

	public function Registrar(UT $data)
	{
		$consulta = "INSERT INTO FISC_UNIDADTRIBUTARIA 
		(id_unidadt, yinicio, minicio, dinicio, yfin, mfin, dfin, valor) 
		VALUES (:id, :yin, :min, :din, :yfn, :mfn, :dfn, :val )";
		
		$id= $data->__GET('id_unidadt');
		$yinicio = $data->__GET('yinicio');
		$minicio = $data->__GET('minicio');
		$dinicio = $data->__GET('dinicio');
		$yfin = $data->__GET('yfin');
		$mfin = $data->__GET('mfin');
		$dfin = $data->__GET('dfin');
		$valor = $data->__GET('valor');
		
		//Preparamos la conexión a la base de datos
		$this->conex = DataBase::getInstance();
		
		//Preparamos la consulta
		$stid = oci_parse($this->conex,$consulta);
		
		if (!$stid){
			//Libera los recursos
			oci_free_statement($stid);
			// Cierra la conexión Oracle
			oci_close($this->conex);
			
			return false;
		}
		
		// Realizar la lógica de la consulta
		oci_bind_by_name($stid, ':id', $id);
		oci_bind_by_name($stid, ':yin', $yinicio);
		oci_bind_by_name($stid, ':min', $minicio);
		oci_bind_by_name($stid, ':din', $dinicio);
		oci_bind_by_name($stid, ':yfn', $yfin);
		oci_bind_by_name($stid, ':mfn', $mfin);
		oci_bind_by_name($stid, ':dfn', $dfin);
		oci_bind_by_name($stid, ':val', $valor);
		
		$r = oci_execute($stid);
		if (!$r){
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
	
	public function queryByValor($valor)
	{
		$this->conex = DataBase::getInstance();
		$consulta = "SELECT * FROM FISC_UNIDADTRIBUTARIA WHERE valor=:valor";
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
		$alm = new UT();
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
	
	/*	
	public function queryByFechaInicio($yinicio, $minicio, $dinicio)
	{
		
		try
		{
			$result = array();

			$stm = $this->pdo->prepare("SELECT * FROM ut WHERE anio_inicio= ? and mes_inicio= ? and dia_inicio= ?");
			$stm->execute(array($yinicio,$minicio,$dinicio));

			foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r)
			{
				$alm = new UT();

				$alm->__SET('id', $r->id_ut);
				$alm->__SET('yinicio', $r->anio_inicio);
				$alm->__SET('minicio', $r->mes_inicio);
				$alm->__SET('dinicio', $r->dia_inicio);
				$alm->__SET('yfin', $r->anio_fin);
				$alm->__SET('mfin', $r->mes_fin);
				$alm->__SET('dfin', $r->dia_fin);
				$alm->__SET('valor', $r->valor);

				$result[] = $alm;
			}

			return $result;
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}		
	}
	
	public function queryByYearInicio($yinicio)
	{
		
		try
		{
			$result = array();

			$stm = $this->pdo->prepare("SELECT * FROM ut WHERE anio_inicio= ?");
			$stm->execute(array($yinicio));

			foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r)
			{
				$alm = new UT();

				$alm->__SET('id', $r->id_ut);
				$alm->__SET('yinicio', $r->anio_inicio);
				$alm->__SET('minicio', $r->mes_inicio);
				$alm->__SET('dinicio', $r->dia_inicio);
				$alm->__SET('yfin', $r->anio_fin);
				$alm->__SET('mfin', $r->mes_fin);
				$alm->__SET('dfin', $r->dia_fin);
				$alm->__SET('valor', $r->valor);
				$result[] = $alm;
			}

			return $result;
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}		
	}
	
	public function queryByMesInicio($minicio)
	{
		
		try
		{
			$result = array();

			$stm = $this->pdo->prepare("SELECT * FROM ut WHERE mes_inicio= ?");
			$stm->execute(array($minicio));

			foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r)
			{
				$alm = new UT();

				$alm->__SET('id', $r->id_ut);
				$alm->__SET('yinicio', $r->anio_inicio);
				$alm->__SET('minicio', $r->mes_inicio);
				$alm->__SET('dinicio', $r->dia_inicio);
				$alm->__SET('yfin', $r->anio_fin);
				$alm->__SET('mfin', $r->mes_fin);
				$alm->__SET('dfin', $r->dia_fin);
				$alm->__SET('valor', $r->valor);

				$result[] = $alm;
			}

			return $result;
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}		
	}
	
	public function queryByDiaInicio($dinicio)
	{
		
		try
		{
			$result = array();

			$stm = $this->pdo->prepare("SELECT * FROM ut WHERE dia_inicio= ?");
			$stm->execute(array($dinicio));

			foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r)
			{
				$alm = new UT();

				$alm->__SET('id', $r->id_ut);
				$alm->__SET('yinicio', $r->anio_inicio);
				$alm->__SET('minicio', $r->mes_inicio);
				$alm->__SET('dinicio', $r->dia_inicio);
				$alm->__SET('yfin', $r->anio_fin);
				$alm->__SET('mfin', $r->mes_fin);
				$alm->__SET('dfin', $r->dia_fin);
				$alm->__SET('valor', $r->valor);

				$result[] = $alm;
			}

			return $result;
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}		
	}
	
	public function queryByFechaFin($yfin, $mfin, $dfin)
	{
		
		try
		{
			$result = array();

			$stm = $this->pdo->prepare("SELECT * FROM ut WHERE anio_fin= ? and mes_fin= ? and dia_fin= ?");
			$stm->execute(array($yfin,$mfin,$dfin));

			foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r)
			{
				$alm = new UT();

				$alm->__SET('id', $r->id_ut);
				$alm->__SET('yinicio', $r->anio_inicio);
				$alm->__SET('minicio', $r->mes_inicio);
				$alm->__SET('dinicio', $r->dia_inicio);
				$alm->__SET('yfin', $r->anio_fin);
				$alm->__SET('mfin', $r->mes_fin);
				$alm->__SET('dfin', $r->dia_fin);
				$alm->__SET('valor', $r->valor);

				$result[] = $alm;
			}

			return $result;
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}		
	}
	
	public function queryByYearFin($yfin)
	{
		
		try
		{
			$result = array();

			$stm = $this->pdo->prepare("SELECT * FROM ut WHERE anio_fin=?");
			$stm->execute(array($yfin));

			foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r)
			{
				$alm = new UT();

				$alm->__SET('id', $r->id_ut);
				$alm->__SET('yinicio', $r->anio_inicio);
				$alm->__SET('minicio', $r->mes_inicio);
				$alm->__SET('dinicio', $r->dia_inicio);
				$alm->__SET('yfin', $r->anio_fin);
				$alm->__SET('mfin', $r->mes_fin);
				$alm->__SET('dfin', $r->dia_fin);
				$alm->__SET('valor', $r->valor);

				$result[] = $alm;
			}

			return $result;
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}		
	}
	
	public function queryByMesFin($mfin)
	{
		
		try
		{
			$result = array();

			$stm = $this->pdo->prepare("SELECT * FROM ut WHERE mes_fin=?");
			$stm->execute(array($mfin));

			foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r)
			{
				$alm = new UT();

				$alm->__SET('id', $r->id_ut);
				$alm->__SET('yinicio', $r->anio_inicio);
				$alm->__SET('minicio', $r->mes_inicio);
				$alm->__SET('dinicio', $r->dia_inicio);
				$alm->__SET('yfin', $r->anio_fin);
				$alm->__SET('mfin', $r->mes_fin);
				$alm->__SET('dfin', $r->dia_fin);
				$alm->__SET('valor', $r->valor);

				$result[] = $alm;
			}

			return $result;
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}		
	}
	
	public function queryByDiaFin($dfin)
	{
		
		try
		{
			$result = array();

			$stm = $this->pdo->prepare("SELECT * FROM ut WHERE dia_fin=?");
			$stm->execute(array($dfin));

			foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r)
			{
				$alm = new UT();

				$alm->__SET('id', $r->id_ut);
				$alm->__SET('yinicio', $r->anio_inicio);
				$alm->__SET('minicio', $r->mes_inicio);
				$alm->__SET('dinicio', $r->dia_inicio);
				$alm->__SET('yfin', $r->anio_fin);
				$alm->__SET('mfin', $r->mes_fin);
				$alm->__SET('dfin', $r->dia_fin);
				$alm->__SET('valor', $r->valor);

				$result[] = $alm;
			}

			return $result;
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}		
	}
	*/
}
