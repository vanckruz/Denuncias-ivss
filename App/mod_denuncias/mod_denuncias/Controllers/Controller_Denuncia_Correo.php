<?php 
error_reporting(E_ALL);
ini_set('display_errors', '1');
session_start();
include('../../../resources/orcl_conex.php');
include('../../librerias/PHPMailer/PHPMailerAutoload.php');
include('../../../resources/select/funciones.php');
include('../../config/config.php');


$denuncias = $_POST['denuncia_true'];
$direcciones = $_POST['direcciones_destino'];
$descripcion = $_POST['descripcion'];

if(!empty($denuncias) && !empty($direcciones))
{
		//actualizar estatus de la denuncia
	obtenerDenuncias($denuncias);

		//buscar datos de la denuncia
	list($resultado,$motivos,$archivos) = obtenerDatosDenuncia($denuncias);

		//obtener emails de direcciones
	$emailsArray = obtenerCorreosDirecciones($direcciones);

	insertAsignacion($denuncias,$direcciones);

	//generar pdf
	//generarPdf();

		//mandar emails
	if(enviarEmail($emailsArray,$descripcion,$resultado,$motivos,$archivos,$base_url))
	{	
		header('location:'.$base_url.'App/mod_denuncias/denuncias.php?msjd=Se Envío la(s) denuncia(s) exitosamente&asg=1');
	}else
	{
		header('location:'.$base_url.'App/mod_denuncias/denuncias.php?msjd=Error al enviar&asg=1');
	}

}else
{
	header('location:'.$base_url.'App/mod_denuncias/denuncias.php?msjd=Error al enviar&asg=1');
}


	/*
		Nombre: obtenerDenuncias
		param
		* denuncias = array con los id de las denuncias
	*/
		function obtenerDenuncias($denuncias)
		{
		//$ids = transformarArray($denuncias,",");
			$conex = DataBase::getInstance();


			foreach ($denuncias as $key => $value)
			{
				$conex = DataBase::getInstance();
				$stid = oci_parse($conex, "UPDATE FISC_DENUNCIAS SET 
					ASIGNACION=1 , ASIGNADOPOR=:sesion_cod
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

			function enviarEmail($emails,$descripcion,$resultado,$motivos,$archivos,$base_url)
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

				//$archivo = "Prueba_08-19-2015.pdf";
				//$correo->AddAttachment($archivo);

				foreach ($archivos as $key => $arch)
				{
					//$archivo = "Prueba_".date('m-d-Y').".pdf";
					$nombreArch = $arch['STR_NOMBRE_ARCHIVO'];	
					$ruta = "../../../public_html/archivos/denuncias/".$nombreArch;

					$correo->AddAttachment("../../../public_html/archivos/denuncias/".$nombreArch."");
				}	

				$correo->Subject = "Asignación de denuncias";

				//$correo->Subject = "Test";

				$registros = "";
				/*Imagen no se muestra de inmediato en algunos correos por eso la comento porsiacaso*/
#<img src='http://desarrollofiscalizacion.ivss.int/public_html/imagenes/logoivss.png' style='float:left;width:100px;'>

				$registros.= "
				<head>
					<meta content='text/html' http-equiv='content-type' charset='utf-8'>
				</head>

				<div style='min-height:800px;'><div style='text-align:justify;margin-bottom:16px;border-bottom:1px dotted gray;overflow:hidden;background:#3B5998;'>		
					
					<div style='text-align:justify;padding:12px 12px 12px 7px;color:white;'>
						REPÚBLICA BOLIVARIANA DE VENEZUELA<br>
						MINISTERIO DEL PODER POPULAR PARA EL PROCESO SOCIAL DE TRABAJO<br>
						DIRECCIÓN GENERAL DE FISCALIZACIÓN<br>
						SISTEMA DE FISCALIZACIÓN
					</div>

				</div><p style='text-align:justify;text-indent:10px;padding:16px;'>
				Estimados directores de línea, se asigna las siguientes denuncias:
			</p>";

			$registros.= "<table style='width:100%;'>
			<thead>
				<tr>
					<td colspan='8' style='background:#3B5998;color:white;padding:12px;font-size:1.0em;text-align:center;'>Denuncias Asignadas</td>
				</tr>

			</thead></div><tbody>";

			foreach ($resultado as $key => $denuncia)
			{
				$registros.= "
				<tr style='background: green !important ;'>
					<th class='colorth'>N° Denuncia</th>
					<th class='colorth'>N° Cédula Denunciante</th>
					<th class='colorth'>Empresa Denunciada</th>
					<th class='colorth'>Motivos</th>
				</tr>

				<tr >
					<td>".$denuncia['ID_DENUNCIA']."</td>
					<td>".$denuncia['ID_CIUDADANO']."</td>
					<td>".$denuncia['ID_EMPRESA']."</td>
					<td>".dameMotivosCorreo($denuncia['ID_DENUNCIA'])."</td>
				</tr>
				
				<tr>
					<th >Dirección Empresa</th>
					<th >Punto de Referencia</th>
					<th colspan='2' >Descripción</th>
				</tr>
				
				<tr>
					<td >".$denuncia['DIRECCION_EMPRESA']."</td>
					<td >".$denuncia['PUNTO_REF_FISC_EMPRESA']."</td>
					<td colspan='2'>".$denuncia['DESCRIPCION']."</td>
				</tr>
				";
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

			$correo->Body = utf8_decode($texto);

			foreach ($emails as $key => $value){
				$correo->AddAddress($value);
			}

		//$correo->AddCC("edwin.garcia@ivss.gob.ve","Edwin AGM");

		//copia oculta
			$correo->AddBCC("edwin.garcia@ivss.gob.ve","Edwin AGM");
			$correo->AddBCC("jhonny.vasquez@ivss.gob.ve","Edwin AGM");

			if(!$correo->Send())
			{
				return FALSE;
			}
			else
			{
				return TRUE;
			}
		}

	/*
		Funcion para generar pdf
	*/

		function generarPdf()
		{
			ini_set("session.auto_start", 0);
			error_reporting(E_ALL);
			ini_set("display_errors", 1);
			include('../../librerias/fpdf/fpdf.php');

			$pdf = new  FPDF('P');
			$pdf->AddPage();
			$pdf->Image('../../../public_html/imagenes/logoclaro.png',40,50,120);
			$pdf->SetTitle("Notificación al denunciante",true);
			$pdf->Image('../../../public_html/imagenes/logoivss.png',20,7,13);
			$pdf->SetFont('Arial','',6);
		//$pdf->Text(40,10,utf8_decode('hola'));

			$nombre = "Prueba_".date('m-d-Y').".pdf";
			$pdf->Output($nombre,'F');
		}


	/*
	DATOS DE LA DENUNCIA
	*/

	function obtenerDatosDenuncia($ids)
	{
		$todo = array();
		foreach ($ids as $key => $value)
		{
			$fila = dameDenunciasCorreo($value);

			$descripciones = dameMotivosCorreo($value);

			$archivos = dameArchivosDenuncia($value);

		   //var_dump($descripciones); exit();
			array_push($todo, $fila);
		}
		return array($todo,$descripciones,$archivos);
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
					
					$consulta = "INSERT INTO TBLASIGNACIONDENUNCIAS (
						CLV_ASIGNACION, 
						INT_ID_DIRECCION,STR_ID_DENUNCIA,FECHA_ASIGNACION)
values
(
	:clv_asignacion,
	:int_id_direccion,
	:str_id_denuncia,
	:fecha_asignacion
	)";
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

oci_bind_by_name($stid, ':clv_asignacion', $clv_asignacion);
oci_bind_by_name($stid, ':int_id_direccion', $direccion);
oci_bind_by_name($stid, ':str_id_denuncia', $denuncia);
oci_bind_by_name($stid, ':fecha_asignacion', $fecha);

$r = oci_execute($stid, OCI_NO_AUTO_COMMIT);
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


?>
