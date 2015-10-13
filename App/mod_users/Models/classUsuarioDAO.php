<?php
session_start();
	//include('DataBase.php'); Funcionando actualmente
	//include('classConexion.php');
include('../../../resources/orcl_conex.php');
class UsuarioDAO{
	private $conex;
	public function __construct()
	{

	}

	public function obtenerUsuario($cedula, $email)
	{
			//Abrir la conexión
		$this->conex = DataBase::getInstance();

			// Preparar la sentencia
		$stid = oci_parse($this->conex, "SELECT * FROM FISC_USERS WHERE (ID_USER='{$cedula}' AND CORREO='{$email}')");
		if (!$stid){
			$e = oci_error($this->conex);
			trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
		}
			// Realizar la lógica de la consulta
		$r = oci_execute($stid);
		if (!$r){
			$e = oci_error($stid);
			trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
		}
			// Obtener los resultados de la consulta
		$alm = new Usuario();
			//
		while ($fila = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)){
			$it = new ArrayIterator($fila);

			while($it->valid()){
				$alm->__SET(strtolower($it->key()),$it->current());
				$it->next();
			}
		}
			//Libera los recursos
		oci_free_statement($stid);
			// Cierra la conexión Oracle
		oci_close($this->conex);
			//retorna el resultado de la consulta
		return $alm;
	}

	public function verificarUser(&$usuario){

			//Abrir la conexión
		$this->conex = DataBase::getInstance();

			// Preparar la sentencia
		$stid = oci_parse($this->conex, "SELECT COUNT(*) AS UsuarioCuenta FROM FISC_USERS WHERE ID_USER='{$usuario}'");
		if (!$stid){
			$e = oci_error($this->conex);
			trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
		}
			// Realizar la lógica de la consulta
		$r = oci_execute($stid);
		if (!$r){
			$e = oci_error($stid);
			trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
		}
			// Obtener los resultados de la consulta
		$fila = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS);
			//Libera los recursos
		oci_free_statement($stid);
			// Cierra la conexión Oracle
		oci_close($this->conex);
			//retorna el resultado de la consulta
		return $fila;

	}

	public function verificarUserInsert(&$usuario){

			//Abrir la conexión
		$this->conex = DataBase::getInstance();

			// Preparar la sentencia
		$stid = oci_parse($this->conex, "SELECT * FROM FISC_USERS WHERE ID_USER='{$usuario}'");
		if (!$stid){
			$e = oci_error($this->conex);
			trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
		}
			// Realizar la lógica de la consulta
		$r = oci_execute($stid);
		if (!$r){
			$e = oci_error($stid);
			trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
		}
			// Obtener los resultados de la consulta
		$fila = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS);
			//Libera los recursos
		oci_free_statement($stid);
			// Cierra la conexión Oracle
		oci_close($this->conex);
			//retorna el resultado de la consulta
		return $fila;

	}

	public function registrarUsuario(&$usuario)
	{
			//preparamos los datos a insertar
		$nac                 =  $usuario      ->__GET('nacionalidad');   
		$id                  = 	$usuario      ->__GET('id_user');
		$name                = 	$usuario      ->__GET('nombre');
		$apellido            = 	$usuario      ->__GET('apellido');
		$email               = 	$usuario      ->__GET('correo'); 
		$pass                = 	$usuario      ->__GET('password'); 
		$perfil              = 	$usuario      ->__GET('user_type');
		$region              =  $usuario      ->__GET('region'); 
		$estado              = 	$usuario      ->__GET('estado'); 
		$oficina             = 	$usuario      ->__GET('oficina'); 
		$direccion_general   = 	$usuario      ->__GET('direccion_general');
		$departamento        = 	$usuario      ->__GET('departamento');
		$direccion_linea     = 	$usuario      ->__GET('direccion_linea');
		$user                = 	$usuario      ->__GET('usuario');
		$codigo_usuario      = 	$usuario      ->__GET('codigo_usuario');
		$telefono_habitacion = 	$usuario      ->__GET('telefono_habitacion');
		$telefono_movil      = 	$usuario      ->__GET('telefono_movil');


			//Abrir la conexión
		$this->conex = DataBase::getInstance();

			// Preparar la sentencia
		$consulta = "INSERT INTO FISC_USERS(
			NACIONALIDAD,
			ID_USER,
			NOMBRE,
			APELLIDO,
			CORREO,
			PASSWORD,
			USER_TYPE,
			REGION,
			ESTADO,
			OFICINA,
			DIRECCION_GENERAL,
			DEPARTAMENTO,
			DIRECCION_LINEA,
			USUARIO,
			CODIGO_USUARIO,
			TELEFONO_HABITACION,
			TELEFONO_MOVIL)
