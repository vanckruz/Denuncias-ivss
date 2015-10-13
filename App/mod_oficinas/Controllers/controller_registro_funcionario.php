<?php 
ini_set("display_errors", 1);
error_reporting(E_ALL);

if ($_SERVER['REQUEST_METHOD']=='POST')
{	
	
	echo "<pre>";
	print_r($_POST);
	echo "</pre>";
	
	include("../Models/model_funcionario.php");
	include("../Models/class_funcionario.php");
	include("../../../resources/orcl_conex.php");
	include("../../../resources/select/funciones.php");
	
	if(isset($_POST['option_agregar']))
	{
		$region_funcionario       = htmlentities($_POST['region_ofc_funcionario']);
		$estado_funcionario       = htmlentities($_POST['Estado_ofc_funcionario']);
		$id_oficina               = htmlentities($_POST['oficina_funcionario']);
		$nacionalidad_funcionario = htmlentities($_POST['nacionalidad_funcionario']);
		$cedula_funcionario       = htmlentities($_POST['cedula_funcionario']);
		$nombre1_funcionario      = htmlentities($_POST['nombre_funcionario']);
		$nombre2_funcionario      = htmlentities($_POST['nombre2_funcionario']);
		$apellido1_funcionario    = htmlentities($_POST['apellido_funcionario']);
		$apellido2_funcionario    = htmlentities($_POST['apellido2_funcionario']);
		$cargo_funcionario        = htmlentities($_POST['cargo_funcionario']);
		
		$funcionario              = new Funcionario();
		$modelo                   = new FuncionarioDAO();

		$funcionario              ->__SET('id_funcionario', $cedula_funcionario);
		$funcionario              ->__SET('nacionalidad', $nacionalidad_funcionario);
		$funcionario              ->__SET('id_oficina', $id_oficina);
		$funcionario              ->__SET('primer_nombre', $nombre1_funcionario);
		$funcionario              ->__SET('segundo_nombre', $nombre2_funcionario);
		$funcionario              ->__SET('primer_apellido', $apellido1_funcionario);
		$funcionario              ->__SET('segundo_apellido', $apellido2_funcionario);
		$funcionario              ->__SET('cargo', $cargo_funcionario);

		if($modelo ->agregar($funcionario))
		{
			header("Location: ../oficinas.php?mensaje=Funcionario Agregado Correctamente");
		}
		else
		{
			header("Location: ../oficinas.php?mensaje=Error en el Registro");
		}
	}

	if(isset($_REQUEST['option_editar']))
	{
		
		
	}

	if(isset($_REQUEST['option_eliminar']))
	{
		
	}
}
?>