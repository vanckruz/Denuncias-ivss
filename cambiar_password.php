<?
    include("App/config/config.php");

?>
<style type="text/css" media="screen">
    .Alert{
        position: absolute;
        width: 607px;
        height: 254px;
        background-color: rgba(0,0,0,0.5);
        margin: -26.9% 0% 0% 30%;
        z-index: 2;
    }

    .AlertBox{
        background: #f1f1f1;
        height: auto;
        width: 387px;
        margin: 11% 0% 0% 17%;
        box-shadow: 8px 8px 7px 2px #ccc;
        border-radius: 20px 20px 20px 20px;
        border-top: solid 1px rgba(0, 0, 0, 0.99);
        border-left: solid 1px rgba(0, 0, 0, 0.99);
        border-right: solid 1px rgba(0, 0, 0, 0.99);
    }

    .AceptarButton{
        display:inline-block;       
        width: 387px;
        border-left: solid 1px rgb(2, 2, 2);
        border-right: solid 1px rgb(2,2,2);
        border-bottom: solid 1px rgb(2,2,2);
        margin: 25px 0px 0px -1px;
        /* margin: 6% 0% 0% 0%; */
        background-color: rgb(241, 241, 241);
        border-radius: 0px 0px 20px 20px;
    }


    .AlertMensaje{
        font-family: arial;
        font-size: 17px;
        color: black;
        padding: 3%;
        text-align: justify;

    }
    .ModalButton {
        background: #f5f8ff;
        background-image: -webkit-linear-gradient(top, #f5f8ff, #b9c2c7);
        background-image: -moz-linear-gradient(top, #f5f8ff, #b9c2c7);
        background-image: -ms-linear-gradient(top, #f5f8ff, #b9c2c7);
        background-image: -o-linear-gradient(top, #f5f8ff, #b9c2c7);
        background-image: linear-gradient(to bottom, #f5f8ff, #b9c2c7);
        -webkit-border-radius: 22;
        -moz-border-radius: 22;
        border-radius: 22px;
        font-family: Arial;
        color: #121212;
        font-size: 13px;
        padding: 4px 21px 4px 20px;
        border: solid #dedede 1px;
        text-decoration: none;
    }

    .ModalButton:hover {
        background: #b9c2c7;
        background-image: -webkit-linear-gradient(top, #b9c2c7, #f5f8ff);
        background-image: -moz-linear-gradient(top, #b9c2c7, #f5f8ff);
        background-image: -ms-linear-gradient(top, #b9c2c7, #f5f8ff);
        background-image: -o-linear-gradient(top, #b9c2c7, #f5f8ff);
        background-image: linear-gradient(to bottom, #b9c2c7, #f5f8ff);
        text-decoration: none;
    }
    .error{
        color:red;
    }

</style>
<html lang="es">
<head>
    <meta charset="UTF-8"/>
    <link rel="shortcut icon" href="public_html/imagenes/favicon.ico" type="image/x-icon" />
    <link href="public_html/css/login_style.css" rel="stylesheet"/>
    <link rel="stylesheet" type="text/css" href="public_html/css/bootstrap/css/bootstrap.css">
    <script type="text/javascript" src="../../public_html/js/jquery-2.1.4.min.js"></script>
    <script type="text/javascript" src="../../public_html/vendor/jQueryValidation/dist/jquery.validate.js"></script>
    <title>Cambiar Contraseña</title>
</head> 
<body>
    <!--BANNER-->
    <div id="banner_pueblo">
        <img src="public_html/imagenes/banner_institucional.png" id="imagen_pueblo">
    </div>
    <!--BANNER-->
    <div class="principal">
        <div class="login" style="  height: 433px;">
            <div style="width:100%;padding:2px;border-top:5px solid rgba(255,255,255,1);border-bottom:5px solid rgba(255,255,255,1);background:url('public_html/imagenes/logoivss_blanco.png') no-repeat scroll 300px 300px, #234181 linear-gradient(#639ACA, #6095C4 20%, #3368A0 60%, #234181 100%) no-repeat scroll 0% 0%;">
                <p style="font-size:1.3em;color:white;text-indent:25px;"><img src="public_html/imagenes/logoivss_blanco.png" width="50"> Sistema de Fiscalización</p>
            </div>               
            <div id="div_user" style="overflow:hidden; width: 600px;">
                <!--<form name="form_cambiar_contrasena" id="form_cambiar_contrasena" method="post" action="#">-->
                <form name="form_cambiar_contrasena" id="form_cambiar_contrasena" method="post" action="App/mod_denuncias/Controllers/Controller_password.php">
                    <table>                          
                        <tr>
                            <!--Repetir Contrasena-->
                            <td style="width:500px;font-size:1.2em;">Nueva contraseña: </td>
                            <td>
                                <div class="inner-addon left-addon" style="margin-top:5px;">
                                    <i class="glyphicon glyphicon-asterisk"></i>
                                    <input style="  width: 329px;" type="password" name="newpassword" id="newpassword" class="form-control" maxlength="50"/>
                                </div>
                            </td>
                        </td>
                    </tr>
                    <tr>
                        <!--Nueva Contrasena-->
                        <td style="width:500px;font-size:1.2em;">Repetir nueva contraseña: </td>
                        <td>
                            <div class="inner-addon left-addon" style="margin-top:5px;">
                                <i class="glyphicon glyphicon-asterisk"></i>
                                <input style="  width: 329px;" type="password" name="repeatnewpassword" id="repeatnewpassword" class="form-control" maxlength="50"/>
                            </div>
                        </td>
                    </tr>                            
                </table>

                <input type="hidden" name="token" value= <?php echo $_GET['token']; ?> >

                <hr>
                <div id="btn_ingresar" style="float:right;">                    
                    <button id="ingresobutton" name="ingresobutton" type="submit" style="height: 35px;" class="btn btn-primary" id="guardar">
                        <span style="margin-top: -5px;" class="glyphicon">Guardar</span>
                    </button>
                    <button type="reset" style="height: 35px;" class="btn btn-primary" id="limpiar">
                        <span style="margin-top: -5px;" class="glyphicon"> Limpiar</span>
                    </button>
                    <button type="button" style="height: 35px; margin-right: 150px;" class="btn btn-primary" id="regresar" name="regresar" title="Volver">
                        <span style="margin-top: -5px;" class="glyphicon">Regresar</span>
                    </button>                    
                </div>
            </form>
        </div><!--Div user-->                
        <div id="mensaje" style="width:400px;margin:auto;margin-bottom:5px;color:white;display:hide;text-align:center;">
            <div class="center" style="">                        
                <?php
                if (!empty($mensaje)){
                    echo '<span class="glyphicon glyphicon-info-sign" style="float:left;font-size:1.4em;"></span>';
                    echo '<h4>'.htmlspecialchars($mensaje).'</h4>';
                }
                ?>  
            </div>                     
        </div>
    </div> <!--login--> 
</div><!--principal-->
<!--Pie de pagina-->
<div class="pie" style="background:rgba(241,241,241,0.9);width:100%;height:100px;overflow:hidden;position:absolute;bottom:0;">
    <div style="background:url('public_html/imagenes/logoivss_blanco.png') no-repeat;background-position:center; width:600px;height:100%;margin:auto; ">
        <p style="text-align:center;margin-top:16px;">
            LA SEGURIDAD SOCIAL ES TU DERECHO<br>
            INSTITUTO VENEZOLANO DE LOS SEGUROS SOCIALES (IVSS) 2015<br>
            DESARROLLADO POR LA DIRECCIÓN GENERAL DE INFORMÁTICA                
        </p>
    </div>
</div>
<!--Pie de pagina-->
</body>
</html>
<div id="mensajerror1" style="display:none;position:fixed;z-index:100000;background:rgba(0,0,0,0.8);width:100%;height:100%;top:0;left:0;">
    <div id="error1" title="Mensaje" style="display:none;z-index: 10000;width:600px;hight:300px;margin:auto;margin-top:100px;background:rgba(255,255,255,0.8);" >
        <div id="titulo_error1" style="background:#234181 linear-gradient(#639ACA, #6095C4 20%, #3368A0 60%, #234181 100%) repeat scroll 0% 0%;color:white;padding:10px;margin:auto;font-size:1.4em; ">
            Mensaje
            <div style="width:21px;float:right;cursor:pointer;" title="Cerrar mensaje" id="cerrar_error1">
                <span class="glyphicon glyphicon-remove"></span>
            </div>
        </div>                                     
        <div class="mensaje" style="padding:25px 25px 25px 25px;font-size:1.3em;">
            ¡ Por favor ingrese un valor válido en el campo de password !
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
<!--VENTANA MODAL SI NO-->
<div class="Alert" id="AlertaSiNo" style="display:none;">
    <div class="AlertBox">
        <div class="AlertMensaje" style="text-align:center;">
            <span id="TextoAlerta"><!-- ESTE ES EL TEXTO DE TU ALERT BOX--></span>
        </div>
        <div class="AceptarButton">
            <button id="NewPassOk" name="AceptarIngreso" type="button" class="ModalButton" style="margin-left: 23%;margin-right: 6%;margin-bottom: 3%;">
                <span class=""></span>Aceptar
            </button>
            <button id="NewPassCancel" name="CancelarIngreso" type="button" class="ModalButton" style="">
                <span class=""></span>Cancelar
            </button>
        </div>
    </div>
</div>
<!--VENTANA MODAL SI NO-->
<!--Scripts-->
<link rel="stylesheet" href="../../../public_html/vendor/DataTables/media/css/jquery.dataTables.css">
<script type="text/javascript" src="public_html/js/jquery-2.1.4.min.js"></script>
<script type="text/javascript" src="public_html/vendor/DataTables/media/js/jquery.dataTables.js"></script>      
<script type="text/javascript" src="public_html/js/valida_login.js"></script>
<script type="text/javascript" src="../../public_html/vendor/jQueryValidation/dist/jquery.validate.js"></script>
<script type="text/javascript" src="../../public_html/vendor/jQueryMask/jquery.mask.js"></script>
<script>
    $(document).ready(function(){
        $('#cedula').mask('##.###.###',{placeholder: "ej. 00.000.000"});
    });
    $("#ingresobutton").on("click",function(){        
        $("#form_cambiar_contrasena").validate({
            rules:{
                cedula:{
                    required:true
                },
                newpassword:{
                    required:true
                },
                repeatnewpassword:{
                    required:true,
                    equalTo:"#newpassword"
                }
            },
            messages:{
                cedula:{
                    required:"Este campo es obligatorio"
                },
                newpassword:{
                    required:"Este campo es obligatorio"
                },
                repeatnewpassword:{
                    required:"Este campo es obligatorio",
                    equalTo:"Ambas contraseñas deben coincidir"}
                },
                submitHandler: function(form) {
                    form.submit();
                }
            });
    });
    $("#cedula").on("keypress",function(){
        if ($("#cedula").val().length > "8"){
           $('#cedula').mask('##.###.###');                
       } else {
           $('#cedula').mask('#.###.###');
       }
   });

    $("#regresar").on("click",function(){
        window.location.href="<?=$base_url;?>"
    });
</script>

