<?php   
if ($_SERVER['REQUEST_METHOD']=='POST')
{	
	/*echo "<pre>";
	print_r($_POST);
	echo "</pre>";*/
	
	include("../Models/class_estatus_denuncia.php");
	include("../Models/model_estatus_denuncia.php");
	include("../Models/include_denuncia.php");
	include("../../../resources/orcl_conex.php");
	include("../../../resources/select/funciones.php");
	
	if(isset($_REQUEST['option']))
	{
		$estatus = array();
		$modelo = new EstatusDenunciaDAO();
		$ids = dameId();
		$id_estatus = $ids[0]['ESTATUS_DENUNCIA'];
		
		foreach($_POST['documento'] as $des)
		{
			$estatus = new EstatusDenuncia();
			$estatus->__SET('id_estatus', $id_estatus++);
			$estatus->__SET('descripcion', $des);
			$estatuses[] = $estatus;
		}
		
		if($modelo->agregar($estatuses))
		{
			#echo "Estatus(s) agregado(s) correctamente";
			header('Location: ../denuncias.php?mensaje=Estatus(s) agregado(s) correctamente&est=1');
		}
		else
		{
			#echo "error en el registro";
			header('Location: ../denuncias.php?mensaje=Error en el registro&est=1');
		}
	}

	if(isset($_REQUEST['option_editar']))
	{
		$modelo      = new EstatusDenunciaDAO();
		$estatus      = new EstatusDenuncia();
		$id_estatus   = $_POST['id_motivo'];
		$descripcion = $_POST['descripcion_documento'];

		$estatus->__SET('id_estatus', $id_estatus);
		$estatus->__SET('descripcion', $descripcion);

		if($modelo->actualizar($estatus))
		{
		#echo "Estatus editado";
			//require();//VISTA DE REGISTRO EXITOSO
			header('Location: ../denuncias.php?mensaje=Estatus editado&est=1');
		}
		else
		{
			#echo "Error al editar el Estatus";
			//require();//VISTA DE ERROR EN EL REGISTRO
			header('Location: ../denuncias.php?mensaje=Error al editar el Estatus&est=1');
		}
	}

	if(isset($_REQUEST['option_eliminar']))
	{
		$id_estatus  = $_POST['eliminar_documento'];
		$modelo      = new EstatusDenunciaDAO();

		$modelo_denuncia = new DenunciaDAO();
		$denuncia        = $modelo_denuncia->getByEstatus($id_estatus);
		
		if($denuncia['ESTATUS']!=0)
		{
			#echo "";	
			header('Location: ../denuncias.php?mensaje=Este estatus no puede ser eliminado ya que se encuentra en uso&est=1');
		}
		else
		{
			if($modelo->eliminar($id_estatus))
			{
				#echo "Estatus Eliminado";
				//require();//VISTA DE REGISTRO EXITOSO
				header('Location: ../denuncias.php?mensaje=Estatus Eliminado&est=1');

			}
			else
			{
				#echo "Error al eliminar";
				//require();//VISTA DE ERROR EN EL REGISTRO
				header('Location: ../denuncias.php?mensaje=Error al eliminar&est=1');

			}			
		}
	}
}
?>