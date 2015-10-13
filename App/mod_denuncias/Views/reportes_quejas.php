<?php
require('../../../resources/orcl_conex.php'); 
require('../../../resources/select/funciones.php');
include("../../config/config.php");


$id_direcciones ='15,17,18';

$direcciones = dameDirecciones($id_direcciones);

$motivos = dameMotivosQuejasDescripcion();

$status= dameEstatusDenuncia();

$quejas = dameQuejasPanelReporte();    

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="<?=$base_url;?>public_html/vendor/DataTables/media/css/jquery.dataTables.css">
    <link rel="stylesheet" href="<?=$base_url;?>public_html/vendor/DataTables/extensions/TableTools/css/dataTables.tableTools.css">
    <link rel="stylesheet" type="text/css" href="<?=$base_url;?>public_html/vendor/DataTables/extensions/Buttons-1.0.0/css/buttons.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="<?=$base_url;?>public_html/vendor/jquery-ui/css/smoothness/jquery-ui-1.9.2.custom.min.css">
    <link rel="stylesheet" href="<?=$base_url;?>public_html/vendor/chosen/chosen.min.css">

</head>
<style type="text/css" media="screen">
    #tabla_juridica_length label, #tabla_juridica_filter label{
        color: #555;
        font-weight: normal;
    }
    #tabla_juridica_length select, #tabla_juridica_filter input{
        color:#555;
        font-weight: normal;
        border:1px solid gray;
    }

    #tabla_denuncias_length label, #tabla_denuncias_filter label{
        color: #555;
        font-weight: normal;
    }
    #tabla_denuncias_length select, #tabla_denuncias_filter input{
        color:#555;
        font-weight: normal;
        border:1px solid gray;
    }
    .dataTables_info{
        color:#555;
    }

    #tabla_denuncias{
        width:2500px !important;
    }

    #tabla_denuncias tr td{
        width: 100px;
    }

    .thead_list_den2{
        font-size: 0.7em;
    }

    .thead_list_den2 tr th{
        text-align: left;
    }

    table tr{
        cursor:pointer;
    }

    .font_body2{
        font-size: 0.6em;
    }

    .td_espacio_mas1{
        width: 250px !important;
        text-align: left; 
    }

    .td_espacio_mas2{
        width: 300px !important;
        text-align: left;
    }

    .td_espacio_mas3{
        width: 100px !important;
        text-align: left;
    }   

    .td_espacio_mas4{
        width: 300px !important;
        text-align: justify;
    }        

    .td_espacio_mas5{
        width: 100px !important;
        text-align: justify;
    }  
    
    .td_espacio_mas6{
        width: 300px !important;
        text-align: justify;
    }  

    .td_espacio_mas7{
        width: 100px !important;
        text-align:left;
    }  

    .td_espacio_mas8{
        width: 100px !important;
        text-align:left;
    }  

    .td_espacio_mas9{
        width: 400px !important;
        text-align:left;
    }  

    .motclass{
        width: 550px !important;
    }

    .divFiltros{
        margin-left: -2%!important;
    }

    .dataTables_filter{
        display: none;
    }
    .dataTables_info{
        /*display: none;*/
    }
    .dataTables_length{
        display: none;

    }
    .tbody_list_den{
        font-size: 1.1em;
    }
    #tabla_denuncias_length {
        display: none;
    }
    #tabla_denuncias_paginate{
        /*display: none;*/
    }
    #tabla_quejas_paginate{
        /*display: none;*/
    }

    @media screen and (min-width:760px) and (max-width: 1100px) {
        #tabla_reporte{
            width: 600px !important;
        }
    }

</style>

