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
    <title>Registro de Queja o Reclamo</title>
    <link rel="shortcut icon" href="<?=$base_url;?>public_html/imagenes/favicon.ico" type="image/x-icon" />
    <link rel="stylesheet" type="text/css" href="<?=$base_url;?>public_html/css/bootstrap/css/bootstrap.css" />
    <link rel="stylesheet" type="text/css" href="<?=$base_url;?>public_html/css/desplegable.css" />
    <link rel="stylesheet" type="text/css" href="<?=$base_url;?>public_html/vendor/multiple_select/multiple-select.css"/>
    <link rel="stylesheet" type="text/css" href="<?=$base_url;?>public_html/vendor/chosen/chosen.css" />
    <style type="text/css">
        label.error{
            color: red;
            font-size:0.9em;
        }
        textarea{text-indent: 0px;}

    </style>
</head>
<body style="background:linear-gradient(to right, #AFA19E, #E7E7FF, #E7E7E7, #8E8E8E) no-repeat scroll 0% 0% #8E8E8E;height:auto;">
   <!--Mensajes de alerta-->
   <div id="content_mensaje1" style="display:none;position:fixed;z-index:100000;background:rgba(0,0,0,0.8);width:100%;height:100%;">
    <div style="display:none;z-index: 10000;width:600px;hight:300px;margin:auto;margin-top:100px;background:rgba(255,255,255,0.8);" id="alerta1" title="Mensaje">
        <div id="titulo_alerta" style="background:#234181 linear-gradient(#639ACA, #6095C4 20%, #3368A0 60%, #234181 100%) repeat scroll 0% 0%;color:white;padding:10px;margin:auto;font-size:1.4em; ">
            Mensaje
            <div style="width:21px;float:right;cursor:pointer;" title="Cerrar mensaje" id="cerrar_mensaje1">
                <span class="glyphicon glyphicon-remove"></span>
            </div>
        </div>                                     
        <div class="mensaje" style="padding:25px 25px 25px 25px;font-size:1.3em;">
            Valor incorrecto!. Debe poseer 9 Caracteres, iniciando con una letra y seguida de 8 dígitos.
        </div>
    </div>
</div>

<div id="content_mensaje2" style="display:none;position:fixed;z-index:100000;background:rgba(0,0,0,0.8);width:100%;height:100%;">
    <div style="display:none;z-index: 10000;width:600px;hight:300px;margin:auto;margin-top:100px;background:rgba(255,255,255,0.8);" id="alerta2" title="Mensaje">
        <div id="titulo_alerta2" style="background:#234181 linear-gradient(#639ACA, #6095C4 20%, #3368A0 60%, #234181 100%) repeat scroll 0% 0%;color:white;padding:10px;font-size:1.4em; ">
            Mensaje
            <div style="width:21px;float:right;cursor:pointer;" title="Cerrar mensaje" id="cerrar_mensaje2">
                <span class="glyphicon glyphicon-remove"></span>
            </div>
        </div>

        <div class="mensaje" style="padding:25px 25px 25px 25px;font-size:1.3em; ">
            Valor incorrecto!. Debe poseer 10 Caracteres, iniciando con una letra y seguida de 9 dígitos.
        </div>
        
    </div>
</div>

<div id="content_mensaje3" style="display:none;position:fixed;z-index:100000;background:rgba(0,0,0,0.8);width:100%;height:100%;">
    <div style="display:none;z-index: 10000;width:600px;hight:300px;margin:auto;margin-top:100px;background:rgba(255,255,255,0.8);" id="alerta3" title="Mensaje">
        <div id="titulo_alerta3" style="background:#234181 linear-gradient(#639ACA, #6095C4 20%, #3368A0 60%, #234181 100%) repeat scroll 0% 0%;color:white;padding:10px;font-size:1.4em; ">
            Mensaje
            <div style="width:21px;float:right;cursor:pointer;" title="Cerrar mensaje" id="cerrar_mensaje3">
                <span class="glyphicon glyphicon-remove"></span>
            </div>
        </div>

        <div class="mensaje" style="padding:25px 25px 25px 25px;font-size:1.3em;">
            Por favor ingrese un valor en el campo 
        </div>
        
    </div>
