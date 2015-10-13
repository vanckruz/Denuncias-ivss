$(document).ready(function(){

	//DENUNCIAS
	$("#registrarden,#consultarden,#asignar_den,#reportes_den,#doc_den, #mot_den, #dir_den,#est_den").each(function(){
		var href = $(this).attr("href");


  	//var name = $(this).attr('id')  
  	//var action = "<input type='hidden' id='action' name ='action' value='"+name+"' form='formquery'/>"
  	$(this).attr({ href: "#"});
  	
  	$(this).click(function(){
  		$("#mensajeCargando").show("fast");

  		$("#contenidos").load(href,function(){
  			$("#mensajeCargando").hide();
  		});


  		$("#modules").empty();
  		$("#modules").html("<a href='denuncias.php' title='Volver a la página principal'><span class='modulo'><span class='glyphicon glyphicon-share-alt'></span> Menú Denuncias</span></a>");

					  //$("#modules").css('display', 'none');
					});
  });

	  //FISCALIZACIÓN
	  $("#fiscalizar,#empresas_fiscalizadas").each(function(){
	  	var href = $(this).attr("href");
	  	$(this).attr({ href: "#"});
	  	$(this).click(function(){
	  		$("#contenidos").remove("#action");
	  		$("#contenidos").load(href);
			//$("#contenidos").after(action);
		});
	  });
	  
	//MULTAS
	$("").each(function(){
		var href = $(this).attr("href");
		$(this).attr({ href: "#"});
		$(this).click(function(){
			$("#contenidos").load(href);
		});
	});
	
	//UNIDAD TRIBUTARIA				
	$("#consultaut,#registraut,#actualizaut,#eliminaut").each(function(){
		var href = $(this).attr("href");
		var name = $(this).attr('id')  
		var action = "<input type='hidden' id='action' name ='action' value='"+name+"' form='formquery'/>"
		$(this).attr({ href: "#"});
		$(this).click(function(){
			$("#action").replaceWith(action);
			$("#contenidos").load(href)
			$("#contenidos").after(action);
			action ="";
			$("#modules").empty();
			$("#modules").html("<a href='unidadt.php'><span class='modulo'>Modulo Unidad T</span></a>"+"<img src='../../public_html/imagenes/unidadt.png' class='imgmodulo'></img>");
			
		});
	});
	
	
	//CIUDADANOS
	$("#registrarciudadano,#consultarciudadano,#eliminarciudadano").each(function(){
		var href = $(this).attr("href");
		$(this).attr({ href: "#"});
		$(this).click(function(){
			$("#contenidos").load(href);
		});
	});
	
	//Empresas
	$("#registrarempresa,#consultarempresa,#actualizarempresa,#eliminarempresa").each(function(){
		var href = $(this).attr("href");
		$(this).attr({ href: "#"});
		$(this).click(function(){
			$("#contenidos").load(href);
			$("#modules").empty();
			$("#modules").html("<a href='empresa.php'><span class='modulo'>Menú Empresas</span></a>"+"<img src='../imagenes/empresa.png' class='imgmodulo'></img>");
		});
	});
	
	/**************Usuarios********************************************/
	$("#registrar_user,#consultar_user,#actualizar_user,#eliminar_user").each(function(){
		var href = $(this).attr("href");
  	//var name = $(this).attr('id')  
  	//var action = "<input type='hidden' id='action' name ='action' value='"+name+"' form='formquery'/>"
  	$(this).attr({ href: "#"});
  	$(this).click(function(){
	  //$("#action").replaceWith(action);
	  $("#contenidos").load(href)
	  //$("#contenidos").after(action);
	  //action ="";
	  $("#modules").empty();
	  //$("#modules").html("<a href='denuncias.php'><span class='modulo'>Menú Denuncias</span></a>"+"<img src='../../public_html/imagenes/ciudadanos.png' class='imgmodulo'></img>");
	  
					  //$("#modules").css('display', 'none');
					});
  });
	/**************************************************************************************/

	/************************************Oficinas********************************************/

	$("#registrar_oficina,#consultar_oficina").each(function(){
		var href = $(this).attr("href");




		$(this).attr({ href: "#"});
		$(this).click(function(){
			
			$("#mensajeCargando").show("fast");
			
			$("#contenidos").load(href,function(){
				$("#mensajeCargando").hide();
			});
		  //$("#contenidos").after(action);
		  //action ="";
		  $("#modules").empty();
		  $("#modules").html("<a href='denuncias.php' title='Volver a la página principal'><span class='modulo'><span class='glyphicon glyphicon-share-alt'></span> Menú Denuncias</span></a>");
		  
						  //$("#modules").css('display', 'none');
						});
	});
	/************************************Oficinas********************************************/


});




