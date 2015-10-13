<?php
require_once("funciones.php");
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Formulario con SELECT > OPTION Dinamico</title>
<script src="jquery-1.10.2.min.js"></script>
</head>

<body>
<form style="width: 480px">
	<fieldset>
	<legend>Seleccione su entidad federativa</legend>
	<label>Estado:</label>
		<select name="estado" id="estado">
				<option value="">- Seleccione un Estado -</option>
		<?php
		$estados = dameEstado();
		
		foreach($estados as $indice => $registro){
			echo "<option value=".$registro['id_estado'].">".$registro['estado']."</option>";
		}
		?>
	</select>
	<br><br>
	<label>Municipio:</label>
		<select name="municipio" id="municipio">
				<option value="">- primero seleccion un estado -</option>
	</select>
	<br><br>
	<label>Parroquia:</label>
		<select name="localidad" id="localidad">
				<option value="">- primero seleccione un municipio -</option>
	</select>
	</fieldset>
</form>
<hr>
<!--<a href="http://elporfirio.com"><img src="http://porfirio.mx/firma_firio.png"></a>-->
<script>
$("#estado").on("change", buscarMunicipios);
$("#municipio").on("change", buscarLocalidades);

function buscarMunicipios(){
	$("#localidad").html("<option value=''>- primero seleccione un municipio -</option>");
	
	$estado = $("#estado").val();
	
	if($estado == ""){
			$("#municipio").html("<option value=''>- primero seleccione un estado -</option>");
	}
	else {
		$.ajax({
			dataType: "json",
			data: {"estado": $estado},
			url:   'buscar.php',
			type:  'post',
			beforeSend: function(){
				//Lo que se hace antes de enviar el formulario
				},
			success: function(respuesta){
				//lo que se si el destino devuelve algo
				$("#municipio").html(respuesta.html);
			},
			error:	function(xhr,err){ 
				alert("readyState: "+xhr.readyState+"\nstatus: "+xhr.status+"\n \n responseText: "+xhr.responseText);
			}
		});
	}
}

function buscarLocalidades(){
	$municipio = $("#municipio").val();
	
	$.ajax({
		dataType: "json",
		data: {"municipio": $municipio},
		url:   'buscar.php',
        type:  'post',
		beforeSend: function(){
			//Lo que se hace antes de enviar el formulario
			},
        success: function(respuesta){
			//lo que se si el destino devuelve algo
			$("#localidad").html(respuesta.html);
		},
		error:	function(xhr,err){ 
			alert("readyState: "+xhr.readyState+"\nstatus: "+xhr.status+"\n \n responseText: "+xhr.responseText);
		}
	});	
}
</script>
</body>
</html>