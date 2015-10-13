<?php
		class Denuncia
		{
			var $numeroDenuncia;
			var $cedula;
			var $numeroPatronal; //Numero patronal. Asocia la denuncia a un patrono específico.
			var $fechaDenuncia;
			var $motivoDenuncia;
			var $estatusDenuncia;
			
			public function __construct(){}
			
			public function Denuncia($n,$c,$p,$f,$m,$e)
			{
				$this->numero=$n;
				$this->motivo=$m;
				$this->estatus=$e;
				$this->fecha=$f;
				$this->patrono=$p;
				$this->cedula=$c;
				
			}
			
			public function setEstatus($sts)
			{
				$this->estatusDenuncia=$sts;
			}
			
			public function setFecha($fec)
			{
				$this->fechaDenuncia=$fec;
			}
			
			public function setMotivo($mot)
			{
				$this->motivoDenuncia=$mot;
			}
			
			public function setNumero($num)
			{
				$this->numeroDenuncia=$num;
			}
			
			public function setPatrono($pat)
			{
				$this->numeroPatronal=$pat;
			}
			
			public function setCedula($ced)
			{
				$this->cedula=$ced;
			}
			
			public function getEstatus()
			{
				return $this->estatusDenuncia;
			}
			
			public function getFecha()
			{
				return $this->fechaDenuncia;
			}
			
			public function getMotivo()
			{
				return $this->motivoDenuncia;
			}
			
			public function getNumero()
			{
				return $this->numeroDenuncia;
			}
			
			public function getPatrono()
			{
				return $this->numeroPatronal;
			}
			
			public function getCedula()
			{
				return $this->cedula;
			}
		}
?>