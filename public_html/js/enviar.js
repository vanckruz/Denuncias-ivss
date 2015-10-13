// JavaScript Document

$(document).ready(function() {
	
	$(".detailsden").each(function(e){
		$(this).click(function(){
			var id = $(this).attr('id');
		  var option = 'details';//$(this).attr('value');
		  $("#option").attr('value', option);
		  $("#id").attr('value', id);
		  $("#details").submit();
		});
	});

	$(".detailsdenjuridico").each(function(e){
		$(this).click(function(){
			var id = $(this).attr('id');
		  var option = 'details_juridicos';//$(this).attr('value');
		  $("#option").attr('value', option);
		  $("#id").attr('value', id);
		  $("#details").submit();
		});
	});
	
	$(".updateden").each(function(e){
		$(this).click(function(){
			var id = $(this).attr('id');
			var option = 'editar';
			$("#option").attr('value', option);
			$("#id").attr('value', id);
			$("#details").submit();
		});
	});

	$(".procesar").each(function(e){
		$(this).click(function(){
			var id = $(this).attr('id');
			var option = 'editar';
			$("#option").attr('value', option);
			$("#id").attr('value', id);
			$("#procesar").submit();
		});
	});

	$(".procesar_juridico").each(function(e){
		$(this).click(function(){
			var id = $(this).attr('id');
			var option = 'editarjuridico';
			$("#option").attr('value', option);
			$("#id").attr('value', id);
			$("#procesar").submit();
		});
	});

	$(".updatedenjuridico").each(function(e){
		$(this).click(function(){
			var id = $(this).attr('id');
			var option = 'editarjuridico';
			$("#option").attr('value', option);
			$("#id").attr('value', id);
			$("#details").submit();
		});
	});

	/************GESTION DE DOCUMENTOS QUEJAS*************/
	$(".editdocqueja").each(function(e){
		$(this).click(function(){
			var id = $(this).attr('id');
		  var option = 'details';//$(this).attr('value');
		  $("#option").attr('value', option);
		  $("#id").attr('value', id);
		  $("#details").submit();
		});
	});

	$(".adddocqueja").each(function(e){
		$(this).click(function(){
			var id = $(this).attr('id');
		  var option = 'details';//$(this).attr('value');
		  $("#option").attr('value', option);
		  $("#id").attr('value', id);
		  $("#details").submit();
		});
	});

	
	/******************************************************/

	/************GESTION DE MOTIVOS QUEJAS*************/
	//Editar
	$(".edit_mot_queja").each(function(e){
		e.preventDefault();
		$(this).click(function(){
			var id = $(this).attr('id');
		  var option = 'editar';//$(this).attr('value');
		  $("#opcion").attr('value', option);
		  $("#id").attr('value', id);
		  $("#form_motivo_queja").submit();
		});
	});

	$("#add_motivo_queja").on("click",function(e){
		e.preventDefault();
		var id = $(this).attr('id');
		  var option = 'registrar';//$(this).attr('value');
		  $("#option").attr('value', option);
		  $("#id").attr('value', id);
		  $("#form_motivo_queja").submit();
		});
	/******************************************************/

	/************GESTION DE USUARIOS*************/
	//Editar
	$(".edit_user").each(function(e){
		/*e.preventDefault();*/	
		$(this).click(function(){
			var id = $(this).attr('id');
		  var option = 'edituser';//$(this).attr('value');
		  $("#option").attr('value', option);
		  $("#id").attr('value', id);
		  $("#details").submit();
		});
	});
	/******************************************************/

	/*
	$(".deleteden").each(function(e){
	  $(this).click(function(){
		  accion = confirm("Está a punto de eliminar la denuncia. Esta acción no se puede revertir");
		  if(accion)
		  {
		  	var value = $(this).attr('id');
		  	var action = "<input type='hidden' id='action' name='id' value='"+value+"' form='delete'/>";  
		  	$("#delete").before(action);
		  	$("#delete").submit();
		  }
    	});
	});
	
	$(".detailsden").each(function(e){
	  $(this).click(function(){
	  	var value = $(this).attr('id');
   	  	$("#value").attr('value',value);
		//var action = "<input type='hidden' id='action' name='id' value='"+value+"' form='details'/>";  
		//$("#details").before(action);
		$("#details").submit();
    	});
	});
	
	$("span.updateut").each(function(e){
	  $(this).click(function(){
		  var value = $(this).attr('id');
		  var action = "<input type='hidden' id='action' name ='id' value='"+value+"' form='preupdate'/>";  
		  $("#preupdate").before(action);
		  $("#preupdate").submit();
    	});
	});
	
	$("span.deleteut").each(function(e){
	  $(this).click(function(){
		  accion = confirm("Está a punto de eliminar la Unidad Tributaria. Esta acción no se puede revertir");
		  if(accion)
		  {
		  	var value = $(this).attr('id');
		  	var action = "<input type='hidden' id='action' name ='id' value='"+value+"' form='delete'/>";  
		  	$("#delete").before(action);
		  	$("#delete").submit();
		  }
    	});
	});
	
	
	$("span.deleteemp").each(function(e){
	  $(this).click(function(){
		  accion = confirm("Está a punto de eliminar el registro seleccionado. Esta acción no se puede revertir");
		  if(accion)
		  {
		  	var value = $(this).attr('id');
		  	var action = "<input type='hidden' id='action' name ='id' value='"+value+"' form='delete'/>";  
		  	$("#delete").before(action);
		  	$("#delete").submit();
		  }
    	});
	});
	
	$("span.updateemp").each(function(e){
	  $(this).click(function(){
		  var value = $(this).attr('id');
		  var action = "<input type='hidden' id='action' name ='id' value='"+value+"' form='preupdate'/>";  
		  $("#preupdate").before(action);
		  $("#preupdate").submit();
    	});
	});
	
	/*$("#update").submit(function(e) {
        e.preventDefault();
		e.stopPropagation();
		$(".enviar").click(function(e) {
		  var value = $(this).attr('id');
		  var action = "<input type='hidden' id='action' name ='id' value='"+value+"' form='preupd'/>";  
		  $("#update").before(action);
		  $("#update").submit();
			//$("#mostrar").html("<h3>Ha echo Click</h3>");
			//$("#mostrar").html(id);
		});
	});
*/
});