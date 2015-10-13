<?php 
class Fisc_Ciudadano{
	private $id_ciudadano; 
	private $nombres;  
	private $apellidos;
	private $direccion; 
	private $telefono_movil;	 
	private $telefono_habitacion;  
	private $correo;

	public funtion __SET($k, $v){
		$this->$k = $v;
		return $this;
	}

	public funtion __GET($k){
		return $this->$k;
	}
}
 ?>}

