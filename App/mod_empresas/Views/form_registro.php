
<h3>Registrar Empresa</h3>
	<form method="post" name="form_registro" id="form_registro" action="../../Controllers/controller.Empresa.php">
    	<input type="hidden" name="option" value="registro"/>
        <fieldset class="fieldset">
            <div class="elementoform">
                <label for="rif">Rif</label>
                <input type="text" name="rif" id="rif" maxlength="10" placeholder="Ej: J12345678" title="Ingrese RIF de la Empresa" required/>
            </div>
            
            <div class="elementoform">
                <label for="npat">N° Patronal</label>
                <input type="text" name="npat" id="npat" maxlength="10" placeholder="Ej: D12345678" title="Ingrese N° Patronal aquí" required/>
            </div>
            
            <div class="elementoform">
                <label for="nombre">Nombre</label>
                <input type="text" name="nombre" id="nombre" maxlength="100" placeholder="Ingrese nombre de la empresa aquí" required/>
            </div>
            
            <div class="elementoform">
                <label for="direccion">Dirección</label>
                <input type="text" name="direccion" id="direccion" maxlength="100" placeholder="Ingrese dirección de la empresa aquí" required/>
            </div>
            
            <div class="elementoform">
                <label for="telefono">Telefono</label>
                <input type="text" name="telefono" id="telefono" maxlength="12" placeholder="Ingrese n° telefónico aquí" required/>
            </div>
           
            <div class="elementoform">
            	<input type="submit" value="Registrar"/>
                <input type="button" value="Cancelar"/>
            </div>
		</fieldset>
	</form>