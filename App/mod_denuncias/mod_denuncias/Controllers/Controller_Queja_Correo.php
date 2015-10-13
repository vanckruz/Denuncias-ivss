<?php 

	error_reporting(E_ALL);
	session_start();
	ini_set('display_errors', '1');
	include('../../../resources/orcl_conex.php');
	include('../../librerias/PHPMailer/PHPMailerAutoload.php');
	include('../../../resources/select/funciones.php');
	include('../../config/config.php');

	$quejas = $_POST['quejas_true'];
	$direcciones = $_POST['direcciones_destino'];
	$descripcion = $_POST['descripcion'];


	//var_dump($quejas,'-',$direcciones); exit();


	if(!empty($quejas) && !empty($direcciones))
	{
		//actualizar estatus de la denuncia
		actualizarQuejas($quejas);

		//obtener emails de direcciones
		$emailsArray = obtenerCorreosDirecciones($direcciones);
	
		//buscar datos de las quejas
		list($resultado,$archivos) = obtenerDatosQuejas($quejas);

		insertAsignacion($quejas,$direcciones);

		//mandar emails
		if(enviarEmail($emailsArray,$descripcion,$resultado,$archivos))
		{	
			header('location:'.$base_url.'App/mod_denuncias/quejas.php?msjd=Se envio la(s) queja(s) correctamente&asg=1');
		}else
		{
			header('location:'.$base_url.'App/mod_denuncias/quejas.php?msjd=Error al enviar&asg=1');
		}
		
		//header('location:http://desarrollofiscalizacion.ivss.int/App/mod_denuncias/quejas.php?msjd=Envio exitoso&asg=1');

	}else
	{
		header('location:'.$base_url.'App/mod_denuncias/quejas.php?msjd=Debe seleccionar una queja y direcciones&asg=1');
	}



	/*
		CAMBIAR DE ESTATUS LA QUEJA A ASIGNADA
	*/
	function actualizarQuejas($quejas)
	{
	//$ids = transformarArray($denuncias,",");
		$conex = DataBase::getInstance();

		foreach ($quejas as $key => $value)
		{
			$conex = DataBase::getInstance();
			$stid = oci_parse($conex, "UPDATE FISC_DENUNCIAS_JURIDICAS SET 
				ASIGNADA=1 , ASIGNADOPOR=:sesion_cod
				WHERE ID_DENUNCIA=:ID");
			if (!$stid)
			{
				oci_free_statement($stid);
				oci_close($conex);
				return false;
			}

		// Realizar la lógica de la consulta
			oci_bind_by_name($stid, ':ID', $value);
			oci_bind_by_name($stid, ':sesion_cod', $_SESSION['USUARIO']['codigo_usuario']);

			$r = oci_execute($stid, OCI_NO_AUTO_COMMIT);
			if (!$r)
			{
				oci_free_statement($stid);
				oci_close($conex);
				return false;
			}

			$r = oci_commit($conex);
			if(!$r)
			{
				oci_free_statement($stid);
				oci_close($conex);
				return false;

			}
			oci_free_statement($stid);
		// Cierra la conexión Oracle
			oci_close($conex);
		}
		return true;
	}


	/*
		Nombre: obtenerCorreosDirecciones
		param
		* direcciones = array con los id de las direcciones
	*/
	function obtenerCorreosDirecciones($direcciones)
	{
		$ids = transformarArray($direcciones,",");

	//Abrir la conexión
		$conex = DataBase::getInstance();
		$consulta = "SELECT CORREO from DIRECCIONES_ASIGNACION where ID_DIRECCION IN ($ids)";
	//echo $consulta;

		$stid = oci_parse($conex, $consulta);
		if (!$stid){
			$e = oci_error($conex);
			trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
		}
	// Realizar la lógica de la consulta
	//ocibindbyname($stid, ':ids', $ids);
		$r = oci_execute($stid);

		if (!$r){
			$e = oci_error($stid);
			trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
		}

		$array = array();

		while ($fila = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)){
			$it = new ArrayIterator($fila);

			while($it->valid()){
				array_push($array, $it->current());
				$it->next();
			}
		}
	//Libera los recursos
		oci_free_statement($stid);
	// Cierra la conexión Oracle
		oci_close($conex);
		return $array;
	}


	/*
		nombre = transformarArray
		param
			*array = array con id
			*sep = separador para la cadena
	*/
	function transformarArray($array,$sep)
	{
		return implode($sep,$array);
	}



	/*
	DATOS DE LA QUEJAS
	*/
	function obtenerDatosQuejas($ids)
	{
		$todo = array();
		foreach ($ids as $key => $value)
		{
			$fila = dameQuejas($value);

			$archivos = dameArchivosQueja($value);

		   //var_dump($descripciones); exit();
			array_push($todo, $fila);
		}
		return array($todo,$archivos);
	}

	/*
		FUNCION PARA GUARDAR EN LA TABLA
	*/

