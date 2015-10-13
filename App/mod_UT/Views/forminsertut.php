<?php
	require('../../../resources/restrictedaccess.php');
	$meses= array(1=>'Enero', 2=>'Febrero', 3=>'Marzo', 4=>'Abril', 5=>'Mayo', 6=>'Junio', 7=>'Julio', 8=>'Agosto', 9=>'Septiembre',
	              10=>'Octubre', 11=>'Noviembre', 12=>'Diciembre');
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="../../public_html/css/bootstrap/css/bootstrap.min.css" rel="stylesheet"/>
    <link href="../../public_html/vendor/jquery-ui/jquery-ui.min.css" rel="stylesheet" type="text/css">
    <link href="../../public_html/vendor/jquery-ui/jquery-ui.theme.min.css" rel="stylesheet" type="text/css">
    <link href="../../public_html/vendor/jquery-ui/jquery-ui.structure.min.css" rel="stylesheet" type="text/css">
    <title></title>
    
</head>
<body>
	<h3>Registrar Unidad Tributaria</h3>
    <form action="Controllers/controller.UT.php" method="post" name="forminsert" id="forminsert">
        	<fieldset class="fieldset">
            	<input type="hidden" name="option" value="insertar" id="option"/>
            	
                <span class="tituloform">Fecha de vigencia</span>
                <p>Desde <input type="text" id="datepicker1" name="" value=""/></p>
                <p>Hasta <input type="text" id="datepicker2" name="" value=""/></p>

                <!--
                <div class="elementoform">
                    <p>Desde<input type="text" id="datepicker"/></p>
               	</div>
                
                <div class="elementoform">
                    <p>Hasta<input data-provide="datepicker"></p>
         		</div>
                -->
                <span class="tituloform">Valor de la Unidad Tributaria</span>
                
                <div class="ut">
                <!--<label for="valor" class="labelagregar">Valor</label>-->
                <input type="text" name="valor" id="valor" class="form-control inputagregar" maxlength="10" placeholder="ej: 127.00" required>
                </div>
                
                <div class="ut">
                <input type="submit" class="boton" value="Registrar">
                <a href=""><input type="button" class="boton" value="Cancelar"></a>
                </div>
                
                <div id="mostrar"></div>
                
			</fieldset>
		</form>
        <script type="text/javascript" src="../../public_html/js/jquery-2.1.4.min.js"></script>
        <script type="text/javascript" src="../../public_html/js/bootstrap/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="../../public_html/vendor/jquery-ui/jquery-ui.min.js"></script>
        <script type="text/javascript">
            $(function() {
                $.datepicker1.setDefaults($.datepicker1.regional["es"]);
                $.datepicker2.setDefaults($.datepicker2.regional["es"]);
                $( "#datepicker1, #datepicker2" ).datepicker({
                    changeMonth: true,
                    changeYear: true
                });
            });
  </script>
    </body>
</html>

