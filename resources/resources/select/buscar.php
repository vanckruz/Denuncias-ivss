<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
require_once("funciones.php");
require_once("../orcl_conex.php");

//consultar codigos de estado
if(isset($_POST['codigo']))
{
	$id_estado = $_POST['codigo'];
	$codigos   = dameCodigosEstados($id_estado);
	$html         = '';
	
	foreach($codigos as $indice => $registro)
	{
		$html .= "<option style= 'padding:5px;' value='".$registro['CODIGO_AREA']."'>".$registro['CODIGO_AREA']."</option>";
	}
	
	$respuesta = array("html"=>$html);
	echo json_encode($respuesta);
}


//consultar estado por ubicacion Geográfica
if(isset($_POST['region']))
{
	$id_ubicacion = $_POST['region'];
	$estados      = dameEstadosRegion($id_ubicacion);
	$html         = '';
	
	foreach($estados as $indice => $registro)
	{
		$html .= "<option data-estado='".$registro['ID_ESTADO']."' value='".$registro['INICIAL_NUMERO_EMPRESA']."'>".$registro['NOMBRE_ESTADO']."</option>";
	}
	
	$respuesta = array("html"=>$html);
	echo json_encode($respuesta);
}


if(isset($_POST['regionUsers']))
{
	$id_ubicacion = $_POST['regionUsers'];
	$estados      = dameEstadosRegion($id_ubicacion);
	$html         = '';
	
	foreach($estados as $indice => $registro)
	{
		$html .= "<option value='".$registro['ID_ESTADO']."'>".$registro['NOMBRE_ESTADO']."</option>";
	}
	
	$respuesta = array("html"=>$html);
	echo json_encode($respuesta);
}


//consultar oficina administrativa
if(isset($_POST['primera_letra']))
{
	$letra     = $_POST['primera_letra'];
	$oficinas  = dameOficinas($letra);
	$html = "<option value=''>Seleccione</option>";
	
	foreach($oficinas as $indice => $registro)
	{
		$html .= "<option value='".$registro['ID_OFICINA_IVSS']."'>".$registro['NOMBRE_OFICINA']."</option>";
	}
	
	$respuesta = array("html"=>$html);
	echo json_encode($respuesta);
}


//consultar ciudadno
if(isset($_POST['nac_apo']) && isset($_POST['id_apo']))
{
	$ciudadano 		= dameCiudadano($_POST['nac_apo'],$_POST['id_apo']);
	if ($ciudadano == ""){
		$respuesta = array("nombre"=>false);
	} else{
		$usuario   		= dameUsuario($_POST['nac_apo'],$_POST['id_apo']);
		$nombre    		= $ciudadano[0]['PRIMER_NOMBRE']." ".$ciudadano[0]['SEGUNDO_NOMBRE'];
		$apellido  		= $ciudadano[0]['PRIMER_APELLIDO']." ".$ciudadano[0]['SEGUNDO_APELLIDO'];
		$prinom    		= $ciudadano[0]['PRIMER_NOMBRE'];
		$segnom    		= $ciudadano[0]['SEGUNDO_NOMBRE'];
		$priape    		= $ciudadano[0]['PRIMER_APELLIDO'];
		$segape    		= $ciudadano[0]['SEGUNDO_APELLIDO'];
		$telhab    		= $ciudadano[0]['TELEFONO_HAB'];
		$telmov    		= $ciudadano[0]['TELEFONO_MOVIL'];
		$email	   		= $ciudadano[0]['EMAIL_PRINCIPAL'];
		$id_ciudadano 	= $ciudadano[0]['ID_CIUDADANO'];
		$respuesta = array("nombre"=>$nombre, "apellido"=>$apellido, "prinom"=>$prinom,"segnom"=>$segnom,"priape"=>$priape,"segape"=>$segape,"telhab"=>$telhab,"telmov"=>$telmov,'email'=>$email,'usuario'=>$usuario,'id_ciudadano'=>$id_ciudadano);
	}

	echo json_encode($respuesta);
}

//consultar municipios
if(isset($_POST['estado']))
{
	
	$municipios = dameMunicipio(htmlentities($_POST['estado']));
	
	$html = "<option value=''>Seleccione</option>";   
	foreach($municipios as $indice => $registro)
	{
		$html .= "<option data-municipio='".$registro['NOMBRE_MUNICIPIO']."' value='".$registro['ID_MUNICIPIO']."'>".$registro['NOMBRE_MUNICIPIO']."</option>";
	}
	
	$respuesta = array("html"=>$html);
	echo json_encode($respuesta);
}