function insertAsignacion($denuncias,$direcciones)
	{
		$fecha = date('d-m-Y');

		foreach ($denuncias as $key => $denuncia)
		{
			foreach ($direcciones as $key => $direccion)
			{
					$clv_asignacion = mt_rand();
					$conex  = DataBase::getInstance();	
					
					$consulta = "INSERT INTO TBL_ASIGNACIONQUEJA (
						CLV_ASIGNACION, 
						INT_ID_DIRECCION,STR_ID_DENUNCIA,FECHA_ASIGNACION)
					values
					(
					   ".$clv_asignacion.", ".$direccion.", '".$denuncia."','".$fecha."'
					)";

					//var_dump($consulta); exit();

					$stid = oci_parse($conex, $consulta);
					
					if (!$stid)
					{
						$e = oci_error($conex);
						trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
						oci_rollback($conex);
						//$error = true;
						//self::eliminar($id_den);
						//$e = oci_error($conex);
						//trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
						//Libera los recursos
						oci_free_statement($stid);
						// Cierra la conexión Oracle
						oci_close($conex);
						return false;
					}

					/*oci_bind_by_name($stid, ':clv_asignacion', $clv_asignacion);
					oci_bind_by_name($stid, ':int_id_direccion', $direccion);
					oci_bind_by_name($stid, ':str_id_denuncia', $denuncia);
					oci_bind_by_name($stid, ':fecha_asignacion', $fecha);*/
					
					$r = oci_execute($stid);
					if (!$r)
					{
						$e = oci_error($conex);
						trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
						//$error = true;
						//self::eliminar($id_den);
						oci_rollback($conex);
						//$e = oci_error($stid);
						//trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
						//Libera los recursos
						oci_free_statement($stid);
						// Cierra la conexión Oracle
						oci_close($conex);
						return false;
					}
			}
		}
		return TRUE;
	}

	function enviarEmail($emails,$descripcion,$resultado,$archivos)
	{

				$correo = new PHPMailer(); 
		//$correo->IsSMTP(); 
		//$mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
				$correo->SMTPAuth = true; 
				$correo->SMTPSecure = 'ssl'; 
				$correo->Host = "correo.ivss.gob.ve";
				$correo->Port = 25; 
				$correo->IsHTML(true);
				$correo->Username = "sistema.fiscalizacion@ivss.gob.ve";
				$correo->Password = "123456";
				$correo->SetFrom("sistema.fiscalizacion@ivss.gob.ve");
				//$archivo = "Prueba_".date('m-d-Y').".pdf";

				//primer parmetro es el archivo , el segundo es el nombre del archivo adjunto
				//$correo->AddAttachment($archivo,"ArchivoPDF");

				foreach ($archivos as $key => $arch)
				{
					//$archivo = "Prueba_".date('m-d-Y').".pdf";
					$nombreArch = $arch['STR_NOMBRE_ARCHIVO'];	
					$ruta = "../../../public_html/archivos/quejas/".$nombreArch;

					$correo->AddAttachment("../../../public_html/archivos/quejas/".$nombreArch."");
				}	

				$correo->Subject = "Asignación de quejas";
				//$correo->Subject = "Test";


				$registros = "";
				/*Imagen no se muestra de inmediato en algunos correos por eso la comento porsiacaso*/
#<img src='http://desarrollofiscalizacion.ivss.int/public_html/imagenes/logoivss.png' style='float:left;width:100px;'>

				$registros.= "<div style='min-height:800px;'><div style='text-align:justify;margin-bottom:16px;border-bottom:1px dotted gray;overflow:hidden;background:#3B5998;'>		
				<div style='text-align:justify;padding:12px 12px 12px 7px;color:white;'>
					REPÚBLICA BOLIVARIANA DE VENEZUELA<br>
					MINISTERIO DEL PODER POPULAR PARA EL PROCESO SOCIAL DE TRABAJO<br>
					DIRECCIÓN GENERAL DE FISCALIZACIÓN<br>
					SISTEMA DE FISCALIZACIÓN
				</div>
			</div><p style='text-align:justify;text-indent:10px;padding:16px;'>
			Estimados directores de línea, se asigna las siguientes quejas:
			</p>";

			$registros.= "<table style='width:100%;'>
			<thead>
				<tr>
					<td colspan='7' style='background:#3B5998;color:white;padding:12px;font-size:1.3em;text-align:center;'>Quejas y/o Reclamos Asignadas</td>
				</tr>

			</thead><tbody></div>";

			foreach ($resultado as $key => $quejas)
			{
				foreach ($quejas as $key2 => $queja)
				{
					$registros.= "
					<tr>
					<th class='colorth'>N° Quejas/Reclamos</th>
					<th class='colorth'>Denunciante</th>
					<th class='colorth'>Motivos</th>
					</tr>

					<tr>
					<td>".$queja['ID_DENUNCIA']."</td>
					<td>".$queja['ID_EMPRESA']."</td>
					<td style='text-align:justify !important;'>".(dameMotivosQuejaCadena($queja['ID_DENUNCIA']))."</td>
					</tr>
						
					<tr>
					<th >Dirección Empresa</th>
					<th >Punto de Referencia</th>
					<th colspan='2' >Descripción</th>
					</tr>

					<tr>
					<td >".$queja['DIRECCION_EMPRESA']."</td>
					<td >".$queja['PUNTO_REF_FISC_EMPRESA']."</td>
					<td colspan='2'>".$queja['DESCRIPCION']."</td>
				</tr>";
				}
			}


		$registros.= "</tbody></table>";
		/*****************************Fin tabla datos denuncia****************************************************/
		$texto ='<html>
		<head>
			<meta charset="UTF-8">
			<title>fiscalización-Denuncias</title>
			<style>
				html,body{
					margin:0px;
					padding:0px;
				}
				table{
					background:rgba(255,255,255,0.9);
				}
				table tr:hover{
					background:#ddd;
				}
				table td,table th{
					padding:5px;
					text-align:center;
					font-size:0.8em;
				}
				.colorth{					
					background:#d9edf7;
				}
				table th{ background:#f1f1f1; }
			</style>
		</head>
		<body style="background:linear-gradient(to right, #AFA19E, #E7E7FF, #E7E7E7, #8E8E8E) no-repeat scroll 0% 0% #8E8E8E;height:auto;font-size:0.8em;">
			'.$registros.'
			<br>
			<b>Descripción de Asignación:</b> <br>
			'.$descripcion.'
		</body>
		</html>';

		$correo->Body =  utf8_decode($texto);

		foreach ($emails as $key => $value){
			$correo->AddAddress($value);
		}

		//$correo->AddCC("edwin.garcia@ivss.gob.ve","Edwin AGM");

		//copia oculta
		$correo->AddBCC("edwin.garcia@ivss.gob.ve","Edwin AGM");
		$correo->AddBCC("jhonny.vasquez@ivss.gob.ve","Edwin AGM");
		//$correo->AddBCC("@ivss.gob.ve","Edwin AGM");

		if(!$correo->Send())
		{
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}


 ?>
