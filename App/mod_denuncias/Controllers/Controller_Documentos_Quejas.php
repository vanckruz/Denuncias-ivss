<?php   
if ($_SERVER['REQUEST_METHOD']=='POST')
{
	include("../Models/class_documentos_quejas.php");
	include("../Models/model_documentos_queja.php");
	include("../Models/class_denuncia_juridica.php");
	include("../Models/class_denuncia_juridica_dao.php");
	include("../../../resources/orcl_conex.php");
	include("../../../resources/select/funciones.php");

	/*******************AGREGAR NUEVOS DOCUMENTOS DE QUEJA*********************/
	if(isset($_REQUEST['action']) && $_REQUEST['action'] == 'ingresar')
	{
		$modelo = new DocumentoQuejaDAO();
		$ids = dameId();
		$id_documento = $ids[0]['DOCUMENTO_QUEJA'];
		$des       = htmlentities($_POST['input_descripcion_ingreso']);
		$documento = new DocumentoQueja();
		$documento->__SET('id_documento', $id_documento);
		$documento->__SET('descripcion', $des);
		
		/**********Para agregar Varios documentos a la vez************
		$documentos = array();
		foreach($_POST['documento'] as $des)
		{
			$documento = new DocumentoDenuncia();
			$documento->__SET('id_documento', $id_documento++);
			$documento->__SET('descripcion', $des);
			$documentos[] = $documento;
		}

		echo "<pre>";
		print_r($documentos);
		echo "</pre>";
		exit();
		/**********************************************************/

		if($modelo->agregar($documento))
		{
			
			header('Location: ../quejas.php?mensaje=Documento agregado correctamente');
		}
		else
		{
			header('Location: ../quejas.php?mensaje=Error en el registro');
		}
	}
	
	/***********************EDITAR DOCUMENTOS DE QUEJA*********************/
	if(isset($_REQUEST['action']) && $_REQUEST['action'] == 'editar')
	{
		$modelo      = new DocumentoQuejaDAO();
		$documento      = new DocumentoQueja();
		$id          = $_POST['id_documento'];
		$descripcion = htmlentities($_POST['input_documento_edicion']); 
		$documento->__SET('id_documento', $id);
		$documento->__SET('descripcion', $descripcion);

		if($modelo->editar($documento))
		{
			
			
			header('Location: ../quejas.php?mensaje=Documento editado');
		}
		else
		{
			
			header('Location: ../quejas.php?mensaje=Error al editar');
			
		}
	}

	/********************ELIMINAR DOCUMENTOS DE QUEJA************************/
	if(isset($_REQUEST['action']) && $_REQUEST['action'] == 'eliminar')
	{
		$modelo      = new DocumentoQuejaDAO();
		$id          = $_POST['input_id_eliminiacion'];
		
		$modelo_denuncia    = new DenunciaJuridicaDAO();
		$denuncia           = $modelo_denuncia->getByDocumentos($id);
		
		if($denuncia['DOCUMENTOS']!=0)
		{
			
			header('Location: ../quejas.php?mensaje=Este documento se encuentra en uso');
		}
		else
		{
			if($modelo->eliminar($id))
			{
				
				header('Location: ../quejas.php?mensaje=Documento Eliminado');
			}
			else
			{
				
				header('Location: ../quejas.php?mensaje=Error al eliminar');
				
			}			
		}
	}
}
?>