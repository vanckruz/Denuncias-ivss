<?php

	class Empresa
	{
		private $rif;
		private $nombre;
		private $direccion;
		private $telefono;
		private $patrono;//Numero patronal
		
		public function __construc($r, $n, $d, $t, $p)
		{
			$this->rif=$r;
			$this->nombre=$n;
			$this->direccion=$d;
			$this->telefono=$t;
			$this->patrono=$p;
		}
		
		public function setRif($rif)
		{
			$this->rif=$rif;
		}
		
		public function setNombre($nom)
		{
			$this->nombre=$nom;
		}
		
		public function setDireccion($dir)
		{
			$this->direccion=$dir;
		}
		
		public function setTelefono($tel)
		{
			$this->telefono=$tel;
		}
		
		public function setPatrono($pat)
		{
			$this->patrono=$pat;
		}
		
		public function getRif()
		{ return $this->rif;}
		
		public function getNombre()
		{return $this->nombre;}
		
		public function getDireccion()
		{ return $this->direccion;}
		
		public function getTelefono()
		{ return $this->telefono;}
		
		public function getNumPat()
		{return $this->patrono;}
		
		/**
		*
		*Devuelve un array con todas las propiedades del objeto
		*
		**/
		public function getAll()
		{
			$data=array(rif=>getRif(), nombre=>getNombre(), direccion=>getDireccion(), telefono=>getTelefono(), numpat=>getNumPat());
			return $data;
		}
		
	}
?>