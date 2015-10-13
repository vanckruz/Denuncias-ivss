<?php
class Funcionario
{
	private $id_funcionario;
	private $id_oficina;
	private $nacionalidad;
	private $primer_nombre;
	private $segundo_nombre;
	private $primer_apellido;
	private $segundo_apellido;
	//private $codigo_funcionario;
	private $cargo;

	public function __GET($k){ return $this->$k;}
	public function __SET($k, $v){ $this->$k = $v; return $this;}
}  
?>