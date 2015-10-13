<?php
	class Patrono
	{
		private $nombres;
		private $apellidos;
		private $num_pat;
		private $empresas; //Almacena el rif de las empresas Asociadas al patrono. Permite establecer relación con la clase Empresa.
		
		public function __construct($n, $a, $np, $e)
		{
			$this->nombres=$n;
			$this->apellidos=$a;
			$this->num_pat=$np;
			$this->empresas=$e;
		}
		
		public function setNombre($n,$a)
		{
			$this->nombres=$n;
			$this->apellidos=$a;
		}
		
		public function setNumPat($np)
		{
			$this->num_pat=$np;
		}
		
		//Empresas
		
		public function getNombre()
		{
			return $this->nombres." ".$this->apellidos;
		}
		
		public function getNumPat()
		{
			return $this->num_pat;
		}
		
		public function getEmpresas()
		{
			return $this->empresas;
		}
	}
?> 
