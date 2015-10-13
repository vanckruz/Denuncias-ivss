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
    <form action="Controllers/Controller.Users.php" method="post" name="formquery" id="formquery">
        <input type="hidden" name="option" value="consultar" id="option"/>
        <div class="login-message">
            <fieldset class="fieldset" style="border-radius:0px;background:#3B5998; margin-top: -93px;margin: 2px 0px 0px 165px;">
                <h3 style="color:white;margin: -21px 0px 0px 93px;font-size: 1.2em;" class="Resaltar">Consultar Usuario</h3>
                <hr>
                <div class="form-group persona" id="persona" style="display: block;">
                    <input type="hidden" name="option" value="consultar" id="option"/>
                    <label style="margin-left: 69px;display:block;font-size: 13px;float:left;width:150px;margin-right: -67px; color:white;">Nacionalidad</label>
                    <label style="display:block;font-size: 13px;float:left;width:150px; color:white;">Cédula</label>
                    <div style="clear:both;"></div>
                    <select id="NacionalidadSelect" name="nac_apo" class="form-control" style="width: 115px !important;font-size: 12px !important;height: 29px;margin: 0px 0px 7px 73px;">
                        <option value="" selected="">Seleccione</option>
                        <option value="V">V</option>
                        <option value="E">E</option>
                        <option value="T">T</option>
                    </select>  
                    <input type="text" id="cedula" name="cedula" class="form-control input-sm" placeholder="Ingrese cédula aquí" maxlength="8" required="" style="width: 179px !important;float: left;margin: -36px 0px 0px 204px;height: 29px;font-size: 12px!important;padding-left: 10px;">
                    <div class="form-group elementoform" id="botones_pernat">
                        <input type="submit" id="boton_consulta" name="boton_consulta" class="btn btn-default" value="Consultar" style="width: 98px;margin: 6px -11px -25px 0px;padding: 0;height: 29px;font-size: 12px;">
                    </div>
                </div>
            </fieldset>
        </div> 
    </form>
    <!--######################################################################################################################################-->
    <!--###################################################### VENTANA CONSULTAR USUARIO #####################################################-->
    <!--######################################################################################################################################-->
    <!--######################################################## VENTANA DE OPCIONES #########################################################-->
    <!--######################################################################################################################################-->



    <!--######################################################################################################################################-->
    <!--######################################################## VENTANA DE OPCIONES #########################################################-->
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
    $("#boton_consulta").on("click",function(e){
        e.preventDefault();
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
          
            $("#formquery").submit();
        }
    })
    $("#cerrar_error1").click(function(){
        $("#error1").slideUp('slow');
        $("#mensajerror1").slideUp( "slow" );
    });
</script>
<!-- ############################################################ JAVASCRIPT ##############################################################-->