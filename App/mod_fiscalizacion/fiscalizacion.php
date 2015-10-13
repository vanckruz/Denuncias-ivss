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
<!doctype html>
<html lang="ES">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximun-scale=1">
    <link href="<?=$base_url;?>public_html/css/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="<?=$base_url;?>public_html/css/styles2.css" rel="stylesheet" type="text/css">
    <link href="<?=$base_url;?>public_html/css/formularios.css" rel="stylesheet"/>
    <title>Sistema de Fiscalización</title>
</head>
<style>
    .popover{
        width: 400px;
    }

    .menu_inf_item:hover{
      background: #9ECC02;
      box-shadow: inset 0px 5px 20px #466101;
  }

  .content-menu{
    width:160px;
    position:absolute;
    top:84px;
    left:0;
}
.item-menu{
    width:160px;
    height:83px;
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
    width:40px;
    height:auto;
    margin:auto;
    margin-top:2px;
    opacity:0.7;
}

</style>
<body style="background:linear-gradient(to right, #AFA19E, #E7E7FF, #E7E7E7, #8E8E8E) no-repeat scroll 0% 0% #8E8E8E;height:auto;">
    <div class="content-menu">
        <a href="Views/formqueryempresa.php" name="fiscalizar" id="fiscalizar" data-content="Modulo para la gestión de fiscalización de empresas" rel="popover" data-placement="right" data-original-title="Fiscalizar" data-trigger="hover">
            <div class="item-menu">
               <img src="<?=$base_url;?>public_html/imagenes/iconos/fiscalizar.png" class="img_menu"/>
               <p>Generar Ficha Técnica</p>
           </div>
       </a>

       <a href="Views/listafichatecnica.php" name="" id="empresas_fiscalizadas" data-content="Modulo para la gestión de fiscalización de empresas" rel="popover" data-placement="right" data-original-title="Empresas fiscalizadas" data-trigger="hover">
        <div class="item-menu">
            <img src="<?=$base_url;?>public_html/imagenes/iconos/oficinas2.png" class="img_menu"/>
            <p>Fiscalizaciones</p>
        </div>
    </a>

    <a href="../mod_multas/determinacion.php" id="determinacion" data-content="Modulo para la gestión de multas a empresas fiscalizadas" rel="popover" data-placement="right" data-original-title="Gestión de multas" data-trigger="hover">
        <div class="item-menu">
            <img src="<?=$base_url;?>public_html/imagenes/iconos/fiscalizacion2.png" class="img_menu"/>
            <p>Multas</p>
        </div>
    </a>

    <a href="../mod_UT/unidadt.php" id="control" data-content="Modulo para la gestión de unidades tributarias" rel="popover" data-placement="right" data-original-title="Control de unidades tributarias" data-trigger="hover">
        <div class="item-menu">
            <img src="<?=$base_url;?>public_html/imagenes/iconos/tiempo_dinero.png" class="img_menu"/>
            <p>Unidades T.</p>
        </div>
    </a>

    <a href="#" name="" id="reportes" data-content="Modulo para la gestión reportes" rel="popover" data-placement="right" data-original-title="Reportes graficos" data-trigger="hover">
        <div class="item-menu">
            <img src="<?=$base_url;?>public_html/imagenes/iconos/reporte1.png" class="img_menu"/>
            <p>Reportes</p>
        </div>
    </a> 
</div>

<div style="width:100%;background:#3B5998; margin: 0;padding:12px;">
    <div class="container">
        <div class="row">            

            <div class="col-xs-1">
                <img src="<?=$base_url;?>public_html/imagenes/logoivss_blanco.png" style="width:60px;"/>
            </div>

            <div class="col-xs-4">
                <span id="titulo">SISTEMA DE FISCALIZACIÓN DEL IVSS</span>
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
<div class="container">
    <div class="row">
        <div class="col-xs-11 col-xs-offset-1" id="contenidos" style="min-height:600px;">
            <div style="background:rgba(0,0,0,0.2);padding:25px;">
                <h3>Módulo de Fiscalización</h3><hr>
                <p style="font-size:.8em !important;text-align:justify;">En el panel Izquierdo encontrará las opciones relacionadas con el proceso de Fiscalización. Seleccione la acción
                    que desea realizar o seleccione la opcíon <strong>Volver</strong> para regresar al menú principal
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
                            <a  id="volver_act" data-link="../sistemafiscal.php" rel="popover" data-placement="left" data-content="Volver" data-trigger="hover">
                                <div style="cursor:pointer;padding:3px;" class="menu_inf_item" id="volver_act">
                                    <img src="<?=$base_url;?>public_html/imagenes/iconos/volver.png" style="width:30px;">
                                    <p style="font-size:0.7em;color:white;margin-top:10px;">Volver</p>
                                </div> 
                            </a>
                        </div>

                        <div style="width:100px;float:left;">
                            <a onClick="location='<?=$base_url;?>'" id="menu_principal" rel="popover" data-placement="left" data-content="Ir al menu principal" data-trigger="hover">
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
    <script type="text/javascript" src="../../public_html/js/jquery-2.1.4.min.js"></script>
    <script type="text/javascript" src="../../public_html/js/bootstrap/js/bootstrap.js"></script>
    <script type="text/javascript" src="../../public_html/js/mostrarContenido.js"></script>
    <script type="text/javascript" src="../../public_html/js/valida_login.js"></script>
    <script type="text/javascript" src="../../public_html/js/consultar.js"></script>
    <script>
        $(document).ready(function()
        {
            var pag = "../sistemafiscal.php";
            $("#btn-volver").on('click', function()
            {
                location.href=pag;
            });

            $('#empresas_fiscalizadas,#fiscalizar,#multas,#determinacion,#control,#reportes,#volver_act,#menu_principal').popover({ trigger: "hover" });

            /***********************************************************************************/
            $("#fiscalizar,#empresas_fiscalizadas,#determinacion, #control, #reportes").on("click",function(){
                $("#volver_act").data("link","fiscalizacion.php"); 
            });

            $("#volver_act").on("click",function(){
                window.document.location=$(this).data("link"); 
            });
            /***********************************************************************************/                   

        });
    </script>
</body>
</html>