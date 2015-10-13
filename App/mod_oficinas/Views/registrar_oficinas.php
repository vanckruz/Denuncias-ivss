<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Registar Oficinas</title>
</head>
<style>
	html,body{
		width:100%;
		height:100%;
	}

	/* style icon */
	.inner-addon .glyphicon {
		position: absolute !important;
		padding: 10px !important;
		pointer-events: none !important;
	}

	/* align icon */
	.left-addon .glyphicon  { left:  0px !important;}
	.right-addon .glyphicon { right: 0px !important;}

	/* add padding  */
	.left-addon input  { padding-left:  34px !important;}
	.right-addon input { padding-right: ;}

	input{
		border-radius:0px !important;
	}

	.form-control{
		width:100% !important;
	}

	label.error{
		color:red;
	}

	.ui-datepicker-header .ui-widget-header .ui-helper-clearfix .ui-corner-all{
		background:#3B5998 !important;
	}
</style>
<body>
	<!--*******************************************************************************************-->
	<div id="mensajerror1" style="display:none;position:fixed;z-index:100000;background:rgba(0,0,0,0.8);width:100%;height:100%;top:0;left:0;">
		<div id="error1" title="Mensaje" style="z-index:10;width:600px;hight:300px;margin:auto;margin-top:200px;background:rgba(255,255,255,0.8);" >
			<div id="titulo_error1" style="background:#3B5998;color:white;padding:10px;margin:auto;font-size:1.4em; ">
				Mensaje
				<div style="width:21px;float:right;cursor:pointer;" title="Cerrar mensaje" id="cerrar_error1">
					<span class="glyphicon glyphicon-remove"></span>
				</div>
			</div>                                     
			<div class="mensaje" style="padding:25px 25px 25px 25px;font-size:1.3em;">
				¡ Por favor ingrese un valor válido en el campo de cédula !
			</div>
		</div>
	</div>
	<!--*******************************************************************************************-->

	<div id="mensajerrorcedula" style="display:none;position:fixed;z-index:100000;background:rgba(0,0,0,0.8);width:100%;height:100%;top:0;left:0;">
		<div id="error1" title="Mensaje" style="z-index: 10000;width:600px;hight:300px;margin:auto;margin-top:100px;background:rgba(255,255,255,0.8);" >
			<div id="titulo_errorced" style="background:#3B5998;color:white;padding:10px;margin:auto;font-size:1.4em; ">
				Mensaje
				<div style="width:21px;float:right;cursor:pointer;" title="Cerrar mensaje" id="cerrar_errorcedula">
					<span class="glyphicon glyphicon-remove"></span>
				</div>
			</div>                                     
			<div class="mensaje" style="padding:25px 25px 25px 25px;font-size:1.2em;color:red;">
				¡ La cédula ingresada no esta registrada !
			</div>
		</div>
	</div>

	<!--*******************************************************************************************-->
	<div id="mensajeCargandoCedula1" style="display:none;position:fixed;z-index:100000;background:rgba(0,0,0,0.8);width:100%;height:100%;top:0;left:0;">
		<div id="error_msnced" title="Mensaje" style="z-index:10;width:600px;hight:300px;margin:auto;margin-top:200px;background:rgba(255,255,255,0.8);" >
			<div id="titulo_msnced" style="background:#3B5998;color:white;padding:10px;margin:auto;font-size:1.4em; ">
				Por favor espere ...
				<div style="width:21px;float:right;cursor:pointer;display:none;" title="Cerrar mensaje" id="cerrar_msnced">
					<span class="glyphicon glyphicon-remove"></span>
				</div>
			</div>                                     
			<div class="mensaje_loading" style="padding:25px 25px 25px 25px;font-size:1.3em;">
				<img src='http://desarrollofiscalizacion.ivss.int/public_html/imagenes/Cargando2.gif' style='width:150px;height:auto;opacity:1;'>
			</div>
		</div>
	</div>
	<!--*******************************************************************************************-->

	<!--*******************************************************************************************-->
	<div id="mensajeCargandoCedula2" style="display:none;position:fixed;z-index:100000;background:rgba(0,0,0,0.8);width:100%;height:100%;top:0;left:0;">
		<div id="error_msnced2" title="Mensaje" style="z-index:10;width:600px;hight:300px;margin:auto;margin-top:200px;background:rgba(255,255,255,0.8);" >
			<div id="titulo_msnced2" style="background:#234181 linear-gradient(#639ACA, #6095C4 20%, #3368A0 60%, #234181 100%) repeat scroll 0% 0%;color:white;padding:10px;margin:auto;font-size:1.4em; ">
				Por favor espere ...
				<div style="width:21px;float:right;cursor:pointer;display:none;" title="Cerrar mensaje" id="cerrar_msnced2">
					<span class="glyphicon glyphicon-remove"></span>
				</div>
			</div>                                     
			<div class="mensaje_loading" style="padding:25px 25px 25px 25px;font-size:1.3em;">
				<img src='http://desarrollofiscalizacion.ivss.int/public_html/imagenes/Cargando2.gif' style='width:150px;height:auto;opacity:1;'>
			</div>
		</div>
	</div>
	<!--******************************************************************************************-->

	<!--*******************************************************************************************-->
	<div id="mensajeguardando_oficina" style="display:none;position:fixed;z-index:100000;background:rgba(0,0,0,0.8);width:100%;height:100%;top:0;left:0;">
		<div id="error_msnced3" title="Mensaje" style="z-index:10;width:600px;hight:300px;margin:auto;margin-top:200px;background:rgba(255,255,255,0.8);" >
			<div id="titulo_msnced3" style="background:#234181 linear-gradient(#639ACA, #6095C4 20%, #3368A0 60%, #234181 100%) repeat scroll 0% 0%;color:white;padding:10px;margin:auto;font-size:1.4em; ">
				Guardando, Por favor espere ...
				<div style="width:21px;float:right;cursor:pointer;display:none;" title="Cerrar mensaje" id="cerrar_msnced3">
					<span class="glyphicon glyphicon-remove"></span>
				</div>
			</div>                                     
			<div class="mensaje_loading" style="padding:25px 25px 25px 25px;font-size:1.3em;">
				<img src='http://desarrollofiscalizacion.ivss.int/public_html/imagenes/Cargando2.gif' style='width:150px;height:auto;opacity:1;'>
			</div>
		</div>
	</div>
	<!--******************************************************************************************-->

	<!--*******************************************************************************************-->
	<div id="mensajeguardando_funcionarios" style="display:none;position:fixed;z-index:100000;background:rgba(0,0,0,0.8);width:100%;height:100%;top:0;left:0;">
		<div id="error_msnced4" title="Mensaje" style="z-index:10;width:600px;hight:300px;margin:auto;margin-top:200px;background:rgba(255,255,255,0.8);" >
			<div id="titulo_msnced4" style="background:3B5998;color:white;padding:10px;margin:auto;font-size:1.4em; ">
				Guardando, Por favor espere ...
				<div style="width:21px;float:right;cursor:pointer;display:none;" title="Cerrar mensaje" id="cerrar_msnced4">
					<span class="glyphicon glyphicon-remove"></span>
				</div>
			</div>                                     
			<div class="mensaje_loading" style="padding:25px 25px 25px 25px;font-size:1.3em;">
				<img src='http://desarrollofiscalizacion.ivss.int/public_html/imagenes/Cargando2.gif' style='width:150px;height:auto;opacity:1;'>
			</div>
		</div>
	</div>
	<!--******************************************************************************************-->

	<div style="width:100%;height:auto;background:linear-gradient(rgba(255, 255, 255, 0.21),#dde9f4);margin-bottom:100px;">
	<?php /* 
	<div style="width:100%;color:white;background:#234181 linear-gradient(#639ACA, #6095C4 20%, #3368A0 60%, #234181 100%) repeat scroll 0% 0%;padding:12px;">
		<h1><span class=" glyphicon glyphicon-floppy-disk"></span> Registrar</h1>			
	</div> */ ?>

	<div class="" style="margin-top:25px;">
		<div class="row">		
			<div class="col-xs-12">

				<ul class="nav nav-tabs" role="tablist">
					<li role="presentation" class="active" ><a href="#oficina_administrativa" role="tab" data-toggle="tab" style="color:blue;"> Oficina administrativa</a></li>
					<?php /*<li role="presentation" ><a href="#funcionarios" role="tab" data-toggle="tab" style="color:blue;"> Funcionarios</a></li>*/?>
				</ul>

				<div class="tab-content" style="padding:50px;margin-bottom:100px;font-size:0.7em !important;">
					<div class="tab-pane active" id="oficina_administrativa" style="padding:25px;">
						<div class="">
							<div class="row">
								<!---------------------------------------------------------------->
								<form action="Controllers/controller_registro.php" method="post" id="form_oficinas">
									<div class="col-xs-4">
										<input type="hidden" name="option_agregar" value="option_agregar">
										<p class="etiqueta">Nombre Oficina:</p><span class="requerido">*</span> <input type="text" class="form-control" id="nombre_oficina_adm" name="nombre_oficina_adm" form="form_oficinas" maxlength="200">	
									</div>

									<div class="col-xs-4">
										<p class="etiqueta">Siglas Oficina:</p><span class="requerido">*</span><input type="text" class="form-control" id="siglas_oficina_adm" name="siglas_oficina_adm" form="form_oficinas" maxlength="200">	
									</div>

									<div class="col-xs-4">
										<p class="etiqueta">Región:</p><span class="requerido">*</span>
										<select class="form-control" style="cursor:pointer;" id="region" name="region" form="form_oficinas">	
											<option value="">Seleccione</option>
											<option value="CEN">Central</option>
											<option value="OCC">Occidental</option>
											<option value="OR">Oriental</option>
										</select>
									</div>
								</div>

								<div class="row">
									<div class="col-xs-4">
										<p class="etiqueta">Estado:</p><span class="requerido">*</span> 
										<select type="text" class="form-control" style="cursor:pointer;" id="estados_region" name="estados_region" form="form_oficinas">	
											<option value="" selected="selected">Seleccione</option>
										</select>							
									</div>

									<div class="col-xs-4">
										<p class="etiqueta">Dirección:</p> <span class="requerido">*</span><input type="text" class="form-control" id="direccion" name="direccion" form="form_oficinas" required="required" maxlength="200">								
									</div>

									<div class="col-xs-1">
										<select id="nacionalidad" style="margin-top:27px;background:white;cursor:pointer;width:60px !important;" name="nacionalidad" form="form_oficinas">
											<option value="V">V</option>
											<option value="E">E</option>
											<option value="T">T</option>
										</select>
									</div>

									<div class="col-xs-3">
										<p class="etiqueta">Cédula Jefe Oficina:</p> <span class="requerido">*</span><input type="text" class="form-control" id="cedula_jefe_oficina"  name="cedula_jefe_oficina" maxlength="8" form="form_oficinas" rel="popover" data-placement="left" data-original-title="Nota" data-content="Ingrese número de Cédula y presione la tecla Enter" data-trigger="focus" maxlength="8">								
									</div>

								</div>

								<div style="height:10px;"></div>
								<!--Formulario de jefe de oficina en caso de que no exista-->
								<div class="row" id="registro_jefe" style="display:none;">
									<div class="col-xs-12">
										<div class="alert alert-info" style="padding:16px;overflow:hidden;border-radius:0px;">
											<div class="titulo_jefe_oficina">
												<p style="font-weight:bold;text-align:center;">Jefe de esta oficina</p>
											</div>
											<hr>

											<div class="col-xs-6">
												<p style="font-weight:bold;">Cedula:</p> <input type="text" class="form-control" id="id_ciu" name="id_ciu" form="form_oficinas">								
											</div>

											<div class="col-xs-6">
												<p style="font-weight:bold;">Tratamiento protocolario:</p> 
												<select id="tratamiento_protocolario" class="form-control" name="tratamiento_protocolario" form="form_oficinas">
													<option value="Doctor">Doctor(a)</option>
													<option value="Magister">Magister</option>
													<option value="Ingeniero">Ingeniero</option>
													<option value="Licenciado">Licenciado</option>										
													<option value="Abogado">Abogado</option>																			
													<option value="TSU">TSU</option>										
												</select>
											</div>

											<div class="col-xs-6">
												<p style="font-weight:bold;">Primer Nombre:</p> <input type="text" class="form-control" id="prinom" name="prinom" form="form_oficinas">								
											</div>

											<div class="col-xs-6">
												<p style="font-weight:bold;">Segundo Nombre:</p> <input type="text" class="form-control" id="segnom" name="segnom" form="form_oficinas">								
											</div>

											<div class="col-xs-6">
												<p style="font-weight:bold;">Primer Apellido:</p> <input type="text" class="form-control" id="priape" name="priape" form="form_oficinas">								
											</div>

											<div class="col-xs-6">
												<p style="font-weight:bold;">Segundo apellido:</p> <input type="text" class="form-control" id="segape" name="segape" form="form_oficinas">								
											</div>

											<div class="col-xs-6">
												<p style="font-weight:bold;">Resolución:</p> <input type="text" class="form-control" id="resolucion" name="resolucion" form="form_oficinas" required maxlength="30">								
											</div>

											<div class="col-xs-6">
												<p style="font-weight:bold;">Fecha Resolución:</p> <input type="text" class="form-control" id="fecha_resolucion" name="fecha_resolucion" form="form_oficinas" readonly="readonly">								
											</div>

										</div><!--Alert azul-->
									</div><!--Col-xs-12-->
									<button type="submit" class="btn btn-primary" id="enviar_formulario" style="float:right;">
										<span class=" glyphicon glyphicon-floppy-disk"></span> Guardar
									</button>
								</form>
								<div style="overflow:hidden;"></div>
							</div><!--Row-->

							<!--Formulario de jefe de oficina en caso de que no exista-->
						</div>


					</div><!---Fin tab pane 1-->

					<!--Segundo tab pane-->
					<div class="tab-pane" id="funcionarios" style="padding:25px;">
						<div class="row">
							<div class="col-xs-4">
								<form action="Controllers/controller_registro_funcionario.php" method="post" id="form_funcionarios">
									<input type="hidden" name="option_agregar" value="option_agregar">
									<p style="font-weight:bold;">Región:</p>
									<select class="form-control" style="cursor:pointer;" id="region_ofc_funcionario" name="region_ofc_funcionario" form="form_funcionarios">	
										<option>Seleccione</option>
										<option value="CEN">Central</option>
										<option value="OCC">Occidental</option>
										<option value="OR">Oriental</option>				
									</select>
								</div>

								<div class="col-xs-4">
									<p style="font-weight:bold;">Estado:</p>
									<select class="form-control" style="cursor:pointer" id="Estado_ofc_funcionario" name="Estado_ofc_funcionario" form="form_funcionarios">
										<option value="">Seleccione Estado</option>
									</select>
								</div>

								<div class="col-xs-4">
									<p style="font-weight:bold;">Oficina:</p>
									<select class="form-control" style="cursor:pointer" id="oficina_funcionario" name="oficina_funcionario" form="form_funcionarios">

									</select>
								</div>
							</div>

							<div class="row">
								<div class="col-xs-1">
									<select id="nacionalidad_funcionario" style="border-radius:0px;margin-top:30px;background:white;width:60px !important;cursor:pointer;" name="nacionalidad_funcionario" form="form_funcionarios">
										<option value="V">V</option>
										<option value="E">E</option>
										<option value="T">T</option>
									</select>
								</div>

								<div class="col-xs-3">
									<p style="font-weight:bold;">Cedula:</p> <input type="text" class="form-control" id="cedula_funcionario" name="cedula_funcionario" form="form_funcionarios">								
								</div>

								<div class="col-xs-4">
									<p style="font-weight:bold;">Primer Nombre:</p> <input type="text" class="form-control" id="nombre_funcionario" name="nombre_funcionario" form="form_funcionarios">								
								</div>

								<div class="col-xs-4">
									<p style="font-weight:bold;">Segundo Nombre:</p> <input type="text" class="form-control" id="nombre2_funcionario" name="nombre2_funcionario" form="form_funcionarios">								
								</div>
							</div>

							<div class="row">
								<div class="col-xs-4">
									<p style="font-weight:bold;">Primer Apellido:</p> <input type="text" class="form-control" id="apellido_funcionario" name="apellido_funcionario" form="form_funcionarios">								
								</div>

								<div class="col-xs-4">
									<p style="font-weight:bold;">Segundo Apellido:</p> <input type="text" class="form-control" id="apellido2_funcionario" name="apellido2_funcionario" form="form_funcionarios">								
								</div>

								<div class="col-xs-4">
									<p style="font-weight:bold;">Cargo:</p> <input type="text" class="form-control" id="cargo_funcionario" name="cargo_funcionario" form="form_funcionarios">								
								</div>
							</div>

							<div class="row">
								<div class="col-xs-12" style="margin-top:16px;">
									<button type="submit" class="btn btn-primary" id="enviar_formulario2" style="float:right;">
										<span class=" glyphicon glyphicon-floppy-disk"></span> Guardar
									</button>	
								</div>
							</div>
						</form>	

					</div>
					<!--Segundo tab pane-->			
				</div>

			</div><!--Col-xs-5-->
		</div><!--Row-->
	</div><!--Container-->

