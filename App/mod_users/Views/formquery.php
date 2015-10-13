<?php 

require('../../../resources/restrictedaccess.php');
include("../../../resources/select/funciones.php");
include("../../../App/config/config.php");


$codTelefono = dameCodigosTelefono();
$estados = dameEstado();
$direcciones = dameDirecciones();
$roles = dameRoles();
?>


<style>
    .Resaltar{
        text-align: left;
        font-size: 0.9em;
        font-weight: bold;
        text-decoration: initial;
        margin-left: 14px;
    }
    hr{
        border-top: 1px solid #9A9A9A;
    }
    label{
        color: black;
        font-size: 0.8em;
    }
    .popover{
        width:500px;
        font-weight: normal;
    }
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
    .table td{
        text-align: center;
    }
    .table th{
        text-align: center !important;
    }

    @media screen and (min-width:900px) and (max-width: 1100px) {
        .container{
            width: 880px !important;
        }
    }
    .LabelText{
        display: block;
        text-align: left;
    }

</style>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script type="text/jscript" src="<?=$base_url;?>public_html/js/jquery-2.1.4.min.js"></script>
    <script type="text/javascript" src="../../public_html/js/valida_login.js"></script> 
    <script type="text/javascript" src="<?=$base_url;?>/public_html/vendor/jQueryValidation/dist/jquery.validate.js"></script>
    <title></title>
    <!--<link href="../../public_html/css/formularios.css" rel="stylesheet"/>-->
