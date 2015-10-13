<?php  include("../../config/config.php"); ?>
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

        <span>Nombre:&nbsp;&nbsp;<?=$denuncia[0]->__GET('nombre_empresa')?></span>
        <span>N° Patronal:&nbsp;&nbsp;<?=$denuncia[0]->__GET('id_empresa')?></span>
        <h4 class="representante">Representante Legal:</h4>
        <span>Cédula Representante:&nbsp;&nbsp;<?=$denuncia[0]->__GET('id_representante')?></span>
        <span>Nombre Representante:&nbsp;&nbsp;<?=$denuncia[0]->__GET('nombre_representante')."  ". $denuncia[0]->__GET('apellido_representante')?></span>
    </article>
    <h4 class="titulo">Quejas/Reclamos Registrados</h4>
    <form name='details' id='details' action='Controller.Denuncia.php' method='post'>
    <input type="hidden" name="id" value="" id="id" />
    <input type="hidden" name="option" value="" id="option" />
<!--/******************************************************************************************************/-->    
<div style="margin-left:25px;margin-right:25px;">
<table class='table table-bordered table-hover' id="">
      <thead>
        <tr>
          <th class="text-center" style="background:#234181 linear-gradient(#639ACA, #6095C4 20%, #3368A0 60%, #234181 100%) repeat scroll 0% 0% !important;color:white !important;">N° Queja/Reclamo</th> 
          <th class="text-center" style="background:#234181 linear-gradient(#639ACA, #6095C4 20%, #3368A0 60%, #234181 100%) repeat scroll 0% 0% !important;color:white !important;">Fecha</th>
          <th class="text-center" style="background:#234181 linear-gradient(#639ACA, #6095C4 20%, #3368A0 60%, #234181 100%) repeat scroll 0% 0% !important;color:white !important;">Responsable</th>
          <th class="text-center" style="background:#234181 linear-gradient(#639ACA, #6095C4 20%, #3368A0 60%, #234181 100%) repeat scroll 0% 0% !important;color:white !important;">Estatus</th>
          <th class="text-center" style="background:#234181 linear-gradient(#639ACA, #6095C4 20%, #3368A0 60%, #234181 100%) repeat scroll 0% 0% !important;color:white !important;"><span class="glyphicon glyphicon-search"></span></th>
          <th class="text-center" style="background:#234181 linear-gradient(#639ACA, #6095C4 20%, #3368A0 60%, #234181 100%) repeat scroll 0% 0% !important;color:white !important;"><span class="glyphicon glyphicon-pencil"></span></th>
          
        </tr>
      </thead>

    <tbody>
<?php
  //$denuncia->selfIteratorRow($denuncia);
  foreach ($denuncia as $key) {
?>    
  <tr>
        <td><?=$key->__GET('id_denuncia')?></td>
        <td><?=$key->__GET('fecha_denuncia')?></td>
        <td><?=$key->__GET('responsable_denuncia')?></td>
        <td><?=$stsden[$key->__GET('estatus_denuncia')]?></td>
        <td style="text-align: center; padding-top: 5px;"><button style=" margin-top: 5px;" type="button" id="<?=$key->__GET('id_denuncia')?>" value="" class='submit detailsdenjuridico btn_opcion' title="Detalles"><span class="glyphicon glyphicon-zoom-in"></span></button></td>
        <td style="text-align: center; padding-top: 5px;"><button style=" margin-top: 5px;" type="submit" id="<?=$key->__GET('id_denuncia')?>" value="" class='submit updatedenjuridico btn_opcion' title="Editar"/><span class="glyphicon glyphicon-pencil"></span></button></td>
      
    </tr>
<?php          
   }//foreach
?>

      </tbody>

        <tfoot style="display: none;">
        <tr style="color:white;background: #234181 linear-gradient(#639ACA, #6095C4 20%, #3368A0 60%, #234181 100%) repeat scroll 0% 0%;">
          <th class="text-center">N° Denuncia</th>
          <th class="text-center">Cédula</th>
          <th class="text-center">Nombres y Apellidos</th>
          <th class="text-center">Estatus</th>
          <th class="text-center"><span class="glyphicon glyphicon-search"></span></th>
          <th class="text-center"><span class="glyphicon glyphicon-pencil"></span></th>
        </tr>
      </tfoot>
   </table>
  </form>
