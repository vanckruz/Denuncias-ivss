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
    <link rel="shortcut icon" href="../../public_html/imagenes/favicon.ico" type="image/x-icon" />
    <link href="../../public_html/css/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="../../public_html/css/styles2.css" rel="stylesheet" type="text/css">
    <link href="../../public_html/css/formularios.css" rel="stylesheet"/>
    <link href="../../public_html/vendor/jquery-ui/jquery-ui.min.css" rel="stylesheet" type="text/css">
    <link href="../../public_html/vendor/jquery-ui/jquery-ui.theme.min.css" rel="stylesheet" type="text/css">
    <title>Sistema de Fiscalización | Empresas</title>
</head>
<body> 
    <div class="container">
<!--********************************************************************
    **************************HEADER*********************************-->    
    <div class="row">
        <header class="banner">
            <div class="col-xs-12">
                <figure>
                    <img src="../../../public_html/imagenes/top.png"/>
                </figure>   
            </div>
        </header> 
    </div>
<!--********************************************************************
    **************************NAV TOP********************************-->
    <div class="row">
        <nav class="nav_top">
            <div class="col-xs-3">
                <span id="titulo">SISTEMA DE FISCALIZACIÓN DEL IVSS</span>
            </div>
            <div class="col-xs-6">
                <span id="saludo"><span class="glyphicon glyphicon-user"></span> Bienvenido <?=$_SESSION['USUARIO']['nombre']." ".$_SESSION['USUARIO']['apellido'];?></span>         
            </div>
            <div class="col-xs-3">
                <span id="cerrar"><a href="../../resources/logout.php">Cerrar Sesión <span class="glyphicon glyphicon-log-out"></span></a></span>
                <span id="fecha"><?=Date("d-m-Y");?></span>
            </div>
        </nav>    
    </div>
<!--********************************************************************
    **************************MENU / CONTENIDOS**********************-->
    <div class="row">
        <div class="col-xs-2">
            <a href="Views/form_registro.php" name="registrarempresa" id="registrarempresa" data-toggle="tooltip" data-placement="right" title="Registrar empresa en el sistema"><span class="modulo" ><img src="../../public_html/imagenes/Folder.png"/>Registrar</span></a>
            <a href="Views/FormQueryEmpresa.php" name="consultarempresa" id="consultarempresa"><span class="modulo" title="Consultar empresas registradas en el sistema"><img src="../../public_html/imagenes/search.png"/>Consultar</span></a>
            <a href="Views/FormUpdateEmpresa.php" name="actualizarempresa" id="actualizarempresa"><span class="modulo" title="Eliminar empresas registradas en el sistema"><img src="../../public_html/imagenes/update.png"/>Actualizar</span></a>
            <a href="Views/FormDeleteEmpresa.php" name="eliminarempresa" id="eliminarempresa"><span class="modulo" title="Eliminar empresas registradas en el sistema"><img src="../../public_html/imagenes/cancel.png"/>Eliminar</span></a>
            <a href="../sistemafiscal.php" name="regresar" id="regresar"><span class="modulo" title="Regresar al menú principal"><img src="../../public_html/imagenes/volver.png"/>Volver</span></a> 
        </div>

        <div class="col-xs-10 contenidos" id="contenidos">
            <h2>Módulo Empresas</h2>
            <p class="parrafo">En el panel Izquierdo encontrará las opciones relacionadas con la gestión de Empresas. 
                Seleccione la acción que desea realizar o seleccione la opcíon <strong>Volver</strong> para regresar 
                al menú principal
            </p>
        </div>
    </div>
<!--********************************************************************
    **************************FOOTER*********************************-->
    <div class="row">
        <footer class="foot">
            <p>DISEÑADO POR LA DIRECCIÓN GENERAL DE INFORMÁTICA DEL IVSS. <?=date('Y')?>.</p>
        </footer>
    </div>
</div><!--Container-->
<!--********************************************************************
    **************************SCRIPTS********************************-->
    <script type="text/javascript" src="../../public_html/js/jquery-2.1.4.min"></script>
    <script type="text/javascript" src="../../public_html/js/mostrarContenido.js"></script>
    <script type="text/javascript" src="../../public_html/js/consultar.js"></script>
    <script type="text/javascript" src="../../public_html/vendor/jquery-ui/jquery-ui.min.js"></script>
    <script type="text/javascript" src="../../public_html/js/valida_login.js"></script>
    <script type="text/javascript" src="../../public_html/js/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>