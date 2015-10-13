<?php

	include("../Models/model_Empresa.php");
	include("../Views/Mensajes.php");
	include('../../../resources/orcl_conex.php');

	$empresa = new Empresa();
	$empresaD = new EmpresaDAO();
	$op = $_POST["option"];
	
	
	
	if($op=="registro")
	{
		$rif = addslashes($_POST["rif"]);
		$npat = addslashes($_POST["npat"]);
		$nombre = addslashes($_POST["nombre"]);
		$dir = addslashes($_POST["direccion"]);
		$tlf = addslashes($_POST["telefono"]);
		if(existe_empresa("rif", $rif) || existe_empresa("numero_patronal", $npat)|| existe_empresa("nombre",$nombre))
		{
			$mensaje = new Mensaje("EXIST");
			$mensaje->showMensaje();
		}
		else
		{
			$empresa->__SET('rif', $rif);
			$empresa->__SET('id_empresa', $npat);
			$empresa->__SET('nombre_empresa', $nombre);
			$empresa->__SET('domicilio_completo', $dir);
			$empresa->__SET('telefono1', $tlf);
			
			if($empresaD->registrar($empresa))
			{
				$mensaje = new Mensaje("REG_OK");
				$mensaje->showMensaje();
			}
			else
			{
				$mensaje = new Mensaje("REG_ERR");
				$mensaje->showMensaje();
			}
		}
		
	}//FIN REGISTRO 
	
	elseif($op=='consulta')
	{
		$clave = htmlentities($_POST['opciones']);
		$valor = htmlentities($_POST['valor']);
		if($clave=='id_empresa')
		{
			$empresa = $empresaD->queryByPatrono($valor);
		}
		
		elseif($clave=='rif')
		{
			$empresa = $empresaD->queryByRif($valor);
		}
		elseif($clave=='nombre_empresa')
		{
			$empresa = $empresaD->queryByNombre($valor);
		}
		
		if(count($empresa)!=0)
		{
			$mensaje = new Mensaje();
			$mensaje->mostrar($empresa);
		}
		else
		{
			$mensaje = new Mensaje("NRF");
			$mensaje->showMensaje();
		}
	
	}//FIN CONSULTA
	
	elseif($op=="consultaexterna")
	{
		$clave = addslashes($_POST["filtro"]);
		$valor = addslashes($_POST["valor"]);
		if(existe_empresa($clave, $valor))
		echo "La empresa existe";
		else echo 0;
	}

	elseif($op=="actualizar")
	{
		$existe;
		$clave = addslashes($_POST['opciones']);
		
		if($clave=='npat')
		{
			$npatronal = addslashes($_POST['numero']);
			$empresa = $empresaD->queryByPatrono($npatronal);
		}
		
		elseif($clave=='rif')
		{
			$rif = addslashes($_POST['rif']);
			$empresa = $empresaD->queryByRif($rif);
		}
		elseif($clave=='nombre')
		{
			$nombre = addslashes($_POST['nombre']);
			$empresa = $empresaD->queryByNombre($nombre);
		}
		
		if(count($empresa)!=0)
		{
			$mensaje = new Mensaje();
			$mensaje->showUpdateForm($empresa);
		}
		else
		{
			$mensaje = new Mensaje("NRF");
			$mensaje->showMensaje();
		}
		
	}//FIN ACTUALIZAR
	
	elseif($op=="eliminar")
	{
		$clave = addslashes($_POST['opciones']);
		
		if($clave=='npat')
		{
			$npatronal = addslashes($_POST['numero']);
			$empresa = $empresaD->queryByPatrono($npatronal);
		}
		
		elseif($clave=='rif')
		{
			$rif = addslashes($_POST['rif']);
			$empresa = $empresaD->queryByRif($rif);
		}
		elseif($clave=='nombre')
		{
			$nombre = addslashes($_POST['nombre']);
			$empresa = $empresaD->queryByNombre($nombre);
		}
		
		if(count($empresa)!=0)
		{
			$mensaje = new Mensaje();
			$mensaje->showDeleteForm($empresa);
		}
		else
		{
			$mensaje = new Mensaje("NRF");
			$mensaje->showMensaje();
		}

	
	}//FIN ELIMINAR
	
	function existe_empresa($clave, $valor)
	{
		$empresa = new Empresa();
		$empresad = new EmpresaDAO();
		
		$empresa = $empresad->obtener($clave, $valor);
		if(count($empresa)!=0)
		return true;
		else
		return false;
	}
?>