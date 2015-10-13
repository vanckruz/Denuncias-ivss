
<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
include("../../../resources/orcl_conex.php");
include("../../../resources/select/funciones.php");
require("../../config/config.php");
$motivos = dameMotivosQuejas();

//print_r($motivos);

?>
<html lang="ES">
<head>
 <meta charset="utf-8">
</head>
<body>
    <div style="height:950px;width:450px;margin-bottom:150px;">
       <!--<form id="form_motivo_queja" action="Controllers/Controller_Motivos_Quejas.php" method="POST">-->
       <table  class="table table-hover" style="margin:0% 0% 0% -14%;width:100%;background:transparent linear-gradient(#FFF, #DDE9F4) repeat scroll 0% 0%;">
        <tr>
         <td colspan="3" style="padding: 13px;font-size:1.2em;">Gestión de Motivos de Quejas/Reclamos</td>
     </tr>
     <tr>
         <td colspan="2" style="padding-left: 16px;"><input type="text" id="input_nuevo_motivo" style="border: solid #AAD4FF 1px; border-radius: 5px 5px;width: 753px;height: 32px; padding-left: 10px;font-size: 16px;" title="Ingrese un Nuevo Motivo" placeholder="Agregar Nuevo Motivo" maxlength="200"></td>
         <td><button  id="add_motivo_queja" class="btn btn-primary ingresar_motivo_queja" style="float:right;" id="btn_agregar_motivos" title="Ingresar Nuevo Motivo"><span class="glyphicon glyphicon-plus-sign"></span> Agregar</button></td>    				   
     </tr>
     <tr>
        <th style="text-align:left;padding-left:25px;font-size:1em;">Descripción</th>
        <th style="font-size:1em;">Editar</th>
        <th style="font-size:1em;">Eliminar</th>
    </tr>
    <?
    foreach ($motivos as $motivosdenuncias) {
        echo "<tr>";
        echo "<td style='width:100%;font-size:0.9em;text-align:left;font-size:0.9em;'>".$motivosdenuncias["DESCRIPCION"]."</td>";
        echo "<td>";
        echo "<button id=".$motivosdenuncias["ID_MOTIVO"]." title='Editar Motivo' class='btn btn-primary edit_mot_queja'data-nombre_motivo='".str_replace(" ","-",$motivosdenuncias["DESCRIPCION"])."'data-id_motivo='".str_replace(" ","-",$motivosdenuncias["ID_MOTIVO"])."'><span style=' margin-left: -6px;top: -2px;' class='glyphicon glyphicon-edit'></span></button>";
        echo "</td>";
        echo "<td>";
        echo "<button id=".$motivosdenuncias["ID_MOTIVO"]." title='Eliminar Motivo'  class='btn btn-danger eliminar_mot_queja' data-id_motivo='".str_replace(" ","-",$motivosdenuncias["ID_MOTIVO"])."''><span style=' margin-left: -6px;top: -1px;' class='glyphicon glyphicon-remove-circle'></span></button>";
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
                <!--</form>-->
            </div>
            <!--*************************************************** INGRESAR **********************************************-->
            <div id="ingresar_motivo" style="display:none;width:100%;height: 100%;position:fixed;z-index:10;top:0px;left:0px;overflow:hidden;">
                <div style="width:100%;margin-bottom:25px;repeat scroll 0% 0%;color:white;padding:26px;">
                </div>  
                <div style="width:45%;margin:auto;height:200px;overflow:hidden;padding:25px;background:#f1f1f1;margin-top: 96px;">
                    <form action="Controllers/Controller_Motivos_Quejas.php" method="post" id="form_motivo_queja_ingresar">
                        <p style="text-align:left;margin-bottom:12px;font-weight:bold;font-size:0.9em;text-align:center;">¿Desea agregar este nuevo motivo?</p>
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
                <div style="width:70%;margin:auto;  height:250px;overflow:hidden;padding:25px;background:#f1f1f1;margin-top: 96px;">
                    <form action="Controllers/Controller_Motivos_Quejas.php" method="post" id="form_motivo_queja_editar">
                        <p style="text-align:left;margin-bottom:12px;font-weight:bold;">Editar motivo:</p>
                        <input type="hidden" class="form-control" style="border-radius:0px;" name="action" id="action" value="editar">
                        <input type="hidden" class="form-control" style="border-radius:0px;" name="id_motivo" id="id_motivo">
                        <input type="text" class="form-control" style="border-radius:0px;" name="descripcion_motivo" id="input_motivo_edicion" maxlength="200">
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
            <div id="eliminar_motivo" style="display:none;width:100%;height: 100%;position:fixed;z-index:10;top:0px;left:0px;overflow:hidden;">
                <div style="width:100%;margin-bottom:25px;repeat scroll 0% 0%;color:white;padding:26px;">
                </div>  
                <div style="width:38%;margin:auto;height:200px;overflow:hidden;padding:25px;background:#f1f1f1;margin-top: 96px;">
                    <form action="Controllers/Controller_Motivos_Quejas.php" method="post" id="form_motivo_queja_eliminacion">
                        <p style="text-align:left;margin-bottom:12px;font-weight:bold;font-size:0.9em;text-align:center;">¿Desea eliminar este motivo?</p>
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
            <div id="alerta_ingreso" style="display:none;width:100%;height:100%;position:fixed;z-index:10;top:0px;left:0px;overflow:hidden;">
                <div style="width:100%;margin-bottom:25px;repeat scroll 0% 0%;color:white;padding:26px;">
                </div>  
                <div style="width:42%;margin:auto;height:200px;overflow:hidden;padding:25px;background:#f1f1f1;margin-top: 96px;">
                    <p style="text-align:left;margin-bottom:12px;font-weight:bold,font-size:0.9em;">Debe ingresar una descripción para el nuevo motivo</p>       
                    <hr>
                    <div>
                        <button class="btn btn-primary" id="cerrar_alert" title="Aceptar"><span class="glyphicon glyphicon-remove-circle"></span> Aceptar</button>
                    </div>
                </div>
            </div>
            <!--*************************************************** ALERTA **********************************************-->

            <div style="width:100%;height:150px;">

            </div>
        </body>
        <script>
//-------------------------------------- INGRESAR ---------------------------------------------
$('.ingresar_motivo_queja').on('click',function(e){
    if (document.getElementById('input_nuevo_motivo').value != ""){
        e.preventDefault();
        var $this = $(this);
        $('#ingresar_motivo').css({background:'rgba(0, 0, 0, 0.35)'});
        $('#ingresar_motivo').fadeIn();        
        $("#input_descripcion_ingreso").val(document.getElementById('input_nuevo_motivo').value);
        $("#submit_ingresar").on("click",function(a){
            a.preventDefault();
            $("#form_motivo_queja_ingresar").submit();
        });        
        $('#cerrar_ingresar_motivo').on("click",function(a){
            a.preventDefault();
            $('#ingresar_motivo').fadeOut();
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
$('.edit_mot_queja').on('click',function(e){
    e.preventDefault();
    var $this = $(this);
    $('#editar_motivo').css({background:'rgba(0, 0, 0, 0.35)'});
    $('#editar_motivo').fadeIn();
    $("#id_motivo").val($this.attr("data-id_motivo").replace(/-/g, " "));
    $("#input_motivo_edicion").val($this.attr("data-nombre_motivo").replace(/-/g, " "));
    $("#submit_editar").on("click",function(a){
        a.preventDefault();
        $("#form_motivo_queja_editar").submit();
    });
    $('#cerrar_edit_motivo').on("click",function(a){
        a.preventDefault();
        $('#editar_motivo').fadeOut();
    });
});
//--------------------------------------- EDITAR ----------------------------------------------
//-------------------------------------- ELIMINAR ---------------------------------------------
$('.eliminar_mot_queja').on('click',function(e){
    e.preventDefault();
    var $this = $(this);
    $('#eliminar_motivo').css({background:'rgba(0, 0, 0, 0.35)'});
    $('#eliminar_motivo').fadeIn();
    $("#input_id_eliminiacion").val($this.attr("data-id_motivo").replace(/-/g, " "));
    $("#submit_eliminar").on("click",function(a){
        a.preventDefault();
        $("#form_motivo_queja_eliminacion").submit();
    });
    $('#cerrar_elim_motivo').on("click",function(a){
        a.preventDefault();
        $('#eliminar_motivo').fadeOut();
    });
});
//-------------------------------------- ELIMINAR ---------------------------------------------  
</script>
</html>