<body>
    <div id="panel_denuncias" style="width:100%;height:100%;padding:25px;background:white;margin-bottom:50px; overflow: hidden;">

      <div style="font-size:1.1em;color:#333;background:#3B5998;padding:5px;color:white;margin-top:12px;margin-bottom:12px;"><span class="glyphicon glyphicon-paste"></span> Reportes de Quejas y/o Reclamos</div>

      <form action="../mod_denuncias/Controllers/ControllerExcelQueja.php" method="POST" class="form-inline" id="form_reportes_quejas">

        <table class="table table-hover">
            <tr>
                <th style="text-align:left;font-size:0.9em;">Direcciones</th>
                <td>
                    <select class="chosen" id="chosen_dir" name="direcciones[]" multiple="multiple" style="width:500px !important;">
                        <?php  foreach ($direcciones as $dir) { ?>
                        <option value="<?php echo $dir['ID_DIRECCION'];?>" style="text-align:left;"><?php echo $dir['NOMBRE'];?></option>
                        <?php }?>
                    </select>
                </td>
            </tr>

            <tr>
                <th style="text-align:left;font-size:0.9em;">Motivos</th>
                <td>
                    <select class="chosen" id="chosen_est" name="motivos[]" multiple="multiple" style="width:500px !important;">
                        <?php  foreach ($motivos as $dir) { ?>
                        <option value="<?php echo $dir['ID_MOTIVO'];?>" style="text-align:left;"><?php echo $dir['DESCRIPCION'];?></option>
                        <?php }?>
                    </select>
                </td>
            </tr>

            <tr>
                <th style="text-align:left;font-size:0.9em;">Status</th>
                <td>
                    <select class="chosen" id="chosen_mot" name="status[]" multiple="multiple" style="width:500px !important;">
                        <?php  foreach ($status as $dir) { ?>
                        <option value="<?php echo $dir['ID_ESTATUS'];?>" style="text-align:left;"><?php echo $dir['DESCRIPCION'];?></option>
                        <?php }?>
                    </select>
                </td>
            </tr>

        </table>

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

            <tr>
                <td colspan="3">
                    <button type="submit" style="float:right;font-size:1em;padding:7px;" class="btn btn-primary" id="form_reportes_quejas_boton"><span class="glyphicon glyphicon-search"></span> Filtrar</button>   
                </td>
            </tr>
        </table> 

    </form>
    
    <br><br><br>
    <div style="white-space:pre;overflow:auto;width:800px;padding:10px;" id="tabla_reporte"> 
        <table id="tabla_quejas" class="table table-hover">
            <thead class="thead_list_den2">
                <tr>
                    <th>N° Queja y/o Reclamo</th>
                    <th>N° Patronal</th>
                    <th>Nombre Del Representante</th>
                    <th>Fecha</th>          
                    <th>Estatus</th>          
                    <?/*?><th>Motivos</th>      <?*/?>
                </tr>
            </thead>

            <tbody class="tbody_list_den">
                <?php if(empty($quejas)){echo "";}else {foreach ($quejas as $key) { ?>
                <tr class="font_body2" data-nacionalidad="" data-cedula="">    
                    <td class="td_espacio_mas1"><?php echo  $key["ID_DENUNCIA"]; ?></td>

                    <td class="td_espacio_mas2"><?php echo  $key["ID_EMPRESA"]; ?></td>
                    
                    <?php
                    $nombre = ""; 
                    if($nombre != NULL)
                    {
                        $nombre = dameNombreDenuncianteQueja($key['ID_EMPRESA']);
                        foreach ($nombre as $ke2 => $nom){
                            $nombre= $nom['NOMBRE'];
                        }
                    }else $nombre = "";
                    ?>
                    <td class="td_espacio_mas3"><?php echo $nombre; ?></td>
                    
                    <td class="td_espacio_mas4"><?php echo  $key["FECHA_DENUNCIA"]; ?></td>

                    <?php 
                    $status="";
                    if($key["ESTATUS_DENUNCIA"]==0) $status = "PROCEDENTE";
                    elseif($key["ESTATUS_DENUNCIA"]==1) $status="NO PROCEDENTE";
                    else $status="CERRADO"; 

                    ?>

                    <td> <?php echo $status; ?> </td>

                    <?/*?><td class="td_espacio_mas4">
                        <?php echo dameMotivosQuejaCadena($key["ID_DENUNCIA"]); ?>
                    </td><?*/?>

                </tr>
                <?php }} ?>
            </tbody>

            <tfoot style="display:none">
                <tr>
                    <th>Queja y/o Reclamos</th>
                    <th>N° Patronal</th>
                    <th>Nombre Del Representante</th>
                    <th>Fecha</th>       
                    <th>Estatus</th>       
                    <!--<th>Motivos</th>      -->
                </tr>
            </tfoot>
        </table>

    </div>
    <br>

    <form action="../mod_denuncias/Controllers/ControllerReportesQueja.php" method="POST" class="form-inline">
        <input type="hidden" id="sqlQuery" name="query">
        <hr>

        <div style="overflow:hidden;">
            <input type="submit" class="btn btn-primary" style="width: 150px;float:right;" id="" value="Exportar a excel">  
        </div>
        
    </form>
    



    <?php /* ?>
    <button class="btn btn-primary" style="cursor:pointer;border-radius:2px;font-size:1em;padding:5px;color:white;width:100px;margin:auto;margin-bottom:25px;" onClick="location.reload()">
        <span class="glyphicon glyphicon-arrow-left"></span> Volver
    </button>

    <button class="btn btn-primary" style="cursor:pointer;border-radius:2px;font-size:1em;padding:5px;color:white;width:200px;margin:auto;margin-bottom:25px;" onclick="menuprincipal()">
        <span class="glyphicon glyphicon-home"></span> Menu principal
    </button>
    <?php */?>