values 
(
	:nac,
	:id_user, 
	:username, 
	:apellido,
	:correo, 
	:password, 
	:user_type,
	:region,
	:estado, 
	:oficina, 
	:dir_gen,
	:depart, 
	:dir_lin, 
	:usuario, 
	:cod_user, 
	:tel_hab, 
	:tel_mov
	)";

$stid = oci_parse($this->conex,$consulta);
if (!$stid)
{
				//Libera los recursos
	oci_free_statement($stid);
				// Cierra la conexión Oracle
	oci_close($this->conex);
	return false;
}

			// Realizar la lógica de la consulta

oci_bind_by_name($stid, ':nac'       , $nac );
oci_bind_by_name($stid, ':id_user'   , $id );
oci_bind_by_name($stid, ':username'  , $name );
oci_bind_by_name($stid, ':apellido'  , $apellido );
oci_bind_by_name($stid, ':correo'    , $email );
oci_bind_by_name($stid, ':password'  , $pass );
oci_bind_by_name($stid, ':user_type' , $perfil );
oci_bind_by_name($stid, ':region'    , $region );
oci_bind_by_name($stid, ':estado'    , $estado );
oci_bind_by_name($stid, ':oficina'   , $oficina );
oci_bind_by_name($stid, ':dir_gen'   , $direccion_general );
oci_bind_by_name($stid, ':depart'    , $departamento );
oci_bind_by_name($stid, ':dir_lin'   , $direccion_linea );
oci_bind_by_name($stid, ':usuario'   , $user );
oci_bind_by_name($stid, 'cod_user'   , $codigo_usuario );
oci_bind_by_name($stid, ':tel_hab'   , $telefono_habitacion );
oci_bind_by_name($stid, ':tel_mov'   , $telefono_movil );

$r = oci_execute($stid);
if (!$r)
{
				//Libera los recursos
	oci_free_statement($stid);
				// Cierra la conexión Oracle
	oci_close($this->conex);

	return false;
}

			//Libera los recursos
oci_free_statement($stid);
			// Cierra la conexión Oracle
oci_close($this->conex);
return true;
}

public function getByCedula($cedula)
{
			//Abrir la conexión
	$this->conex = DataBase::getInstance();

			// Preparar la sentencia
	$consulta = "SELECT * FROM FISC_USERS WHERE ID_USER=:cedula";
	$stid = oci_parse($this->conex, $consulta);
	if (!$stid){
		$e = oci_error($this->conex);
		trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
	}
			// Realizar la lógica de la consulta
	ocibindbyname($stid, ':cedula', $cedula);
	$r = oci_execute($stid);
	if (!$r){
		$e = oci_error($stid);
		trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
	}
			// Obtener los resultados de la consulta
	$alm = new Usuario();
			//
	while ($fila = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)){
		$it = new ArrayIterator($fila);

		while($it->valid()){
			$alm->__SET(strtolower($it->key()),$it->current());
			$it->next();
		}
	}
			//Libera los recursos
	oci_free_statement($stid);
			// Cierra la conexión Oracle
	oci_close($this->conex);
			//retorna el resultado de la consulta
	return $alm;
}

public function getByCedulaUser($cedula)
{
			//Abrir la conexión
	$this->conex = DataBase::getInstance();

			// Preparar la sentencia
	$consulta = "SELECT * FROM FISC_USERS WHERE ID_USER=:cedula AND INT_BORRADO='0'";
	$stid = oci_parse($this->conex, $consulta);
	if (!$stid){
		$e = oci_error($this->conex);
		trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
	}
			// Realizar la lógica de la consulta
	ocibindbyname($stid, ':cedula', $cedula);
	$r = oci_execute($stid);
	if (!$r){
		$e = oci_error($stid);
		trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
	}
			// Obtener los resultados de la consulta
	$alm = new Usuario();
			//
	while ($fila = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)){
		$it = new ArrayIterator($fila);

		while($it->valid()){
			$alm->__SET(strtolower($it->key()),$it->current());
			$it->next();
		}
	}
			//Libera los recursos
	oci_free_statement($stid);
			// Cierra la conexión Oracle
	oci_close($this->conex);
			//retorna el resultado de la consulta
	return $alm;
}

