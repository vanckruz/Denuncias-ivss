<?php
	class Oficina
	{
		private $id_oficina;
		private $id_region;
		private $id_estado;
		private $id_jefe;
		private $siglas;
		private $nombre;
		private $direccion;

		public function __GET($k){ return $this->$k;}
		public function __SET($k, $v){ $this->$k = $v; return $this;}
	}  
?>