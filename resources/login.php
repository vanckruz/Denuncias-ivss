<?php
	/*
	 * Valida un usuario y contraseña o presenta el formulario para hacer login
	 */
	error_reporting(E_ALL);
	ini_set("display_errors", 1);
	
	if ($_SERVER['REQUEST_METHOD']=='POST') { // ¿Nos mandan datos por el formulario?
    //include('resources/config.ini.php'); //incluimos configuración
    require_once('class.Login.php'); //incluimos las funciones
    $login = new Login();
    //si hace falta cambiamos las propiedades tabla, campo_usuario, campo_contraseña, metodo_encriptacion

    //verificamos el usuario y contraseña mandados
		$nick = htmlentities($_POST['usuario']);
		$password = htmlentities($_POST['password']);
		$cedula = htmlentities($_POST['cedula']);
		$usuario = $login->login_users($cedula, $nick, $password);
		if($usuario == TRUE)
		{
			header('Location:../App/sistemafiscal.php');
        	die();
		}
		else 
		{
        //acciones a realizar en un intento fallido
        //Ej: mostrar captcha para evitar ataques fuerza bruta, bloquear durante un rato esta ip, ....
      
        //preparamos un mensaje de error y continuamos para mostrar el formulario
        	$mensaje='<br/>Datos de acceso incorrectos';
			//require("../index.php");
			
			echo "<script type='text/javascript'>
					$('#mensaje').append({$mensaje});
				 </script>";
			echo $mensaje;
    	}
} //fin if post
?>