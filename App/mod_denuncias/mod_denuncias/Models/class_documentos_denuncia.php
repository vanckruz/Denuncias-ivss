<?php
		class DocumentoDenuncia
		{
			private $id_documento; //Identificador del documento
			private $descripcion; //descripción del documento
			public function __GET($k){ return $this->$k;}
			public function __SET($k, $v){ $this->$k = $v;}
		}
