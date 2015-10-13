<?php
require('../../../resources/orcl_conex.php'); 
require('../../../resources/select/funciones.php');
$quejas   = dameQuejasProceso();

$ids="1";
$direcciones = dameDirecciones($ids);

include("../../config/config.php");

/*
foreach ($denuncias as $denuncia) {
	
	$motivos = dameNombreMotivos($denuncia['ID_DENUNCIA']);
	var_dump($motivos);
	//$denuncia->__SET('motivos', $motivos);
}

echo "<pre>";
print_r($denuncias);
echo "</pre>";

echo "<pre>";
print_r($direcciones);
echo "</pre>";

SELECT * FROM PEARREDONDO.FISC_DENUNCIA_JURIDICA;
*/

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<link rel="stylesheet" href="<?=$base_url;?>public_html/vendor/DataTables/media/css/jquery.dataTables.css">	
	<link rel="stylesheet" href="<?=$base_url;?>public_html/vendor/chosen/chosen.min.css">
	<style>
		#listadoDenuncias_length label, #listadoDenuncias_filter label{
			color: #555;
			font-weight: normal;
			font-size: 0.7em;
		}
		#listadoDenuncias_length select, #listadoDenuncias_filter input{
			color:#555;
			font-weight: normal;
			border:1px solid gray;
			font-size: 0.7em;
		}

		#tlistadoDenuncias_length label, #tlistadoDenuncias_filter label{
			color: #555;
			font-weight: normal;			
		}
		#tlistadoDenuncias_length select, #tlistadoDenuncias_filter input{
			color:#555;
			font-weight: normal;
			border:1px solid gray;			
		}

		.thead_list_den{
			font-size: 0.7em;
			font-weight: bold;
		}

		.tbody_list_den{
			font-size: 0.7em;
		}
		table tr{
			cursor:pointer;
		}

		.dataTables_paginate{
			font-size: 0.7em;			
		}

		.dataTables_info{
			font-size: 0.7em; 
		}
	</style>
