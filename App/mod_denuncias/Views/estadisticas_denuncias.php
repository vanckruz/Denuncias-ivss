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
                    <td style="font-size:0.9em;">Inicio</td>
                    <td style="font-size:0.9em;">Fin</td>
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
                        <button type="button" style="float:right;margin-right: 30%; background-color: #B31C1C !important; " class="btn btn-primary"  id="limpiar_fechas">Limpiar</button>   
                    </td>
                </tr>
                
                <tr>
                    <td style="color:red;font-size:0.9em" id="msjfecha"></td>
                    <td style="color:red;font-size:0.9em" id="msjfechaFin"></td>
                </tr>          

            </table> 			
			
			<input type="hidden" name="generar" value="1">

			<hr>
			<button type="button" class="btn btn-primary" id="enviar_form_asignacion" style="float:right">
				Generar <span class="glyphicon glyphicon-share-alt"></span>
			</button>
			<div style="clear:both;"></div>	

			<hr>
			<div style="display:none;" id="divFoto">
				<img src="a" alt="Estadisticas" id="foto">
			</div>
		</form>

		<form action="../mod_denuncias/Controllers/ControllerEstadistica.php " method="post">
			<input type="hidden" name="q" id="q">
			<input type="hidden" name="i" id="i">
			<input type="hidden" name="f" id="f">
			<input type="hidden" name="n" id="n">
			<input type="hidden" name="c" id="c">

			<button type="submit" class="btn btn-primary" id="enviar_form_asignacion" style="float:right">
				Exportar a excel 
			</button>
		</form>
		<div style="clear:both;"></div>	
		
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

        $("#date1,#date2").datepicker({ dateFormat: 'mm-yy' });

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

		          var arrInicio = fechaInicio.split('-');
		          var arrFin = fechaFin.split('-');
				 
		          //comparo el aa
		          if(arrInicio[1] > arrFin[1])
		          {
		          	 $("#msjfechaFin").html("La fecha de inicio debe ser menor a la fecha fin");
		          	 return 0;
		          }else if(arrInicio[1] == arrFin[1])
		          {
		          	if(arrInicio[0]>arrFin[0])
		          	 {
		          	 	$("#msjfechaFin").html("La fecha de inicio debe ser menor a la fecha fin");
		          	 	return 0;
		          	 }
		          }

		          //resta de los meses para q sean 
		          var resta = arrFin[0] - arrInicio[0];
		          //alert(resta);

		          if( resta!=0 && resta!=2 && resta!=1 && resta!=5 && resta!=11 )
		          {
		          	 //alert("entre");
		          	 $("#msjfechaFin").html("No esta permitido el reporte");
		          	 return 0;
		          }
                }

                //envio en ajax

                $.ajax({
                url:$("#form_denuncias_asig").attr("action"),
                type:"post",
                dataType: "json",
                data:$("#form_denuncias_asig").serialize(),
                beforeSend:function(){
                   $("#Cargando").fadeIn();

               },
               success:function(resp){

                //console.log(resp.query);
                //console.log(resp.nombre);
               
                $('#divFoto').css("display","");
                $('#foto').attr("src", resp.nombre);

                $('#q').val(resp.query);
                $('#i').val(resp.fechaInicio);
                $('#f').val(resp.fechaFin);
                $('#n').val(resp.nombre);
                $('#c').val(resp.cont);

                $("#Cargando").fadeOut();
               
            	}
        		});

				//$("#Cargando").fadeIn();
				//$("#form_denuncias_asig").submit();
				//$("#Cargando").fadeOut();
			
			});


});
</script>
</body>
</html>
