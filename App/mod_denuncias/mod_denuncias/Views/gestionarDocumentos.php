<style>

</style>

<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
include("../../../resources/orcl_conex.php");
include("../../../resources/select/funciones.php");
$documentos = getDocumentosQuejas();
?>
<!DOCTYPE html>
<html lang="ES">
<head>
    <meta charset="utf-8">
</head>
<body>
    <div style="height:950px;width:450px;">
        <table  class="table table-hover" style="margin:0% 0% 0% -14%;width:100%; background:transparent linear-gradient(#FFF, #DDE9F4) repeat scroll 0% 0%;">
            <tr>
             <td colspan="3" style="padding: 13px;font-size:1.2em;">Gestión de Documentos de Quejas/Reclamos</td>
         </tr>

         <tr>
            <td colspan="2" style="padding-left: 16px;"><input type="text" id="input_nuevo_documento" style="border: solid #AAD4FF 1px; border-radius: 5px 5px;width: 753px;height: 32px; padding-left: 10px; font-size: 16px;" title="Ingrese un Nuevo Documento" placeholder="Agregar Nuevo Documento" maxlength="200"></td>
            <td><button  id="add_documento_queja" class="btn btn-primary ingresar_documento_queja" style="float:right;" id="btn_agregar_motivos"><span class="glyphicon glyphicon-plus-sign"></span> Agregar</button></td>
        </tr>

        <tr>
            <th style="text-align:left;padding-left:25px;font-size:1em;">Descripción</th>
            <th style="text-align:left;padding-left:25px;font-size:1em;">Editar</th>
            <th style="text-align:left;padding-left:25px;font-size:1em;">Eliminar</th>
        </tr>
        <?
        foreach ($documentos as $documento) {
            echo "<tr>";
            echo "<td style='text-align:left;font-size:0.9em;'>".$documento["DESCRIPCION"]."</td>";
            echo "<td>";
            echo "<button id=".$documento["ID_DOCUMENTO"]."  class='btn btn-primary edit_doc_queja'data-nombre_documento='".str_replace(" ","-",$documento["DESCRIPCION"])."'data-id_documento='".str_replace(" ","-",$documento["ID_DOCUMENTO"])."'><span style='' class='glyphicon glyphicon-edit'></span></button>";
            echo "</td>";
            echo "<td>";
            echo "<button id=".$documento["ID_DOCUMENTO"]."  class='btn btn-danger eliminar_doc_queja' data-id_motivo='".str_replace(" ","-",$documento["ID_DOCUMENTO"])."'''><span style='' class='glyphicon glyphicon-remove-circle'></span></button>";
            echo "</td>";
            echo "</tr>";                  
        }          
        ?>
    </table>
        <?php /* ?>
        <button type="button" style="margin-left:-10px;" class="btn btn-default btn-volver" id="btn-volver" onclick="window.location.reload()">
            <span class="glyphicon glyphicon-arrow-left"></span> Volver
        </button>
        <button type="button" style="width: 157px;" class="btn btn-default btn-volver" id="btn-volver" onclick="location.href = 'http://desarrollofiscalizacion.ivss.int/App/sistemafiscal.php';">
            <span class="glyphicon glyphicon-home"></span> Menu Principal
        </button>
        */?>
    </div>
</body>

<!--Modal Agregar Documentos-->
<div id="agregar_motivo" style="display:none;width:100%;height:100%;position:fixed;z-index:10;top:0px;left:0px;z-index:50;overflow:hidden;">
    <div style="width:100%;margin-bottom:25px;background:#3B5998;color:white;padding:7px;">
        <h2 style="text-align:center;">Agregar Documentos</h2>        
    </div>  
    <div style="width:70%;margin:auto;height:200px;overflow:hidden;padding:25px;background:#f1f1f1;position:relative;">
        <form action="Controllers/Controller_Documentos_Denuncias.php" method="post" id="form_agregar_motivo">
            <p style="text-align:left;margin-bottom:12px;font-weight:bold;float:left;width:300px;">
                Descripción del documento:              
                <hr>
                <div style="width:100px;position:absolute;top:21px;right:10px;">
                    <button id="mas_user" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span></button>
                    <button id="menos_user" class="btn btn-danger"><span class="glyphicon glyphicon-minus"></span></button>         
                </div>
            </p>
            <input type="hidden" name="option" value="registrar">
            <div id="input_agregador_motivos" style="margin-top:35px">
                <p style='color:red;text-align:left;' id='mensaje_add_doc'></p>
                <input type="text" class="form-control inputivo input_agregar" style="border-radius:0px;" name="documento[]" id="motivos_p">                    
            </div>
            <hr>
            <div>
                <button class="btn btn-primary" id="submit_agregar"><span class="glyphicon glyphicon-floppy-disk"></span> Guardar</button>
                <button class="btn btn-danger" id="cerrar_agregar_motivo"><span class="glyphicon glyphicon-remove-circle"></span> Cancelar</button>
            </div>
        </form> 
    </div>