public function getByCorreo($correo){

			//Abrir la conexión
	$this->conex = DataBase::getInstance();

			// Preparar la sentencia
	$consulta = "SELECT * FROM FISC_USERS WHERE USUARIO=:correo AND INT_BORRADO =0";
	$stid = oci_parse($this->conex, $consulta);
	if (!$stid){
		$e = oci_error($this->conex);
		trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
	}
			// Realizar la lógica de la consulta
	ocibindbyname($stid, ':correo', $correo);
	$r = oci_execute($stid);
	if (!$r){
		$e = oci_error($stid);
		trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
	}
			// Obtener los resultados de la consulta
	$alm = new Usuario();
			//
	while ($fila = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)){
		$it = new ArrayIterator($fila);

		while($it->valid()){
			$alm->__SET(strtolower($it->key()),$it->current());
			$it->next();
		}
	}
			//Libera los recursos
	oci_free_statement($stid);
			// Cierra la conexión Oracle
	oci_close($this->conex);
			//retorna el resultado de la consulta
	return $alm;
}

public function getByCodUser($CodUser){

			//Abrir la conexión
	$this->conex = DataBase::getInstance();

			// Preparar la sentencia
	$consulta = "SELECT * FROM FISC_USERS WHERE CODIGO_USUARIO=:codigo AND INT_BORRADO =0";
	$stid = oci_parse($this->conex, $consulta);
	if (!$stid){
		$e = oci_error($this->conex);
		trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
	}
			// Realizar la lógica de la consulta
	ocibindbyname($stid, ':codigo', $CodUser);
	$r = oci_execute($stid);
	if (!$r){
		$e = oci_error($stid);
		trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
	}
			// Obtener los resultados de la consulta
	$alm = new Usuario();
			//
	while ($fila = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)){
		$it = new ArrayIterator($fila);

		while($it->valid()){
			$alm->__SET(strtolower($it->key()),$it->current());
			$it->next();
		}
	}
			//Libera los recursos
	oci_free_statement($stid);
			// Cierra la conexión Oracle
	oci_close($this->conex);
			//retorna el resultado de la consulta
	return $alm;
}		

public function modificarUsuario(&$datos){

				//preparamos los datos a insertar
	$id_user             = 	$datos      ->__GET('id_user');
	$name                = 	$datos      ->__GET('nombre');
	$apellido            = 	$datos      ->__GET('apellido');
	$departamento        = 	$datos      ->__GET('departamento');
	$email               = 	$datos      ->__GET('correo');
	$perfil              = 	$datos      ->__GET('user_type');
	$region              =  $datos      ->__GET('region');
	$estado              = 	$datos      ->__GET('estado');
	$oficina             = 	$datos      ->__GET('oficina');
	$direccion_general   = 	$datos      ->__GET('direccion_general');
	$direccion_linea     = 	$datos      ->__GET('direccion_linea');
	$user                = 	$datos      ->__GET('usuario');
	$telefono_habitacion = 	$datos      ->__GET('telefono_habitacion');
	$telefono_movil      = 	$datos      ->__GET('telefono_movil');
	$codigo_usuario      =  $datos      ->__GET('codigo_usuario');


	$this->conex = DataBase::getInstance();
	$consulta =  "UPDATE FISC_USERS 
	SET NOMBRE 			= '$name'
	,APELLIDO 				= '$apellido'		
	,CORREO 				= '$email'			
	,USER_TYPE 				= '$perfil'
	,DEPARTAMENTO 			= '$departamento'
	,ESTADO 				= '$estado'
	,OFICINA 				= '$oficina'
	,DIRECCION_GENERAL 		= '$direccion_general'
	,DIRECCION_LINEA 		= '$direccion_linea'
	,USUARIO 				= '$user'
	,TELEFONO_HABITACION 	= '$telefono_habitacion'
	,TELEFONO_MOVIL 		= '$telefono_movil'
	,REGION 				= '$region' 
	WHERE ID_USER = '$id_user'";
	

	$stid = oci_parse($this->conex, $consulta);

	if (!$stid){
		$e = oci_error($this->conex);
		trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
		oci_close($this->conex);
		return false;
	}		

	$r = oci_execute($stid,OCI_NO_AUTO_COMMIT);

	if (!$r){
		$e = oci_error($stid);
		trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
		oci_close($this->conex);
		return false;
	}

	/*echo $r;
	exit();	*/

	/*INSERTANDO EN TBL_GESTION_USUARIOS*/
	$consulta_gestion = "INSERT INTO TBL_GESTION_USUARIOS(
		CODIGO_USUARIO,
		ACCION,
		FECHA,
		DESCRIPCION,
		RESPONSABLE)
