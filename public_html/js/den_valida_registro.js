// JavaScript Document
$(document).ready(function() 
{
	$('#registrar').on(Click, function(e)
	{
		/* Act on the event */
		e.preventDefault();
		//VALIDAR CAMPOS SELECCIONADOS
		if($('#estatus').val() == '-1'){
			alert(Debe seleccionar el estatus);
		}
		if($('#documentos').is(':checked'))
		{
    		$("#registrar").submit();
		}
		else
		{
			alert("Seleccione al menos un documento");
		}
			
	});
}