<?php  
require('resources/class.Login.php');
//if( isset($_SESSION['USUARIO']) )
if(Login::estoy_logeado())
{
    if($_SESSION['USUARIO']['utype']==1)
        {header('Location: App/sistemafiscal.php');}
    elseif($_SESSION['USUARIO']['utype']==2)
        {header('Location: App/sistemafiscal.analista.php');}
    elseif($_SESSION['USUARIO']['utype']==3)
        {header('Location: App/sistemafiscal.responsable.php');}
    /*elseif($_SESSION['USUARIO']['usuario']=="")
    { header('Location:index.php'); }*/
}

    /*
     * Valida un usuario y contraseña o presenta el formulario para hacer login
     */
    error_reporting(E_ALL);
    ini_set("display_errors", 1);
    
    if ($_SERVER['REQUEST_METHOD']=='POST') { // ¿Nos mandan datos por el formulario?
    //include('resources/config.ini.php'); //incluimos configuración
    //incluimos las funciones
        $login = new Login();
    //si hace falta cambiamos las propiedades tabla, campo_usuario, campo_contraseña, metodo_encriptacion

    //verificamos el usuario y contraseña mandados
        $nick = htmlentities(strtolower($_POST['usuario']));
        $password = htmlentities(strtolower($_POST['password']));
        $usuario = $login->login_users($nick, $password);
        if($usuario == TRUE)
        {
            if($_SESSION['USUARIO']['utype']==1)
                {header('Location: App/sistemafiscal.php');}
            elseif($_SESSION['USUARIO']['utype']==2)
                {header('Location: App/sistemafiscal.analista.php');}
            elseif($_SESSION['USUARIO']['utype']==3)
                {header('Location: App/sistemafiscal.responsable.php');}
        }
        else 
        {
        //acciones a realizar en un intento fallido
        //Ej: mostrar captcha para evitar ataques fuerza bruta, bloquear durante un rato esta ip, ....

        //preparamos un mensaje de error y continuamos para mostrar el formulario
            $mensaje='Los datos de acceso son incorrectos';
            //require("../index.php");
        }
} //fin if post
?>

<html lang="es">
<head>
    <meta charset="UTF-8"/>
    <link rel="shortcut icon" href="public_html/imagenes/favicon.ico" type="image/x-icon" />
    <link href="public_html/css/login_style.css" rel="stylesheet"/>
    <link rel="stylesheet" type="text/css" href="public_html/css/bootstrap/css/bootstrap.css">
    <title>Login</title>
</head>

<body>
    <div id="banner_pueblo">
        <img src="public_html/imagenes/banner_institucional.png" id="imagen_pueblo">
    </div>

    <div class="principal">
        <div class="login" style="">
            <div style="width:100%;padding:10px;background:url('public_html/imagenes/logoivss_blanco.png') no-repeat scroll 300px 300px, #234181 linear-gradient(#639ACA, #6095C4 20%, #3368A0 60%, #234181 100%) no-repeat scroll 0% 0%;">
                <p style="font-size:1.3em;color:white;text-indent:25px;"><img src="public_html/imagenes/logoivss_blanco.png" width="50"> Sistema de Fiscalización</p>
            </div>
            <form method="post" action="index.php" name="form_login" id="form_login">
                <div id="div_user" style="overflow:hidden;">                        

                    <div style="margin:auto;width:80%;">

                        <table>

                            <tr>
                                <td style="width:500px;font-size:1.2em;">Usuario: </td>
                                <td> 
                                    <div class="inner-addon left-addon" style="margin-top:5px;">
                                        <i class="glyphicon glyphicon-user"></i>
                                        <input type="text" name="usuario" id="usuario" class="form-control" maxlength="50" rel="popover" data-placement="left" data-original-title="Mensaje" data-content="Ingrese un correo Válido" data-trigger="blur">
                                        <p style="font-size:0.9em;color:red;display:none;" id="mensaje_eror_user">Ingrese un email válido.</p>
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td style="width:500px;font-size:1.2em;">Contraseña: </td>
                                <td>
                                    <div class="inner-addon left-addon" style="margin-top:5px;">
                                       <i class="glyphicon glyphicon-asterisk"></i>
                                       <input name="password" id="password" class="form-control" type="password" maxlength="12" title="Escriba una contraseña válida" required/>
                                       <p style="font-size:0.9em;color:red;display:none;" id="mensaje_eror_pass">Rellene este campo.</p>
                                   </div>
                               </td>
                           </tr>
                       </table>

                       <hr>
                       <div id="cambio_contraseña">
                           <a href="restablecer_password.php">Restaurar Contraseña</a>
                       </div>
                       <div id="btn_ingresar" style="float:right;">
                        <input type="submit" value="Ingresar" class="btn btn-default" id="boton_ingreso"/>
                        <input type="reset" value="Limpiar" class="btn btn-default" />
                    </div>
                </div>
                <div id="mensaje" style="width:600px;margin-top:30px;margin-bottom:5px;padding:12px;">                     
                    <?php if (!empty($mensaje)){ ?>                    
                    <p style="font-size:1.2em;color:red;text-align:center;display:inline;"><span class="glyphicon glyphicon-info-sign" style="font-size:1.2em;color:red;"></span> <?php echo $mensaje;?></p>
                    <?php  } ?>                      
                </div>  
            </div><!--Div user-->
        </form>
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

