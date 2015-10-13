
<?php

include("../../config/config.php");
?>
<!DOCTYPE html>
<html lang="ES">
<head>
	<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Denuncia - Editar</title>
  <link rel="shortcut icon" href="<?=$base_url;?>public_html/imagenes/favicon.ico" type="image/x-icon" />
  <link rel="stylesheet" type="text/css" href="<?=$base_url;?>public_html/css/bootstrap/css/bootstrap.css" />
  <link rel="stylesheet" type="text/css" href="<?=$base_url;?>public_html/css/desplegable.css" />
  <link rel="stylesheet" type="text/css" href="<?=$base_url;?>public_html/vendor/chosen/chosen.css" /> 
</head>
<body style="background:linear-gradient(to right, #AFA19E, #E7E7FF, #E7E7E7, #8E8E8E) no-repeat scroll 0% 0% #8E8E8E;height:auto;">
  <div class="container" style="background:transparent linear-gradient(#FFF, #DDE9F4) repeat scroll 0% 0%;">
  	<header class="banner" style="width:1024px;margin:auto;">
      <figure>
        <img src="<?=$base_url;?>public_html/imagenes/top.jpg" style="width:1000px;" />
      </figure>
    </header>
    
    <section class="accordion">
      <fieldset>
        <form name="editar" id="editar" method="post" action="../Controllers/Controller.Denuncia.php" enctype="multipart/form-data">
         <input type="hidden" name="id_den" value="<?=$id_den?>" id="id" />
         <input type="hidden" name="option" value="update" id="option" />
         <input type="hidden" name="fden" value="<?=$fecden?>" id="fden" />
         <div class="row">
          <div class="col-xs-12" style="width:1025px !important;background:#3B5998;">
            <h1 class="text-center" style="color: white;">Procesar Denuncia</h1>        
          </div>
        </div>
        <div id="content_center" style="width:960px !important;margin:auto;padding:25px;overflow:auto;background:transparent linear-gradient(#FFF, #DDE9F4) repeat scroll 0% 0%;box-shadow:10px 10px 21px #000;"><!--Iniciio content center-->
          <!-- Inicio Datos Denuncia -->
          <article>
            <div class="block">
              <table class="table table-hover">
                <caption><h2 style="background:#3B5998;color:white;padding:7px;">Datos de la Denuncia</h2></caption>
                <thead>
                  <tr class="info">
                    <th>N° Denuncia</th>
                    <th>Fecha Denuncia</th>
                    <th>Estatus</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td><?=$numden?></td>
                    <td><?=$fecden?></td>

                    <td>
                      <input type="text" name="" value="<?=$stsden?>" readonly id="estaus_flag" style="border:none;background:none;">

                      <input type="text" name="otros" id="otros" style="display:none;" maxlength="50">
                    </td>
                  </tr>
                </tbody>
              </table>


              <!--MOTIVOS DE LA DENUNCIA-->
              <table class="table table-hover">
                <caption></caption>
                <thead>
                  <tr  class="info">
                    <th>Motivo(s) de la Denuncia</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $motivos = $denuncia->__GET('motivo_denuncia');
                  if( $motivos != null)
                  {
                    foreach($motivos as $key=> $motivo)
                    {
                      echo "<tr>
                      <td>".$motivo['DESCRIPCION']."</td>
                    </tr>";

                  }
                }
                else{
                  echo "<tr>
                  <td>Sin motivos.</td>
                </tr>";
              }
              ?>
            </tbody>
          </table>

          <!--DESCRIPCION DE LA DENUNCIA-->
          <table class="table table-hover">
            <tr class="info"><th>Descripción de la Denuncia</th></tr>
            <tbody>
              <tr>
                <td>
                  <textarea name="descripcion_denuncia" maxlength="3000" id="descripcion_denuncia" form="editar" readonly required="required" style="width:890px;"><?=$descripcion?></textarea>
                </td>
              </tr>
            </tbody>
          </table>

          <!--DESCRIPCION DEL CIEERE-->
          <table id="tabla_descripcion_estatus" class="table table-hover" style="display:none;">
            <tr class="info"><th>Descripción del Cierre de la Denuncia <span class="requerido">*</span></th></tr>
            <tbody>
              <tr>
                <td><textarea name="descripcion_estatus" maxlength="350" id="descripcion_estatus" form="editar" style="width:890px;" placeholder="Ingrese un máximo de 350 caracteres."></textarea>
                  <p style="color:red;display:none;font-weight: bolder;" id="mensaje_descripcion">Este campo es requerido</p>
                </td>
              </tr>
            </tbody>
          </table>
          <?php /*************************************************************************************/ ?>
          <div class="archivos" style="margin-bottom:25px;">
            <h2 style="background:#3B5998;color:white;padding:7px;">Adjuntar archivos</h2>

            <?php 

            $archivos = dameArchivosDenuncia($numden);

            if(dameArchivosDenuncia($numden) != null){
              echo "<table class='table table-hover'>
              <thead>
                <tr class='info'>
                  <th>".count($archivos)." Archivos.</th>
                </tr>                  
              </thead>

              <tbody>";
                foreach ($archivos as $archivo) {
                  echo "<tr><td><a href='".$base_url."public_html/archivos/denuncias/".$archivo['STR_NOMBRE_ARCHIVO']."' download>".$archivo['STR_NOMBRE_ARCHIVO']."</a></td></tr>";
                }

                echo "</tbody></table>";
              }
              ?>            

              <div class="botones_archivos" style="overflow:hidden;margin-bottom:25px;">
                <button id="menos_file" class="btn btn-danger"  style="float:right;"><span class="glyphicon glyphicon-minus"></span></button>
                <button id="mas_file" class="btn btn-primary"  style="float:right;"><span class="glyphicon glyphicon-plus"></span></button>
              </div>


              <div id="inpuflivos" style="overflow:hidden;height:auto;display:inline-block;">
                <input type="file" name="archivosdenuncia[]" class="archivosdenuncia form-control" style="border-radius:0px;display:inline;margin-right:10px;height:auto;width:300px;">              
              </div>
            </div>
            <?php /*************************************************************************************/ ?>          

          </div>
        </article> <!-- Fin Datos Empresa -->

        <!-- Inicio Documentos -->
        <?php
        /*
        $documentos = documentosNoConsignados($id_den);
        if($documentos!=false)
        {
          echo '
          <article>
            <div class="block">
              <table class="table table-bordered table-hover" id="tabla_documentos">
                <caption><h2 style="background:#3B5998;color:white;padding:7px;">Documentos a Consignar</h2></caption>
                <tbody>';
                  foreach($documentos as $indice => $registro){
                    echo '<tr>
                    <td><input type="checkbox" name="documentos[]" value="'.$registro['ID_DOCUMENTO'].'" form="editar"></td>
                    <td>'.$registro['DESCRIPCION'].'</td>
                  </tr>';
                }
                echo '
              </tbody>
            </table>
          </div>
        </article>';
      }
      */?>
      <!-- Fin Documentos -->

      <!-- Asignar denuncia -->
