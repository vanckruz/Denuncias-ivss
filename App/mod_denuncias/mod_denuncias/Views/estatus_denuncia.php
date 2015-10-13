<?php 
error_reporting(E_ALL);
ini_set("display_errors", 1);
include("../../../resources/orcl_conex.php");
include("../../../resources/select/funciones.php");
include("../../config/config.php");
$estatus = DameEstatusDenuncia();
/*
echo "<pre>";
print_r($estatus);
echo "<pre>";
*/
?>


<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link   href="<?=$base_url;?>/resources/jquery.confirm/jquery.confirm/jquery.confirm.css">
	<link   href="<?=$base_url;?>/public_html/vendor/jquery-ui/jquery-ui.min.css">
	<title>Registro de Estatus</title>

	<script  src="<?=$base_url;?>/public_html/js/jquery-2.1.4.min.js"></script>
	<script  src="<?=$base_url;?>/public_html/vendor/jquery-ui/jquery-ui.min.js"></script>
	<!--<script  src="../../../public_html/js/enviar.js"></script>-->

	<style>
		*{
			margin: 0px;
			padding: 0px;
		}
		html,body{
			width: 100%;
			height: 100%;
		}

		#tabla_motivos tr:nth-child(odd){
			/*background: #aad4ff;*/
		}

		#tabla_motivos tr{
			font-size: .8em;
		}
		#tabla_motivos tr td{
			text-align:left;
			padding:16px !important;
		}
	</style>
</head>
<body>
	<div style="width:100%;background:tranparent;min-height:600px;padding-bottom:21px;position:relative;top:0;">
	<!--<div style="width:50px;background:linear-gradient(#ffffff,#dde9f4);height:100%;float:left;padding-top:150px;">
		<div id="subir" title="subir" style="cursor:pointer;font-size:1.6em;"><span class="glyphicon glyphicon-chevron-up"></span></div>
		<div id="bajar" title="bajar" style="cursor:pointer;font-size:1.6em;"><span class="glyphicon glyphicon-chevron-down"></span></div>
	</div>-->

	<!--Div de abajo 80% en caso de poner el slider-->	
	<div style="width:100%;margin:auto;margin-bottom:0px;background:transparent;color:white;padding:7px 0px 0px 0px;position:relative;z-index:10;border-bottom:1px dotted white;" id="titulo_gestor_motivos">
		<div style="background:#f1f1f1;border-bottom:1px dotted black;padding:7px;overflow:hidden">
			<h3 style="float:left;color:black;padding:7px;">Gestión de Estatus de Denuncia</h3>
			<button class="btn btn-primary" style="float:right;" id="btn_agregar_motivos"><span class="glyphicon glyphicon-plus-sign"></span> Agregar Estatus</button>
		</div>
	</div>

	<!--Contenedor motivos-->
	<div id="content_motivos" style="width:100%;margin:auto;margin-top:0px;background:linear-gradient(#ffffff,#dde9f4);box-shadow:10px 10px 5px #888888;position:relative;">

		<div style="width:100%;">

			<table class="table table-hover" id="tabla_motivos">
				<tr>
					<th style="text-align:center;font-weight:bold;">Descripción</th>
					<th style="text-align:center;font-weight:bold;">Editar</th>
					<th style="text-align:center;font-weight:bold;">Eliminar</th>
				</tr>
				<?php 
				foreach ($estatus as $status) {
					echo '<tr>
					<td style="padding:16px !important;text-align:center;">'.$status["DESCRIPCION"].'</td>
					<td style="text-align:center;">
						<button id="'.$status["ID_ESTATUS"].'" class="btn btn-primary mas_user edit_mot_denuncia" data-nombre_motivo="'.str_replace(" ","-",$status["DESCRIPCION"]).'">
							<span class="glyphicon glyphicon-pencil"></span>
						</button>
					</td>
					<td style="text-align:center;">
						<button id="'.$status["ID_ESTATUS"].'" class="btn btn-danger mas_user eliminar_mot_denuncia" data-nombre_motivo="'.str_replace(" ","-",$status["DESCRIPCION"]).'">
							<span class="glyphicon glyphicon-remove-circle"></span>
						</button>
					</td>
				</tr>';	
			}

			?>
		</table>
	</div><!--Div central form-->	
</div><!--div content motivos-->
</div>
<?php /* ?><button style="text-align:center;background:#234181 linear-gradient(#639ACA, #6095C4 20%, #3368A0 60%, #234181 100%) repeat scroll 0% 0%;color:white;font-size:1.3em;padding:5px;border-radius:5px;margin-top:12px;" onclick="window.location.reload();" title="Regresar al menu"><span class="glyphicon glyphicon-arrow-left"></span> Volver</button><?php */ ?>
<!--***********************************************************************************-->
<!--***********************************************************************************-->

