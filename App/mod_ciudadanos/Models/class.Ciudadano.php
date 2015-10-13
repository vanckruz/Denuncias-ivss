<?php
class Ciudadano extends CiudadanoDAO
{
	private $id_ciudadano;
	private $primer_nombre;
	private $segundo_nombre;
	private $primer_apellido;
	private $segundo_apellido;
	private $telefono_hab;
	private $telefono_movil;
	private $sexo;
	private $fecha_nacimiento;
	//private $direccion;
	public function __construct()
	{
		parent::__construct();
	}	
	public function __GET($k){ return $this->$k; }
	public function __SET($k, $v){ return $this->$k = $v;}
}
