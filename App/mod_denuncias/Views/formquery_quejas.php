<?php
require('../../../resources/orcl_conex.php'); 
require('../../../resources/select/funciones.php');
include("../../config/config.php");

$quejas = dameQuejas();
    /*echo "<pre>";
    print_r($quejas);
    echo "</pre>";*/
    ?>
    <!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <style type="text/css" media="screen">
        #tabla_juridica_length label, #tabla_juridica_filter label{
            color: #555;
        }
        #tabla_juridica_length select, #tabla_juridica_filter input{
            color:#555;
            border:1px solid gray;
        }

        #tabla_quejas_length label, #tabla_quejas_filter label{
            color: #555;
            font-size: 0.8em;
        }
        #tabla_quejas_length select, #tabla_quejas_filter input{
            color:#555;
            border:1px solid gray;
        }

        .thead_font{
            font-size:0.8em;
            color: #111;
            font-weight:bold;
        }

    </style>
    <body>
        <form name='details' id='details' action='Controllers/Controller.Denuncia.php' method='post'>
            <input type="hidden" name="id" value="" id="id" />
            <input type="hidden" name="option" value="" id="option" />
        </form>
<?php /*
<div style="width:100%;padding:12px;text-align:center;font-size:1.5em;color:white;background:#234181 linear-gradient(#639ACA, #6095C4 20%, #3368A0 60%, #234181 100%) repeat scroll 0% 0%;">
    Listado de Quejas
</div>
*/?>
<?php /* ?>
<div id="consulta_queja">
    <p>Seleccione un criterio de búsqueda</p>
    <select name="criterio">
        <option value="">Fecha</option>
        <option value="">Estatus</option>
        <option value=""></option>
        <option value=""></option>
    </select>
</div>
*/
?>
<div id="panel_quejas" style="width:100%;height:100%;padding:25px;background:#f1f1f1;margin-bottom:100px;">
    <table id="tabla_quejas" class="table table-hover">
        <thead  class="thead_font">
            <tr>
                <td>ID Quejas y/o Reclamos</td>
                <td>Denunciante</td>
                <td>Estatus</td>   
                <td>Detalles</td>          
                <td>Procesar</td>
            </tr>
        </thead>
        <tbody>
            <?php if(empty($quejas)){echo "";}else { foreach ($quejas as $key) { ?>
            <tr data-nacionalidad="" data-cedula="">    
                <td><?php echo  $key["ID_DENUNCIA"]; ?></td>
                <td><?php echo  $key["ID_EMPRESA"]; ?></td>
                <td><?php switch ($key["ESTATUS_DENUNCIA"]) {
                    case '0':
                    echo "Procedente";
                    break;
                    case '1':
                    echo "No procedente";
                    break;
                    case '2':
                    echo "Cerrada";
                    break;
                }?></td>
                <td><button class="btn btn-primary detailsdenjuridico" id="<?=$key["ID_DENUNCIA"]?>" title="Detalles" ><span class="glyphicon glyphicon-search"></span></button></td>
                <td><?php if($key["ESTATUS_DENUNCIA"]==0) {?><button class="btn btn-primary updatedenjuridico" id="<?=$key["ID_DENUNCIA"]?>" title="Procesar" ><span class="glyphicon glyphicon-pencil"></span></button><?php } ?></td>
            </tr>
            <?php } }?>
        </tbody>

        <tfoot style="display:none;">
            <tr>
                <td>ID Quejas y/o Reclamos</td>
                <td>Denunciante</td>
                <td>Detalles</td>          
                <td>Editar</td>   
            </tr>
        </tfoot>
    </table>
    <?php  /*
    <button class="btn btn-primary" style="cursor:pointer;border-radius:2px;font-size:1.3em;padding:5px;color:white;width:100px;margin:auto;" onClick="location.reload()">
        <span class="glyphicon glyphicon-arrow-left"></span> Volver
    </button>

    <button class="btn btn-primary" style="cursor:pointer;border-radius:2px;font-size:1.3em;padding:5px;color:white;width:200px;margin:auto;" onclick="menuprincipal()">
        <span class="glyphicon glyphicon-home"></span> Menu principal
    </button>
    */?>
</div>
<!--Panel Quejas-->
<div id="mensajerror1" style="display:none;position:fixed;z-index:100000;background:rgba(0,0,0,0.8);width:100%;height:100%;top:0;left:0;">
    <div id="error1" title="Mensaje" style="display:none;z-index: 10000;width:600px;hight:300px;margin:auto;margin-top:100px;background:rgba(255,255,255,0.8);" >
        <div id="titulo_error1" style="background:#234181 linear-gradient(#639ACA, #6095C4 20%, #3368A0 60%, #234181 100%) repeat scroll 0% 0%;color:white;padding:10px;margin:auto;font-size:1.4em; ">
            Mensaje
            <div style="width:21px;float:right;cursor:pointer;" title="Cerrar mensaje" id="cerrar_error1">
                <span class="glyphicon glyphicon-remove"></span>
            </div>
        </div>                                     
        <div class="mensaje" style="padding:25px 25px 25px 25px;font-size:1.3em;">
            ¡ Por favor ingrese un valor válido en el campo de cédula !
        </div>
    </div>