values 
(
	:codigo_usuario,
	:accion,
	:fecha,
	:descripcion,
	:responsable
	)";

$responsable = $_SESSION['USUARIO']['codigo_usuario'];
$accion      = 2;
$fecha       = date('d/m/y');
$descripcion = "Modificar datos del usuario";

$stid_gestion = oci_parse($this->conex, $consulta_gestion);

if (!$stid_gestion)
{
	$e = oci_error($this->conex);
	trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
	    		//$e = oci_error($this->conex);
	    		//trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
				//Libera los recursos
	oci_free_statement($stid);
	oci_free_statement($stid_gestion);
				// Cierra la conexión Oracle
	oci_close($this->conex);
	return false;
}

	// Realizar la lógica de la consulta
oci_bind_by_name($stid_gestion, ':codigo_usuario', $codigo_usuario);
oci_bind_by_name($stid_gestion, ':accion', $accion);
oci_bind_by_name($stid_gestion, ':fecha', $fecha);
oci_bind_by_name($stid_gestion, ':descripcion', $descripcion);
oci_bind_by_name($stid_gestion, ':responsable', $responsable);

$result_gestion = oci_execute($stid_gestion, OCI_NO_AUTO_COMMIT);
if (!$result_gestion)
{
	//echo "Desde el execute 2";
	$e = oci_error($this->conex);
	trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
	    		//Revertimos los cambios
	oci_rollback($this->conex);
				//Libera los recursos
	oci_free_statement($stid_gestion);
	oci_free_statement($stid);
				// Cierra la conexión Oracle
	oci_close($this->conex);
	return false;
}
/*INSERTANDO EN TBL_GESTION_USUARIOS*/
$result = oci_commit($this->conex);
if(!$result) 
{
	oci_close($this->conex);
	return false;

}


oci_free_statement($stid);
oci_close($this->conex);
return true;
}

public function eliminarUsuario($cedula, $codigo){
	
	$this->conex = DataBase::getInstance();
	$stid = oci_parse($this->conex, "UPDATE FISC_USERS SET INT_BORRADO = 1 WHERE ID_USER =:cedula");
	if (!$stid){
		$e = oci_error($this->conex);
		trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
		return false;
	}
	ocibindbyname($stid,':cedula',$cedula);
	$r = oci_execute($stid, OCI_NO_AUTO_COMMIT);
	if (!$r){
		$e = oci_error($stid);
		trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
		return false;
	}

	/*INSERTANDO EN TBL_GESTION_USUARIOS*/
	$consulta_gestion = "INSERT INTO TBL_GESTION_USUARIOS(
		CODIGO_USUARIO,
		ACCION,
		FECHA,
		DESCRIPCION,
		RESPONSABLE)
values 
(
	:codigo_usuario,
	:accion,
	:fecha,
	:descripcion,
	:responsable
	)";

$responsable = $_SESSION['USUARIO']['codigo_usuario'];
$accion      = 3;
$fecha       = date('d/m/y');
$descripcion = "Eliminar usuario";

$stid_gestion = oci_parse($this->conex, $consulta_gestion);

if (!$stid_gestion)
{
	$e = oci_error($this->conex);
	trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
	    		//$e = oci_error($this->conex);
	    		//trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
				//Libera los recursos
	oci_free_statement($stid);
	oci_free_statement($stid_gestion);
				// Cierra la conexión Oracle
	oci_close($this->conex);
	return false;
}

	// Realizar la lógica de la consulta
oci_bind_by_name($stid_gestion, ':codigo_usuario', $codigo);
oci_bind_by_name($stid_gestion, ':accion', $accion);
oci_bind_by_name($stid_gestion, ':fecha', $fecha);
oci_bind_by_name($stid_gestion, ':descripcion', $descripcion);
oci_bind_by_name($stid_gestion, ':responsable', $responsable);

