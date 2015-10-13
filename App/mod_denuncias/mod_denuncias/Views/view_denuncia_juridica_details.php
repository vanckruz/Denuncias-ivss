<?php 
include("../../config/config.php");
?>
<!DOCTYPE html>
<html lang="ES">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Quejas - Detalles</title>
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
        <form method="post" action="<?=$base_url;?>App/mod_denuncias/Controllers/Controller.Denuncia.php" id="procesar">
          <input type="hidden" name="option" id="option" value="">
          <input type="hidden" name="id" id="id" value="">

          <div class="row" style="width:1025px;background:#3B5998;">
            <div class="col-xs-12">
              <h1 class="text-center" style="color:white;">Detalles de la Queja o Reclamo</h1>        
            </div>
          </div>
          <div id="content_center" style="width:960px !important;margin:auto;padding:25px;overflow:hidden;background:transparent linear-gradient(#FFF, #DDE9F4) repeat scroll 0% 0%;box-shadow:10px 10px 21px #000;"><!--Iniciio content center-->
            <!-- Inicio Datos Queja -->
            <article>

              <div class="block">
                <table class="table  table-hover">
                  <caption><h2 style="background:#3B5998;color:white;padding:7px;">Datos de la Queja o Reclamo</h2></caption>
                  <thead>
                    <tr class="info">
                      <th>N° Queja/Reclamo</th>
                      <th>Fecha Registro</th>
                      <th>Estatus</th>
                      <th>Responsable</th>
                      <th>Creado por</th>

                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td><?=$id_den?></td>
                      <td><?=$fecden?></td>
                      <td><?=$stsden?></td>
                      <td><?=$resden?></td>
                      <td><?=$creado?></td>
                    </tr>

                    <tr>
                      <th class="info" colspan="5">Descripción</th>
                    </tr>
                    <tr>
                      <td colspan="5"><?=$desden?></td>
                    </tr>

                  </tbody>
                </table>

                <!--ASIGNADAS-->
                <?php 
                    //SI ESTAN ASIGNADAS 
                if(isset($direcciones)) { ?>
                <table class="table table-hover">
                  <thead>
                    <tr  class="info">
                      <th style="width:150px;">Fecha Asignación</th>
                      <th>Asignada(s)</th>
                      <th style="width:250px;text-align:left;">Asignado por</th> 
                    </tr>
                  </thead>

                  <tbody>
                    <?php
                    if($direcciones != NULL)
                    { 
                      foreach ($direcciones as $key => $direccion)
                      {
                        ?> 
                        <tr>
                          <td> <?php echo $direccion['FECHA_ASIGNACION']; ?>  </td>
                          <td> <?php echo $direccion['NOMBRE']; ?> </td>
                          <td> <?php echo $asignadopor; ?> </td>
                        </tr>  
                        <?php    
                      }
                    } 
                  } 
                  ?>
                </tbody>
              </table>
              <!--ASIGNADAS-->

              <!--CERRADAS-->

              <?php
              if(isset($cerrada)){
              // Si esta cerrada
                if($cerrada==1 ){ ?>   
                <table class="table table-hover"> 
                  <thead>
                    <tr class="info">
                      <th style="width:150px;">Fecha de Cierre</th> 
                      <th>Descripción de Cierre</th> 
                      <th style="width:250px;text-align:left;">Cerrado por</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td> <?php echo $fecha_cierre_queja; ?> </td>
                      <td> <?php echo $descripcion_estatus_queja; ?> </td>
                      <td> <?php echo $cerradopor; ?></td>
                    </tr>
                  </tbody>
                </table>
                <?php    
              }
            } ?>

            <!--CERRADAS-->


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
          <table class="table table-hover">
            <tr class="info">
              <th>
                Documentos Consignados.
              </th>
            </tr>
            <tbody>
              <?php
              $documentos = documentosConsignadosQuejas($id_den);

              if($documentos != null){
                foreach($documentos as $indice => $registro){
                  echo "<tr>
                  <td>".$registro['DESCRIPCION']."</td>
                </tr>";
              }
            }

            ?>
          </tbody>
        </table>

        <table class="table table-hover">
         <?php $archivos = dameArchivosQueja($id_den);
         if($archivos != null ){

          echo "<tr class='info'><th>".count($archivos)." Archivos adjuntos.</th></tr>";

          foreach ($archivos as $archivo) {
            echo "<tr>";
            echo "<td><a href='".$base_url."public_html/archivos/quejas/".$archivo['STR_NOMBRE_ARCHIVO']."' download=''>".$archivo['STR_NOMBRE_ARCHIVO']."</a></td>";
            echo "</tr>";
          }
        }
        ?>
      </table>

    </div>
  </article> <!-- Fin Datos Denuncia -->
  <!-- Inicio Datos Empresa -->
  <article>
    <div class="block">
      <table class="table table-hover">
        <caption><h2 style="background:#3B5998;color:white;padding:7px;">Datos de la Empresa</h2></caption>
        <thead>
          <tr class="info">
            <th style="width:150px;">N° Patronal</th>
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

  <!-- Inicio Datos Representante -->

  <article>
    <div class="block">
      <table class="table table-hover">
        <caption><h2 style="background:#3B5998;color:white;padding:7px;">Datos del representante de la Empresa</h2></caption>
        <thead>
          <tr class="info">
            <th>Cédula</th>
            <th>Nombres</th>
            <th>Apellidos</th>
            <!--<div class="datos"><span><label>Dirección:</label><?=$dirper?></span></div>-->
            <th>Teléfono</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td><?=$cedrep?></td>
            <td><?=$nomrep?></td>
            <td><?=$aperep?></td>
            <!--<div class="datos"><span><label>Dirección:</label><?=$dirper?></span></div>-->
            <td><?=$telrep?></td>
          </tr>
        </tbody>
      </table>
    </div>
  </article> <!-- Fin Datos Representante -->

  <?php  
  $ruta = "../quejas.php";
  if($_SESSION['USUARIO']['utype']==2)
    {$ruta="../quejas.analista.php";}
  elseif($_SESSION['USUARIO']['utype']==3)
    {$ruta="../quejas.responsable.php";}
  ?>
  <div class="elemento">
    <?php  
    if($stsdenuncia==0){?>
    <input type="button" value="Procesar" class="btn btn-primary procesar_juridico" id="<?=$id_den?>">
    <?php }?>
    <input type="button" value="Imprimir" class="btn btn-primary" id="imprimir_denuncia"/>
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
    <iframe id="pdf_denuncia" data-src="<?=$base_url;?>App/mod_denuncias/notificacion_denuncia.php?id_denuncia=<?=$id_den?>" style="width:100%;height:100%;margin:auto;"></iframe>
    <?php } else {?>
    <iframe id="pdf_denuncia" data-src="<?=$base_url;?>App/mod_denuncias/notificacion_cierre_queja.php?id_denuncia=<?=$id_den?>" style="width:100%;height:100%;margin:auto;"></iframe>
    <?php } ?>
  </div>
</div>
<!--Ventana modal con el pdf-->
<script src="<?=$base_url;?>public_html/js/jquery-2.1.4.min.js"></script>
<script src="<?=$base_url;?>public_html/js/enviar.js"></script>
</body>
</html>