</div>

<div id="mensajerror2" style="display:none;position:fixed;z-index:100000;background:rgba(0,0,0,0.8);width:100%;height:100%;top:0;left:0;">
    <div id="error2" title="Mensaje" style="display:none;z-index: 10000;width:600px;hight:300px;margin:auto;margin-top:100px;background:rgba(255,255,255,0.8);" >
        <div id="titulo_error2" style="background:#234181 linear-gradient(#639ACA, #6095C4 20%, #3368A0 60%, #234181 100%) repeat scroll 0% 0%;color:white;padding:10px;margin:auto;font-size:1.4em; ">
            Mensaje
            <div style="width:21px;float:right;cursor:pointer;" title="Cerrar mensaje" id="cerrar_error2">
                <span class="glyphicon glyphicon-remove"></span>
            </div>
        </div>                                     
        <div class="mensaje" style="padding:25px 25px 25px 25px;font-size:1.3em;">
            ¡ Por favor ingrese un valor válido en el campo!
        </div>
    </div>
</div>    

<div id="mensaje_empresa" style="display:none;">
    <div id="empresa_rel">

    </div>
</div>              
<!--Scripts-->
<link rel="stylesheet" href="<?=$base_url;?>public_html/vendor/DataTables/media/css/jquery.dataTables.css">
<script type="text/javascript" src="<?=$base_url;?>public_html/vendor/DataTables/media/js/jquery.dataTables.js"></script>      
<script type="text/javascript" src="<?=$base_url;?>public_html/js/valida_login.js"></script>
<script type="text/javascript" src="<?=$base_url;?>public_html/js/enviar.js"></script>
<script>
    $(document).ready(function()
    {

        $("#tabla_quejas").dataTable();
        $("#pernat").click(function(){
            $("#persona").css('display', 'block');
            $("#empresa").css('display', 'none');
            $("#cedula").attr('required','true');
            $("#valor").removeAttr('required');
            $("#botones_perjur").css('display', 'none');
            $("#botones_pernat").css('display', 'block');         
        });

        $("#perjur").click(function()
        {
            $("#persona").css('display', 'none');
            $("#empresa").css('display', 'block');
            $("#valor").attr('required','true');
            $("#cedula").removeAttr('required');
            $("#botones_pernat").css('display', 'none');
            $("#botones_perjur").css('display', 'block');

        });

        $("#opciones_empresa").on('change', function(){
            var mensaje = "Ingrese ";
            var opcion = $("#opciones").val();
            if(opcion == 'id_empresa')
            {
                mensaje += "N° Patronal";
                $("#valor").attr('maxlength', '9')
            }else if(opcion == 'rif'){
                mensaje += "Rif";
                $("#valor").attr('maxlength', '10')
            }else if(opcion == 'nombre_empresa'){
                mensaje += "Nombre";
                $("#valor").attr('maxlength', '100')
            }
            $("#valor").attr('placeholder', mensaje);
        });

        /*********************Boton Consultar persona natural**********************/
        $("#boton_consulta").click(function(e){
            e.preventDefault();

            if( $("#cedula").val() == '' ){
                $("#mensajerror1").fadeIn("slow");
                $("#error1").slideDown('slow');

                $("#cerrar_error1").click(function(){
                    $("#error1").slideUp('slow');
                    $("#mensajerror1").slideUp( "slow" );           
                });
            }else if($("#cedula").val() != '' ){
                $("#ciudadano").val('persona');
                $("#formquery").submit();


               }//Llave else if

           });//Llave FIN click boton consulta (persona natural).


//////////////////////////////////////////////////////////////////////////////
/*********************Boton Consultar persona jurídica**********************/
////////////////////////////////////////////////////////////////////////////
$("#boton_consulta_empresa").click(function(e)
{
    e.preventDefault();
    if( $("#valor").val() == '' ){
        $("#mensajerror2").fadeIn("slow");
        $("#error2").slideDown('slow');

        $("#cerrar_error2").click(function(){
            $("#error2").slideUp('slow');
            $("#mensajerror2").slideUp( "slow" );           
        });
    }else if($("#valor").val() != '' ){

        $("#ciudadano").val('empresa');
        $("#formquery").submit();

                    }//Llave else if

          });//Llave click boton consulta_empresa.
});
function enviarFormulario(){
    //e.preventDefault();
    $("#empresas_completas_ciu").val($("#mensaje_empresa #empresa_rel").html());
    $("#forminsert").submit();
}

function regresar()
{
    var pagina = "../denuncias.php";
    location:href(pagina);
}

function menuprincipal(){
    window.location.href='<?=$base_url;?>';
}
</script>
</body>
</html>     
