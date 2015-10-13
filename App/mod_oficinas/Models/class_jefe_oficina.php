<?php
	class JefeOficina
	{
		private $nacionalidad;
		private $id_jefe;
		private $primer_nombre;
		private $segundo_nombre;
		private $primer_apellido;
		private $segundo_apellido;
		private $tratamineto_protocolar;
		private $numero_resolucion;
		private $fecha_resolucion;

		public function __GET($k){ return $this->$k;}
		public function __SET($k, $v){ $this->$k = $v; return $this;}
	}  
?>