</div>
<!--Modal Agregar Motivo-->

<!--*************************************************** INGRESAR **********************************************-->
<div id="ingresar_documento" style="display:none;width:100%;height: 100%;position:fixed;z-index:10;top:0px;left:0px;overflow:hidden;">
    <div style="width:100%;margin-bottom:25px;repeat scroll 0% 0%;color:white;padding:26px;">
    </div>  
    <div style="width:49%;margin:auto; height: 30%;overflow:hidden;padding:25px;background:#f1f1f1;margin-top: 96px;">
        <form action="Controllers/Controller_Documentos_Quejas.php" method="post" id="form_documento_ingresar">
            <p style="text-align:left;margin-bottom:12px;font-weight:bold;font-size:0.9em;">¿Está seguro de agregar este nuevo documento de quejas?</p>
            <input type="hidden" class="form-control" style="border-radius:0px;" name="action" id="action" value="ingresar">
            <input type="hidden" class="form-control" style="border-radius:0px;" name="input_descripcion_ingreso" id="input_descripcion_ingreso">
            <hr>
            <div>
                <button class="btn btn-primary" id="submit_ingresar" title="Ingresar Motivo"><span class="glyphicon glyphicon-ok"></span> Aceptar</button>
                <button class="btn btn-danger" id="cerrar_ingresar_motivo" title="Cancelar"><span class="glyphicon glyphicon-remove-circle"></span> Cancelar</button>
            </div>
        </form>
    </div>
</div>
<!--*************************************************** INGRESAR **********************************************-->
<!--**************************************************** EDITAR ***********************************************-->
<div id="editar_motivo" style="display:none;width:100%;height: 100%;position:fixed;z-index:10;top:0px;left:0px;overflow:hidden;">
    <div style="width:100%;margin-bottom:25px;repeat scroll 0% 0%;color:white;padding:26px;"></div>  
    <div style="width:70%;margin:auto;  height:225px;overflow:hidden;padding:25px;background:#f1f1f1;margin-top: 96px;">
        <form action="Controllers/Controller_Documentos_Quejas.php" method="post" id="form_documento_editar">
            <p style="text-align:left;margin-bottom:12px;font-weight:bold;">Editar documento:</p>
            <input type="hidden" class="form-control" style="border-radius:0px;" name="action" id="action" value="editar">
            <input type="hidden" class="form-control" style="border-radius:0px;" name="id_documento" id="id_documento">
            <input type="text" class="form-control" style="border-radius:0px;" name="input_documento_edicion" id="input_documento_edicion">
            <hr>
            <div>
                <button class="btn btn-primary" id="submit_editar" title="Editar motivo"><span class="glyphicon glyphicon-floppy-disk"></span> Guardar</button>
                <button class="btn btn-danger" id="cerrar_edit_motivo" title="Cancelar"><span class="glyphicon glyphicon-remove-circle"></span> Cancelar</button>
            </div>
        </form>
    </div>
</div>
<!--**************************************************** EDITAR ***********************************************-->
<!--*************************************************** ELIMINAR **********************************************-->
<div id="eliminar_motivo" style="display:none;width:100%;height:100%;position:fixed;z-index:10;top:0px;left:0px;overflow:hidden;">
    <div style="width:100%;margin-bottom:25px;repeat scroll 0% 0%;color:white;padding:26px;">
    </div>  
    <div style="width: 41%;margin:auto;  height:225px;overflow:hidden;padding:25px;background:#f1f1f1;margin-top: 96px;">
        <form action="Controllers/Controller_Documentos_Quejas.php" method="post" id="form_documento_eliminacion">
            <p style="text-align:left;margin-bottom:12px;font-size:0.9em;font-weight:bold;text-align:center;">¿Desea eliminar este documento?</p>
            <input type="hidden" class="form-control" style="border-radius:0px;" name="action" id="action" value="eliminar">
            <input type="hidden" class="form-control" style="border-radius:0px;" name="input_id_eliminiacion" id="input_id_eliminiacion">

            <hr>
            <div>
                <button class="btn btn-danger" id="submit_eliminar" title="Eliminar motivo"><span class="glyphicon glyphicon-trash"></span> Eliminar</button>
                <button class="btn btn-default" id="cerrar_elim_motivo" title="Cancelar"><span class="glyphicon glyphicon-remove-circle"></span> Cancelar</button>
            </div>
        </form>
    </div>
