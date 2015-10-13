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
         <span> <p style="margin-top: 20px;">Registro actualizado exitosamente! </p></span><hr>
         <input type='button' class='btn btn-primary' style='width:200px; display: block;float:left;' id="imprimir" value='Imprimir Comprobante'>
         <input type='button' class='btn btn-primary' style="display: block; margin:10px auto;" value='Finalizar' onclick="location='../denuncias.php?dgf=r'" > 
       </div>
     </div>
   </div> 
   
 </article>
</div>

<!--Ventana modal con el pdf-->
<div id="content_pdf" style="position:fixed;top:0;left:0;width:100%;height:100%;display:none;background:rgba(0,0,0,0.5);">
  <div id="cerrar_pdf" style="position:absolute;top:40px;left:10px;z-index:500;cursor: pointer; color:white; font-size: 1.2em; font-weight: bolder;"><span class="glyphicon glyphicon-remove"></span> Cerrar</div>
  <div style="width:80%;height:100%;margin:auto;">
    <iframe id="pdf_denuncia" data-src="<?=$base_url;?>App/mod_denuncias/notificacion_cierre_denuncia.php?id_denuncia=<?=$id_denuncia?>" style="width:100%;height:100%;margin:auto;"></iframe>
  </div>  
</div>
<!--Ventana modal con el pdf-->

<!--
<script src="<?=$base_url;?>public_html/js/jquery-2.1.4.min.js"></script>
<script>
$(document).on("ready",function(){
    $("#imprimir").on("click",function(){
        window.location.href="../notificacion_cierre_denuncia.php?id_denuncia="+"<?php #echo $id_denuncia;?>";
    });
});
</script>
-->
</body>
</html>