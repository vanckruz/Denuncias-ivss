<?php
session_start(); 
include("../../config/config.php"); 
?>
<!DOCTYPE html>
<html lang="ES">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Denuncia - Detalles</title>
  <link rel="shortcut icon" href="<?=$base_url;?>public_html/imagenes/favicon.ico" type="image/x-icon" />
  <link rel="stylesheet" type="text/css" href="<?=$base_url;?>public_html/css/bootstrap/css/bootstrap.min.css" />
  <link rel="stylesheet" type="text/css" href="<?=$base_url;?>public_html/css/desplegable.css" />
</head>
<body style="background:linear-gradient(to right, #AFA19E, #E7E7FF, #E7E7E7, #8E8E8E) no-repeat scroll 0% 0% #8E8E8E;height:auto;">
  <div class="container" style="background:transparent linear-gradient(#FFF, #DDE9F4) repeat scroll 0% 0%;">
    <header class="banner" style="width:1024px;margin:auto;">
      <figure>
        <img src="<?=$base_url;?>public_html/imagenes/top.jpg" style="width:990px;"/>
      </figure>
    </header>
    <section class="accordion">
      <fieldset>
        <form>
          <div class="row">
            <div class="col-xs-12" style="width:1025px !important;background:#3B5998;color: white;">
              <h1 class="text-center" style="color: white;">Denuncia-Detalles</h1>        
            </div>
          </div>
          <!-- Inicio Datos Trabajador -->
          <div id="content_center" style="width:960px !important;margin:auto;padding:25px;overflow:hidden;background:transparent linear-gradient(#FFF, #DDE9F4) repeat scroll 0% 0%;box-shadow:10px 10px 21px #000;"><!--Iniciio content center-->
            <article>
              <div class="block">
               <!--Inicio Datos Empleado -->
               <table class="table table-bordered table-hover">
                <caption><h2 style="background:#3B5998;color:white;padding:7px;">Datos del Trabajador</h2></caption>
                <thead>
                  <tr>
                    <th>Cédula</th>
                    <th>Nombres</th>
                    <th>Apellidos</th>
                    <!--<div class="datos"><span><label>Dirección:</label><?=$dirper?></span></div>-->
                    <th>Teléfono</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td><?=$cedper?></td>
                    <td><?=$nomper?></td>
                    <td><?=$apeper?></td>
                    <!--<div class="datos"><span><label>Dirección:</label><?=$dirper?></span></div>-->
                    <td><?=$telper?></td>
                  </tr>
                </tbody>
              </table>
            </div>
          </article> <!-- Fin Datos Trabajador -->

          <!-- Inicio Datos del apoderado -->
          <?php  if(isset($ced_apo) && !empty($nom_apo)) { ?>
          <table class="table table-bordered table-hover">
           <caption><h2 style="background:#3B5998;color:white;padding:7px;">Datos del Apoderado</h2></caption>
           <thead>
            <tr>
              <th>Cédula</th>
              <th>Nombres</th>
              <th>Apellidos</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td><?=$ced_apo?></td>
              <td><?=$nom_apo?></td>
              <td><?=$ape_apo?></td>
            </tr>
          </tbody>
        </table>
        <?php } ?>
        <!-- Inicio Datos Empresa -->
        <article>
          <div class="block">
           <table class="table table-bordered table-hover">
            <caption><h2 style="background:#3B5998;color:white;padding:7px;">Datos de la Empresa</h2></caption>
            <thead>
              <tr>
                <th>N° Patronal</th>
                <th>RIF</th>
                <th>Razón Social</th>
                <th>Dirección</th>
                <th>Teléfono</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td><?=$numpat?></td>
                <td><?=$rifemp?></td>
                <td><?=$nomemp?></td>
                <td><?=$diremp?></td>
                <td><?=$telemp?></td>
              </tr>
            </tbody>
          </table>
        </div>
      </article> <!-- Fin Datos Empresa -->

      <!-- Inicio Datos Denuncia -->
      <article>

        <div class="block">
          <table class="table table-bordered table-hover">
            <caption><h2 style="background: #3B5998;color:white;padding:7px;">Datos de la Denuncia</h2></caption>
            <thead>
              <tr>
                <th>N° Denuncia</th>
                <th>Fecha Denuncia</th>
                <th>Estatus</th>
                <th>Descripción</th>
                <th>Responsable</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td><?=$numden?></td>
                <td><?=$fecden?></td>
                <td><?=$stsden?></td>
                <td><?=$desden?></td>
                <td><?=$resden?></td>
              </tr>
            </tbody>
          </table>
          <!--INICIO MOTIVOS-->
          <table class="table table-bordered table-hover">
            <caption></caption>
            <thead>
              <tr>
                <th>Motivo(s) de la Denuncia</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $motivos = $denuncia->__GET('motivo_denuncia');
              foreach($motivos as $motivo){
                echo "<tr>
                <td>".$mot[$motivo['ID_MOTIVO']-1]['DESCRIPCION']."</td>
              </tr>";
            }
            ?>
          </tbody>
        </table>
        <!--FIN MOTIVOS-->

        <!--INICIO DOCUMENTOS-->
        <table class="table table-bordered table-hover" id="tabla_documentos">
          <caption></caption>
          <thead>
            <tr>
              <th>Documentos Consignados</th>
              <!--<th></th>-->
            </tr>
          </thead>
          <tbody>
            <?php
            $documentos = documentosConsignados($id_den);
            foreach($documentos as $indice => $registro){
              echo "<tr>
              <td>".$registro['DESCRIPCION']."</td>
            </tr>";
          }
          ?>
        </tbody>
      </table>
      <!--INICIO DOCUMENTOS-->

    </div>
  </article> 

  <!-- Fin Datos Denuncia -->
  <?php  
  $ruta = "../denuncias.php";
  if($_SESSION['USUARIO']['utype']==2)
    {$ruta="../denuncias.analista.php";}
  elseif($_SESSION['USUARIO']['utype']==3)
    {$ruta="../denuncias.responsable.php";}
  ?>
  <div class="elemento">
    <input type="button" value="Procesar" class="btn btn-primary" id="imprimir_denuncia" />
    <input type="button" value="Regresar" onClick="window.document.location='<?php echo $ruta; ?>?ivss=c';" class="btn btn-primary"/>
  </div>
</div>
</form>
</fieldset>
</section>
</div>

<!--Ventana modal con el pdf-->
<div id="content_pdf" style="position:fixed;top:0;left:0;width:100%;height:100%;display:none;background:rgba(0,0,0,0.5);">
  <div id="cerrar_pdf" style="position:absolute;top:40;left:10px;z-index:500;cursor: pointer; color:white;"><span class="glyphicon glyphicon-remove"></span> Cerrar</div>
  <div style="width:80%;height:100%;margin:auto;">
    <?php  if($stsdenuncia == 0){ ?>
    <iframe id="pdf_denuncia" data-src="<?=$base_url;?>App/mod_denuncias/notificacion_denuncia.php?id_denuncia=<?=$numden?>" style="width:100%;height:100%;margin:auto;"></iframe>
    <?php } else {?>
    <iframe id="pdf_denuncia" data-src="<?=$base_url;?>App/mod_denuncias/notificacion_cierre_denuncia.php?id_denuncia=<?=$numden?>" style="width:100%;height:100%;margin:auto;"></iframe>
    <?php } ?>
  </div>  
</div>
<!--Ventana modal con el pdf-->
</body>
</html>