</div>	
<script type="text/javascript" src="../../public_html/js/jquery-2.1.4.min"></script>
<script type="text/javascript" src="../../../public_html/vendor/jquery-ui/jquery-ui.min.js"></script>
<script type="text/javascript" src="../../public_html/vendor/jQueryMask/jquery.mask.js"></script>
<script type="text/javascript" src="../../public_html/vendor/jQueryValidation/dist/jquery.validate.js"></script>
<script type="text/javascript" src="../../public_html/js/bootstrap/js/bootstrap.min.js"></script>
<script>
	$(document).on("ready",function(){
		/*******************************************/
		$('#cedula_jefe_oficina').popover({ trigger: "focus" });
		/***********************************************/
		/*****************************************************************************************/
		$.datepicker.regional['es'] = {
			closeText: 'Cerrar',
			prevText: '<Ant',
			nextText: 'Sig>',
			currentText: 'Hoy',
			monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
			monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
			dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
			dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
			dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
			weekHeader: 'Sm',
			dateFormat: 'dd/mm/yy',
			firstDay: 1,
			isRTL: false,
			showMonthAfterYear: false,
			yearSuffix: ''
		};

		$.datepicker.setDefaults($.datepicker.regional['es']);

		$("#fecha_resolucion").datepicker({dateFormat: 'dd-mm-yy'});
		/*****************************************************************************************/
		jQuery.validator.addMethod("just_number", function(value,  element) {
			return this.optional(element) || /^\d+$/.test(value);
		}, "");
		$.validator.addMethod("regex",function(value,element,regexp){
			var re= new RegExp(regexp);
			return this.optional(element) || re.test(value);
		},"Solo caracteres alfanumericos");
		$.validator.addMethod("solonumeric",function(value,element,regexp){
			var res= new RegExp(regexp);
			return this.optional(element) || res.test(value);
		},"Escribir solo Nùmeros");

		$.validator.addMethod("sololetras",function(value,element,regexp){
			var res= new RegExp(regexp);
			return this.optional(element) || res.test(value);
		},"Escribir solo Letras");

		$("#form_oficinas").validate({
			rules: {
				nombre_oficina_adm: {
					required:true
				},
				siglas_oficina_adm: {
					required:true,
					sololetras:"^[A-Z a-z]*$"
				},
				region: {required:true},
				estados_region: {required:true},
				direccion: {required:true},
				resolucion: {required: true}
			},/*Rules*/
			messages: {
				nombre_oficina_adm: {required:"Este campo es requerido"},
				siglas_oficina_adm: {
					required:"Este campo es requerido",
					sololetras: "Este campo solo acepta letras"
				},
				region: {required:"Este campo es requerido"},
				estados_region: {required:"Este campo es requerido"},
				direccion: {required:"Este campo es requerido"},
				resolucion: {required:"Este campo es requerido"}
			}/*Messages*/
		});
		/***********************************************************************************/
		$("#region").on("change",function(){
			valor = $("#region").val();
			if(valor == "")
			{
				$("#estados_region").html('<option value="">Seleccione</option>');
			}
			else
			{
				$.ajax({
					dataType: "json",
					data: {"region":$("#region").val()},
					url:   '../../../resources/select/buscar.php',
					type:  'post',
					beforeSend: function(){
					},
					success: function(resp){
           //lo que se si el destino devuelve algo
           $("#estados_region").html(resp.html);
           //console.log(resp.html);                         
       },
       async:false
   });
			}
		});


		$("#region_ofc_funcionario").on("change",function(){
			$.ajax({
				dataType: "json",
				data: {"region":$("#region_ofc_funcionario").val()},
				url:   '../../../resources/select/buscar.php',
				type:  'post',
				beforeSend: function(){
				},
				success: function(resp){
           //lo que se si el destino devuelve algo
           $("#Estado_ofc_funcionario").html(resp.html);
           //console.log(resp.html);                         
       },
       async:false
   });
		});	

		$("#Estado_ofc_funcionario").on("change",function(){

			$.ajax({
				dataType: "json",
				data: {"primera_letra":$("#Estado_ofc_funcionario").val()},
				url:   '../../../resources/select/buscar.php',
				type:  'post',
				beforeSend: function(){

				},
				success: function(resp){
            //lo que se si el destino devuelve algo
            $("#oficina_funcionario").html(resp.html);
            //console.log(resp.html);                         
        },
        async:false
    });

		});

		/**************************************************************************************/
		$("#cedula_funcionario").on("blur" , function(e){


			if( $(this).val() == ""){
				$("#mensajerror1").slideDown('slow');
				$("#cerrar_error1").on("click",function(){
					$("#mensajerror1").slideUp('slow');
				});
			}else{
				/**********************************************/
				$.ajax({
					dataType: "json",
					data: {"nac_apo":$("#nacionalidad_funcionario").val(),"id_apo":$("#cedula_funcionario").val()},
					url:   '../../../resources/select/buscar.php',
					type:  'post',
					beforeSend: function(){
						$("#mensajeCargandoCedula2").fadeIn();
					},
					success: function(resp){
              //lo que se si el destino devuelve algo
              //$("#id_ciu").val(resp.id_ciudadano).attr("readonly","readonly");
              $("#nombre_funcionario").val(resp.prinom).attr("readonly","readonly");
              $("#nombre2_funcionario").val(resp.segnom).attr("readonly","readonly");                                      
              $("#apellido_funcionario").val(resp.priape).attr("readonly","readonly");                                      
              $("#apellido2_funcionario").val(resp.segape).attr("readonly","readonly");                                      
          }
      }).done(function(){  
      	$("#mensajeCargandoCedula2").fadeOut();         	
      });
      /****************************/
  }		


});
/**************************************************************************************/
/**************************************************************************************/
/**************************************************************************************/


/**************************************************************************************/
/**************************************************************************************/
/**************************************************************************************/

$("#cedula_jefe_oficina").keypress(function(e){
	keynum = window.event ? window.event.keyCode : e.which;
	if ((keynum == 8) || (keynum == 13))
		return true;
	return /\d/.test(String.fromCharCode(keynum));
});

$("#cedula_jefe_oficina").on("keypress" , function(e){
	
	if(e.keyCode == 13) {
		if( $(this).val() == ""){
			$("#mensajerror1").slideDown('slow');
			$("#cerrar_error1").on("click",function(){
				$("#mensajerror1").slideUp('slow');
			});
		}else{
			/**********************************************/
			$.ajax({
				dataType: "json",
				data: {"nac_apo":$("#nacionalidad").val(),"id_apo":$("#cedula_jefe_oficina").val()},
				url:   '../../../resources/select/buscar.php',
				type:  'post',
				beforeSend: function(){

              		//$("#mensaje_cargando").html("<img src='http://desarrollofiscalizacion.ivss.int/public_html/imagenes/Cargando2.gif' style='width:150px;height:auto;opacity:1;'>");
              		$("#mensajeCargandoCedula1").fadeIn();
              		/*$("#registro_jefe").hide();*/
              	},
              	success: function(resp){
              //lo que se si el destino devuelve algo

              if( resp.id_ciudadano != undefined ){
              	$("#mensajeCargandoCedula1").fadeOut(); 
              	$("#id_ciu").val(resp.id_ciudadano).attr("readonly","readonly");
              	$("#prinom").val(resp.prinom).attr("readonly","readonly");
              	$("#segnom").val(resp.segnom).attr("readonly","readonly");
              	$("#priape").val(resp.priape).attr("readonly","readonly");
              	$("#segape").val(resp.segape).attr("readonly","readonly");
              	$("html, body").animate({
              		scrollTop: $("#pie_pagina").offset().top
              	}, 2000);

            	//$("#mensaje_cargando").hide();          	
            	$("#registro_jefe").slideDown();
            	$("#resolucion").focus();
            }else{
            	
            	$("#mensajeCargandoCedula1").fadeOut(); 

            	$("#mensajerrorcedula").slideDown();

            	$("#cerrar_errorcedula").on("click",function(){

            		$("#mensajerrorcedula").slideUp();
            	});
            }


              //console.log(resp.html);                         
          }
      });
/****************************/
}		
}

});



/**************************************************************************************************************************/

$("#enviar_formulario").on("click",function(e){
	e.preventDefault();

//$("#mensajeguardando_oficina").slideDown();

$("#form_oficinas").submit();

	/*$.ajax({
		dataType: "json",
              data: {
              	"option_agregar":"option_agregar",
              	"nombre_oficina_adm":$("#nombre_oficina_adm").val(),
              	"siglas_oficina_adm":$("#siglas_oficina_adm").val(),
              	"region":$("#region").val(),
              	"estados_region":$("#estados_region").val(),
              	"direccion_oficina_amd":$("#direccion_oficina_amd").val(),
              	"id_ciu":$("#id_ciu").val(),
              	"tratamiento_protocolario":$("#tratamiento_protocolario").val(),
              	"prinom":$("#prinom").val(),
              	"segnom":$("#segnom").val(),
              	"priape":$("#priape").val(),
              	"segape":$("#segape").val(),
              	"resolucion":$("#resolucion").val(),
              	"fecha_resolucion":$("#fecha_resolucion").val(),
              },
              url:   'Controllers/controller_registro.php',
              type:  'post',
              beforeSend: function(){
              		$("#mensaje_cargando").html("<p style='font-weight:bold;'>Cargando...</p><img src='http://desarrollofiscalizacion.ivss.int/public_html/imagenes/484_azul.GIF' style='width:50px;height:auto;'>");
                },
              success: function(resp){
              	$("#mensajeguardando_oficina").fadeOut();
              	alert(resp);
              },
                error:  function(xhr,err){ 
                    alert("readyState: "+xhr.readyState+"\nstatus: "+xhr.status+"\n \n responseText: "+xhr.responseText);
                }
            }); */ 

});

$("#enviar_formulario2").on("click",function(){
	$("#form_funcionarios").submit();
});
/*
$("#enviar_formulario2").on("click",function(){

$("#mensajeguardando_funcionarios").slideDown();

	$.ajax({
		dataType: "json",
              data: {
              	"option_agregar":"option_agregar",
              	"region_ofc_funcionario":$("#region_ofc_funcionario").val(),
              	"Estado_ofc_funcionario":$("#Estado_ofc_funcionario").val(),
              	"oficina_funcionario":$("#oficina_funcionario").val(),
              	"nacionalidad_funcionario":$("#nacionalidad_funcionario").val(),
              	"cedula_funcionario":$("#cedula_funcionario").val(),
              	"nombre_funcionario":$("#nombre_funcionario").val(),
              	"nombre2_funcionario":$("#nombre2_funcionario").val(),
              	"apellido_funcionario":$("#apellido_funcionario").val(),
              	"apellido2_funcionario":$("#apellido2_funcionario").val(),
              	"cargo_funcionario":$("#cargo_funcionario").val(),
              },
              url:   '../../../App/mod_oficinas/Controllers/controller_registro.php',
              type:  'post',
              beforeSend: function(){
              		$("#mensaje_cargando").html("<p style='font-weight:bold;'>Cargando...</p><img src='http://desarrollofiscalizacion.ivss.int/public_html/imagenes/484_azul.GIF' style='width:50px;height:auto;'>");
                },
              success: function(resp){
              //lo que se si el destino devuelve algo
              alert(resp);
              }
            });
           

});
*/
/**Ready**/	
});
</script>
</body>
</html>