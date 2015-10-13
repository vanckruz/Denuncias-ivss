<?php
session_start();
include("../config/config.php");
/********Validación de tiempo de sesión********************/
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 3600)) {
    //última petición fue hace más de 30 minutos
    session_unset();     // Vacia El array $_SESSION en tiempo de ejecucion
    session_destroy();   // destruye las sesiones almacenadas
}
/********Validación de tiempo de sesión********************/


if(!isset($_SESSION['USUARIO']))
{
  header("Location: ".$base_url."index.php?s=0");
}
?>

<!DOCTYPE html>
<html lang="ES">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximun-scale=1">
    <link rel="shortcut icon" href="<?=$base_url;?>public_html/imagenes/favicon.ico" type="image/x-icon" />
    <link href="<?=$base_url;?>public_html/css/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="<?=$base_url;?>public_html/css/styles2.css" rel="stylesheet" type="text/css">
    <link href="<?=$base_url;?>public_html/css/formularios.css" rel="stylesheet"/>
    <link href="<?=$base_url;?>public_html/vendor/jquery-ui/jquery-ui.min.css" rel="stylesheet" type="text/css">
    <link href="<?=$base_url;?>public_html/vendor/jquery-ui/jquery-ui.theme.min.css" rel="stylesheet" type="text/css">
    <title>Sistema de Fiscalización | Oficinas Administrativas</title>
</head>
<style>
    html,body{
        width: 100%;height:100%;
    }
    .popover{
        width: 400px;
    }

    .menu_inf_item:hover{
      background: #9ECC02;
      box-shadow: inset 0px 5px 20px #466101;
  }

  .content-menu{
    width:130px;
    position:absolute;
    top:84px;
    left:0;
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
    opacity:0.7;
}

#menu{
    width: 160px;
    height:auto;
    position: absolute;
    /*z-index:1;*/
    top:80px;
    margin-left:0px;
    background-color:white;/* #3b5998;*/
    border-radius: 0px 20px 20px 0px;
    font-size:1.1em;
}

#menuLateral li span{
   color:black;
}

#menu ul li{
    cursor:pointer;
}

.ui-datepicker-header .ui-widget-header .ui-helper-clearfix .ui-corner-all{
    background:#3B5998 !important;
}

@media screen and (min-width:900px) and (max-width: 1100px) {
    .container{
        width: 880px !important;
    }
}
</style>
<body style="background:linear-gradient(to right, #AFA19E, #E7E7FF, #E7E7E7, #8E8E8E) no-repeat scroll 0% 0% #8E8E8E;height:auto;">
    <div class="content-menu">
        <a href="Views/registrar_oficinas.php" name="registrar_oficina" id="registrar_oficina" data-toggle="tooltip" data-placement="right" title="Registrar Oficina Administrativa">
            <div class="item-menu">
                <img src="<?=$base_url;?>public_html/imagenes/iconos/guardar.png" class="img_menu"/>
                <p>Registrar</p>
            </div>
        </a>

        <a href="Views/ver_oficinas.php" name="consultar_oficina" id="consultar_oficina" title="Consultar Oficinas registradas en el sistema">
         <div class="item-menu">
            <img src="<?=$base_url;?>public_html/imagenes/iconos/buscar2.png" class="img_menu"/>
            <p>Consultar</p>
        </div>
    </a>
</div>

<div style="width:100%;background:#3B5998; margin: 0;padding:12px;">
    <div class="container">
<!--********************************************************************
    **************************HEADER*********************************-->    
    <div class="row">            

        <div class="col-xs-1">
            <img src="<?=$base_url;?>public_html/imagenes/logoivss_blanco.png" style="width:60px;"/>
        </div>

        <div class="col-xs-4">
            <span id="titulo">Sistema De Fiscalización</span>
        </div>

        <div class="col-xs-4">
            <span id="saludo">Bienvenido <?=$_SESSION['USUARIO']['nombre']." ".$_SESSION['USUARIO']['apellido'];?> <span class="glyphicon glyphicon-user"></span> </span>         
        </div>

        <div class="col-xs-3">
            <span id="cerrar"><a href="<?=$base_url;?>resources/logout.php">Cerrar Sesión <span class="glyphicon glyphicon-log-out"></span></a></span>
            <span id="fecha"><?=Date("d-m-Y");?></span>
        </div>

    </div>  
</div>
</div>
<!--********************************************************************
    **************************MENU / CONTENIDOS**********************-->
    <div class="container">
        <div class="row">
            <div class="col-xs-11 col-xs-offset-1" id="contenidos" style="min-height:600px;">
                <div style="background:rgba(0,0,0,0.2);padding:25px;">                     
                    <h3>Módulo de Gestión de Oficinas Administrativas</h3><hr>
                    <p  style="font-size:.8em !important;text-align:justify;">En el panel Izquierdo encontrará las opciones relacionadas con la gestión de Oficinas Administrativas. Seleccione la acción
                        que desea realizar o seleccione la opcíon <strong>Volver</strong> para regresar al menú principal
                    </p>
                </div>

                <?php /* ?>
                <button type="button" class="btn btn-default btn-volver" id="btn-volver">
                    <span class="glyphicon glyphicon-arrow-left"></span> Volver
                </button>
                <?php */ ?>
            </div>
        </div>
    </div>
