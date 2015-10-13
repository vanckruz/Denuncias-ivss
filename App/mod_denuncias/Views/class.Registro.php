<?php
	//include("../Models/Ciudadanos/model_Ciudadano.php");
	//include("../Models/Denuncias/include_denuncia.php");
error_reporting(E_ALL);
ini_set("display_errors", 1);		
class Registro{
	private $persona;
	private $denuncia;
	private $empresa;
	private $nacionalidad_nueva;
	private $cedula_nueva;
	public function __construct($idc="", $ide="", $nac="", $ced="")
	{

		if($idc != "")
		{
			$ciudadano = new Ciudadano();
			$denuncia = new DenunciaDAO();
			$this->persona = $ciudadano->getById($idc);
			$this->denuncia = $denuncia->getByIC($idc);
			$this->nacionalidad_nueva = $nac;
			$this->cedula_nueva = $ced;
		}

		if($ide != "")
		{
			$modelo   = new EmpresaDAO();
			$denuncia = new DenunciaJuridicaDAO();
			$this->empresa = $modelo->queryByPatrono($ide);
			$this->denuncia = $denuncia->getByIdEmp($ide);
		}

	}

	public static function generateNumeroDenunciaNatural($c, $n)
	{
		if($n<10)
			$numero = "D-DGF-".date('Ymd')."-".$c."-00".$n;
		elseif($n>=10 && $n<100)
			$numero = "D-DGF-".date('Ymd')."-".$c."-0".$n;
		elseif($n>=100)
			$numero = "D-DGF-".date('Ymd')."-".$c."-".$n;
		return $numero;
	}

	public static function generateNumeroDenunciaJuridica($id, $n)
	{
		if($n<10)
			$numero = "QR-DGF-".date('Ymd')."-".$id."-00".$n;
		elseif($n>=10 && $n<100)
			$numero = "D-DGF-".date('Ymd')."-".$id."-0".$n;
		elseif($n>=100)
			$numero = "D-DGF-".date('Ymd')."-".$id."-".$n;
		return $numero;
	}

	public function showFormNatural($data)
	{	
			//Datos del Ciudadano denunciante
		$nacionalidad_nueva = $this->nacionalidad_nueva;
		$cedula_nueva = $this->cedula_nueva;
			$idc = $this->persona->__GET('id_ciudadano'); //id del ciudadano (tabla ciudadano)
 			//$nac = $this->persona->__GET('nacionalidad'); //Nacionalidad del denunciante
			$ced = $idc;//$this->persona->__GET('cedula'); // Cédula del denunciante
			$nom = $this->persona->__GET('primer_nombre')." ". $this->persona->__GET('segundo_nombre'); // Nombre del denunciante 
			$ape = $this->persona->__GET('primer_apellido')." ". $this->persona->__GET('segundo_apellido'); //Apellido del denunciante
			$fecha_nac = $this->persona->__GET('fecha_nacimiento');
			$sexo      = $this->persona->__GET('sexo');
			//Generar número de denuncia automático
			$nd = count($this->denuncia)+1;// Número de denuncias registradas por el denunciante
			$num_den = self::generateNumeroDenunciaNatural($ced, $nd); // Número de registro para la denuncia actual
			//Incluímos el formulario de nuevo registro
			require("../Views/registroDenuncia.php");
			//require("../Views/bottomView.tpl.php");
			//echo $nom . "<br/>" . $ape;
		}

		public function showFormJuridico()
		{	
			//Datos de la empresa denunciante

			$ide       = $this->empresa->__GET('id_empresa'); //N° Patronal (tabla empresa)
			$rif       = $this->empresa->__GET('rif');// Cédula de la empresa
			$nombre    = $this->empresa->__GET('nombre_empresa'); // Nombre de la empresa
			$direccion = $this->empresa->__GET('domicilio_completo');
			$email     = $this->empresa->__GET('email_principal'); //Email Empresa
			$telefono  = $this->empresa->__GET('telefono1'); //Email Empresa

			//Generar número de denuncia automático
			$nd = count($this->denuncia)+1;// Número de denuncias registradas por el denunciante
			$num_den = self::generateNumeroDenunciaJuridica($ide, $nd); // Número de registro para la denuncia actual
			
			$representante = dameRepresentante($ide);
			$ced_rep	   = $representante[0]['ID_CIUDADANO'];
			$nombre_rep	   = $representante[0]['PRIMER_NOMBRE']."  ".$representante[0]['SEGUNDO_NOMBRE'];;
			$apellido_rep  = $representante[0]['PRIMER_APELLIDO']."  ".$representante[0]['SEGUNDO_APELLIDO'];;	
			$tel_hab_rep   = $representante[0]['TELEFONO_HAB'];	
			$tel_mov_rep   = $representante[0]['TELEFONO_MOVIL'];	
			$email_rep	   = $representante[0]['EMAIL_PRINCIPAL'];
			//Incluímos el formulario de nuevo registro
			require("../Views/registroDenuncia3.php");
		}
	}
	?>