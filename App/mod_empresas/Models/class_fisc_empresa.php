<?php
class FiscEmpresa
{
	private $id_fisc_empresa;
	private $rif_fisc_empresa;
	private $nombre_fisc_empresa;
	private $telefono_fisc_empresa;
	private $email_fisc_empresa;
	private $direccion_fisc_empresa; 
	private $denuncias_fisc_empresa;
	private $punto_ref_fisc_empresa;
	private $fiscalizaciones_fisc_empresa;
	private $id_representante;
	private $fisc_empresa;
	private $estado;
	private $municipio;
	private $parroquia;
	private $calle;
	private $edificio;
	private $casa;
	
	public function __SET($k, $v){ return $this->$k = $v;}
	public function __GET($k){ return $this->$k;}
}		
?>