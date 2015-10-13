<?php
	//include('DataBase.php'); Funcionando actualmente
	//include('classConexion.php');
include('orcl_conex.php');
class UsuarioDAO{
	private $pdo;
	private $conex;

		/* constructor PDO
		public function __construct()
		{
			try
			{
				$this->pdo = DataBase::getInstance();
				//$this->pdo = Conexion::getInstance();
			}
			catch(Exception $e)
			{
				die($e->getMessage());
			}
		}
		*/

		public function __construct(){
			$this->conex = DataBase::getInstance();
		}

		/* Método PDO ObtenerUsuario
		public function obtenerUsuario($cedula, $email, $password){
			$alm = new Usuario();
			try
			{
				$stm = $this->pdo->prepare("SELECT * FROM users WHERE cedula = :cedula AND correo = :email and fiscalSystemUserPass=:pass");
				$stm->execute(array(':cedula'=>$cedula, ':email'=>$email,':pass'=>$password));

				foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r)
				{
					$alm->__SET('id', $r->id_user);
					$alm->__SET('cedula', $r->cedula);
					$alm->__SET('nombre', $r->nombre);
					$alm->__SET('apellido', $r->apellido);
					$alm->__SET('email', $r->correo);
					$alm->__SET('password', $r->fiscalSystemUserPass);
					$alm->__SET('type', $r->user_type);
				}

				return $alm;
			}
			catch(Exception $e)
			{
				die($e->getMessage());
			}
		}*/
		/*Método "NO-PDO" obtenerUsuario()*/ 
		public function obtenerUsuario($email){
			// Preparar la sentencia
			$consulta = "SELECT * FROM FISC_USERS WHERE CORREO=:email";
			$stid = oci_parse($this->conex, $consulta);
			if (!$stid){
				$e = oci_error($this->conex);
				trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
			}
			//Realizar la lógica de la consulta
			oci_bind_by_name($stid, ':email', $email);
			$r = oci_execute($stid);
			if (!$r){
				$e = oci_error($stid);
				trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
			}
			// Obtener los resultados de la consulta
			$alm = new Usuario();
			//
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

		public function registrarUsuario($datos){}

		public function modificarUsuario($ced, $datos){}

		public function eliminarUsuario($cedula){}

		public function update_session(&$usuario){
			// Preparar la sentencia
			$consulta = "UPDATE FISC_USERS SET 
			SESSION_ID=:session_id
			WHERE id_user=:id_user";
			$stid = oci_parse($this->conex, $consulta);
			if (!$stid){
				$e = oci_error($this->conex);
				trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
				return false;
			}
			//Realizar la lógica de la consulta
			$session_id = $usuario->__GET('session_id'); 
			$id_user    = $usuario->__GET('id_user');
			oci_bind_by_name($stid, ':session_id', $session_id);
			oci_bind_by_name($stid, ':id_user', $id_user);
			$r = oci_execute($stid);
			if (!$r){
				$e = oci_error($stid);
				trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
				return false;
			}
			//Libera los recursos
			oci_free_statement($stid);
			// Cierra la conexión Oracle
			oci_close($this->conex);
			//retorna el resultado de la consulta 
			return true;
		}
	}
	?>