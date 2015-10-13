<?php
class DenunciaJuridica
{
	//datos de la denuncia
	private $id_denuncia;
	private $id_empresa;
	private $fecha_denuncia;
	private $estatus_denuncia;
	private $responsable_denuncia;
	private $descripcion_denuncia;
	private $descripcion_estatus;
	private $hora_denuncia;
	private $asignada;
	private $creador;
	private $editor;
	private $fechaedicion;
	private $fecha_cierre;
	private $cerradopor;
	private $asignadopor;
	private $motivo_denuncia = array();
	private $documentos = array();
	private $archivos_queja = array();
	private $fisc_empresa;
	public function __GET($k){ return $this->$k;}
	public function __SET($k, $v){ $this->$k = $v;}
}

?>