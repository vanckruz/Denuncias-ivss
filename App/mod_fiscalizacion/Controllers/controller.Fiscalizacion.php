<?php
	session_start();
	include('../../mod_fiscalizacion/Models/class_ficha.php');
	include('../../mod_fiscalizacion/Models/class_ficha_dao.php');
	include("../../mod_empresas/Models/model_Empresa.php");
	include("../../../resources/orcl_conex.php");
	include("../../../resources/select/funciones.php");
	$op = $_POST['operacion']; 
	if($op=="fiscalizar") 
	{
		if(isset($_POST['opciones'])){
			$clave = htmlentities($_POST['opciones']);
		}
		if($clave == 'numero_patronal')
		$valor = htmlentities($_POST['npat']);
		elseif($clave == 'rif')
		$valor = htmlentities($_POST['rif']);
		elseif($clave == 'nombre_empresa')
		$valor = htmlentities($_POST['nombre']);
		
		$modelo = new EmpresaDAO();
		if($clave=='rif')
		$empresa= $modelo->queryByRif($valor);
		else if($clave=='numero_patronal')
		$empresa= $modelo->queryByPatrono($valor);
		else if($clave=='nombre_empresa')
		$empresa= $modelo->queryByNombre($valor);
		if(count($empresa)==0)
		{
			echo "No hay empresa registrada con los datos suministrados";
		}
		elseif(count($empresa)==1)
		{
			//$it = new ArrayIterator($empresa);
			$funcionario           = $_SESSION['USUARIO']['nombre'];
			$funcionario          .= " ".$_SESSION['USUARIO']['apellido'];
			$ced_fun               = $_SESSION['USUARIO']['cedula'];
			$tipo                  = $_SESSION['USUARIO']['utype'];
			$nombre_seniat         = $empresa->__GET('nombre_empresa');
			$id_empresa            = $empresa->__GET('id_empresa');
			$id_riesgo             = $empresa->__GET('id_riesgo');
			$id_actividad          = $empresa->__GET('id_actividad');
			$representante         = dameRepresentante($empresa->__GET('id_empresa'));
			$nombre_representante  = $representante[0]['PRIMER_NOMBRE']." ".$representante[0]['SEGUNDO_NOMBRE'];
			$nombre_representante .= " ". $representante[0]['PRIMER_APELLIDO']." ".$representante[0]['SEGUNDO_APELLIDO'];
			$cedula_representante  = $representante[0]['ID_CIUDADANO'];

			$ficha = new FichaDAO();
		//consultar datos tiuna
			$resultado_tiuna = $ficha->datosTiuna($id_empresa);
		//consultar datos tiuna

		//consultar datos del riesgo
			$resultado_riesgo = $ficha->datosRiesgo($id_riesgo);
		//consultar datos del riesgo

		//consultar datos de Retención
			$resultado_retencion = $ficha->datosRetencion($id_riesgo);
		//consultar datos de Retención

		//consultar datos de actividad económica
			$resultado_actividad = $ficha->datosActividad($id_actividad);
		//consultar datos del riesgo
			
			/*
			echo "<pre>";
			print_r($resultado_tiuna);
			echo "</pre></br></br>";

			echo "<pre>";
			print_r($resultado_riesgo);
			echo "</pre></br></br>";

			echo "<pre>";
			print_r($resultado_retencion);
			echo "</pre></br></br>";

			echo "<pre>";
			print_r($resultado_actividad);
			echo "</pre></br></br>";
			*/
			
			$rif               = str_split($empresa->__GET('rif'));
			$np                = str_split($empresa->__GET('id_empresa'));
			$cedula            = "";
			$rif_emp           = $empresa->__GET('rif');
			$id_emp            = $empresa->__GET('id_empresa');
			$numero            = "DGF-FTCH-".date('Y')."/".$empresa->__GET('id_empresa');
			$numero_documento  = $resultado_tiuna[0]['MERC_NRO_DOCUMENTO'];
			$numero_tomo       = $resultado_tiuna[0]['MERC_NRO_TOMO'];
			$numero_folio      = $resultado_tiuna[0]['MERC_NRO_FOLIO'];
			$numero_protocolo  = $resultado_tiuna[0]['MERC_NRO_PROTOCOLO'];
			$fregistro_emp     = $resultado_tiuna[0]['MERC_FECHA_INSCRIPCION'];
			$factividad_emp    = $resultado_tiuna[0]['MERC_FECHA_ACTIVIDAD'];
			$finscripcion_emp  = $empresa->__GET('fecha_inscripcion');
			$fregistro         = str_split($resultado_tiuna[0]['MERC_FECHA_INSCRIPCION']);
			$factividad        = str_split($resultado_tiuna[0]['MERC_FECHA_ACTIVIDAD']);
			$finscripcion      = str_split($empresa->__GET('fecha_inscripcion'));
			$oficina           = $resultado_tiuna[0]['MERC_OFICINA_REGISTRO'];
			$email             = $resultado_tiuna[0]['EMAIL'];
			$telefono          = $empresa->__GET('telefono1');
			$empleados         = $empresa->__GET('cantidad_empleado');
			$direccion         = $empresa->__GET('domicilio_completo');
			$riesgo            = $resultado_riesgo[0]['DESC_RIESGO'];
			$actividad         = $resultado_actividad[0]['DESC_ACTIVIDAD'];
			$retencion         = $resultado_retencion[0]['RETENCION'];
			require("../Views/ficha.php");
			require("../Views/bottomView.tpl.php");
			
		}
		elseif(count($empresa)>1)
		{
			echo "La busqueda podujo más de un resultado";
		}
	}