</div>
<!--Mensajes de alerta-->

<!-- Modal Consultar empresa-->
<div class="modal fade bs-example-modal-lg" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" id="">
        <div class="modal-content" style="background:transparent linear-gradient(#FFF, #DDE9F4) repeat scroll 0% 0%;">
            <div class="modal-header" style="background:#234181 linear-gradient(#639ACA, #6095C4 20%, #3368A0 60%, #234181 100%) repeat scroll 0% 0%;"> 
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h2 class="modal-title text-center" id="myModalLabel" style="color:white;font-size:1.4em;">Sistema de Fiscalización del IVSS</h2>
            </div>
            <div class="modal-body" id="cuerpo_tabla">

               <div class="contenido"> 
                <h3 class="text-center" style="color:#555;">Consultar Empresa</h3>
                <form name="form_consultar" id="form_consultar">
                    <input type="hidden" name="option" value="consultaexterna"/>
                    <h5 class="text-center">Seleccione una opción de búsqueda</h5>
                    <div class="elemento">

                        <select name="opciones" class="form-control"" text-center sel" id="opciones" required="required" >
                            <option value="" selected>Seleccione</option>
                            <option value="id_empresa">N° Patronal</option>
                            <option value="rif">RIF</option>
                            <option value="nombre_empresa">Nombre</option>
                        </select>
                        
                    </div>
                    <div id="contenido_emergente">
                        <!--<input type="text" class="form-control" id="valor" name="valor" form="form_consultar" style="" required="required" />-->
                    </div>
                </form>
            </div>
        </div> 
        <div class="modal-footer">
            <button type="reset" class="btn btn-danger" id="cancelar" data-dismiss="modal" form="form_consultar">Cancelar</button>
            <button type="submit" class="btn btn-primary" id="consultar" form="form_consultar">Consultar</button>
        </div>
    </div>
</div>
</div>

<!-- END Modal consultar empresa -->
<header class="banner_desplegable" style="width:1024px;margin:auto;" id="banner_pueblo_soberano">
    <figure>
        <img src="<?=$base_url;?>public_html/imagenes/top.jpg"/>
    </figure>
