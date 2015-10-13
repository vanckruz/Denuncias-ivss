<?php
class Denuncia
{
	private $id_denuncia; //Identificador de la denuncia
	private $id_ciudadano; //Identificador del denunciante
	private $id_empresa; //Identificador de la empresa
	private $rif; //rif de la empresa denunciada
	//private $numero_denuncia; //Numero de la denuncia registrada
	private $fecha_denuncia; //Fecha de la denuncia registrada
	private $hora_denuncia;
	private $motivo_denuncia = array(); // Motivo de la denuncia
	private $estatus_denuncia; // estatus de la denuncia
	private $descripcion;
	private $descripcion_estatus;
	private $responsable;
	private $apoderado;
	private $nombres_apoderado;
	private $apellidos_apoderado;
	private $creadopor;
	private $updatedby;
	private $updatedate;
	private $asignacion;
	private $fecha_cierre;
	private $cerradopor;
	private $asignadopor;
	private $documentos=array();
	private $archivos_denuncia = array();
	private $fisc_empresa;
	public function __GET($k){ return $this->$k;}
	public function __SET($k, $v){ $this->$k = $v;}
}
