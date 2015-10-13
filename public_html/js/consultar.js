// JavaScript Document
//<![CDATA[

function mostrar()
{
	selec = $("#opciones").val();
	fuente = $("#fuente").val();

//////////////////////////////////CONTROL DE UT//////////////////////////////////////

	if(fuente=="unidadt")
	{
		if(selec == "default")
		{
			$("#yinicio").css('display','none');
			$("#minicio").css('display','none');
			$("#dias").css('display','none');
			$("#consultar").css('display','none');
			$("#cancelar").css('display','inline-block');
		}
		if(selec == "valor" || selec == "fecha")
    	{
    		$("#mostrar").css('display','block');                         
    	}
		if(selec == "valor")
		{
			$("#inpval").css('display','block');
			$("#inpval").attr('required',true); 
			$("#inpval").css('margin','5px auto');
			$("#yinicio").css('display','none');
			$("#minicio").css('display','none');
			$("#dias").css('display','none');
			$("#consultar").css('display','inline-block');
		}                
    	if(selec == "fecha")
    	{
			$("#yinicio").css('display','inline-block');
			$("#minicio").css('display','inline-block');
			$("#dias").css('display','inline-block');
			$("#inpval").css('display','none');
			$("#inpval").removeAttr('required');
			
		}
	/*
	else if(selec == "todo")
    {
    	document.getElementById("mostrar").innerHTML="";
        $( "#mostrar" ).append(btnconsulta);
        $( "#mostrar" ).append("<a href=unidadt.php>"+btncancela+"</a>");
		$( "#contenidos").append("</form>");
    }               
    */
	
	}
	
//////////////////////////////////CONTROL DE EMPRESAS Y FISCALIZACIÓN//////////////////////////////////////
	if(fuente=="fiscalizacion" || fuente=="empresa")
	{
		
		if(selec=='numero_patronal')
		{
			$("#npat").css('display','block');
			$("#rif").css('display','none');
			$("#nombre").css('display','none');
			$("#consultar").css('display','inline-block');
			$("#rif").removeAttr('required');
			$("#nombre").removeAttr('required');
			$("#npat").attr('required',true);
		}
		else if(selec=='rif')
		{
			$("#npat").css('display','none');
			$("#rif").css('display','block');
			$("#nombre").css('display','none');
			$("#consultar").css('display','inline-block');
			$("#npat").removeAttr('required');
			$("#nombre").removeAttr('required');
			$("#rif").attr('required',true);         
		}
	
		else if(selec=='nombre_empresa')
		{
			$("#npat").css('display','none');
			$("#rif").css('display','none');
			$("#nombre").css('display','block');
			$("#consultar").css('display','inline-block');
			$("#rif").removeAttr('required');
			$("#npat").removeAttr('required');
			$("#nombre").attr('required',true);         
		}
		else
		{
			$("#npat").css('display','none');
			$("#rif").css('display','none');
			$("#nombre").css('display','none');
			$("#consultar").css('display','none');
		}
	}
}

        //]]>          