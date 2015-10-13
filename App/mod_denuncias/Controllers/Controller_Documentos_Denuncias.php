<?php  
if ($_SERVER['REQUEST_METHOD']=='POST')
{
	include("../Models/class_documentos_denuncia.php");
	include("../Models/model_documentos_denuncia.php");
	include("../Models/include_denuncia.php");
	include("../../../resources/orcl_conex.php");
	include("../../../resources/select/funciones.php");
	if(isset($_REQUEST['option']))
	{
		$documentos = array();
		$modelo = new DocumentoDenunciaDAO();
		$ids = dameId();
		$id_documento = $ids[0]['DOCUMENTO_DENUNCIA'];
		$vacio =0;
		foreach($_POST['documento'] as $des)
		{
			if($des==""){$vacio++;}
			$documento = new DocumentoDenuncia();
			$documento->__SET('id_documento', $id_documento++);
			$documento->__SET('descripcion', $des);
			$documentos[] = $documento;
		}

		if($vacio!=0){header('Location: ../denuncias.php?mensaje=Escriba una descripción para todos los documentos&doc=1');}
		else
		{
			if($modelo->agregar($documentos))
			{
			#echo "Documento agregado";
				header('Location: ../denuncias.php?mensaje=Documento agregado&doc=1');
			}
			else
			{
			#echo "error en el registro";
				header('Location: ../denuncias.php?mensaje=Error en el registro&doc=1');

			}
		}

	}

	if(isset($_REQUEST['option_editar']))
	{
		$modelo      = new DocumentoDenunciaDAO();
		$documento      = new DocumentoDenuncia();
		$id_documento   = $_POST['id_motivo'];
		$descripcion = $_POST['descripcion_documento'];

		$documento->__SET('id_documento', $id_documento);
		$documento->__SET('descripcion', $descripcion);

		if($modelo->actualizar($documento))
		{
			#echo "documento editado";
			header('Location: ../denuncias.php?mensaje=Documento editado&doc=1');
		}
		else
		{
			#echo "Error al editar el documento";
			header('Location: ../denuncias.php?mensaje=Error al editar el documento&doc=1');
		}
		
	}

	if(isset($_REQUEST['option_eliminar']))
	{
		$id          = $_POST['eliminar_documento'];
		$modelo      = new DocumentoDenunciaDAO();

		$modelo_denuncia = new DenunciaDAO();
		$documentos      = $modelo_denuncia->getByDocumentos($id);

		if($documentos['DOCUMENTOS']!=0)
		{
			#echo "Este documento no puede ser eliminado ya que se encuentra en uso";
			header('Location: ../denuncias.php?mensaje=Este documento no puede ser eliminado ya que se encuentra en uso&doc=1');	
		}
		else
		{
			if($modelo->eliminar($id))
			{
				#echo "documento Eliminado";
				header('Location: ../denuncias.php?mensaje=Documento Eliminado&doc=1');
				//require();//VISTA DE REGISTRO EXITOSO
			}
			else
			{
				#echo "Error al eliminar el documento";
				header('Location: ../denuncias.php?mensaje=Error al eliminar el documento&doc=1');
				//require();//VISTA DE ERROR EN EL REGISTRO
			}
		}
	}
}
?>