<?php 
class RepresentanteEmpresa{
	private $clv_representante;
	private $str_nombres;
	private $str_apellidos;
	private $str_telefono1;
	private $str_telefono2;
	private $str_email;
	private $str_direccion;
	private $int_borrado;

	public function __GET($k){ return $this->$k;}
	public function __SET($k, $v){ $this->$k = $v; return $this;}
}
?>