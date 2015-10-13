<?php
	require('../../../resources/restrictedaccess.php');
    $meses= array(1=>'Enero', 2=>'Febrero', 3=>'Marzo', 4=>'Abril', 5=>'Mayo', 6=>'Junio', 7=>'Julio', 8=>'Agosto', 9=>'Septiembre',
                  10=>'Octubre', 11=>'Noviembre', 12=>'Diciembre');
?>
	<h3>Consultar Unidad Tributaria</h3>
        <form action="Controllers/controller.UT.php" method="post" name="formquery" id="formquery">
        	<fieldset class="fieldset">
            	<input type="hidden" name="option" value="select" id="option" form="formquery"/>
                <input type="hidden" name="fuente" value="unidadt" id="fuente"/>
            		<label for="busqueda" id="etq1" class="buscar">Seleccione una opción de busqueda</label>
                	<select id="opciones" name="opciones" onchange = "mostrar();" form="formquery">
                		<option value="default" selected="selected" name="opcdef">Seleccione</option>
                		<option value="valor">Por valor</option>
                    	<option value="fecha">Por Fecha de Vigencia</option>
                    	<!--<option value="todo">Todo</option>-->
                	</select>
                <div id="mostrar">
                    <input type="text" id="inpval" name="valor" style="display:none" required/>
                    <select name="yinicio" id="yinicio" style="display:none;">
                        <option value="" selected>Año</option>
                        <?php
                            for($i=1950;$i<=date('Y');$i++)
                                echo '<option value="'.$i.'">'.$i.'</option>';
                        ?>
                    </select>

                    <select name="minicio" id="minicio" style="display:none;" onchange="cargarDias()">
                        <option value="" selected>Mes</option>
                        <?php
                        for($i=1;$i<=12;$i++)
                        {
                            echo '<option value="'.$i.'">'.$meses[$i].'</option>';
                        }
                    ?>
                    </select>

                    <select name="dias" id="dias" style="display:none;">
                        <option value="" selected>Seleccione</option>
                    </select>

                    <a href=""><input type="button" class="boton" value="Cancelar" id="cancelar"></a>
                    <input type="submit" value="Consultar" id="consultar" style="display:none" />
                </div>
			</fieldset>
       </form>
       <script type="text/javascript" src="../../../public_html/js/jquery-2.1.4.min.js"></script>
       <script type="text/javascript" charset="utf-8" async defer>
        function cargarDias(){
    $("#minicio").on("change", cargarDias);
    $year = $("#yinicio").val();
    $month = $("#minicio").val();
    if($year == "" || $month == ""){
            $("#dias").html("<option value=''>-Seleccione-</option>");
    }
    else {
        $.ajax({
            dataType: "json",
            data: {"year": $year,"month":$month},
            url:   '../../../resources/select/buscar.php',
            type:  'post',
            beforeSend: function(){
                //Lo que se hace antes de enviar el formulario
                },
            success: function(respuesta){
                //lo que se si el destino devuelve algo
                $("#dias").html(respuesta.html);
            },
            error:  function(xhr,err){ 
                alert("readyState: "+xhr.readyState+"\nstatus: "+xhr.status+"\n \n responseText: "+xhr.responseText);
            }
        });
    }
}   
       </script>
         