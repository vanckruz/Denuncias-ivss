<?php
error_reporting(E_ALL);
ini_set("display_errors", 1); 

if ($_SERVER['REQUEST_METHOD']=='POST')
{	
	include("../Models/class_direcciones_asignacion.php");
	include("../Models/model_direcciones_asignacion.php");
	//include("../Models/include_denuncia.php");
	include("../../../resources/orcl_conex.php");
	include("../../../resources/select/funciones.php");
	if(isset($_REQUEST['option']) && $_REQUEST['option']=="registrar")
	{
		$direcciones = array();
		$correos     = array();

		$modelo = new DireccionesAsignacionDAO();
		$ids = dameId();
		$id_direccion = $ids[0]['DIRECCION_ASIGNACION'];
		echo "Registrar".$id_direccion."<br>";
		
		foreach($_POST['correo'] as $correo)
		{
			$correos[] = $correo;
		}

		$correo = 0;
		foreach($_POST['direccion'] as $nombre)
		{
			$direccion = new DireccionesAsignacion();
			$direccion->__SET('id_direccion', $id_direccion++);
			$direccion->__SET('nombre', $nombre);
			$direccion->__SET('correo', $correos[$correo++]);
			$direcciones[] = $direccion;
		}

		if($modelo->agregar($direcciones))
		{
			#echo "Documento agregado";
			header('Location: ../denuncias.php?mensaje=Dirección(es) agregada(s) correctamente!&dir=1');
		}
		else
		{
			#echo "error en el registro";
			header('Location: ../denuncias.php?mensaje=Error en el registro&dir=1');

		}	
	}

	if(isset($_REQUEST['option_editar']) && $_REQUEST['option_editar']=="editar")
	{
		
		$modelo         = new DireccionesAsignacionDAO();
		$direccion      = new DireccionesAsignacion();
		$id_direccion   = $_POST['id_motivo'];
		$descripcion    = $_POST['descripcion_documento'];
		$correo         = $_POST['correo_direccion'];

		$direccion->__SET('id_direccion', $id_direccion);
		$direccion->__SET('nombre', $descripcion);
		$direccion->__SET('correo', $correo);

		if($modelo->actualizar($direccion))
		{
			#echo "documento editado";
			header('Location: ../denuncias.php?mensaje=Dirección editada&dir=1');
		}
		else
		{
			#echo "Error al editar el documento";
			header('Location: ../denuncias.php?mensaje=Error al editar la dirección&dir=1');
		}

	}

	if(isset($_REQUEST['option_eliminar']))
	{
		$id                 = $_POST['eliminar_documento'];
		$modelo             = new DireccionesAsignacionDAO();
		$asignadas_denuncia = $modelo->getAsignadasdenuncias($id);
		$asignadas_queja    = $modelo->getAsignadasQuejas($id);
		
		if($asignadas_denuncia!=0 || $asignadas_queja!=0)
		{
			#echo "Este documento no puede ser eliminado ya que se encuentra en uso";
			header('Location: ../denuncias.php?mensaje=Este dirección no puede ser eliminada ya que se encuentra en uso&dir=1');	
		}
		else
		{
			if($modelo->eliminar($id))
			{
				#echo "documento Eliminado";
				header('Location: ../denuncias.php?mensaje=Dirección Eliminada&dir=1');
				//require();//VISTA DE REGISTRO EXITOSO
			}
			else
			{
				#echo "Error al eliminar el documento";
				header('Location: ../denuncias.php?mensaje=Error al eliminar la dirección&dir=1');
				//require();//VISTA DE ERROR EN EL REGISTRO
			}
		}
	}
}
?>