</div>
<!--*************************************************** ELIMINAR **********************************************-->
<!--*************************************************** ALERTA **********************************************-->
<div id="alerta_ingreso" style="display:none;width:100%;height:100%;position:fixed;z-index:10;top:0px;left:0px;overflow:hidden;">
    <div style="width:100%;margin-bottom:25px;repeat scroll 0% 0%;color:white;padding:26px;">
    </div>  
    <div style="width: 44.2%;;margin:auto;overflow:hidden;padding:25px;background:#f1f1f1;margin-top: 96px;">
        <p style="text-align:left;margin-bottom:12px;font-weight:bold"> Debe rellenar el campo de descripción del documento.</p>       
        <hr>
        <div>
            <button class="btn btn-primary" id="cerrar_alert" title="Aceptar"><span class="glyphicon glyphicon-remove-circle"></span> Aceptar</button>
        </div>
    </div>
</div>
<!--*************************************************** ALERTA **********************************************-->
<script>

//-------------------------------------- INGRESAR ---------------------------------------------
$('.ingresar_documento_queja').on('click',function(e){
    if (document.getElementById('input_nuevo_documento').value != ""){
        e.preventDefault();
        var $this = $(this);
        $('#ingresar_documento').css({background:'rgba(0, 0, 0, 0.35)'});
        $('#ingresar_documento').fadeIn();        
        $("#input_descripcion_ingreso").val(document.getElementById('input_nuevo_documento').value);
        $("#submit_ingresar").on("click",function(a){
            a.preventDefault();
            $("#form_documento_ingresar").submit();
        });        
        $('#cerrar_ingresar_motivo').on("click",function(a){
            a.preventDefault();
            $('#ingresar_documento').fadeOut();
        });
    } else {
        $('#alerta_ingreso').css({background:'rgba(0, 0, 0, 0.35)'});
        $('#alerta_ingreso').fadeIn();
        $('#cerrar_alert').on("click",function(){
            $('#alerta_ingreso').fadeOut();
        });
    }
});
//-------------------------------------- INGRESAR ---------------------------------------------
//--------------------------------------- EDITAR ----------------------------------------------
$('.edit_doc_queja').on('click',function(e){
    e.preventDefault();
    var $this = $(this);
    $('#editar_motivo').css({background:'rgba(0, 0, 0, 0.35)'});
    $('#editar_motivo').fadeIn();
    $("#id_documento").val($this.attr("data-id_documento").replace(/-/g, " "));
    $("#input_documento_edicion").val($this.attr("data-nombre_documento").replace(/-/g, " "));
    $("#submit_editar").on("click",function(a){
        a.preventDefault();
        $("#form_documento_editar").submit();
    });
    $('#cerrar_edit_motivo').on("click",function(a){
        a.preventDefault();
        $('#editar_motivo').fadeOut();
    });
});
//--------------------------------------- EDITAR ----------------------------------------------
////-------------------------------------- ELIMINAR ---------------------------------------------
$('.eliminar_doc_queja').on('click',function(e){
    e.preventDefault();
    var $this = $(this);
    $('#eliminar_motivo').css({background:'rgba(0, 0, 0, 0.35)'});
    $('#eliminar_motivo').fadeIn();
    $("#input_id_eliminiacion").val($this.attr("data-id_motivo").replace(/-/g, " "));
    $("#submit_eliminar").on("click",function(a){
        a.preventDefault();
        $("#form_documento_eliminacion").submit();
    });
    $('#cerrar_elim_motivo').on("click",function(a){
        a.preventDefault();
        $('#eliminar_motivo').fadeOut();
    });
});

//-------------------------------------- ELIMINAR ---------------------------------------------  
</script>
</html>