</div>
<!--Separador Segunda tabla en caso de que tenga denuncia-->
<?php if(!empty($denuncia_natural)){ ?>
<?php /*
<div style="width:100%;height:50px;border-top:1px solid darkgray;"></div>
<h4>Denuncias Registradas en contra de la empresa</h4>
<table class='table table-bordered table-hover'>
<thead>
    <tr>
      <th class="text-center" style="background:#234181 linear-gradient(#639ACA, #6095C4 20%, #3368A0 60%, #234181 100%) repeat scroll 0% 0% !important;color:white !important;">N° Denuncia</th> 
      <th class="text-center" style="background:#234181 linear-gradient(#639ACA, #6095C4 20%, #3368A0 60%, #234181 100%) repeat scroll 0% 0% !important;color:white !important;">N° Patronal</th> 
      <th class="text-center" style="background:#234181 linear-gradient(#639ACA, #6095C4 20%, #3368A0 60%, #234181 100%) repeat scroll 0% 0% !important;color:white !important;">Nombre Empresa</th> 
      <th class="text-center" style="background:#234181 linear-gradient(#639ACA, #6095C4 20%, #3368A0 60%, #234181 100%) repeat scroll 0% 0% !important;color:white !important;">Motivo</th> 
      <th class="text-center" style="background:#234181 linear-gradient(#639ACA, #6095C4 20%, #3368A0 60%, #234181 100%) repeat scroll 0% 0% !important;color:white !important;">Estatus</th> 
      <th class="text-center" style="color:white;"><span class="glyphicon glyphicon-search"></span></th>
      <th class="text-center" style="color:white;"><span class="glyphicon glyphicon-pencil"></span></th>
      <th class="text-center" style="color:white;"><span class="glyphicon glyphicon-remove"></span></th>
    </tr>    
</thead>

  <tbody>
<?php 
$nombre_empresa =  array();
$motivosnat     = array();
$motivosnat = dameMotivos();

foreach ($denuncia_natural as $denat){
  echo "<tr><td>".$denat->__GET('id_ciudadano')."</td>";
  echo "<td>".$denat->__GET('id_empresa')."</td>";
  echo "<td>";

    foreach ( dameEmpresa('id_empresa',$denat->__GET('id_empresa')) as $key2){
      echo $key2['NOMBRE_EMPRESA'];
    }

echo "</td><td>";

echo $motivosnat[$denat->__GET('motivo_denuncia')]['DESCRIPCION'];

echo "</td><td>".$stsden[$denat->__GET('estatus_denuncia')]."</td>";

echo '<td style="text-align: center; padding-top: 5px;"><button style=" margin-top: 5px;" type="button" id="" value="" class="submit detailsdenjuridico btn_opcion" title="Detalles"><span class="glyphicon glyphicon-zoom-in"></span></button></td>
      <td style="text-align: center; padding-top: 5px;"><button style=" margin-top: 5px;" type="submit" id="" value="" class="submit updatedenjuridico btn_opcion" title="Editar"/><span class="glyphicon glyphicon-pencil"></span></button></td>
      <td style="text-align: center; padding-top: 5px;"><button style=" margin-top: 5px;" type="button" id="" value="" class="submit eliminarjuridico btn_opcion" title="Eliminar"><span class="glyphicon glyphicon-remove"></span></button></td></tr>';
}
?>
</tbody>
  <tfood>    
    <tr>
      <th class="text-center" style="background:#234181 linear-gradient(#639ACA, #6095C4 20%, #3368A0 60%, #234181 100%) repeat scroll 0% 0% !important;color:white !important;">N° Denuncia</th> 
      <th class="text-center" style="background:#234181 linear-gradient(#639ACA, #6095C4 20%, #3368A0 60%, #234181 100%) repeat scroll 0% 0% !important;color:white !important;">N° Patronal</th> 
      <th class="text-center" style="background:#234181 linear-gradient(#639ACA, #6095C4 20%, #3368A0 60%, #234181 100%) repeat scroll 0% 0% !important;color:white !important;">Nombre Empresa</th> 
      <th class="text-center" style="background:#234181 linear-gradient(#639ACA, #6095C4 20%, #3368A0 60%, #234181 100%) repeat scroll 0% 0% !important;color:white !important;">Motivo</th> 
      <th class="text-center" style="background:#234181 linear-gradient(#639ACA, #6095C4 20%, #3368A0 60%, #234181 100%) repeat scroll 0% 0% !important;color:white !important;">Estatus</th> 
      <th class="text-center" style="color:white;"><span class="glyphicon glyphicon-search"></span></th>
      <th class="text-center" style="color:white;"><span class="glyphicon glyphicon-pencil"></span></th>
      <th class="text-center" style="color:white;"><span class="glyphicon glyphicon-remove"></span></th>
    </tr> 
  </tfood>
</table>
*/
?>
<?php }?>
<!--Separador-->
<div style="width:100%;height:50px;border-top:1px solid darkgray;"></div>

<input type='button' class='boton' value='Volver' onClick='regresar();' style="float:right;padding:3px;color:white !important;font-weight:bold;margin-right:10px;">

<!--/******************************************************************************************************/-->   
   <script type="text/jscript" src="<?=$base_url;?>public_html/js/jquery-2.1.4.min.js"></script>
   <script type="text/javascript" src="<?=$base_url;?>public_html/js/enviar.js"></script>
   <script type="text/javascript" src="<?=$base_url;?>resources/jquery.confirm/jquery.confirm/jquery.confirm.js"></script>
  <script type="text/javascript" src="<?=$base_url;?>resources/jquery.confirm/js/script.js"></script>
<script type="text/javascript" src="<?=$base_url;?>public_html/vendor/DataTables/media/js/jquery.dataTables.js"></script>
   <script type='text/javascript'>
      function regresar()
      {
          var pagina = '../quejas.php';
          location.href=pagina
      }

      function volver()
      {
        history.back();
      }

    $(document).ready(function($) {
      $("#tabla_consulta").dataTable();
    });
  </script>
   </section>
 </div>
 </body>
 </html>
  
  