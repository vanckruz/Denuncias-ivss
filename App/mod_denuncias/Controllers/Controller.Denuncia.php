	<?php
	session_start();
	header('Content-Type: text/html; charset=UTF-8');
	error_reporting(E_ALL);
	ini_set("display_errors", 1);
	date_default_timezone_set('America/Caracas');

	require('../../config/config.php');
	include("../Models/include_denuncia.php");
	include("../Models/class_apoderado.php");
	include("../Models/model_apoderado.php");
	include("../Models/class_representante.php");
	include("../Models/model_representante.php");
	include("../Views/Mensajes.php");
	include("../Views/class.Registro.php");	
	include("../../mod_ciudadanos/Models/model_Ciudadano.php");
	include("../../mod_ciudadanos/Models/class.Ciudadano.php");
	include("../../mod_ciudadanos/Models/class_fisc_ciudadano.php");
	include("../../mod_ciudadanos/Models/class_fisc_ciudadanoDAO.php");
	include("../../mod_empresas/Models/model_Empresa.php");
	include("../../mod_empresas/Models/class_fisc_empresa.php");
	include("../../mod_empresas/Models/class_fisc_empresaDAO.php");	
	include('../../../resources/orcl_conex.php');
	include('../../../resources/select/funciones.php');
	
	// capturar la acción a realizar
	$op = $_POST['option'];