<!--********************************************************************
    **************************FOOTER*********************************-->
    <div style="width:100%;background:#3B5998; margin: 0; position:fixed;bottom: 0;left:0;" id="pie_pagina">
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
                            <a  id="volver_act" data-link="../sistemafiscal.php"  rel="popover" data-placement="left" data-content="Volver" data-trigger="hover">
                                <div style="cursor:pointer;padding:3px;" class="menu_inf_item" id="volver_act">
                                    <img src="<?=$base_url;?>public_html/imagenes/iconos/volver.png" style="width:30px;">
                                    <p style="font-size:0.7em;color:white;margin-top:10px;">Volver</p>
                                </div> 
                            </a>
                        </div>

                        <div style="width:100px;float:left;">
                            <a onClick="location='<?=$base_url;?>'" id="menu_principal"  rel="popover" data-placement="left" data-content="Ir al menu principal" data-trigger="hover">
                                <div style="cursor:pointer;padding:3px;" class="menu_inf_item" >
                                    <img src="<?=$base_url;?>public_html/imagenes/iconos/home.png" style="width:30px;">
                                    <p style="font-size:0.7em;color:white;margin-top:10px;">Menu home</p>
                                </div>    
                            </a>
                        </div>

                    </div><!--Navegación inferior-->

                </div>
            </div>
        </div>
    </div>   


    <!--*******************************************************************************************-->
    <div id="mensajeCargando" style="display:none;position:fixed;z-index:100000;background:rgba(0,0,0,0.8);width:100%;height:100%;top:0;left:0;">
        <div id="error_msnced" title="Mensaje" style="z-index:10;width:600px;hight:300px;margin:auto;margin-top:150px;background:rgba(255,255,255,0.8);" >
            <div id="titulo_msnced" style="background:#3B5998;color:white;padding:10px;margin:auto;font-size:1.4em; ">
                Por favor espere ...
                <div style="width:21px;float:right;cursor:pointer;display:none;" title="Cerrar mensaje" id="cerrar_msnced">
                    <span class="glyphicon glyphicon-remove"></span>
                </div>
            </div>                                     
            <div class="mensaje_loading" style="padding:25px 25px 25px 25px;font-size:1.3em;">
                <img src='http://desarrollofiscalizacion.ivss.int/public_html/imagenes/Cargando2.gif' style='width:150px;height:auto;opacity:1;'>
            </div>
        </div>
    </div>
    <!--*******************************************************************************************-->
    
    <!---------------------------------------------------------------------------------------------------------->
    <div style='position:fixed; top:0; left:0;z-index:12;width:100%;height:100%;background:rgba(0,0,0,0.6); display: none;' id="mensaje">
        <div style="width:50%;margin:auto;margin-top:100px;background:#f1f1f1;padding:25px;">
            <h1> <?php if( isset($_GET['mensaje']) ) { echo $_GET['mensaje']; }?></h1><hr>
        </div>
    </div>

    <!---------------------------------------------------------------------------------------------------------->

<!--********************************************************************
    **************************SCRIPTS********************************-->
    <script type="text/javascript" src="<?=$base_url;?>public_html/js/jquery-2.1.4.min"></script>
    <script type="text/javascript" src="<?=$base_url;?>public_html/js/mostrarContenido.js"></script>
    <script type="text/javascript" src="<?=$base_url;?>public_html/js/consultar.js"></script>
    <script type="text/javascript" src="<?=$base_url;?>public_html/vendor/jquery-ui/jquery-ui.min.js"></script>
    <script type="text/javascript" src="<?=$base_url;?>public_html/js/valida_login.js"></script>
    <script type="text/javascript" src="<?=$base_url;?>public_html/js/bootstrap/js/bootstrap.min.js"></script>
    
    <script>
        $(document).on('ready', function() {
            $("#btn-volver").on('click', function() {
                document.location.href="../sistemafiscal.php";
            });

            $('#registrar_oficina,#consultar_oficina,#volver_act,#menu_principal').popover({ trigger: "hover" });

            /***********************************************************************************/
            $("#registrar_oficina, #consultar_oficina").on("click",function(){
                $("#volver_act").attr("data-link","oficinas.php"); 
            });

            $("#volver_act").on("click",function(e){
                e.preventDefault();
                window.document.location=$(this).data("link"); 
            });
            /***********************************************************************************/
            <?php if( isset($_GET['mensaje']) ) { ?>
                $('#mensaje').fadeIn('fast').delay(2000).fadeOut('fast').delay(500,function(){
            //window.document.location="denuncias.php";
        });

                <?php } ?>  

                <?php if( isset($_GET['ivss']) ) { ?>
                    var href = "Views/ver_oficinas.php";
                    $("#contenidos").load(href);
                    $("#volver_act").attr("data-link","oficinas.php").data("link","oficinas.php"); 
                    <?php } ?> 

                });

            </script>

        </body>
        </html>