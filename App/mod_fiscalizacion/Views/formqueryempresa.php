<?php
	require('../../../resources/restrictedaccess.php');
?>
        <form action="Controllers/controller.Fiscalizacion.php" method="post" name="formqueryempresa" id="formqueryempresa">
        	<input type="hidden" name="operacion" value="fiscalizar" />
        	<fieldset class="fieldset" style="margin-top:0px;border-radius:0px;background:#3B5998;margin-top:70px;">
            	<input type="hidden" name="option" value="select" id="option" form="formqueryempresa"/>
                <input type="hidden" name="fuente" value="fiscalizacion" id="fuente"/>
            		<h3  style="color:white;margin:auto;margin-bottom:0px;">Consultar empresa a Fiscalizar</h3>
                    <hr>
                	<select id="opciones" name="opciones" onchange = "mostrar();" form="formqueryempresa" style="cursor:pointer;">
                		<option value="default" selected="selected" name="opcdef">Seleccione</option>
                		<option value="numero_patronal">N° Patronal</option>
                    	<option value="rif">Rif</option>
                    	<option value="nombre_empresa">Nombre</option>
                	</select>
                <div id="mostrar">
                <input type="text" id="npat" name="npat" style="display:none; margin:5px auto;" placeholder="Ingrese Número patronal"required/>
                <input type="text" id="rif" name="rif" style="display:none; margin:5px auto;" placeholder="Ingrese Rif"required/>
                <input type="text" id="nombre" name="nombre" style="display:none; margin:5px auto;" placeholder="Ingrese Nombre"required/>
               <input type="submit" value="Consultar" id="consultar" style="display:none;" class="btn btn-default" />
               <a href=""><input type="button" class="btn btn-default" value="Cancelar" id="cancelar"></a>
                </div>
			</fieldset>
       </form>
         