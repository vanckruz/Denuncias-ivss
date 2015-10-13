<?php
class UT
{
	private $id_unidadt;
	private $yinicio;
	private $minicio;
	private $dinicio;
	private $yfin;
	private $mfin;
	private $dfin;
	private $valor;

	public function __GET($k){ return $this->$k;}
	public function __SET($k, $v){ return $this->$k = $v;}
}