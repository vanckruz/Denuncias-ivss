<?php 
require('../../../resources/restrictedaccess.php');

include("../../config/config.php");
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<style type="text/css" media="screen">
  #tabla_juridica_length label, #tabla_juridica_filter label{
    color: black;
    font-size: 0.8em;
    color:#555;
  }
  #tabla_juridica_length select, #tabla_juridica_filter input{
    color:black;
    border:1px solid gray;

  }
  .ui-widget-overlay{
    background: rgba(0,0,0,0.7);
  }
  label.error{
    color: red;
    margin-top:5px;
    font-size: 0.8em;
  }
  .cols-tabla{
    font-size:0.7em;
  }

</style>
<body>
  <form action="Controllers/Controller.Denuncia.php" method="post" name="forminsert" id="forminsert" class="form-inline">
    <input type="hidden" id="ciudadano" name="ciudadano" value="empresa">
    <input type="hidden" name="option" id="option" value="registro" form="forminsert">
    <input type="hidden" id="id_empresa_ciu_nat" name="id_empresa_ciu_nat"> 
    <input type="hidden" id="rif_ciu_nat" name="rif_ciu_nat">
    <input type="hidden" id="nombre_empresa_ciu_nat" name="nombre_empresa_ciu_nat"> 
    <input type="hidden" id="direccion_ciu_nat" name="direccion_ciu_nat"> 
    <input type="hidden" id="estatus_empresa_ciu_nat" name="estatus_empresa_ciu_nat"> 
    <input type="hidden" id="empresas_completas_ciu" name="empresas_completas_ciu">
    <input type="hidden" id="telefono_empresa" name="telefono_empresa"> 
    <input type="hidden" id="email_empresa" name="email_empresa">
    <fieldset class="fieldset" style="background:#3B5998;">
      <h3 style="color:white;">Registrar Quejas y/o Reclamos</h3>
      <hr>
      <!--Consultar Empresa-->
      <div class="form-group empresa" id="empresa">
        <select id="opciones_empresa" name="opciones" class="form-control input-sm" required>
          <option value="" name="opcdef" selected>Seleccione</option>
          <option value="rif">Rif</option>
          <option value="id_empresa">N° Patronal</option>
          <option value="nombre_empresa">Nombre Empresa</option>
        </select>

        <input type ="text" name="valor" id="valor" class="form-control input-sm">

        <div class="form-group elementoform" id="botones_perjur" style="display: block !important;">
          <input type="submit" id="boton_consulta_empresa" class="btn btn-default" value="Consultar" style="float:right;">
          <?php /*<a href="quejas.php"><input type="button" class="btn btn-default btn-sm" value="Cancelar"/></a>*/?>
        </div>
      </div><!--FIN Consultar Empresa-->


                <?php /*<div class="form-group">
                    <button type="button" style="width: 157px;" class="btn btn-default btn-volver" id="btn-volver" onclick="location.href = 'http://desarrollofiscalizacion.ivss.int/App/sistemafiscal.php';">
                        <span class="glyphicon glyphicon-home"></span> Menu Principal
                    </button>
                  </div>*/?>
                  <div id="mostrar"></div>
                </fieldset>
              </form>

              <div id="mensajerror2" style="display:none;position:fixed;z-index:100000;background:rgba(0,0,0,0.8);width:100%;height:100%;top:0;left:0;">
                <div id="error2" title="Mensaje" style="display:none;z-index: 10000;width:600px;hight:300px;margin:auto;margin-top:100px;background:rgba(255,255,255,0.8);" >
                  <div id="titulo_error2" style="background:#234181 linear-gradient(#639ACA, #6095C4 20%, #3368A0 60%, #234181 100%) repeat scroll 0% 0%;color:white;padding:10px;margin:auto;font-size:1.4em; ">
                    Mensaje
                    <div style="width:21px;float:right;cursor:pointer;" title="Cerrar mensaje" id="cerrar_error2">
                      <span class="glyphicon glyphicon-remove"></span>
                    </div>
                  </div>                                     
                  <div class="mensaje" style="padding:25px 25px 25px 25px;font-size:1.3em;color:red;">
                    ¡ Por favor ingrese un valor válido en el campo!
                  </div>
                </div>
              </div> 

              <div id="mensajerror3" style="display:none;position:fixed;z-index:100000;background:rgba(0,0,0,0.8);width:100%;height:100%;top:0;left:0;">
                <div id="error1" title="Mensaje" style="z-index: 10000;width:600px;hight:300px;margin:auto;margin-top:100px;background:rgba(255,255,255,0.8);" >
                  <div id="titulo_error3" style="background:#234181 linear-gradient(#639ACA, #6095C4 20%, #3368A0 60%, #234181 100%) repeat scroll 0% 0%;color:white;padding:10px;margin:auto;font-size:1.4em; ">
                    Mensaje
                    <div style="width:21px;float:right;cursor:pointer;" title="Cerrar mensaje" id="cerrar_error3">
                      <span class="glyphicon glyphicon-remove"></span>
                    </div>
                  </div>                                     
                  <div class="mensaje" style="padding:25px 25px 25px 25px;font-size:1.2em;color:red;">
                    ¡ Por favor seleccione una Opción de la lista !
                  </div>
                </div>
              </div>  

              <div id="mensaje_empresa" style="display:none;">
                <div id="empresa_rel">

                </div>
              </div>              
              <!--Scripts-->
              <link rel="stylesheet" href="<?=$base_url;?>public_html/vendor/DataTables/media/css/jquery.dataTables.css">
              <script type="text/javascript" src="<?=$base_url;?>public_html/vendor/DataTables/media/js/jquery.dataTables.js"></script>      
              <script type="text/javascript" src="<?=$base_url;?>public_html/js/valida_login.js"></script>
              <script type="text/javascript" src="<?=$base_url;?>public_html/vendor/jQueryValidation/dist/jquery.validate.js"></script>
              <script type="text/javascript" src="<?=$base_url;?>public_html/vendor/jQueryMask/jquery.mask.js"></script>
              <script>
                $(document).ready(function()
                {

                  /*
                  $(".npatronal").mask('P99999999', {translation: { 
                    'P': { pattern: /[a-zA-ZáéíóúàèìòùÀÈÌÒÙÁÉÍÓÚñÑüÜ_\s]$/, defaults: ':'}}});

                  $(".rif").mask('R999999999', {translation: { 
                    'R': { pattern: /[vVgGjJ\s]$/, defaults: ':'}}});
*/
$("#opciones_empresa").on('change', function(){
  var mensaje = "";
  var opcion = $("#opciones_empresa").val();


  if(opcion == 'id_empresa')
  {
    mensaje += "Ej: A12345678";
    $("#valor").attr('maxlength', '9');
    $("#valor").removeClass('rif');
    $("#valor").addClass('npatronal');


    $("#valor").mask('P99999999', {translation: { 
      'P': { pattern: /[a-zA-ZáéíóúàèìòùÀÈÌÒÙÁÉÍÓÚñÑüÜ_\s]$/, defaults: ':'}}});
  }else if(opcion == 'rif'){
    mensaje += "Ej: J123456789";
    $("#valor").attr('maxlength', '10');
    
    $("#valor").removeClass('npatronal');
    $("#valor").addClass('rif');
    $("#valor").mask('R999999999', {translation: { 
      'R': { pattern: /[vVgGjJ\s]$/, defaults: ':'}}});
  }else if(opcion == 'nombre_empresa'){
    mensaje += "Ej: IVSS";
    $("#valor").attr('maxlength', '100');
    $("#valor").removeClass('rif');
    $("#valor").removeClass('npatronal');
    $("#valor").mask('NNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNN', {translation: { 
      'N': { pattern: /[0-9a-zA-ZáéíóúàèìòùÀÈÌÒÙÁÉÍÓÚñÑüÜ._\s]$/, defaults: ':'}}});
  }
  $("#valor").attr('placeholder', mensaje);
});

/********************VALIDAR RIF Y NÚMERO PATRONAL*************************/
$("#forminsert").validate({
  rules:{
    valor:{required:true}
  },
  messages:{                  
    valor:{required:"Este campo es requerido"}
  },
});

//////////////////////////////////////////////////////////////////////////////
/*********************Boton Consultar persona jurídica**********************/
////////////////////////////////////////////////////////////////////////////

$("#cerrar_error3").on('click',function(){
 $("#mensajerror3").fadeOut("slow");
});

$("#boton_consulta_empresa").click(function(e){
  e.preventDefault();
  var opcion = $("#opciones_empresa").val();
  var boo = false;
  if(opcion=="")
  {
    $("#opciones_empresa").css({"border":"1px solid red"});
    $("#mensajerror3").slideDown();

    return false;
  }

  if(  ($("#valor").val() == '' || $("#valor").val().length != 9) && !isNaN($("#valor").val().charAt(0))){
    $("#mensajerror2").fadeIn("slow");
    $("#error2").slideDown('slow');

    $("#cerrar_error2").click(function(){
      $("#error2").slideUp('slow');
      $("#mensajerror2").slideUp( "slow" );           
    });
  }
  else if($("#valor").val() != ''){

    if (opcion=='id_empresa'){

      if ($("#valor").val().length != 9) {
        $("#mensajerror2").fadeIn("slow");
        $("#error2").slideDown('slow');
        $("#cerrar_error2").click(function(){
          $("#error2").slideUp('slow');
          $("#mensajerror2").slideUp( "slow" );           
        });
        return false;
      }
    }//fin id_emprersa

    if (opcion=='rif'){

      if ($("#valor").val().length != 10) {
        $("#mensajerror2").fadeIn("slow");
        $("#error2").slideDown('slow');
        $("#cerrar_error2").click(function(){
          $("#error2").slideUp('slow');
          $("#mensajerror2").slideUp( "slow" );           
        });
        return false;
      }
    }//fin rif

    $("#mensaje_empresa").dialog({width:"960px",title:"Empresas",modal:true,minHeight:"300px","resizable":false,position: "top"});

    $.ajax({
      data: {"option":$("#option").val(),"ciudadano":$("#ciudadano").val(),"opciones":$("#opciones_empresa").val(),"valor":$("#valor").val()},
      url:   'Controllers/Controller.Denuncia3.php',
      type:  'post',
     // contentType:'application/x-www-form-urlencode;charset=utf-8',
     beforeSend: function(){
      $("#mensaje_empresa").css({"background":"rgba(255,255,255,0.9)"});
      $("#mensaje_empresa #empresa_rel").html("<div style='background:white;vertical-align:center;'><img src='http://desarrollofiscalizacion.ivss.int/public_html/imagenes/484.GIF' style='background:rgba(255,255,255,0.7);width:70px;height:70px;margin-top:50px;'><br><p style='margin-top:16px;margin-bottom:50px;font-weight:bold;'>Cargando...</p></div>");
    },
    success: function(resp){
     // alert(resp);
                            //lo que se si el destino devuelve algo
                            $("#mensaje_empresa #empresa_rel").html(resp);                
                          }
                        }).done(function(){

                          $( "#tabla_juridica").dataTable();               
                          /*************** BOTON OK PERSONA JURÍDICA*******************/ 
                   // $(".boton_formulario_empresa").click(function(e){
                     $("#tabla_juridica").on("click","tr .boton_formulario_empresa",function(e){
                      e.preventDefault();

                      var this_boton = $(this).attr("data-nombre_empresa").replace(/-/g, " ");

                      $("#nombre_empresa_ciu_nat").val( $(this).attr("data-nombre_empresa").replace(/-/g, " ") );

                      $("#id_empresa_ciu_nat").val( $(this).attr("data-id_empresa") );

                      $("#rif_ciu_nat").val( $(this).attr("data-rif") );

                      $("#direccion_ciu_nat").val( $(this).attr("data-direccion").replace(/-/g, " ") );

                      $("#telefono_empresa").val( $(this).attr("data-telefono"));

                      $("#email_empresa").val( $(this).attr("data-email"));

                            //$("#mensaje_empresa #empresa_rel").append("Nombre: "+$(this).attr("data-direccion"));

                            $("#forminsert").submit();

                           // $("#boton_formulario2").click(function(){
                               // alert("dbfsdbgfsdfsdbfhsdjbf");
                            //}; 

                        });//FIN Click boton ok persona Jurídica             

});/*Fin ajax done*/

                }//Llave else if

           });//Llave click boton consulta_empresa.

/**/
});
function enviarFormulario(){
    //e.preventDefault();
    $("#empresas_completas_ciu").val($("#mensaje_empresa #empresa_rel").html());
    $("#forminsert").submit();
  }
</script>
</body>
</html>     
