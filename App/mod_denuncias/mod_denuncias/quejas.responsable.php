 <?php 
 session_start();
 require("../config/config.php");
 error_reporting(E_ALL);
 ini_set("display_errors", 1);
 
 /********Validación de tiempo de sesión********************/
 if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 3600)) {
    //última petición fue hace más de 30 minutos
    session_unset();     // Vacia El array $_SESSION en tiempo de ejecucion
    session_destroy();   // destruye las sesiones almacenadas
}
/********Validación de tiempo de sesión********************/

if( isset($_SESSION['USUARIO']) )
{
    if($_SESSION['USUARIO']['utype']==2)
        {header('Location:quejas.analista.php');}
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
  <link href="<?=$base_url;?>public_html/css/styles2.css" rel="stylesheet"/>
  <link rel="stylesheet" type="text/css" href="<?=$base_url;?>public_html/vendor/jquery-ui/css/smoothness/jquery-ui-1.9.2.custom.min.css">
  <link rel="stylesheet" href="<?=$base_url;?>public_html/vendor/DataTables/media/css/jquery.dataTables.css">
  <script type="text/javascript" src="<?=$base_url;?>public_html/vendor/DataTables/media/js/jquery.dataTables.js"></script>
  <style>
    .popover{
        width: 400px;margin-left: 25px;
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
    border-top: 1px dotted #f1f1f1;
    padding:5px;
}
.item-menu:hover{
    background: #9ECC02;
    box-shadow: inset 0px 5px 20px #466101;
    cursor:pointer;
}

.item-menu a:hover{
    cursor:pointer
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

.numpat{
    width: 150px;
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
        <a href="Views/forminsert_queja.php" name="registrar" id="registrarden" data-content="Esta opción permite registrar una queja con un identificador de persona juridica." rel="popover" data-placement="right" data-original-title="Registro de Quejas" data-trigger="hover" >
            <div class="item-menu">  
                <img src="<?=$base_url;?>public_html/imagenes/iconos/guardar.png" class="img_menu"/>
                <p>Registrar</p>
            </div>
        </a>

        <a href="Views/formquery_quejas.php" name="consultar" id="consultarden"  data-content="Esta opción permite consultar las quejas registradas en el sistema de fiscalización del ivss." rel="popover" data-placement="right" data-original-title="Consulta de Quejas" data-trigger="hover">
            <div class="item-menu">  
                <img src="<?=$base_url;?>public_html/imagenes/iconos/buscar2.png" class="img_menu"/>
                <p>Consultar</p>
            </div>
        </a>
    <?php /* 
        <a href="Views/gestionarDocumentos.php" name="doc_den" id="doc_den" data-content="Esta opción permite gestionar los documentos a consignar para registrar una queja." rel="popover" data-placement="right" data-original-title="Gestión de Documentos" data-trigger="hover">
            <div class="item-menu">  
                <img src="../../public_html/imagenes/iconos/pages.png" class="img_menu"/>
                <p>Documentos</p>
            </div>
        </a>

        <a href="Views/gestionarMotivos.php" name="mot_den" id="mot_den"  data-content="Esta opción permite gestionar los motivos de quejas" rel="popover" data-placement="right" data-original-title="Gestión de Motivos" data-trigger="hover">
            <div class="item-menu">  
                <img src="../../public_html/imagenes/iconos/listado.png" height="64" width="64" class="img_menu"/>
                <p>Motivos</p>
            </div>
        </a>
    */ ?>

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
<!--********************************************************************
    **************************MENU / CONTENIDOS**********************-->
    <div class="container">
        <div class="row">
            <div class="col-xs-10 col-xs-offset-2" id="contenidos" style="min-height:600px;">
                <div style="background:rgba(0,0,0,0.2);padding:25px;">
                    <h3>Módulo de Quejas y Reclamos del Sistema de Fiscalización del IVSS</h3><hr>
                    <p  style="font-size:.8em !important;text-align:justify;">En el panel izquierdo encontrará las opciones relacionadas con la gestión de Quejas y Reclamos. 
                        Seleccione la acción que desea realizar o seleccione la opción <strong>Volver</strong> para regresar 
                        al menú principal.Para consultar el estatus de las quejas o reclamos registrados, seleccione
                        la opción <strong>Consultar</strong>. Esta opción le mostrará información relacionada con quejas y/o reclamos registradas
                        en el sistema. 
                    </p>
                <?php /* ?>
                <button type="button" class="btn btn-default btn-volver" id="btn-volver">
                    <span class="glyphicon glyphicon-arrow-left"></span> Volver
                </button>
                <?php */ ?>
            </div>
        </div>
    </div>
</div>
<!--********************************************************************
    **************************FOOTER*********************************-->
    <div style="width:100%;background:#3B5998; margin: 0; position: fixed;bottom: 0;left:0;">
        <div class="container">  
            <div class="row">
                <div class="col-xs-12" style="padding:7px;">
                    <p style="text-align:center;margin-top:7px;font-size:0.7em;color:white;">
                        LA SEGURIDAD SOCIAL ES TU DERECHO<br>
                        INSTITUTO VENEZOLANO DE LOS SEGUROS SOCIALES (IVSS) 2015<br>
                        DESARROLLADO POR LA DIRECCIÓN GENERAL DE INFORMÁTICA                
                    </p>

                    <div style="position:absolute;top:2px;right:25px;width:210px;border-left:1px solid white;">
                        <div style="width:100px;float:left;">
                            <a  id="volver_act" data-link="<?=$base_url;?>sistemafiscal.php" rel="popover" data-placement="left" data-content="Volver" data-trigger="hover">
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
<!--********************************************************************
    **************************SCRIPTS*********************************-->

    <script type="text/javascript" src="<?=$base_url;?>public_html/js/jquery-2.1.4.min"></script>
    <script type="text/javascript" src="<?=$base_url;?>public_html/vendor/jquery-ui/js/jquery-ui.min.js"></script>
    <script type="text/javascript" src="<?=$base_url;?>public_html/js/bootstrap/js/bootstrap.js"></script>
    <script type="text/javascript" src="<?=$base_url;?>public_html/js/mostrarContenido.js"></script>
    <script type="text/javascript" src="<?=$base_url;?>public_html/js/modernizr.custom.75139.js"></script>
    <script type="text/javascript" src="<?=$base_url;?>public_html/js/desplegable.js"></script>
    <script type="text/javascript" src="<?=$base_url;?>public_html/js/valida_login.js"></script>
    <script>
        $(document).ready(function()
        {
           var pag = "../sistemafiscal.php";
           $("#btn-volver").on('click', function()
           {
            location.href=pag;
        });

           $('#registrarden,#consultarden,#doc_den,#mot_den,#volver_act,#menu_principal').popover({trigger:"hover"});


           /***********************************************************************************/
           $("#registrarden,#consultarden,#doc_den, #mot_den, #est_den").on("click",function(){
            $("#volver_act").data("link","quejas.php"); 
        });

           $("#volver_act").on("click",function(){
            window.document.location=$(this).data("link"); 
        });
           /***********************************************************************************/
       });

        <?php if( isset($_GET['ivss']) ) { ?>
            var href = "Views/formquery_quejas.php";
            $("#contenidos").load(href);
            $("#volver_act").data("link","quejas.php"); 
            <?php } ?> 

            <?php if( isset($_GET['dgf']) ) { ?>
                var href2 = "Views/forminsert_queja.php";
                $("#contenidos").load(href2);
                $("#volver_act").data("link","quejas.php"); 
                <?php } ?> 
            </script>
        </body>
        </html>