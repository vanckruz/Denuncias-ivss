<?php 
//require("../resources/restrictedaccess.php");
session_start();
ini_set("session.cookie_lifetime","5");
ini_set("session.gc_maxlifetime","5");
require("config/config.php");

/********Validación de tiempo de sesión********************/
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 3600)) {
    //última petición fue hace más de 30 minutos
    session_unset();     // Vacia El array $_SESSION en tiempo de ejecucion
    session_destroy();   // destruye las sesiones almacenadas
}

$_SESSION['LAST_ACTIVITY'] = time();
/********Validación de tiempo de sesión********************/

if( isset($_SESSION['USUARIO']) )
{
    /*if($_SESSION['USUARIO']['utype']==2)
    {header('Location:sistemafiscal.analista.php');}*/
    if($_SESSION['USUARIO']['utype']==3)
        {header('Location:sistemafiscal.responsable.php');}
}else{
   header("Location: ".$base_url."index.php?s=0");
}

?>
<!doctype html>
<html lang="ES">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximun-scale=1">
    <link rel="shortcut icon" href="<?=$base_url;?>public_html/imagenes/favicon.ico" type="image/x-icon" />
    <link href="<?=$base_url;?>public_html/css/bootstrap/css/bootstrap.css" rel="stylesheet"/>
    <link href="<?=$base_url;?>public_html/css/styles2.css" rel="stylesheet" type="text/css">
    <title>Sistema de Fiscalización</title>
    <!--<script type="text/javascript" src="js/mostrarContenidos.js"></script>-->
</head>
<style>
    .popover{
        width: 300px;
    }

    .content-menu{
        width:150px;
        position:absolute;
        top:84px;
        left:0;
        z-index:10;
    }
    .item-menu{
        width:150px;
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

    #animacion_ivss{
        width:300px;
        height:auto;
        margin-top:100px;
        opacity:0.99;
        animation-duration:3s;
        animation-name:giro;
        animation-iteration-count:infinite;    

        -moz-animation-duration:3s;
        -moz-animation-name: giro;
        -moz-animation-iteration-count:infinite;   

        -webkit-animation-duration:3s;
        -webkit-animation-name: giro; 
        -webkit-animation-iteration-count:infinite;
    }


    @keyframes giro{
        25%{transform:rotateY(90deg);}
        50%{transform:rotateY(180deg);}
        75%{transform:rotateY(270deg);}
        100%{transform:rotateY(360deg);}
    }

    @-moz-keyframes giro{
        25%{-moz-transform:rotateY(90deg);}
        50%{-moz-transform:rotateY(180deg);}
        75%{-moz-transform:rotateY(270deg);}
        100%{-moz-transform:rotateY(360deg);}
    }

    @-webkit-keyframes giro{
        25%{-webkit-transform:rotateY(90deg);}
        50%{-webkit-transform:rotateY(180deg);}
        75%{-webkit-transform:rotateY(270deg);}
        100%{-webkit-transform:rotateY(360deg);}
    }

    #animacion_ivss:hover{
        -webkit-animation-play-state: paused; /* Chrome, Safari, Opera */
        animation-play-state: paused;
        cursor:url("../public_html/imagenes/ivss_logo_cursor.png"),auto;
    }


</style>
<body style="background:linear-gradient(to right, #AFA19E, #E7E7FF, #E7E7E7, #8E8E8E) no-repeat scroll 0% 0% #8E8E8E;height:100%;">

    <div class="content-menu">
        <a href="mod_denuncias/denuncias.analista.php" id="denuncia" data-content="Módulo para la gestión de denuncias del sistema de fiscalización del ivss" rel="popover" data-placement="right" data-original-title="Gestión de denuncias" data-trigger="hover"> 
           <div class="item-menu">       
            <img src="<?=$base_url;?>public_html/imagenes/iconos/denuncia.png" class="img_menu" />        
            <p>Denuncias</p>
        </div>
    </a>  

    <a href="mod_denuncias/quejas.analista.php" id="quejas" data-content="Módulo para la gestión de quejas y reclamos del sistema de fiscalización del ivss" rel="popover" data-placement="right" data-original-title="Gestión de Queja y Reclamos" data-trigger="hover">
        <div class="item-menu">
            <img src="<?=$base_url;?>public_html/imagenes/iconos/quejas.png" class="img_menu" />        
            <p>Quejas</p>
        </div>
    </a>

    <?php  /*
    <a href="mod_fiscalizacion/fiscalizacion.php" id="fiscalizacion" data-content="Módulo para la gestión de fiscalización de empresas" rel="popover" data-placement="right" data-original-title="Gestión de Fiscalización" data-trigger="hover">
        <div class="item-menu">
            <img src="../public_html/imagenes/iconos/fiscalizacion1.png" class="img_menu" />    
            <p>Fiscalización</p>
        </div>
    </a>

    <a href="mod_oficinas/oficinas.php" id="oficinas" data-content="Módulo para la gestión de oficinas administrativas del ivss" rel="popover" data-placement="right" data-original-title="Gestión de Oficinas Administrativas" data-trigger="hover">
        <div class="item-menu">       
            <img src="../public_html/imagenes/iconos/oficinas1.png" class="img_menu" />
            <p>Oficinas</p>
        </div>
    </a>

    <a href="mod_users/users.php" id="users" data-content="Módulo para la gestión de usuarios del sistema de fiscalización del ivss" rel="popover" data-placement="right" data-original-title="Gestión de usuarios" data-trigger="hover">
        <div class="item-menu">         
            <img src="../public_html/imagenes/iconos/usuarios.png" class="img_menu" />
            <p>Usuarios</p>
        </div>
    </a>
*/?>