if(isset($_POST['municipio']))
{
	
	$localidades= dameLocalidad(htmlentities($_POST['municipio']));
	
	$html = "<option value=''>Seleccione</option>";
	foreach($localidades as $indice => $registro)
	{
		$html .= "<option data-parroquia='".$registro['DESC_PARROQUIA']."' value='".$registro['ID_PARROQUIA']."'>".$registro['DESC_PARROQUIA']."</option>";
	}
	
	$respuesta = array("html"=>$html);
	echo json_encode($respuesta);
}

if(isset($_POST['year']) && isset($_POST['month']))
{
	$html = '<option value="">Seleccione</option>';
	$year = htmlentities($_POST['year']);
	$month = htmlentities($_POST['month']);
	$html;
	$dias = days_in_month($month, $year);
	for($i=1;$i<=$dias;$i++)
	{
		$html.= '<option value="'.$i.'">'.$i.'</option>';
	}
	
	$respuesta = array("html"=>$html);
	echo json_encode($respuesta);
}

if(isset($_POST['filtro']) && isset($_POST['valor']))
{
	$filtro = strtoupper(htmlentities($_POST['filtro']));
	$valor = strtoupper(htmlentities($_POST['valor']));
	$empresas = dameEmpresa($filtro, $valor);

	$html = "<table class='table table-bordered table-hover table-constriped' id='tabla_datos_empresa' >
	<caption>Resultados</caption>
	<thead>
		<tr style='background:#3B5998;'>
			<th class='text-center'  style='color:white;' >Rif</th>
			<th class='text-center'  style='color:white;' >N° Patronal</th>
			<th class='text-center'  style='color:white;' >Nombre</th>
			<th class='text-center'  style='color:white;' >Dirección</th>
			<th class='text-center'  style='color:white;' >Teléfono</th>
			<th class='text-center'  style='color:white;' >Confirmar</th>
		</tr>
	</thead>
	<tbody>";
		foreach($empresas as $empresa)
		{
			$html .= "<tr>
			<!--<td class='sup'></td>-->
			<td>".( ($empresa['RIF'] != null) ? $empresa['RIF'] :'' )."</td>
			<td>".( ($empresa['ID_EMPRESA'] != null) ? $empresa['ID_EMPRESA'] : '' )."</td>
			<td>".( ($empresa['NOMBRE_EMPRESA'] != null )? $empresa['NOMBRE_EMPRESA'] : '' )."</td>
			<td>".( ($empresa['DOMICILIO_COMPLETO'] != null) ? $empresa['DOMICILIO_COMPLETO'] : '' )."</td>
			<td>".( ($empresa['TELEFONO1'] != null) ? $empresa['TELEFONO1'] : '' )."</td>
			<td class='tdboton'><input type='button' value='OK' class='btnok btn btn-primary' data-rif='".( ($empresa['RIF'] != null) ? $empresa['RIF'] :'' )."' data-ID_EMPRESA='".( ($empresa['ID_EMPRESA'] != null) ? $empresa['ID_EMPRESA'] : '' )."'  data-NOMBRE_EMPRESA='".str_replace(" ","-",( ($empresa['NOMBRE_EMPRESA'] != null )? $empresa['NOMBRE_EMPRESA'] : '') )."' data-DOMICILIO_COMPLETO='".str_replace(" ","-",( ($empresa['DOMICILIO_COMPLETO'] != null) ? $empresa['DOMICILIO_COMPLETO'] : '' ) )."' data-TELEFONO1='".( ($empresa['TELEFONO1'] != null) ? $empresa['TELEFONO1'] : '' )."'  data-dismiss='modal' style='width:50px; text-align:center;'/></td>
		</tr>";
	}

	$html .="</tbody></table>";
	$respuesta = array("html"=>$html);
	echo json_encode($respuesta);
}

if(isset($_POST['direcciongeneral'])){

	$id_direccionlinea 	= $_POST['direcciongeneral'];
	$direcioneslinea	= dameDireccionesLinea($id_direccionlinea);
	$html = "<option style= 'padding:5px;' value=''>Seleccione</option>";


	if($direcioneslinea!=false)
	{
		foreach($direcioneslinea as $indice => $registro)
		{	
			$html .= "<option style= 'padding:5px;' value='".$registro['ID_DIRECCION_LINEA']."'>".$registro['NOMBRE']."</option>";
		}

	} else {
		$html = false;
	}
	$respuesta = array("html"=>$html);
	echo json_encode($respuesta);
}

?>