<?php /* 
<article>
  <div class="block">
    <h2 style="background:#3B5998;color:white;padding:7px; margin-bottom: 10px;">Asignar Denuncia</h2>
    <select name="responsable" id="responsable" class="form-control" style="margin-bottom: 10px">
      <option value="" >Seleccione</option>
      <option value="016" >Dirección General de Fiscalización</option>
      <?php
      /*
      $direcciones = dameDirecciones();
      foreach($direcciones as $indice => $registro){
        echo '
        <option value="'.$registro['ID_DIRECCION'].'" form="editar" >
          '.$registro['NOMBRE'].'
        </option>';
      }
      
    </select>
  </div>
</article><!-- Fin asignar denuncia -->
*/
?>
<?php  
$ruta = "../denuncias.php";
if($_SESSION['USUARIO']['utype']==2)
  {$ruta="../denuncias.analista.php";}
elseif($_SESSION['USUARIO']['utype']==3)
  {$ruta="../denuncias.responsable.php";}
?>

<div class="elemento">
  <input type="submit" value="Cerrar Denuncia" class="btn btn-primary" id="boton_submit"/>
  <input type="button" value="Regresar" onClick="window.document.location='<?php echo $ruta; ?>?ivss=c';" class="btn btn-primary"/>
  
</div>
</div>
</fieldset>
</form>
</section>
</div>
<script type="text/javascript" src="<?=$base_url;?>public_html/js/jquery-2.1.4.min.js"></script>
<script type="text/javascript" src="<?=$base_url;?>public_html/vendor/jQueryValidation/dist/jquery.validate.min.js"></script>
<script type="text/javascript" src="<?=$base_url;?>public_html/vendor/chosen/chosen.jquery.js"></script>
<script type="text/javascript" src="<?=$base_url;?>public_html/vendor/chosen/chosen.proto.js"></script>
<script type="text/javascript" src="<?=$base_url;?>public_html/vendor/jquery-count/jquery.jqEasyCharCounter.js"></script>
<script>
  $("#responsable").chosen();
</script>
<script>
  function volver()
  {
    history.back();
  }
</script>

<script>
  $(document).ready(function(){
    if( $("#estaus_flag").val() == 'Procedente'){
      $("#tabla_descripcion_estatus").show();
    }

    $("#estatus").on("change", function(){
      valor = $("#estatus").val();
      if(valor=='1' || valor=='2')
      {

        $("#tabla_descripcion_estatus").css('display','inline-block');
        $("#descripcion_estatus").attr('required', 'required');

      }
      else
      {
        $("#tabla_descripcion_estatus").css('display','none');
        $("#descripcion_estatus").removeAttr('required');
      }
    });//Fin estatus

  });//Fin ready
</script>

<script>

  $(document).on("ready",function(){
        //alert($(".check_docs").length);
        $("#boton_submit").on("click",function(e){
          e.preventDefault();
          if( $("#descripcion_estatus").val() == ""){
            $("#mensaje_descripcion").show();
          }else{
            $("#editar").submit();
          }

        });

        $("#descripcion_estatus").focus(function(){
          $("#mensaje_descripcion").hide();
        });

        $("#mas_file").on("click",function(e){
          e.preventDefault();
          if($(".archivosdenuncia").length < 10 ){agregar();}   
        });

        $("#menos_file").on("click",function(e){
          e.preventDefault();
          if($(".archivosdenuncia").length > 1){$(".archivosdenuncia:last").remove();}
        });
      });

  function agregar(){
    var file='<input type="file" name="archivosdenuncia[]" class="archivosdenuncia form-control" style="border-radius:0px;display:inline;margin-right:10px;height:auto;width:300px;">';
    var nuevo_file = $(file);
    $("#inpuflivos").append(nuevo_file);
  }
</script>
</body>
</html>

