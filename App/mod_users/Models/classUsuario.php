<?php  
class Usuario{
		//Datos del usuario
	private $nacionalidad;
	private $id_user;
	private $nombre;
	private $apellido;
	private $correo;
	private $password;
	private $region;
	private $estado;
	private $oficina;
	private $departamento;
	private $user_type;
	private $direccion_general;
	private $direccion_linea;
	private $usuario;
	private $codigo_usuario;
	private $telefono_habitacion;
	private $telefono_movil;
	private $int_borrado;

	
	public function __SET($key, $val){
		return $this->$key = $val;
	}

	public function __GET($key){
		return $this->$key;
	}
}
?>