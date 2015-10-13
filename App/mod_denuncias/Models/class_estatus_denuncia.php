<?php
	class EstatusDenuncia{
		private $id_estatus;
		private $descripcion;

		public function __GET($k){ return $this->$k;}
		public function __SET($k, $v){ $this->$k = $v;}
	}
 ?>