	<?php
	header ('Content-type: text/html; charset=utf-8');
	error_reporting(E_ALL);
	ini_set("display_errors", 1);
	
	include("../Models/include_denuncia.php");
	include("../Views/Mensajes.php");
	include("../Views/class.Registro.php");	
	include("../../mod_ciudadanos/Models/model_Ciudadano.php");
	include("../../mod_ciudadanos/Models/class.Ciudadano.php");
	include("../../mod_empresas/Models/model_Empresa.php");
	include("../../mod_empresas/Models/class_fisc_empresa.php");
	include("../../mod_ciudadanos/Models/class_fisc_ciudadano.php");	
	include('../../../resources/orcl_conex.php');
	include('../../../resources/select/funciones.php');

		// capturar la acción a realizar
		//$op = addslashes($_POST["option"]);

		//Funciones previas
		/**
		 ** ajustar cédula al formato de la base de datos
		**/
		function prepara_cedula($ced)
		{
			if(strlen ($ced)<9)
			{
				$ceros = 9-strlen($ced);
				$aux = $ced;
				$ced="";
				for($i=0;$i<$ceros;$i++){
					$ced.=0;
				}
				$ced.=$aux;
			}
			return $ced;
		}

		/**
		 ** Verificar existecia de Ciudadanos
		**/
		function queryCiudadano($id, &$ciudadano, $ciudadanod)
		{
			$ciudadano = $ciudadanod->getById($id);
			if($ciudadano->__GET('id_ciudadano')!='')
				return true;
			else
				return false;
		}

		/**
		 ** Verificar existencia de denuncias para el usuario actual
		**/
		function queryDenuncia($id_ciu, &$denuncia, $denunciad)
		{
			$existe = 0;
			$denuncia = $denunciad->getByIC($id_ciu);
			$it = new ArrayIterator($denuncia);
			while($it->valid())
			{
				if($it->current()->__GET('id_denuncia')!='')
				{
					$existe++;
				}
				$it->next();
			}

			if($existe !=0)
				return true;
			else
				return false;
		}

		/**
		 ** Verificar existencia de Empresa
		**/
		function existe_empresa($clave, $valor, &$empresa, $modelo)
		{
			$existe  = 0;
			$empresa = $modelo->consultar_empresa($clave, $valor);

			$it = new ArrayIterator($empresa);
			while($it->valid())
			{
				if($it->current()->__GET('id_empresa')!='')
				{
					$existe++;
				}
				$it->next();
			}

			if($existe !=0)
				return true;
			else
				return false;
		}

		//Procesar las peticiones
		/**
		 ** Petición de registro de denuncia
		**/

		if($_POST["option"]=='registro')
		{
			$denunciante = htmlentities($_POST["ciudadano"]);
			//Es una Persona Jurídica
			if($denunciante=='empresa')
			{
				$filtro  = htmlentities($_POST["opciones"]);
				$valor   = htmlentities($_POST["valor"]);

			}//FIN Persona Jurídica

			//Es una Persona Natural
			else if($denunciante=='persona')
			{
				/*echo htmlentities($_POST["nacionalidad"])." ". htmlentities($_POST["cedula"]);*/
				$ciudadano = new Ciudadano();
				$ciudadanod = new CiudadanoDAO();
				$denuncia = new Denuncia();
				$denunciad = new DenunciaDAO();
				$nac = htmlentities($_POST["nacionalidad"]);
				$ced = prepara_cedula(htmlentities($_POST["cedula"]));
				$id_ciu = $nac.$ced;
				$consulta = "SELECT ID_ASEGURADO FROM SIRA.ASEGURADO WHERE ID_CIUDADANO =:id";
				$conex = DataBase::getInstance();
		// Preparar la sentencia
		$stid = oci_parse($conex,"SELECT * FROM SIRA.EMPRESA WHERE ID_EMPRESA IN(SELECT ID_EMPRESA FROM SIRA.ASEGURADO_EMPRESA WHERE ID_ASEGURADO IN(SELECT ID_ASEGURADO FROM SIRA.ASEGURADO WHERE ID_CIUDADANO = '".$id_ciu."') )"); # AND ID_ESTATUS_ASEGURADO = 'A' 

		if (!$stid){
			$e = oci_error($conex);
			trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
		}
		// Realizar la lógica de la consulta
		#oci_bind_by_name($stid, ':id', $id_ciu);
		$r = oci_execute($stid);
		if (!$r){
			$e = oci_error($stid);
			trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
		}

		$result = array();

		// Obtener los resultados de la consulta
		$id_asegurado;
		while ($fila = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)){
			$result[] = $fila;
			/*echo "<pre>";
			var_dump($fila,1);
			echo "</pre>";*/
			//$id_asegurado = $fila['NOMBRE_EMPRESA'];
		}
		

		if($result != null){
			echo  "<table class='table'>
			<tr>
				<td class='class_th nombre_empresa'><b>Empresa</b></td>
				<td class='class_th id_empresa'><b>N° Patronal</b></td>
				<td class='class_th estatus_empresa'><b>Estatus</b></td>
				<td class='class_th actividad_empresa'><b>Actividad Económica</b></td>
				<td class='class_th '><b>Denunciar</b></td>
			</tr>";

			foreach ($result as $empresa) {
				echo "<tr>
				<td class='class_td nombre_empresa'>".$empresa['NOMBRE_EMPRESA']."</td>
				<td class='class_td id_empresa'>".$empresa['ID_EMPRESA']."</td>
				<td class='class_td estatus_empresa'>".$empresa['ID_ESTATUS']."</td>
				<td class='class_td actividad_empresa'>";

					$queryActividad = oci_parse($conex,"SELECT * FROM SIRA.ACTIVIDAD_ECONOMICA WHERE ID_ACTIVIDAD = '".$empresa['ID_ACTIVIDAD']."' ");
					oci_execute($queryActividad);

					while ($actividad_economica = oci_fetch_array($queryActividad, OCI_ASSOC+OCI_RETURN_NULLS)) {
						echo $actividad_economica['DESC_ACTIVIDAD'];
					}

					echo  "</td><td><input type='button' class='boton_formulario btn btn-primary' value='ok' style='font-size:0.8em;".(($empresa['ID_ACTIVIDAD'] == 15 || $empresa['ID_ACTIVIDAD'] == 16 || $empresa['ID_ACTIVIDAD'] == 17 || $empresa['ID_ACTIVIDAD'] == 66 || $empresa['ID_ACTIVIDAD'] == 97 )? 'display:none;' : '')."' data-id_empresa='".$empresa['ID_EMPRESA']."' data-estatus_empresa='".$empresa['ID_ESTATUS']."' data-rif='".$empresa['RIF']."' data-nombre_empresa='".str_replace(" ","-",$empresa['NOMBRE_EMPRESA'])."' data-direccion='".str_replace(" ","-",$empresa['DOMICILIO_COMPLETO'])."' ></td></tr>";  
					/*********************************************************************************************/                               
}#foreach

echo "<tr><td colspan='5'><button id='boton_formulario2' class='btn btn-primary' onclick='enviarFormulario()' style='width:200px;float:right;cursor:pointer;font-size:0.8em;'>Otra empresa</button></td></tr></table>";     
}else{
	echo "<p style='font-size:1.2em;color:red;'>¡ No se han encontrado resultados !</p>";
}

//Libera los recursos
oci_free_statement($stid);
		// Cierra la conexión Oracle
oci_close($conex);


				/*empieza aqui el comentario de refactorizacion
				//inicio Consultar Ciudadano
				if(queryCiudadano($id_ciu, $ciudadano, $ciudadanod))
				{
					//Inicio Consultar denuncias
					if(queryDenuncia($id_ciu, $denuncia, $denunciad))
					{
						$existe=0;
						foreach($denuncia as $key)
						{
							//if(strtoupper($key->__GET('estatusDenuncia'))=='EN PROCESO')
							if($key->__GET('estatus_denuncia')=='0')
							{
								$existe++;
							}
						}
						if($existe!=0)
						{
							//Impedir registro de denuncia
							$mensaje = new Visualizer('DEN','EXIST');
							$mensaje->showMensaje();	
						}
						else
						{
							$registro = new Registro($id_ciu);
							$registro->showForm();
							
						}
					}//FIN queryDenuncia
					else
					{
						$registro = new Registro($id_ciu);
						$registro->showForm();
					}
				}//FIN queryCiudadano
				else
				{
					$mensaje = new Visualizer('CIU','NRF');
					$mensaje->showMensaje();
				}
				Termina aqui el comentario de factorizacion
				*/
			}//FIN Persona Natural
		}