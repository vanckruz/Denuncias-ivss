<?php
		class Denuncia
		{
			private $cedulaDenunciante; //Asocia la denuncia a un Ciudadano específico
			private $patronoDenunciado; //Numero patronal. Asocia la denuncia a un patrono específico.
			private $numeroDenuncia;  
			private $fechaDenuncia;
			private $motivoDenuncia;
			private $estatusDenuncia;
	
			public function __construc(){}
			
			public function Denuncia($cDenunciante, $nPatrono, $nDenuncia, $fDenuncia, $mDenuncia, $eDenuncia)
			{
				$this->cedulaDenunciante=$cDenunciante;
				$this->patronoDenunciado=$nPatrono;
				$this->numeroDenuncia=$nDenuncia;
				$this->fechaDenuncia=$fDenuncia;
				$this->motivoDenuncia=$mDenuncia;
				$this->estatusDenuncia=$eDenuncia;
			}
			
			//Establece la cedula del denunciante
			public function setCedula($cDenunciante)
			{
				$this->cedulaDenunciante=$cDenunciante;
			}
			
			//devuelve la cedula del denunciante
			public function getCedula()
			{
				return $this->cedulaDenunciante;
			}
			
			//Establece el numero patronal del denunciado
			public function setPatrono($nPatrono)
			{
				$this->patronoDenunciado=$nPatrono;
			}
			
			//Devuelve el numero patronal del denunciado
			public function getPatrono()
			{
				return $this->patronoDenunciado;
			}
			
			//Establece el numero de la denuncia. Número único que identifica a cada denuncia
			public function setNumero($num)
			{
				$this->numeroDenuncia=$num;
			}
			
			//Devuelve el numero de la denuncia
			public function getNumero()
			{
				return $this->numeroDenuncia;
			}
			
			//Establece la fecha en que se realiza la denuncia
			public function setFecha($fDenuncia)
			{
				$this->fechaDenuncia=$fDenuncia;
			}
			
			//Devuelve la fecha de la denuncia
			public function getFecha()
			{
				return $this->fechaDenuncia;
			}
			
			//Establece el motivo de la denuncia
			public function setMotivo($mot)
			{
				$this->motivoDenuncia=$mot;
			}
			
			//Devuelve el motivo de la denuncia
			public function getMotivo()
			{
				return $this->motivoDenuncia;
			}
			
			//Establece el estatus de la denuncia
			public function setEstatus($estatus)
			{
				$this->estatusDenuncia=$estatus;
			}
			
			//Devuelve el estatus de la denuncia
			public function getEstatus()
			{
				return $this->estatusDenuncia;
			}
			
		}
?>