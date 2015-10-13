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
        <form action="Controllers/Controller.Denuncia.php" method="post" name="formdelete" id="formdelete" class="form-inline">
        	<span class="tituloform">Consultar Ciudadano</span>
            <fieldset class="fieldset">
            	<input type="hidden" name="option" value="eliminar" id="option"/>
            	<!--<legend>Consultar Ciudadano</legend>-->
                <label for="nacionalidad" id="nac" class="buscar">Cédula</label>
                	<select id="nacionalidad" name="nacionalidad" required>
                		<option value="" selected="selected" name="opcdef"></option>
                		<option value="V">V</option>
                    	<option value="E">E</option>
                        <option value="T">T</option>
                	</select>
                	<input type ="text" id="cedula" name="cedula" class="form-control" placeholder="Ingrese cédula aquí" maxlength="10" required>
                <div class="elementoform">
                	<input type="submit" id="boton_consulta" class="btn btn-default" value="Consultar">
                	<a href="denuncias.php"><input type="button" id="boton_consulta" class="btn btn-default" value="Cancelar"></a>
                </div>

                <div id="mostrar"></div>
			</fieldset>
            <script type="text/javascript" src="<?=$base_url;?>public_html/js/valida_login.js"></script>
		</form>
    </body>
</html>