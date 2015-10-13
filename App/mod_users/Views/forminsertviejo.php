<?php 

require('../../../resources/restrictedaccess.php');
include("../../../resources/select/funciones.php");
include("../../../App/config/config.php");


$codTelefono = dameCodigosTelefono();
$estados = dameEstado();
$direcciones = dameDirecciones();
?>

<style type="text/css">
    input, textarea, select{ 
        padding: 9px;
        height: 30px;
        border: solid 1px #E5E5E5; 
        outline: 0; 
        font: normal 13px/100% Verdana, Tahoma, sans-serif; 
        width: 200px; 
        background: #FFFFFF url('bg_form.png') left top repeat-x; 
        background: -webkit-gradient(linear, left top, left 25, from(#FFFFFF), color-stop(4%, #EEEEEE), to(#FFFFFF)); 
        background: -moz-linear-gradient(top, #FFFFFF, #EEEEEE 1px, #FFFFFF 25px); 
        box-shadow: rgba(0,0,0, 0.1) 0px 0px 8px; 
        -moz-box-shadow: rgba(0,0,0, 0.1) 0px 0px 8px; 
        -webkit-box-shadow: rgba(0,0,0, 0.1) 0px 0px 8px; 
    } 
    select,input{
        padding: 0% 3%;
        border: solid 1px rgba(219, 219, 219, 0.99);
        margin: 7px;
        /*width: 100% !important;*/
    }
    option{
        background:white;
    }

    .inputleft{
        /*width: 100% !important;*/
        width: 300px !important;
    }

    .inputright{
        /*width: 80% !important;*/
        width: 300px !important;
    }
    
    textarea { 
        width: 400px; 
        max-width: 400px; 
        height: 150px; 
        line-height: 150%; 
    } 
    
    input:hover, textarea:hover, select:hover,
    input:focus, textarea:focus, select:focus
    { 
        border-color: #C9C9C9; 
        -webkit-box-shadow: rgba(76, 133, 255, 0.73) 0px 0px 8px; 
    }
    .form {
        background: #f1f1f1;
        margin-bottom: 7%;
        height: auto;
    }

    .form  h1{

        
        background: #3B5998;
        padding: 11px;
        color: white;
        font-size: 23px;
        font-family: arial;
        margin-bottom: 20px;
    }
    
    .LabelForm { font-size: 89%;color: rgba(0, 0, 0, 0.7);}
    .form hr{
        background-color: rgb(177, 177, 177);
        height: 1px;
        margin-top: 5px;
        float: left;
    }
    .form button{
        height: 30px;
    } 
    .form .separador label{

        font-family: Arial;
        font-size: 103%;
        border: solid 3px rgb(95, 148, 195);
        margin: 0% 80% 0% 0%;
        padding: 0.5% 1.0% 0.5% 1%;
        border-radius: 30px;
        background-color: #E7E5E5;

    }

    .form .separador hr{

        margin-top: -2.3%;
        margin-bottom: 10px;
        width: 77%;
        margin-left: 19%;
        height: 0.14em;
        background: #538ec2;
        background: -moz-linear-gradient(left, #538ec2 0%, #f1f1f1 100%, #f1f1f1 100%, #f1f1f1 100%);
        background: -webkit-gradient(linear, left top, right top, color-stop(0%,#538ec2), color-stop(100%,#f1f1f1), color-stop(100%,#f1f1f1), color-stop(100%,#f1f1f1));
        background: -webkit-linear-gradient(left, #538ec2 0%,#f1f1f1 100%,#f1f1f1 100%,#f1f1f1 100%);
        background: -o-linear-gradient(left, #538ec2 0%,#f1f1f1 100%,#f1f1f1 100%,#f1f1f1 100%);
        background: -ms-linear-gradient(left, #538ec2 0%,#f1f1f1 100%,#f1f1f1 100%,#f1f1f1 100%);
        background: linear-gradient(to right, #538ec2 0%,#f1f1f1 100%,#f1f1f1 100%,#f1f1f1 100%);
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#538ec2', endColorstr='#f1f1f1',GradientType=1 );
    }

    .submit input { 
        width: auto; 
        padding: 9px 15px; 
        background: #617798; 
        border: 0; 
        font-size: 14px; 
        color: #FFFFFF; 
        -moz-border-radius: 5px; 
        -webkit-border-radius: 5px; 
    }
    td {
        text-align: right;
    }
    .loginbox{
        background:#3B5998;
        height: 59%;
        width: 39%;
        margin: 7% 0% 0% 32%;
        box-shadow: 8px 8px 7px 2px #ccc;
        border-radius: 11% 4%;
        padding: 16px;
    }
    .loginbackground{
    /*position: absolute;
    width: 101%;
    height: 500px;
    background: rgba(0,0,0,0.5);
    margin-top: 0;
    z-index: 2;
    margin-left: -1%;*/
}


.login-message{
    font-family: arial;
    font-size: 20px;
    color: white;
    padding: 13% 0% 1% 0%;
}

.volverBotones{
    position: relative;
    z-index: 2;
}

.Alert{

    position: absolute;
    width: 99.1%;
    height: 88.1%;
    margin-top: -5.8%;
    z-index: 2;
}

.AlertBox{
  background: white;
  height: 26%;
  width: 45%;
  margin: 16% 0% 14% 27%;
  box-shadow: 2px 3px 7px 2px #ccc;
  border-radius: 20px;
}

.AlertBoxCargando{
    background: #3B5998;
    border-radius:0px;
    box-shadow: 3px 3px 1px 7px #f1f1f1;
    height: 70%;
    width: 60%;
    position: absolute;
    bottom:380px;
    left:200px;
}
.titulo{
    background:#3B5998;
    padding:25px;
    color: white;
    font-size:1.3em;
    text-align:center;
}
.AlertMensaje{

    font-family: arial;
    font-size: 20px;
    color: black;
    padding: 13% 0% 1% 0%;
}

.DivImagen{
    margin-top: -44%;
    opacity: 1;
    position: relative;
}
.obligatorio{
    color:red;
    /*margin-right: 0.4%;*/
    width: 100px;
    margin-left: -1px;
}
.error {
    color: red;
    font-size: 0.8em;
    font-weight: normal;
    padding: 0% 2% 0% 1%;
}

select .error{
    color:black!important;
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
    <div id="loginbackground" class="loginbackground">
        <div class="login-message">
        <fieldset class="fieldset" style="border-radius:0px;background:#3B5998; margin-top: -93px;">
            <h3 style="color:white;margin:auto;font-size: 1.0em;">Registrar Usuario</h3>
            <hr>
            <div class="form-group persona" id="persona" style="display: block;">
                <label for="nacionalidad" style="margin-left: 69px;display:block;font-size: 13px;float:left;width:150px;margin-right: -67px;">Nacionalidad</label>
                <label for="nacionalidad" style="display:block;font-size: 13px;float:left;width:150px;">Cédula</label>
                <div style="clear:both;"></div>
                <select id="NacionalidadSelect" name="nac_apo" class="form-control" required="" style="width: 115px !important;font-size: 12px !important;height: 29px;margin: 0px 0px 7px 73px;" form="FormularioRegistroUsuario">
                    <option value="" selected="">Seleccione</option>
                    <option value="V">V</option>
                    <option value="E">E</option>
                    <option value="T">T</option>
                </select>  
                <input type="text" id="CIuserlogin" name="id_apo" class="form-control input-sm" placeholder="Ingrese cédula aquí" maxlength="8" required="" form="FormularioRegistroUsuario" style="width: 179px !important;float: left;margin: -36px 0px 0px 204px;height: 29px;font-size: 12px!important;">
                <div class="form-group elementoform" id="botones_pernat">
                    <input type="submit" id="ButtonLogin" name="ButtonLogin"class="btn btn-default" value="Consultar" style="width: 98px;margin: 6px -11px -25px 0px;padding: 0;height: 29px;font-size: 12px;">
                </div>    
            </div><!-- FIN consultar Ciudadano-->
            <div id="mostrar"></div>
        </fieldset>
        </div> 
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
    <!---ALERTA MODAL -->
    <!---MENSAJE DE ERROR -->
    <div id="mensajerror1" style="display:none;position:fixed;z-index:100000;background:rgba(0,0,0,0.8);width:100%;height:100%;top:0;left:0;">
        <div id="error1" title="Mensaje" style="display:none;z-index: 10000; width: 600px; margin: 213px auto auto; background: rgba(255, 255, 255, 0.8);" >
            <div id="titulo_error1" style="background:#3B5998;color:white;padding:10px;margin:auto;font-size:1.4em; ">
                Mensaje
                <div style="width:21px;float:right;cursor:pointer;" title="Cerrar mensaje" id="cerrar_error1">
                    <span class="glyphicon glyphicon-remove"></span>
                </div>
            </div>                                    
            <div class="mensaje" style="padding:25px 25px 25px 25px;font-size:1.3em;">
                <span id="TextoMensaje"></span>
            </div>
        </div>
    </div>
    <!---MENSAJE DE ERROR -->
    <form name="FormularioRegistroUsuario" id="FormularioRegistroUsuario" class="form" action="Controllers/Controller.Users.php" method="post" style="display:none;margin: 0px 0px 88px -85px !important;width: 1051px;margin-top: 4px;">
        <input type="hidden" id="option" name="option" value="registro">    
        <h1 style="font-size: 1.5em;">Registrar Usuario</h1>
        <span class="obligatorio" style="margin-left: -850px;">*</span><span>Datos Obligatorios</span>    

        <!--  ////////////////////////////////////PANTALLA DE DATOS DEL USUARIO/////////////////////////////////////////////  -->
        <center>
            <table>
                <tr>
                    <th colspan="4" style="padding: 0% 0% 2% 0%;">
                        <div class="separador">
                            <h2 style="background:#3B5998;color:white;padding:7px;text-align: left;font-size: 1.2em;">Datos Personales</h2>
                        </div>
                    </th>
                </tr>      
                <tr>
                    <td>
                        <label class="LabelForm">Nombre</label>
                        <input type="text" id="NombreUser" name="NombreUser" class="inputleft" readonly="">
                    </td>
                    <td>
                        <label class="LabelForm">Apellido</label>
                        <input id="ApellidoUser" name="ApellidoUser" type="text" class="inputright" readonly="">
                    </td>
                </tr>
                <tr>
                    <td>
                        <label class="LabelForm">Cédula</label>
                        <input id="Cedula" name="Cedula" type="text" class="inputleft" readonly="">
                    </td>
                    <td>
                        <span class="obligatorio">*</span>
                        <label id="EmailLabel" class="LabelForm">Correo Electrónico</label>
                        <input id="Email" name="Email" type="text" class="inputright" maxlength="100"  pattern="^[_a-zA-Z0-9-]+(\.[_a-zA-Z0-9-]+)*@[a-zA-Z0-9-]+(\.[a-zA-Z0-9-]+)*(\.[a-zA-Z]{2,3})$" title="ingrese un email válido" placeholder="ejemplo: correo@correo.com" oncopy="return false;" onpaste="return false;" oncut="return false;">
                    </td>
                </tr>
                <tr>
                    <td>
                        <label class="LabelForm" style="float: left;margin-left: 31px;margin-top: 10px;">Teléfono de Habitación</label>
                        <select name="TelefHabitacionSelect" id="TelefHabitacionSelect" style="width: 96px !important;float: left;margin-top: 5px;">
                            <option value="">Seleccione</option>
                            <? 
                            foreach ($codTelefono as $TelefonoCodigo) {
                               echo "<option value=".$TelefonoCodigo['CODIGO_AREA'].">".$TelefonoCodigo['CODIGO_AREA']."</option>";
                           }
                           ?>
                       </select>
                       <input id="Telf_Habitacion" name="Telf_Habitacion" type="text" class="inputleft" onkeypress="return justNumbers(event);" maxlength="7" placeholder="ejemplo: 1234567" style="width: 191px !important;" oncopy="return false;" onpaste="return false;" oncut="return false;">
                   </td>
                   <td>
                    <label style="float: left;margin-left: 53px;margin-top: 10px;" class="LabelForm">Teléfono Móvil</label>
                    <select name="TelefMovilSelect" id="TelefMovilSelect" style="width: 96px !important;float: left;margin-top: 5px;">
                        <option value="">Seleccione</option>
                        <option value="0414">0414</option>
                        <option value="0424">0424</option>
                        <option value="0416">0416</option>
                        <option value="0416">0426</option>
                        <option value="0412">0412</option>
                    </select>
                    <input id="Telef_Movil" name="Telef_Movil" type="text" class="inputright" onkeypress="return justNumbers(event);" maxlength="7" placeholder="ejemplo: 1234567" style="width: 191px !important;" oncopy="return false;" onpaste="return false;" oncut="return false;">
                </td>
            </tr>
            <tr>
                <th colspan="4" style="padding: 0% 0% 2% 0%;">
                    <div class="separador">
                        <h2 style="background:#3B5998;color:white;padding:7px;text-align: left;font-size: 1.2em;">Datos de Usuario</h2>
                    </div>
                </th>
            </tr>
            <tr>
                <td>
                    <span class="obligatorio">*</span>
                    <label id="UsuarioLabel" class="LabelForm">Usuario</label>
                    <input name="UserName" id="UserName" type="text" class="inputleft" maxlength="100" oncopy="return false;" onpaste="return false;" oncut="return false;">
                    <p id="errorCorreoUsuarioExiste" class="error" style="display:none;">Correo ingresado ya existe</p>
                </td>
                <td>
                    <span class="obligatorio" style="width: 100px;margin-left: -1px;">*</span>
                    <label id="CodUserLabel" class="LabelForm">Código del Usuario</label>
                    <input name="CodUser" id="CodUser" type="text" class="inputright" maxlength="11" onkeypress="return justNumbers(event);" oncopy="return false;" onpaste="return false;" oncut="return false;">
                    <p id="errorUsuarioExiste" class="error" style="display:none;">Codigo de usuario ingresado ya existe</p>
                </td>
            </tr>
            <tr>
                <td>
                    <span class="obligatorio">*</span>
                    <label id="PasswordLabel" class="LabelForm">Contraseña</label>
                    <input name="password" id="password" type="password" class="inputleft" maxlength="100" oncopy="return false;" onpaste="return false;" oncut="return false;">
                </td>
                <td>
                    <span class="obligatorio">*</span>
                    <label id="PerfilLabel" class="LabelForm">Perfil</label>
                    <select id="perfil" name="perfil" class="inputright">
                        <option value="" selected="selected" name="opcdef" >Seleccione</option>
                        <option value="1">Administrador</option>
                        <option value="2">Analista</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td><span class="obligatorio">*</span><label id="RegionLabel" class="LabelForm">Región</label>
                    <select id="regionselect" name="regionselect" class="inputleft"> 
                        <option value="">Seleccione</option>
                        <option value="CEN">Central</option>
                        <option value="OCC">Occidental</option>
                        <option value="OR">Oriental</option>
                    </select>
                </td>
                <td><span class="obligatorio">*</span><label id="EstadoLabel" class="LabelForm">Estado</label>                
                    <select id="estadoselect" name="estadoselect" class="inputright"> 
                        <option value="">Seleccione</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>
                    <span class="obligatorio">*</span>
                    <label style="margin-left: -1%;" id="OfiAdminLabel" class="LabelForm">Oficina Administrativa</label>
                    <select id="oficinaselect" name="oficinaselect" class="inputleft">
                        <option value="">Seleccione</option>
                    </select>
                </td>
                <td>
                    <span class="obligatorio">*</span>
                    <label id="DirGenLabel" class="LabelForm">Dirección General</label>
                    <select id="direcciongeneralselect" name="direcciongeneralselect" class="inputright">
                        <option value="">Seleccione</option>
                        <?
                        foreach ($direcciones as $direcciongeneral) {
                            echo  "<option value=".$direcciongeneral['ID_DIRECCION'].">".$direcciongeneral['NOMBRE']."</option>";
                        }
                        ?>
                    </select>
                </td>                
            </tr>
            <tr>
                <td>
                    <span class="obligatorio">*</span>
                    <label id="DirecLineaLabel" class="LabelForm">Dirección de Línea</label>
                    <select id="direccionlineaselect" name="direccionlineaselect" class="inputleft">
                        <option value="">Seleccione</option>
                        <option value="1">Dirección de Apoyo Técnico Administrativo</option>
                        <option value="2">Direcciones de Fiscalización Región Oriente</option>
                        <option value="3">Direcciones de Fiscalización Región Occidente</option>
                    </select>
                </td>
                <td>
                    <span class="obligatorio">*</span>
                    <label id="DivisionLabel" class="LabelForm">División</label>                
                    <select id="divisionselect" name="divisionselect" class="inputright">
                        <option value="">Seleccione</option>
                        <option value="1">División de Atención al Denunciante</option>
                        <option value="2">División de Conformación y Sustanciación de Expedientes Administrativos</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td colspan="4" style="text-align: center;">
                    <button id="RegistarButton" type="submit"  class="btn btn-primary" style="margin-bottom: 20px;margin-top: 20px;padding: 0px 10px 0px 10px;">
                        <span class="glyphicon"></span>Registrar
                    </button>
                    <button id="limpia_campos" type="reset" style="padding: 0px 10px 0px 10px;"  class="btn btn-primary">
                        <span class="glyphicon"></span>Limpiar
                    </button>                    
                </td>
            </tr>
        </table>
        <!--  ////////////////////////////////////PANTALLA DE DATOS DEL USUARIO/////////////////////////////////////////////  -->    
    </form> 
    <script src="<?=$base_url?>public_html/js/valida_login.js" type="text/javascript" charset="utf-8" async defer></script>   
    <script type="text/javascript">
    $( document ).ready(function(){
        window.ExisteCorreoUsuario = false;
        window.ExisteUsuario       = false;
        alert(ExisteCorreoUsuario)
    })

        $("#limpia_campos").on("click",function(){
            $("#loginbackground").css("display","");
            $("#FormularioRegistroUsuario").css("display","none");
        });

        $("#regionselect").on("change",function(){
            $.ajax({
                dataType: "json",
                data: {"region":$("#regionselect").val()},
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

        $("#estadoselect").on("change", buscarOficina);
        function buscarOficina()
        {
            $("#oficinaselect").html("<option value=''>Seleccione</option>");        
            $estado = $("#estadoselect").val();        
            if($estado == ""){
                $("#oficinaselect").html("<option value=''>Seleccione</option>");
            }
            else {
                $.ajax({
                    dataType: "json",
                    data: {"primera_letra": $estado},
                    url:   '../../../resources/select/buscar.php',
                    type:  'post',
                    beforeSend: function(){
                    //Lo que se hace antes de enviar el formulario
                },
                success: function(respuesta){
                    //lo que se si el destino devuelve algo
                    $("#oficinaselect").html(respuesta.html);
                },
                error:  function(xhr,err){ 
                    //alert("readyState: "+xhr.readyState+"\nstatus: "+xhr.status+"\n \n responseText: "+xhr.responseText);
                }
            });
            }
        }

$("#CIuserlogin").on("keypress",function(e){
    //alert("hola")
    Keycode = e.which;
    if (Keycode == 13){
        e.preventDefault();
        $("#ButtonLogin").click();
    }
})
$("#ButtonLogin").on("click",function(e){
    e.preventDefault();
    var EnviarMensaje = false;
    if(document.getElementById('CIuserlogin').value=="")
    {
        /* ------ Ha ocurrido un error El usuario aun no insertado una cedula mandamos el mensaje de alerta ------*/
        $("#TextoMensaje").text("Ingrese una cédula para poder continuar");
        $("#TextoMensaje").css("color","red");
        $("#mensajerror1").fadeIn("slow");
        $("#error1").fadeIn('slow');
        EnviarMensaje = true;
    } else if (document.getElementById("NacionalidadSelect").value == "") {
         /* ------ Ha ocurrido un error El usuario aun no insertado una cedula mandamos el mensaje de alerta ------*/
        $("#TextoMensaje").text("Por favor seleccione una nacionalidad");
        $("#TextoMensaje").css("color","red");
        $("#mensajerror1").fadeIn("slow");
        $("#error1").fadeIn('slow');
        EnviarMensaje = true;
    } else {
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
                        if (respuesta.usuario == false){
                            $("#NombreUser").val(respuesta.nombre);
                            $("#ApellidoUser").val(respuesta.apellido);
                            $("#Cedula").val($("#NacionalidadSelect").val()+$("#CIuserlogin").val());
                            $("#Telf_Habitacion").val(respuesta.telhab);
                            $("#Telef_Movil").val(respuesta.telmov);
                            $(".loginbackground").css("display","none");
                            $("#FormularioRegistroUsuario").css("display","");
                        } else {
                            $("#TextoMensaje").text("El usuario" + " " + $("#NacionalidadSelect").val()+$("#CIuserlogin").val() + " ya esta registrado en el sistema");
                            $("#CIuserlogin").val("");
                            $("#mensajerror1").fadeIn("slow");
                            $("#error1").fadeIn('slow');
                        }
                    } else {
                        $("#TextoMensaje").text("El ciudadano" + " " + $("#NacionalidadSelect").val()+$("#CIuserlogin").val() + " no existe");
                        $("#mensajerror1").fadeIn("slow");
                        $("#error1").fadeIn('slow');
                        $("#CIuserlogin").val("");
                    }
                    window.ExisteCorreoUsuario = false;
                    window.ExisteUsuario       = false;
                    $("#errorCorreoUsuarioExiste").css("display","none");
                    $("#errorUsuarioExiste").css("display","none");
                },
                error:  function(xhr,err){ 
                    alert("readyState: "+xhr.readyState+"\nstatus: "+xhr.status+"\n \n responseText: "+xhr.responseText);
                }
            }).done(function(){

            });
        }
        if(EnviarMensaje != false){
           /*$("#MensajeAlerta").fadeIn();*/
       }
   });

$("#ButtonAlert").on("click",function(){
    $("#MensajeAlerta").fadeOut();
});

$("#cerrar_error1").click(function(){
    $("#error1").slideUp('slow');
    $("#mensajerror1").slideUp( "slow" );
});

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
        /*alert($("#UserName").val())*/
        /*$("#option").val("validarEmail");*/
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

    $("#CodUser").on("blur",function(){
        /*alert($("#UserName").val())*/
        /*$("#option").val("validarEmail");*/
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
    })
$(function(){           
    $("#FormularioRegistroUsuario").validate({
        rules:{
            UserName:{
                required:  true,
                email: true,
            },CodUser:{
                required:  true,
                minlength: 5
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
            },
            divisionselect:{
                required:        true,
                valueNotEquals: ""
            }
        },
        messages:{
            UserName:{
                required:   "Este campo es requerido",
                email:      "Este campo es un email"
            },
            CodUser:{
                required:    "Este campo es requerido",
                minlength:   "Mínimo 5 caracteres"
            },
            password:{
                required:  "Este campo es requerido",
                minlength: "Mínimo 6 caracteres"
            },
            Email:{
                required: "Este campo es requerido",
                email :   "Formato correo@correo.com",
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
            },
            divisionselect:{
                required:  "Este campo es requerido"
            }
        },submitHandler: function(form,event) {
            if (ExisteCorreoUsuario != false){
                if (ExisteUsuario != false){
                    form.submit();                         
                }
                else{
                    event.preventDefault();
                }
            }
            else{event.preventDefault();
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


