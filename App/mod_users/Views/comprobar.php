<?php
		include("../Models/classUsuario.php");
		include("../Models/classUsuarioDAO.php");
		include("../Views/visualizer.php");

		/*
		//$conexion = mysql_connect("localhost", "jean","31051982");
		//mysql_select_db("sicein1");
		$sql = "SELECT * from usuario where cedula='$formcedula'";
		$resultado = mysql_query($sql, $conexion);
		if(mysql_fetch_assoc($resultado)){
		    echo "false";
		}else{
		    echo "true";
		}*/
		$formcedula=$_GET['Email'];
		$this->conex = DataBase::getInstance();
			// Preparar la sentencia
		$stid = oci_parse($this->conex, "SELECT * FROM FISC_USERS WHERE CORREO='$formcedula'");
		if (!$stid){
    		$e = oci_error($this->conex);
    		trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
		}
		// Realizar la lógica de la consulta
		$r = oci_execute($stid);
		if (!$r){
    		$e = oci_error($stid);
    		trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
		}
		// Obtener los resultados de la consulta
		if(oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)){
			echo 'false';
		} else{
			echo 'true';
		}
		//
?> 