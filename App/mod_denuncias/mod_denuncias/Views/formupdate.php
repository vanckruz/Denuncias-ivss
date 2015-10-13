<?php
	require('../../../resources/restrictedaccess.php');
        include("../../config/config.php");
?>
        <form action="Controllers/Controller.Denuncia.php" method="post" name="formupdate" id="formupdate" class="form-inline">
        	<span class="tituloform">Consultar Ciudadano</span>
            <fieldset class="fieldset">
            	<input type="hidden" name="option" value="actualizar" id="option"/>
            	<!--<legend>Consultar Ciudadano</legend>-->
                <label for="nacionalidad" id="nac" class="buscar">Cédula</label>
                	<select id="nacionalidad" name="nacionalidad" onchange = "mostrar();" required>
                		<option value="" selected name="opcdef"></option>
                		<option value="V">V</option>
                    	<option value="E">E</option>
                        <option value="T">T</option>
                	</select>
                
                	<input type ="text" name="cedula" id="cedula" class="form-control registrar" placeholder="Ingrese cédula aquí" maxlength="10" required>
            
                <div class="elementoform">
                	<input type="submit" id="boton_consulta" class="btn btn-default" value="Consultar">
                	<a href="denuncias.php"><input type="button" class="btn btn-default" id="boton_consulta" value="Cancelar"></a>
                </div>
                <div id="mostrar"></div>
			</fieldset>
            <script type="text/javascript" src="<?=$base_url;?>public_html/js/valida_login.js"></script>
		</form> 