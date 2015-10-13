<?php
require('../../../resources/orcl_conex.php'); 
require('../../../resources/select/funciones.php');
$denuncias   = dameDenunciasProceso();
$direcciones = dameDirecciones();

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
		<div style="font-size:1.1em;color:#333;background:#3B5998;padding:5px;color:white;margin-bottom:12px;"><div style="width:50px;border:1px solid white;float:left;cursor:pointer;"><input type="checkbox" id="sel_all_denuncias"> <span class="glyphicon glyphicon-ok" style="color:white;font-size:0.7em;"></span></div>Denuncias</div>
		<form action="../mod_denuncias/Controllers/Controller_Denuncia_Correo.php " method="post" id="form_denuncias">
			<input type="hidden" name="asignar" value="asignar">
			<table class="table table-hover" id="listadoDenuncias">
				<thead class="thead_list_den">
					<tr>
						<th>Elegir</th>
						<th>N° Denuncia</th>
						<th>Denunciante</th>
						<th>N° Patronal</th>
						<th>Motivo</th>
					</tr>
				</thead>	
				
				<tbody class="tbody_list_den">

					<?php if(empty($denuncias)){echo "";} else {foreach ($denuncias as $den) { ?>
					<tr>
						<td><input type="checkbox" class="check_denuncias" name="denuncia_true[]" form="form_denuncias" value="<?=$den['ID_DENUNCIA'];?>" style="cursor:pointer;"></td>
						<td><?=$den['ID_DENUNCIA'];?></td>
						<td><?=$den['ID_CIUDADANO'];?></td>
						<td style="width:100px;"><?=$den['ID_EMPRESA'];?></td>
						<td>
							<ol style="margin-left:10px;text-align:left;">
								<?php
								foreach ( dameNombreMotivos($den['ID_DENUNCIA']) as $motivos) {
									echo "<li>".$motivos['DESCRIPCION']."</li>";
								}?>
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
						<th>N° Patronal</th>
						<th>Motivo</th>
					</tr>
				</tfoot>
			</table>

			<div style="font-size:1.1em;color:#333;background:#3B5998;padding:5px;color:white;margin-top:12px;margin-bottom:12px;">Direcciones de envio</div>
			<select class="chosen" id="chosen_dir" name="direcciones_destino[]" multiple="multiple" style="width:800px !important;">
				<?php  foreach ($direcciones as $dir) { ?>
				<option value="<?php echo $dir['ID_DIRECCION'];?>" style="text-align:left;"><?php echo $dir['NOMBRE'];?></option>
				<?php }?>
			</select>
			
			<div style="font-size:1.1em;color:#333;background:#3B5998;padding:5px;color:white;margin-top:12px;margin-bottom:12px;">Descripción de la asignación</div>
			<textarea id="descripcion" name="descripcion" class="form-control" style="margin-top:16px;resize:none;height:200px;overflow-y:scroll;">
				
			</textarea>
			<hr>
			<button type="submit" class="btn btn-primary" id="enviar_form_asignacion" style="float:right;padding:7px;font-size:1.1em;">
				Asignar <span class="glyphicon glyphicon-share-alt"></span>
			</button>
			<div style="clear:both;"></div>			
		</form>
	</div><!--Content-->



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


		});
	</script>
</body>
</html>