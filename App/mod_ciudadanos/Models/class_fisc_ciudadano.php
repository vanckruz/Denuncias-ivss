<?php 
class FiscCiudadano{
	private $id_ciudadano; 
	private $nombres;  
	private $apellidos;
	private $direccion; 
	private $telefono_movil;	 
	private $telefono_habitacion;  
	private $correo;

	public function __SET($k, $v){
		$this->$k = $v;
		return $this;
	}

	public function __GET($k){
		return $this->$k;
	}
}
 ?>