</header>
<div class="container" style="background:transparent linear-gradient(#FFF, #DDE9F4) repeat scroll 0% 0%;">
    <section class="accordion">
        <fieldset>
            <form name="registrar" id="rd" method="post" action="Controller.Denuncia.php" class="form-inline" enctype="multipart/form-data">
                <input type="hidden" name="option" value="registrar2" form="rd"/>
                <input type="hidden" name="direccion_responsable" value="1" form="rd"/>
                
                <!--
                <input type="hidden" name="idc" value="<?=$idc?>" form="rd"/>
                <input type="hidden" name="cedula" value="<?=$ced?>" form="rd"/>
                <input type="hidden" name="nombre" value="<?=$nom?>" form="rd"/>
                <input type="hidden" name="apellido" value="<?=$ape?>" form="rd"/>
                <input type="hidden" name="estatus" value="En Proceso" form="rd"/>-->
                
                <div class="row">
                    <div class="col-xs-12" style="background:#3B5998;width:1025px;color:white !important;text-align:center;font-size:1.7em;padding:12px;">
                        Registro de Quejas y/o Reclamos        
                    </div>
                </div>
                <div id="content_center" style="width:960px !important;margin:auto;padding:25px;overflow:hidden;background:transparent linear-gradient(#FFF, #DDE9F4) repeat scroll 0% 0%;box-shadow:10px 10px 21px #000;"><!--Iniciio content center-->


                    <div class="separador"></div>

                    <!--Inicio datos del representante Legal de la Empresa-->
                    <article>
                        <h2 style="background: #3B5998;color:white;padding:7px;">Datos del Representante Legal</h2>
                        <div class="block">
                            <div id="campos_requeridos">
                                <span class="requerido">*</span><label> Campos Obligatorios</label>
                            </div>
                            <div class="row">
                                <div class="col-xs-4 form-group">
                                    <label for="cedula">Cédula</label>
                                    <input type="text" class="form-control" name="cedula_representante" id="cedula_representante" maxlength="10" form="rd" value="<?=$ced_rep?>" required="required"  readonly/>
                                </div>
                                <div class="col-xs-4 form-group">
                                    <label for="razon">Nombres del Representante</label>
                                    <input type="text" class="form-control" name="nombre_representante" id="nombre_representante" maxlength="200" form="rd" value="<?=$nombre_rep?>" required="required"  readonly/>
                                </div>
                                <div class="col-xs-4 form-group">
                                    <label for="">Apellidos del Representante</label>
                                    <input type="text" class="form-control" name="apellido_representante" id="apellido_representante" maxlength="200" form="rd" value="<?=$apellido_rep?>" required="required"  readonly/>
                                </div>
                                
                            </div>

                            <div class="separador"></div>
                            
                            <div class="row">
                                <div class="col-xs-12">
                                    <label>Dirección Domiciliaria Exacta</label>
                                    <textarea class="form-control" name="direccion_patrono" id="direccion_patrono" style="width:900px;resize: none; display: block;">
                                       <?php if(isset($_POST['direccion_patrono'])){
                                        echo $_POST['direccion_patrono']; 
                                    }?>
                                </textarea>
                                
                            </div>
                        </div>
                        
                        <div class="separador"></div>
                        <div class="row">
                            <div class="col-xs-1 form-group">
                                <label for="numero_representante"><span class="requerido"></span></label>
                                <select name="codigo_fijo_representante" id="codigo_fijo_representante" class="form-control" style="margin-top: 20px;width: 116px;height: 30px;cursor: pointer;">
                                    <option value="" style="padding: 5px; text-align: center;">Seleccione</option>
                                    <?php
                                    $codigos = dameCodigosTelefono();
                                    foreach($codigos as $indice => $registro){
                                        echo "<option value=".$registro['CODIGO_AREA']." style='padding: 5px; text-align: center;'>".$registro['CODIGO_AREA']."</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-xs-3 form-group">
                                <label for="punto_emp" style="margin-left: -80px;"><span class="requerido">*</span>Teléfono de Habitación</label>
                                <input type="text" maxlength="7" class="form-control tel_hab_rep" name="tel_hab_rep" value ="" required form="rd" style="margin-left: 40px;" placeholder="Ej:1234567"/>
                            </div>
                            <div class="col-xs-1 form-group">
                                <label for="numero_empresa"><span class="requerido"></span></label>
                                <select name="codigo_movil_representante" id="codigo_movil_representante" class="form-control" style="margin-top: 20px;width: 116px;height: 30px;cursor: pointer;">
                                    <option value="" style="padding: 5px; text-align: center;">Seleccione</option>
                                    <option value="0412" style="padding: 5px; text-align: center;">0412</option>
                                    <option value="0414" style="padding: 5px; text-align: center;">0414</option>
                                    <option value="0416" style="padding: 5px; text-align: center;">0416</option>
                                    <option value="0424" style="padding: 5px; text-align: center;">0424</option>
                                    <option value="0426" style="padding: 5px; text-align: center;">0426</option>
                                </select>
                            </div>
                            <div class="col-xs-3 form-group">
                                <label for="numero_emp" style="margin-left: -80px;"><span class="requerido">*</span>Teléfono Móvil</label>
                                <input type="text" maxlength="7" class="form-control tel_hab_rep" name="tel_mov_rep" value="" required form="rd" title="Este campo es requerido" style="margin-left:40px;" placeholder="Ej:1234567"/>
                            </div>
                            <div class="col-xs-4 form-group">
                                <label for="correo"><span class="requerido">*</span>Correo Electrónico</label>
                                <input type="text" maxlength="150" class="form-control" name="email_rep" id="email_rep" value="<?=$email_rep?>" required form="rd" placeholder="Ej: alguien@alguien.com"/>
                            </div>
                        </div>
                    </div>
                </article>
                <!--Fin Datos del representante Legal de la Empresa-->

                <div class="separador"></div>

                <!-- Inicio Datos Empresa -->
                <article>
                    <h2 style="background:#3B5998;color:white;padding:7px;">Datos de la Empresa o Razón Social</h2>
                    <div class="block">
                        <div class="row">
                            <div class="col-xs-12">
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal" id="consultar_empresa_all">
                                    Consultar Empresa
                                </button>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xs-5 form-group">
                                <label for="razon">Nombre o razón Social</label>
                                <input type="text" class="form-control" name="razon" id="razon" maxlength="500" form="rd" value="<?php if(isset($_POST['nombre_empresa_ciu_nat'])){echo $_POST['nombre_empresa_ciu_nat'];}?>" readonly/>
                            </div>

                            <div class="col-xs-4 form-group">
                                <label for="rif">RIF</label>
                                <input type="text" class="form-control rif" name="rif" id="rif" form="rd" title="Este campo es requerido" value="<?php if(isset($_POST['rif_ciu_nat'])){echo $_POST['rif_ciu_nat'];}?>"  readonly/>
                            </div>
                            <div class="col-xs-3 form-group">
                                <label for="">Nº Patronal</label>
                                <input type="text" class="form-control" name="npat" id="npat" maxlength="9" form="rd" value="<?php if(isset($_POST['id_empresa_ciu_nat'])){echo $_POST['id_empresa_ciu_nat'];}?>" readonly/>
                            </div>

                        </div>

                        <div class="separador"></div>
                        <div class="row">
                            <div class="col-xs-12">
                                <label>Dirección de la Empresa</label>
                                <textarea class="form-control" maxlength="200" name="direccion_empresa" id="direccion_empresa" style="width:900px;resize: none; display: block;" readonly="readonly">
                                   <?php if(isset($_POST['direccion_ciu_nat'])){
                                    echo $_POST['direccion_ciu_nat']; 
                                }?>
                            </textarea>
                        </div>
                    </div>
                    <div class="separador"></div>
                    <div class="row">
                        <div class="col-xs-4 form-group">
                            <label for="punto_emp">Punto de referencia</label>
                            <input type="text" maxlength="300" class="form-control" name="punto_emp" id="punto_emp" form="rd"/>
                        </div>
                        <div class="col-xs-4 form-group">
                            <label for="numero_emp">Teléfono de la empresa</label>
                            <input type="text" maxlength="11" class="form-control" name="tel_emp" id="tel_emp" value="<?php if(isset($_POST['telefono_empresa'])){echo $_POST['telefono_empresa'];}?>" form="rd" placeholder="Ej:02121234567" titel="Este campo es requerido"/>
                        </div>
                        <div class="col-xs-4 form-group">
                            <label for="calle_avenida">Correo Electrónico</label>
                            <input type="text" maxlength="150" class="form-control" name="email_emp" id="email_emp" value="<?php if(isset($_POST['email_empresa'])){echo $_POST['email_empresa'];}?>" form="rd" placeholder="alguien@alguien.com"/>
                        </div>
                    </div>
                </div>
            </article> <!-- Fin Datos Empresa -->

            <!-- Inicio Datos Denuncia -->
            <div class="separador"></div>
            <article>
                <div class="block">
                    <table class="table">
                        <caption><h2 style="background:#3B5998;color:white;padding:7px;">Datos de la Queja y/o Reclamo</h2></caption>
                        <thead>
                            <tr style="border-top: none; border-bottom: none;">
                                <th style="border-top: none;border-bottom: none;">N° Queja y/o Reclamo</th>
                                <th style="border-top: none;border-bottom: none;">Fecha Queja y/o Reclamo</th>
                                <th style="border-top: none;border-bottom: none;"><span class="requerido">*</span> Estatus </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr style="border-top: none;border-bottom: none;">
                                <td style="border-top: none;border-bottom: none;"><input type="text" class="form-control" name="num_den" id="num_den" value="<?=$num_den?>" readonly form="rd"/></td>
                                <td style="border-top: none;border-bottom: none;"><input type="text" class="form-control" name="fecha" id="fecha" value="<?=date('d/m/y')?>" readonly form="rd"/></td>

                                <td style="border-top: none;border-bottom: none;">
                                    <select name="estatus" class="form-control" id="estatus" form="rd" required="required" style="text-align: center;cursor: pointer;" title="Este campo es requerido">
                                        <option value="" selected style="padding: 5px;">Seleccione</option>
                                        <?php
                                        $estatus = dameEstatusDenuncia();

                                        if($estatus != NULL)
                                        {
                                            foreach($estatus as $indice => $registro)
                                            {
                                                if($registro['ID_ESTATUS'] != 2){

                                                    echo "<option style='padding:5px;' value=".$registro['ID_ESTATUS']." >".$registro['DESCRIPCION']."</option>";
                                                }
                                            }
                                        }
                                        ?>
                                    </select>
                                </td>
                            </tr>

                            <tr style="border-top: none;border-bottom: none;">
                                <th colspan="3" style="border-top: none;border-bottom: none;">Motivos</th>
                            </tr>
                            <tr style="border-top: none;border-bottom: none;">
                                <td colspan="3" style="border-top: none;border-bottom: none;">
                                    <select name="motivos[]" class="form-control" id="motivos" form="rd" required="required" multiple="multiple" style="width: 900px;">
                                        <?php
                                        $motivos = dameMotivosQuejas();
                                        foreach($motivos as $indice => $registro)
                                        {
                                            echo "<option value=".$registro['ID_MOTIVO'].">".$registro['DESCRIPCION']."</option>";
                                        }
                                        ?>
                                    </select>
                                </td>
                            </tr>
                            <tr style="border-top: none;border-bottom: none;">
                                <th colspan="3" style="border-top: none;border-bottom: none;"><span class="requerido">*</span>Descripción Detallada de la Queja y/o Reclamo</th>
                            </tr>
                            <tr style="border-top: none;border-bottom: none;">
                                <td colspan="3" style="border-top: none;border-bottom: none;"><textarea name="descripcion" maxlength="3000" id="descripcion" form="rd" required="required"  style="width:900px;"></textarea></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </article><!-- Fin Datos Denuncia -->

            <!--Documentos-->

            <!-- Inicio Documentos -->
            <article>
                <div class="block">
                    <table class="table table-hover" id="tabla_documentos">
                        <caption><h2 style="background:#3B5998;color:white;padding:7px;">Documentos a Consignar</h2></caption>
                        <tbody>
                            <tr style="border-top: none;border-bottom: none; display:none" id="content_mensajedocs">
                                <td colspan="2" id="mensajedocs" style="text-align:left;color:red; font-weight: bolder;border-top: none;border-bottom: none;">
                                    Se debe seleccionar por lo menos un documento
                                </td>
                            </tr>
                            <?php
                            $documentos = getDocumentosQuejas();
                            foreach($documentos as $indice => $registro)
                            {
                                echo '<tr style="border-top: none;border-bottom: none;">
                                <td style="border-top: none;border-bottom: none;"><input type="checkbox" class="check_docs" name="documentos[]" value="'.$registro['ID_DOCUMENTO'].'" form="rd"/></td>
                                <td style="border-top: none;border-bottom: none; text-indent: -85px;" class="td_documentos">'.$registro['DESCRIPCION'].'</td>
                            </tr>';
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </article><!-- Fin Documentos -->
        <!--Documentos-->
        <?php  
        $ruta = "../quejas.php";
        if($_SESSION['USUARIO']['utype']==2)
            {$ruta="../quejas.analista.php";}
        elseif($_SESSION['USUARIO']['utype']==3)
            {$ruta="../quejas.responsable.php";}
        ?>
        <div class="archivos" style="margin-bottom:25px;">
          <h2 style="background:#3B5998;color:white;padding:7px;">Adjuntar archivos</h2>


          <div class="botones_archivos" style="overflow:hidden;margin-bottom:25px;">
            <button id="menos_file" class="btn btn-danger"  style="float:right;"><span class="glyphicon glyphicon-minus"></span></button>
            <button id="mas_file" class="btn btn-primary"  style="float:right;"><span class="glyphicon glyphicon-plus"></span></button>
        </div>


        <div id="inpuflivos" style="overflow:hidden;height:auto;display:inline-block;">
            <input type="file" name="archivosdenuncia[]" class="archivosdenuncia form-control" style="border-radius:0px;display:inline;margin-right:10px;height: auto;">              
        </div>
    </div>
    <hr>
    <div class="elemento">
     <input type="submit" value="Registrar" id="registrar" form="rd" class="btn btn-primary" />
     <input type="reset" value="Limpiar" form="rd" class="btn btn-primary" id="limpiar"/>
     <input type="button" value="Cancelar" class="btn btn-primary" id="cancelar" onclick="location='<?php echo $ruta; ?>?dgf=r'" />
     <div style="float:right"><a href="#banner_pueblo_soberano" id="subir" title="Subir"><span class="glyphicon glyphicon-arrow-up" style="font-size:2em;color:#3B5998;"></span></a><p style="color:blue;">Subir</p></div>
 </div>
</div><!--Fin content center-->
</fieldset>
</form>
</section>
</div>
<script type="text/javascript" src="<?=$base_url;?>public_html/js/jquery-2.1.4.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?=$base_url;?>public_html/vendor/jquery-ui/jquery-ui.min.css">
<link rel="stylesheet" type="text/css" href="<?=$base_url;?>public_html/vendor/jquery-ui/jquery-ui.theme.min.css">
<script type="text/javascript" src="<?=$base_url;?>public_html/vendor/jquery-ui/jquery-ui.min.js"></script>
<!--<script type="text/javascript" src="<?=$base_url;?>public_html/js/desplegable.js"></script>-->
<script type="text/javascript" src="<?=$base_url;?>public_html/js/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?=$base_url;?>public_html/js/emergente.js"></script>
<script type="text/ecmascript" src="<?=$base_url;?>public_html/js/consultaEmergente.js"></script>
<script type="text/javascript" src="<?=$base_url;?>public_html/js/mostrarContenido.js"></script>
<script type="text/javascript" src="<?=$base_url;?>public_html/js/enviar.js"></script>
<script type="text/javascript" src="<?=$base_url;?>public_html/vendor/chosen/chosen.jquery.js"></script>
<script type="text/javascript" src="<?=$base_url;?>public_html/vendor/chosen/chosen.proto.js"></script>
<link rel="stylesheet" href="<?=$base_url;?>public_html/vendor/DataTables/media/css/jquery.dataTables.css">
<script type="text/javascript" src="<?=$base_url;?>public_html/vendor/DataTables/media/js/jquery.dataTables.js"></script>
<script type="text/javascript" src="<?=$base_url;?>public_html/vendor/jQueryValidation/dist/jquery.validate.js"></script>
<script type="text/javascript" src="<?=$base_url;?>public_html/vendor/jQueryMask/jquery.mask.js"></script>
<script type="text/javascript">
    $(document).ready(function()  
    {
        $.jMaskGlobals = {
            maskElements: 'input,td,span,div',
            dataMaskAttr: '*[data-mask]',
            dataMask: true,
            watchInterval: 300,
            watchInputs: true,
            watchDataMask: false,
            byPassKeys: [9, 16, 17, 18, 36, 37, 38, 39, 40, 91],
            translation: {
                '0': {pattern: /\d/},
                '9': {pattern: /\d/, optional: true},
                '#': {pattern: /\d/, recursive: true},
                'A': {pattern: /[a-zA-Z0-9]/},
                'S': {pattern: /^([VvEeJjGg])$/}
            }
        };

        $(".rif").mask('S999999999',{placeholder: "Ej: J123456789"});


        /********************************************************************************************/
        $("a#subir").click(function(e) {
           e.preventDefault();
           volver = $(this).attr("href");
           $("html, body").animate({
            scrollTop: $(volver).offset().top
        }, 2000);
            }); //subir

        /*********************************************************************************************************/
            //$("#motivos").multipleSelect({filter:true,  placeholder:"Selecione uno o varios motivos",width:"900px"});
            $("#motivos").chosen();
            /**********************************************************************************************************/
            $('#telhab, #telmov, #tel_emp, #id_denunciado, #tel_hab_rep, #tel_mov_rep, .tel_hab_rep').keypress(function(e){
                keynum = window.event ? window.event.keyCode : e.which;
                
                
                if ((keynum == 8) || (keynum == 0))
                    return true;
                return /\d/.test(String.fromCharCode(keynum));
                
            });

            <?php if(!isset($_POST['rif_ciu_nat']) || $_POST['rif_ciu_nat']==""){ ?>
                $("#rif").removeAttr('readonly');
                $("#rif").attr('required', 'required');

                <?php } ?>

                $("#cancelar").click(function(){
                    var pagina = '../denuncias.php';
                    location.href=pagina;

                });

                jQuery.validator.addMethod("formato_correo", function(value,  element) {
                    return this.optional(element) || /^[_a-zA-Z0-9-]+(\.[_a-zA-Z0-9-]+)*@[a-zA-Z0-9-]+(\.[a-zA-Z0-9-]+)*(\.[a-zA-Z]{2,3})$/.test(value);
                }, "");

                /*jQuery.validator.addMethod("direccion_patrono", function(value,  element) {
                    return this.optional(element) || /^[a-zA-Z0-9]{1-140}$/.test(value);
                }, "");*/
jQuery.validator.addMethod("phone_number", function(value,  element) {
    return this.optional(element) || /^\d{7}$/.test(value);
}, "");
$("#rd").validate({
    rules:{
        estado:{required:true},
        rif:{
            required:true,
            minlength:10
        },
        codigo_movil_representante:{required:true},
        codigo_fijo_representante:{required:true},
        municipio:{required:true},
        localidad:{required:true},
        motivos:{required:true},
        documentos:{
            required:true,
            minlength:1},
            descripcion:{required:true},
            email_emp:{
                formato_correo:true,required:true},
                email_rep:{
                    required:true,
                    formato_correo:true},
                    tel_hab_rep:{
                        required:true,
                        phone_number:true},
                        tel_mov_rep:{
                            required:true,
                            phone_number:true},
                            calleper:{required:true},
                            edifper:{required:true},
                            ncasa:{required:true},
                            direccion_patrono:{required:true,
                                maxlength:140},
                                tel_emp:{
                                    required:true,
                                    minlength:11}
                                },
                                messages:{
                                    estado:{required:"Este campo es requerido"},
                                    rif:{
                                        required:"Este campo es requerido",
                                        minlength:"Mínimo 10 caracteres"
                                    },
                                    codigo_movil_representante:{required:"Seleccione"},
                                    codigo_fijo_representante:{required:"Seleccione"},
                                    municipio:{required:"Este campo es requerido"},
                                    localidad:{required:"Este campo es requerido"},
                                    motivos:{required:"Este campo es requerido"},
                                    documentos:{
                                        minlength:"Seleccione al menos un documento",
                                        required: "Este campo es requerido"},
                                        descripcion:{required:"Este campo es requerido"},
                                        email_emp:{
                                            formato_correo:"Introduzca un formato de email válido",
                                            required:"Este campo es requerido"   
                                        },
                                        email_rep:{
                                            required:"Este campo es requerido",
                                            formato_correo:"Introduzca un formato de email válido"},
                                            tel_hab_rep:{
                                                required:"Este campo es requerido",
                                                phone_number:"Debe poseer 7 dígitos"
                                            },
                                            tel_mov_rep:{
                                                required:"Este campo es requerido",
                                                phone_number:"Debe poseer 7 dígitos"
                                            },
                                            calleper:{required:"Este campo es requerido"},
                                            edifper:{required:"Este campo es requerido"},
                                            ncasa:{required:"Este campo es requerido"},
                                            direccion_patrono:{required:"Este campo es requerido",
                                            maxlength:"Máximo 140 caracteres"},
                                            tel_emp:{
                                                required:"Este campo es requerido",
                                                minlength:"Mínimo 11 caracteres"}
                                            },
                                        });

$("#rd").submit(function(e)
{

                //Se verifica si alguno de los checks esta seleccionado
                if ($('input[name="documentos[]"]').is(':checked'))
                {
                    return true;
                }
                else
                {
                    $("#content_mensajedocs").css({'display':'block'});
                    $(".td_documentos").css({'text-indent':'-845px'});
                    return false;
                }      
            });
/**********************************************************************************/
$('input[name="documentos[]"]').on('click', function(){
    $("#content_mensajedocs").css({'display':'none'});
    $(".td_documentos").css({'text-indent':'-85px'});
})
/***********************************************************************************/

<?php if(isset($_POST['direccion_ciu_nat']) && $_POST['direccion_ciu_nat'] !=""){ ?>

    $("#consultar_empresa_all").attr('disabled','disabled').css({'display':'none'});
    $("#direccion_empresa").css({'text-indent':'-135px'}); 
    
    <?php } ?>
        });//fin ready1


$("#id_denunciado").on("blur", buscarCiudadano);

function buscarCiudadano()
{

    $nac_apo = $("#nacionalidad").val();
    $id_apo  = $("#id_denunciado").val();

    if($id_apo == "")
    {
        alert("Ingrese una cédula en el campo correspondiente")
    }
    else
    {
        $.ajax({
            dataType: "json",
            data: {"nac_apo": $nac_apo,"id_apo": $id_apo},
            url:   '../../../resources/select/buscar.php',
            type:  'post',
            beforeSend: function(){
                    //Lo que se hace antes de enviar el formulario
                    $("#id_denunciado").after('<img src="<?=$base_url;?>public_html/imagenes/484_azul.GIF" id="cargando_apo" style="display:inline; margin-left:150px; margin-top:-50px; width:30px; ">');
                    $("#nombre_denunciado").val("").attr('readonly','readonly');
                    $("#apellido_denunciado").val("").attr('readonly','readonly');
                },
                success: function(respuesta){
                    //lo que se si el destino devuelve algo
                    $("#cargando_apo").remove();
                    $("#nombre_denunciado").val(respuesta.nombre);
                    $("#apellido_denunciado").val(respuesta.apellido);


                },
                error:  function(xhr,err){ 
                    alert("readyState: "+xhr.readyState+"\nstatus: "+xhr.status+"\n \n responseText: "+xhr.responseText);
                }
            });
}
}
</script>

<script>
    /*
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
}*/
</script>

<script>

    $(document).on("ready",function(){
        //var num_checks = $(".check_docs").length;
        $("#mas_file").on("click",function(e){
            e.preventDefault();

            var num_checks = $(".check_docs:checked").length;
	   //console.log(num_checks);	

     if($(".archivosdenuncia").length < num_checks ){agregar();}   
 });

        $("#menos_file").on("click",function(e){
            e.preventDefault();

            if($(".archivosdenuncia").length > 1){$(".archivosdenuncia:last").remove();}
        });
    });

    function agregar(){
        var file='<input type="file" name="archivosdenuncia[]" class="archivosdenuncia form-control" style="border-radius:0px;display:inline;margin-right:10px;height:auto;">';
        var nuevo_file = $(file);
        $("#inpuflivos").append(nuevo_file);
    }
</script>
</div>

