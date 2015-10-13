// JavaScript Document
$(document).ready(function(e){
	//Abrir ventana
	$("#open, #editar, #eliminar").click(function(){
		$("#popup").fadeIn("slow");
		//$('body').css('opacity', '0.5');
		return false;
	});
	
	//Cerrar ventana
	$("#close").click(function(e){
		$("#form_consultar").empty();
		$("#popup").fadeOut('slow');
		//$("#consultar").reset();
		//$('body').css('opacity', '1');
		return false;
	});
});