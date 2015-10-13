<?php
class CiudadanoDAO
{
	private $pdo;
	
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

	public function listar()
	
	{
		try
		{
			$result = array();

			$stm = $this->pdo->prepare("SELECT * FROM ciudadano");
			$stm->execute();

			foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r)
			{
				$alm = new Ciudadano();

				$alm->__SET('id', $r->id);
				$alm->__SET('nacionalidad', $r->nacionalidad);
				$alm->__SET('cedula', $r->cedula);
				$alm->__SET('nombreCiudadano', $r->nombre_ciudadano);
				$alm->__SET('apellidoCiudadano', $r->apellido_ciudadano);

				$result[] = $alm;
			}

			return $result;
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function obtener($nac, $ced)
	{
		try 
		{
			$stm = $this->pdo->prepare("SELECT * FROM ciudadano WHERE nacionalidad = ? and cedula = ?");
			$stm->execute(array($nac, $ced));
			$r = $stm->fetch(PDO::FETCH_OBJ);
			if($r)
			{	$alm = new Ciudadano();
				echo $r->cedula;
				$alm->__SET('id', $r->id_ciudadano);
				$alm->__SET('nacionalidad', $r->nacionalidad);
				$alm->__SET('cedula', $r->cedula);
				$alm->__SET('nombreCiudadano', $r->nombre_ciudadano);
				$alm->__SET('apellidoCiudadano', $r->apellido_ciudadano);
				return $alm;
			}
			else
			return;
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function actualizar(Ciudadano $data)
	{
		try 
		{
			$sql = "UPDATE ciudadano SET 
						nacionalidad= ?,
						cedula= ?, 
						nombre_ciudadano= ?,
						apellido_ciudadano=?
				    WHERE id_ciudadano = ?";

			$this->pdo->prepare($sql)
			     ->execute(
				array(
					$data->__GET('nacionalidad'),
					$data->__GET('cedula'), 
					$data->__GET('nombreCiudadano'), 
					$data->__GET('apellidoCiudadano'),
					$data->__GET('id')
					)
				);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}
}