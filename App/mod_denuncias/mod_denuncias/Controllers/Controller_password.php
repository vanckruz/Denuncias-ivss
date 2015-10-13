<?php 
	include('../../../resources/orcl_conex.php');

	$newpassword = sha1($_POST['newpassword']);
	$token = $_POST['token'];

	//var_dump($newpassword); exit();

	if(actualizarPassword($newpassword,$token)) 
	{
		include('../../mod_users/Views/cambio_contrasena_upd_ok.php');
		//echo "si";


	}else
	{
		include('../../mod_users/Views/cambio_contrasena_error.php');
		//echo "no";
	}

	/*
		Funcion actualizarPassword
		param: 
		*newpassword: password nuevo
		*token: token campo unico del usuario sha1 
	*/
	function actualizarPassword($newpassword,$token)
	{
		$conex = DataBase::getInstance();
		$stid = oci_parse($conex, "UPDATE FISC_USERS SET 
						password=:newpassword
				    WHERE token=:token");
		if (!$stid)
		{
			oci_free_statement($stid);
			oci_close($conex);
			return false;
		}

		// Realizar la lógica de la consulta
		oci_bind_by_name($stid, ':token', $token);
		oci_bind_by_name($stid, ':newpassword' , $newpassword);

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

 	//pass anterior pedro  7c4a8d09ca3762af61e59520943dc26494f8941b

 ?>