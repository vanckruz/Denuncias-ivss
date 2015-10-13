<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
$hora_denuncia = date("h:m");
include("../../config/config.php");
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registro de Denuncia</title>
    <link rel="shortcut icon" href="<?=$base_url;?>public_html/imagenes/favicon.ico" type="image/x-icon" />
    <link rel="stylesheet" type="text/css" href="<?=$base_url;?>public_html/css/bootstrap/css/bootstrap.css" />
    <link rel="stylesheet" type="text/css" href="<?=$base_url;?>public_html/css/desplegable.css" />
    <link rel="stylesheet" type="text/css" href="<?=$base_url;?>public_html/vendor/chosen/chosen.css" />
    <link rel="stylesheet" type="text/css" href="<?=$base_url;?>public_html/vendor/multiple_select/multiple-select.css"/>
    <link rel="stylesheet" type="text/css" href="<?=$base_url;?>public_html/vendor/bootstrap-switch/dist/css/bootstrap3/bootstrap-switch.css" />

    <style>
        label.error{
            color: red;
            margin-top:5px;
        }
        .ui-dialog-titlebar,.ui-widget-header{
            background:#3B5998 !important;
            color: white !important;
            border-radius:0px !important;
            padding: 5px !important;
            box-shadow: 5px 7px 7px #888888 !important;
        }
        .ui-dialog-content,.ui-widget-content{
            background:linear-gradient(#ffffff,#dde9f4) !important;
        }



/*input[type=text],select{
   border:none; 
}*/
</style>
</head>
<body style="background:linear-gradient(to right, #AFA19E, #E7E7FF, #E7E7E7, #8E8E8E) no-repeat scroll 0% 0% #8E8E8E;height:auto;">
 <!--Mensajes de alerta-->
 <div id="content_mensaje1" style="display:none;position:fixed;z-index:100000;background:rgba(0,0,0,0.8);width:100%;height:100%;">
    <div style="z-index: 10000;width:600px;hight:300px;margin:auto;margin-top:100px;background:rgba(255,255,255,0.8);" id="alerta1" title="Mensaje">
        <div id="titulo_alerta" style="background:#3B5998;color:white;padding:10px;margin:auto;font-size:1.4em; ">
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
    <div style="z-index: 10000;width:600px;hight:300px;margin:auto;margin-top:100px;background:rgba(255,255,255,0.8);" id="alerta2" title="Mensaje">
        <div id="titulo_alerta2" style="background:#3B5998;color:white;padding:10px;margin:auto;font-size:1.4em; ">
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
    <div style="z-index: 10000;width:600px;hight:300px;margin:auto;margin-top:100px;background:rgba(255,255,255,0.8);" id="alerta3" title="Mensaje">
        <div id="titulo_alerta3" style="background:#3B5998;color:white;padding:10px;font-size:1.4em; ">
            Mensaje
            <div style="width:21px;float:right;cursor:pointer;" title="Cerrar mensaje" id="cerrar_mensaje3">
                <span class="glyphicon glyphicon-remove"></span>
            </div>
        </div>

        <div class="mensaje" style="padding:25px 25px 25px 25px;font-size:1.3em; ">
            Por favor ingrese un valor en el campo 
        </div>
        
    </div>
</div>

<div id="content_mensaje4" style="display:none;position:fixed;z-index:100000;background:rgba(0,0,0,0.8);width:100%;height:100%;">
    <div style="z-index: 10000;width:600px;hight:300px;margin:auto;margin-top:100px;background:rgba(255,255,255,0.8);" id="alerta1" title="Mensaje">
        <div id="titulo_alerta5" style="background:#3B5998;color:white;padding:10px;margin:auto;font-size:1.4em; ">
            Mensaje
            <div style="width:21px;float:right;cursor:pointer;" title="Cerrar mensaje" id="cerrar_mensaje5">
                <span class="glyphicon glyphicon-remove"></span>
            </div>
        </div>                                     
        <div class="mensaje" style="padding:25px 25px 25px 25px;font-size:1.3em;">
         ¡ Este ciudadano ya posee una denuncia en proceso en contra de esta empresa, debe esperar a que la misma se cerrada para efectuar otra !
     </div>
 </div>
</div>
<!--Mensajes de alerta-->

<!-- Modal Consultar empresa-->
<div class="modal fade bs-example-modal-lg" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" id="">
        <div class="modal-content" style="background:transparent linear-gradient(#FFF, #DDE9F4) repeat scroll 0% 0%;">
            <div class="modal-header" style="background:#3B5998"> 
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

                        <select name="opciones" class="form-control text-center sel" id="opciones" required style="text-align: center;cursor:pointer;">
                            <option style="padding:5px"; value="" selected >Seleccione</option>
                            <option style="padding:5px"; value="id_empresa">N° Patronal</option>
                            <option style="padding:5px"; value="rif">RIF</option>
                            <option style="padding:5px"; value="nombre_empresa">Nombre</option>
                        </select>
                        
                    </div>
                    <div id="contenido_emergente_before">
                        <input type="text" class="form-control" id="valor" name="valor" form="form_consultar" style="display:none; margin-left: 317px;"/>
                    </div>
                    <hr>
                    <div id="contenido_emergente">

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


<!--***********************************************************************************************-->
<div id="consultar_nuevo_ciudadano" style="display:none;width:960px;height:500px;">
    <div id="content_new_ciu">
        <?php echo $data; ?>
    </div>
</div>
<!--***********************************************************************************************-->
<header class="banner_desplegable" style="width:1024px;margin:auto;" id="banner_pueblo_soberano">
    <figure>
        <img src="<?=$base_url;?>public_html/imagenes/top.jpg"/>
    </figure>
</header>
<div class="container" style="background:transparent linear-gradient(#FFF, #DDE9F4) repeat scroll 0% 0%;">
    <section class="accordion">
        <fieldset>
            <form name="registrar" id="rd" method="post" action="Controller.Denuncia.php" class="form-inline" enctype="multipart/form-data">
                <input type="hidden" name="option" value="registrar" form="rd"/>
                <input type="hidden" name="idc" value="<?=$idc?>" form="rd"/>
                <input type="hidden" name="cedula" value="<?=$ced?>" form="rd"/>
                <input type="hidden" name="nombre" value="<?=$nom?>" form="rd"/>
                <input type="hidden" name="apellido" value="<?=$ape?>" form="rd"/>
                <input type="hidden" name="nacionalidad_nueva" id="nacionalidad_nueva" value="<?=$nacionalidad_nueva?>">
                <input type="hidden" name = "cedula_nueva" id="cedula_nueva" value="<?=$cedula_nueva?>">
                <input type="hidden" name = "hora_denuncia" id="hora_denuncia" value="<?=$hora_denuncia?>">
                <input type="hidden" name = "direccion_responsable" id="direccion_responsable" value="1">
                
                <!--<input type="hidden" name="estatus" value="En Proceso" form="rd"/>-->
                
                <div class="row">
                    <div class="col-xs-12" style="width:1025px !important;background:#3B5998;">
                        <h1 class="text-center" style="color:white">Registro de Denuncia</h1>        
                    </div>
                </div>
                <!-- Inicio Datos Trabajador -->
                <div id="content_center" style="width:960px !important;margin:auto;padding:25px;overflow:hidden;background:transparent linear-gradient(#FFF, #DDE9F4) repeat scroll 0% 0%;box-shadow:10px 10px 21px #000;"><!--Iniciio content center-->

                    <article>
                        <h2 style="background:#3B5998;color:white;padding:7px;">Datos del Trabajador</h2>
                        <div >
                            <div id="campos_requeridos">
                                <span class="requerido">*</span><label> Campos Obligatorios</label>
                            </div>
                            <div class="row">
                                <div class="col-xs-12">
                                    <div id="opcion_consultar_nuevo" title="Consultar de nuevo" style="cursor:pointer; width: 160px; height: 35px; padding:5px;color:white;background:#04c;">
                                        <!--<span class="glyphicon glyphicon-search" aria-hidden="true" style="margin-top:10px;"></span>-->
                                        <span class="glyphicon glyphicon-user" aria-hidden="true" style="margin-top:4px;"></span>
                                        <p style="float:right;margin-left:7px; margin-top: 2px">    
                                            Historial de empleo  
                                        </p>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-xs-4 form-group ">
                                    <label for="cedula">C&eacute;dula</label>
                                    <input type="text" class="form-control" id="cedula" name="cedula2" value="<?=$ced?>" readonly form="rd"/>
                                </div>
                                <div class="col-xs-4 form-group">
                                    <label for="nombres">Nombres</label>
                                    <input type="text" class="form-control" id="nombre" name="nombre" value="<?= $nom ?>" readonly/>
                                </div>
                                <div class="col-xs-4 form-group">
                                    <label for="apellidos">Apellidos</label>
                                    <input type="text" class="form-control" id="apellido" name="apellido" value="<?=$ape?>" readonly/>
                                </div>
                            </div>

                            <div class="separador"></div>

                            <div class="row"><!--Fecha nacimiento y sexo-->
                                <div class="col-xs-4">
                                    <label><span class="requerido"></span>Fecha de Nacimiento</label>
                                    <input type="text" name="fecha_nacimiento" id="datenac" class="form-control" value="<?php echo $fecha_nac;?>" readonly="readonly">
                                </div>

                                <div class="col-xs-4">
                                    <label><span class="requerido"></span>Sexo</label>
                                    <input type="text" name="sexo" value="<?= $sexo ?>" id="sex" class="form-control" readonly="readonly">
                                </div>

                                <div class="col-xs-4 form-group ">
                                    <label for="estado">Estado <span class="requerido">*</span></label>
                                    <select name="estado" class="form-control" id="estado" form="rd" required style="cursor: pointer;">
                                        <option value="" style="padding:5px;">Seleccione</option>
                                        <?php
                                        $estados = dameEstado();
                                        foreach($estados as $indice => $registro){
                                            echo "<option style='padding:5px;' data-estado= ".$registro['NOMBRE_ESTADO']." value=".$registro['ID_ESTADO'].">".$registro['NOMBRE_ESTADO']."</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div><!--Fecha nacimiento y sexo-->

                            <div class="separador"></div>

                            <div class="row">

                                <div class="col-xs-4 form-group ">
                                    <label for="municipio">Municipio <span class="requerido">*</span></label>
                                    <select name="municipio" class="form-control" id="municipio" form="rd" required style="cursor: pointer;">
                                        <option value="" style="padding:5px;">Seleccione</option>
                                    </select>
                                </div>
                                <div class="col-xs-4 form-group ">
                                    <label for="parroquia">Parroquia <span class="requerido">*</span></label>
                                    <select name="localidad" class="form-control" id="localidad" form="rd" required style="cursor: pointer;">
                                        <option value="">Seleccione</option>
                                    </select>
                                </div>

                                <div class="col-xs-4 form-group">
                                    <label for="calle_avenida">Calle/Avenida <span class="requerido">*</span></label>
                                    <input type="text" maxlength="50" class="form-control" name="calleper" id="calleper" required form="rd"/>
                                </div>
                            </div>

                            <div class="separador"></div>

                            <div class="row">

                                <div class="col-xs-4 form-group">
                                    <label for="nombre_casa">Casa/Edificio <span class="requerido">*</span></label>
                                    <input type="text" maxlength="50" class="form-control" name="edifper" id="edifper" required form="rd"/>
                                </div>
                                <div class="col-xs-4 form-group">
                                    <label for="numero_casa">N° Casa/Apto <span class="requerido">*</span></label>
                                    <input type="text" maxlength="5" class="form-control" name="ncasa" id="ncasa" required form="rd"/>
                                </div>

                                <div class="col-xs-1 form-group">
                                    <label for="numero_movil"><span class="requerido"></span></label>
                                    <select name="codigo_fijo" id="codigo_fijo" class="form-control" style="margin-top:22px; width: 100px;cursor: pointer;">
                                        <option selected="selected" style="padding:5px;">Seleccione</option>
                                    </select>
                                </div>
                                <div class="col-xs-3 form-group">
                                    <label for="telefono_casa" style="margin-left: -80px;"><span class="requerido"></span>Teléfono de Habitación</label>
                                    <input type="text" maxlength="7" class="form-control" name="telhab" id="telhab" placeholder="Ej: 5555555" form="rd" style="margin-left: 30px;"/>
                                </div>
                            </div>

                            <div class="separador"></div>
                            <div class="row">

                                <div class="col-xs-1 form-group">
                                    <label for="numero_movil"></label>
                                    <select name="codigo_movil" class="form-control" id="codigo_movil" style="width: 205%;margin-top: 19px;height: 30px;cursor: pointer;">
                                        <option value="" style="padding:5px;">Seleccione</option>
                                        <option value="0412" style="padding:5px;">0412</option>
                                        <option value="0414" style="padding:5px;">0414</option>
                                        <option value="0424" style="padding:5px;">0424</option>
                                        <option value="0416" style="padding:5px;">0416</option>
                                        <option value="0426" style="padding:5px;">0426</option>
                                    </select>
                                </div>

                                <div class="col-xs-3 form-group">
                                    <label for="numero_casa" style="margin-left: -80px;">Teléfono Móvil <span class="requerido">*</span></label>
                                    <input type="text" maxlength="7" class="form-control" name="telmov" id="telmov" form="rd" placeholder="Ej: 5555555" style="margin-top: 1px;margin-left: 16%;"/>
                                </div>

                                <div class="col-xs-4 form-group">
                                    <label for="email">Correo Electrónico <span class="requerido"></span></label>
                                    <input type="text" maxlength="100" class="form-control correo" name="email" id="email" form="rd" placeholder="Ej: alguien@alguien.com"/>

                                </div>

                                <div class="col-xs-4">
                                    <div id="apoderado" class="alert alert-info" style="cursor:pointer;border-radius:0px;margin-top: 13px;" title="Indicar el apoderado del denunciante">
                                        <span class="requerido"></span>Apoderado<span class="glyphicon glyphicon-align-justify" style="float:right;"></span>
                                    </div>                            
                                </div>
                            </div><!--DIV ROW-->

                            <!--row apoderado-->
                            <div class="row" style="display:none;" id="fila_apoderado">
                                <div class="col-xs-12">
                                    <div class="alert alert-info" style="padding:16px;overflow:hidden;border-radius:0px;">
                                        <div class="titulo_apo" style="text-align:center;">
                                         <b>Datos del Apoderado</b> 
                                         <br>
                                     </div> 
                                     <hr> 

                                     <div class="contenido_apoderado " >
                                         <div class="col-xs-3">
                                          <label for="nacionalidad_apoderado">Nacionalidad <span class="requerido">*</span></label><br>
                                          <select name="nacionalidad" id="nacionalidad" class="form-control" style="text-align: center;cursor: pointer;">
                                              <option value="" selected="selected" style="padding: 5px;">Seleccione</option>
                                              <option value="V" style="padding: 5px;">V</option>
                                              <option value="E" style="padding: 5px;">E</option>
                                              <option value="T" style="padding: 5px;">T</option>
                                          </select>  
                                          <div id="mensaje_error_nac" style="color:red;margin-top:12px;width:180px;display:none;font-size:0.9em;text-align:left;font-weight: bold;"></div>                                  
                                      </div>

                                      <div class="col-xs-3">
                                        <label for="cedula_apoderado">Cédula del Apoderado <span class="requerido">*</span></label>
                                        <input type="text" name="cedula_apo" class="form-control" id="cedula_apo" style="display:block;" maxlength="8">
                                        <div id="mensaje_error_apo" style="color:red;margin-top:12px;width:180px;display:none;font-size:0.9em;text-align:left;font-weight: bold;"></div>
                                        <div id="mensaje_error_apo1" style="color:red;margin-top:12px;width:180px;display:none;font-size:0.9em;text-align:left;font-weight: bold;"></div>
                                    </div>
                                    <div class="col-xs-3" style="padding-top:12px;">
                                     <label for="nombres_apoderado">Nombres del Apoderado </label>
                                     <input type="text" name="nombre_apo" id="nombre_apo" value="" style="display:block;">
                                 </div>

                                 <div class="col-xs-3" style="padding-top:12px;">
                                     <label for="apellidos_apoderado">Apellidos del Apoderado </label>
                                     <input type="text" name="apellido_apo" value="" id="apellido_apo" style="display:block;">
                                 </div>
                             </div>

                         </div>

                     </div>
                 </div>
                 <!--row apoderado-->
             </div>
         </article> <!-- Fin Datos Trabajador -->
         <div class="separador"></div>

         <!-- Inicio Datos Empresa -->
         <article>
            <h2 style="background:#3B5998;color:white;padding:7px;">Datos de la Empresa</h2>
            <div class="block">
                <div class="row">
                    <div class="col-xs-12">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal" id="consultar_empresa_all">
                            Consultar Empresa
                        </button>
                    </div>
                </div>

                <div class="separador"></div>

                <div class="row">
                    <div class="col-xs-5 form-group">
                        <label for="razon">Nombre o Razón Social</label>
                        <input type="text" class="form-control" name="razon" id="razon" maxlength="500" form="rd" value="<?php if(isset($_POST['nombre_empresa_ciu_nat'])){echo $_POST['nombre_empresa_ciu_nat'];}?>" required="required" readonly title="Este campo es requerido"/>
                    </div>

                    <div class="col-xs-3 form-group">
                        <label for="rif">RIF</label>
                        <input type="text" class="form-control rif" name="rif" id="rif" maxlength="10" form="rd" value="<?php if(isset($_POST['rif_ciu_nat'])){echo $_POST['rif_ciu_nat'];}?>" required readonly title="Este campo es requerido"  onkeyup="this.value=this.value.toUpperCase();"/>
                    </div>
                    <div class="col-xs-3 form-group">
                        <label for="" id="label_pat">Nº Patronal</label>
                        <input type="text" class="form-control" name="npat" id="npat" readonly maxlength="9" form="rd" value="<?php if(isset($_POST['id_empresa_ciu_nat'])){echo $_POST['id_empresa_ciu_nat'];}?>" />
                    </div>

                </div>

                <div class="separador"></div>
                <div class="row" id="dir_emp_vsbl">
                    <div class="col-xs-12">
                        <label>Dirección Fiscal</label>
                        <textarea class="form-control" maxlength="1000" name="direccion_empresa" id="direccion_empresa" style="width:900px;resize: none; display: block;" readonly>
                         <?php if(isset($_POST['direccion_ciu_nat'])){
                            echo $_POST['direccion_ciu_nat']; 
                        }?>
                    </textarea>

                </div>
            </div>

            <div class="separador"></div>
            <div class="row">
                    <div class="col-xs-12">
                    <label style="margin-bottom: 30px;">Ingresar Dirección Fiscal Nueva: </label>
                            <!--
                            <label>Si</label><input type="radio" value="si" name="dirfiscal" id="radiodirfiscal1">
                            <label>No</label><input type="radio" value="no" name="dirfiscal" id="radiodirfiscal2">
                        -->
                        <input type="checkbox" value="" name="dirfiscal" id="dirfiscal">
                    </div>
                    <div class="separador"></div>
                    <div class="row" id="dirfiscal1" style="display:none; margin-left: 2px;">
                        <div class="col-xs-4 form-group">
                            <label for="estado">Estado <span class="requerido">*</span></label>
                            <select name="estado2" class="form-control" id="estado2" form="rd" style="cursor:pointer;">
                                <option value="" selected="selected">Seleccione</option>
                                <?php
                                $estados = dameEstado();
                                foreach($estados as $indice => $registro)
                                {
                                    echo "<option value=".$registro['ID_ESTADO'].">".$registro['NOMBRE_ESTADO']."</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-xs-4 form-group">
                            <label for="municipio2">Municipio <span class="requerido">*</span></label>
                            <select name="municipio2" class="form-control" id="municipio2" form="rd" style="cursor:pointer;">
                                <option value="">Seleccione</option>
                            </select>
                        </div>
                        <div class="col-xs-4 form-group">
                            <label for="parroquia">Parroquia <span class="requerido">*</span></label>
                            <select name="localidad2" class="form-control"  id="localidad2" form="rd" style="cursor:pointer;">
                                <option value="">Seleccione</option>
                            </select>
                        </div>
                    </div>

                    <div class="separador"></div>
                    <div class="row">
                        <div class="col-xs-4 form-group">
                            <label for="punto_emp">Punto de Referencia</label>
                            <input type="text" maxlength="300" class="form-control" name="punto_emp" id="punto_emp" form="rd"/>
                        </div>
                        <div class="col-xs-2 form-group">
                            <label for="numero_emp">Tlf. Empresa</label>
                            <select name="cod_area_emp" id="cod_area_emp" class="form-control" style="width:120px;float: left;height: 30px;cursor:pointer;">
                                <option value="" style="padding: 5px; text-align: center;">Seleccione</option>
                                <?php
                                $codigos = dameCodigosTelefono();
                                foreach($codigos as $indice => $registro){
                                    echo "<option value=".$registro['CODIGO_AREA']." style='padding: 5px; text-align: center;'>".$registro['CODIGO_AREA']."</option>";
                                }
                                ?>
                            </select> 
                        </div>
                        <div class="col-xs-2">
                            <input type="text" class="form-control telefono" name="tel_emp" form="rd" style="width: 150px;float: right;margin-top: 25px" />
                        </div>
                        <div class="col-xs-4 form-group">
                            <label for="calle_avenida">Correo Electrónico</label>
                            <input type="text" maxlength="300" class="form-control correo" name="email_emp" id="email_emp" form="rd" placeholder="Ej: alguien@alguien.com"/>
                        </div>
                    </div>



                    <div class="separador"></div>

                    <div class="row" id="dirfiscal2" style="display:none; margin-left: 2px;">
                        <div class="col-xs-4 form-group">
                            <label for="calle_emp">Calle/Avenida <span class="requerido">*</span></label>
                            <input type="text" class="form-control" name="calle_emp" id="calle_emp" maxlength="50" form="rd"  />
                        </div>
                        <div class="col-xs-4 form-group">
                            <label for="casa_emp">Casa/Edificio <span class="requerido">*</span></label>
                            <input type="text" class="form-control" name="edif_emp" id="edif_emp" maxlength="20" form="rd"  />
                        </div>
                        <div class="col-xs-4 form-group">
                            <label for="apto_emp">N° Casa/Apto <span class="requerido">*</span></label>  
                            <input type="text" class="form-control" name="ncasa_emp" id="ncasa_emp" maxlength="5" form="rd"  />
                        </div>
                    </div>
                    
                </div>
            </article> <!-- Fin Datos Empresa -->
            
            <div class="separador"></div>
            
            <!-- Inicio Datos Denuncia -->
            <article>
                <div class="block">
                    <table class="table">
                        <caption><h2 style="background:#3B5998;color:white;padding:7px;">Datos de la Denuncia</h2></caption>
                        <thead>
                            <tr>
                                <th>N° Denuncia</th>
                                <th>Fecha Denuncia</th>
                                <th>Estatus <span class ="requerido">*</span></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><input type="text" class="form-control" name="num_den" id="num_den" value="<?=$num_den?>" readonly form="rd"/></td>
                                <td><input type="text" class="form-control" name="fecha" id="fecha" value="<?=date('d/m/y')?>" readonly form="rd"/></td>
                                
                                <td>
                                    <select name="estatus" class="form-control" id="estatus" form="rd" required title="Este campo es requerido" style="text-align: center;cursor:pointer;">
                                        <option value="" selected style='padding:5px;'>Seleccione</option>
                                        <?php
                                        $estatus = dameEstatusDenuncia();

                                        if($estatus != null){
                                            foreach($estatus as $indice => $registro)
                                            {
                                              if($registro['ID_ESTATUS'] != 2){
                                                echo "<option style='padding:5px;' value=".$registro['ID_ESTATUS']." >".$registro['DESCRIPCION']."</option>";
                                            }
                                        }
                                    }
                                    ?>
                                </select>
                                 <!--
                                <td><input type="text" class="form-control" value="Registrada" readonly disabled="disabled" /></td>
                                <input type="hidden"  name="estatus" id="estatus" value="0" form="rd">-->
                            </td>
                        </tr>
                        <tr>
                            <th colspan="3">Motivos</th>
                        </tr>
                        <tr>
                            <td colspan="3">
                                <select name="motivos[]" class="chosen" id="motivos" form="rd" required="required" multiple="multiple" style="cursor:pointer;">
                                    <?php
                                    $motivos = dameMotivos();
                                    foreach($motivos as $indice => $registro)
                                    {
                                        echo "<option value=".$registro['ID_MOTIVO'].">".$registro['DESCRIPCION']."</option>";
                                    }
                                    ?>
                                </select>
                            </td>
                        </tr>
                        <tr style="display: none;" id="otros_motivos">
                            <td colspan="3">
                                <label>Descripción del Motivo</label>
                                <input type="text" name="otro_motivo" id="otro_motivo">
                            </td>
                        </tr>
                            <!--
                            <tr class="">
                                <th colspan="3">Responsable</th>
                            </tr>
                            <tr>
                                <td colspan="3">
                                    <select name="direccion_responsable" class="form-control" id="direccion_responsable" form="rd" required>
                                        <option value="">Seleccione</option>-->
                                        <?php 
                                            /*
                                            $direcciones = dameDirecciones();
                                            foreach($direcciones as $indice => $registro)
                                            {
                                                echo "<option value=".$registro['ID_DIRECCION'].">".$registro['NOMBRE']."</option>";
                                            }
                                        ?>//php 
                                    </select>
                                </td>
                            </tr>*/?>
                            <tr>
                                <th colspan="3">Descripción <span class="requerido">*</span></th>
                            </tr>
                            <tr>
                                <td colspan="3"><textarea name="descripcion" maxlength="3000" id="descripcion" form="rd" required style="width:900px;"></textarea></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </article><!-- Fin Datos Denuncia -->

            <!-- Inicio Documentos -->
            <article>
                <div class="block">
                    <table class="table table-hover" id="tabla_documentos">
                        <caption><h2 style="background:#3B5998;color:white;padding:7px;">Documentos a Consignar</h2></caption>
                        
                        <tbody>
                            <tr>
                                <td colspan="2" id="mensajedocs" style="text-align:left;color:red;font-weight: bolder;">

                                </td>
                            </tr>
                            <?php
                            $documentos = getDocumentos();
                            foreach($documentos as $indice => $registro)
                            {
                                echo '<tr>
                                <td><input type="checkbox" class="check_docs" name="documentos[]" value="'.$registro['ID_DOCUMENTO'].'" form="rd"/></td>
                                <td>'.$registro['DESCRIPCION'].'</td>
                            </tr>';
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </article><!-- Fin Documentos -->
        <?php  
        $ruta = "../denuncias.php";
        if($_SESSION['USUARIO']['utype']==2)
          {$ruta="../denuncias.analista.php";}
      elseif($_SESSION['USUARIO']['utype']==3)
          {$ruta="../denuncias.responsable.php";}
      ?>

      <div class="archivos" style="margin-bottom:25px;">
          <h2 style="background:#3B5998;color:white;padding:7px;">Adjuntar archivos</h2>
          

          <div class="botones_archivos" style="overflow:hidden;margin-bottom:25px;">
            <button id="menos_file" class="btn btn-danger"  style="float:right;"><span class="glyphicon glyphicon-minus"></span></button>
            <button id="mas_file" class="btn btn-primary"  style="float:right;"><span class="glyphicon glyphicon-plus"></span></button>
        </div>

        
        <div id="inpuflivos" style="overflow:hidden;height:auto;display:inline-block;">
            <input type="file" name="archivosdenuncia[]" class="archivosdenuncia form-control" style="border-radius:0px;display:inline;margin-right:10px;height:auto;">              
        </div>
    </div>
    <hr>
    <div class="elemento" style="margin-top:25px;">
       <input type="submit" value="Registrar" id="registrar" form="rd" class="btn btn-primary" />
       <input type="reset" value="Limpiar" form="rd" class="btn btn-primary" id="limpiar"/>
       <input type="button" value="Regresar" class="btn btn-primary" id="cancelar" onclick="location='<?php echo $ruta; ?>?dgf=r'" />
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
<script type="text/javascript" src="<?=$base_url;?>public_html/vendor/jquery-ui/js/jquery-ui.min.js"></script>
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
<script type="text/javascript" src="<?=$base_url;?>public_html/vendor/bootstrap-switch/dist/js/bootstrap-switch.js"></script>
<script type="text/javascript" src="<?=$base_url;?>public_html/vendor/jQueryMask/jquery.mask.js"></script>
<script type="text/javascript" src="<?=$base_url;?>public_html/vendor/jQueryValidation/dist/jquery.validate.js"></script>
<script type="text/javascript">
    $(document).ready(function()
    {
//$(".chosen").chosen({allow_single_deselect: true,width:"900px"});
 //$("#motivos").multipleSelect({filter:true,  placeholder:"Selecione uno o varios motivos",width:"900px"});

 $("#motivos").chosen();

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
//$(".npatronal").mask('S99999999',{placeholder: "Ej: N12345678"});

$(".telefono").mask('0000000',{placeholder: "Ej: 3834581"});
/*
$("#cod_area_emp").chosen();
$("#codigo_movil").chosen();
$("#estado").chosen();
$("#municipio, #localidad").chosen();
*/


//$(".correo").mask('',{placeholder: "ej. alguien@alguien.com"});

/**********************************************************************************/
/**********************************************************************************/
/*
$("#email").on("blur",function(){
expr = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
     if ( !expr.test($("#email").val()) ){
        $("#email").css({"border":"1px solid red"}); 
    }else{
        $("#email").css({"border":"none"}); 
    }
});


$("#email_emp").on("blur",function(){
expr = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    if ( !expr.test($("#email_emp").val()) ){
        $("#email_emp").css({"border":"1px solid red"}); 
    }else{
        $("#email_emp").css({"border":"none"}); 
    }
});
*/

$("#email_emp").on({
    blur:function(){
        if($("#email").val() != ""){
            if( $(this).val() == $("#email").val() ){
                $(this).after("<p id='pepemail' style='color:red;width:200px;font-size:1em;font-weight:bold;'>El email no puede ser el mismo que el denunciante.</p>");
            }
        }
    },
    focus:function(){
        $("#pepemail").remove();
    }
});
/***********************************************************************************/
$("#motivos option").on("click", function(){
    valor = $(this).val();
    if(valor=='12')
    {

      $("#otros_motivos").css('display','inline-block');
      $("#otro_motivo").css('width','900px');
      $("#otro_motivo").attr('required', 'required');
  }
  else
  {
      $("#otros_motivos").css('display','none');
      $("#otro_motivo").removeAttr('required');
  }
});

/***********************************************************************************/
    /*
    $("#radiodirfiscal2").on("click", function()
    {
        $("#dirfiscal1").css('display','block');
        $("#dirfiscal2").css('display','block');
        $("#estado2").attr('required', 'required');
        $("#municipio2").attr('required', 'required');
        $("#localidad2").attr('required', 'required');
        $("#calle_emp").attr('required', 'required');
        $("#edif_emp").attr('required', 'required');
        $("#ncasa_emp").attr('required', 'required');     
    });

    $("#radiodirfiscal1").on("click", function()
    {
        $("#dirfiscal1").css('display','none');
        $("#dirfiscal2").css('display','none');
        $("#estado2").removeAttr('required');
        $("#municipio2").removeAttr('required');
        $("#localidad2").removeAttr('required');
        $("#calle_emp").removeAttr('required');
        $("#edif_emp").removeAttr('required');
        $("#ncasa_emp").removeAttr('required');  
    });
*/
/***********************************************************************************/

$("#dirfiscal").bootstrapSwitch();

/***********************************************************************************/
$('#telhab, #telmov, #tel_emp, #cedula_apo').keypress(function(e){
    keynum = window.event ? window.event.keyCode : e.which;
    if ((keynum == 8))
        return true;
    return /\d/.test(String.fromCharCode(keynum));
});

/***********************************************************************************/
jQuery.validator.addMethod("formato_correo", function(value,  element) {
    return this.optional(element) || /^[_a-zA-Z0-9-]+(\.[_a-zA-Z0-9-]+)*@[a-zA-Z0-9-]+(\.[a-zA-Z0-9-]+)*(\.[a-zA-Z]{2,3})$/.test(value);
}, "");

jQuery.validator.addMethod("phone_number", function(value,  element) {
    return this.optional(element) || /^\d{7}$/.test(value);
}, "Debe poseer 7 dígitos");

jQuery.validator.addMethod("rif_format", function(value,  element) {
    return this.optional(element) || /^[a-zA-Z]{1}\d{9}/.test(value);
}, "");

$("#rd").validate({
    rules:{
        direccion_empresa:{required:true},
        codigo_movil:{required:true},
        estado:{required:true},
        municipio:{required:true},
        localidad:{required:true},
        motivos:{required:true},
        estado2:{required:true},
        municipio2:{required:true},
        localidad2:{required:true},
        calle_emp:{required:true},
        edif_emp:{required:true},
        ncasa_emp:{required:true},
        rif:{
            required:true,
            rif_format:true
        },
        documentos:{
            required:true,
            minlength:1},
            descripcion:{required:true},
            tel_emp:{
                maxlength:7,
                phone_number:true
            },
            email:{
                formato_correo:true},
                email_emp:{formato_correo:true},
                telhab:{phone_number:true},
                telmov:{
                    required:true,
                    phone_number:true},
                    calleper:{required:true},
                    edifper:{required:true},
                    ncasa:{required:true},
                    cedula_apo:{required:true}

                },
                messages:{
                    direccion_empresa:{required:"Este campo es requerido"},
                    codigo_movil:{required:"Seleccione"},
                    estado:{required:"Este campo es requerido"},
                    municipio:{required:"Este campo es requerido"},
                    localidad:{required:"Este campo es requerido"},
                    motivos:{required:"Este campo es requerido"},
                    estado2:{required:"Esta campo es requerido"},
                    municipio2:{required:"Esta campo es requerido"},
                    localidad2:{required:"Esta campo es requerido"},
                    calle_emp:{required:"Esta campo es requerido"},
                    edif_emp:{required:"Esta campo es requerido"},
                    ncasa_emp:{required:"Esta campo es requerido"},
                    rif:{
                        required:"Este campo es requerido",
                        rif_format:"Ej: J123456789"},
                        documentos:{
                            minlength:"Seleccione al menos un documento",
                            required: "Este campo es requerido"},
                            descripcion:{required:"Este campo es requerido"},
                            tel_emp:{
                                maxlength:"7 Dígitos"
                            },
                            email:{
                                formato_correo:"Introduzca un formato de email válido",
                            },
                            email_emp:{formato_correo:"Introduzca un formato de email válido"},
                            telhab:{required:"Este campo es requerido"},
                            telmov:{required:"Este campo es requerido"},
                            calleper:{required:"Este campo es requerido"},
                            edifper:{required:"Este campo es requerido"},
                            ncasa:{required:"Este campo es requerido"},
                            cedula_apo:{required:"Este campo es requerido"}

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
                    $("#mensajedocs").html('Se debe seleccionar por lo menos un documento');
                    return false;
                }
            });

<?php if(isset($_POST['direccion_ciu_nat']) && $_POST['direccion_ciu_nat'] !=""){ ?>

    $("#consultar_empresa_all").attr('disabled','disabled').css({'display':'none'});
        //$("#direccion_empresa").css({'text-indent':'-135px'});


        
        <?php } ?>


        <?php if(!isset($_POST['rif_ciu_nat']) || $_POST['rif_ciu_nat']==""){ ?>

            $("#rif").removeAttr('readonly');
            <?php }else{ ?>
             $("#rif").attr('readonly','readonly');
             <?php } ?>
             /**************************************************************************************/

             /********************************************************************************************/
             $("a#subir").click(function(e) {
                 e.preventDefault();
                 volver = $(this).attr("href");
                 $("html, body").animate({
                    scrollTop: $(volver).offset().top
                }, 2000);
            }); //subir
             /********************************************************************************************/
             $("#apoderado").click(function(){
                $("#fila_apoderado").slideToggle();
            });

             /******************************************************************************************************/    
             $("#opcion_consultar_nuevo").on("click",function(){               
        //$("#consultar_nuevo_ciudadano content_new_ciu").html("");

         //$("#consultar_nuevo_ciudadano #content_new_ciu").html(); 
         $("#consultar_nuevo_ciudadano").dialog({"title":"Historial de empleo del ciudadano "+$("#cedula").val(),"minHeight":"500","minWidth":"960","resize":false,"modal":true}); 
       /*
        $.ajax({
            data: {"option":"registro","ciudadano":"persona","nacionalidad": $("#nacionalidad_nueva").val(),"cedula":$("#cedula_nueva").val()},
            url:   '../Controllers/Controller.Denuncia2.php',
            type:  'post',
            beforeSend: function(){
                //$("#mensaje_empresa").css({"background":"rgba(255,255,255,0.9)"});
                $("#consultar_nuevo_ciudadano #content_new_ciu").html("<div style='background:white;vertical-align:center;'><img src='http://desarrollofiscalizacion.ivss.int/public_html/imagenes/484.GIF' style='background:rgba(255,255,255,0.7);width:70px;height:70px;margin-top:50px;'><br><p style='margin-top:16px;margin-bottom:50px;font-weight:bold;'>Cargando...</p></div>");
                },
            success: function(resp){
                //lo que se si el destino devuelve algo
                $("#consultar_nuevo_ciudadano #content_new_ciu").html('<?php echo $data; ?>');                           
            }
        });/*.done(function(){        
        $("#consultar_nuevo_ciudadano").dialog({"title":"Historial de empleo del ciudadano "+$("#cedula").val(),"minHeight":"500","minWidth":"800","resize":false,"modal":true});    
    }); */ 
});        
/********************************************************************************************/
$("#consultar_empresa_all").on("click",function(){
    $("#dir_emp_vsbl").show();
    $("#label_pat").show();
    $("#npat").show();
    $("#npat,#razon,#direccion_empresa").attr("readonly","readonly");
});

$(".boton_formulario").click(function(e){
    e.preventDefault();
    var $this = $(this);
    console.log($this.attr("data-direccion").replace(/-/g, " "));
    $.ajax({
        type:"post",
        url:"../Controllers/controller.validator.php",
        data: {"id_empresa" : $this.attr("data-id_empresa") , "id_ciudadano" : $("#cedula").val() },
        success: function(resp){
            if(resp > 0){

              $("#content_mensaje4").slideDown();

              $("#cerrar_mensaje5").on("click",function(){
                $("#content_mensaje4").slideUp();
            });

          }else{
            var this_boton = $this.attr("data-nombre_empresa").replace(/-/g, " ");

            $( "#consultar_nuevo_ciudadano" ).dialog( "close" );

            $("#consultar_empresa_all").attr('disabled','disabled').css({'display':'none'});

            $("#direccion_empresa").css({'text-indent':'0px'}); 

            $("#razon").val( $this.attr("data-nombre_empresa").replace(/-/g, " ") );

            $("#rif").val( $this.attr("data-rif") ).attr('readonly', 'readonly');

            $("#npat").val( $this.attr("data-id_empresa") );                            

            $("#direccion_empresa").val( $this.attr("data-direccion").replace(/-/g, " ") );

            }//Else
        }//success
    });
/*
var this_boton = $(this).attr("data-nombre_empresa").replace(/-/g, " ");

$( "#consultar_nuevo_ciudadano" ).dialog( "close" );

$("#consultar_empresa_all").attr('disabled','disabled').css({'display':'none'});

$("#direccion_empresa").css({'text-indent':'0px'}); 

$("#razon").val( $(this).attr("data-nombre_empresa").replace(/-/g, " ") );

$("#rif").val( $(this).attr("data-rif") );
$("#rif").attr('readonly', 'readonly');

$("#npat").val( $(this).attr("data-id_empresa") );                            

$("#direccion_empresa").html( $(this).attr("data-direccion").replace(/-/g, " ") );
*/
});//Click boton ok   
/********************************************************************************************/                          

/******************************************************************************************************/            
$("#boton_formulario2").click(function(){
    $( "#consultar_nuevo_ciudadano" ).dialog( "close" );
    $("#consultar_empresa_all").removeAttr('disabled').css({'display':'block'});
    
    $("#razon").val("");

    $("#rif").val("");

    $("#npat").val("");                            
    
    $("#direccion_empresa").html("");
}); 
/*****************************************************************************************/ 
});//fin ready1
</script>
<!--***********************************************************************************************-->
<script>
    $("#estado").on("change", buscarMunicipios);
    $("#estado").on("change", buscarCodigo);
    $("#municipio").on("change", buscarLocalidades);
    $("#estado2").on("change", buscarMunicipios2);
    $("#municipio2").on("change", buscarLocalidades2);
    
    $("#nombre_apo").attr('readonly','readonly');
    $("#apellido_apo").attr('readonly','readonly');  


    //$("#cedula_apo").after('<p id="mensaje_error_apo" style="color:red;margin-top:25px;width:400px;display:none;font-size: 1.2em;text-align: center;"></p>');

    $("#cedula_apo").on("blur", buscarCiudadano);

    function buscarCiudadano(){
/*
if(cedula_apoderado != cedula_ciudadano){
    $("#cedula_apo").on("blur", buscarCiudadano);
}else{
    alert("Ingrese un apoderado distinto");
}/*Else validación mismo ciudadano
*/

//$("#mensaje_error_apo").hide();

$nac_apo = $("#nacionalidad").val();
$id_apo  = $("#cedula_apo").val();
var cedula_ciudadano = <?=$cedula_nueva?>;
var cedula_apoderado = $("#cedula_apo").val();

if( $nac_apo != ""){
    $("#nacionalidad").css({'border':'1px solid #f1f1f1'});
    if(cedula_apoderado == ""){
        $("#mensaje_error_apo").html("Ingrese una cédula").show();
        $("#cedula_apo").focus();
    }else if(cedula_apoderado == cedula_ciudadano){
        $("#mensaje_error_apo").html("El apoderado debe ser distinto al denunciante").show();
        $("#cedula_apo").focus();
    }
    else{
        $("#mensaje_error_apo").hide();
        $.ajax({
            dataType: "json",
            data: {"nac_apo": $nac_apo,"id_apo": $id_apo},
            url:   '../../../resources/select/buscar.php',
            type:  'post',
            beforeSend: function(){
                    //Lo que se hace antes de enviar el formulario
                    $("#cedula_apo").attr("disabled","disabled");
                    $("#cedula_apo").after('<img src="<?=$base_url?>public_html/imagenes/484_azul.GIF" id="cargando_apo" style="display:inline; margin-left:160px; margin-top:-50px; width:30px; ">');
                    $("#nombre_apo").val("").attr('readonly','readonly');
                    $("#apellido_apo").val("").attr('readonly','readonly');
                },
                success: function(respuesta){
                    //lo que se si el destino devuelve algo
                    if(respuesta.nombre != false){
                        $("#cargando_apo").remove();
                        $("#nombre_apo").val(respuesta.nombre);
                        $("#apellido_apo").val(respuesta.apellido);
                        $("#cedula_apo").removeAttr("disabled");
                    }
                    else{
                        $("#cargando_apo").remove();
                        $("#cedula_apo").val('').removeAttr('disabled');
                        $("#mensaje_error_apo1").html('La cédula ingresada no se encuentra registrada').show();
                        //$("#cedula_apo").focus();
                        $("#cedula_apo").on("focus",function(){
                            $("#mensaje_error_apo1").hide();
                        });
                    }

                },
                error:  function(xhr,err){ 
                    alert("readyState: "+xhr.readyState+"\nstatus: "+xhr.status+"\n \n responseText: "+xhr.responseText);
                }
            });/*Ajax*/
}//else ajax

}/*Else */else{
    $("#nacionalidad").css({'border':'1px solid red'});
    $("#mensaje_error_nac").html('Seleccione nacionalidad').show();
}
/**************************************************************************************************************/     
}/*Fin funcion buscar ciudadano*/

$("#nacionalidad").on("change",function(){
    if( $(this).val() !='' ){
        $("#nacionalidad").css({'border':'1px solid #f1f1f1'});
        $("#mensaje_error_nac").hide();
    }

});


/**************************************************************************************************************/
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
    if($municipio == "")
    {
        $("#localidad").html("<option value=''>seleccione</option>");
    }
    else
    {
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
    if($municipio == "")
    {
        $("#localidad2").html("<option value=''>seleccione</option>");
    }
    else
    {
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

function buscarCodigo(){
    $codigo = $("#estado").val();
    if($codigo == '')
    {
        return 0;
    }
    else{
        $.ajax({
            dataType: "json",
            data: {"codigo": $codigo},
            url:   '../../../resources/select/buscar.php',
            type:  'post',
            beforeSend: function(){
                    //Lo que se hace antes de enviar el formulario
                },
                success: function(respuesta){
                    //lo que se hace si el destino devuelve algo
                    $("#codigo_fijo").html(respuesta.html);
                },
                error:  function(xhr,err){ 
                    alert("readyState: "+xhr.readyState+"\nstatus: "+xhr.status+"\n \n responseText: "+xhr.responseText);
                }
            });
    }
}
function regresar()
{
    var pagina = '../denuncias.php';
    location.href=pagina
}
</script>

<script>

    $(document).on("ready",function(){
       // var num_checks = $(".check_docs").length;
       $("#mas_file").on("click",function(e){
        e.preventDefault();
        var num_checks = $(".check_docs:checked").length;	
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
