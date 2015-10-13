$(document).ready(function(){
	$(".eliminar").each(function(e){
	$(this).click(function(){
		var id = $(this).attr('id');
		var option = 'delete';
		var elem = $(this).closest('.item');
		$.confirm({
			'title'		: 'Confirmar Eliminación',
			'message'	: 'Está a punto de borrar este registro. <br />Esta acción no se puede revertir!. &nbsp;&nbsp;Continuar? ',
			'buttons'	: {
				'SI'	: {
					'class'	: 'blue',
					'action':function()
					{
						$("#option").attr('value', option);
						$("#id").attr('value', id);
						$("#details").submit();
				   }
				},
				
			    'NO'	: {
				  'class'	: 'gray',
				  'action': function(){}	// Nothing to do in this case. You can as well omit the action property.
			  }
		  }
	  });
  });
});
///////////////////////////////////////////////////////////

$(".eliminar_mot_denuncia").each(function(e){
	
	$(this).click(function(){
		e.preventDefault();
		var id = $(this).attr('id');
		var option = 'eliminar';
		var elem = $(this).closest('.item');
		$.confirm({
			'title'		: 'Confirmar Eliminación',
			'message'	: 'Está a punto de borrar este registro. <br />Esta acción no se puede revertir!. &nbsp;&nbsp;Continuar? ',
			'buttons'	: {
				'SI'	: {
					'class'	: 'blue',
					'action':function()
					{
						
						$("#opcion").attr('value', option);
						$("#id").attr('value', id);
						//$("#form_mot_denuncias").submit();
						alert("click: "+ id);
				   }
				},
				
			    'NO'	: {
				  'class'	: 'gray',
				  'action': function(){}	// Nothing to do in this case. You can as well omit the action property.
			  }
		  }
	  });
  });
});

////////////////////////////////////////////////////////////////////////////


$(".eliminarjuridico").each(function(e){
	$(this).click(function(){
		var id = $(this).attr('id');
		var option = 'deletejuridico';
		var elem = $(this).closest('.item');
		$.confirm({
			'title'		: 'Confirmar Eliminación',
			'message'	: 'Está a punto de borrar este registro. <br />Esta acción no se puede revertir!. &nbsp;&nbsp;Continuar? ',
			'buttons'	: {
				'SI'	: {
					'class'	: 'blue',
					'action':function()
					{
						$("#option").attr('value', option);
						$("#id").attr('value', id);
						$("#details").submit();
				   }
				},
				
			    'NO'	: {
				  'class'	: 'gray',
				  'action': function(){}	// Nothing to do in this case. You can as well omit the action property.
			  }
		  }
	  });
  });
});
});