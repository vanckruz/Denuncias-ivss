<form name="actualiza" id="actualiza" method="post" action="../Controllers/Controller.Denuncia.php" >
<input type="hidden" name="option" value="update" form="actualiza"/>
<input type="hidden" name="nacionalidad" value="<?=$nacionalidad?>" form="actualiza"/>
<input type="hidden" name="id" value="<?=$id?>" form="actualiza"/>
<input type="hidden" name="numero" value="<?=$numero?>" form="actualiza"/>
<input type="hidden" name="cedula" value="<?=$cedula?>" form="actualiza"/>
<input type="hidden" name="fecha" value="<?=$fecha?>" form="actualiza"/>
<table class="datos">
    <tr>
        <td><label for="id">ID</label></td>
        <td><input type="text" form="actualiza" name="id" value="<?=$id?>" disabled/></td>
    </tr>
        
    <tr>
        <td><label for="numero">Número Denuncia</label></td>
        <td><input type="text" form="actualiza" name="numero" value="<?=$numero?>" disabled/></td>
    </tr>
    
    <tr>
        <td><label for="cedula">Cédula</label></td>
        <td><input type="text" name="cedula" form="atualiza" value="<?=$nacionalidad.' - '.$cedula?>" disabled/></td>         
    </tr>
    <tr>
        <td><label for="fecha">Fecha</label></td>
        <td><input type="text" form="actualiza" value="<?=$fecha?>" disabled/></td>
    </tr>
        
    <tr>
        <td><label for="motivo">Motivo</label></td>
        <td><input type="text" name="motivo" id="motivo" form="actualiza" value="<?=$motivo?>"/></td>
        <td>
            <select name="motivo" id="motivo" onChange="upEstatus();">
                <option value="">En proceso</option>
                <option value="">Procedente</option>
                <option value="">Improcedente</option>
            </select>
        </td>
    </tr>
    <tr>
        <td><label for="estatus">Estatus</label></td>
        <td><input type="text" value="<?=$estatus?>" name="estatus" id="estatus" form="actualiza"></td>
        <td>
            <select name="cambiaestatus" id="cambiaestatus" onChange="upEstatus();">
                <option value="x" selected>Seleccione</option>
                <option value="0">En proceso</option>
                <option value="1">Procedente</option>
                <option value="-1">Improcedente</option>
            </select>
        </td>
    </tr>
        
</table>
</form>
    <div class="foot">
        <input type="button" class="boton" value="Cancelar" onClick="volver();">
        <input type="submit" class="boton" id="actualizar" value="Actualizar" form="actualiza">
    </div>
    
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