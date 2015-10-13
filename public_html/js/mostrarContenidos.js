// JavaScript Document
function start()
{
	document.getElementById('consultar').addEventListener('click',mostrar,false);
	document.getElementById('registrar').addEventListener('click',mostrar,false);
	document.getElementById('eliminar').addEventListener('click',mostrar,false);
	document.getElementById('registraut').addEventListener('click',mostrar,false);
}

function mostrar()
{
	var contenido;
	var destino = document.getElementById('contenidos');
	var id=this.id;
	if(id=="consultar")
	{
		destino.innerHTML="";
		contenido="<h3>Consulta de Ciudadanos</h3><form method='post' action='consulta_denuncias.php'>";
		contenido+="<fieldset><legend>Ingrese sus datos a continuación</legend>";
		contenido+="<label for='cedula'>Cedula</label><select id='nac' class='nac' name='nac'>";
        contenido+="<option>V</option><option>E</option></select>";
        contenido+="<input pattern='[0-9]{5,}' name='cedula' id ='cedula' maxlength=\"10\" placeholder='Ingrese su cedula' required>";
        contenido+="<input type='submit' value='Consultar'>";
        contenido+="<input type='button' value='Cancelar' id='cancelar' onClick='regresar();'>";
        contenido+="</fieldset></form>";
		destino.innerHTML=contenido;
	}
	else if(id=="registrar")
	{
		destino.innerHTML="";
		contenido="<h3>Consulta de Ciudadanos</h3><form method='post' action='registro_denuncia.php'>";
		contenido+="<fieldset><legend>Ingrese sus datos a continuación</legend>";
		contenido+="<label for='cedula'>Cedula</label><select id='nac' class='nac' name='nac'>";
        contenido+="<option>V</option><option>E</option></select>";
        contenido+="<input pattern='[0-9]{5,}' name='cedula' id ='cedula' maxlength=\"10\" placeholder='Ingrese su cedula' required>";
        contenido+="<input type='submit' value='Consultar'>";
        contenido+="<input type='button' value='Cancelar' id='cancelar' onClick='regresar();'>";
        contenido+="</fieldset></form>";
		destino.innerHTML=contenido;
	}
	
	else if(id=="registraut")
	{
		destino.innerHTML="";
		contenido="<h3>REGISTRO DE UNIDAD TRIBUTARIA(UT)</h3><form method='post' action='../../resources/controllers/controller.UT.php'>";
		contenido+="<fieldset><legend>Datos UT</legend><input type='hidden' name='option' id='option' value='1'>";
		contenido+="<span>Fecha de vigencia</span>";
        contenido+="<label for='inicio'>Desde</label><input type='text' name='inicio' id ='inicio' maxlength=\"10\" placeholder='Ej:2015-03-31' required>";
		contenido+="<label for='fin'>Hasta</label><input type='text' name='fin' id ='fin' maxlength=\"10\" placeholder='Ej:2015-03-31' required>";
		contenido+="<span>Valor de la Unidad Tributaria</span><label for='valor'>Valor</label><input type='text' name='valor' id ='valor' maxlength=\"10\" placeholder='Ej:120.55' required>";
        contenido+="<input type='submit' value='Agregar'>";
        contenido+="<input type='button' value='Limpiar' id='limpiar'>";
        contenido+="</fieldset></form>";
		destino.innerHTML=contenido;
	}
	else if(id=="eliminar")
	{
		destino.innerHTML="";
		contenido="<h3>Consulta de Ciudadanos</h3><form method='post' action='eliminar_denuncias.php'>";
		contenido+="<fieldset><legend>Ingrese sus datos a continuación</legend>";
		contenido+="<label for='cedula'>Cedula</label><select id='nac' class='nac' name='nac'>";
        contenido+="<option>V</option><option>E</option></select>";
        contenido+="<input pattern='[0-9]{5,}' name='cedula' id ='cedula' maxlength=\"10\" placeholder='Ingrese su cedula' required>";
        contenido+="<input type='submit' value='Consultar' id='consultar'>";
        contenido+="<input type='button' value='Cancelar' id='cancelar' onClick='regresar();'>";
        contenido+="</fieldset></form>";
		destino.innerHTML=contenido;
	}
	else e.preventDefault();
}
window.addEventListener("load",start,false);