<?php 
    include("../../config/config.php");
 ?>
<!doctype html>
<html> 
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="<?=$base_url;?>public_html/css/bootstrap/css/bootstrap.css" rel="stylesheet"/>
    <link rel="stylesheet" href="<?=$base_url;?>public_html/css/mensajes.css"/>
    <title></title>
</head>
<body>
    <div class='principal'>
        <article id='contenedor_mensajes'>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-3">
                        <img src='<?=$base_url;?>public_html/imagenes/Info_Icon.png' class="img-responsive">
                    </div>
                    <div class="col-md9">
                        <span>
                            <p>Este Ciudadano posee actualmente una denuncia <strong>En Proceso.</strong></p>
                            <p>Debe esperar a que la misma sea procesada para poder registrar una nueva.</p>
                        </span>
                        <input type='button' class='boton' value='Aceptar' onClick=regresar();>
                    </div>
                </div>
            </div>     
        </article>
    </div>
</body>
</html> 