</head>
<body>
	<div style="width:100%;background:white;min-height:600px;padding:25px;margin-bottom:75px;"><!--Content-->
		<div style="font-size:1.1em;color:#333;background:#3B5998;padding:5px;color:white;margin-bottom:12px;"><div style="width:50px;border:1px solid white;float:left;cursor:pointer;"><input type="checkbox" id="sel_all_denuncias"> <span class="glyphicon glyphicon-ok" style="color:white;font-size:0.7em;"></span></div>Quejas y/o Reclamos</div>
		<form action="../mod_denuncias/Controllers/Controller_Queja_Correo.php" method="post" id="form_quejas">
			<input type="hidden" name="asignar" value="asignar">
			<table class="table table-hover" id="listadoDenuncias">
				<thead class="thead_list_den">
					<tr>
						<th>Elegir</th>
						<th >N° Queja y/o Reclamo</th>
						<th>Denunciante</th>
						<th>Fecha</th>
						<th style="text-align:left">Motivo</th>
					</tr>
				</thead>	
				
				<tbody class="tbody_list_den">

					<?php if(empty($quejas)){echo "";} else {foreach ($quejas as $den) { ?>
					<tr>
						<td><input type="checkbox" class="check_denuncias" name="quejas_true[]" form="form_quejas" value="<?=$den['ID_DENUNCIA'];?>" style="cursor:pointer;"></td>
						<td><?=$den['ID_DENUNCIA'];?></td>
						<td style="width:100px;"><?=$den['ID_EMPRESA']; ?></td>
						<td><?=$den['FECHA_DENUNCIA'];?></td>

						<td>
							<ol style="margin-left:10px;text-align:left;">
								<?php
								if(dameQuejasDescripcion($den['ID_DENUNCIA']) != null){
									foreach ( dameQuejasDescripcion($den['ID_DENUNCIA']) as $motivos) {
										echo "<li>".$motivos['DESCRIPCION']."</li>";
									}

								}
								?>
							</ol>
						</td>
					</tr>
					<?php } }?>
				</tbody>

				<tfoot style="display:none;">
					<tr>
						<th>Elegir</th>
						<th>N° Denuncia</th>
						<th>Denunciante</th>
						<th>Fecha</th>
						<th>Motivo</th>
					</tr>
				</tfoot>
			</table>
			<div style="color:red;font-size=0.5em;" id="mensajedocs" >
				
			</div>	

			<div style="font-size:1.1em;color:#333;background:#3B5998;padding:5px;color:white;margin-top:12px;margin-bottom:12px;">Direcciones</div>
			<select class="chosen" id="chosen_dir" name="direcciones_destino[]" multiple="multiple" style="width:100% !important;">
				<?php  foreach ($direcciones as $dir) { ?>
				<option value="<?php echo $dir['ID_DIRECCION'];?>" style="text-align:left;"><?php echo $dir['NOMBRE'];?></option>
				<?php }?>
			</select>

			<div style="color:red;font-size=0.5em;" id="mensajedocs3" >
				
			</div>
			
			<div style="font-size:1.1em;color:#333;background:#3B5998;padding:5px;color:white;margin-top:12px;margin-bottom:12px;">Descripción de la asignación</div>
			<textarea id="descripcion" name="descripcion" class="form-control" style="margin-top:16px;resize:none;height:200px;overflow-y:scroll;">
				
			</textarea>
			<div style="color:red;font-size=0.5em;" id="mensajedocs2" >
				
			</div>
			<hr>
			<button type="button" class="btn btn-primary" id="enviar_form_asignacion" style="float:right">
				Asignar <span class="glyphicon glyphicon-share-alt"></span>
			</button>
			<div style="clear:both;"></div>			
		</form>
	</div><!--Content-->

	<!--*******************************************************************************************-->
	<div id="Cargando" style="display:none;position:fixed;z-index:100000;background:rgba(0,0,0,0.8);width:100%;height:100%;top:0;left:0;">
		<div id="error_msnced2" title="Mensaje" style="z-index:10;width:600px;hight:300px;margin:auto;margin-top:200px;background:rgba(255,255,255,0.8);" >
			<div id="titulo_msnced2" style="background:#234181 linear-gradient(#639ACA, #6095C4 20%, #3368A0 60%, #234181 100%) repeat scroll 0% 0%;color:white;padding:10px;margin:auto;font-size:1.4em; ">
				Por favor espere ...
				<div style="width:21px;float:right;cursor:pointer;display:none;" title="Cerrar mensaje" id="cerrar_msnced2">
					<span class="glyphicon glyphicon-remove"></span>
				</div>
			</div>                                     
			<div class="mensaje_loading" style="padding:25px 25px 25px 25px;font-size:1.3em;background-color: white;">
				<img src='<?=$base_url;?>public_html/imagenes/484.GIF' style='width:100px;height:auto;opacity:1;'>
			</div>
		</div>
	</div>
	<!--******************************************************************************************-->

	<script src="<?=$base_url;?>public_html/js/jquery-2.1.4.min.js"></script>

	<script type="text/javascript" src="<?=$base_url;?>public_html/vendor/DataTables/media/js/jquery.dataTables.js"></script>      
	<script type="text/javascript" src="<?=$base_url;?>public_html/vendor/chosen/chosen.jquery.js"></script>      
	<script>
		$(document).on("ready",function(){
			$("#listadoDenuncias").dataTable();
			$("#chosen_dir").chosen();

			$("#sel_all_denuncias").on("click",function(){
				$(".check_denuncias").each(function(index, elemento) {
					$(this).prop('checked', function(i, v) { return !v; });
				});
			});

			$(".check_denuncias").on("click",function(){
				prop('disabled', function(i, v) { return !v; });
			});

			$("#enviar_form_asignacion").on("click",function(){

				$("#mensajedocs").html('');
				$("#mensajedocs2").html('');
				$("#mensajedocs3").html('');

				var boo=false;

				var errores = "";

				if(($('input[name="quejas_true[]"]')).is(':checked')){
					boo=true;
				}else
				{
					if(boo==true) boo=false;
					errores = "Se debe seleccionar como mínimo una queja";
					$("#mensajedocs").html(errores);
				}
				
				if( $('#descripcion').val().length != 8)
				{
					if(boo==true) boo=true;
					//alert($('#descripcion').val().length);
				}else
				{
					if(boo==true) boo=false;
					errores = "Se debe ingresar una Descripción";
					$("#mensajedocs2").html(errores);
				}

				if($('#chosen_dir').val()!=null)
				{
					if(boo==true) boo=true;
				}else
				{
					if(boo==true) boo=false;
					errores = "Se debe seleccionar una Dirección";
					$("#mensajedocs3").html(errores);
				}

				if(boo==true)
				{
					boo=false;
					$("#Cargando").fadeIn();
					$("#form_quejas").submit();
					//alert("se envia");
				}


			});




});
</script>
</body>
</html>