<!--Modal Agregar Documentos-->
<div id="agregar_motivo" style="display:none;width:100%;height:100%;position:fixed;top:0px;left:0px;z-index:50;overflow:hidden;">
	<div style="width:100%;margin-bottom:25px;background:#3B5998;color:white;padding:7px;">
		<h2 style="text-align:center;">Agregar Estatus</h2>
	</div>	
	<div style="width:70%;margin:auto;height:auto;overflow:hidden;padding:25px;background:#f1f1f1;position:relative;">
		<form action="Controllers/Controller_estatus_denuncia.php" method="post" id="form_agregar_motivo">
			<p style="text-align:left;margin-bottom:12px;font-weight:bold;float:left;width:300px;">
				Descripción del Estatus:				
				<hr>
				<div style="width:100px;position:absolute;top:21px;right:10px;">
					<button id="mas_user" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span></button>
					<button id="menos_user" class="btn btn-danger"><span class="glyphicon glyphicon-minus"></span></button>			
				</div>
			</p>
			<input type="hidden" name="option" value="registrar">
			<div id="input_agregador_motivos" style="margin-top:35px">
				<p style='color:red;text-align:left;' id='mensaje_add_doc'></p>
				<input type="text" class="form-control inputivo input_agregar" style="border-radius:0px;" name="documento[]" id="motivos_p">	
			</div>
			<hr>
			<div>
				<button class="btn btn-primary" id="submit_agregar"><span class="glyphicon glyphicon-floppy-disk"></span> Guardar</button>
				<button class="btn btn-danger" id="cerrar_agregar_motivo"><span class="glyphicon glyphicon-remove-circle"></span> Cancelar</button>
			</div>
		</form>	
	</div>
</div>
<!--Modal Agregar Motivo-->

<!--Modal Editar-->
<div id="editar_motivo" style="display:none;width:100%;height:100%;position:fixed;top:0px;left:0px;z-index:50;overflow:hidden;">
	<div style="width:100%;margin-bottom:25px;background:#3B5998;color:white;padding:26px;">
		<h1 style="text-align:center;">Editar este Estatus</h1>
		<!--<span class="glyphicon glyphicon-remove-circle" style="float:right;font-size:1.6em;margin-bottom:21px;margin-right:21px;cursor:pointer;"></span>-->
	</div>	
	<div style="width:70%;margin:auto;height:250px;overflow:hidden;padding:25px;background:#f1f1f1;">
		<form action="Controllers/Controller_estatus_denuncia.php" method="post" id="form_editar_motivo">
			<p style="text-align:left;margin-bottom:12px;font-weight:bold;">Descripción del estatus:</p>
			<input type="hidden" name="option_editar" value="editar">
			<input type="hidden" name="id_motivo" id="id_mots" >
			<input type="text" class="form-control" style="border-radius:0px;" name="descripcion_documento" id="input_motivo_edicion">
			<hr>
			<div>
				<button class="btn btn-primary" id="submit_editar"><span class="glyphicon glyphicon-floppy-disk"></span> Guardar</button>
				<button class="btn btn-danger" id="cerrar_edit_motivo"><span class="glyphicon glyphicon-remove-circle"></span> Cancelar</button>
			</div>
		</form>	
	</div>
</div>
<!--Modal Editar-->

<!--Modal Eliminar-->
<div id="eliminar_motivo" style="display:none;width:100%;height:100%;position:fixed;top:0px;left:0px;z-index:50;overflow:hidden;">
	<div style="width:100%;margin-bottom:25px;background:#3B5998;color:white;padding:26px;">
		<h1 style="text-align:center;">Eliminar este estatus</h1>
		<!--<span class="glyphicon glyphicon-remove-circle" style="float:right;font-size:1.6em;margin-bottom:21px;margin-right:21px;cursor:pointer;"></span>-->
	</div>	
	<div style="width:50%;margin:auto;height:200px;overflow:hidden;padding:12px;background:#f1f1f1;">
		<form action="Controllers/Controller_estatus_denuncia.php" method="post" id="form_eliminar_motivo">
			<p style="text-align:center;margin-bottom:12px;font-size:1.1em;font-weight:bold;">¿Desea eliminar este estatus?</p>
			<hr>
			<input type="hidden" name="option_eliminar" value="eliminar">
			<input type="hidden" name="eliminar_documento" id="input_motivo_eliminar">
			<hr>
			<div>
				<button class="btn btn-danger" id="submit_eliminar"><span class="glyphicon glyphicon-trash"></span> Eliminar</button>
				<button class="btn btn-default" id="cerrar_eliminar_motivo"><span class="glyphicon glyphicon-remove-circle"></span> Cancelar</button>
			</div>
		</form>	
	</div>
