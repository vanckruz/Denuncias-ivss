 <?php 
 session_start();
 include("../config/config.php");
 /********Validación de tiempo de sesión********************/
 if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 3600)) {
    //última petición fue hace más de 30 minutos
    session_unset();     // Vacia El array $_SESSION en tiempo de ejecucion
    session_destroy();   // destruye las sesiones almacenadas
}

$_SESSION['LAST_ACTIVITY'] = time();
/********Validación de tiempo de sesión********************/

/*
if( isset($_SESSION['USUARIO']) )
{
    if($_SESSION['USUARIO']['utype']==2)
        {header('Location:denuncias.analista.php');}
    elseif($_SESSION['USUARIO']['utype']==3)
        {header('Location:denuncias.responsable.php');}
    }else*/
    if( !isset($_SESSION['USUARIO']) ){
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
        .container{
            width: 960px !important;
        }
        .popover{
            width:500px;z-index:50;
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
        <a href="Views/forminsert.php" name="registrar" id="registrarden" class="cambia_link"  data-content="Esta opción permite registrar una denuncia en el sistema, con el número de cédula del ciudadano." rel="popover" data-placement="right" data-original-title="Registro de Denuncias" data-trigger="hover">
            <div class="item-menu">
                <img src="<?=$base_url;?>public_html/imagenes/iconos/guardar.png" class="img_menu"/>
                <p>Registrar</p>
            </div>
        </a>

        <a href="Views/formquery.php" name="consultar" id="consultarden" class="cambia_link"  data-original-title="Consultar Denuncias" data-content="Esta opción permite consultar las denuncias registradas en el sistema, con el número de cédula del ciudadano." rel="popover" data-placement="right" data-trigger="hover">
            <div class="item-menu">
                <img src="<?=$base_url;?>public_html/imagenes/iconos/buscar2.png" class="img_menu"/>
                <p>Consultar</p>
            </div>
        </a>

        <a href="Views/asignar_denuncia.php" name="asignar_den" id="asignar_den" class="cambia_link"  data-original-title="Asignar Denuncias" data-content="Esta opción permite asignar las denuncias a las distintas direcciones responsables." rel="popover" data-placement="right" data-trigger="hover">
            <div class="item-menu">
                <img src="<?=$base_url;?>public_html/imagenes/iconos/correo3.png" class="img_menu"/>
                <p>Asignar</p>
            </div>
        </a>

        <a href="Views/reportes_denuncias.php" name="reportes_den" id="reportes_den" class="cambia_link"  data-original-title="Reportes de Denuncias" data-content="Esta opción permite generar reportes en excel." rel="popover" data-placement="right" data-trigger="hover">
            <div class="item-menu">
                <img src="<?=$base_url;?>public_html/imagenes/iconos/reporte1.png" class="img_menu"/>
                <p>Reportes</p>
            </div>
        </a>
<?php /* 
        <a href="Views/documentos_denuncia.php" name="doc_den" id="doc_den" class="cambia_link" data-original-title="Gestión de Documentos a Consignar" data-content="Esta opción permite gestionar los documentos a consignar en el registro de denuncias" rel="popover" data-placement="right" data-trigger="hover">
            <div class="item-menu">
                <img src="<?=$base_url;?>public_html/imagenes/iconos/pages.png"  class="img_menu"/>
                <p>Documentos</p>
            </div>
        </a>

        <a href="Views/motivos_denuncias.php" name="mot_den" id="mot_den" class="cambia_link" data-original-title="Gestión de Motivos de Denuncias" data-content="Esta opción permite gestionar los motivos de denunicias en el registro de denuncias" rel="popover" data-placement="right" data-trigger="hover" >
            <div class="item-menu">
                <img src="<?=$base_url;?>public_html/imagenes/iconos/listado.png" class="img_menu"/>
                <p>Motivos</p>
            </div>
        </a>

        <a href="Views/direcciones_linea.php" name="dir_den" id="dir_den" class="cambia_link" data-original-title="Gestión de Direcciones de Linea" data-content="Esta opción permite gestionar las Direcciones de linea para las asignaciones con su correo electronico" rel="popover" data-placement="right" data-trigger="hover" >
            <div class="item-menu">
                <img src="<?=$base_url;?>public_html/imagenes/iconos/oficinas2.png" class="img_menu"/>
                <p>Direcciones</p>
            </div>
        </a>



        <a href="Views/estatus_denuncia.php" name="est_den" id="est_den" class="cambia_link" data-original-title="Gestión de Estatus de Denuncias" data-content="Esta opción permite gestionar los estatus para las denunicias." rel="popover" data-placement="right" data-trigger="hover" >
            <div class="item-menu">
                <img src="<?=$base_url;?>public_html/imagenes/iconos/ojo.png" alt="" class="img_menu">
                <p>Estatus</p>
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


<div class="container">   
    <div class="row">
        <div class="col-xs-11 col-xs-offset-1" id="contenidos" style="margin-bottom:50px;min-height:600px;">
            <div style="background:rgba(0,0,0,0.2);padding:25px;">
                <h3>Módulo de Denuncias</h3><hr>
                <p  style="font-size:.8em !important;text-align:justify;">En el panel izquierdo encontrará las opciones relacionadas con la gestión de denuncias. 
                    Seleccione la acción que desea realizar o seleccione la opción <strong>Volver</strong> para regresar 
                    al menú principal.Todas las acciones de este módulo están relacionadas con un ciudadano en particular.
                    Por ello, para poder realizar alguna acción, el sistema le solicitará consultar a dicho ciudadano para verificar 
                    si posee denuncias registradas en el sistema. En caso afirmativo, el sistema verifica automáticamente el estatus 
                    de las denuncias y de haber alguna que se encuentre <strong>"En proceso"</strong>, se mostrará un mensaje al usuario
                    indicando esta situación y no se permitirá registrar una nueva denuncia. En caso contrario, el sistema mostrará
                    directamente el formulario para registrar una nueva denuncia.Para consultar el estatus de las denuncias registradas por un ciudadano, seleccione
                    la opción <strong>Ver Denuncias</strong>. Esta opción le mostrará información relacionada 
                    con las denuncias registradas en el sistema.
                </p>
            </div>
            
                    <?php /* ?>
                <button type="button" class="btn btn-default btn-volver" id="btn-volver">
                    <span class="glyphicon glyphicon-arrow-left"></span> Volver
                </button><?php */ ?>
            </div>
        </div>
    </div><!--container 2-->

    <div style="width:100%;background:#3B5998; margin: 0; position:fixed;bottom: 0;left:0;">
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
        <h1> <?php if( isset($_GET['mensaje']) ) { echo $_GET['mensaje']; }?> <?php if( isset($_GET['msj']) ) { echo $_GET['msj'];} ?><?php if( isset($_GET['msjd']) ) { echo $_GET['msjd'];} ?></h1><hr>
    </div>
</div>

<!---------------------------------------------------------------------------------------------------------->



<script type="text/javascript" src="<?=$base_url;?>public_html/js/jquery-2.1.4.min.js"></script>
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

        $('#registrarden,#consultarden,#asignar_den,#reportes_den,#doc_den,#mot_den,#dir_den,#volver_act,#menu_principal').popover({ trigger: "hover" });

        /******************************************************************************************/
        $(".cambia_link").on("click",function(){
            $("#volver_act").attr("data-link","denuncias.php").data("link","denuncias.php");
            
            //alert($("#volver_act").data("link"));
        });

        $("#volver_act").on("click",function(){
            //alert($("#volver_act").data("link"));
            window.document.location=$(this).data("link"); 
        });
        /******************************************************************************************/
    });

    <?php if( isset($_GET['mensaje']) ) { ?>
        $('#mensaje').fadeIn('fast').delay(2000).fadeOut('fast').delay(500,function(){
            //window.document.location="denuncias.php";
        });

        <?php } ?>  

        <?php if( isset($_GET['ivss']) ) { ?>
            var href = "Views/formquery.php";
            $("#contenidos").load(href);
            $("#volver_act").attr("data-link","denuncias.php").data("link","denuncias.php"); 
            <?php } ?>  

            <?php if( isset($_GET['dgf']) ) { ?>
                var href2 = "Views/forminsert.php";
                $("#contenidos").load(href2);
                $("#volver_act").attr("data-link","denuncias.php").data("link","denuncias.php"); 
                <?php } ?>  

                <?php if( isset($_GET['asg']) ) { ?>
                    var href = "Views/asignar_denuncia.php";
                    $("#contenidos").load(href);
                    $("#volver_act").attr("data-link","denuncias.php").data("link","denuncias.php"); 
                    <?php } ?> 

                    <?php if( isset($_GET['doc']) ) { ?>
                        var href = "Views/documentos_denuncia.php";
                        $("#contenidos").load(href);
                        $("#volver_act").attr("data-link","denuncias.php").data("link","denuncias.php"); 
                        <?php } ?> 

                        <?php if( isset($_GET['mot']) ) { ?>
                            var href = "Views/motivos_denuncias.php";
                            $("#contenidos").load(href);
                            $("#volver_act").attr("data-link","denuncias.php").data("link","denuncias.php"); 
                            <?php } ?> 

                            <?php if( isset($_GET['dir']) ) { ?>
                                var href = "Views/direcciones_linea.php";
                                $("#contenidos").load(href);
                                $("#volver_act").attr("data-link","denuncias.php").data("link","denuncias.php"); 
                                <?php } ?> 

                                <?php if( isset($_GET['msjd']) ) { ?>
                                    $('#mensaje').fadeIn('fast').delay(2000).fadeOut('fast').delay(500,function(){
                                    }); 
                                    <?php } ?>   

                                    <?php if( isset($_GET['msj']) ) { ?>
                                        $('#mensaje').fadeIn('fast').delay(2000).fadeOut('fast').delay(500,function(){
                                            window.document.location="denuncias.php";
                                        }); 
                                        <?php } ?>      
                                    </script>
                                </body>
                                </html>