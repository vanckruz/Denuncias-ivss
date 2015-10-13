<?php   
if ($_SERVER['REQUEST_METHOD']=='POST')
{	
	include("../Models/class_motivos_denuncia.php");
	include("../Models/model_motivos_denuncia.php");
	include("../Models/include_denuncia.php");
	include("../../../resources/orcl_conex.php");
	include("../../../resources/select/funciones.php");
	
	if(isset($_REQUEST['option']))
	{
		$motivos = array();
		$modelo = new MotivoDenunciaDAO();
		$ids = dameId();
		$id_motivo = $ids[0]['MOTIVO_DENUNCIA'];
		$vacio =0;
		foreach($_POST['motivo'] as $des)
		{
			if($des==""){$vacio++;}
			$motivo = new MotivoDenuncia();
			$motivo->__SET('id_motivo', $id_motivo++);
			$motivo->__SET('descripcion', $des);
			$motivos[] = $motivo;
		}
		if($vacio!=0){header('Location: ../denuncias.php?mensaje=Escriba una descripción para todos los documentos&doc=1');}
		else{
			if($modelo->agregar($motivos))
			{
				
				header('Location: ../denuncias.php?mensaje=Motivo(s) agregado(s) correctamente&mot=1');
			}
			else
			{
				
				header('Location: ../denuncias.php?mensaje=Error en el registro&mot=1');
			}
		}
		
		
	}

	if(isset($_REQUEST['option_editar']))
	{
		$modelo      = new MotivoDenunciaDAO();
		$motivo      = new MotivoDenuncia();
		$id_motivo   = $_POST['id_motivo'];
		$descripcion = $_POST['descripcion_motivo'];

		$motivo->__SET('id_motivo', $id_motivo);
		$motivo->__SET('descripcion', $descripcion);

		if($modelo->actualizar($motivo))
		{
			
			header('Location: ../denuncias.php?mensaje=Motivo editado&mot=1');
			
		}
		else
		{
			
			header('Location: ../denuncias.php?mensaje=Error al editar el motivo&mot=1');
			
		}
	}

	if(isset($_REQUEST['option_eliminar']))
	{
		$id          = $_POST['eliminar_motivo'];
		$modelo      = new MotivoDenunciaDAO();

		$modelo_denuncia = new DenunciaDAO();
		$denuncia        = $modelo_denuncia->getByMotivo($id);
		
		if($denuncia['MOTIVOS']!=0)
		{
			
			header('Location: ../denuncias.php?mensaje=Este motivo no puede ser eliminado ya que se encuentra en uso&mot=1');
		}
		else
		{
			if($modelo->eliminar($id))
			{
				
				header('Location: ../denuncias.php?mensaje=Motivo Eliminado&mot=1');
				
			}
			else
			{
				
				header('Location: ../denuncias.php?mensaje=Error al eliminar&mot=1');
				
			}			
		}
	}
}
?>