</div>
<!--Modal Eliminar-->
<script>
	var c1=100;

	$(document).on("ready",function(){

		$("#mas_user").on("click",function(e){
			e.preventDefault();
			if($(".inputivo").length < 5){agregar();}	
		});

		$("#menos_user").on("click",function(e){
			e.preventDefault();
			if($(".inputivo").length > 1){$(".inputivo:last").remove();}
		});

		/****************************************************************************************************/
		/****************************************************************************************************/
		$('#btn_agregar_motivos').on('click',function(e){
			e.preventDefault();

			var $this = $(this);
			$('#agregar_motivo').css({background:'rgba(0, 0, 0, 0.5)'});
			$('#agregar_motivo').fadeIn();

			$("#input_motivo_agregar").val($this.attr("data-nombre_motivo").replace(/-/g, " "));

		});

		$("#submit_agregar").on("click",function(a){
			a.preventDefault();

			$(".input_agregar").each(function(index, el) {
				if($(this).val() == ""){
					$("#mensaje_add_doc").html("¡ Por favor rellene todos los campos !.");
				}else{
					$("#form_agregar_motivo").submit();					
				}	
			});
			
		});

		$('#cerrar_agregar_motivo').on("click",function(ev){
			ev.preventDefault();
			$('#agregar_motivo').fadeOut();
		});
		/****************************************************************************************************/
		/****************************************************************************************************/

		/****************************************************************************************************/
		/****************************************************************************************************/
		$('.edit_mot_denuncia').on('click',function(e){
			e.preventDefault();

			var $this = $(this);
			$('#editar_motivo').css({background:'rgba(0, 0, 0, 0.5)'});
			$('#editar_motivo').fadeIn();

			$("#input_motivo_edicion").val($this.attr("data-nombre_motivo").replace(/-/g, " "));
			$("#id_mots").val($this.attr("id"));

			$("#submit_editar").on("click",function(a){
				a.preventDefault();
				$("#form_editar_motivo").submit();
			});

			$('#cerrar_edit_motivo').on("click",function(ev){
				ev.preventDefault();
				$('#editar_motivo').fadeOut();
			});
		});
		/****************************************************************************************************/	
		/***********************************************************************************/

		/****************************************************************************************************/
		/****************************************************************************************************/	
		$('.eliminar_mot_denuncia').on('click',function(e){
			e.preventDefault();

			var $this = $(this);
			$('#eliminar_motivo').css({background:'rgba(0, 0, 0, 0.5)'});
			$('#eliminar_motivo').fadeIn();

			$("#input_motivo_eliminar").val($this.attr("id"));

			$("#submit_eliminar").on("click",function(a){
				a.preventDefault();
				$("#form_eliminar_motivo").submit();
			});

			$('#cerrar_eliminar_motivo').on("click",function(ev){
				ev.preventDefault();
				$('#eliminar_motivo').fadeOut();
			});

		});
		/****************************************************************************************************/
		/****************************************************************************************************/

		$("#subir").on("click",function(){
			c1-=100;

			$("#content_motivos").animate({marginTop:c1+"px"}, 700);

			var v = Math.round($("#content_motivos").offset().top);

			if(v <= -100){
				c1 = 0;
				$("#content_motivos").animate({marginTop:c1+"px"}, 1000);
			}
	//alert(v);
});

		
		$("#bajar").on("click",function(){
			c1+=100;
			$("#content_motivos").animate({marginTop:c1+"px"}, 700);

			var v = Math.round($("#content_motivos").offset().top);

			if(v >= 200){
				c1 = 0;
				$("#content_motivos").animate({marginTop:c1+"px"}, 1000);
			}
	//alert(v);
});


		/*Fin ready*/
	});
/*Fin ready*/
/*Function agregar*/
function agregar(){
	var miembro='<input type="text" class="form-control inputivo" style="border-radius:0px;margin-top:7px;" name="documento[]">';
	var nuevo_miembro=$(miembro);
	$("#input_agregador_motivos").append(nuevo_miembro);
}
/*Function agregar*/
</script>
<!--***********************************************************************************-->
<!--***********************************************************************************-->
</body>
</html>