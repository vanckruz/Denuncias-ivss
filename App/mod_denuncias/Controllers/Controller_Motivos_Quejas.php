
<?php   
if ($_SERVER['REQUEST_METHOD']=='POST')
{
	include("../Models/class_motivos_quejas.php");
	include("../Models/model_motivos_queja.php");
	include("../Models/class_denuncia_juridica.php");
	include("../Models/class_denuncia_juridica_dao.php");
	include("../../../resources/orcl_conex.php");
	include("../../../resources/select/funciones.php");
	
	/*******************AGREGAR NUEVOS MOTIVOS DE QUEJA*********************/
	if(isset($_REQUEST['action']) && $_REQUEST['action'] == 'ingresar')
	{
		$modelo = new MotivoQuejaDAO();
		$ids = dameId();
		$id_motivo = $ids[0]['MOTIVO_QUEJA'];
		$des       = htmlentities($_POST['input_descripcion_ingreso']);
		$motivo    = new MotivoQueja();
		$motivo->__SET('id_motivo', $id_motivo);
		$motivo->__SET('descripcion', $des);
		
	/**********Para agregar Varios motivos a la vez***********
		$motivos = array();
		foreach($_POST['motivo'] as $des)
		{
			$motivo = new MotivoDenuncia();
			$motivo->__SET('id_motivo', $id_motivo++);
			$motivo->__SET('descripcion', $des);
			$motivos[] = $motivo;
		}
		**********************************************************/

		if($modelo->agregar($motivo))
		{
			header('Location: ../quejas.php?mensaje=Motivo(s) agregado(s) correctamente&mot=1');
			
		}
		else
		{
			
			header('Location: ../quejas.php?mensaje=Error en el registro&mot=1');
		}
	}
	
	/***********************EDITAR MOTIVOS DE QUEJA*********************/
	if(isset($_REQUEST['action']) && $_REQUEST['action'] == 'editar')
	{
		$modelo      = new MotivoQuejaDAO();
		$motivo      = new MotivoQueja();
		$id          = $_POST['id_motivo'];
		$descripcion = htmlentities($_POST['descripcion_motivo']); 
		$motivo->__SET('id_motivo', $id);
		$motivo->__SET('descripcion', $descripcion);

		if($modelo->editar($motivo))
		{
			
			header('Location: ../quejas.php?mensaje=Motivo editado&mot=1');
		}
		else
		{
			
			header('Location: ../quejas.php?mensaje=Error al editar&mot=1');
		}

	}
	
	/********************ELIMINAR MOTIVOS DE QUEJA************************/
	if(isset($_REQUEST['action']) && $_REQUEST['action'] == 'eliminar')
	{
		
		$modelo      = new MotivoQuejaDAO();
		$id          = $_POST['input_id_eliminiacion'];
		
		$modelo_denuncia    = new DenunciaJuridicaDAO();
		$denuncia           = $modelo_denuncia->getByMotivo($id);
		
		if($denuncia['MOTIVOS']!=0)
		{
			
			header('Location: ../quejas.php?mensaje=Este motivo se encuentra en uso&mot=1');

		}
		else
		{
			if($modelo->eliminar($id))
			{
				header('Location: ../quejas.php?mensaje=Motivo Eliminado&mot=1');
			}
			else
			{
				
				header('Location: ../quejas.php?mensaje=Error al eliminar&mot=1');
			}			
		}
	}

}//FIN $_SERVER['REQUEST_METHOD']

?>