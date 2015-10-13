<?php 
    require('../../../resources/restrictedaccess.php');
      include("../../config/config.php");
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title></title>
        <!--<link href="../../public_html/css/formularios.css" rel="stylesheet"/>-->
    </head>
    <body>
        <form action="../../controllers/controller.Denuncia.php" method="post" name="formselect" id="formselect" class="form-inline">
        	<fieldset class="fieldset">
            	<input type="hidden" name="option" value="select" id="option"/>
                <input type="hidden" name="action" value="consultarden"/>
            	<legend>Consultar Ciudadano</legend>
                <label for="nacionalidad" id="nac" class="buscar">Cédula</label>
                	<select id="nacionalidad" name="nacionalidad" onchange = "mostrar();" required>
                		<option value="" selected name="opcdef"></option>
                		<option value="V">V</option>
                    	<option value="E">E</option>
                        <option value="T">T</option>
                	</select>
                <div class="elementoform">
                	<input type ="text" name="cedula" id="cedula" class="form-control registrar" placeholder="Ingrese cédula aquí" maxlength="10" required pattern="[0-9]{8,10}">
                </div>
                <div class="elementoform">
                	<input type="submit" id="boton_consulta" class="btn btn-default" value="Consultar">
                	<a href="denuncias.php"><input type="button" class="btn btn-default" id="boton_consulta" value="Cancelar"></a>
                </div>
                <div id="mostrar"></div> 
			</fieldset>
		</form>
    </body>
</html>