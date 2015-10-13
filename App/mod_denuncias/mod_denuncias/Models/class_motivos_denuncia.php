<?php
	class MotivoDenuncia
	{
		private $id_motivo; //Identificador del motivo
		private $descripcion; //descripción del motivo
		public function __GET($k){ return $this->$k;}
		public function __SET($k, $v){ $this->$k = $v;}
	}
 