/*
	switch ($op) {
		case 'registro':
			MostrarFormRegistro();
			break;

		case 'registrar':
			registrarDenuncia();
			break;

		case 'consultar':
			consultarDenuncia();
			break;

		case 'details':
			DetallesDenuncia();
			break;

		case 'actualizar':
			MostrarFormUpdate();
			break;

		case 'update':
			actualizarDenuncia();
			break;
		
		default:
			# code...
			break;
	}
*/
		//Funciones previas

		//ajustar cédula al formato de la base de datos
	function prepara_cedula($ced)
	{
		if(strlen ($ced)<9)
		{
			$ceros = 9-strlen($ced);
			$aux = $ced;
			$ced="";
			for($i=0;$i<$ceros;$i++){
				$ced.=0;
			}
			$ced.=$aux;
		}
		return $ced;
	}

	function existe_denuncia($id_empresa)
	{
		$modelo    = new DenunciaDAO();
		$denuncias = $modelo->getById($id_empresa);
		$existe=0;
		foreach($denuncias as $key)
		{
			if($key->__GET('estatus_denuncia')=='0')
			{
				$existe++;
			}
		}
		return $existe;
	}

		//Verificar existecia de Ciudadanos
	function queryCiudadano($id, &$ciudadano, $ciudadanod)
	{
		$ciudadano = $ciudadanod->getById($id);
		if($ciudadano->__GET('id_ciudadano')!='')
			return true;
		else
			return false;
	}

		// Verificar existencia de denuncias para el usuario actual
	function queryDenuncia($id_ciu="", $id_emp="", &$denuncia, $modelo)
	{
		$existe = 0;
		if($id_ciu !="")
			$denuncia = $modelo->getByIC($id_ciu);

		if($id_emp !="")
			$denuncia = $modelo->getByIdEmp($id_emp);

		$it = new ArrayIterator($denuncia);
		while($it->valid())
		{
			if($it->current()->__GET('id_denuncia')!='')
			{
				$existe++;
			}
			$it->next();
		}

		if($existe !=0)
			return true;
		else
			return false;
	}

		//Verificar existencia de Empresa
	function existe_empresa($clave, $valor, &$empresa, $modelo)
	{
		$existe  = 0;
		$empresa = $modelo->consultar_empresa($clave, $valor);

		$it = new ArrayIterator($empresa);
		while($it->valid())
		{
			if($it->current()->__GET('id_empresa')!='')
			{
				$existe++;
			}
			$it->next();
		}

		if($existe !=0)
			return true;
		else
			return false;
	}

		//Procesar las peticiones

		//Petición de registro de denuncia
	if($op=='registro')
	{

		echo "ESTOY EN EL CONTROLADOR"; exit();

		//htmlentities($str,ENT_COMPAT,'UTF-8');
		$denunciante = htmlentities($_POST["ciudadano"],ENT_COMPAT,'UTF-8');
			//Es una Persona Jurídica
		if($denunciante=='empresa')
		{
			include("../Models/class_denuncia_juridica.php");
			include("../Models/class_denuncia_juridica_dao.php");

			$id_empresa = htmlentities($_POST['id_empresa_ciu_nat']);
			$modelo     = new DenunciaJuridicaDAO();
			$denuncia   = new DenunciaJuridica();
			$registro = new Registro('', $id_empresa, '', '');
			$registro->showFormJuridico();
			/*
			if(queryDenuncia('', $id_empresa, $denuncia, $modelo))
			{
				$existe=0;
				foreach($denuncia as $key)
				{
					if($key->__GET('estatus_denuncia')=='0')
					{
						$existe++;
					}
				}
				if($existe!=0)
				{
						//Impedir registro de denuncia
					$mensaje = new Visualizer('QR','EXIST');
					$mensaje->showMensaje();	
				}
				else
				{
					$registro = new Registro('', $id_empresa, '', '');
					$registro->showFormJuridico();	
				}
			}//FIN queryDenuncia
				else
				{
					$registro = new Registro('', $id_empresa, '', '');
					$registro->showFormJuridico();
				}
			*/
		}//FIN Persona Jurídica
	else if($denunciante=='persona')//Es una Persona Natural
	{
		
		$ciudadano = new Ciudadano();
		$ciudadanod = new CiudadanoDAO();
		$denuncia = new Denuncia();
		$denunciad = new DenunciaDAO();
		$nac = htmlentities($_POST["nacionalidad"]);
		$cedula = htmlentities($_POST["cedula"]);
		$ced = prepara_cedula(htmlentities($_POST["cedula"]));
		$id_ciu = $nac.$ced;

    //inicio Consultar Ciudadano
		if(queryCiudadano($id_ciu, $ciudadano, $ciudadanod))
		{
			//Inicio Consultar denuncias
			if(queryDenuncia($id_ciu, '', $denuncia, $denunciad))
			{
				$existe=0;
				foreach($denuncia as $key)
				{
							//if(strtoupper($key->__GET('estatusDenuncia'))=='PROCEDENTE')
					if($key->__GET('id_empresa')==$_POST['id_empresa_ciu_nat'] && $key->__GET('estatus_denuncia')=='0')
					{
						$existe++;
					}
				}
				if($existe!=0)
				{
							//Impedir registro de denuncia
					$mensaje = new Visualizer('DEN','EXIST');
					$mensaje->showMensaje();	
				}
				else
				{
					$registro = new Registro($id_ciu, '', $nac, $cedula);
					$registro->showFormNatural($_POST['empresas_completas_ciu']);	
				}
					}//FIN queryDenuncia
					else
					{
						$registro = new Registro($id_ciu, '', $nac, $cedula);
						$registro->showFormNatural($_POST['empresas_completas_ciu']);
					}
				}//FIN queryCiudadano
				else
				{
					$mensaje = new Visualizer('CIU','NRF');
					$mensaje->showMensaje();
				}

			}//FIN Persona Natural
			
		}
		
		elseif($op=='consultar')
		{
			$persona = htmlentities($_POST['ciudadano']);

			if($persona == 'persona')
			{
				$ciudadano = new Ciudadano();
				$ciudadanod = new CiudadanoDAO();
				$denuncia = new Denuncia();

				$denunciad = new DenunciaDAO();
				$id_ciu = htmlentities($_POST["cedula"]);
				if(queryCiudadano($id_ciu, $ciudadano, $ciudadanod))
				{
					if(queryDenuncia($id_ciu, '', $denuncia, $denunciad))
					{	
						$visualizador = new Visualizer();
						$visualizador->mostrarDenuncia($denuncia);//paso los objetos
					}
					else
					{
						$visualizador = new Visualizer('DEN','NRF');
						$visualizador->showMensaje();
					}
				}
				else
				{
					$mensaje = new Visualizer('CIU','NRF');
					$mensaje->showMensaje();
				}
			}

			if($persona == 'empresa')
			{
				
				include("../Models/class_denuncia_juridica.php");
				include("../Models/class_denuncia_juridica_dao.php");
				$filtro = htmlentities($_POST['opciones']);
				$valor  = htmlentities($_POST['valor']);
				$denuncia = new DenunciaJuridica();//Queja o reclamo
				$denuncia = consultarDenuncia($filtro, $valor);
				if(empty($denuncia))
				{					
					$visualizador = new Visualizer('DEN','NRF');
					$visualizador->showMensaje();
				}

				else
				{
					$visualizador = new Visualizer();
					$visualizador->mostrarDenunciaJuridica($denuncia);
				}
			}
		}
		
		elseif($op=='actualizar')
		{
			$ciudadano = new Ciudadano();
			$ciudadanod = new CiudadanoDAO();
			$denuncia = new Denuncia();
			$denunciad = new DenunciaDAO();
			$nac = htmlentities($_POST["nacionalidad"]);
			$ced = prepara_cedula(htmlentities($_POST["cedula"]));
			$id_ciu = $nac.$ced;
			if(queryCiudadano($id_ciu, $ciudadano, $ciudadanod))
			{
				if(queryDenuncia($id_ciu, '', $denuncia, $denunciad))
				{
					$mensaje = new Visualizer();
					$mensaje->mostrarUpdateDen($denuncia,$ciudadano);
					
					}//FIN if(queryDenuncia)
					else
					{
						$mensaje = new Visualizer('DEN','NRF');
						$mensaje->showMensaje();
					}
					
				}//Fin if(queryCiudadano)
				else
				{
					$mensaje = new Visualizer('CIU','NRF');
					$mensaje->showMensaje();
				}

			}
			
			else if($op=='eliminar')
			{
				$ciudadano = new Ciudadano();
				$ciudadanod = new CiudadanoDAO();
				$denuncia = new Denuncia();
				$denunciad = new DenunciaDAO();
				$nac = addslashes($_POST["nacionalidad"]);
				$ced = prepara_cedula(htmlentities($_POST["cedula"]));
				$id_ciu = $nac.$ced;
				if(queryCiudadano($id_ciu, $ciudadano, $ciudadanod))
				{
					if(queryDenuncia($id_ciu, '', $denuncia, $denunciad))
					{
						$mensaje = new Visualizer();
						$mensaje->showDelDen($denuncia,$ciudadano);
						
					}//FIN if(queryDenuncia)
					else
					{
						$mensaje = new Visualizer('DEN','NRF');
						$mensaje->showMensaje();
					}
					
				}//Fin if(queryCiudadano)
				else
				{
					$mensaje = new Visualizer('CIU','NRF');
					$mensaje->showMensaje();
				}
				
			}
			
			else if($op == 'editar') 
			{
				$ciudadano = new FiscCiudadano();
				$ciudadanod = new FiscCiudadanoDAO();
				$denuncia = new Denuncia();
				$denunciad = new DenunciaDAO();
				$id = addslashes($_POST['id']);
				$denuncia = $denunciad->getById($id);
				$motivos    = $denunciad->getMotivos($denuncia);
				$documentos = $denunciad->getDocumentos($denuncia);
				$denuncia->__SET('motivo_denuncia', $motivos);
				$denuncia->__SET('documentos', $documentos);
				$ciudadano = $ciudadanod->getbyId($denuncia->__GET('id_ciudadano'));
				$modelo = new FiscEmpresaDAO();
				$empresa = new FiscEmpresa();
				$empresa = $modelo->queryByRif($denuncia->__GET('rif'));
				$mensaje = new Visualizer();
				$mensaje->showUpForm($denuncia, $ciudadano, $empresa);	
			} 

			else if($op == 'editarjuridico') 
			{
				include("../Models/class_denuncia_juridica.php");
				include("../Models/class_denuncia_juridica_dao.php");
				$denuncia = new DenunciaJuridica();
				$denunciad = new DenunciaJuridicaDAO();
				$id = htmlentities($_POST['id']);
				$denuncia = $denunciad->getById($id);
				$mensaje = new Visualizer();
				$mensaje->showUpFormJuridico($denuncia);	
			} 

			else if($op == 'update')
			{ 	
				$denuncia             = new Denuncia();
				$denunciad            = new DenunciaDAO();
				$id                   = htmlentities($_POST['id_den']);
				//$estatus              = htmlentities(addslashes($_POST['estatus']));
				$estatus              = 2;
				//$descripcion_estatus  = htmlentities($_POST['descripcion_estatus'],ENT_COMPAT,'UTF-8');
				$descripcion_estatus  = utf8_decode(htmlentities($_POST['descripcion_estatus'], ENT_COMPAT,'UTF-8'));
				
				$fecha_cierre = date('d/m/Y');
				/*
				if(!empty($_POST['responsable']))
				{
					$responsable = htmlentities(addslashes($_POST['responsable']));
				}
				else
				{
					$responsable = "018";
				}
				*/

				$denuncia             ->__SET('id_denuncia'         , $id);
			//$denuncia             ->__SET('fecha_denuncia'      , $fecha);
			//$denuncia             ->__SET('motivo_denuncia'     , $motivo);
				$denuncia             ->__SET('estatus_denuncia'    , $estatus);
			//$denuncia             ->__SET('descripcion_denuncia', $descripcion_denuncia);
				$denuncia             ->__SET('descripcion_estatus' , $descripcion_estatus);    
				$denuncia             ->__SET('fecha_cierre' , $fecha_cierre);    
				//$denuncia             ->__SET('responsable'         , $responsable);  
				if(!empty($_POST['documentos']))
				{
					$doc = $_POST['documentos'];
					$denuncia->__SET('documentos', $doc);
				}

				if(!empty($_FILES['archivosdenuncia']))
				{
					$archivos = array();
					foreach ($_FILES["archivosdenuncia"]["name"] as $key => $nombre) 
					{
						if(!empty($nombre))
						{
							array_push($archivos, $nombre);
						}
					}
					$denuncia->__SET('archivos_denuncia', $archivos);
				}

				if($denunciad->actualizar($denuncia))
				{
					$uploads_dir ='../../../public_html/archivos/denuncias/';
					opendir($uploads_dir);

					if($_FILES["archivosdenuncia"]["size"]!=0){
						foreach ($_FILES["archivosdenuncia"]["error"] as $key => $error){
							if ($error == UPLOAD_ERR_OK){
								$tmp_name 		= $_FILES["archivosdenuncia"]["tmp_name"][$key];
								$nombre_archivo = $_FILES["archivosdenuncia"]["name"][$key];

								$exito = move_uploaded_file($tmp_name,$uploads_dir.$nombre_archivo);
							}
					}#foreach. 
				}
				$mensaje = new Visualizer("DEN","UPD_OK"); 
				$mensaje->showMensaje($id);
			}
			else 
			{
				$mensaje = new Visualizer("DEN","UPD_ERR");
				$mensaje->showMensaje();

			}
		} 

	///

		else if($op == 'updatejuridico')
		{ 	
			include("../Models/class_denuncia_juridica.php");
			include("../Models/class_denuncia_juridica_dao.php");

			$denuncia    = new DenunciaJuridica();
			$denunciad   = new DenunciaJuridicaDAO();
			$id          = htmlentities($_POST['id_den']);
			$fecha       = htmlentities($_POST['fden']);
			//$estatus     = htmlentities(addslashes($_POST['estatus']));
			$estatus = 2;
			$descripcion = htmlentities($_POST['descripcion']);
			$descripcion_estatus  = htmlentities($_POST['descripcion_estatus']);

			if(!empty($_POST['documentos']))
			{
				$doc = $_POST['documentos'];
				$denuncia->__SET('documentos', $doc);
			}

			if(!empty($_FILES['archivosdenuncia']))
			{
				$archivos = array();
				foreach ($_FILES["archivosdenuncia"]["name"] as $key => $nombre) 
				{
					if(!empty($nombre))
					{
						array_push($archivos, $nombre);
					}
				}
				$denuncia->__SET('archivos_queja', $archivos);
			}
			
			$denuncia->__SET('id_denuncia',$id);
			$denuncia->__SET('fecha_denuncia',$fecha);
			$denuncia->__SET('estatus_denuncia',$estatus);
			$denuncia->__SET('descripcion_denuncia',$descripcion);
			$denuncia->__SET('descripcion_estatus',$descripcion_estatus);

			if($denunciad->actualizar($denuncia))
			{
				$uploads_dir ='../../../public_html/archivos/quejas/';
				opendir($uploads_dir);
				if($_FILES["archivosdenuncia"]["size"]!=0){
					foreach ($_FILES["archivosdenuncia"]["error"] as $key => $error){
						if ($error == UPLOAD_ERR_OK){
							$tmp_name 		= $_FILES["archivosdenuncia"]["tmp_name"][$key];
							$nombre_archivo = $_FILES["archivosdenuncia"]["name"][$key];

							$exito =move_uploaded_file($tmp_name,$uploads_dir.$nombre_archivo);

						}
					}#foreach.
				}
				$mensaje = new Visualizer("QR","UPD_OK"); 
				$mensaje->showMensaje($id);
			}
			else 
			{
				$mensaje = new Visualizer("DEN","UPD_ERR");
				$mensaje->showMensaje();

			}
		} 

		else if($op=="delete")
		{

			$denunciad = new DenunciaDAO();
			$id = $_POST['id'];

			if($denunciad->eliminar($id))
			{
				$mensaje = new Visualizer("DEN","DEL_OK");
				$mensaje->showMensaje();
			}
			else
			{
				$mensaje = new Visualizer("DEN","ERR");
				$mensaje->showMensaje();
			}

		}

		else if($op=="deletejuridico")
		{

			include("../Models/class_denuncia_juridica.php");
			include("../Models/class_denuncia_juridica_dao.php");
			$denunciad = new DenunciaJuridicaDAO();
			$id = $_POST['id'];

			if($denunciad->eliminar($id))
			{
				$mensaje = new Visualizer("DEN","DEL_OK");
				$mensaje->showMensaje();
			}
			else
			{
				$mensaje = new Visualizer("DEN","ERR");
				$mensaje->showMensaje();
			}
		}
		else if($op=="details")
		{
			$ciudadano = new FiscCiudadano();
			$ciudadanod = new FiscCiudadanoDAO();
			$denuncia = new Denuncia();
			$denunciad = new DenunciaDAO();

			$modelo_empresa = new FiscEmpresaDAO();

			$modelo_apoderado = new ApoderadoDAO();
			$id = htmlentities($_POST['id']);
			$denuncia = $denunciad->getByID($id);

				//var_dump($denuncia); exit();

			$motivos    = $denunciad->getMotivos($denuncia);
			$documentos = $denunciad->getDocumentos($denuncia);
			$denuncia->__SET('motivo_denuncia', $motivos);
			$denuncia->__SET('documentos', $documentos);
			$ciudadano = $ciudadanod->getById($denuncia->__GET('id_ciudadano'));
			$id_empresa = $denuncia->__GET('id_empresa');
			$fisc_empresa = $denuncia->__GET('fisc_empresa');
			$empresa = $modelo_empresa->queryByFisc($fisc_empresa);

			$id_apoderado = $denuncia->__GET('apoderado');
			$apoderado = $modelo_apoderado->queryByIC($id_apoderado);
			$detalles = new Visualizer();
			$detalles->showDetails($ciudadano, $empresa, $denuncia, $apoderado);
		}

		else if($op=="details_juridicos")
		{
			include("../Models/class_denuncia_juridica.php");
			include("../Models/class_denuncia_juridica_dao.php");
			$denuncia = new DenunciaJuridica();
			$modelo = new DenunciaJuridicaDAO();
			$id = htmlentities($_POST['id']);
			$denuncia = $modelo->getByID($id);
			$modelo_empresa = new FiscEmpresaDAO();
			$empresa        = $modelo_empresa->queryByFisc($denuncia->__GET('fisc_empresa'));

			$modelo_representante = new RepresentanteDAO();
			$representante        = $modelo_representante->queryByIC($empresa->__GET('id_representante'));

			$detalles = new Visualizer();
			$detalles->showDetailsJuridico($denuncia, $empresa, $representante);
		}

		else if($op=="registrar")
		{
			//Datos del ciudadano
			$ciudadano = new FiscCiudadano();
			$idc       = $_POST['idc'];
			$nombres   = htmlentities($_POST['nombre']);
			$apellidos = htmlentities($_POST['apellido']);
			$estado    = htmlentities($_POST['estado']);
			$municipio = htmlentities($_POST['municipio']);
			$parroquia = htmlentities($_POST['localidad']);
			$calle     = htmlentities($_POST['calleper']);
			$edificio  = htmlentities($_POST['edifper']);
			$casa      = htmlentities($_POST['ncasa']);
			$cod_movil = htmlentities($_POST['codigo_movil']);
			$tel_movil = htmlentities($_POST['telmov']);
			$tlf_movil = $cod_movil.$tel_movil;
			$cod_habit = htmlentities($_POST['codigo_fijo']);
			$tel_hab   = htmlentities($_POST['telhab']);
			$tlf_habit = $cod_habit.$tel_hab;
			$correo    = htmlentities($_POST['email']);
			$direccion_completa = $estado.", ".$municipio.", ".$parroquia.", ".$calle.", ".$edificio." N° ".$casa;
			$ciudadano->__SET('id_ciudadano',$idc)->__SET('nombres',$nombres)->__SET('apellidos',$apellidos)->__SET('direccion',$direccion_completa)->__SET('telefono_movil',$tlf_movil)->__SET('telefono_habitacion',$tlf_habit)->__SET('correo',$correo);	

			//Fin Datos Ciudadano

		//Datos de la Denuncia
			$rif         = htmlentities($_POST['rif']);
			$num_den     = htmlentities($_POST['num_den']); //id de la denuncia
			$fecha       = htmlentities($_POST['fecha']);
			$hora        = htmlentities($_POST['hora_denuncia']);
			$estatus     = htmlentities($_POST['estatus']);
			$descripcion = htmlentities($_POST['descripcion']);
			$responsable = htmlentities($_POST['direccion_responsable']);
			$apoderado   = htmlentities($_POST['nacionalidad'].$_POST['cedula_apo']);
			$name_apod   = htmlentities($_POST['nombre_apo']);
			$apel_apod   = htmlentities($_POST['apellido_apo']);
			$denuncia    = new Denuncia();
			$modelo      = new DenunciaDAO();

			$denuncia->__SET('id_ciudadano', $idc);
			$denuncia->__SET('rif', $rif);


			$denuncia->__SET('id_denuncia', $num_den);
			$denuncia->__SET('fecha_denuncia', $fecha);
			$denuncia->__SET('hora_denuncia', $hora);

			if(!empty($_POST['motivos']))
			{
				$motivos = $_POST['motivos'];
				$denuncia->__SET('motivo_denuncia', $motivos);
			}
			$denuncia->__SET('estatus_denuncia', $estatus);
			$denuncia->__SET('descripcion', $descripcion);
			$denuncia->__SET('responsable', $responsable);
			$denuncia->__SET('apoderado', $apoderado);
			$denuncia->__SET('nombres_apoderado', $name_apod);
			$denuncia->__SET('apellidos_apoderado', $apel_apod);
			if(!empty($_POST['documentos']))
			{
				$doc = $_POST['documentos'];
				$denuncia->__SET('documentos', $doc);
			}

			if(!empty($_FILES['archivosdenuncia']))
			{
				$archivos = array();
				foreach ($_FILES["archivosdenuncia"]["name"] as $key => $nombre) 
				{
					if(!empty($nombre))
					{
						array_push($archivos, $nombre);
					}
				}
				$denuncia->__SET('archivos_denuncia', $archivos);
			}
			
		//Datos de la Denuncia 

		//Datos de la Empresa

			$ids = dameId();
			$fisc_empresa = $ids[0]['FISC_EMPRESA'];


			$nombre  = htmlentities($_POST['razon']);

			$id_emp  = ( !empty( $_POST['npat'] ) ? trim($_POST['npat']) : "N/A" );

			$direc   = trim(htmlentities($_POST['direccion_empresa']));

			$refer   = trim(htmlentities($_POST['punto_emp']));
			$cod_emp = htmlentities($_POST['cod_area_emp']);
			$telef   = $cod_emp.htmlentities($_POST['tel_emp']);
			$maile   = trim(htmlentities($_POST['email_emp']));
			
			$empresa = new FiscEmpresa();
			$empresa ->__SET('fisc_empresa', $fisc_empresa);
			$empresa ->__SET('id_fisc_empresa', $id_emp);
			$empresa ->__SET('rif_fisc_empresa', $rif);
			$empresa ->__SET('nombre_fisc_empresa', $nombre);
			$empresa ->__SET('telefono_fisc_empresa', $telef);
			$empresa ->__SET('email_fisc_empresa', $maile);
			$empresa ->__SET('direccion_fisc_empresa', $direc);
			$empresa ->__SET('punto_ref_fisc_empresa', $refer);

			if(!empty($_POST['estado2']) && !empty($_POST['municipio2']) && !empty($_POST['localidad2'])
				&& !empty($_POST['calle_emp']) && !empty($_POST['edif_emp']) && !empty($_POST['ncasa_emp']))
			{
				$empresa ->__SET('estado', htmlentities($_POST['estado2']));
				$empresa ->__SET('municipio', htmlentities($_POST['municipio2']));
				$empresa ->__SET('parroquia', htmlentities($_POST['localidad2']));
				$empresa ->__SET('calle', htmlentities($_POST['calle_emp']));
				$empresa ->__SET('edificio', htmlentities($_POST['edif_emp']));
				$empresa ->__SET('casa', htmlentities($_POST['ncasa_emp']));
				
				/*$direccion_empresa = htmlentities($_POST['estado2']).", ";
				$direccion_empresa.= htmlentities($_POST['municipio2']).", ";
				$direccion_empresa.= htmlentities($_POST['localidad2']).", ";
				$direccion_empresa.= htmlentities($_POST['calle_emp']).", ";
				$direccion_empresa.= htmlentities($_POST['edif_emp']).", ";
				$direccion_empresa.= htmlentities($_POST['ncasa_emp']);
				$empresa ->__SET('direccion_fisc_empresa', $direccion_empresa);
				*/
			}

		//Datos de la Empresa 

			if($modelo->registrar($denuncia, $empresa, $ciudadano))
			{
				$uploads_dir ='../../../public_html/archivos/denuncias/';
				opendir($uploads_dir);

				if($_FILES["archivosdenuncia"]["size"]!=0){
					foreach ($_FILES["archivosdenuncia"]["error"] as $key => $error){
						if ($error == UPLOAD_ERR_OK){
							$tmp_name 		= $_FILES["archivosdenuncia"]["tmp_name"][$key];
							$nombre_archivo = $_FILES["archivosdenuncia"]["name"][$key];

							$exito = move_uploaded_file($tmp_name,$uploads_dir.$nombre_archivo);
						}
					}#foreach. 
				}
				$mensaje = new Visualizer('DEN', 'REG_OK');
				$mensaje->showMensaje($num_den);
			}

			else
			{
				$mensaje = new Visualizer('DEN', 'REG_ERR');
				$mensaje->showMensaje();
			}	
		}//Fin Registrar

		//cambios de última Hora
		else if($op=="registrar2")
		{
			include("../Models/class_denuncia_juridica.php");
			include("../Models/class_denuncia_juridica_dao.php");
			//Datos de la empresa
			$ids = dameId();
			$fisc_empresa = $ids[0]['FISC_EMPRESA'];
			$id_empresa = htmlentities($_POST['npat']);
			$rif = htmlentities($_POST['rif']);
			$nombre_empresa = htmlentities($_POST['razon']);
			$direccion_empresa = htmlentities($_POST['direccion_empresa']);
			$punto_referencia  = htmlentities($_POST['punto_emp']);
			$telefono_empresa = htmlentities($_POST['tel_emp']);
			$email_empresa = htmlentities($_POST['email_emp']);

			$empresa = new FiscEmpresa();

			$empresa->__SET('fisc_empresa', $fisc_empresa);
			$empresa->__SET('id_empresa', $id_empresa);
			$empresa->__SET('rif', $rif);
			$empresa->__SET('nombre_empresa', $nombre_empresa);
			$empresa->__SET('direccion_empresa', $direccion_empresa);
			$empresa->__SET('punto_referencia', $punto_referencia);
			$empresa->__SET('telefono_empresa', $telefono_empresa);
			$empresa->__SET('email_empresa', $email_empresa);

			//Datos del representante de la empresa
			$id_representante = htmlentities($_POST['cedula_representante']);
			$nombre_representante = htmlentities($_POST['nombre_representante']);
			$apellido_representante = htmlentities($_POST['apellido_representante']);
			$telefono1_representante = htmlentities($_POST['tel_hab_rep']);
			$telefono2_representante = htmlentities($_POST['tel_mov_rep']);
			$email_representante = htmlentities($_POST['email_rep']);
			$direccion_representante = htmlentities($_POST['direccion_patrono']);

			$representante = new RepresentanteEmpresa();

			$representante->__SET('clv_representante', $id_representante);
			$representante->__SET('str_nombres',       $nombre_representante);
			$representante->__SET('str_apellidos',     $apellido_representante);
			$representante->__SET('str_telefono1',     $telefono1_representante);
			$representante->__SET('str_telefono2',     $telefono2_representante);
			$representante->__SET('str_email',         $email_representante);
			$representante->__SET('str_direccion',     $direccion_representante);
			
			//DATOS DE LA QUEJA
			$id_denuncia = htmlentities($_POST['num_den']);
			$fecha_denuncia = htmlentities($_POST['fecha']);
			$estatus_denuncia = htmlentities($_POST['estatus']);
			$descripcion_denuncia = htmlentities($_POST['descripcion']);
			$responsable_denuncia = htmlentities($_POST['direccion_responsable']);


			$data   = new DenunciaJuridica();
			
			$data ->__SET('id_empresa',$id_empresa);
			$data ->__SET('id_denuncia',$id_denuncia);
			$data ->__SET('fecha_denuncia',$fecha_denuncia);
			$data ->__SET('estatus_denuncia',$estatus_denuncia);
			$data ->__SET('descripcion_denuncia',$descripcion_denuncia);
			$data ->__SET('responsable_denuncia',$responsable_denuncia);
			if(!empty($_POST['motivos']))
			{
				$motivos = $_POST['motivos'];
				$data->__SET('motivo_denuncia', $motivos);
			}
			if(!empty($_POST['documentos']))
			{
				$doc = $_POST['documentos'];
				$data->__SET('documentos', $doc);
			}

			if(!empty($_FILES['archivosdenuncia']))
			{
				$archivos = array();
				foreach ($_FILES["archivosdenuncia"]["name"] as $key => $nombre) 
				{
					if(!empty($nombre))
					{
						array_push($archivos, $nombre);
					}
				}
				$data->__SET('archivos_queja', $archivos);
			}

			$modelo = new DenunciaJuridicaDAO();

			if($modelo->registrar($data,$empresa, $representante))
			{
				$uploads_dir ='../../../public_html/archivos/quejas/';
				opendir($uploads_dir);
				if($_FILES["archivosdenuncia"]["size"]!=0){
					foreach ($_FILES["archivosdenuncia"]["error"] as $key => $error){
						if ($error == UPLOAD_ERR_OK){
							$tmp_name 		= $_FILES["archivosdenuncia"]["tmp_name"][$key];
							$nombre_archivo = $_FILES["archivosdenuncia"]["name"][$key];

							$exito =move_uploaded_file($tmp_name,$uploads_dir.$nombre_archivo);

						}
					}#foreach.
				}
				$mensaje = new Visualizer('QR', 'REG_OK');
				$mensaje->showMensaje($id_denuncia);
			}
			else
			{
				$mensaje = new Visualizer('DEN', 'REG_ERR');
				$mensaje->showMensaje();
			}
		}






