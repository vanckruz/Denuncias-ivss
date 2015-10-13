<?php
class UT
{
	private $id;
	private $inicio;
	private $fin;
	private $valor;

	public function __GET($k){ return $this->$k; }
	public function __SET($k, $v){ return $this->$k = $v; }
}