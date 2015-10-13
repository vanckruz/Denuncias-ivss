<?php 
ini_set("display_errors", 1);
error_reporting(E_ALL);

if ($_SERVER['REQUEST_METHOD']=='POST')
{	
	include("../Models/model_jefe_oficina.php");
	include("../Models/model_oficina.php");
	include("../Models/class_oficina.php");
	include("../Models/class_jefe_oficina.php");
	include("../../../resources/orcl_conex.php");
	include("../../../resources/select/funciones.php");
	
	if(isset($_POST['option_agregar']))
	{
		$nombre_oficina    = htmlentities($_POST['nombre_oficina_adm']);
		$siglas_oficina    = htmlentities($_POST['siglas_oficina_adm']);
		$region_oficina    = htmlentities($_POST['region']);
		$estado_oficina    = htmlentities($_POST['estados_region']);
		$direccion_oficina = htmlentities($_POST['direccion']);

		$nacionalidad_jefe = htmlentities($_POST['nacionalidad']);
		$cedula_jefe       = htmlentities($_POST['cedula_jefe_oficina']);
		$protocolo_jefe    = htmlentities($_POST['tratamiento_protocolario']);
		$nombre1_jefe      = htmlentities($_POST['prinom']);
		$nombre2_jefe      = htmlentities($_POST['segnom']);
		$apellido1_jefe    = htmlentities($_POST['priape']);
		$apellido2_jefe    = htmlentities($_POST['segape']);
		$numero_resolucion = htmlentities($_POST['resolucion']);
		$fecha_resolucion  = htmlentities($_POST['fecha_resolucion']);
		
		$oficina           = new Oficina();
		$jefe              = new JefeOficina();

		//Datos de la Oficina
		$oficina           ->__SET('id_oficina', $siglas_oficina);
		$oficina           ->__SET('id_jefe',    $cedula_jefe);
		$oficina           ->__SET('id_region' , $region_oficina);
		$oficina           ->__SET('id_estado' , $estado_oficina);
		$oficina           ->__SET('siglas'    , $siglas_oficina);
		$oficina           ->__SET('nombre'    , $nombre_oficina);
		$oficina           ->__SET('direccion' , $direccion_oficina);

		//Datos del jefe de Oficina
		$jefe              ->__SET('nacionalidad'          , $nacionalidad_jefe);
		$jefe              ->__SET('id_jefe'               , $cedula_jefe);
		$jefe              ->__SET('primer_nombre'         , $nombre1_jefe);
		$jefe              ->__SET('segundo_nombre'        , $nombre2_jefe);
		$jefe              ->__SET('primer_apellido'       , $apellido1_jefe);
		$jefe              ->__SET('segundo_apellido'      , $apellido2_jefe);
		$jefe              ->__SET('tratamineto_protocolar', $protocolo_jefe);
		$jefe              ->__SET('numero_resolucion'     , $numero_resolucion);
		$jefe              ->__SET('fecha_resolucion'      , $fecha_resolucion);
		
		$modelo = new OficinaDAO();

		if($modelo ->agregar($oficina, $jefe))
		{
			header("Location: ../oficinas.php?mensaje=Oficina agregada con éxito!&ivss=1");
		}
		else
		{
			header("Location: ../oficinas.php?mensaje=Error al agregar la oficina!&ivss=1");
		}
	}

	if(isset($_REQUEST['option_editar']))
	{

		$nombre_oficina    = htmlentities($_POST['nombre_oficina_adm']);
		$siglas_oficina    = htmlentities($_POST['siglas_oficina_adm']);
		//$region_oficina    = htmlentities($_POST['region']);
		//$estado_oficina    = htmlentities($_POST['estados_region']);
		$direccion_oficina = htmlentities($_POST['direccion']);

		//$nacionalidad_jefe = htmlentities($_POST['nacionalidad']);
		$cedula_jefe       = htmlentities($_POST['id_ciu']);
		$protocolo_jefe    = htmlentities($_POST['tratamiento_protocolario']);
		$nombre1_jefe      = htmlentities($_POST['prinom']);
		$nombre2_jefe      = htmlentities($_POST['segnom']);
		$apellido1_jefe    = htmlentities($_POST['priape']);
		$apellido2_jefe    = htmlentities($_POST['segape']);
		$numero_resolucion = htmlentities($_POST['resolucion']);
		$fecha_resolucion  = htmlentities($_POST['fecha_resolucion']);
		
		$oficina           = new Oficina();
		$jefe              = new JefeOficina();

		//Datos de la Oficina
		$oficina           ->__SET('id_oficina', $siglas_oficina);
		$oficina           ->__SET('id_jefe',    $cedula_jefe);
		//$oficina           ->__SET('id_region' , $region_oficina);
		//$oficina           ->__SET('id_estado' , $estado_oficina);
		$oficina           ->__SET('siglas'    , $siglas_oficina);
		$oficina           ->__SET('nombre'    , $nombre_oficina);
		$oficina           ->__SET('direccion' , $direccion_oficina);

		//Datos del jefe de Oficina
		//$jefe              ->__SET('nacionalidad'          , $nacionalidad_jefe);
		$jefe              ->__SET('id_jefe'               , $cedula_jefe);
		$jefe              ->__SET('primer_nombre'         , $nombre1_jefe);
		$jefe              ->__SET('segundo_nombre'        , $nombre2_jefe);
		$jefe              ->__SET('primer_apellido'       , $apellido1_jefe);
		$jefe              ->__SET('segundo_apellido'      , $apellido2_jefe);
		$jefe              ->__SET('tratamineto_protocolar', $protocolo_jefe);
		$jefe              ->__SET('numero_resolucion'     , $numero_resolucion);
		$jefe              ->__SET('fecha_resolucion'      , $fecha_resolucion);
		

		$modelo = new OficinaDAO();
		if( $modelo->actualizar( $oficina, $jefe ) )
		{
			header("Location: ../oficinas.php?mensaje=Oficina modificada con éxito!&ivss=1");
		}
		else
		{
			header("Location: ../oficinas.php?mensaje=Error al editar la oficina!&ivss=1");
			
		}
		
	}

	if(isset($_REQUEST['option_eliminar']))
	{
		$id_oficina = htmlentities($_POST['id_oficina']);

		$modelo = new OficinaDAO();

		if( $modelo->eliminar($id_oficina) )
		{
			header("Location: ../oficinas.php?mensaje=Oficina eliminada con éxito!&ivss=1");
		}
		else
		{
			header("Location: ../oficinas.php?mensaje=Error al eliminar la oficina!&ivss=1");
		}
	}
}
?>