<?php 
    include('../../config/config.php');
 ?>
<!doctype html>
<html> 
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="../../../public_html/css/bootstrap/css/bootstrap.css" rel="stylesheet"/>
    <link rel="stylesheet" href="../../../public_html/css/mensajes.css"/>
    <title></title>
</head>
<body>
    <div class='principal'>
        <article id='contenedor_mensajes'>
            <div class="container-fluid">
        	   <div class="row">
                    <div class="col-md-3">
    		          <img src='../../../public_html/imagenes/Info_Icon.png' class="img-responsive">
                    </div>
                    <div class="col-md9">
                	   <span>
                    	   <p>Datos de Usuario actualizados correctamente!.</p>
                        </span>

                        <input type='button' class='boton' value='Aceptar' onClick=regresar();>      
                        
                    </div>
                </div>
            </div>     
        </article>
    </div>
</body>
</html>
<script>
    function regresar()
            {
               var pagina = '<?=$base_url;?>';
               location.href=pagina;
                /*-------- MEJORAR CERRANDO LA VENTANA ACTUAL ---------*/
                //window.("about:blank", "_self").close();
                /*-------- MEJORAR CERRANDO LA VENTANA ACTUAL ---------*/
            }
</script>