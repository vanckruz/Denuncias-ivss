<?php

if($_SERVER['REQUEST_METHOD']=='POST')
{
	include("../Models/classUsuario.php");
	include("../Models/classUsuarioDAO.php");
	include("../Views/visualizer.php");
	error_reporting(E_ALL);
	ini_set("display_errors", 1);




	/************************INICIO REGISTRO*****************************/
	if(isset($_REQUEST['option']) && $_REQUEST['option'] =="registro")
	{
		$nacionalidad        = htmlentities($_POST['nac_apo']);
		$id                  = htmlentities($_POST['id_apo']);
		$name                = htmlentities($_POST['NombreUser']);
		$apellido            = htmlentities($_POST['ApellidoUser']);
		$departamento        = htmlentities($_POST['divisionselect']);
		$email               = htmlentities($_POST['Email']);
		$pass                = sha1(htmlentities($_POST['password']));
		$perfil              = htmlentities($_POST['perfil']);
		$region              = htmlentities($_POST['regionselect']);
		$estado              = htmlentities($_POST['estadoselect']);
		$oficina             = htmlentities($_POST['oficinaselect']);
		$direccion_general   = htmlentities($_POST['direcciongeneralselect']);
		$direccion_linea     = htmlentities($_POST['direccionlineaselect']);
		$user                = htmlentities($_POST['UserName']);
		$codigo_usuario      = htmlentities($_POST['CodUser']);
		$area_habitacion     = htmlentities($_POST['TelefHabitacionSelect']);
		$telefono_habitacion = htmlentities($_POST['Telf_Habitacion']);
		$telef_habitacion    = $area_habitacion.$telefono_habitacion;
		$area_movil 		 = htmlentities($_POST['TelefMovilSelect']);
		$telefono_movil      = htmlentities($_POST['Telef_Movil']);
		$telef_movil   	 	 = $area_movil.$telefono_movil;


		/*--------------- NO HA SIDO REGISTRADO ANTERIORMNETE REGISTRAMOS NUEVO -------------*/


		$usuario = new Usuario();
		$usuario->__SET('nacionalidad', $nacionalidad);
		$usuario->__SET('id_user', $id);
		$usuario->__SET('nombre', $name);
		$usuario->__SET('apellido', $apellido);
		$usuario->__SET('correo', $email);
		$usuario->__SET('password', $pass);
		$usuario->__SET('departamento', $departamento);
		$usuario->__SET('user_type', $perfil);
		$usuario->__SET('region', $region);
		$usuario->__SET('estado', $estado);
		$usuario->__SET('oficina', $oficina);
		$usuario->__SET('direccion_general', $direccion_general);
		$usuario->__SET('direccion_linea', $direccion_linea);
		$usuario->__SET('usuario', $user);
		$usuario->__SET('codigo_usuario', $codigo_usuario);
		$usuario->__SET('telefono_habitacion', $telef_habitacion);
		$usuario->__SET('telefono_movil', $telef_movil);

		$modelo = new UsuarioDAO();

		if($modelo->registrarUsuario($usuario))
		{
			include('../Views/usuario_ok.php');
			include('../Views/bottomView.tpl.php');					
		}
		else
		{
			include('../Views/usuario_error.php');
			include('../Views/bottomView.tpl.php');					
		}
		
	}
	/***************************FIN REGISTRO****************************/

	/************************INICIO EDITAR*****************************/
	if(isset($_REQUEST['option']) && $_REQUEST['option'] =="editar")
	{	

		$id                  	= $_POST['idUser'];
		$name                	= $_POST['NombreUser'];
		$apellido            	= $_POST['ApellidoUser'];
		$departamento        	= $_POST['divisionselect'];
		$email               	= $_POST['Email'];
		$perfil              	= $_POST['perfil'];
		$region              	= $_POST['regionselect'];
		$estado              	= $_POST['estadoselect'];
		$oficina             	= $_POST['oficinaselect'];
		$direccion_general   	= $_POST['direcciongeneralselect'];
		$direccion_linea     	= $_POST['direccionlineaselect'];
		$user                	= $_POST['UserName'];
		$codusuario 			= $_POST['codUser'];		
		$extension_habitacion	= $_POST['TelefHabitacionSelect'];
		$nro_habitacion 		= $_POST['Telf_Habitacion'];
		$telefono_habitacion 	= $extension_habitacion.$nro_habitacion;
		$extension_movil		= $_POST['TelefMovilSelect'];
		$nro_movil      		= $_POST['Telef_Movil'];
		$telefono_movil 		= $extension_movil.$nro_movil;	

		$usuario = new Usuario();
			//$usuario->__SET('nacionalidad', $nacionalidad);
		$usuario->__SET('id_user', $id);
		$usuario->__SET('nombre', $name);
		$usuario->__SET('apellido', $apellido);
		$usuario->__SET('correo', $email);
			//$usuario->__SET('password', $pass);
		$usuario->__SET('departamento', $departamento);
		$usuario->__SET('user_type', $perfil);
		$usuario->__SET('region', $region);
		$usuario->__SET('estado', $estado);
		$usuario->__SET('oficina', $oficina);
		$usuario->__SET('direccion_general', $direccion_general);
		$usuario->__SET('direccion_linea', $direccion_linea);
		$usuario->__SET('usuario', $user);
		$usuario->__SET('codigo_usuario', $codusuario);
		$usuario->__SET('telefono_habitacion', $telefono_habitacion);
		$usuario->__SET('telefono_movil', $telefono_movil);

		
		$modelo = new UsuarioDAO();

		$edituser = $modelo->modificarUsuario($usuario);

		if($edituser == true)
		{
			include('../Views/usuario_edit_ok.php');			
		}
		else
		{
			include('../Views/usuario_error.php');
		}

	}

	if(isset($_REQUEST['option']) && $_REQUEST['option'] =="eliminar"){

		$ID_user = $_POST['id'];

		$deleteuser = new UsuarioDAO();

		$usuario = $deleteuser->getByCedula($ID_user);
		
		
		$codigo = $usuario->__GET('codigo_usuario');
		$eliminar = $deleteuser->eliminarUsuario($ID_user, $codigo);

		if ($eliminar == true){
			include('../Views/usuario_del_ok.php');
		} else {
			include('../Views/usuario_error.php');
		}

	}

	if(isset($_REQUEST['option']) && $_REQUEST['option'] =="buscarUser"){

		$ID_user = $_POST['id'];
		$Correo_user = $_POST['email'];
		$editaruser = new UsuarioDAO();
		$usuarioedicion = $editaruser->obtenerUsuario($ID_user,$Correo_user);
		echo json_encode(array('ID_USER'=>$usuarioedicion->__GET("id_user"),'NOMBRE'=>$usuarioedicion->__GET("nombre"),'APELLIDO'=>$usuarioedicion->__GET("apellido"), "CORREO"=> $usuarioedicion->__GET("correo"), "PASSWORD"=> $usuarioedicion->__GET("password"), "USER_TYPE"=> $usuarioedicion->__GET("user_type"), "DEPARTAMENTO"=> $usuarioedicion->__GET("departamento"), "ESTADO"=> $usuarioedicion->__GET("estado"), "OFICINA"=> $usuarioedicion->__GET("oficina"), "DIRECCION_GENERAL"=> $usuarioedicion->__GET("direccion_general"), "DIRECCION_LINEA"=> $usuarioedicion->__GET("direccion_linea"), "USUARIO"=> $usuarioedicion->__GET("usuario"), "CODIGO_USUARIO"=> $usuarioedicion->__GET("codigo_usuario"), "TELEFONO_HABITACION"=> $usuarioedicion->__GET("telefono_habitacion"), "TELEFONO_MOVIL"=> $usuarioedicion->__GET("telefono_movil"), "REGION"=> $usuarioedicion->__GET("region"), "NACIONALIDAD"=> $usuarioedicion->__GET("nacionalidad")));

	}

	if(isset($_REQUEST['option']) && $_REQUEST['option'] =="buscarUserInsert"){


		$ID_user = $_POST['id'];
		//$Correo_user = $_POST['email'];
		$User = new UsuarioDAO();
		$UserInsert = $User->verificarUserInsert($ID_user);
		echo json_encode($UserInsert);

	}

	if(isset($_REQUEST['option']) && $_REQUEST['option'] =="consultar")
	{
		/*|----------- LEYENDA -------------|*/
		/*|  0 - EXISTE                     |*/
		/*|  1 - EXISTE PERO INHABILITADO   |*/
		/*|  2 - NO EXISTE                  |*/
		/*|---------------------------------|*/
		
		$cedula = htmlentities($_POST['cedula']);
		//$usuario  = new usuario();
		$modelo = new UsuarioDAO();
		$UsuarioBusqueda = $modelo->getByCedulaUser($cedula);
		
		if($UsuarioBusqueda->__GET('id_user')==NULL){
			echo json_encode(2);
		} else {
			/*echo json_encode($UsuarioBusqueda->__GET('int_borrado'));
			exit();*/
			if ($UsuarioBusqueda->__GET('int_borrado')==0) {
				/*echo json_encode(0);*/
				echo json_encode(array('ID_USER' => $UsuarioBusqueda->__GET('id_user'),'NOMBRE'=>$UsuarioBusqueda->__GET('nombre'),'APELLIDO'=>$UsuarioBusqueda->__GET('apellido'),'CORREO'=>$UsuarioBusqueda->__GET('correo')));
			} else {
				echo json_encode(1);
			}

		}

	}
	/************************FIN CONSULTAR*************************/

	/************************INICIO CONSULTAR**************************/
	if(isset($_REQUEST['option']) && $_REQUEST['option'] =="consultaruser"){

		$cedula = htmlentities($_POST['cedula']);
			//$usuario  = new usuario();
		$modelo = new UsuarioDAO();
		$usuario = $modelo->getByCedula($cedula);
		if($usuario->__GET('id_user')==NULL)
		{
			echo 'false';
		}
		else
		{
				//echo "El usuario Existe";
			echo 'true';
		}

	}

	/*-----------------------VALIDAR SI EXISTE EL EMAIL DEL USUARIO----------------*/
	if(isset($_REQUEST['option']) && $_REQUEST['option'] =="validarEmail"){


		$correoIngresado = htmlentities($_POST['UserName']);
			//$usuario  = new usuario();
			/*
			*/
			$modelo = new UsuarioDAO();
			$usuario = $modelo->getByCorreo($correoIngresado);
			/*echo json_encode($usuario);
			exit();*/

			if($usuario->__GET('id_user')==NULL)
			{
				echo json_encode('valido');
			}
			else
			{
				echo json_encode('invalido');
			}

			
		}

		if(isset($_REQUEST['option']) && $_REQUEST['option'] =="validarEmailEdicion"){

			$correoIngresado 	= htmlentities($_POST['UserName']);
			$correoviejo		= htmlentities($_POST['CurrentEmail']);
			if ($correoIngresado != $correoviejo){
				$modelo = new UsuarioDAO();
				$usuario = $modelo->getByCorreo($correoIngresado);
				if($usuario->__GET('id_user')==NULL)
				{
					echo json_encode('valido');
				}
				else
				{
					echo json_encode('invalido');
				}
			} else {
				echo json_encode('validouser');
			}

			
		}		
		
		/*-----------------------VALIDAR SI EXISTE EL NUMERO DE USUARIO----------------*/
		
		if(isset($_REQUEST['option']) && $_REQUEST['option'] =="validarCodUser"){
			

			$CodUserIngresado = htmlentities($_POST['CodUser']);
			//$usuario  = new usuario();
			/*
			*/
			$modelo = new UsuarioDAO();
			$usuario = $modelo->getByCodUser($CodUserIngresado);

			if($usuario->__GET('id_user')==NULL)
			{
				echo json_encode('valido');
			}
			else
			{
				echo json_encode('invalido');
			}

			
		}			



		/*-------------------USUARIO EXISTENTE CAMBIAMOS ESTATUS -------------------------*/

		
		if(isset($_REQUEST['option']) && $_REQUEST['option'] =="reingreso"){

			//echo json_encode('regingreso exitoso');

			$CodUsuario = htmlentities($_POST['CodUser']);
			$model_euser = new UsuarioDAO();
			$usuario = $model_euser->getByCedula($CodUsuario);
			$codigo = $usuario->__GET('codigo_usuario');

			if($model_euser->activarUsuario($CodUsuario, $codigo)){
				echo json_encode(1);
			}
			else{
				echo json_encode(0);
			}

		}

		/*-------------------USUARIO EXISTENTE CAMBIAMOS ESTATUS -------------------------*/
	}
	?>
