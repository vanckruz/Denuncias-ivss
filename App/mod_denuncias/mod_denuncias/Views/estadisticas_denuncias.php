<?php
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
    <link rel="stylesheet" type="text/css" href="<?=$base_url;?>public_html/vendor/jquery-ui/css/smoothness/jquery-ui-1.9.2.custom.min.css">
</head>
<body>

	<div style="width:100%;background:white;min-height:600px;padding:25px;margin-bottom:75px;"><!--Content-->
		<div style="font-size:1.1em;color:#333;background:#3B5998;padding:5px;color:white;margin-bottom:12px;">
		Estadística</div>
		<form action="../mod_denuncias/Controllers/ControllerEstadistica.php " method="post" id="form_denuncias_asig">
			
			 <table class="table table-hover">
                <tr class="info">
                    <th colspan="3" style="text-align:center;font-size:0.9em;">Rango de Fecha</th>
                </tr>

                <tr>
                    <td style="font-size:0.9em;">Desde</td>
                    <td style="font-size:0.9em;">Hasta</td>
                    <td style="font-size:0.9em;">Limpiar Fechas</td>
                </tr>

                <tr>
                    <td>
                        <input name="fechaInicio" readonly="readonly" type="text" id="date1" style="height: 28px;border: solid 1px #AAAAAD;font-size: 13px;text-align: center;">
                    </td>

                    <td>
                        <input name="fechaFin" readonly="readonly" type="text" id="date2" style="height: 28px;border: solid 1px #AAAAAD;font-size: 13px;text-align: center;">
                    </td>

                    <td>
                        <button type="button" style="float:right;margin-right: 30%; " class="btn btn-primary"  id="limpiar_fechas">Ok</button>   
                    </td>
                </tr>
                
                <tr>
                    <td style="color:red;font-size:0.9em" id="msjfecha"></td>
                    <td style="color:red;font-size:0.9em" id="msjfechaFin"></td>
                </tr>          

            </table> 			
				
			

			<hr>
			<button type="button" class="btn btn-primary" id="enviar_form_asignacion" style="float:right">
				Generar <span class="glyphicon glyphicon-share-alt"></span>
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
    <script type="text/javascript" src="<?=$base_url;?>public_html/vendor/jquery-ui/js/jquery-ui.min.js"></script>
	<script>
		$(document).on("ready",function(){

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

        $("#date1,#date2").datepicker();

        $("#limpiar_fechas").on("click",function(e){
		    e.preventDefault();

		    $('#date1').prop("readonly", false);
		    $('#date1').val("");

		    $('#date2').prop("readonly", false);
		    $('#date2').val("");

		    $('#date1').prop("readonly", true);
		    $('#date2').prop("readonly", true);

		});

		$("#enviar_form_asignacion").on("click",function(){



				$("#msjfecha").html(" ");
				$("#msjfechaFin").html(" ");

				var boo=0;
				var errores = "";

				var fechaInicio = $("#date1").val();
           		var fechaFin = $("#date2").val();

           		//alert(fechaFin+fechaInicio);

           		if(fechaInicio=="" && fechaFin=="")
                {
                  //console.log("entreeee");
                  $("#msjfechaFin").html("Debe ingresar las fechas");
                  return 0; 
                }

           		if(fechaInicio!="")
	            {
	               if(fechaFin=="")
	               {
	                  //console.log("entreeee");
	                  $("#msjfechaFin").html("Debe ingresar la fecha fin");
	                  return 0; 
	              }
	            }

	          	if(fechaFin!="")
	          	{
	           		if(fechaInicio=="")
	           		{
	                  //console.log("entreeee");
	                  $("#msjfecha").html("Debe ingresar la fecha inicio");
	                  return 0; 
	              	}
	          	}

                if(fechaInicio!="" && fechaFin!="")
                {
                  	//console.log("entreeee");

		          var arrInicio = fechaInicio.split('/');
		          var arrFin = fechaFin.split('/');
				 
		          //comparo el aa
		          if(arrInicio[2] > arrFin[2])
		          {
		          	 $("#msjfechaFin").html("La fecha de inicio debe ser menor a la fecha fin");
		          	 return 0;
		          }else if(arrInicio[2] == arrFin[2])
		          {
		          	if(arrInicio[1]>arrFin[1])
		          	 {
		          	 	$("#msjfechaFin").html("La fecha de inicio debe ser menor a la fecha fin");
		          	 	return 0;
		          	 }else if(arrInicio[1] == arrFin[1])
		          	 {
		          	 	if(arrInicio[0] > arrFin[0])
		          	 	{
		          	 		$("#msjfechaFin").html("La fecha de inicio debe ser menor a la fecha fin");
		          	 		return 0;
		          	 	}
		          	 }
		          } 
                
                }

				$("#Cargando").fadeIn();
				$("#form_denuncias_asig").submit();
				$("#Cargando").fadeOut();
			
			});


});
</script>
</body>
</html>
