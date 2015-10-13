<?php 
error_reporting(E_ALL);
ini_set("display_errors", 1);
include ("../../../resources/orcl_conex.php");
include ("../../../resources/select/funciones.php"); 

if (isset($_POST["cedula"])) {

	$usuario = dameUsuario_correo($_POST["cedula"]);

	if(!empty($usuario[0]['USUARIO'])){
		echo json_encode(array("mensaje"=>"se ha enviado un correo a ".$usuario[0]['CORREO'],"estatus"=>"bien"));
	}else{
		echo json_encode(array("mensaje"=>"La cédula ingresada no esta registrada","estatus","mal"));
	}
	
}

?>