</div>
<!--Panel denuncias-->
<div id="mensajerror1" style="display:none;position:fixed;z-index:100000;background:rgba(0,0,0,0.8);width:100%;height:100%;top:0;left:0;">
    <div id="error1" title="Mensaje" style="display:none;z-index: 10000;width:600px;hight:300px;margin:auto;margin-top:100px;background:rgba(255,255,255,0.8);" >
        <div id="titulo_error1" style="background:#234181 linear-gradient(#639ACA, #6095C4 20%, #3368A0 60%, #234181 100%) repeat scroll 0% 0%;color:white;padding:10px;margin:auto;font-size:1.4em; ">
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

<div id="mensajerror2" style="display:none;position:fixed;z-index:100000;background:rgba(0,0,0,0.8);width:100%;height:100%;top:0;left:0;">
    <div id="error2" title="Mensaje" style="display:none;z-index: 10000;width:600px;hight:300px;margin:auto;margin-top:100px;background:rgba(255,255,255,0.8);" >
        <div id="titulo_error2" style="background:#234181 linear-gradient(#639ACA, #6095C4 20%, #3368A0 60%, #234181 100%) repeat scroll 0% 0%;color:white;padding:10px;margin:auto;font-size:1.4em; ">
            Mensaje
            <div style="width:21px;float:right;cursor:pointer;" title="Cerrar mensaje" id="cerrar_error2">
                <span class="glyphicon glyphicon-remove"></span>
            </div>
        </div>                                     
        <div class="mensaje" style="padding:25px 25px 25px 25px;font-size:1.3em;">
            ¡ Por favor ingrese un valor válido en el campo!
        </div>
    </div>
</div>    

<div id="mensaje_empresa" style="display:none;">
    <div id="empresa_rel">

    </div>
</div>   


