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
	$op = addslashes($_POST["option"]);

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
		if($op=='registro')
		{
			$denunciante = htmlentities($_POST["ciudadano"]);
			//Es una Persona Jurídica
			if($denunciante=='empresa')
			{
				$filtro  = htmlentities($_POST["opciones"]);

				//$valor   = utf8_decode(html_entity_decode($_POST["valor"]));
				//
				$valor   = html_entity_decode( htmlentities($_POST["valor"]));

				if(strlen($valor)>9)
				{
					//tiene mas de 9, significa q hay una ñ 
					$valor = "Ñ".substr( $valor , -8); 

				}

				//$valor = str_replace("\u00d1", "Ñ", $valor);
				//echo $valor;
				//exit();
				//echo json_encode($valor);
				$empresas = dameEmpresa($filtro, $valor);
				

				if($empresas != null)
				{
					echo  "<table class='table' id='tabla_juridica'>
					<thead>
						<tr style='background:#3B5998;'>
							<th class='text-center numpat'  style='color:white;font-size:0.8em;' >N° Patronal</th>
							<th class='text-center'  style='color:white;font-size:0.8em;' >Rif</th>
							<th class='text-center'  style='color:white;font-size:0.8em;' >Empresa</th>
							<th class='text-center'  style='color:white;font-size:0.8em;' >Denunciar</th>
						</tr>
					</thead>
					<tbody>";

						foreach ($empresas as $empresa) {
							echo "<tr style='font-size:0.8em;'>
							<td>".$empresa['ID_EMPRESA']."</td>
							<td>".$empresa['RIF']."</td>
							<td>".$empresa['NOMBRE_EMPRESA']."</td>
							<td><input type='button' class='boton_formulario_empresa btn btn-primary' value='OK' style='' data-id_empresa='".$empresa['ID_EMPRESA']."' data-estatus_empresa='".$empresa['ID_ESTATUS']."' data-rif='".$empresa['RIF']."' data-nombre_empresa='".str_replace(" ","-",$empresa['NOMBRE_EMPRESA'])."' data-direccion='".str_replace(" ","-",$empresa['DOMICILIO_COMPLETO'])."' data-email='".$empresa['EMAIL_PRINCIPAL']."' data-telefono='".$empresa['TELEFONO1']."'></td>
						</tr>";                 
					}

					echo "</tbody><tfoot style='display:none;'>
					<tr style='background:#234181 linear-gradient(#639ACA, #6095C4 20%, #3368A0 60%, #234181 100%) repeat scroll 0% 0%;'>
						<th class='text-center'  style='width:150px !important;color:white;font-size:0.7em;text-align:justify;' >N° Patronal</th>
						<th class='text-center'  style='color:white;font-size:0.7em;text-align:justify;' >Rif</th>
						<th class='text-center'  style='color:white;font-size:0.7em;text-align:justify;' >Empresa</th>
						<th class='text-center'  style='color:white;font-size:0.7em;text-align:justify;' >Denunciar</th>
					</tr>
				</tfoot>";
				echo "</table>"; 
				#<tr><td colspan='4'><button id='boton_formulario2' class='btn btn-default' onclick='enviarFormulario()' style='width:200px;float:right;cursor:pointer;font-size:0.8em;'>Otras empresas &nbsp;<span class='glyphicon glyphicon-plus' style='color:#04C;'></span></button></td></tr>
			}else{
				echo "<p style='color:red; font-size:1.2em;'>No se han encontrado registros </p>";
			}

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
			echo  "<table class='table' id='tabla_juridica'>
			<tr class='cols-tabla'>
				<td><b>Empresa</b></td>
				<td><b>N° Patronal</b></td>
				<td><b>Estatus</b></td>
				<td><b>Denunciar</b></td>
			</tr>";

			foreach ($result as $empresa) {
				echo "<tr style='font-size:0.8em;'>
				<td>".$empresa['NOMBRE_EMPRESA']."</td>
				<td>".$empresa['ID_EMPRESA']."</td>
				<td>".$empresa['ID_ESTATUS']."</td>
				<td><input type='button' class='boton_formulario btn btn-primary' value='OK' style='width:40px;' data-id_empresa='".$empresa['ID_EMPRESA']."' data-estatus_empresa='".$empresa['ID_ESTATUS']."' data-rif='".$empresa['RIF']."' data-nombre_empresa='".str_replace(" ","-",$empresa['NOMBRE_EMPRESA'])."' data-direccion='".str_replace(" ","-",$empresa['DOMICILIO_COMPLETO'])."' ></td>
			</tr>";                 
		}
		echo "<tr><td colspan='4'><button id='boton_formulario2' class='btn btn-default' onclick='enviarFormulario()' style='width:200px;float:right;cursor:pointer;font-size:0.8em;'>Otras empresas &nbsp;<span class='glyphicon glyphicon-plus' style='color:#04C;'></span></button></td></tr></table>";     
	}else{
		echo "<b>No se han encontrado registros</b>";
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