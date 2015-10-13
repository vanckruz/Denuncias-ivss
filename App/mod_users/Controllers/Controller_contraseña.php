<?php   
if ($_SERVER['REQUEST_METHOD']=='POST')
{	
	include("../Models/classUsuario.php");
	include("../Models/classUsuarioDAO.php");
	include("../Views/visualizer.php");
	/*echo "<pre>";
	print_r($_POST);
	echo "</pre>";*/
	if(isset($_REQUEST['ingresobutton']))
	{
		$usuario = explode(".",htmlentities($_POST['cedula']));
		$user = $usuario[0].$usuario[1].$usuario[2];
		$newp = htmlentities($_POST['newpassword']);
		$renp = htmlentities($_POST['repeatnewpassword']);
		$modelo  = new UsuarioDAO();
		$usuario = $modelo->getByCedula($user);
		if($usuario->__GET('id_user')==NULL)
		{	
			include('../Views/cambio_contrasena_blank.php');
		} else {
			$usuario = array('id_user'=>$user,'password'=>sha1($newp));
			if($modelo->cambiarContrasena($usuario))
			{
				include('../Views/cambio_contrasena_upd_ok.php');
			} else {
				include('../Views/cambio_contrasena_error.php');
			}
		}
	}
}
?>