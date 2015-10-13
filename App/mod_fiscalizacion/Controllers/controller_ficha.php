<?php 
if ($_SERVER['REQUEST_METHOD']=='POST')
{
	include('../Models/class_ficha.php');
	include('../Models/class_ficha_dao.php');
	include("../../mod_empresas/Models/model_Empresa.php");
	include("../../../resources/orcl_conex.php");
	include("../../../resources/select/funciones.php");

	$ficha = new Ficha();

	$ficha ->__SET('id_ficha',htmlentities($_POST['id_ficha']));
	$ficha ->__SET('fecha_elaboracion',htmlentities($_POST['fecha_elaboracion']));
	$ficha ->__SET('id_empresa',htmlentities($_POST['id_empresa']));
	$ficha ->__SET('rif',htmlentities($_POST['rif']));
	$ficha ->__SET('nombre_empresa_ivss',htmlentities($_POST['razon']));
	$ficha ->__SET('nombre_empresa_seniat',htmlentities($_POST['nombre_empresa_seniat']));
	$ficha ->__SET('id_representante',htmlentities($_POST['cedula']));
	$ficha ->__SET('nombre_representante',htmlentities($_POST['nombre_representante']));
	$ficha ->__SET('direccion_ivss',htmlentities($_POST['direccion_ivss']));
	$ficha ->__SET('direccion_fiscalizacion',htmlentities($_POST['direccion_fiscalizacion']));
	$ficha ->__SET('oficina_registro',htmlentities($_POST['oficina_registro']));
	$ficha ->__SET('fecha_registro',htmlentities($_POST['fecha_registro']));
	$ficha ->__SET('numero',htmlentities($_POST['numero']));
	$ficha ->__SET('tomo',htmlentities($_POST['tomo']));
	$ficha ->__SET('folio',htmlentities($_POST['folio']));
	$ficha ->__SET('protocolo',htmlentities($_POST['protocolo']));
	$ficha ->__SET('fecha_inicio_actividad',htmlentities($_POST['fecha_actividad']));
	$ficha ->__SET('fecha_inscripcion_ivss',htmlentities($_POST['fecha_inscripcion']));
	$ficha ->__SET('numero_sucursales',htmlentities($_POST['numero_sucursales']));
	$ficha ->__SET('denominacion_comercial',htmlentities($_POST['denominacion']));
	$ficha ->__SET('email_empresa',htmlentities($_POST['email']));
	$ficha ->__SET('telefono_empresa',htmlentities($_POST['telefono']));
	$ficha ->__SET('persona_contacto',htmlentities($_POST['contacto']));
	$ficha ->__SET('registro_ivss',htmlentities($_POST['registro_ivss']));
	$ficha ->__SET('registro_tiuna',htmlentities($_POST['registro_tiuna']));
	$ficha ->__SET('nivel_riesgo',htmlentities($_POST['nivel_riesgo']));
	$ficha ->__SET('retencion',htmlentities($_POST['retencion']));
	$ficha ->__SET('actividad_economica',htmlentities($_POST['actividad_economica']));
	$ficha ->__SET('trabajadores_activos',htmlentities($_POST['activos']));
	$ficha ->__SET('afiliados_ivss',htmlentities($_POST['afiliados']));
	$ficha ->__SET('diferencia_trabajadores',htmlentities($_POST['difeferencia']));
	$ficha ->__SET('forma14_02',htmlentities($_POST['forma1402']));
	$ficha ->__SET('forma14_03',htmlentities($_POST['forma1403']));
	$ficha ->__SET('cambio_salario',htmlentities($_POST['cambio_salario']));
	$ficha ->__SET('morosidad',htmlentities($_POST['morosidad']));
	$ficha ->__SET('observaciones',htmlentities($_POST['observaciones']));
	$ficha ->__SET('id_funcionario',htmlentities($_POST['id_funcionario']));
	$ficha ->__SET('nombre_funcionario',htmlentities($_POST['nombre_funcionario']));

	echo "<pre>";
	print_r($ficha);
	echo "</pre>";

}