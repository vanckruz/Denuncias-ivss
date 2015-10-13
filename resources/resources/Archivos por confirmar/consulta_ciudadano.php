<?php
	 
?>
<!doctype html>
<html lang= "ES">
	<head>
		<meta charset="utf-8">
		<title>Consulta Ciudadano</title>
        <link rel="stylesheet" href="css/normalize.css">
        <link rel="stylesheet" href="css/styles.css">
        <script type="text/javascript" src="js/modernizr.custom.75139.js"></script>
        <link rel="shortcut icon" href="imagenes/logo.png" type="image/x-icon">
	</head>
	<body>
   		<div class="container">
   	  		<section id="consulta">
            	<div class="nac">
            		<h3>Consulta de Ciudadanos</h3>
                	<form method="post" action="mod_denuncias/consulta_denuncias.php">
                		<fieldset>
                			<legend>Ingrese sus datos a continuación</legend>
                            <div>
                            <label for="cedula">Cedula</label>
                            <select id="nac" class="nac" name="nac">
                        		<option>V</option>
                            	<option>E</option>
                        	</select>
                            </div>
                            <input type="number" name="cedula" placeholder="Ingrese su cedula" required>
                    		<input type="submit" value="Consultar">
                    		<input type="button" value="Cancelar" id="cancelar" onClick="regresar();">
               			</fieldset>
                	</form>
            	</div>
        </section>
    </div>
    <script type="text/javascript">
		function regresar()
		{
			history.back();	
		}
	</script>
</body>
    
</html>
