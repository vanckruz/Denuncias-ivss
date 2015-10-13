<?php 

require('../../../resources/restrictedaccess.php');
include("../../../resources/select/funciones.php");
include("../../../App/config/config.php");


$codTelefono = dameCodigosTelefono();
$estados = dameEstado();
$direcciones = dameDirecciones();
$roles = dameRoles();

?>

<style type="text/css">
    .labelformulario{
        color: black;
        font-size: 0.8em;
    }
    h2{
        background:#3B5998;
        color:white;
        padding:7px;
        text-align: left;
        font-size: 1.2em;
    }

    .Resaltar{
        text-align: left;
        font-size: 0.9em;
        font-weight: bold;
        text-decoration: initial;
        margin-left: 14px;
    }

    .obligatorio{
        color:red;
    }

    select{
        width: 285px !important;
    }
    hr{
        border-top: 1px solid #9A9A9A;
    }
    .error {
        color:  red !important;
        font-size: 0.8em;
        font-weight: normal;*/
    }
/*input .error{
    color: black !important;
}*/
@media screen and (min-width:900px) and (max-width: 1100px) {
    .container{
        width: 880px !important;
    }
}


</style>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximun-scale=1">    
    <title></title>
</head>
<body>
    <!-- ################################################ VENTANA DE REGISTRAR USUARIO ######################################################-->
    <div id="loginbackground">
        <div class="login-message">
            <fieldset class="fieldset" style="border-radius:0px;background:#3B5998; margin: 1% 0% 0% 21%;">
                <h3 style="color:white;margin: 1% 0% 0% 25%;font-size: 1.2em;" class="Resaltar">Registrar Usuario</h3>
                <hr>
                <div class="form-group persona" id="persona" style="display: block;">
                    <label for="nacionalidad" style="margin: 0% 0% 0% -5%;display:block;font-size: 13px;float:left;width:150px;color:white;">Nacionalidad</label>
                    <label for="nacionalidad" style="display:block;font-size: 13px;float:left;width:150px;color:white;">Cédula</label>
                    <div style="clear:both;"></div>
                    <select id="NacionalidadSelect" name="nac_apo" class="form-control" required="" style="width: 115px !important;font-size: 12px !important;height: 29px;margin: 1% 0% 2% -1%;" form="FormularioRegistroUsuario">
                        <option value="" selected="">Seleccione</option>
                        <option value="V">V</option>
                        <option value="E">E</option>
                        <option value="T">T</option>
                    </select>  
                    <input type="text" id="CIuserlogin" name="id_apo" class="form-control input-sm" placeholder="Ingrese cédula aquí" maxlength="8" required="" form="FormularioRegistroUsuario" style="width: 179px !important;float: left;margin: -9.3% 0% 0% 30%;height: 29px;font-size: 12px!important;">
                    <div class="form-group elementoform" id="botones_pernat">
                        <input type="submit" id="ButtonLogin" name="ButtonLogin"class="btn btn-default" value="Consultar" style="width: 98px;margin: -17.8% -79% 0% 0%;padding: 0;height: 29px;font-size: 12px;">
                    </div>
                </div>
            </fieldset>
        </div> 
    </div>
    <!-- ################################################ VENTANA DE REGISTRAR USUARIO ######################################################-->
    <!-- ####################################################################################################################################-->
    <!-- ######################################################## FORMULARIO ################################################################-->
    <form action="Controllers/Controller.Users.php" id="FormularioRegistroUsuario" name="FormularioRegistroUsuario" method="POST" style="display:none;">
        <input type="hidden" id="option" name="option" value="registro">
        <!-- #################################################### TABLA DE DATOS ################################################################-->
        <div id="TablaFormulario" style="display:none;width:960px !important;margin:auto;padding:25px;overflow:hidden;background:#FFFFFF;box-shadow:10px 10px 21px #000;margin-bottom: 86px;">
            <!--Inicio content center-->
            <h2>Datos Personales</h2>
            <div class="row">
                <h3 class="Resaltar">
                    <span class="obligatorio">*</span> Campos Obligatorios
                </h3>    
            </div>
            <div class="row">            
                <div class="col-xs-4 form-group">
                    <label class="labelformulario" style="margin-left: -224px;">Nombre</label>
                    <input type="text" class="form-control" id="NombreUser" name="NombreUser" value="" readonly="" form="FormularioRegistroUsuario">
                </div>
                <div class="col-xs-4 form-group">
                    <label class="labelformulario" style="margin-left: -224px;">Apellido</label>
                    <input type="text" class="form-control" id="ApellidoUser" name="ApellidoUser" value="" readonly="" form="FormularioRegistroUsuario">
                </div>  
                <div class="col-xs-4 form-group">
                    <label class="labelformulario" style="margin-left: -224px;">Cédula</label>
                    <input type="text" class="form-control" id="Cedula" name="Cedula" value="" readonly="" form="FormularioRegistroUsuario">
                </div>
            </div>
            <div class="row">
                <div class="col-xs-4 form-group ">
                    <label class="labelformulario" style="margin: 0% 0% 2% -48%;"><span class="obligatorio">*</span> Correo Electrónico</label>
                    <input type="text" class="form-control" id="Email" name="Email" placeholder="Ej: alguien@alguien.com" form="FormularioRegistroUsuario" maxlength="250" oncopy="return false;" onpaste="return false;" oncut="return false;">
                </div>
                <div class="col-xs-4 form-group">
                    <label class="labelformulario" style="margin-left: -118px;">Teléfono de Habitación</label>
                    <select name="TelefHabitacionSelect" id="TelefHabitacionSelect" class="form-control" style="width: 123px !important;">
                        <option value="">Seleccione</option>
                        <? 
                        foreach ($codTelefono as $TelefonoCodigo) {
                         echo "<option value=".$TelefonoCodigo['CODIGO_AREA'].">".$TelefonoCodigo['CODIGO_AREA']."</option>";
                     }
                     ?>
                 </select>
                 <input type="text" class="form-control" id="Telf_Habitacion" name="Telf_Habitacion" placeholder="Ej: 5555555" form="FormularioRegistroUsuario" maxlength="7" oncopy="return false;" onpaste="return false;" oncut="return false;" style="width: 151px;margin-top: -39px;margin-left: 131px;">
                 <p id="errorTelefonoHabitacion" class="error" style="display:none;">Debe poseer 7 dígitos</p>
             </div>  
             <div class="col-xs-4 form-group">
                <label class="labelformulario" style="margin-left: -142px;">Teléfono Movil</label>
                <select name="TelefMovilSelect" id="TelefMovilSelect" class="form-control" style="width: 123px !important;">
                    <option value="">Seleccione</option>
                    <option value="0414">0414</option>
                    <option value="0424">0424</option>
                    <option value="0416">0416</option>
                    <option value="0416">0426</option>
                    <option value="0412">0412</option>
                </select>
                <input type="text" class="form-control" id="Telef_Movil" name="Telef_Movil" placeholder="Ej: 5555555" form="FormularioRegistroUsuario"  maxlength="7" oncopy="return false;" onpaste="return false;" oncut="return false;" style="width: 151px;margin-top: -39px;margin-left: 131px;">
                <p id="errorTelefonoMovil" class="error" style="display:none;">Debe poseer 7 dígitos</p>
            </div>
        </div>
        <h2>Datos de Usuario</h2>
        <div class="row">
            <div class="col-xs-4 form-group ">
                <label class="labelformulario" style="margin-left: -214px;"><span class="obligatorio">*</span> Usuario</label>
                <input type="text" class="form-control" id="UserName" name="UserName" placeholder="Ej: alguien@alguien.com" form="FormularioRegistroUsuario" maxlength="100" oncopy="return false;" onpaste="return false;" oncut="return false;">
                <p id="errorCorreoUsuarioExiste" class="error" style="display:none;">Correo ingresado ya existe</p>
            </div>
            <div class="col-xs-4 form-group ">
                <label class="labelformulario" style="margin-left: -136px;"><span class="obligatorio">*</span> Código de Usuario</label>
                <input type="text" class="form-control" id="CodUser" name="CodUser" value="" placeholder="Código de Usuario"form="FormularioRegistroUsuario"  maxlength="11" onkeypress="return justNumbers(event);" oncopy="return false;" onpaste="return false;" oncut="return false;">
                <p id="errorUsuarioExiste" class="error" style="display:none;"><span id="TextoUsuarioExiste"></span></p>
            </div>
            <div class="col-xs-4 form-group ">
                <label class="labelformulario" style="margin-left: -189px;"><span class="obligatorio">*</span> Contraseña</label>
                <input type="password" class="form-control" id="password" name="password" value="" placeholder="Contraseña" form="FormularioRegistroUsuario"  maxlength="100" oncopy="return false;" onpaste="return false;" oncut="return false;">
            </div>  
        </div>
        <div class="row">
            <div class="col-xs-4 form-group">
                <label class="labelformulario" style="margin-left: -229px;"><span class="obligatorio">*</span> Perfil</label>
                <select id="perfil" name="perfil" class="form-control" form="FormularioRegistroUsuario">
                    <option value="" selected>Seleccione</option>
                    <?php foreach ($roles as $rol) {
                        echo "<option value=".$rol['CLV_ROL'].">".$rol['DESCRIPCION']."</option>";
                    } ?>

                </select>
            </div>
            <div class="col-xs-4 form-group">
                <label class="labelformulario" style="margin-left: -229px;"><span class="obligatorio">*</span> Region</label>
                <select id="regionselect" name="regionselect" class="form-control" form="FormularioRegistroUsuario"> 
                    <option value="">Seleccione</option>
                    <option value="CEN">Central</option>
                    <option value="OCC">Occidental</option>
                    <option value="OR">Oriental</option>
                </select>
            </div>
            <div class="col-xs-4 form-group">
                <label class="labelformulario" style="margin-left: -229px;"><span class="obligatorio">*</span> Estado</label>
                <select id="estadoselect" name="estadoselect" class="form-control" form="FormularioRegistroUsuario"> 
                    <option value="">Seleccione</option>
                </select>
            </div>
        </div>
        <div class="row">
            <input type="hidden" id="oficinaselect" name="oficinaselect" value="0">
            <!--<div class="col-xs-4 form-group">
                <label class="labelformulario" style="margin-left: -109px;"><span class="obligatorio">*</span> Oficina Administrativa</label>
                <select id="oficinaselect" name="oficinaselect" class="form-control" form="FormularioRegistroUsuario">
                    <option value="">Seleccione</option>
                </select>
            </div>-->
            <div class="col-xs-4 form-group">
                <label class="labelformulario" style="margin-left: -144px;"><span class="obligatorio">*</span> Dirección General</label>
                <select id="direcciongeneralselect" name="direcciongeneralselect" class="form-control" form="FormularioRegistroUsuario">
                    <option value="">Seleccione</option>
                    <?
                    foreach ($direcciones as $direcciongeneral) {
                        echo  "<option value=".$direcciongeneral['ID_DIRECCION'].">".$direcciongeneral['NOMBRE']."</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="col-xs-4 form-group">
                <label class="labelformulario" style="margin-left: -144px;"><span class="obligatorio">*</span> Dirección de Línea</label>
                <select id="direccionlineaselect" name="direccionlineaselect" class="form-control" form="FormularioRegistroUsuario">
                    <option value="">Seleccione</option>
                </select>
            </div> 
            <div class="col-xs-4 form-group">
                <label class="labelformulario" style="margin-left: -209px;"><?/*?><span class="obligatorio">*</span><?*/?> División</label>
                <select id="divisionselect" name="divisionselect" class="form-control" form="FormularioRegistroUsuario">
                    <option value="">Seleccione</option>

                </select>
            </div>          
        </div>
        <!--<input type="hidden" id="divisionselect" name="divisionselect" value="0">-->

        <hr>
        <div class="row">
            <div class="col-xs-2 col-xs-offset-4 form-group">
                <button id="RegistarButton" type="submit"  class="form-control btn btn-primary" form="FormularioRegistroUsuario">
                    <span class="glyphicon"></span>Registrar
                </button>
            </div> 
            <div class="col-xs-2 form-group">
                <button id="limpia_campos" class="form-control btn btn-primary" form="FormularioRegistroUsuario">
                    <span class="glyphicon"></span>Limpiar
                </button>
            </div>           
        </div>        
    </div>
    <!-- #################################################### TABLA DE DATOS ################################################################-->
</form>
<!-- ######################################################## FORMULARIO ################################################################-->
<!-- ####################################################################################################################################-->
<!-- #################################################### VENTANA DE CARGANDO ###########################################################-->
<div id="Cargando" style="display:none;position:fixed;z-index:100000;background:rgba(0,0,0,0.8);width:100%;height:100%;top:0;left:0;">
    <div id="error_msnced" title="Mensaje" style="z-index:10;width:600px;hight:300px;margin:auto;margin-top: 128px;background: white;" >
        <div id="titulo_msnced" style="background:#3B5998;color:white;padding:10px;margin:auto;font-size:1.4em; ">
            Por favor espere ...
            <div style="width:21px;float:right;cursor:pointer;display:none;" title="Cerrar mensaje" id="cerrar_msnced">
                <span class="glyphicon glyphicon-remove"></span>
            </div>
        </div>                                    
        <div class="mensaje_loading" style="padding:25px 25px 25px 25px;font-size:1.3em;">
            <img src="<?=$base_url;?>public_html/imagenes/484.GIF" style='width:71px;height:auto;opacity:1;'>
            <p style="margin-top:16px;margin-bottom:0px;font-weight:bold;font-size: 19px;">Cargando</p>
        </div>
    </div>
</div>
<!-- #################################################### VENTANA DE CARGANDO ###########################################################-->
<!-- ####################################################################################################################################-->
<!-- ##################################################### VENTANA DE ALERTA ############################################################-->
<div class="Alert" id="MensajeAlerta" style="margin-top: -110px;height: 750px;display:none;">
    <div class="AlertBox">
        <div class="AlertMensaje">
            <span id="TextoAlerta"></span>
        </div>          
        <button id="ButtonAlert" name="ButtonAlert" type="button" style="width: 157px;   margin-top: 18px;"  class="btn btn-warning">
            <span class=""></span>Aceptar
        </button>     
    </div>
</div>
</div>
<!-- ##################################################### VENTANA DE ALERTA ############################################################-->
<!-- ####################################################################################################################################-->
<!-- ###################################################### VENTANA DE ERROR ############################################################-->
<!---MENSAJE DE ERROR -->
<div id="mensajerror1" style="display:none;position:fixed;z-index:100000;background:rgba(0,0,0,0.8);width:100%;height:100%;top:0;left:0;">
    <div id="error1" title="Mensaje" style="display:none;z-index: 10000; width: 600px; margin: 213px auto auto; background: rgba(255, 255, 255, 0.8);" >
        <div id="titulo_error1" style="background:#3B5998;color:white;padding:10px;margin:-18% 0% 0% 0%;font-size:1.4em; ">
            Mensaje
            <div style="width:21px;float:right;cursor:pointer;" title="Cerrar mensaje" id="cerrar_error1">
                <span class="glyphicon glyphicon-remove"></span>
            </div>
        </div>                                    
        <div class="mensaje" style="padding:25px 25px 25px 25px;font-size:1.3em;">
            <span id="TextoMensaje" style="color:red;"></span>
        </div>
    </div>
</div>
<!---MENSAJE DE ERROR -->
<div id="mensajerror2" style="display:none;position:fixed;z-index:100000;background:rgba(0,0,0,0.8);width:100%;height:100%;top:0;left:0;">
    <div id="error2" title="Mensaje" style="display:none;z-index: 10000; width: 600px; margin: 213px auto auto; background: rgba(255, 255, 255, 0.8);" >
        <div id="titulo_error2" style="background:#3B5998;color:white;padding:10px;margin:-18% 0% 0% 0%;font-size:1.4em; ">
            Mensaje
            <?/*?><div style="width:21px;float:right;cursor:pointer;" title="Cerrar mensaje" id="cerrar_error1">
                <span class="glyphicon glyphicon-remove"></span>
            </div><?*/?>
        </div>                                    
        <div class="mensaje" style="padding:25px 25px 25px 25px;font-size:1.3em;">
            <span id="TextoMensaje2" style="color:red;"></span>
            <br>
            <input type="hidden" id="idactualizacion" name="idactualizacion" value="">
            <br>
            <span id="InfoTextoMensaje" style="color:black;"></span>
        </div>
        <div style="padding: 2% 0% 4% 0%;">
            <button class="btn btn-primary" id="AceptaInsert">Aceptar</button>
            <button class="btn btn-default" id="CancelarInsert">Cancelar</button>
        </div>
    </div>
</div>
<!---MENSAJE DE ERROR -->
<div id="mensajactivacion" style="display:none;position:fixed;z-index:100000;background:rgba(0,0,0,0.8);width:100%;height:100%;top:0;left:0;">
    <div id="activacion" title="Mensaje" style="display:none;z-index: 10000; width: 600px; margin: 213px auto auto; background: rgba(255, 255, 255, 0.8);" >
        <div id="titulo_activacion" style="background:#3B5998;color:white;padding:10px;margin:-18% 0% 0% 0%;font-size:1.4em; ">
            Mensaje
            <div style="width:21px;float:right;cursor:pointer;" title="Cerrar mensaje" id="cerrar_activacion">
                <span class="glyphicon glyphicon-remove"></span>
            </div>
        </div>                                    
        <div class="mensaje" style="padding:25px 25px 25px 25px;font-size:1.3em;">
            <span id="TextoActivacion" style="color:black;"></span>
        </div>
    </div>
</div>
<!---MENSAJE DE ERROR -->

<!-- ##################################################### VENTANA DE ALERTA ############################################################-->

<script src="<?=$base_url?>public_html/js/valida_login.js" type="text/javascript" charset="utf-8" async defer></script>   
<script type="text/javascript">

    $("#direcciongeneralselect").on("change",buscarDireccionLinea);
    $("#direccionlineaselect").on("change",buscarDivision);

    function buscarDireccionLinea(){
        if($("#direcciongeneralselect").val()==""){
            return 0;
        }
        else
        {
            $.ajax({
                dataType: "json",
                data: {"direcciongeneral":$("#direcciongeneralselect").val()},
                url:   '../../../resources/select/buscar.php',
                type:  'post',
                beforeSend: function(){

                },
                success: function(resp){
                    if(resp.html == false)
                    {
                        $("#direccionlineaselect").html('<option value="">Seleccione</option>')
                    }
                    else{
                        //console.log(resp.html);
                        $("#direccionlineaselect").html(resp.html);
                    }
                },
                async:false
            });
        }
    }


    function buscarDivision(){
        if($("#direccionlineaselect").val()==""){
            return 0;
        }
        else
        {
            $.ajax({
                dataType: "json",
                data: {"direccionlinea":$("#direccionlineaselect").val()},
                url:   '../../../resources/select/buscar.php',
                type:  'post',
                beforeSend: function(){

                },
                success: function(resp){
                    if(resp.html == false)
                    {
                        $("#divisionselect").html('<option value="">Seleccione</option>')
                    }
                    else{
                        //console.log(resp.html);
                        $("#divisionselect").html(resp.html);
                    }
                },
                async:false
            });
        }
    }

    $("#limpia_campos").on("click",function(){
        $("#Email").val("");
        $("#TelefHabitacionSelect").val("");
        $("#Telf_Habitacion").val("");
        $("#TelefMovilSelect").val("");
        $("#Telef_Movil").val("");
        $("#UserName").val("");
        $("#CodUser").val("");
        $("#password").val("");
        $("#perfil").val("");
        $("#regionselect").val("");
        $("#estadoselect").val("");
        $("#oficinaselect").val("");
        $("#direcciongeneralselect").val("");
        $("#direccionlineaselect").val("");
        $("#divisionselect").val("");
        $("#Email").focus();
    });

    $("#regionselect").on("change",function(){
        $.ajax({
            dataType: "json",
            data: {"regionUsers":$("#regionselect").val()},
            url:   '../../../resources/select/buscar.php',
            type:  'post',
            beforeSend: function(){

            },
            success: function(resp){
                //lo que se si el destino devuelve algo
                $("#estadoselect").html(resp.html);
                //console.log(resp.html);                    
            },
            async:false
        });
    });

    $("#CIuserlogin").on("keypress",function(e){
        Keycode = e.which;
        if (Keycode == 13){
            e.preventDefault();
            $("#ButtonLogin").click();
        }
    })

    $("#ButtonLogin").on("click",function(e){
        e.preventDefault();
        if(document.getElementById('CIuserlogin').value==""){
            /* ------ Ha ocurrido un error El usuario aun no insertado una cedula mandamos el mensaje de alerta ------*/
            $("#TextoMensaje").text("Ingrese una cédula para poder continuar");
            $("#TextoMensaje").css("color","red");
            $("#mensajerror1").fadeIn("slow");
            $("#error1").fadeIn('slow');
        } else if (document.getElementById("NacionalidadSelect").value == "") {
            /* ------ Ha ocurrido un error El usuario aun no seleccionado una nacionalidad una cedula mandamos el mensaje de alerta ------*/
            $("#TextoMensaje").text("Por favor seleccione una nacionalidad");
            $("#TextoMensaje").css("color","red");
            $("#mensajerror1").fadeIn("slow");
            $("#error1").fadeIn('slow');
        } else {
            var EstatusUsuario = false;
            $.ajax({
                dataType:   "json",
                data:       {"option":"buscarUserInsert","id":$("#CIuserlogin").val()},
                url:        'Controllers/Controller.Users.php',
                type:       'post',
                beforeSend:function(){

                },success:function(resp){
                    if (resp == false){
                        buscarNewUser();
                    } else {
                        var Activo = resp.INT_BORRADO;
                        if (resp.INT_BORRADO == 1){
                            //EL USUARIO EXISTE PERO ESTA INACTIVO
                            $("#TextoMensaje2").text("El usuario" + " " + $("#NacionalidadSelect").val()+$("#CIuserlogin").val() + " se encuentra registrado con estatus inactivo");
                            $("#InfoTextoMensaje").text("¿Desea activar nuevamente este usuario al sistema?")
                            $("#idactualizacion").val($("#CIuserlogin").val());
                            $("#NacionalidadSelect").val("");
                            $("#CIuserlogin").val("");
                            $("#mensajerror2").fadeIn("slow");
                            $("#error2").fadeIn('slow');                            
                        } else {
                            //EL USUARIO EXISTE Y ESTA ACTIVO
                            $("#TextoMensaje").text("El usuario" + " " + $("#NacionalidadSelect").val()+$("#CIuserlogin").val() + " ya esta registrado en el sistema");
                            $("#NacionalidadSelect").val("")
                            $("#CIuserlogin").val("");
                            $("#mensajerror1").fadeIn("slow");
                            $("#error1").fadeIn('slow');                            
                        }
                    }
                },error:function(){
                    console.log("error");
                }
            });
} //fin del else
});

/*----------------------------- EL CIUDADANO NO --------------------------------------*/
function buscarNewUser(){
    $.ajax({
        dataType: "json",
        data: {"nac_apo": $("#NacionalidadSelect").val(), "id_apo":$("#CIuserlogin").val()},
        url:   '../../../resources/select/buscar.php',
        type:  'post',

        beforeSend: function(){
                    //Lo que se hace antes de enviar el formulario
                    $("#Cargando").css("display","");                    
                },
                success: function(respuesta){
                    //lo que se si el destino devuelve algo
                    $("#Cargando").css("display","none");
                    if (respuesta.nombre != false){
                        $("#NombreUser").val(respuesta.nombre);
                        $("#ApellidoUser").val(respuesta.apellido);
                        $("#Cedula").val($("#NacionalidadSelect").val()+$("#CIuserlogin").val());
                        $("#Telf_Habitacion").val(respuesta.telhab);
                        $("#Telef_Movil").val(respuesta.telmov);
                        $("#loginbackground").css("display","none");
                        $("#FormularioRegistroUsuario").css("display","");
                        $("#TablaFormulario").css("display","");
                        
                    } else {
                        $("#TextoMensaje").css("color","red");
                        $("#TextoMensaje").text("El ciudadano" + " " + $("#NacionalidadSelect").val()+$("#CIuserlogin").val() + " no se encuentra registrado en el IVSS");
                        $("#mensajerror1").fadeIn("slow");
                        $("#error1").fadeIn('slow');
                        $("#CIuserlogin").val("");
                    }
                    window.ExisteCorreoUsuario  = false;
                    window.ExisteUsuario        = false;
                    window.TelefonoHabitacion   = false;
                    window.TelefonoMovil   = false;                    
                    $("#errorCorreoUsuarioExiste").css("display","none");
                    $("#errorUsuarioExiste").css("display","none");
                },
                error:  function(xhr,err){ 
                    alert("readyState: "+xhr.readyState+"\nstatus: "+xhr.status+"\n \n responseText: "+xhr.responseText);
                }
            }).done(function(){

            });
        }
        /*--------------------------------------------------------------------*/

        $("#ButtonAlert").on("click",function(){
            $("#MensajeAlerta").fadeOut();
        });

        $("#cerrar_error1").click(function(){
            $("#mensajerror1").slideUp( "slow" );
        });

        $("#cerrar_activacion").click(function(){
            $("#mensajactivacion").slideUp("slow");
        })
        /* -------------------------------------*/
        $("#AceptaInsert").click(function(){
            $("#mensajerror2").slideUp( "slow" );
            $.ajax({
                /*dataType: "json",*/
                data: {option:"reingreso",CodUser:$("#idactualizacion").val()},
                url:   'Controllers/Controller.Users.php',
                type:  'POST',
                beforeSend: function(){
                },
                success: function(respuesta){
                    if(respuesta ==1)
                    {
                        $("#TextoActivacion").text("Usuario activado satisfactoriamente");
                    }
                    else{
                        $("#TextoActivacion").text("Error: No se pudo activar el usuario");
                    }
                    $("#activacion").fadeIn();
                    $("#mensajactivacion").fadeIn();
                },  
                error:  function(xhr,err){

                },
            }).done(function(){
            });
        });
        /* -------------------------------------*/
        $("#CancelarInsert").click(function(){
            $("#mensajerror2").slideUp( "slow" );
        });
        /* -------------------------------------*/

        $("#Telf_Habitacion").on("blur",function(){
            if($("#Telf_Habitacion").val().length < 7){
                $("#errorTelefonoHabitacion").css("display","")
                TelefonoHabitacion  = false;
        //TelefonoMovil       = true;
    } else {
      $("#errorTelefonoHabitacion").css("display","none")
      TelefonoHabitacion  = true;
  }
})

        $("#Telef_Movil").on("blur",function(){
            if($("#Telef_Movil").val().length < 7){
                $("#errorTelefonoMovil").css("display","")
                TelefonoMovil       = false;
            } else {
                $("#errorTelefonoMovil").css("display","none")
                TelefonoMovil       = true;
            }
        })

        $("#Telf_Habitacion").on("keypress",function(){
            $("#errorTelefonoHabitacion").css("display","none");
        })

        $("#Telef_Movil").on("keypress",function(){
            $("#errorTelefonoMovil").css("display","none");
        })

        function justNumbers(e){
            var keynum = window.event ? window.event.keyCode : e.which;
        //if (keynum == 13)
             //$("#ButtonLogin").click;
             if ((keynum == 8) || (keynum == 46))
                return true;
            return /\d/.test(String.fromCharCode(keynum));        
        }
        /* ------------------------------------ VALIDAR FORMULARIO ---------------------------------------- */
        $("#UserName").on("click",function(){
            $("#errorCorreoUsuarioExiste").css("display","none");
        });

        $("#UserName").on("blur",function(){
            $("#errorCorreoUsuarioExiste").css("display","none");
            $.ajax({
                dataType: "json",
                data: {option:"validarEmail",UserName:$("#UserName").val()},
                url:   'Controllers/Controller.Users.php',
                type:  'POST',
                beforeSend: function(){
                },
                success: function(resp){
                    /*console.log(resp);*/
                    var respuesta = resp;
                    if (respuesta == "invalido"){
                    //El correo ingresado por el usuario es invalido
                    $("#errorCorreoUsuarioExiste").css("display","");
                    ExisteCorreoUsuario = false;
                } else {
                    //El correo ingresado por el usuario es valido
                    ExisteCorreoUsuario = true;
                }
            },  
            error:  function(xhr,err){ 
            },
        }).done(function(){
            $("#option").val("registro");
        });
    })

$("#CodUser").on("keypress",function(){
    $("#errorUsuarioExiste").css("display","none");
});
$("#CodUser").on("blur",function(){
    if ($("#CodUser").val().length < 11){
        $("#TextoUsuarioExiste").text("El código debe ser 11 dígitos numéricos");
        $("#errorUsuarioExiste").css("display","");
        ExisteUsuario = false;
    } else {
        $("#errorUsuarioExiste").css("display","none");
        $.ajax({
            dataType: "json",
            data: {option:"validarCodUser",CodUser:$("#CodUser").val()},
            url:   'Controllers/Controller.Users.php',
            type:  'POST',
            beforeSend: function(){
            },
            success: function(resp){
                /*console.log(resp);*/
                var respuesta = resp;
                if (respuesta == "invalido"){
                        //El correo ingresado por el usuario es invalido
                        $("#TextoUsuarioExiste").text("Codigo de usuario ingresado ya existe");
                        $("#errorUsuarioExiste").css("display","");
                        ExisteUsuario = false;
                    } else {
                        //El correo ingresado por el usuario es valido
                        ExisteUsuario = true;
                    }
                },  
                error:  function(xhr,err){ 
                },
            }).done(function(){
                $("#option").val("registro");
            });
        }
    })
$(function(){           
    $("#FormularioRegistroUsuario").validate({
        rules:{
            UserName:{
                required:  true,
                //email: true,
                minlength: 5,
            },CodUser:{
                required:  true,
            },
            password:{
                required:  true,
                minlength: 6
            },
            Email:{
                required:  true,
                email :    true
            },
            perfil:{
                required:        true,
                valueNotEquals: ""
            },
            regionselect:{
                required:        true,
                valueNotEquals: ""                    
            },
            estadoselect:{
                required:        true,
                valueNotEquals: ""
            },
            oficinaselect:{
                required:        true,
                valueNotEquals: ""
            },
            direcciongeneralselect:{
                required:        true,
                valueNotEquals: ""
            },
            direccionlineaselect:{
                required:        true,
                valueNotEquals: ""
            }/*,
            divisionselect:{
                required:        true,
                valueNotEquals: ""
            }*/
        },
        messages:{
            UserName:{
                required:   "Este campo es requerido",
                minlength:  "Mínimo 5 caracteres"
                //email:      "Introduzca un formato de email válido"
            },
            CodUser:{
                required:    "Este campo es requerido",
            },
            password:{
                required:  "Este campo es requerido",
                minlength: "Mínimo 6 caracteres"
            },
            Email:{
                required: "Este campo es requerido",
                email :   "Introduzca un formato de email válido",
            },
            perfil:{
                required:  "Este campo es requerido"
            },
            regionselect:{
                required:  "Este campo es requerido"
            },
            estadoselect:{
                required:  "Este campo es requerido"
            },
            oficinaselet:{
                required:  "Este campo es requerido"
            },
            direcciongeneralselect:{
                required:  "Este campo es requerido"
            },
            direccionlineaselect:{
                required:  "Este campo es requerido"
            }/*,
            divisionselect:{
                required:  "Este campo es requerido"
            }*/
        },submitHandler: function(form,event) {
            if (ExisteCorreoUsuario != false){
                if (ExisteUsuario != false){
                    if(TelefonoHabitacion != false){
                        if(TelefonoMovil != false){
                            form.submit();
                        } else {
                            event.preventDefault();
                        }
                    } else {
                        event.preventDefault();
                    }                    
                } else {
                    event.preventDefault();
                }
            } else {
                event.preventDefault();
            }
        }
    });
});

$("#FormularioRegistroUsuario").on("submit",function(e){
    e.preventDefault();
});

$.validator.addMethod("valueNotEquals", function(value, element, arg){
  return arg != value;
}, "Value must not equal arg.");
</script>     
</body>
</html>    


