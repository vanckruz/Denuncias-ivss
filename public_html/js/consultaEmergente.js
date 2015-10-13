// JavaScript Document
$(document).ready(function(e) 
{
	
	$("#opciones").on('change', function(){

		var mensaje = "";
		var opcion = $("#opciones").val();

		//$("#valor").val("");

		if(opcion == 'id_empresa')
		{

			mensaje += "Ej: A12345678";
			$("#valor").css('display', 'block');
			$("#valor").attr('maxlength', '9');
			$("#valor").mask('P99999999', {translation: { 
				'P': { pattern: /[a-zA-ZáéíóúàèìòùÀÈÌÒÙÁÉÍÓÚñÑüÜ_\s]$/, defaults: ':'}}});
		}else if(opcion == 'rif'){

			$("#valor").css('display', 'block');
			mensaje += "Ej: J123456789";
			$("#valor").attr('maxlength', '10');
			$("#valor").mask('R999999999', {translation: { 
				'R': { pattern: /[vVgGjJ\s]$/, defaults: ':'}}});
		}else if(opcion == 'nombre_empresa'){

			$("#valor").css('display', 'block');
			mensaje += "Ej: IVSS";
			$("#valor").attr('maxlength', '100');
			$("#valor").mask('NNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNN', {translation: { 
				'N': { pattern: /[0-9a-zA-ZáéíóúàèìòùÀÈÌÒÙÁÉÍÓÚñÑüÜ._\s]$/, defaults: ':'}}});
		}
		else
		{
			$("#valor").css('display', 'none');
		}
		$("#valor").attr('placeholder', mensaje);
	});

$("#consultar").click(function(e) 
{
	e.preventDefault();
	var filtro = $("#opciones").val();
	var valor = $('#valor').val();

	if(valor ==""){
		$("#content_mensaje3").fadeIn("slow");
		$("#alerta3").slideDown('slow');

		$("#cerrar_mensaje3").click(function(){
			$("#alerta3").slideUp('slow');
			$("#content_mensaje3").slideUp( "slow" );				
		});
	}
	else if((filtro == "id_empresa" && valor.length!=9) || (filtro == "id_empresa" && !isNaN(valor.charAt(0))) ){
		$("#content_mensaje1").fadeIn("slow");
		$("#alerta1").slideDown('slow');

		$("#cerrar_mensaje1").click(function(){
			$("#alerta1").slideUp('slow');
			$("#content_mensaje1").slideUp( "slow" );				
		});
			//alert("Valor incorrecto!. Debe poseer 9 Caracteres, iniciando con una letra y seguida de 8 dígitos ");
		}
		else if((filtro == "rif" && valor.length!=10) ||  (filtro == "rif" && !isNaN(valor.charAt(0))) ){
			$("#content_mensaje2").fadeIn("slow");
			$("#alerta2").slideDown('slow');

			$("#cerrar_mensaje2").click(function(){
				$("#alerta2").slideUp('slow');
				$("#content_mensaje2").slideUp( "slow" );			
			});
			//alert("Valor incorrecto!. Debe poseer 10 Caracteres, iniciando con una letra y seguida de 9 dígitos ");
		}
		else
		{
			$.ajax({
				dataType: "json",
				data: {"filtro": filtro, "valor":valor},
				url:   '../../../resources/select/buscar.php',
				type:  'post',
				timeout:7000,
				beforeSend: function(){
					$("#contenido_emergente").html("<img src='../../../../public_html/imagenes/484_azul.GIF'>");
				},
				success: function(respuesta){
                    //lo que se si el destino devuelve algo
                    $("#contenido_emergente").html(respuesta.html);
                },
                error:  function(xhr,err){ 
                    //alert("readyState: "+xhr.readyState+"\nstatus: "+xhr.status+"\n \n responseText: "+xhr.responseText);
                    $("#contenido_emergente").html("<p style='color:red;'>No se han encontrado registros!</p><button id='ingresar_empresa_no_ivss' class='btn btn-primary' data-dismiss='modal' onClick=\"habilitarRegistroEmpresa()\"  >Ingresar empresa no ivss</button>");
                }
            }).done(function(){

            	$( "#tabla_datos_empresa").dataTable();	

            	$("#tabla_datos_empresa tbody ").on("click","tr .btnok",function(){
            		$("#rif").val($(this).attr("data-rif"));
            		$("#npat").val($(this).attr("data-ID_EMPRESA"));
            		$("#razon").val($(this).attr("data-NOMBRE_EMPRESA").replace(/-/g, " "));
            		$("#direccion_empresa").val($(this).attr("data-DOMICILIO_COMPLETO").replace(/-/g, " "));
            	});           	 

            });//Fin función done.
        }
    });

/**************************************************************************************************/
/*
$("#valor").keypress(function (event){
	//alert($("#valor").val());
	var valor=$("#valor").val();

	var reg = /^[a-zA-Z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+$/;
	var key=event.which;
	var select;
	$( "#opciones" ).change(function() {
		//alert($( this ).val());
		var str = "";
		$( "#opciones option:selected" ).each(function() {
			select=$( this ).val();        
		});

	}).trigger( "change" );
	if (select=='id_empresa') {
		if (valor.length==1) {
			if(!reg.test($("#valor").val())){
				$("#valor").val("");
                //alert("valor incorrecto");
            } 
        }else if (valor.length>1 && valor.length<10) {

        	if (!(key<59)||!(key>46) ) {
        		if (!(key<106)||!(key>95)) {
        			switch(key){
        				case 8:
            //  case 37:
              //case 38:
              //case 39:
              //case 40:
              case 13:
              case 46:
              break;
              default:
              $("#valor").val("");
          }

      }
  }
}else if (valor.length>9) {
	$("#valor").val("");
}
     /* if(reg.test($("#valor").val())){
          alert("valor correcto");
      }else{
           $("#correo").val("");
            $("#valor").val("");
          alert("valor incorrecto");
      }*/
      /*
  }else if (select=='rif'){
  	var reg = /^([VvEeJjGg])$/ ;
  	if (valor.length==1) {
  		if(!reg.test($("#valor").val())){
  			$("#valor").val("");
            //alert("valor incorrecto");
        }
    }else if (valor.length>1 && valor.length<11) {

    	if (!(key<59)||!(key>46) ) {
    		if (!(key<106)||!(key>95)) {
    			switch(key){
    				case 8:
            //  case 37:
              //case 38:
              //case 39:
              //case 40:
              case 13:
              case 46:
              break;
              default:
              $("#valor").val("");key
          }

      }
  }
}else if (valor.length>10) {
	$("#valor").val("");
}
}   
});
*/
/*********************************************************************************************/


});


function habilitarRegistroEmpresa(){
	$("#dir_emp_vsbl").hide();
	$("#label_pat").hide();
	$("#npat").hide();
	$("#rif,#npat,#razon,#direccion_empresa").removeAttr("readonly").val("");
	//$("#dirfiscal").click();
	//$("#dirfuscalrow").css("display","none");
}
