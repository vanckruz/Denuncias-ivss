<?
    include("App/config/config.php");

?>

<html lang="es">
<head>
    <meta charset="UTF-8"/>
    <link rel="shortcut icon" href="public_html/imagenes/favicon.ico" type="image/x-icon" />
    <link href="public_html/css/login_style.css" rel="stylesheet"/>
    <link rel="stylesheet" type="text/css" href="public_html/css/bootstrap/css/bootstrap.css">
    <title>Restablecer password</title>
    <style>
        html,body{
            height:100%;
            width: 100%;
        }
    </style>
</head>

<body>
    <div id="banner_pueblo">
        <img src="public_html/imagenes/banner_institucional.png" id="imagen_pueblo">
    </div>

    <div class="principal">
        <div class="login" style="">
            <div style="width:100%;padding:12px;background:url('public_html/imagenes/logoivss_blanco.png') no-repeat scroll 300px 300px, #234181 linear-gradient(#639ACA, #6095C4 20%, #3368A0 60%, #234181 100%) no-repeat scroll 0% 0%;">
                <p style="font-size:1.3em;color:white;text-indent:25px;"><img src="public_html/imagenes/logoivss_blanco.png" width="50"> Sistema de Fiscalización - Restabler contraseña</p>
            </div>
            <div id="div_user" style="overflow:hidden;">
                <div style="margin:auto;width:80%;">
                    <table>
                        <tr>
                            <td style="width:500px;font-size:1.2em;">Cédula: </td>
                            <td> 
                                <div class="inner-addon left-addon" style="margin-top:5px;">
                                    <i class="glyphicon glyphicon-user"></i>
                                    <input type="text" name="cedula" id="cedula" class="form-control" maxlength="50"  title="Ingresa tu número de cédula">
                                </div>

                            </td>                       
                        </tr>
                         <tr id="error" style="display:none;">
                         <td></td>
                            <td>
                                <p id="mensajeerror" style="color:red; font-weight:bold;">Este campo es requerido</p>
                            </td>
                        </tr>
                    </table>
                    <hr>
                    <div id="btn_ingresar" style="float:right;">
                        <button class="btn btn-default" id="restablecer" >Restablecer</button>
                        <button id="volverhome" class="btn btn-default"> <span class="glyphicon glyphicon-arrow-left"></span> Regresar</button>
                    </div>
                </div>
            </div><!--Div user-->
        </div> <!--login--> 
    </div><!--principal-->
    <!--Pie de pagina-->
    <div class="pie" style="background:rgba(241,241,241,0.9);width:100%;height:100px;overflow:hidden;position:fixed;bottom:0;">
        <div style="background:url('public_html/imagenes/logoivss_blanco.png') no-repeat;background-position:center; width:600px;height:100%;margin:auto; ">
            <p style="text-align:center;margin-top:16px;">
                LA SEGURIDAD SOCIAL ES TU DERECHO<br>
                INSTITUTO VENEZOLANO DE LOS SEGUROS SOCIALES (IVSS) 2015<br>
                DESARROLLADO POR LA DIRECCIÓN GENERAL DE INFORMÁTICA                
            </p>
        </div>
    </div>
    <!--Pie de pagina-->

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
                <img src='<?php $base_url; ?>public_html/imagenes/484.GIF' style='width:150px;height:auto;opacity:1;margin-left: 192px;'>
            </div>
        </div>
    </div>
    <!--******************************************************************************************-->


    <div style="display:none;width:100%;height:100%;background:rgba(0,0,0,0.5);position:fixed;top:0;left:0;z-index:10;" id="mensaje_restablecer">
        <div style="width:40%;margin:auto;margin-top:80px;height:200px;background:#f1f1f1;">
            <div style="width:100%;display:none;background:#3B5998;color:white;font-size:1.6em;padding:7px;">
                Mensaje
                <div style="float:right;cursor:pointer;" id="cerrar"><span class="glyphicon glyphicon-remove"></span></div>
            </div>
            <div style="width:100%;color:black;padding:25px;font-size:1.3em;" id="aprobado">
                <p style="color:rgba(0,0,0.5);margin-top: 50px;" id="aprobado_p"></p>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="public_html/js/jquery-2.1.4.min.js"></script>
    <script>
        $(document).on("ready",function(){
            $('#cedula').attr({"placeholder":"Ej: 16753241","maxlength":"8"});
            $('#cedula').keypress(function(e){
                keynum = window.event ? window.event.keyCode : e.which;
                if ((keynum == 8) || (keynum == 46) || (keynum == 13))
                    return true;
                if(keynum == 46) return false;
                return /\d/.test(String.fromCharCode(keynum));
            });
            $("#restablecer").on("click",function(){
                var estatus = "";
                if($("#cedula").val() == ""){
                    $("#error").css("display","");
                } else {
                            $.ajax({
                    type:"post",
                    url :"App/mod_denuncias/Controllers/Controller.correo.php",
                    data:{"cedula":$("#cedula").val()},
                    beforeSend:function(){
                        //console.log("sdgsdfbsdbjb");
                        $("#Cargando").fadeIn();
                        //$("body").css("background","red");                        
                    },
                    success:function(respuesta){
                        $("#Cargando").fadeOut();
                        $("#aprobado_p").html(respuesta);
                    }
                }).done(function(){
                 //$("#mensaje_restablecer").slideDown(); 
                 $('#mensaje_restablecer').slideDown('fast').delay(2000).fadeOut('slow'); 
             });

                }       

});
/****************************************************************************************/    
$("#cerrar").on("click",function(){
   $("#mensaje_restablecer").slideUp(); 
});

$("#volverhome").on("click",function(){
    window.document.location='index.php';
});

});
$("#cedula").on("click",function(){
    $("#error").css("display","none");
})
</script>
</body>
</html>


