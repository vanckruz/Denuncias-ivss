<?php
/**
 * 
 */
 class Ficha
 {
	private $id_ficha;
	private $fecha_elaboracion;
	private $id_empresa;
	private $rif;
	private $nombre_empresa_ivss;
	private $nombre_empresa_seniat;
	private $id_representante;
	private $nombre_representante;
	private $direccion_ivss;
	private $direccion_fiscalizacion;
	private $oficina_registro;
	private $fecha_registro;
	private $numero;
	private $tomo;
	private $folio;
	private $protocolo;
	private $fecha_inicio_actividad;
	private $fecha_inscripcion_ivss;
	private $numero_sucursales;
	private $denominacion_comercial;
	private $email_empresa;
	private $telefono_empresa;
	private $persona_contacto;
	private $registro_ivss;
	private $registro_tiuna;
	private $nivel_riesgo;
	private $retencion;
	private $actividad_economica;
	private $trabajadores_activos;
	private $afiliados_ivss;
	private $diferencia_trabajadores;
	private $forma14_02;
	private $forma14_03;
	private $cambio_salario;
	private $morosidad;
	private $observaciones;
	private $id_funcionario;
	private $nombre_funcionario;

	public function __SET($clave, $valor)
	{
		return $this->$clave = $valor;
	}

	public function __GET($clave)
	{
		return $this->$clave;
	}
 } 
 ?>