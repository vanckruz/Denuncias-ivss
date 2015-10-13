<div class="principal">
<section id="content">
    <h1>Denuncia - Actualizar</h1>
    <div id="wrapper">
        <section id="steps">
            <form name="actualiza" id="actualiza" method="post" action="../Controllers/Controller.Denuncia.php">
            	<input type="hidden" name="option" value="update" form="actualiza"/>
                <input type="hidden" name="id_den" value="<?=$id_den?>" form="actualiza"/>
                
                <!-- DATOS DENUNCIANTE -->
                <fieldset class="step">
                    <legend>Datos Denunciante</legend>
                    <table>
                        <tr>
                            <td class='sup etiqueta'><span class='reg_item'>Cédula</span></td>
                            <td class='sup'><span class='reg_item'><input type="text" value="<?=$nacper." - ". $cedper?>" disabled/></span></td>
                        </tr>
                        
                        <tr>
                        	<td class='sup etiqueta'><span class='reg_item'>Nombre</span></td>
                            <td class='sup'><span class='reg_item'><input type="text" name="nper" value="<?=$nomper?>" disabled/></span></td>
                        </tr>
                        
                        <tr>
                        	<td class='sup etiqueta'><span class='reg_item'>Apellido</span></td>
                            <td class='sup'><span class='reg_item'><input type="text" name="aper" value="<?=$apeper?>" disabled/></span></td>
                        </tr>
                        
                        <tr>
                        	<td class='sup etiqueta'><span class='reg_item'>Dirección</span></td>
                            <td class='sup'><span class='reg_item'><textarea rows="1" cols="1" name="dper" disabled><?=$dirper?></textarea></span></td>
                        </tr>
                        
                        <tr>
                            <td class='sup etiqueta'><span class='reg_item'>Telefono</span></td>
                            <td class='sup'><span class='reg_item' ><input type="text" name="tper" value="<?=$telper?>" disabled/></span></td>
                        </tr>
                    </table>
                    
                    <p class="nota">Nota: Necesita permisos de administrador para modificar estos datos. Contacte con el administrador del 
                    sistema para obtener permisos de Administrador.</p>
                    
                </fieldset>
                
                <fieldset class="step">
                    <legend>Datos Empresa</legend>
                    <table>
                        <tr>
                            <td class='sup etiqueta'><span class='reg_item'>N° Patronal</span></td>
                            <td class='sup'><span class='reg_item'><input type="text" name="npat" value="<?=$numpat?>"/></span></td>
                        </tr>
                        
                        <tr>
                        	<td class='sup etiqueta'><span class='reg_item'>RIF</span></td>
                            <td class='sup'><span class='reg_item'><input type="text" name="rif" value="<?=$rifemp?>"/></span></td>
                        </tr>
                        
                        <tr>
                        	<td class='sup etiqueta'><span class='reg_item'>Razón Social</span></td>
                            <td class='sup'><span class='reg_item'><input type="text" name="nemp"value="<?=$nomemp?>"/></span></td>
                        </tr>
                        
                        <tr>
                            <td class='sup etiqueta'><span class='reg_item'>Dirección</span></td>
                            <td class='sup'><span class='reg_item'><textarea name='demp'><?=$diremp?></textarea></span></td>
                        </tr>
                        
                        <tr>
                            <td class='sup etiqueta'><span class='reg_item'>Telefono</span></td>
                            <td class='sup'><span class='reg_item'><input type="text" name="temp" value="<?=$telemp?>" /></span></td>
                        </tr>
                    </table>
                </fieldset>
                <fieldset class="step">
                    <legend>Datos Denuncia</legend>
                    <table>
                        <tr>
                            <td class='sup etiqueta'><span class='reg_item'>N° Denuncia:</span></td>
                            <td class='sup'><span class='reg_item'><input type="text" name="nden" value="<?=$numden?>" /></span></td>
                        </tr>
                        
                        <tr>
                        	<td class='sup etiqueta'><span class='reg_item'>Fecha</span></td>
                            <td class='sup'><span class='reg_item'><input type="text" name="fden" value="<?=$fecden?>" /></span></td>
                        </tr>
                        
                        <tr>
                        	<td class='sup etiqueta'><span class='reg_item'>Motivo</span></td>
                            <td class='sup'><span class='reg_item'><textarea name="mden"><?=$motden?></textarea></span></td>
                        </tr>
                        
                        <tr>
                            <td class='sup etiqueta'><span class='reg_item'>Estatus</span></td>
                            <td class='sup'><span class='reg_item' ><input type="text" name="sden" value="<?=$stsden?>" /></span></td>
                        </tr>
                    </table>
                </fieldset>
                <fieldset class="step">
                    <legend>Documentos Consignados</legend>
                    <table>
                        <tr>
                            <td class='sup'><span class='reg_item'></span></td>
                        </tr>
                    </table>
                </fieldset>
                
            </form>
        </section>
        <section id="navigation" style="display:none;">
            <ul>
                <li class="selected">
                    <a href="#">Denunciante</a>
                </li>
                <li>
                    <a href="#">Empresa</a>
                </li>
                <li>
                    <a href="#">Denuncia</a>
                </li>
                <li>
                    <a href="#">Documentos</a>
                </li>
            </ul>
        </section>
    </div>
    <input type="button" class="boton" value="Cancelar" onClick="volver();"/>
    <input type="submit" class="boton" id="actualizar" value="Actualizar" form="actualiza">
    
    <script type='text/javascript'>
        function volver()
        {        
            history.back();
        }
        function upEstatus()
        {
            actual = document.getElementById('estatus').value;
            estatus = document.getElementById('cambiaestatus').value;
            if(estatus==0)
            nombre = 'En Proceso';
            else if(estatus==1)
            nombre = 'Procedente';
            else if(estatus == -1)
            nombre = 'Improcedente';
            else if(estatus =='x')
            nombre = actual;
            document.getElementById('estatus').value = nombre;
            
        }
        
    </script>
</section>
</div>