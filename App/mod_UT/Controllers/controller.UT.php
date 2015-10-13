<?php
		header("../../../public_html/js/emergente.js");
	    //Incluír Modelo y Vista
	    include("../Models/include_ut.php");
		include("../Views/mensajes.php");
		include('../../../resources/orcl_conex.php'); 
		//include("../view/class.Visualizer.php");
		
		$op = $_POST['option'];
		$ut = new UT();
		$utd = new UTDAO();
		if(isset($_POST['valor']))
		$clave = addslashes($_POST['valor']);
		elseif(isset($_POST['finicio']))
		{
			$anio = addslashes($_POST['yinicio']);
			$mes = addslashes($_POST['minicio']);
			$dia =  addslashes($_POST['dinicio']);
		}
		elseif(isset($_POST['ffin']))
		{
			$anio = addslashes($_POST['yfin']);
			$mes = addslashes($_POST['mfin']);
			$dia = addslashes($_POST['dfin']);
		}
				
		// Registrar Unidad Tributaria: INSERT INTO ut 
		if($op=='insertar')
		{ 				
			$existe =0;
			$yinicio = addslashes($_POST["yinicio"]);
			$minicio = addslashes($_POST["minicio"]);
			$dinicio = addslashes($_POST["dinicio"]);
			$yfin = addslashes($_POST["yfin"]);
			$mfin = addslashes($_POST["mfin"]);
			$dfin = addslashes($_POST["dfin"]);
			$valor = addslashes($_POST["valor"]);
			$id = "undt_".$yinicio."_".$minicio."_".$dinicio;
			$ut->__SET('id_unidadt', $id);
			$ut->__SET("yinicio",$yinicio);
			$ut->__SET("minicio",$minicio);
			$ut->__SET("dinicio",$dinicio);
			$ut->__SET("yfin",$yfin);
			$ut->__SET("mfin",$mfin);
			$ut->__SET("dfin",$dfin);
			$ut->__SET("valor",$valor);
			$actual=$utd->Listar();
			
			foreach($actual as $key)
			{
				if($key->__GET('yinicio')==$yinicio && $key->__GET('minicio')==$minicio && $key->__GET('yfin')==$yfin 
				&& $key->__GET('mfin')==$mfin && $key->__GET('valor')==$valor)
				{
					$existe++;
				}
			}
			
			if($existe !=0)
			{
				//Impedir registro de ut
				$sts= 'EXIST';
				$mensaje = new Mensaje($sts);
				$mensaje->showMensaje();
				
			}
			else
			if($utd->Registrar($ut))
			{
				//$est= 'OP_OK';
				$sts= 'REG_OK';
				$mensaje = new Mensaje($sts);
				$mensaje->showMensaje();
			}
			else 
			{
				$sts='REG_ERR';
				$mensaje = new Mensaje($sts);
				$mensaje->showMensaje();
			}
		 }
		
		//Consultar Unidad Tributaria: SELECT FROM ut
		else if($op=='select')
		{
			if($_POST["opciones"]=='valor')
			{
				$valor=addslashes($_POST["valor"]);
				$ut=$utd->queryByValor($valor);
			}
			elseif($_POST["opciones"]=='fecha_inicio')
			{
				$yinicio= addslashes($_POST["yinicio"]);
				$minicio = addslashes($_POST["minicio"]);
				$dinicio = addslashes($_POST["dinicio"]);
				$ut = $utd->queryByFechaInicio($yinicio, $minicio, $dinicio);
			}
			
			if(!$ut)
			{
				$sts = 'NRF'; //NRF: NOT REGISTER FOUND
				$mensaje = new Mensaje($sts);
				$mensaje->showMensaje();
			}
			else
			{ 
				$mensaje = new Mensaje();
				$mensaje->mostrar($ut);
			}	
		}
		else if($_POST["option"]=='queryupd')// Update ut Table
		{
			if($_POST["opciones"]=='valor')
			{
				$valor=addslashes($_POST["valor"]);
				$ut=$utd->queryByValor($valor);
			}
			elseif($_POST["opciones"]=='fecha')
			{
				$inicio= addslashes($_POST["inicio"]);
				$fin = addslashes($_POST["fin"]);
				$ut = $utd->queryByFecha($inicio, $fin);
			}
			
			if(!$ut)
			{
				$sts = 'NRF'; //NRF: NOT REGISTER FOUND
				$mensaje = new Mensaje($sts);
				$mensaje->showMensaje();
			}
			else
			{ 
				$mensaje = new Mensaje();
				$mensaje->showUpdateUt($ut);			}	
			}
		
		else if($_POST["option"]=='preupd')// Update ut Table
		{
			$id = $_POST['id'];
			$ut = $utd ->obtener($id);
			$mensaje = new Mensaje();
			$mensaje->showUpdateForm($ut);
			
		}
		
		else if($_POST["option"]=='update')// Update ut Table
		{
			$id = $_POST['data-id'];
			$inicio = $_POST['inicio'];
			$fin = $_POST['fin'];
			$valor = $_POST['valor'];
			$ut->__SET('id',$id);
			$ut->__SET('inicio',$inicio);
			$ut->__SET('fin',$fin);
			$ut->__SET('valor',$valor);
			
			if($utd->actualizar($ut))
			{
				$mensaje = new Mensaje('UPD_OK');
				$mensaje->showMensaje();
			}
			else
			{
				$mensaje = new Mensaje('UPD_ERR');
				$mensaje->showMensaje();
			}
		}

		
		else if($_POST["option"]=='delete')// Delete From ut Table
		{
			if($_POST["opciones"]=='valor')
			{
				$valor=addslashes($_POST["valor"]);
				$ut=$utd->queryByValor($valor);
			}
			elseif($_POST["opciones"]=='fecha')
			{
				$inicio= addslashes($_POST["inicio"]);
				$fin = addslashes($_POST["fin"]);
				$ut = $utd->queryByFecha($inicio, $fin);
			}
			if(!$ut)
			{
				$sts = 'NRF'; //NRF: NOT REGISTER FOUND
				$mensaje = new Mensaje($sts);
				$mensaje->showMensaje();
			}
			else
			{
				$mensaje = new Mensaje();
				$mensaje->showDeleteForm($ut);
			}
	
		}
?>