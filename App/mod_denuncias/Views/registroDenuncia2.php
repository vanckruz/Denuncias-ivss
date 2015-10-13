<?php
error_reporting(E_ALL);
    ini_set("display_errors", 1);
    include("../../config/config.php");
    ?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registro de Denuncia</title>
    <link rel="stylesheet" type="text/css" href="<?=$base_url;?>public_html/css/bootstrap/css/bootstrap.css" />
	<link rel="stylesheet" type="text/css" href="<?=$base_url;?>public_html/css/desplegable.css" />
</head>
<body style="background:linear-gradient(to right, #AFA19E, #E7E7FF, #E7E7E7, #8E8E8E) no-repeat scroll 0% 0% #8E8E8E;height:auto;">

    <!-- Modal Consultar empresa-->

    <div class="modal fade bs-example-modal-lg" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h2 class="modal-title text-center" id="myModalLabel">Sistema de Fiscalización del IVSS</h2>
                </div>
                <div class="modal-body">
                    <div class="contenido"> 
                        <h3 class="text-center">Consultar Empresa</h3>
                        <form name="form_consultar" id="form_consultar">
                            <input type="hidden" name="option" value="consultaexterna"/>
                            <h5 class="text-center">Seleccione una opción de búsqueda</h5>
                            <div class="elemento">
                                <select name="opciones" class="form-control text-center sel" id="opciones">
                                    <option value="default" selected>Seleccione</option>
                                    <option value="id_empresa">N° Patronal</option>
                                    <option value="rif">RIF</option>
                                    <option value="nombre_empresa">Nombre</option>
                                 </select>
                            </div>
                            <div id="contenido_emergente"></div>
                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="reset" class="btn btn-danger" data-dismiss="modal" form="form_consultar">Cancelar</button>
                    <button type="submit" class="btn btn-primary" id="consultar" form="form_consultar">Consultar</button>
                </div>
            </div>
        </div>
    </div>

