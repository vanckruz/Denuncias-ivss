<?php 
error_reporting(E_ALL);
ini_set("display_errors", 1);
include("../../config/config.php");
?>
<!DOCTYPE html>
<html lang="ES">
<head>
	<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Queja/Reclamo - Editar</title>
  <link rel="shortcut icon" href="<?=$base_url;?>public_html/imagenes/favicon.ico" type="image/x-icon" />
  <link rel="stylesheet" type="text/css" href="<?=$base_url;?>public_html/css/bootstrap/css/bootstrap.css" />
  <link rel="stylesheet" type="text/css" href="<?=$base_url;?>public_html/css/desplegable.css" />
  
</head>
<body style="background:linear-gradient(to right, #AFA19E, #E7E7FF, #E7E7E7, #8E8E8E) no-repeat scroll 0% 0% #8E8E8E;min-height:700px;height:auto;">
  <div class="container" style="background:transparent linear-gradient(#FFF, #DDE9F4) repeat scroll 0% 0%;min-height:100%;">
  	<header class="banner" style="width:1024px;margin:auto;">
      <figure>
        <img src="<?=$base_url;?>public_html/imagenes/top.jpg"/>
      </figure>
    </header>
    
    <section class="accordion">
      <fieldset>
        <form name="editar" id="editar" method="post" action="../Controllers/Controller.Denuncia.php" enctype="multipart/form-data">
         <input type="hidden" name="id_den" value="<?=$id_den?>" id="id" />
         <input type="hidden" name="option" value="updatejuridico" id="option" />
         <input type="hidden" name="fden" value="<?=$fecden?>" id="fden" />
         <div class="row">
          <div class="col-xs-12" style="background:#3B5998;color:white;font-size:1.5em;text-align:center;padding:12px;width:1025px;">
            Procesar Queja y/o Reclamo        
          </div>
        </div>
        <div id="content_center" style="width:960px !important;margin:auto;padding:25px;overflow:hidden;background:transparent linear-gradient(#FFF, #DDE9F4) repeat scroll 0% 0%;box-shadow:10px 10px 21px #000;"><!--Iniciio content center-->

          <!-- Inicio Datos Denuncia -->
          <article>
            <div class="block">
              <table class="table table-hover">
                <caption><h2 style="background: #3B5998;color:white;padding:7px;">Datos de la Queja y/o Reclamo</h2></caption>
                <thead>
                  <tr class="info">
                    <th>N° Queja y/o Reclamo</th>
                    <th>Fecha Registro</th>
                    <th>Estatus</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td><?=$numden?></td>
                    <td><?=$fecden?></td>
                    <td>
                      <input type="text" name="" value="<?=$stsden;?>" readonly id="estaus_flag" style="border:none;background:none;">
                    </td>
                  </tr>
                </tbody>
              </table>

              <table class="table table-hover">
                <caption></caption>
                <thead>
                  <tr class="info">
                    <th>Descripción de la Queja y/o Reclamo </th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td><textarea name="descripcion" maxlength="3000" id="descripcion" form="editar" required style="width:900px;" readonly="readonly"><?=$descripcion?></textarea></td>
                  </tr>
                </tbody>
              </table>

              <!--INICIO MOTIVOS-->
              <table class="table  table-hover">
                <caption></caption>
                <thead>
                  <tr  class="info">
                    <th>Motivo(s) de la Denuncia</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $motivos = $denuncia->__GET('motivo_denuncia');
//               var_dump($motivos);
//                exit();

                  if( $motivos != NULL ){
                    foreach($motivos as $motivo){
                      echo "<tr>
                      <td>".$motivo['DESCRIPCION']."</td>
                    </tr>";
                  }
                }


                ?>
              </tbody>
            </table>
            <!--FIN MOTIVOS-->

            <!--DESCRIPCION DEL ESTATUS-->
            <?php if($stsden == "Procedente"){ ?>
            <table id="tabla_descripcion_estatus" class="table table-hover">
              <tr class="info"><th>Descripción del Cierre de la Queja y/o Reclamo </th></tr>
              <tbody>
                <tr>
                  <td>
                    <textarea name="descripcion_estatus" maxlength="350" id="descripcion_estatus" form="editar" style="width:890px;" placeholder="Ingrese un maximo de 350 caracteres."></textarea>
                    <p style="color:red;display:none;" id="mensaje_descripcion">Este campo es requerido</p>
                  </td>
                </tr>
              </tbody>
            </table>
            <?php } ?>

            <?php /*************************************************************************************/ ?>
            <div class="archivos" style="margin-bottom:25px;">
              <h2 style="background:#3B5998;color:white;padding:7px;">Adjuntar archivos</h2>

              <?php 

              $archivos = dameArchivosQueja($numden);

              if($archivos != null){
                echo "<table class='table table-hover'>
                <thead>
                  <tr class='info'>
                    <th>".count($archivos)." Archivos.</th>
                  </tr>                  
                </thead>

                <tbody>";
                  foreach ($archivos as $archivo) {
                    echo "<tr><td><a href='".$base_url."public_html/archivos/quejas/".$archivo['STR_NOMBRE_ARCHIVO']."' download>".$archivo['STR_NOMBRE_ARCHIVO']."</a></td></tr>";
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

          </article> <!-- Fin Datos Denuncia -->
          <?php  
          $ruta = "../quejas.php";
          if($_SESSION['USUARIO']['utype']==2)
            {$ruta="../quejas.analista.php";}
          elseif($_SESSION['USUARIO']['utype']==3)
            {$ruta="../quejas.responsable.php";}
          ?>
          <div class="elemento">
            <input type="submit" value="Cerrar Queja" class="btn btn-primary" id="boton_submit" />
            <input type="button" value="Regresar" onClick="window.document.location='<?php echo $ruta; ?>?ivss=c';" class="btn btn-primary"/>
          </div>
        </div>
      </fieldset>
    </form>
  </section>
</div>
<script type="text/javascript" src="<?=$base_url;?>public_html/js/jquery-2.1.4.min.js"></script>
<script type="text/javascript" src="<?=$base_url;?>public_html/vendor/jquery-count/jquery.jqEasyCharCounter.js"></script>
<script>
  $(document).ready(function(){
      /*
      $('#descripcion_estatus').jqEasyCounter({
        'maxChars': 10,
        'maxCharsWarning': 8
      });
  */

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
<!--<script type="text/javascript" src="../public_html/js/desplegable.js"></script>-->
