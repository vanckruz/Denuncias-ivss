 <?php 
 session_start();
 include("../config/config.php");
 /********Validación de tiempo de sesión********************/
 if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1800)) {
    //última petición fue hace más de 30 minutos
    session_unset();     // Vacia El array $_SESSION en tiempo de ejecucion
    session_destroy();   // destruye las sesiones almacenadas
}

$_SESSION['LAST_ACTIVITY'] = time();
/********Validación de tiempo de sesión********************/


if( !isset($_SESSION['USUARIO']) )
{
    header("Location: ".$base_url."index.php?s=0");
}

?>
<!doctype html> 
<html lang="ES"> 
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximun-scale=1">
  <script type="text/javascript" src="<?=$base_url;?>public_html/js/jquery-2.1.4.min.js"></script>
  <script type="text/javascript" src="<?=$base_url;?>public_html/js/bootstrap/js/bootstrap.js"></script>
  <script type="text/javascript" src="<?=$base_url;?>public_html/js/mostrarContenido.js"></script>
  <script type="text/javascript" src="<?=$base_url;?>public_html/js/modernizr.custom.75139.js"></script>
  <script type="text/javascript" src="<?=$base_url;?>public_html/js/desplegable.js"></script>
  <script type="text/javascript" src="<?=$base_url;?>public_html/js/valida_login.js"></script>
  <script type="text/javascript" src="<?=$base_url;?>public_html/vendor/jQueryValidation/dist/jquery.validate.js"></script>
  <link rel="shortcut icon" href="<?=$base_url;?>public_html/imagenes/favicon.ico" type="image/x-icon" />
  <link href="<?=$base_url;?>public_html/css/bootstrap/css/bootstrap.css" rel="stylesheet"/>
  <link href="<?=$base_url;?>public_html/css/styles2.css" rel="stylesheet"/>
  <link rel="stylesheet" type="text/css" href="<?=$base_url;?>public_html/vendor/jquery-ui/css/smoothness/jquery-ui-1.9.2.custom.min.css">
  <link rel="stylesheet" href="<?=$base_url;?>public_html/vendor/DataTables/media/css/jquery.dataTables.css">
  <script type="text/javascript" src="<?=$base_url;?>public_html/vendor/DataTables/media/js/jquery.dataTables.js"></script>
  <style>
    .container{
        width: 960px !important;
    }
    .popover{
        width:500px;
        font-weight: normal;
    }

    .content-menu{
        width:130px;
        position:absolute;
        top:84px;
        left:0;
        z-index:10;
    }
    .item-menu{
        width:130px;
        height:65px;
        background:#3B5998;
        border-top:1px dotted #f1f1f1;
        padding:5px;
    }
    .item-menu:hover{
        background: #9ECC02;
        box-shadow: inset 0px 5px 20px #466101;
        cursor:pointer;
    }

    .item-menu a:hover{
        cursor:pointer;
    }

    .item-menu p{
        font-size: 0.7em;
        margin-top: 5px;
        margin-bottom:5px;
    }

    .img_menu{
        width:30px;
        height:auto;
        margin:auto;
        margin-top:2px;
        opacity:0.8;
        text-align: left;
    }

    .menu_inf_item:hover{
      background: #9ECC02;
      box-shadow: inset 0px 5px 20px #466101;
  }

  .ui-dialog-titlebar,.ui-widget-header{
    background:#3B5998;
    color: white;
    border-radius:0px;
    padding: 5px;
    box-shadow: 5px 7px 7px #888888;
}
.ui-dialog-content,.ui-widget-content{
    background:linear-gradient(#ffffff,#dde9f4);
}    

.fon_td{
    font-size:0.8em;
    color: #111;
    font-weight:bold;
}
.font_body td{
    font-size:0.9em;
}

@media screen and (min-width:900px) and (max-width: 1100px) {
    .container{
        width: 880px !important;
    }
}
</style>
<title>Sistema de Fiscalización-Denuncias</title>
</head>
<body style="background:linear-gradient(to right, #AFA19E, #E7E7FF, #E7E7E7, #8E8E8E) no-repeat scroll 0% 0% #8E8E8E;height:auto;">
    <div class="content-menu">
        <a href="Views/forminsert.php" name="registrar_user" id="registrar_user" rel="popover" data-placement="right" data-original-title="Registrar Usuarios" data-content="Esta opción permite registrar usuarios en el Sistema de Fiscalización" data-trigger="hover">
            <div class="item-menu">
                <img src="../../public_html/imagenes/iconos/guardar.png" class="img_menu"/>  
                <p>Registrar</p>
            </div>
        </a>  

        <a href="Views/formquery.php" name="consultar_user" id="consultar_user" rel="popover" data-placement="right" data-original-title="Consultar usuarios" data-content="Esta opción permite consultar usuarios registrados en el Sistema de Fiscalización" data-trigger="hover">
            <div class="item-menu">   
                <img src="../../public_html/imagenes/iconos/usuarios.png" class="img_menu" />
                <p>Consultar</p>
            </div>
        </a>
    </div>
    <!-- ##################################### PANEL LATERAL #########################################-->
    <div style="width:100%;background:#3B5998; margin: 0;padding:12px;">
        <div class="container">
            <div class="row">            
                
                <div class="col-xs-1">
                    <img src="../../public_html/imagenes/logoivss_blanco.png" style="width:60px;"/>
                </div>

                <div class="col-xs-4">
                    <span id="titulo">Sistema De Fiscalización</span>
                </div>
                
                <div class="col-xs-4">
                    <span id="saludo">Bienvenido <?=$_SESSION['USUARIO']['nombre']." ".$_SESSION['USUARIO']['apellido'];?> <span class="glyphicon glyphicon-user"></span> </span>         
                </div>
                
                <div class="col-xs-3">
                    <span id="cerrar"><a href="../../resources/logout.php">Cerrar Sesión <span class="glyphicon glyphicon-log-out"></span></a></span>
                    <span id="fecha"><?=Date("d-m-Y");?></span>
                </div>

            </div>  
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-xs-11 col-xs-offset-1" id="contenidos" style="min-height:600px;">
                <div style="background:rgba(0,0,0,0.2);padding:25px;">
                    <h3>Módulo de Usuarios</h3><hr>
                    <p  style="font-size:.8em !important;text-align:justify;">En el panel izquierdo encontrará las opciones relacionadas con la gestión de Usuarios
                        del sistema. Seleccione la acción que desea realizar o seleccione la opción <strong>Volver</strong> para regresar 
                        al menú principal.
                    </p>
                </div>
                <?php /*
                <button type="button" class="btn btn-default btn-volver" id="btn-volver">
                    <span class="glyphicon glyphicon-arrow-left"></span> Volver
                </button> 
                */?>
            </div>
        </div>
    </div>
    <!--********************************************************************
    **************************FOOTER*********************************-->
    <div style="width:100%;background:#3B5998; margin: 0; position: fixed;bottom: 0;left:0;">
        <div class="container">  
            <div class="row">
                <div class="col-xs-12" style="padding:12px;">
                    <p style="text-align:center;margin-top:7px;font-size:0.7em;color:white;">
                        LA SEGURIDAD SOCIAL ES TU DERECHO<br>
                        INSTITUTO VENEZOLANO DE LOS SEGUROS SOCIALES (IVSS) 2015<br>
                        DESARROLLADO POR LA DIRECCIÓN GENERAL DE INFORMÁTICA                
                    </p>
                    <div style="position:absolute;top:2px;right:25px;width:210px;border-left:1px solid white;">
                        <div style="width:100px;float:left;">
                            <a  id="volver_act" data-link="../sistemafiscal.php" data-content="" rel="popover" data-placement="left" data-original-title="Volver" data-trigger="hover">
                                <div style="cursor:pointer;padding:3px;" class="menu_inf_item" id="volver_act">
                                    <img src="../../public_html/imagenes/iconos/volver.png" style="width:30px;">
                                    <p style="font-size:0.7em;color:white;margin-top:10px;">Volver</p>
                                </div> 
                            </a>
                        </div>

                        <div style="width:100px;float:left;">
                            <a onClick="location='<?=$base_url;?>'" id="menu_principal" data-content="" rel="popover" data-placement="left" data-original-title="Ir al menu principal" data-trigger="hover">
                                <div style="cursor:pointer;padding:3px;" class="menu_inf_item" >
                                    <img src="../../public_html/imagenes/iconos/home.png" style="width:30px;">
                                    <p style="font-size:0.7em;color:white;margin-top:10px;">Menu home</p>
                                </div>    
                            </a>
                        </div>

                    </div><!--Navegación inferior-->              

                </div>
            </div>
        </div>
    </div>

    <!---------------------------------------------------------------------------------------------------------->
    <div style='position:fixed; top:0; left:0;z-index:12;width:100%;height:100%;background:rgba(0,0,0,0.6); display: none;' id="mensaje">
        <div style="width:50%;margin:auto;margin-top:100px;background:#f1f1f1;padding:25px;">
            <h1> <?php if( isset($_GET['mensaje']) ) { echo $_GET['mensaje']; }?> <?php if( isset($_GET['msj']) ) { echo $_GET['msj'];} ?><?php if( isset($_GET['msjd']) ) { echo $_GET['msjd'];} ?> <?php if( isset($_GET['regok']) ) { echo $_GET['regok'];} ?> <?php if( isset($_GET['editOk']) ) { echo $_GET['editOk'];} ?> <?php if( isset($_GET['delOk']) ) { echo $_GET['delOk'];} ?></h1>
            <br>
        </div>
    </div>

    <div id="errormensaje" style="display:none;position:fixed;z-index:100000;background:rgba(0,0,0,0.8);width:100%;height:100%;top:0;left:0;">
        <div id="error1" title="Mensaje" style="display:none;z-index: 10000;width:600px;hight:300px;margin:auto;margin-top:100px;background:rgba(255,255,255,0.8);" >
            <div id="titulo_error1" style="background:#234181 linear-gradient(#639ACA, #6095C4 20%, #3368A0 60%, #234181 100%) repeat scroll 0% 0%;color:white;padding:10px;margin:auto;font-size:1.4em; ">
                Mensaje
                <div style="width:21px;float:right;cursor:pointer;" title="Cerrar mensaje" id="cierra" name="cierra" onclick="cerrarVentana();">
                    <span class="glyphicon glyphicon-remove"></span>
                </div>
            </div>                                    
            <div class="mensaje" style="padding:25px 25px 25px 25px;font-size:1.3em;">
                <span id="TextoMensaje"><?php if( isset($_GET['error']) ) { echo $_GET['error'];} ?></span>
            </div>
        </div>
    </div>

    <!---------------------------------------------------------------------------------------------------------->

    <script>
    function cerrarVentana(){        
         $('#errormensaje').fadeOut('slow');
    }

        $(document).ready(function()
        {

            
            var pag = "../sistemafiscal.php";
            $("#btn-volver").on('click', function()
            {
                location.href=pag;
            });

            $('#registrar_user,#consultar_user,#volver_act,#menu_principal').popover({ trigger: "hover" });

            /***********************************************************************************/
            $("#registrar_user, #consultar_user").on("click",function(){
                $("#volver_act").data("link","users.php"); 
            });

            $("#volver_act").on("click",function(){
                window.document.location=$(this).data("link"); 
            });
            /***********************************************************************************/

            <?php if( isset($_GET['ivss']) ) { ?>
                var href = "Views/forminsert.php";
                $("#contenidos").load(href);
                $("#volver_act").attr("data-link","users.php").data("link","users.php"); 
                <?php } ?> 
                <?php if( isset($_GET['listuser']) ) { ?>
                    var href = "Views/formquery.php";
                    $("#contenidos").load(href);
                    $("#volver_act").attr("data-link","users.php").data("link","users.php"); 
                    <?php } ?>

                    <?php if( isset($_GET['error']) ) { ?>
                        var href = "Views/formquery.php";
                        $("#contenidos").load(href);
                        $("#volver_act").attr("data-link","users.php").data("link","users.php"); 
                        $('#errormensaje').fadeIn('fast');
                        $('#error1').css('display',"");
                        <?php } ?>

                        <?php if( isset($_GET['regok']) ) { ?>
                            var href = "Views/forminsert.php";
                            $("#contenidos").load(href);
                            $("#volver_act").attr("data-link","users.php").data("link","users.php"); 
                            $('#mensaje').fadeIn('fast').delay(2000).fadeOut('fast').delay(500,function(){
                            }); 
                            <?php } ?>
                            
                            <?php if( isset($_GET['editOk']) ) { ?>
                                var href = "Views/formquery.php";
                                $("#contenidos").load(href);
                                $("#volver_act").attr("data-link","users.php").data("link","users.php"); 
                                $('#mensaje').fadeIn('fast').delay(2000).fadeOut('fast').delay(500,function(){
                                }); 
                                <?php } ?>

                                <?php if( isset($_GET['delOk']) ) { ?>
                                    var href = "Views/formquery.php";
                                    $("#contenidos").load(href);
                                    $("#volver_act").attr("data-link","users.php").data("link","users.php"); 
                                    $('#mensaje').fadeIn('fast').delay(2000).fadeOut('fast').delay(500,function(){
                                    }); 
                                    <?php } ?>     
                                });

                            </script>
                        </body>
                        </html>