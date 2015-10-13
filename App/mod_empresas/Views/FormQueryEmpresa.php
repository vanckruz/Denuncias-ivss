<?php
	require('../../../resources/restrictedaccess.php');
?>
	<h3>Consultar Empresa</h3>
        <form method="post" action="Controllers/controller.Empresa.php" name="formquery" id="formquery">
        	<fieldset class="fieldset">
            	<input type="hidden" name="option" value="consulta" id="option"/>
                <input type="hidden" name="fuente" value="empresa" id="fuente"/>
            	
            		<label for="busqueda" id="etq1" class="buscar">Seleccione una opción de busqueda</label>
                	<select id="opciones" name="opciones" onchange = "mostrar();">
                		<option value="default" selected="selected" name="opcdef">Seleccione</option>
                		<option value="id_empresa">N° Patronal</option>
                    	<option value="rif">Rif</option>
                    	<option value="nombre_empresa">Nombre</option>
                	</select>
                <div id="mostrar">
                <input type="text" id="npat" name="valor" style="display:none; margin:5px auto;" placeholder="Ingrese Número patronal"required/>
                <input type="text" id="rif" name="valor" style="display:none; margin:5px auto;" placeholder="Ingrese Rif"required/>
                <input type="text" id="nombre" name="valor" style="display:none; margin:5px auto;" placeholder="Ingrese Nombre"required/>
                <a href=""><input type="button" class="boton" value="Cancelar" id="cancelar"></a>
               <input type="submit" value="Consultar" id="consultar" style="display:none;" />
                </div>
			</fieldset>
       </form>
         