<a href="ayuda.pdf" id="control" target="_blank" data-content="Manual de usuario y ayuda." rel="popover" data-placement="right" data-original-title="Ayuda" data-trigger="hover" >
    <div class="item-menu">
        <img src="<?=$base_url;?>public_html/imagenes/iconos/help.png" class="img_menu" />     
        <p>Ayuda</p>
    </div>   
</a> 

</div>
<!--Menu-->
<div style="width:100%;background:#3B5998; margin: 0;padding:12px;">
    <div class="container">
        <div class="row">            

            <div class="col-xs-1">
                <img src="<?=$base_url;?>public_html/imagenes/logoivss_blanco.png" style="width:60px;"/>
            </div>

            <div class="col-xs-4">
                <span id="titulo">SISTEMA DE FISCALIZACIÓN</span>
            </div>
            
            <div class="col-xs-4">
                <span id="saludo">Bienvenido <?=$_SESSION['USUARIO']['nombre']." ".$_SESSION['USUARIO']['apellido'];?> <span class="glyphicon glyphicon-user"></span> </span>         
            </div>
            
            <div class="col-xs-3">
                <span id="cerrar"><a href="<?=$base_url;?>resources/logout.php">Cerrar Sesión <span class="glyphicon glyphicon-log-out"></span></a></span>
                <span id="fecha"><?=Date("d-m-Y");?></span>
            </div>

        </div>  

    </div><!--container 1-->
</div>  
<div class="container">
 <div class="row">
    <div class="col-xs-9 col-xs-offset-2" id="contenidos">
        <img src='<?=$base_url;?>public_html/imagenes/logoivss.png' id="animacion_ivss"/>
    </div>
</div>
</div>

<div style="width:100%;background:#3B5998; margin: 0; position: fixed;bottom: 0;left:0;">
 <div class="container">  
     <div class="row">
        <div class="col-xs-12" style="color:white;padding:7px;">
            <p style="text-align:center;margin-top:7px;font-size:0.7em;">
                LA SEGURIDAD SOCIAL ES TU DERECHO<br>
                INSTITUTO VENEZOLANO DE LOS SEGUROS SOCIALES (IVSS) 2015<br>
                DESARROLLADO POR LA DIRECCIÓN GENERAL DE INFORMÁTICA                
            </p>
        </div>
    </div>

</div>
</div>  
<!--<script type="text/javascript" src="../public_html/js/jquery-1.11.2.min.js"></script>-->
<script type="text/javascript" src="<?=$base_url;?>public_html/js/jquery-2.1.4.min.js"></script>
<script type="text/javascript" src="<?=$base_url;?>public_html/vendor/jquery-ui/jquery-ui.min.js"></script>
<script type="text/javascript" src="<?=$base_url;?>public_html/js/bootstrap/js/bootstrap.js"></script>
<script type="text/javascript" src="<?=$base_url;?>public_html/js/valida_login.js"></script>
<script type="text/javascript" src="<?=$base_url;?>public_html/js/mostrarContenido.js"></script>
<script>
            // espera hasta que el DOM este cargado
            jQuery(document).ready(function () {
     // esconder el body para luego mostrarlo
     $('body').hide();

 });
// espera hasta que todo el contenido este descargado
jQuery(window).load(function(){
     // mostrar la etiqueta body lentamente
     $('body').fadeIn(1500);
 });

$(document).on("ready",function(){
   $('#denuncia,#quejas,#fiscalizacion,#oficinas,#users,#control').popover({ trigger: "hover" });
});
</script>
</body>
</html>