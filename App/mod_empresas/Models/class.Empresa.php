<?php
class Empresa
{
	private $id_empresa;
	private $id_tipo_empresa;
	private $id_riesgo;
	private $id_sociedad;
	private $id_actividad;
	private $id_catastro;
	private $id_estatus;
	private $id_estado;
	private $id_zona_postal;
	private $id_oficina_ivss;             
	private $rif;
	private $nit;
	private $nombre_empresa;              
	private $domicilio_completo;           
	private $telefono1;                 
	private $telefono2;                 
	private $fecha_inscripcion;             
	private $cantidad_empleado;                  
	private $email_principal;                            
	private $fax;
	private $email_secundario;
	private $saldo_deuda;
	private $saldo_convenio;
	private $interes_deuda;
	private $clasificacion_empresa;
	private $empresa_sane;
	private $indemnizacion_factura;
	private $fecha_constitucion;
	private $fecha_inactivacion;
	private $fisc_empresa;
	
	public function __SET($k, $v){ return $this->$k = $v;}
	public function __GET($k){ return $this->$k;}
}	
?>