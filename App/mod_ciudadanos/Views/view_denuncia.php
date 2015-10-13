<?php include("../../config/config.php"); ?>
<!DOCTYPE html>
<html lang="ES">
<head>
	<meta charset="utf-8">
    <title>Denuncias</title>
  <link rel="stylesheet" type="text/css" href="<?=$base_url;?>public_html/css/bootstrap/css/bootstrap.min.css" />
	<link rel="stylesheet" type="text/css" href="<?=$base_url;?>public_html/css/visualizerut.css"/>
  <link href="<?=$base_url;?>resources/jquery.confirm/jquery.confirm/jquery.confirm.css" rel="stylesheet" />
  <link rel="stylesheet" href="<?=$base_url;?>public_html/vendor/DataTables/media/css/jquery.dataTables.css">
<style>
input,select,label{
  color:black !important;
}    

</style>
</head>
<body>
<div class="principal" style="color:black !important;margin-top:0px !important;">
<!--<img class='imgsuperior' src='<?=$base_url;?>public_html/imagenes/search.png'/>-->
<!--<section class='container'>-->
    <h3 style="background:#234181 linear-gradient(#639ACA, #6095C4 20%, #3368A0 60%, #234181 100%) repeat scroll 0% 0% !important;color:white;margin-top:0px;padding:16px;">Resultados de la búsqueda</h3><br>
    <article class='personaldata'>
        <span>Cédula: <?=$cedula?></span>
        <span>Nombre: <?=$nombre." ".$apellido?></span>
    </article>
    <h4 style="margin-top:60px !important">Denuncias Registradas a Empresas</h4>
    <form name='details' id='details' action='Controller.Denuncia.php' method='post'>
    <input type="hidden" name="id" value="" id="id" />
    <input type="hidden" name="option" value="" id="option" />
<!--/******************************************************************************************************/-->    
<!--<div style="margin-left:25px;margin-right:25px;">-->
<div>
<table class='table table-bordered table-hover' id="tabla_consulta " style="padding:7px;">
      <thead>
         <tr>
          <th class="text-center" style="background:#234181 linear-gradient(#639ACA, #6095C4 20%, #3368A0 60%, #234181 100%) repeat scroll 0% 0% !important;color:white !important;">N° Denuncia</th>
          <th class="text-center" style="background:#234181 linear-gradient(#639ACA, #6095C4 20%, #3368A0 60%, #234181 100%) repeat scroll 0% 0% !important;color:white !important;">N° Patronal</th>
          <th class="text-center" style="background:#234181 linear-gradient(#639ACA, #6095C4 20%, #3368A0 60%, #234181 100%) repeat scroll 0% 0% !important;color:white !important;">Nombre Empresa</th>
          <th class="text-center" style="background:#234181 linear-gradient(#639ACA, #6095C4 20%, #3368A0 60%, #234181 100%) repeat scroll 0% 0% !important;color:white !important;">Estatus</th>
          <th class="text-center" style="background:#234181 linear-gradient(#639ACA, #6095C4 20%, #3368A0 60%, #234181 100%) repeat scroll 0% 0% !important;color:white !important;"><span class="glyphicon glyphicon-search"></span></th>
          <th class="text-center" style="background:#234181 linear-gradient(#639ACA, #6095C4 20%, #3368A0 60%, #234181 100%) repeat scroll 0% 0% !important;color:white !important;"><span class="glyphicon glyphicon-pencil"></span></th>
          <!--<th class="text-center" style="background:#234181 linear-gradient(#639ACA, #6095C4 20%, #3368A0 60%, #234181 100%) repeat scroll 0% 0% !important;color:white !important;"><span class="glyphicon glyphicon-remove"></span></th>-->
        </tr>
      </thead>
<tbody>
  <?php 
    /*echo "<pre>";
      print_r($den);
      echo "</pre>";
      */      
  ?>
    <?php foreach($den as $key){
      $empresa = $modelo->queryByPatrono($key->__GET('id_empresa'));?>
           
           <tr>
              <td><?=$key->__GET('id_denuncia')?></td>
              <td><?=$key->__GET('id_empresa')?></td>
              <td><?=$empresa->__GET('nombre_fisc_empresa')?></td>
            
              <td><?=$sts[$key->__GET('estatus_denuncia')]?></td>
              <!--<td><input type="submit" id="<?=$key->__GET('id_denuncia')?>" value="" class='submit detailsden'/><span class="glyphicon glyphicon-pencil"></td>
              <td><input type="submit" id="<?=$key->__GET('id_denuncia')?>" value="" class='submit updateden'/></td>
              <td><input type="button" id="<?=$key->__GET('id_denuncia')?>" value="" class='submit eliminar'/></td>-->
              <td style="vertical-align: middle"><button type="button" id="<?=$key->__GET('id_denuncia')?>" value="" class='submit detailsden btn_opcion' title="Detalles"><span class="glyphicon glyphicon-zoom-in"></span></button></td>
              <td style="vertical-align: middle"><button type="submit" id="<?=$key->__GET('id_denuncia')?>" value="" class='submit updateden btn_opcion' title="Editar"/><span class="glyphicon glyphicon-pencil"></span></button></td>
              <!--<td style="vertical-align: middle"><button type="button" id="<?=$key->__GET('id_denuncia')?>" value="" class='submit eliminar btn_opcion' title="Eliminar"><span class="glyphicon glyphicon-remove"></span></button></td>-->
              
           </tr>
      <?php }?>
      </tbody>

        <tfoot style="display:none;">
        <tr style="color:white;background: #234181 linear-gradient(#639ACA, #6095C4 20%, #3368A0 60%, #234181 100%) repeat scroll 0% 0%;">
          <th class="text-center">N° Denuncia</th>
          <th class="text-center">N° Patronal</th>
          <th class="text-center">Nombre Empresa</th>
          <th class="text-center">Estatus</th>
          <th class="text-center"><span class="glyphicon glyphicon-search"></span></th>
          <th class="text-center"><span class="glyphicon glyphicon-pencil"></span></th>
          <!--<th class="text-center"><span class="glyphicon glyphicon-remove"></span></th>-->
        </tr>
      </tfoot>
   </table>

   </form>
</div>
<input type='button' class='boton' value='Volver' onClick='regresar();' style="float:right;padding:3px;color:white !important;font-weight:bold;margin-right:10px; margin-top: 1px;">

<!--/******************************************************************************************************/-->   
   <script type="text/jscript" src="<?=$base_url;?>public_html/js/jquery-2.1.4.min.js"></script>
   <script type="text/javascript" src="<?=$base_url;?>public_html/js/enviar.js"></script>
   <script type="text/javascript" src="<?=$base_url;?>resources/jquery.confirm/jquery.confirm/jquery.confirm.js"></script>
  <script type="text/javascript" src="<?=$base_url;?>resources/jquery.confirm/js/script.js"></script>
<script type="text/javascript" src="<?=$base_url;?>public_html/vendor/DataTables/media/js/jquery.dataTables.js"></script>
   <script type='text/javascript'>
      function regresar()
      {
          var pagina = '<?=$base_url;?>App/mod_denuncias/denuncias.php';
          location.href=pagina;
      }

    $(document).ready(function($) {
      $("#tabla_consulta").dataTable();
    });
  </script>
   </section>
 </div>
 </body>
 </html>
  
  