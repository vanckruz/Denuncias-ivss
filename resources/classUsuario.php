<?php  
class Usuario{
	
	private $id_user;
	private $nombre;
	private $apellido;
	private $correo;
	private $password;
	private $departamento;
	private $user_type;
	private $codigo_usuario;
	private $estado;
	private $session_id;
	private $int_borrado;
	
	public function __SET($key, $val){
		return $this->$key = $val;
	}

	public function __GET($key){
		return $this->$key;
	}
}
?>