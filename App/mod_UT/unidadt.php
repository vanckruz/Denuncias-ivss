<?php
session_start();
if(!isset($_SESSION['USUARIO']))
{
    header('location:../../index');
}
?>
<!doctype html>
<html lang="ES">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximun-scale=1">
    <link href="../../public_html/css/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="../../public_html/css/styles2.css" rel="stylesheet" type="text/css">
    <link href="../../public_html/css/formularios.css" rel="stylesheet"/>
    <link href="../../public_html/vendor/jquery-ui/jquery-ui.min.css" rel="stylesheet" type="text/css">
    <link href="../../public_html/vendor/jquery-ui/jquery-ui.theme.min.css" rel="stylesheet" type="text/css">
    <title>Sistema de Fiscalización</title>
    <style>
        .popover{
            width: 300px;
        }

        .content-menu{
            width:190px;
            position:absolute;
            top:84px;
            left:0;
            z-index:10;
        }
        .item-menu{
            width:190px;
            height:75px;
            background:#3B5998;
            border-top:1px dotted #f1f1f1;
            padding:5px;
        }
        .item-menu:hover{
            background: #9ECC02;
            box-shadow: inset 0px 5px 20px #466101;
            /*cursor:url("../public_html/imagenes/ivss_logo_cursor.png"),auto;*/
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
            width:40px;
            height:auto;
            margin:auto;
            margin-top:2px;
            opacity:0.7;
        }
    </style>    
</head>
<body style="background:linear-gradient(to right, #AFA19E, #E7E7FF, #E7E7E7, #8E8E8E) no-repeat scroll 0% 0% #8E8E8E;height:100%;">
    <div class="content-menu">
        <a href="Views/forminsertut.php" name="registraut" id="registraut" data-toggle="tooltip" data-placement="right" title="Registrar Oficina Administrativa">
            <div class="item-menu">
                <img src="../../public_html/imagenes/iconos/guardar.png" class="img_menu"/>
                <p>Registrar</p>
            </div>
        </a>

        <a href="Views/formqueryut.php" name="consultaut" id="consultaut" title="Consultar Oficinas registradas en el sistema">
         <div class="item-menu">
            <img src="../../public_html/imagenes/iconos/buscar2.png" class="img_menu"/>
            <p>Consultar</p>
        </div>
    </a>
</div>

<div style="width:100%;background:#3B5998; margin: 0;padding:12px;">
    <div class="container">
        <div class="row">            

            <div class="col-xs-1">
                <img src="../../public_html/imagenes/logoivss_blanco.png" style="width:60px;"/>
            </div>

            <div class="col-xs-4">
                <span id="titulo">SISTEMA DE FISCALIZACIÓN DEL IVSS</span>
            </div>

            <div class="col-xs-4">
                <span id="saludo">Bienvenido <?=$_SESSION['USUARIO']['nombre']." ".$_SESSION['USUARIO']['apellido'];?> <span class="glyphicon glyphicon-user"></span> </span>         
            </div>

            <div class="col-xs-3">
                <span id="cerrar"><a href="../resources/logout.php">Cerrar Sesión <span class="glyphicon glyphicon-log-out"></span></a></span>
                <span id="fecha"><?=Date("d-m-Y");?></span>
            </div>

        </div>  

    </div><!--container 1-->
</div> 
<!--********************************************************************
    **************************MENU / CONTENIDOS**********************-->
    <div class="container">
        <div class="row">


            <div class="col-xs-10 contenidos" id="contenidos">
                <h2>Módulo de Control de Unidad Tributaria (UT) del Sistema de Fiscalización del IVSS.</h2>
                <p class="parrafo">En el panel Izquierdo encontrará las opciones relacionadas con la gestión de Unidades Tributarias.                       
                    Seleccione la acción que desea realizar o seleccione la opción <strong>Volver</strong> para regresar al menú principal
                </p>
                <button type="button" class="btn btn-default btn-volver" id="btn-volver">
                    <span class="glyphicon glyphicon-arrow-left"></span> Volver
                </button>
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

                    <div style="position:absolute;top:16px;right:60px;width:150px;border:1px solid white;">
                        <a data-link="../sistemafiscal.php" id="volver_act" rel="popover" data-placement="left" data-content="Volver" data-trigger="hover">
                            <div style="width:50px;display:inline;cursor:pointer;padding:12px;" class="menu_inf_item">
                                <img src="../../public_html/imagenes/iconos/volver.png" style="width:40px;">
                            </div> 
                        </a>
                        <a onClick="location='../sistemafiscal.php'" id="menu_principal" rel="popover" data-placement="left" data-content="Ir al menu principal" data-trigger="hover">
                            <div style="width:50px;display:inline;margin-left:12px;cursor:pointer;padding:12px;" class="menu_inf_item" >
                                <img src="../../public_html/imagenes/iconos/home.png" style="width:40px;">
                            </div>    
                        </a>
                    </div><!--Navegación inferior-->

                </div>
            </div>
        </div>
    </div>  

    <script type="text/javascript" src="../../public_html/js/jquery-2.1.4.min"></script>
    <script type="text/javascript" src="../../public_html/js/mostrarContenido.js"></script>
    <script type="text/javascript" src="../../public_html/js/consultar.js"></script>
    <script type="text/javascript" src="../../public_html/vendor/jquery-ui/jquery-ui.min.js"></script>
    <script type="text/javascript" src="../../public_html/js/valida_login.js"></script>
    <script>
        $(document).ready(function(){
            $("#btn-volver").on('click', function(){
                var pagina = "../mod_fiscalizacion/fiscalizacion.php";
                location.href=pagina;
            });
            $( "#datepicker" ).datepicker({
                changeMonth: true,
                changeYear: true
            });
        });

    </script>
</body>
</html>