</head>
<body>

    <!--######################################################################################################################################-->
    <!--###################################################### VENTANA CONSULTAR USUARIO #####################################################-->
    <!--######################################################################################################################################-->
    <div class="login-message" id="ConsultarUser" style="/*display:none;*/">
        <fieldset class="fieldset" style="border-radius:0px;background:#3B5998; margin: 1% 0% 0% 21%;">
            <h3 style="color:white;margin: 1% 0% 0% 25%;font-size: 1.2em;" class="Resaltar">Consultar Usuario</h3>
            <hr>
            <div class="form-group persona" id="persona" style="display: block;">
                <label style="margin: 0% 0% 0% -5%;display:block;font-size: 13px;float:left;width:150px;color:white;">Nacionalidad</label>
                <label style="display:block;font-size: 13px;float:left;width:150px;color:white;">Cédula</label>
                <div style="clear:both;"></div>
                <select id="NacionalidadSelect" name="nac_apo" class="form-control" required="" style="width: 115px !important;font-size: 12px !important;height: 29px;margin: 1% 0% 2% -1%;">
                    <option value="" selected="">Seleccione</option>
                    <option value="V">V</option>
                    <option value="E">E</option>
                    <option value="T">T</option>
                </select>  
                <input type="text" id="cedula" name="cedula" class="form-control input-sm" placeholder="Ingrese cédula aquí" maxlength="8" required="" style="width: 179px !important;float: left;margin: -9.3% 0% 0% 30%;height: 29px;font-size: 12px!important;padding-left: 2.5%;">
                <input type="button" id="consultarUser" name="consultarUser" class="btn btn-default" value="Consultar" style="width: 98px;margin: -17.8% -79% 0% 0%;padding: 0;height: 29px;font-size: 12px;">
            </div>
        </fieldset>
    </div> 
    <!--######################################################################################################################################-->
    <!--###################################################### VENTANA CONSULTAR USUARIO #####################################################-->
    <!--######################################################################################################################################-->
    <!--######################################################## VENTANA DE OPCIONES #########################################################-->
    <!--######################################################################################################################################-->
    <div class="principal" id="DatosUser" style="display:none;color:black !important; background:white !important;width: 120%;margin: 8% 0% 0% -5%;box-shadow: 10px 10px 21px #000;">
        <h3 style="background:#3B5998;color:white;margin-top:0px;padding:16px;">Resultado de la búsqueda</h3><br>
        <h4>Datos del Usuario</h4>
        <div id="MuestraUsuario" style="width:960px !important;margin:auto;padding:25px;overflow:hidden;background:#FFFFFF;margin-bottom: 86px;">
            <table class="table table-hover table-condensed" style="border: solid 1px #f1f1f1;">
               <thead>
                   <tr style="background-color: #3B5998;color: white;">
                       <th>Cédula</th>
                       <th>Nombres</th>
                       <th>Apellidos</th>
                       <th>Email</th>
                       <th>Editar</th>
                       <th>Eliminar</th>
                   </tr>
               </thead>
               <tr>
                   <td><span id="UserID"></span></td>
                   <td><span id="UserNames"></span></td>
                   <td><span id="UserLastName"></span></td>
                   <td><span id="UserEmail"></span></td>
                   <td><button id="EditUser" class='btn btn_opcion  btn-primary'><span class="glyphicon glyphicon-pencil"></span></button></td>
                   <td><button id="DeleteUser" class='btn btn_opcion  btn-danger'><span class="glyphicon glyphicon-remove"></span></button></td>
               </tr>
               <tbody>
               </tbody>
           </table>
       </div>
   </div>
   <!--######################################################################################################################################-->
   <!--######################################################## VENTANA DE OPCIONES #########################################################-->
   <!--######################################################################################################################################-->
   <!--################################################## VENTANA DE EDICION/ELIMINACION ####################################################-->
   <!--######################################################################################################################################-->
   <div id="ModalBoxEdit" style="display:none;width:100%;height:100%;position:fixed;top:0px;left:0;z-index:50;overflow:hidden; background:rgba(0,0,0,0.5)">
     <form name="FormularioEdicion" id="FormularioEdicion" action="Controllers/Controller.Users.php" method="POST" style="margin-top: -20px!important;">
        <input type="hidden" name="option" value="editar">
        <input type="hidden" id="idUser" name="idUser">
        <input type="hidden" id="oficinaselect" name="oficinaselect" value="0">
        <input type="hidden" id="correoprincipal" name="correoprincipal" value="0">
        <input type="hidden" id="codUser" name="codUser" value="0">
        <!--  ////////////////////////////////////PANTALLA DE DATOS DEL USUARIO/////////////////////////////////////////////  -->    
        <div id="TablaFormulario" style="width: 79% !important;left: 10%;padding:25px;overflow:hidden;background:#FFFFFF;box-shadow:10px 10px 21px #000;margin-bottom: 86px;top: 0;position: fixed;">
            <div class="row" style="margin: 0% 0% 1% 0%;">
                <h3 class="Resaltar">
                    <span class="obligatorio">*</span> Campos Obligatorios
                </h3>    
            </div>
            <div class="row">            
                <div class="col-xs-4 form-group">
                    <label class="labelformulario LabelText">Nombre</label>
                    <input type="text" class="form-control" id="NombreUser" name="NombreUser" value="" readonly="" form="FormularioEdicion">
                </div>
                <div class="col-xs-4 form-group">
                    <label class="labelformulario LabelText" >Apellido</label>
                    <input type="text" class="form-control" id="ApellidoUser" name="ApellidoUser" value="" readonly="" form="FormularioEdicion">
                </div>  
                <div class="col-xs-4 form-group">
                    <label class="labelformulario LabelText">Cédula</label>
                    <input type="text" class="form-control" id="Cedula" name="Cedula" value="" readonly="" form="FormularioEdicion">
                </div>
            </div>
            <div class="row">
                <div class="col-xs-4 form-group ">
                    <label class="labelformulario LabelText"><span class="obligatorio">* </span>Correo Electrónico</label>
                    <input type="text" class="form-control" id="Email" name="Email" placeholder="Ej: alguien@alguien.com" form="FormularioEdicion" maxlength="250" oncopy="return false;" onpaste="return false;" oncut="return false;">
                </div>
                <div class="col-xs-4 form-group">
                    <label class="labelformulario LabelText">Teléfono de Habitación</label>
                    <select name="TelefHabitacionSelect" id="TelefHabitacionSelect" class="form-control" style="width: 43% !important;padding: 5px;height: 30px !important;">
                        <option value="">Seleccione</option>
                        <? 
                        foreach ($codTelefono as $TelefonoCodigo) {
                           echo "<option value=".$TelefonoCodigo['CODIGO_AREA'].">".$TelefonoCodigo['CODIGO_AREA']."</option>";
                       }
                       ?>
                   </select>
                   <input type="text" class="form-control" id="Telf_Habitacion" name="Telf_Habitacion" placeholder="Ej: 5555555" form="FormularioEdicion" maxlength="7" oncopy="return false;" onpaste="return false;" oncut="return false;" style="width: 57%;height: 31px;float: left;margin: -11.2% 0% 0% 43%;">
                   <p id="errorTelefonoHabitacion" class="error" style="display:none;">Debe poseer 7 dígitos</p>
               </div>  
               <div class="col-xs-4 form-group">
                   <label class="labelformulario LabelText">Teléfono Movil</label>
                   <select name="TelefMovilSelect" id="TelefMovilSelect" class="form-control" style="width: 43% !important;padding: 5px;height: 30px !important;">
                    <option value="">Seleccione</option>
                    <option value="0414">0414</option>
                    <option value="0424">0424</option>
                    <option value="0416">0416</option>
                    <option value="0416">0426</option>
                    <option value="0412">0412</option>
                </select>
                <input type="text" class="form-control" id="Telef_Movil" name="Telef_Movil" placeholder="Ej: 5555555" form="FormularioEdicion"  maxlength="7" oncopy="return false;" onpaste="return false;" oncut="return false;" style="width: 57%;height: 31px;float: left;margin: -11.2% 0% 0% 43%;">
                <p id="errorTelefonoMovil" class="error" style="display:none;">Debe poseer 7 dígitos</p>
            </div>
        </div>
        <h2>Datos de Usuario</h2>
        <div class="row">          
            <div class="col-xs-4 col-xs-offset-3 form-group ">
                <label class="labelformulario LabelText"><span class="obligatorio" style="margin: 0% 0% 0% 67%;">*</span> Usuario</label>
                <input type="text" class="form-control" id="UserName" name="UserName" placeholder="Ej: alguien@alguien.com" form="FormularioEdicion" maxlength="100" oncopy="return false;" onpaste="return false;" oncut="return false;" style="width: 159%;">
                <p id="errorCorreoUsuarioExiste" class="error" style="display:none;">Correo ingresado ya existe</p>
            </div>         
        </div>
        <div class="row" style="margin: 0% -4% 0% 0%;">
            <div class="col-xs-4 form-group">
                <label class="labelformulario LabelText"><span class="obligatorio">*</span> Perfil</label>
                <select id="perfil" name="perfil" class="form-control" form="FormularioEdicion">
                    <option value="" selected>Seleccione</option>
                    <?php foreach ($roles as $rol) {
                        echo "<option value=".$rol['CLV_ROL'].">".$rol['DESCRIPCION']."</option>";
                    } ?>
                </select>
            </div>
            <div class="col-xs-4 form-group">
                <label class="labelformulario LabelText"><span class="obligatorio">*</span> Región</label>
                <select id="regionselect" name="regionselect" class="form-control" form="FormularioEdicion"> 
                    <option value="">Seleccione</option>
                    <option value="CEN">Central</option>
                    <option value="OCC">Occidental</option>
                    <option value="OR">Oriental</option>
                </select>
            </div>
            <div class="col-xs-4 form-group">
                <label class="labelformulario LabelText"><span class="obligatorio">*</span> Estado</label>
                <select id="estadoselect" name="estadoselect" class="form-control" form="FormularioEdicion"> 
                    <option value="">Seleccione</option>
                </select>
            </div>
        </div>
        <div class="row" style="margin: 0% -4% 0% 0%;">
            <div class="col-xs-4 form-group">
                <label class="labelformulario LabelText"><span class="obligatorio">*</span> Dirección General</label>
                <select id="direcciongeneralselect" name="direcciongeneralselect" class="form-control" form="FormularioEdicion">
                    <option value="">Seleccione</option>
                    <?
                    foreach ($direcciones as $direcciongeneral) {
                        echo  "<option value=".$direcciongeneral['ID_DIRECCION'].">".$direcciongeneral['NOMBRE']."</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="col-xs-4 form-group">
                <label class="labelformulario LabelText"><span class="obligatorio">*</span> Dirección de Línea</label>
                <select id="direccionlineaselect" name="direccionlineaselect" class="form-control" form="FormularioEdicion">
                    <option value="">Seleccione</option>
                </select>
            </div> 
            <div class="col-xs-4 form-group">
                <label class="labelformulario LabelText"><?/*?><span class="obligatorio">*</span><?*/?> División</label>
                <select id="divisionselect" name="divisionselect" class="form-control" form="FormularioEdicion">
                    <option value="">Seleccione</option>
                </select>
            </div>          
        </div>
        <hr>
        <div class="row">
            <div class="col-xs-2 col-xs-offset-4 form-group">
                <button id="AceptarUpdate" type="submit"  class="form-control btn btn-primary">
                    <span class="glyphicon"></span>Editar
                </button>
            </div> 
            <div class="col-xs-2 form-group">
                <button id="CancelUpdate" class="form-control btn btn-primary">
                    <span class="glyphicon"></span>Cancelar
                </button>
            </div>           
        </div>        
    </div>
</form>
</div>


<!--######################################################################################################################################-->
<!--################################################## VENTANA DE EDICION/ELIMINACION ####################################################-->
<!--######################################################################################################################################-->
</body>
</html>
<!-- ###################################################### MENSAJES #####################################################################-->
<!--######################################################################################################################################-->
<!-- ################################################ MENSAJE DE ERROR ###################################################################-->
<div id="mensajerror1" style="display:none;position:fixed;z-index:100000;background:rgba(0,0,0,0.8);width:100%;height:100%;top:0;left:0;">
    <div id="error1" title="Mensaje" style="display:none;z-index: 10000;width:600px;hight:300px;margin:auto;margin-top:100px;background:rgba(255,255,255,0.8);" >
        <div id="titulo_error1" style="background:#234181 linear-gradient(#639ACA, #6095C4 20%, #3368A0 60%, #234181 100%) repeat scroll 0% 0%;color:white;padding:10px;margin:auto;font-size:1.4em; ">
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
<!--######################################################################################################################################-->
<!-- ################################################ MENSAJE DE ERROR ###################################################################-->
<!--######################################################################################################################################-->
<!-- ################################################## MENSAJE EXITO ####################################################################-->
<div id="mensajeexito" style="display:none;position:fixed;z-index:100000;background:rgba(0,0,0,0.8);width:100%;height:100%;top:0;left:0;">
    <div id="exito" title="Mensaje" style="display:none;z-index: 10000;width:600px;hight:300px;margin:auto;margin-top:100px;background:rgba(255,255,255,0.8);" >
        <div id="titulo_exito" style="background:#234181 linear-gradient(#639ACA, #6095C4 20%, #3368A0 60%, #234181 100%) repeat scroll 0% 0%;color:white;padding:10px;margin:auto;font-size:1.4em; ">
            Exito
            <?/*?><div style="width:21px;float:right;cursor:pointer;" title="Cerrar mensaje" id="cerrar_error1">
                <span class="glyphicon glyphicon-remove"></span>
            </div><?*/?>
        </div>                                    
        <div class="mensaje" style="padding:25px 25px 25px 25px;font-size:1.3em;">
            <span id="TextoExito" style="color:blue;"></span>
        </div>
    </div>
</div>
<!--######################################################################################################################################-->
<!-- ################################################## MENSAJE EXITO ####################################################################-->
<!--######################################################################################################################################-->
<!-- ################################################ MENSAJE EXISTE ACTIVACION ##########################################################-->
<!--######################################################################################################################################-->
<div id="mensajeactivacion" style="display:none;position:fixed;z-index:100000;background:rgba(0,0,0,0.8);width:100%;height:100%;top:0;left:0;">
    <div id="activacion" title="Mensaje" style="display:none;z-index: 10000;width:600px;hight:300px;margin:auto;margin-top:100px;background:rgba(255,255,255,0.8);" >
        <div id="titulo_error1" style="background:#234181 linear-gradient(#639ACA, #6095C4 20%, #3368A0 60%, #234181 100%) repeat scroll 0% 0%;color:white;padding:10px;margin:auto;font-size:1.4em; ">
            Usuario Inactivo
            <?/*?><div style="width:21px;float:right;cursor:pointer;" title="Cerrar mensaje" id="cerrar_error1">
                <span class="glyphicon glyphicon-remove"></span>
            </div><?*/?>
        </div>                                    
        <div class="mensaje" style="padding:25px 25px 25px 25px;font-size:1.3em;">
            <span id="TextoMensajeActivacion">Existe este usuario</span>
            <br>
            <span id="PreguntaActivacion" style="color:blue">¿desea activar?</span>
            <div style="margin: 6% 0% 0% 0%;">
                <button class="btn btn-primary" id="AceptarEdit"><span></span>Aceptar</button>
                <button class="btn btn-danger" id="CancelarEdit"><span></span>Cancelar</button>
            </div>
        </div>       
    </div>
</div>

<!--######################################################################################################################################-->
<!-- ################################################ MODAL DE ELIMINAR ###################################################################-->
<!--######################################################################################################################################-->
<div id="ModalBoxDelete" style="display:none;width:100%;height:100%;position:fixed;top:0px;left:0px;z-index:50;overflow:hidden; background-color: rgba(0, 0, 0, 0.498039)">
  <div style="width: 30%;margin: 16% 0% 0% 37%;height: 182px;overflow:hidden;padding:12px;background:#f1f1f1;">
      <p style="margin: 8% 1% 4% 0%;text-align:center;font-size:1.1em;" id="PreguntaModalDelete"></p>
      <form action="Controllers/Controller.Users.php" id="FormDelete"method="POST">
          <input name="option" id="option" type="hidden" value="eliminar">
          <input name="id" id="id_opt_eliminar" type="hidden">
          <input name="email" id="email_opt" type="hidden">
      </form>
      <button class="btn btn-primary" id="confirm_delete" style="margin-top: 12%;"><span id="spanbutton" class="glyphicon"></span id="spantext"> Aceptar</button>
      <button class="btn btn-danger" id="cancel_delete" style="margin-top: 12%;"><span class="glyphicon"></span> Cancelar</button>
  </div>
</div>
<!-- ###################################################### MENSAJES #####################################################################-->
<!--######################################################################################################################################-->
<!-- ###################################################### JAVASCRIPT ###################################################################-->
<script type="text/javascript">

    $("#cedula").on("keydown",function(e){
        if(e.keyCode == 13)
        {
            $("#consultarUser").click();
        }
    })

    $("#consultarUser").on("click",function(){
        if($("#cedula").val() == ""){
            $("#TextoMensaje").text("Ingrese una cédula para poder continuar");
            $("#mensajerror1").fadeIn("slow");
            $("#error1").fadeIn('slow');
        } else if ($("#NacionalidadSelect").val() == ""){
            $("#TextoMensaje").text("Seleccione una nacionalidad para poder continuar");
            $("#mensajerror1").fadeIn("slow");
            $("#error1").fadeIn('slow');
        } else {
            BuscaUser();
        }
    });

    $("#direcciongeneralselect").on("change",buscarDireccionLinea);
    $("#direccionlineaselect").on("change",buscarDivision);

    $("#cerrar_error1").click(function(){
        $("#mensajerror1").slideUp( "slow" );
    });

    $("#DeleteUser").on("click",function(){
        $("#PreguntaModalDelete").text("¿Desea eliminar este usuario del sistema?");
        $("#ModalBoxDelete").fadeIn()
    })

    $("#regionselect").on("change",function(){
        ComboEstado($("#regionselect").val());
    })

    function ComboEstado(REGIONID){
        $.ajax({
            dataType: "json",
            data: {"regionUsers":REGIONID},
            url:   '../../../resources/select/buscar.php',
            type:  'post',
            beforeSend: function(){

            },
            success: function(resp){
                $("#estadoselect").html(resp.html);
            },
            async:false
        });    
    }

    /* #################################### EDITAR UN USUARIO ###########################################*/
    $("#EditUser").on("click",function(){
        datosUser();
    })
    $("#AceptarUpdate").on("click",function(event){
        event.preventDefault();
        $("#FormularioEdicion").submit();
    })
    $("#CancelUpdate").on("click",function(event){
        event.preventDefault();
        $("#ModalBoxEdit").fadeOut(); 
    })

    /* #################################### EDITAR UN USUARIO ###########################################*/
    /*###################################################################################################*/
    /*###################################  ELIMINAR UN USUARIO ##########################################*/
    $("#confirm_delete").on("click",function(){
        $("#FormDelete").submit();
    })
    $("#cancel_delete").on("click",function(){
        $("#ModalBoxDelete").fadeOut();
        event.preventDefault();
    })
    /*###################################  ELIMINAR UN USUARIO ##########################################*/
    /*###################################################################################################*/
    /*####################################  REINGRESAR UN USUARIO #######################################*/
    $("#AceptarEdit").on("click",function(){
        ReingresoUser();
        $("#mensajeactivacion").fadeOut();
    })

    $("#CancelarEdit").on("click",function(event){
        $("#mensajeactivacion").fadeOut();
    })
    /*#################################  REINGRESAR UN USUARIO ###########################################*/
    /*###################################  JQUERYVALIDATION  #############################################*/
    $(function(){   
        $("#FormularioEdicion").validate({
            rules:{ 
                UserName:{
                    required:  true,
                    //email: true,
                    minlength: 5
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
                //email:      "Ingrese un correo válido",
                minlength:  "El nombre de usuario debe ser mayor de 5 caracteres"
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
            direcciongeneralselect:{
                required:  "Este campo es requerido"
            },
            direccionlineaselect:{
                required:  "Este campo es requerido"
            }/*,
            divisionselect:{
                required:  "Este campo es requerido"
            }*/
        }, submitHandler: function(form,event) {
            if (ExisteCorreoUsuario != false){
                form.submit();
            }else{
                event.preventDefault();
            }            
        }
    });
});

$.validator.addMethod("valueNotEquals", function(value, element, arg){
  return arg != value;
}, "Value must not equal arg.");
/*###################################  JQUERYVALIDATION  #############################################*/


$("#UserName").on("click",function(){
    $("#errorCorreoUsuarioExiste").css("display","none");
});

$("#UserName").on("blur",function(){
    $("#errorCorreoUsuarioExiste").css("display","none");
    if($("#UserName").val() != $("#correoprincipal").val()){
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
    } else {
        ExisteCorreoUsuario = true;
    }   
})

/*#!#!#!#!#!#!#!#!#!#!#!#!#!#!#!#!#!#!#!#!#!#!#!#!#!#! JAVASCRIPTS #!#!#!#!#!#!#!#!#!#!#!#!#!#!#!#!#!#!#!#!#!#!#!#!#!#!#!#!#!#!#!#!#!#!*/
function BuscaUser(){
    $.ajax({
        dataType: "json",
        data: {"option":"consultar","cedula":$("#cedula").val()},
        url:   'Controllers/Controller.Users.php',
        type:  'post',
        beforeSend: function(){

        },
        success: function(resp){
            if (resp == 2){
                    //No existe
                    $("#TextoMensaje").text("No existe usuario registrado con la cédula especificada.");
                    $("#mensajerror1").fadeIn();
                    $("#error1").fadeIn();

                } else if (resp == 1) {
                    //Existe este usuario pero esta inactivo
                    $("#mensajeactivacion").fadeIn();
                    $("#TextoMensajeActivacion").text("El usuario "+$("#NacionalidadSelect").val()+$("#cedula").val()+" se encuentra registrado con estatus inactivo")
                    $("#PreguntaActivacion").text("¿Desea activar nuevamente este usuario?");
                    $("#activacion").fadeIn();
                } else {
                    //Existe este usuario
                    $("#ConsultarUser").css("display","none");
                    $("#UserID").text(resp.ID_USER)
                    $("#UserNames").text(resp.NOMBRE)
                    $("#UserLastName").text(resp.APELLIDO)
                    $("#UserEmail").text(resp.CORREO)
                    $("#id_opt_eliminar").val(resp.ID_USER)
                    $("#DatosUser").fadeIn();
                }
            },error :function(){
                console.log("error")
            }
        });

}

function datosUser(){
    $.ajax({
        dataType: "json",
        type:"post",
        data:{"option": 'buscarUser','id':$("#UserID").text(),'email':$("#UserEmail").text()},
        url:"Controllers/Controller.Users.php",
        beforeSend:function(){

        },
        success:function(resp){
            window.ExisteCorreoUsuario  = true;
            $("#idUser").val(resp.ID_USER);
            $("#NombreUser").val(resp.NOMBRE);
            $("#ApellidoUser").val(resp.APELLIDO);
            $("#Cedula").val(resp.ID_USER);            
            $("#Email").val(resp.CORREO);
            $("#codUser").val(resp.CODIGO_USUARIO);
            if (resp.TELEFONO_HABITACION != null){
                var TelefHabitacion = resp.TELEFONO_HABITACION.split("");
                var ExtensionHabitacion = TelefHabitacion[0]+TelefHabitacion[1]+TelefHabitacion[2]+TelefHabitacion[3];
                $("#TelefHabitacionSelect").val(ExtensionHabitacion);
                $("#Telf_Habitacion").val(TelefHabitacion[4]+TelefHabitacion[5]+TelefHabitacion[6]+TelefHabitacion[7]+TelefHabitacion[8]+TelefHabitacion[9]+TelefHabitacion[10]);
            }
            if (resp.TELEFONO_MOVIL != null){
                var TelefMovil = resp.TELEFONO_MOVIL.split("");
                var ExtensionMovil = TelefMovil[0]+TelefMovil[1]+TelefMovil[2]+TelefMovil[3];
                $("#TelefMovilSelect").val(ExtensionMovil);
                $("#Telef_Movil").val(TelefMovil[4]+TelefMovil[5]+TelefMovil[6]+TelefMovil[7]+TelefMovil[8]+TelefMovil[9]+TelefMovil[10]);
            }
            $("#UserName").val(resp.USUARIO);
            $("#correoprincipal").val(resp.USUARIO);
            $("#perfil").val(resp.USER_TYPE);
            $("#regionselect").val(resp.REGION);
            $("#direcciongeneralselect").val(resp.DIRECCION_GENERAL);
            buscarDireccionLinea();
            $("#direccionlineaselect").val(resp.DIRECCION_LINEA);
            buscarDivision();
            $("#divisionselect").val(resp.DEPARTAMENTO);
            ComboEstado(resp.REGION)
            $("#estadoselect").val(resp.ESTADO)

        },
        error:function(){
            console.log('error');
        }
    }).done(function(){
        $("#ModalBoxEdit").fadeIn('slow');
    })
}

function ReingresoUser(){
    $.ajax({
        dataType: "json",
        data: {"option":"reingreso","CodUser":$("#cedula").val()},
        url:   'Controllers/Controller.Users.php',
        type:  'post',
        beforeSend: function(){

        },
        success: function(resp){
            //console.log(resp)
            if (resp == 1){
                //Usuario Activado Satisfactoriamente
                $("#TextoExito").text("Usuario reingresado satisfactoriamente")
                $("#mensajeexito").fadeIn('slow').delay(2000).fadeOut('fast').delay(900,function(){});
                $("#exito").fadeIn();
            }
        },error :function(){
            console.log("error")
        }
    });
}

function buscarDireccionLinea(){
    if($("#direcciongeneralselect").val()==""){
        return 0;
    } else {
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
                    $("#direccionlineaselect").html(resp.html);
                        //console.log(resp.html);         
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
                    $("#divisionselect").html(resp.html);
                        //console.log(resp.html);         
                    }
                },
                async:false
            });
    }
}

/*̈́̈́̈́̈́̈́̈́̈́̈́̈́̈́̈́̈́̈́̈́̈́̈́̈́̈́̈́̈́̈́̈́̈́̈́̈́̈́̈́̈́̈́̈́̈́̈́̈́̈́̈́̈́̈́ JAVASCRIPTS ̈́̈́̈́̈́̈́̈́̈́̈́̈́̈́̈́̈́̈́̈́̈́̈́̈́̈́̈́̈́̈́̈́̈́̈́̈́̈́̈́̈́̈́̈́̈́̈́̈́̈́̈́̈́̈́̈́̈́̈́̈́̈́̈́̈́̈́̈́̈́̈́*/
</script>
<!-- ############################################################ JAVASCRIPT ##############################################################-->