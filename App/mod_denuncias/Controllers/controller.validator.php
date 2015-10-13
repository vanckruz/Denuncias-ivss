<?php
#include("../Models/include_denuncia.php");
/*
include("../Models/include_denuncia.php");
include("../Models/class_denuncia_juridica.php");
include("../Models/class_denuncia_juridica_dao.php");
include("../Views/Mensajes.php");
include("../Views/class.Registro.php");	
include("../../mod_ciudadanos/Models/model_Ciudadano.php");
include("../../mod_ciudadanos/Models/class.Ciudadano.php");
include("../../mod_ciudadanos/Models/class_fisc_ciudadano.php");
include("../../mod_ciudadanos/Models/class_fisc_ciudadanoDAO.php");
include("../../mod_empresas/Models/model_Empresa.php");
include("../../mod_empresas/Models/class_fisc_empresa.php");
include("../../mod_empresas/Models/class_fisc_empresaDAO.php");	
include('../../../resources/orcl_conex.php');
include('../../../resources/select/funciones.php');


$id_emp = $_POST['id_empresa'];
$id_ced = $_POST['id_ciudadano'];

$modelo    = new DenunciaDAO();
$denuncias = $modelo->getByID_ced($id_emp,$id_ced);

/*$existe=0;
foreach($denuncias as $key)
{
	if($key->__GET('estatus_denuncia')=='0')
	{
		$existe++;
	}
}
*/

//echo $denuncias["PEPE"];
echo "Hola mundo";
?>