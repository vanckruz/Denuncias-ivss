<?php
class DireccionesAsignacion
{
	private $id_direccion; //Identificador de la denuncia
	private $nombre; //Identificador del denunciante
	private $correo; //Identificador de la empresa
	private $intborrado;
	public function __GET($k){ return $this->$k;}
	public function __SET($k, $v){ $this->$k = $v;}
}