<!-- END Modal consultar empresa -->
    <header class="banner_desplegable">
            <figure>
                <img src="<?=$base_url;?>public_html/imagenes/top.jpg"/>
            </figure>
            </header>
    <div class="container-fluid">
        <section class="accordion">
        <fieldset>
            <form name="registrar" id="rd" method="post" action="Controller.Denuncia.php" class="form-inline">
                <input type="hidden" name="option" value="registrar" form="rd"/>
                <input type="hidden" name="idc" value="<?=$idc?>" form="rd"/>
                <input type="hidden" name="cedula" value="<?=$ced?>" form="rd"/>
                <input type="hidden" name="nombre" value="<?=$nom?>" form="rd"/>
                <input type="hidden" name="apellido" value="<?=$ape?>" form="rd"/>
                <input type="hidden" name="documentos[]" value="" form="rd"/>
            </form>
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="text-center">Registro de Denuncia</h1>        
                    </div>
                </div>
                
                <div class="separador"></div>
            <!-- Inicio Datos Trabajador -->
            <article>
                <h2>Datos del trabajador</h2>
                <div class="block">
                    <div class="row">
                        <div class="col-md-4 form-group ">
                            <label for="cedula">C&eacute;dula</label>
                            <input type="text" class="form-control" id="cedula" name="cedula2" value="<?=$ced?>" readonly form="rd"/>
                        </div>
                        <div class="col-md-4 form-group">
                            <label for="nombres">Nombres</label>
                            <input type="text" class="form-control" id="apellido" value="<?= $nom ?>" readonly/>
                        </div>
                        <div class="col-md-4 form-group">
                            <label for="apellidos">Apellidos</label>
                            <input type="text" class="form-control" id="apellido" value="<?=$ape?>" readonly/>
                        </div>
                    </div>

                    <div class="separador"></div>

                    <div class="row">
                        <div class="col-md-4 form-group ">
                            <label for="estado">Estado</label>
                            <select name="estado" class="form-control" id="estado" form="rd" required>
                                <option value="">Seleccione</option>
                                <?php
                                    $estados = dameEstado();
                                    foreach($estados as $indice => $registro){
                                        echo "<option value=".$registro['ID_ESTADO'].">".$registro['NOMBRE_ESTADO']."</option>";
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-4 form-group ">
                            <label for="municipio">Municipio</label>
                            <select name="municipio" class="form-control" id="municipio" form="rd" required>
                                <option value="">Seleccione</option>
                            </select>
                        </div>
                        <div class="col-md-4 form-group ">
                            <label for="parroquia">Parroquia</label>
                            <select name="localidad" class="form-control" id="localidad" form="rd" required>
                                <option value="">Seleccione</option>
                            </select>
                        </div>
                    </div>

                    <div class="separador"></div>
                    
                    <div class="row">
                        <div class="col-md-4 form-group">
                            <label for="calle_avenida">Calle/Avenida</label>
                            <input type="text" class="form-control" name="calleper" id="calleper" required form="rd"/>
                        </div>
                        <div class="col-md-4 form-group">
                            <label for="nombre_casa">Casa/Edificio</label>
                            <input type="text" class="form-control" name="edifper" id="edifper" required form="rd"/>
                        </div>
                        <div class="col-md-4 form-group">
                            <label for="numero_casa">N° Casa/Apto</label>
                            <input type="text" class="form-control" name="ncasa" id="calleper" required form="rd"/>
                        </div>
                    </div>
                </div>
            </article> <!-- Fin Datos Trabajador -->
        
            <div class="separador"></div>

            <!-- Inicio Datos Empresa -->
            <article>
                <h2>Datos de la empresa</h2>
                <div class="block">
                    <div class="row">
                        <div class="col-md-12">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                                Consultar Empresa
                            </button>
                        </div>
                    </div>

                    <div class="separador"></div>
                
                    <div class="row">
                        <div class="col-md-4 form-group">
                            <label for="razon">Nombre o razón Social</label>
                            <input type="text" class="form-control" name="razon" id="razon" maxlength="50" form="rd" required/>
                        </div>

                        <div class="col-md-4 form-group">
                            <label for="rif">RIF</label>
                            <input type="text" class="form-control" name="rif" id="rif" maxlength="10" form="rd" required/>
                        </div>
                        <div class="col-md-4 form-group">
                            <label for="">Nº Patronal</label>
                            <input type="text" class="form-control" name="npat" id="npat" maxlength="9" form="rd" required/>
                        </div>
                        
                    </div>

                    <div class="separador"></div>

                    <div class="row">
                        <div class="col-md-4 form-group">
                            <label for="estado">Estado</label>
                            <select name="estado2" class="form-control" id="estado2" form="rd" required>
                                <option value="" selected="selected">Seleccione un Estado</option>
                                    <?php
                                        $estados = dameEstado();
                                        foreach($estados as $indice => $registro)
                                        {
                                            echo "<option value=".$registro['ID_ESTADO'].">".$registro['NOMBRE_ESTADO']."</option>";
                                        }
                                    ?>
                            </select>
                        </div>
                        <div class="col-md-4 form-group">
                            <label for="municipio">Municipio</label>
                            <select name="municipio2" class="form-control" id="municipio2" form="rd" required>
                                <option value="">Seleccione</option>
                            </select>
                        </div>
                        <div class="col-md-4 form-group">
                            <label for="parroquia">Parroquia</label>
                            <select name="localidad2" class="form-control"  id="localidad2" form="rd" required>
                                <option value="">Seleccione</option>
                            </select>
                        </div>
                    </div>
                
                    <div class="separador"></div>

                    <div class="row">
                        <div class="col-md-4 form-group">
                            <label for="calle_emp">Calle/Avenida</label>
                            <input type="text" class="form-control" name="calle_emp" id="calle_emp" maxlength="20" form="rd" required />
                        </div>
                        <div class="col-md-4 form-group">
                            <label for="casa_emp">Casa/Edificio</label>
                            <input type="text" class="form-control" name="edif_emp" id="edif_emp" maxlength="20" form="rd" required />
                        </div>
                        <div class="col-md-4 form-group">
                            <label for="apto_emp">N° Casa/Apto</label>  
                            <input type="text" class="form-control" name="ncasa_emp" id="ncasa_emp" maxlength="5" form="rd" required />
                        </div>
                    </div>
                </div>
            </article> <!-- Fin Datos Empresa -->
        
            <div class="separador"></div>
        
            <!-- Inicio Datos Denuncia -->
            <article>
                <h2>Datos de la denuncia</h2>
                <div class="block">
                    <div class="row">
                        <div class="col-md-4 form-group">
                            <label for="ndenuncia">N° Denuncia</label>
                            <input type="text" class="form-control" name="num_den" id="num_den" value="<?=$num_den?>" readonly form="rd"/>
                        </div>
                          <div class="separador"></div>  
                        <div class="col-md-4 form-group">
                            <label for="fdenuncia">Fecha Denuncia</label>
                            <input type="text" class="form-control" name="fecha" id="fecha" value="<?=date('d/m/y')?>" readonly form="rd"/>
                        </div>

                        <div class="col-md-4 form-group">
                            <label for="estatus">Estatus</label>  
                            <select name="estatus" class="form-control" id="estatus" form="rd" required>
                                <option value="-1" selected>Seleccione</option>
                                <option value="0">En Proceso</option>
                                <option value="1">Procedente</option>
                                <option value="2">Improcedente</option>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 form-group">
                	       <label for="motivo">Motivo Denuncia</label>
                    	   <select name="motivos" class="form-control" id="motivos" form="rd" required>
                                <option value="0">Seleccione</option>
                                <?php
                                    $motivos = dameMotivos();
                                    foreach($motivos as $indice => $registro)
                                    {
                                        echo "<option value=".$registro['ID_MOTIVO'].">".$registro['DESCRIPCION']."</option>";
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="separador"></div>
                    <div class="row">
                        <div class="col-md-6 form-group">  
                            <label for="descripcion">Descripción</label>        
                            <textarea name="descripcion" class="form-control" cols="40" id="descripcion" form="rd" required></textarea>
                        </div>
                        <div class="col-md-6"></div>
                    </div>    
                </div>
            </article> <!-- Fin Datos Denuncia -->
            <div class="separador"></div>
            <!-- Inicio Documentos -->
            <article>
                <h2>Documentos a Consignar</h2>
                <div class="block">
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <ul class="lista">
            	               <?php 
                                    $documentos = getDocumentos();
                                    foreach($documentos as $indice => $registro)
                                    {
                                        echo '<li><span><input type="checkbox" name=documentos[] value="'.$registro["ID_DOCUMENTO"].'" form="rd" id="documentos"/>'.$registro['DESCRIPCION'].'</span>
                                                </li>';
                                    }
                                ?>
        	               </ul>
                        </div>
                    </div>
                </div>

                </article><!-- Fin Documentos -->
                <div class="elemento">
        	       <input type="submit" value="Registrar" form="rd" class="btnback" id="registrar" />
        	       <input type="reset" value="Limpiar" form="rd" class="btnback" id="limpiar"/>
                    <input type="button" value="Cancelar" class="btnback" id="cancelar" onclick="regresar();"/>
                </div>
            </fieldset>
    </section>
</div>
      
      <script type="text/javascript" src="<?=$base_url;?>public_html/js/jquery-2.1.4.min.js"></script>
      <script type="text/javascript" src="<?=$base_url;?>public_html/js/desplegable.js"></script>
      <script type="text/javascript" src="<?=$base_url;?>public_html/js/emergente.js"></script>
      <script type="text/javacript" src="<?=$base_url;?>public_html/js/consultaEmergente.js"></script>
      <!--<script type="text/javacript" src="<?=$base_url;?>public_html/js/den_valida_registro.js"></script>-->
      <script type="text/javascript" src="<?=$base_url;?>public_html/js/mostrarContenido.js"></script>
      <script type="text/javascript" src="<?=$base_url;?>public_html/js/enviar.js"></script>
      <script type="text/javascript" src="<?=$base_url;?>public_html/js/bootstrap/js/bootstrap.min.js"></script>
      <script>
    $("#estado").on("change", buscarMunicipios);
    $("#municipio").on("change", buscarLocalidades);
    $("#estado2").on("change", buscarMunicipios2);
    $("#municipio2").on("change", buscarLocalidades2);

    function buscarMunicipios(){
        $("#localidad").html("<option value=''>seleccione</option>");
        
        $estado = $("#estado").val();
        
        if($estado == ""){
                $("#municipio").html("<option value=''>seleccione</option>");
        }
        else {
            $.ajax({
                dataType: "json",
                data: {"estado": $estado},
                url:   '../../../resources/select/buscar.php',
                type:  'post',
                beforeSend: function(){
                    //Lo que se hace antes de enviar el formulario
                    },
                success: function(respuesta){
                    //lo que se si el destino devuelve algo
                    $("#municipio").html(respuesta.html);
                },
                error:  function(xhr,err){ 
                    alert("readyState: "+xhr.readyState+"\nstatus: "+xhr.status+"\n \n responseText: "+xhr.responseText);
                }
            });
        }
    }

    function buscarLocalidades(){
        $municipio = $("#municipio").val();
        
        $.ajax({
            dataType: "json",
            data: {"municipio": $municipio},
            url:   '../../../resources/select/buscar.php',
            type:  'post',
            beforeSend: function(){
                //Lo que se hace antes de enviar el formulario
                },
            success: function(respuesta){
                //lo que se si el destino devuelve algo
                $("#localidad").html(respuesta.html);
            },
            error:  function(xhr,err){ 
                alert("readyState: "+xhr.readyState+"\nstatus: "+xhr.status+"\n \n responseText: "+xhr.responseText);
            }
        }); 
    }

    function buscarMunicipios2(){
        $("#localidad2").html("<option value=''>seleccione</option>");
        
        $estado = $("#estado2").val();
        
        if($estado == ""){
                $("#municipio2").html("<option value=''>seleccione</option>");
        }
        else {
            $.ajax({
                dataType: "json",
                data: {"estado": $estado},
                url:   '../../../resources/select/buscar.php',
                type:  'post',
                beforeSend: function(){
                    //Lo que se hace antes de enviar el formulario
                    },
                success: function(respuesta){
                    //lo que se si el destino devuelve algo
                    $("#municipio2").html(respuesta.html);
                },
                error:  function(xhr,err){ 
                    alert("readyState: "+xhr.readyState+"\nstatus: "+xhr.status+"\n \n responseText: "+xhr.responseText);
                }
            });
        }
    }

    function buscarLocalidades2(){
        $municipio = $("#municipio2").val();
        
        $.ajax({
            dataType: "json",
            data: {"municipio": $municipio},
            url:   '../../../resources/select/buscar.php',
            type:  'post',
            beforeSend: function(){
                //Lo que se hace antes de enviar el formulario
                },
            success: function(respuesta){
                //lo que se si el destino devuelve algo
                $("#localidad2").html(respuesta.html);
            },
            error:  function(xhr,err){ 
                alert("readyState: "+xhr.readyState+"\nstatus: "+xhr.status+"\n \n responseText: "+xhr.responseText);
            }
        }); 
    }

    function buscarMotivos(){
        $motivo = $("#motivos").val();
        
        $.ajax({
            dataType: "json",
            data: {"motivo": $motivo},
            url:   '../../../resources/select/buscar.php',
            type:  'post',
            beforeSend: function(){
                //Lo que se hace antes de enviar el formulario
                },
            success: function(respuesta){
                //lo que se hace si el destino devuelve algo
                $("#motivos").html(respuesta.html);
            },
            error:  function(xhr,err){ 
                alert("readyState: "+xhr.readyState+"\nstatus: "+xhr.status+"\n \n responseText: "+xhr.responseText);
            }
        }); 
    }
    </script>
    </div>