<!---------------------------------------------------------------------------------------------------------->
<div style='position:fixed; top:0; left:0; width:100%;height:100%;background:rgba(0,0,0,0.6); display: none;' id="mensaje_login">

    <div style="width:50%;margin:auto;margin-top:100px;background:#f1f1f1;">   
        <p style="width:100%;background:#3B5998;padding:10px;color:white;font-size:1.5em;">Mensaje</p>     
        <p style="font-size:1.4em;padding:25px;"> Su sesión ha espirado por favor loguese nuevamente</p><hr>
    </div>
</div>

<!---------------------------------------------------------------------------------------------------------->

<!--*****************************************Scripts*********************************-->
<script type="text/javascript" src="public_html/js/jquery-2.1.4.min.js"></script>
<script type="text/javascript" src="public_html/js/valida_login.js"></script>
<script type="text/javascript" src="public_html/js/bootstrap/js/bootstrap.js"></script>
<script type="text/javascript" src="public_html/vendor/jQueryValidation/dist/jquery.validate.js"></script>
<script>
    $(document).on("ready",function(){
        <?php if( isset($_GET['s']) ) { ?>
            $('#mensaje_login').fadeIn('fast').delay(1000).fadeOut('fast'); 
            <?php } ?>  

           /* $("#form_login").validate({
                rules:{
                    password:{required:true}
                },
                messages:{
                    password:{required:"Este campo es requerido"}
                }
            });*/

$("#usuario").on({
    blur:function(){
        expr = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        if ( !expr.test($(this).val()) ){
            $(this).css({"border":"1px solid red"}); 
            $("#mensaje_eror_user").show();
        }else{
            $(this).css({"border":"1px solid #f1f1f1"}); 
            $("#mensaje_eror_user").hide();
        }
    },
    click:function(){
        $(this).css({"border":"1px solid #f1f1f1"}); 
        $("#mensaje_eror_user").hide();
    }
});


$("#password").on({
    blur:function(){
        if( $("#password").val() == '' )
        {
            $(this).css({"border":"1px solid red"}); 
            $("#mensaje_eror_pass").show();
        }else{
            $(this).css({"border":"1px solid #f1f1f1"}); 
            $("#mensaje_eror_pass").hide();            
        }
    },
    click:function(){
        $(this).css({"border":"1px solid #f1f1f1"}); 
        $("#mensaje_eror_pass").hide();  
    }
});



$("#boton_ingreso").on('click',function(e){
    e.preventDefault();
    if( $("#password").val() == '' )
    {
        $("#password").css({"border":"1px solid red"});
        $("#mensaje_eror_pass").show();
    }else{
        $("#form_login").submit();
    }

});

});
</script>
<!--*****************************************Scripts*********************************-->
</body>
</html>


