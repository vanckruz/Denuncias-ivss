<?php 

require('../../../resources/restrictedaccess.php');
include("../../../resources/select/funciones.php");
include("../../../App/config/config.php");


$codTelefono = dameCodigosTelefono();
$estados = dameEstado();
$direcciones = dameDirecciones();
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
</style>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>
    <!--<link href="../../public_html/css/formularios.css" rel="stylesheet"/>-->
</head>
<body>

<!--######################################################################################################################################-->
<!--###################################################### VENTANA CONSULTAR USUARIO #####################################################-->
<!--######################################################################################################################################-->
    <!--<form action="#" method="post" name="formquery" id="formquery">
        <input type="hidden" name="option" value="consultar" id="option"/>-->
    <div class="login-message">
        <fieldset class="fieldset" style="border-radius:0px;background:#3B5998; margin: 1% 0% 0% 21%;">
        <h3 style="color:white;margin: 1% 0% 0% 25%;font-size: 1.2em;" class="Resaltar">Consultar Usuario</h3>
        <hr>
            <div class="form-group persona" id="persona" style="display: block;">
            <!--<input type="hidden" name="option" value="consultar" id="option"/>-->
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
            <input type="button" id="boton_consulta" name="boton_consulta" class="btn btn-default" value="Consultar" style="width: 98px;margin: -17.8% -79% 0% 0%;padding: 0;height: 29px;font-size: 12px;">
            </div>
        </fieldset>
    </div> 
   <!-- </form> -->
<!--######################################################################################################################################-->
<!--###################################################### VENTANA CONSULTAR USUARIO #####################################################-->
<!--######################################################################################################################################-->
<!--######################################################## VENTANA DE OPCIONES #########################################################-->
<!--######################################################################################################################################-->
<?/*?><div class="principal" style="display:none;color:black !important; background:white !important;width: 120%;margin: 8% 0% 0% -5%;">
    <h3 style="background:#3B5998;color:white;margin-top:0px;padding:16px;">Resultado de la búsqueda</h3><br>
    <h4>Datos del Usuario</h4>
    <form name='UsersRegistrados' id='UsersRegistrados' action='#' method='post' style="background-color:white !important;">
        <input type="hidden" name="id" value="" id="id" />
        <input type="hidden" name="option" value="" id="option" />
        <div style="margin-left:25px;margin-right:25px;">
        <table class='table table-bordered table-hover' id="tabla_consulta">
            <thead>
                <tr>
                    <th class="text-center" style="background:#3B5998;color:white !important;">Cédula</th>
                    <th class="text-center" style="background:#3B5998;color:white !important;">Nombres</th>
                    <th class="text-center" style="background:#3B5998;color:white !important;">Apellidos</th>
                    <th class="text-center" style="background:#3B5998;color:white !important;">Email</th>
                    <th class="text-center" style="background:#3B5998;color:white !important;"><span>Editar</span></th>
                    <th class="text-center" style="background:#3B5998;color:white !important;"><span>Eliminar</span></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="text-center"><?=$usuario->__GET('id_user')?></td>
                    <td class="text-center"><?=$usuario->__GET('nombre')?></td>
                    <td class="text-center"><?=$usuario->__GET('apellido')?></td>
                    <td class="text-center"><?=$usuario->__GET('correo')?></td>
                    <td style="text-align:center;"><button type="button" id="<?=$usuario->__GET('id_user')?>" value="edituser" class='edit_user btn_opcion btn btn-primary' data-nacionalidad = "<?=$usuario->__GET('nacionalidad');?>"data-id = "<?=$usuario->__GET('id_user')?>"data-name = "<?=$usuario->__GET('nombre')?>"data-apellido = "<?=$usuario->__GET('apellido')?>"data-email = "<?=$usuario->__GET('correo')?>"data-pass = "<?=$usuario->__GET('password')?>"data-departamento = "<?=$usuario->__GET('departamento')?>"data-perfil = "<?=$usuario->__GET('user_type')?>"data-region = "<?=$usuario->__GET('region')?>"data-estado = "<?=$usuario->__GET('estado')?>"data-oficina = "<?=$usuario->__GET('oficina')?>"data-direcciongeneral = "<?=$usuario->__GET('direccion_general')?>"data-direccionlinea = "<?=$usuario->__GET('direccion_linea')?>"data-user = "<?=$usuario->__GET('usuario')?>"data-codigousuario = "<?=$usuario->__GET('codigo_usuario')?>"data-telefonohabitacion = "<?=$usuario->__GET('telefono_habitacion')?>"data-telefonomovil = "<?=$usuario->__GET('telefono_movil')?>" title="Editar"/><span class="glyphicon glyphicon-pencil"></span></button></td>
                    <td style="text-align:center;"><button type="button" id="<?=$usuario->__GET('id_user')?>" value="eliminar" class='eliminar_user btn_opcion btn btn-danger' title="Eliminar"><span class="glyphicon glyphicon-remove"></span></button></td>
                </tr>
            </tbody>
            <tfoot>                
            </tfoot>
        </table>
    </form>   
</div><?*/?>
<!--######################################################################################################################################-->
<!--######################################################## VENTANA DE OPCIONES #########################################################-->
<!--######################################################################################################################################-->
<!--################################################## VENTANA DE EDICION/ELIMINACION ####################################################-->
<!--######################################################################################################################################-->
<!--######################################################################################################################################-->
<!--################################################## VENTANA DE EDICION/ELIMINACION ####################################################-->
<!--######################################################################################################################################-->
    <script type="text/javascript" src="../../public_html/js/valida_login.js"></script>
</body>
</html>
<!-- ################################################### MENSAJES #####################################################################-->
<div id="mensajerror1" style="display:none;position:fixed;z-index:100000;background:rgba(0,0,0,0.8);width:100%;height:100%;top:0;left:0;">
    <div id="error1" title="Mensaje" style="display:none;z-index: 10000;width:600px;hight:300px;margin:auto;margin-top:100px;background:rgba(255,255,255,0.8);" >
        <div id="titulo_error1" style="background:#234181 linear-gradient(#639ACA, #6095C4 20%, #3368A0 60%, #234181 100%) repeat scroll 0% 0%;color:white;padding:10px;margin:auto;font-size:1.4em; ">
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
<!-- ############################################################# MENSAJES ##############################################################-->
<!--######################################################################################################################################-->
<!-- ############################################################ JAVASCRIPT ##############################################################-->
<script type="text/javascript">
    /*$("#boton_consulta").on("click",function(){
        alert("hola")
    });*/

    $("#boton_consulta").on("click",function(){
        if($("#cedula").val() == ""){
            $("#TextoMensaje").text("Ingrese una cédula para poder continuar");
            $("#TextoMensaje").css("color","red");
            $("#mensajerror1").fadeIn("slow");
            $("#error1").fadeIn('slow');
        } else if ($("#NacionalidadSelect").val() == ""){
            $("#TextoMensaje").text("Seleccione una nacionalidad para poder continuar");
            $("#TextoMensaje").css("color","red");
            $("#mensajerror1").fadeIn("slow");
            $("#error1").fadeIn('slow');
        } else {
            $.ajax({
                dataType: "json",
                data: {"region":$("#regionselect").val()},
                url:   '../../../resources/select/buscar.php',
                type:  'post',
                beforeSend: function(){

                },
                success: function(resp){

                },
            }); 
        }
    })
    $("#cerrar_error1").click(function(){
    $("#error1").slideUp('slow');
    $("#mensajerror1").slideUp( "slow" );
});
</script>
<!-- ############################################################ JAVASCRIPT ##############################################################-->