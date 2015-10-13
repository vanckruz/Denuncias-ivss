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
    <title>Sistema de Fiscalización</title>
</head>
<style>
    .container{
        width: 960px !important;
    }
    .popover{
        width:500px;
    }

    .content-menu{
        width:180px;
        position:absolute;
        top:84px;
        left:0;
    }
    .item-menu{
        width:160px;
        height:90px;
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
        width:45px;
        height:auto;
        margin:auto;
        margin-top:2px;
        opacity:0.8;
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
</style>
<body> 
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
                    <span id="cerrar"><a href="../../resources/logout.php">Cerrar Sesión <span class="glyphicon glyphicon-log-out"></span></a></span>
                    <span id="fecha"><?=Date("d-m-Y");?></span>
                </div>

            </div>  
        </div>
    </div>

    <div class="container">
<!--********************************************************************
    **************************HEADER*********************************-->    

<!--********************************************************************
    **************************MENU / CONTENIDOS**********************-->
    <div class="row">
        <div class="col-xs-2">
            <a href="#" name="registrar" id="registrar"><span class="modulo"></span></a>
            <a href="#" name="consulta" id="consultar"><span class="modulo"></span></a>
            <a href="#" name="eliminar" id="eliminar"><span class="modulo"></span></a> 
        </div>
        
        <div class="col-xs-10 contenidos" id="contenidos">
            <h2>Módulo de Multas</h2>
            <p class="parrafo">En el panel Izquierdo encontrará las opciones relacionadas con la gestión de Multas. Seleccione la acción
                que desea realizar o seleccione la opcíon <strong>Volver</strong> para regresar al menú principal</p>
                <button type="button" class="btn btn-default btn-volver" id="btn-volver">
                    <span class="glyphicon glyphicon-arrow-left"></span> Volver
                </button>
            </div>
        </div>
<!--********************************************************************
    **************************FOOTER*********************************-->
    <div style="width:100%;background:#3B5998; margin: 0; position:fixed;bottom: 0;left:0;">
       <div class="container">  
           <div class="row">
            <div class="col-xs-12" style="padding:7px;">
                <p style="text-align:center;margin-top:7px;font-size:0.7em;color:white;">
                    LA SEGURIDAD SOCIAL ES TU DERECHO<br>
                    INSTITUTO VENEZOLANO DE LOS SEGUROS SOCIALES (IVSS) 2015<br>
                    DESARROLLADO POR LA DIRECCIÓN GENERAL DE INFORMÁTICA                
                </p>
                
                <div style="position:absolute;top:16px;right:60px;width:150px;border:1px solid white;">
                    <a onClick="window.location.reload()" id="volver_act" rel="popover" data-placement="top" data-content="Volver" data-trigger="hover">
                        <div style="width:50px;display:inline;cursor:pointer;padding:12px;" class="menu_inf_item" id="volver_act">
                            <img src="../../public_html/imagenes/iconos/volver.png" style="width:40px;">
                        </div> 
                    </a>
                    <a onClick="location='http://desarrollofiscalizacion.ivss.int/'" id="menu_principal" rel="popover" data-placement="top" data-content="Ir al menu principal" data-trigger="hover">
                        <div style="width:50px;display:inline;margin-left:12px;cursor:pointer;padding:12px;" class="menu_inf_item" >
                            <img src="../../public_html/imagenes/iconos/home.png" style="width:40px;">
                        </div>    
                    </a>
                </div><!--Navegación inferior-->

            </div>
        </div>

    </div>
</div> 
</div><!--Container-->
<script type="text/javascript" src="../../public_html/js/jquery-2.1.4.min.js"></script>
<script type="text/javascript" src="../../public_html/js/mostrarContenido.js"></script>
<script type="text/javascript" src="../../public_html/js/valida_login.js"></script>
<script>
    $(document).ready(function()
    {
        var pag = "../mod_fiscalizacion/fiscalizacion.php";
        $("#btn-volver").on('click', function()
        {
            location.href=pag;
        });
    });
</script>
</body>
</html> 