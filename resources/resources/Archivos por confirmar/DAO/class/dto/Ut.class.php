<!doctype html>
<html lang="ES">
	<head>
		<meta charset="utf-8">
		<title>Documento sin título</title>
	</head>
	<body>
    	<?php
			class Ut
			{
				var $id;
				var $inicio;
				var $fin;
				var $valor;
				
				public function __construct(){}
				
				public function Ut($inicio, $fin, $valor)
				{
					$this->inicio=$inicio;
					$this->fin=$fin;
					$this->valor=$valor;
				}
				
				public function setInicio($dat)
				{
					$this->inicio=$dat;
				}
				
				public function getInicio()
				{
					return $this->inicio;
				}
				
				public function setFin($dat)
				{
					$this->fin=$dat;
				}
				
				public function getFin()
				{
					return $this->fin;
				}
				
				public function setValor($dat)
				{
					$this->valor=$dat;
				}
				
				public function getValor()
				{
					return $this->valor;
				}	
			}	
		?>
	</body>
</html>