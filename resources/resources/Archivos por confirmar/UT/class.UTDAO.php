<?php
class UTDAO
{
	private $pdo;

	public function __CONSTRUCT($provider)
	{
		try
		{
			$this->pdo = new PDO($provider.':host=localhost;dbname=fiscalsystem', 'root', '');
			$this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);		        
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function Listar()
	{
		try
		{
			$result = array();

			$stm = $this->pdo->prepare("SELECT * FROM ut");
			$stm->execute();

			foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r)
			{
				$alm = new UT();

				$alm->__SET('id', $r->id);
				$alm->__SET('inicio', $r->inicio);
				$alm->__SET('fin', $r->fin);
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

	public function Obtener($id)
	{
		try 
		{
			$stm = $this->pdo->prepare("SELECT * FROM ut WHERE id = ?");
			$stm->execute(array($id));
			$r = $stm->fetch(PDO::FETCH_OBJ);
			$alm = new Alumno();
			$alm->__SET('id', $r->id);
			$alm->__SET('inicio', $r->inicio);
			$alm->__SET('fin', $r->fin);
			$alm->__SET('valor', $r->valor);
			return $alm;
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Eliminar($id)
	{
		try 
		{
			$stm = $this->pdo->prepare("DELETE FROM ut WHERE id = ?");			          

			$stm->execute(array($id));
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Actualizar(UT $data)
	{
		try 
		{
			$sql = "UPDATE ut SET 
						inicio= ?, 
						fin= ?,
						valor=?
				    WHERE id = ?";

			$this->pdo->prepare($sql)
			     ->execute(
				array(
					$data->__GET('inicio'), 
					$data->__GET('fin'), 
					$data->__GET('valor'),
					$data->__GET('id')
					)
				);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Registrar(UT $data)
	{
		try 
		{
		$sql = "INSERT INTO ut (inicio,fin,valor) 
		        VALUES (?, ?, ?)";

		$this->pdo->prepare($sql)
		     ->execute(
			array(
				$data->__GET('inicio'), 
				$data->__GET('fin'), 
				$data->__GET('valor')
				)
			);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
		return true;
	}
}