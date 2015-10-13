<?php

include("../../../resources/orcl_conex.php");
include("../../../resources/select/funciones.php");
$oficinas = dameOficinasFiscalizacion();
	/*echo "<pre>";
	print_r($oficinas);
	echo "</pre>";*/
	?>
	<!DOCTYPE html>
	<html>
	<script type="text/javascript" src="../../public_html/js/jquery-2.1.4.min"></script>
	<link rel="stylesheet" href="../../public_html/vendor/DataTables/media/css/jquery.dataTables.css">
	<script type="text/javascript" src="../../public_html/vendor/DataTables/media/js/jquery.dataTables.js"></script>      
	<script type="text/javascript" src="../../public_html/vendor/angular.min.js"></script>

	<style type="text/css" media="screen">
		html,body{
			height:100%;
			width:100%;
		}
		#contenedor{
			width: 100%;
			height: 100%;
			background:white;
			padding: 25px;
		}
		#Tabla_oficinas_length label, #Tabla_oficinas_filter label{
			color: black;
			font-weight: normal;
		}
		#Tabla_oficinas_length select, #Tabla_oficinas_filter input{
			color:black;
			border:1px solid gray;
		}

		table tr{
			cursor:pointer;
		}

		#tabla_edit_oficina td,#tabla_edit_oficina th{
			text-align: left;
		}

	</style>

	<body>

		<?php /*<div style="width:100%;padding:21px;font-size:1.5em;color:white;text-align:center;background:#234181 linear-gradient(#639ACA, #6095C4 20%, #3368A0 60%, #234181 100%) repeat scroll 0% 0%;">
			Listado de Oficinas
		</div>*/ ?>
		<div id="contenedor" style="margin-bottom:150px;">
			<table id="Tabla_oficinas" class="table table-hover" style="font-size:0.8em;" >
				<thead>
					<tr>
						<td>Nombre</td>
						<td>Jefe</td>
						<td>Dirección</td>
						<td>Editar</td>
						<td>Eliminar</td>
					</tr>
				</thead>

				<tbody>
					<?php if(empty($oficinas)){echo "";}else {foreach ($oficinas as $key) { ?>
					<tr>
						<td><?php echo $key["NOMBRE"]; ?></td>
						<td><?php echo dameNombreJefe($key["ID_JEFE"]); ?></td>
						<td><?php echo $key["DIRECCION"]; ?></td>
						<?php 
						$jefe= dameJefeOficina($key["ID_JEFE"]);												
						?>
						<td><button type="button" class="btn btn-primary editar_oficinas" data-nombre="<?php echo $key["NOMBRE"]; ?>" data-siglas="<?php echo $key["SIGLAS"]; ?>" data-region="<?php switch($key["ID_REGION"]){case "CEN": echo "Central"; break;case "OCC": echo "Occidental"; break;case "OR": echo "Oriente"; break;} ?>" data-estado="<?php echo $key["ID_ESTADO"]; ?>" data-direccion="<?php echo str_replace(" ","-",$key['DIRECCION']); ?>" data-cedulajefe="<?php echo $jefe[0]["ID_JEFE"]; ?>" data-tratamientoproto="<?php echo $jefe[0]["TRATAMIENTO_PROTOCOLAR"]; ?>" data-prinombrejefe="<?php echo $jefe[0]["PRIMER_NOMBRE"]; ?>" data-segnombrejefe="<?php echo $jefe[0]["SEGUNDO_NOMBRE"]; ?>" data-priapejefe="<?php echo $jefe[0]["PRIMER_APELLIDO"]; ?>" data-segapejefe="<?php echo $jefe[0]["SEGUNDO_APELLIDO"]; ?>" data-resolucionjefe="<?php echo $jefe[0]["NUMERO_RESOLUCION"]; ?>" data-fechareljefe="<?php echo $jefe[0]["FECHA_RESOLUCION"]; ?>"><span class="glyphicon glyphicon-pencil"></span></button></td>
						<td><button type="button" class="btn btn-danger eliminar_oficinas" data-idoficina="<?php echo $key["ID_OFICINA"]; ?>"><span class="glyphicon glyphicon-remove"></span></button></td>
					</tr>

					<?php } }?>
				</tbody>

				<tfoot style="display:none;">
					<tr>
						<td>Nombre</td>
						<td>Jefe</td>
						<td>Dirección</td>
						<td>Editar</td>
						<td>Eliminar</td>
					</tr>
				</tfoot>
			</table>
		</div>

		<!--Editar oficina-->
		<div id="ventana_editar_oficina" style="display:none;position:fixed;top:0;left:0;z-index:10;width:100%;height:100%;background:rgba(0,0,0,0.5);color:black;font-size:0.8em !important;">
			<div style="background:#3B5998;color:white;font-size:1.5em;color:white;padding:12px;">
				Editar esta oficina
			</div>
			<form action="Controllers/controller_registro.php" method="post" id="form_oficinas">
				<div class="container" style="margin-top:25px;background:rgba(241,241,241,0.9);padding:25px;">
					<table class="table table-hover" id="tabla_edit_oficina">
						<thead>

						</thead>
						<input type="hidden" name="option_editar" value="option_editar">
						<tbody>
							<tr>
								<th>Nombre Oficina:</th>
								<th>Siglas Oficina:</th>
								<th>Dirección</th>
								<th>Cedula Jefe</th>
							</tr>		

							<tr>
								<td>
									<input type="text" class="form-control" id="nombre_oficina_adm" name="nombre_oficina_adm" form="form_oficinas">
								</td>

								<td>
									<input type="text" class="form-control" id="siglas_oficina_adm" name="siglas_oficina_adm" form="form_oficinas">
								</td>

								<td>
									<?php /* ?>
									<select class="form-control" style="cursor:pointer;" id="region" name="region" form="form_oficinas">	
										<option value="">Seleccione</option>
										<option value="CEN">Central</option>
										<option value="OCC">Occidental</option>
										<option value="OR">Oriental</option>
									</select>
									<?php */ ?>
									<input type="text" class="form-control" id="direccion" name="direccion" form="form_oficinas">
								</td>

								<td>
									<?php /* ?>
									<select type="text" class="form-control" style="cursor:pointer;" id="estados_region" name="estados_region" form="form_oficinas">	
										<option value="" selected="selected">Seleccione</option>
									</select>	
									<?php */ ?>						
									<input type="text" class="form-control" id="id_ciu" name="id_ciu" form="form_oficinas">
								</td>
							</tr>

							<tr>							
								<th>Tratamiento Protocolario</th>
								<th>Primer Nombre</th>
								<th>Segundo Nombre</th>
								<th> Primer apellido </th>
							</tr>

							<tr>

								<td>
									<select id="tratamiento_protocolario" class="form-control" name="tratamiento_protocolario" form="form_oficinas">
										<option value="Doctor">Doctor(a)</option>
										<option value="Magister">Magister</option>
										<option value="Ingeniero">Ingeniero</option>
										<option value="Licenciado">Licenciado</option>										
										<option value="Abogado">Abogado</option>																			
										<option value="TSU">TSU</option>										
									</select>
								</td>

								<td>
									<input type="text" class="form-control" id="prinom" name="prinom" form="form_oficinas">
								</td>

								<td>
									<input type="text" class="form-control" id="segnom" name="segnom" form="form_oficinas">			
								</td>
								<td>
									<input type="text" class="form-control" id="priape" name="priape" form="form_oficinas">
								</td>

							</tr>

							<tr>
								<th> Segundo Apellido </th>
								<th> Resolución </th>
								<th> Fecha Resolución </th>
							</tr>

							<tr>


								<td>
									<input type="text" class="form-control" id="segape" name="segape" form="form_oficinas">
								</td>

								<td>
									<input type="text" class="form-control" id="resolucion" name="resolucion" form="form_oficinas">
								</td>

								<td>
									<input type="text" class="form-control" id="fecha_resolucion" name="fecha_resolucion" form="form_oficinas">
								</td>

								<td>
									<div style="width:200px;float:right;overflow:hidden;">
										<button type="submit" class="btn btn-primary" id="enviar_formulario" style="float:left;">
											<span class=" glyphicon glyphicon-floppy-disk"></span> Guardar
										</button>

										<button id="cancelar_edit" class="btn btn-danger">Cancelar</button>	
									</div>
								</td>
							</tr>
						</tbody>
					</table>	

				</div>
			</form>	
		</div><!--Ventana Editar-->

		<div id="ventana_eliminar_oficina" style="display:none;position:fixed;top:0;left:0;z-index:10;width:100%;height:100%;background:rgba(0,0,0,0.5);color:white;">
			<div style="background:#3B5998;color:white;font-size:1.5em;color:white;padding:12px;">
				Eliminar esta oficina
			</div>
			<div style="width:50%;height:200px;margin:auto;margin-top:50px;background:rgba(241,241,241,0.9);padding-top:10px;">
				<form action="Controllers/controller_registro.php" method="post" id="form_oficinas_eliminar">
					<input type="hidden" name="option_eliminar" value="option_eliminar">
					<input type="hidden" name="id_oficina" id="id_oficina_eliminar" >
				</form>
				<p style="color:black;">¿Esta seguro de eliminar esta oficina?</p>				
				<hr>
				<button class="btn btn-danger" id="del_oficine">Eliminar</button>
				<button class="btn btn-default" id="cancel_oficina">Cancelar</button>
			</div>
		</div>
		<script>
			$(document).on("ready",function(){
				$("#Tabla_oficinas").dataTable();

				$(".editar_oficinas").on("click",function(){
					var $this = $(this);
					$("#ventana_editar_oficina").fadeIn();

					$("#nombre_oficina_adm").val($this.attr("data-nombre"));
					$("#siglas_oficina_adm").val($this.attr("data-siglas"));
					$("#direccion").val($this.attr("data-direccion").replace(/-/g, " "));
					$("#id_ciu").val($this.attr("data-cedulajefe"));
					$("#prinom").val($this.attr("data-prinombrejefe"));
					$("#segnom").val($this.attr("data-segnombrejefe"));
					$("#priape").val($this.attr("data-priapejefe"));
					$("#segape").val($this.attr("data-segapejefe"));
					$("#resolucion").val($this.attr("data-resolucionjefe"));
					$("#fecha_resolucion").val($this.attr("data-fechareljefe"));
				});

				$("#cancelar_edit").on("click",function(e){
					e.preventDefault();
					$("#ventana_editar_oficina").fadeOut();
				});

				$(".eliminar_oficinas").on("click",function(){
					$this = $(this);					

					$("#form_oficinas_eliminar #id_oficina_eliminar").val($this.attr("data-idoficina"));

					$("#ventana_eliminar_oficina").fadeIn();

					$("#del_oficine").on("click",function(){
						$("#form_oficinas_eliminar").submit();
					});

					$("#cancel_oficina").on("click",function(){
						$("#ventana_eliminar_oficina").fadeOut();display:none;
					});

				});				
			});
		</script>
	</body>
	</html>