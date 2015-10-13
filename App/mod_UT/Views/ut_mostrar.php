<!doctype html>
<html lang="ES">
	<head>
    	<meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="../../../public_html/css/visualizerut.css"/>
        <link href="../../../resources/jquery.confirm/jquery.confirm/jquery.confirm.css" rel="stylesheet" />
    </head>
	<body>
    	<div class='principal mostrarut'>
			<section class='container'>
            <img class='imgsuperior' src='../../../public_html/imagenes/search.png'/>
            <h3>RESULTADOS DE LA BUSQUEDA</h3>
            <form name='details' id='details' action='Controller.UT.php' method='post'>
    		<input type="hidden" name="id" value="" id="id" />
    		<input type="hidden" name="option" value="" id="option" />
            <table class='registros'>
                <tr>
                    <!--<td class='sup'></td>-->
                    <td class='sup'><span class='reg_item'>INICIO</span></td>
                    <td class='sup'><span class='reg_item'>FIN</span></td>
                    <td class='sup'><span class='reg_item'>VALOR</span></td>
                    <td class='sup' colspan=3><span class='reg_item'>OPCIONES</span></td>
                </tr>
                
                <?php foreach($ut as $key){  
                    $inicio = $key->__GET('dinicio')."-".$key->__GET('minicio')."-".$key->__GET('yinicio');
                    $fin = $key->__GET('dfin')."-".$key->__GET('mfin')."-".$key->__GET('yfin');
                    $valor = $key->__GET('valor');
					
				?>
                    
               <tr>	
                  <td class='sup'><span class='reg_item'><?=$inicio?></span></td>
                  <td class='sup'><span class='reg_item'><?=$fin?></span></td>
                  <td class='sup'><span class='reg_item'><?=$valor." BsF"?></span></td>
               	  <td class='sup'><input type="submit" id="<?=$key->__GET('id_den')?>" value="Detalles" class='submit detailsden' /></td>
              	  <td class='sup'><input type="submit" id="<?=$key->__GET('id_den')?>" value="Editar" class='submit updateden' /></td>
              	  <td class='sup item'><input type="button" id="<?=$key->__GET('id_den')?>" value="Eliminar" class='submit eliminar'/></td>
               </tr>
               <?Php }?>
        	</table>
            <input type="button" class="boton" value="Aceptar" onClick="regresar();"/>
            </form>
            </section>
		</div>
        <script type="text/javascript" src="../../../public_html/js/jquery-2.1.4.min.js"></script>
        <script type="text/javascript" src="../../../public_html/js/enviar.js"></script>
        <script type="text/javascript" src="../../../resources/jquery.confirm/jquery.confirm/jquery.confirm.js"></script>
  		<script type="text/javascript" src="../../../resources/jquery.confirm/js/script.js"></script>
	</body>
</html>