$result_gestion = oci_execute($stid_gestion, OCI_NO_AUTO_COMMIT);
if (!$result_gestion)
{
	echo "Desde el execute 2";
	$e = oci_error($this->conex);
	trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
	    		//Revertimos los cambios
	oci_rollback($this->conex);
				//Libera los recursos
	oci_free_statement($stid_gestion);
	oci_free_statement($stid);
				// Cierra la conexión Oracle
	oci_close($this->conex);
	return false;
}
/*INSERTANDO EN TBL_GESTION_USUARIOS*/

$result = oci_commit($this->conex);
if(!$result) 
{
	oci_close($this->conex);
	return false;

}

oci_free_statement($stid);
oci_close($this->conex);
return true;
}

public function cambiarContrasena($data)
{
	$id_user  	= $data['id_user'];
	$password 	= $data['password'];
	$this->conex = DataBase::getInstance();
	$stid = oci_parse($this->conex, "UPDATE FISC_USERS SET 
		password=:password
		WHERE id_user=:id_user");
	if (!$stid)
	{
		oci_free_statement($stid);
		oci_close($this->conex);
		return false;
	}

			// Realizar la lógica de la consulta
	oci_bind_by_name($stid, ':password', $password);
	oci_bind_by_name($stid, ':id_user' , $id_user);

	$r = oci_execute($stid, OCI_NO_AUTO_COMMIT);
	if (!$r)
	{
		oci_free_statement($stid);
		oci_close($this->conex);
		return false;
	}

	$r = oci_commit($this->conex);
	if(!$r)
	{
		oci_free_statement($stid);
		oci_close($this->conex);
		return false;

	}
	oci_free_statement($stid);
			// Cierra la conexión Oracle
	oci_close($this->conex);
	return true;
}

public function activarUsuario(&$codusario, $codigo){
	
	$this->conex = DataBase::getInstance();
	$stid = oci_parse($this->conex, "UPDATE FISC_USERS SET INT_BORRADO = 0 WHERE ID_USER =$codusario");
	if (!$stid){
		oci_close($this->conex);
		$e = oci_error($this->conex);
		trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
		return false;
	}
			//ocibindbyname($stid,':codusario',$codusario);
	$r = oci_execute($stid, OCI_NO_AUTO_COMMIT);
	if (!$r){
		oci_close($this->conex);
		$e = oci_error($stid);
		trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
		return false;
	}

	/*INSERTANDO EN TBL_GESTION_USUARIOS*/
	$consulta_gestion = "INSERT INTO TBL_GESTION_USUARIOS(
		CODIGO_USUARIO,
		ACCION,
		FECHA,
		DESCRIPCION,
		RESPONSABLE)
values 
(
	:codigo_usuario,
	:accion,
	:fecha,
	:descripcion,
	:responsable
	)";

$responsable = $_SESSION['USUARIO']['codigo_usuario'];
$accion      = 4;
$fecha       = date('d/m/y');
$descripcion = "Activar usuario";

$stid_gestion = oci_parse($this->conex, $consulta_gestion);

if (!$stid_gestion)
{
	$e = oci_error($this->conex);
	trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
	    		//$e = oci_error($this->conex);
	    		//trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
				//Libera los recursos
	oci_free_statement($stid);
	oci_free_statement($stid_gestion);
				// Cierra la conexión Oracle
	oci_close($this->conex);
	return false;
}

	// Realizar la lógica de la consulta
oci_bind_by_name($stid_gestion, ':codigo_usuario', $codigo);
oci_bind_by_name($stid_gestion, ':accion', $accion);
oci_bind_by_name($stid_gestion, ':fecha', $fecha);
oci_bind_by_name($stid_gestion, ':descripcion', $descripcion);
oci_bind_by_name($stid_gestion, ':responsable', $responsable);

$result_gestion = oci_execute($stid_gestion, OCI_NO_AUTO_COMMIT);
if (!$result_gestion)
{
	echo "Desde el execute 2";
	$e = oci_error($this->conex);
	trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
	    		//Revertimos los cambios
	oci_rollback($this->conex);
				//Libera los recursos
	oci_free_statement($stid_gestion);
	oci_free_statement($stid);
				// Cierra la conexión Oracle
	oci_close($this->conex);
	return false;
}
/*INSERTANDO EN TBL_GESTION_USUARIOS*/

$result = oci_commit($this->conex);
if(!$result) 
{
	oci_close($this->conex);
	return false;

}
oci_free_statement($stid);
oci_close($this->conex);
return true;
}
}
?>

