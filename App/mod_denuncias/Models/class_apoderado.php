<?php
class Apoderado
{
	private $id_apoderado;
	private $nombres_apoderado;
	private $apellidos_apoderado;
	public function __GET($k){ return $this->$k;}
	public function __SET($k, $v){ $this->$k = $v;}
}
