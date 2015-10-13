<?php 
	require("../../resources/restrictedaccess.php");
?>
<!doctype html>
<html lang="ES">
    <head>
		<meta charset="utf-8">
        <!--<link href="../../public_html/css/bootstrap/css/bootstrap.css" rel="stylesheet"/>-->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="../../public_html/css/stylesbtsp.css" rel="stylesheet"/>
        <link href="../../public_html/css/bootstrap/css/bootstrap.css" rel="stylesheet"/>
		<title>Sistema de Fiscalización-Denuncias</title>
	</head>
    <body id="principal"> 
        <div class="container-fluid">
            <div class="row-fluid banner">
                <div class="col-md-5">
                    <header class="">
                        <figure>
                            <img src="../../public_html/imagenes/top.png" class="img-responsive"/>
                        </figure>
                    </header>
                </div>
                <div class="col-md-7"><!--OTRO CONTENIDO DEL HEADER--></div>
            </div>
            <div class="row-fluid nav_top">
                <div class="col-md-4"><span id="titulo">SISTEMA DE FISCALIZACIÓN DEL IVSS</span></div>
                <div class="col-md-4"><span id="saludo"><?=$_SESSION['USUARIO']['pnombre']." ".$_SESSION['USUARIO']['papellido'];?></span></div>
                <div class="col-md-2"><span id="cerrar"><a href="../../resources/logout.php">Cerrar Sesión</a></span></div>
                <div class="col-md-2"><span id="fecha"><?=Date("d-m-Y");?></span></div>
            </div>
            <section class="modules" id="modules">
            	<span class="titmod">Menú Denuncias</span>
                <a href="Views/forminsert.php" name="registrar" id="registrarden"><span id="tooltip" class="modulo" title="Registrar denuncia en el sistema"><img src="../../public_html/imagenes/folder.png"/>Registrar</span></a>
                <!--<a href="../../view/Denuncias/registroDenuncia.php" name="registrar" id="registrarden"><span id="tooltip" class="modulo" title="Registrar denuncia en el sistema"><img src="../imagenes/folder.png"/>Registrar</span></a>-->
                <a href="Views/formquery.php" name="consultar" id="consultarden"><span class="modulo" title="Consultar denuncias registradas en el sistema"><img src="../../public_html/imagenes/search.png"/>Consultar</span></a>
                <a href="Views/formupdate.php" name="actualizar" id="actualizarden"><span class="modulo" title="Editar Denuncia"><img src="../../public_html/imagenes/refresh.png"/>Actualizar</span></a>
                <a href="Views/formdelete.php" name="eliminar" id="eliminarden"><span class="modulo" title="Eliminar denuncias registradas en el sistema"><img src="../../public_html/imagenes/cancel.png"/>Eliminar</span></a>
                <a href="../sistemafiscal.php" name="regresar" id="regresar"><span class="modulo" title="Regresar al menú principal"><img src="../../public_html/imagenes/volver.png"/>Volver</span></a>
            </section>
            
            <section id="contenidos" class="contenidos">
            	<h2 class="tituloform">Módulo de denuncias del Sistema de Fiscalización del IVSS</h2>
                <p class="parrafo">En el panel izquierdo encontrará las opciones relacionadas con la gestión de denuncias. 
                	Seleccione la acción que desea realizar o seleccione la opción <strong>Volver</strong> para regresar 
                    al menú principal.
                </p>
                
                <p class="parrafo">Todas las acciones de este módulo están relacionadas con un ciudadano en particular.
                	Por ello, para poder realizar alguna acción, el sistema le solicitará consultar a dicho ciudadano para verificar 
                    si posee denuncias registradas en el sistema. En caso afirmativo, el sistema verifica automáticamente el estatus 
                    de las denuncias y de haber alguna que se encuentre <strong>"En proceso"</strong>, se mostrará un mensaje al usuario
                    indicando esta situación y no se permitirá registrar una nueva denuncia. En caso contrario, el sistema mostrará
                    directamente el formulario para registrar una nueva denuncia.
                </p>
                   
                <p class="parrafo">Para consultar el estatus de las denuncias registradas por un ciudadano, selccione
                	la opcion <strong>Consultar</strong>. Esta opción le mostrará información relacionada 
                    con las denuncias registradas por un ciudadano en particular.
                </p>
            </section>
            <footer class="foot">
        		<p>Esta Página está en Construcción</p>
        		<address>
            		&copy; 2015 IVSS
           		</address>
        	</footer>
        </div>
        <script type="text/javascript" src="../../public_html/js/jquery-1.11.0.js"></script>
        <script type="text/javascript" src="../../public_html/js/mostrarContenido.js"></script>
        <script type="text/javascript" src="../../public_html/js/modernizr.custom.75139.js"></script>
	    <script type="text/javascript" src="../../public_html/js/desplegable.js"></script>
        <script type="text/javascript" src="../../public_html/js/valida_login.js"></script>
    </body>
</html>