<div style='position:fixed; top:0; left:0;z-index:12;width:100%;height:100%;background:rgba(0,0,0,0.6); display: none;' id="mensaje">
    <div style="width:50%;margin:auto;margin-top:100px;background:#f1f1f1;padding:25px;">
        <h1>
            ¡ Por favor tiene que elegir una o varias opciones!
            <hr>
        </div>
    </div>

    <!--*******************************************************************************************-->
    <div id="Cargando" style="display:none;position:fixed;z-index:100000;background:rgba(0,0,0,0.8);width:100%;height:100%;top:0;left:0;">
        <div id="error_msnced2" title="Mensaje" style="z-index:10;width:600px;hight:300px;margin:auto;margin-top:200px;background:rgba(255,255,255,0.8);" >
            <div id="titulo_msnced2" style="background:#3B5998;color:white;padding:10px;margin:auto;font-size:1.4em; ">
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

    <!--Scripts-->

    <script type="text/javascript" src="<?=$base_url;?>public_html/js/jquery-2.1.4.min.js"></script> 
    <script type="text/javascript" src="<?=$base_url;?>public_html/vendor/DataTables/media/js/jquery.dataTables.js"></script>  

    <script type="text/javascript" src="<?=$base_url;?>public_html/vendor/DataTables/extensions/TableTools/js/dataTables.tableTools.min.js"></script>  
    <script type="text/javascript" src="<?=$base_url;?>public_html/vendor/DataTables/extensions/Buttons-1.0.0/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" src="<?=$base_url;?>public_html/vendor/DataTables/extensions/Buttons-1.0.0/js/buttons.flash.min.js"></script>
    <script type="text/javascript" src="<?=$base_url;?>public_html/js/valida_login.js"></script>
    <script type="text/javascript" src="<?=$base_url;?>public_html/js/enviar.js"></script>
    <script type="text/javascript" src="<?=$base_url;?>public_html/vendor/chosen/chosen.jquery.js"></script>    
    <script type="text/javascript" src="<?=$base_url;?>public_html/vendor/jquery-ui/js/jquery-ui.min.js"></script>

    <script>
        $(document).ready(function()
        {
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

            $("#chosen_dir").chosen();
            $("#chosen_mot").chosen();
            $("#chosen_est").chosen();

            $.fn.dataTable.Buttons.swfPath = "<?php echo $base_url; ?>/public_html/vendor/DataTables/extensions/Buttons-1.0.0/swf/flashExport.swf";
            $('#tabla_quejas').dataTable({
               // "sPaginationType":"full_numbers",
               // "iDisplayLength": 5
           }
           );

            /******************************************************************/
            $("#form_reportes_quejas_boton").on("click",function(e){
                e.preventDefault();

                //console.log("si");

                var direcciones = $("#chosen_dir").val();
                var motivos = $("#chosen_est").val();
                var status = $("#chosen_mot").val();
                var fechaInicio = $("#date1").val();
                var fechaFin = $("#date2").val();
                //var boo = false;


                $("#msjfecha").html(" ");
                $("#msjfechaFin").html(" ");
                if(fechaInicio!="")
                {
                 if(fechaFin=="")
                 {
                  //console.log("entreeee");
                  $("#msjfechaFin").html("Debe ingresar la fecha fin");
                  return 0; 
              }
          }

          $("#msjfecha").html(" ");
          if(fechaFin!="")
          {
             if(fechaInicio=="")
             {
                      //console.log("entreeee");
                      $("#msjfecha").html("Debe ingresar la fecha inicio");
                      return 0; 
                  }
              }

              if(direcciones==null && motivos==null && status==null && fechaFin=="" && fechaInicio=="")
              {
                $('#mensaje').fadeIn('fast').delay(2000).fadeOut('fast').delay(500,function(){
            //window.document.location="denuncias.php";
        });

            }else
            {

             //console.log("bn");
             $("#tabla_quejas").dataTable().fnDestroy();
             $.ajax({
                url:$("#form_reportes_quejas").attr("action"),
                type:"post",
                dataType: "json",
                data:$("#form_reportes_quejas").serialize(),
                beforeSend:function(){
                   $("#Cargando").fadeIn();

               },
               success:function(resp){
                $('#tabla_quejas').html(resp.tabla);
                $("#sqlQuery").val(resp.query);
                console.log(resp.query);
                $("#Cargando").fadeOut();
                $("#tabla_quejas").dataTable();
            }
        });
         }

     });



$("#limpiar_fechas").on("click",function(e){
    e.preventDefault();

    $('#date1').prop("readonly", false);
    $('#date1').val("");

    $('#date2').prop("readonly", false);
    $('#date2').val("");

    $('#date1').prop("readonly", true);
    $('#date2').prop("readonly", true);

});



$("#pernat").click(function()
{
    $("#persona").css('display', 'block');
    $("#empresa").css('display', 'none');
    $("#cedula").attr('required','true');
    $("#valor").removeAttr('required');
    $("#botones_perjur").css('display', 'none');
    $("#botones_pernat").css('display', 'block');         
});

$("#perjur").click(function()
{
    $("#persona").css('display', 'none');
    $("#empresa").css('display', 'block');
    $("#valor").attr('required','true');
    $("#cedula").removeAttr('required');
    $("#botones_pernat").css('display', 'none');
    $("#botones_perjur").css('display', 'block');

});

$("#opciones").on('change', function(){
    var mensaje = "Ingrese ";
    var opcion = $("#opciones").val();
    if(opcion == 'id_empresa')
    {
        mensaje += "N° Patronal";
        $("#valor").attr('maxlength', '9')
    }else if(opcion == 'rif'){
        mensaje += "Rif";
        $("#valor").attr('maxlength', '10')
    }else if(opcion == 'nombre_empresa'){
        mensaje += "Nombre";
        $("#valor").attr('maxlength', '100')
    }
    $("#valor").attr('placeholder', mensaje);
});

/*********************Boton Consultar persona natural**********************/
$("#boton_consulta").click(function(e){
    e.preventDefault();

    if( $("#cedula").val() == '' ){
        $("#mensajerror1").fadeIn("slow");
        $("#error1").slideDown('slow');

        $("#cerrar_error1").click(function(){
            $("#error1").slideUp('slow');
            $("#mensajerror1").slideUp( "slow" );           
        });
    }else if($("#cedula").val() != '' ){
        $("#ciudadano").val('persona');
        $("#formquery").submit();


               }//Llave else if

           });//Llave FIN click boton consulta (persona natural).


//////////////////////////////////////////////////////////////////////////////
/*********************Boton Consultar persona jurídica**********************/
////////////////////////////////////////////////////////////////////////////
$("#boton_consulta_empresa").click(function(e)
{
    e.preventDefault();
    if( $("#valor").val() == '' ){
        $("#mensajerror2").fadeIn("slow");
        $("#error2").slideDown('slow');

        $("#cerrar_error2").click(function(){
            $("#error2").slideUp('slow');
            $("#mensajerror2").slideUp( "slow" );           
        });
    }else if($("#valor").val() != '' ){

        $("#ciudadano").val('empresa');
        $("#formquery").submit();

                    }//Llave else if

          });//Llave click boton consulta_empresa.
});
function enviarFormulario(){
    //e.preventDefault();
    $("#empresas_completas_ciu").val($("#mensaje_empresa #empresa_rel").html());
    $("#forminsert").submit();
}

function regresar()
{
    var pagina = "../denuncias.php";
    location:href(pagina);
}

function menuprincipal(){
    window.location.href='<?= $base_url; ?>';
}
</script>
</body>
</html>     
