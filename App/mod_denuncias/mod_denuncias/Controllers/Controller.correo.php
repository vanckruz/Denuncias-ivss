<?php 
/****Aqui es el archivo que resive el post enviado por ajax de restablecer contraseña y envia el correo****/
date_default_timezone_set('Etc/UTC');
error_reporting(E_ALL);
ini_set('display_errors', '1');
require '../../librerias/PHPMailer/PHPMailerAutoload.php';
include('../../../resources/orcl_conex.php');
include ("../../../resources/select/funciones.php"); 
include ("../../config/config.php"); 


$usuario = dameUsuario_correo($_POST["cedula"]);

$cedula = $_POST['cedula'];

//buscar usuario
list($fila,$count) = buscarUsuario($cedula);
	//generar link
$sha = sha1($cedula);
$link = generarLinkTemporal($sha,$base_url);
	//actualizar link en la tabla user
if(actualizarToken($fila['ID_USER'],$sha))
{
	if($count==1)
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

		$correo->Subject = "Cambio de Password";

			// <p>"'.$_POST['cedula'].'</p>

		$texto ='<html>
		<head>
			<title>Restablece tu contraseña</title>
		</head>
		<body>

			<p>Hemos recibido una solicitud para restablecer la contraseña de tu cuenta.</p>
			<p>Si hiciste esta petición, haz clic en el siguiente enlace, si no hiciste esta petición puedes ignorar este correo.</p>
			<p>  
				<strong>Enlace para restablecer tu contraseña</strong><br>
				<a href="'.$link.'"> Restablecer contraseña </a>
			</p>
		</body>
		</html>';

		$correo->Body =  utf8_decode($texto);
		$correo->AddAddress($fila['CORREO']);

			//$correo->AddCC("edwin.garcia@ivss.gob.ve","Edwin AGM");
		//$correo->AddBCC("edwin.garcia@ivss.gob.ve","Edwin AGM");

			//copia oculta
			//$mail->AddBCC("copia1@correo.com","Nombre copia 1");

		if(!$correo->Send())
		{
				//echo "Error: " . $correo->ErrorInfo;
			echo "Ha ocurrido un error al enviar el correo. Ingrese una cédula valida";
		}
		else
		{
			if(!empty($usuario[0]['USUARIO'])){
				echo "Se ha enviado un correo a ".$usuario[0]['CORREO']." con un link para actualizar sus datos";	

			}else{
				echo "La cédula ingresada no esta registrada en el sistema.";
			}
			

		}
	}
}else
{
	echo "Hubo un error al enviar el correo";
}

	/*
		Funcion generarLinkTemporal
		param: 
		*Cedula: Cedula del usuario a cambiar la contraseña
	*/
		function generarLinkTemporal($sha,$base_url)
		{
			$enlace = $base_url.'cambiar_password.php?token='.$sha;
			return $enlace;
		}

	/*
		Funcion buscarUsuario
		param: 
		*Cedula: Cedula del usuario a cambiar la contraseña
	*/
		function buscarUsuario($cedula)
		{
		//Abrir la conexión
			$conex = DataBase::getInstance();

			$stid = oci_parse($conex, "SELECT * FROM FISC_USERS WHERE ID_USER=:cedula");
			if (!$stid){
				$e = oci_error($conex);
				trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
			}
		// Realizar la lógica de la consulta
			ocibindbyname($stid, ':cedula', $cedula);
			$r = oci_execute($stid);

			if (!$r){
				$e = oci_error($stid);
				trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
			}

		// Obtener los resultados de la consulta	
			$fila = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS);

		//Libera los recursos
			oci_free_statement($stid);
		// Cierra la conexión Oracle
			oci_close($conex);

			return array($fila,count($stid));

		}

	/*
		Funcion actualizarToken
		param: 
		*id_user: id del usuario a cambiar la contraseña
		*token: token campo unico del usuario sha1 
	*/
		function actualizarToken($id_user,$token)
		{
			$conex = DataBase::getInstance();
			$stid = oci_parse($conex, "UPDATE FISC_USERS SET 
				token=:token
				WHERE id_user=:id_user");
			if (!$stid)
			{
				oci_free_statement($stid);
				oci_close($conex);
				return false;
			}

		// Realizar la lógica de la consulta
			oci_bind_by_name($stid, ':token', $token);
			oci_bind_by_name($stid, ':id_user' , $id_user);

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
			return true;
		}


		?>

