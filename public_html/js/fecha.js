// JavaScript Document
$(document).ready(function(e) {
	var meses= array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
	mesinicio=$("#minicio").val();
	mesfin=$("#mfin").val();
	if(mesinicio==2)
	{
		dias = lista(28);
		for(i=0;i<dias.lenght;i++)
		$("#dinicio").append("<option>"+dias[i]+"</option>");
	}
	else if(mes == 4 || mes == 6 || mes == 9 || mes == 11)
	{
		dias = lista(30);
	}
	else
		dias = lista(31);
	
	function lista(n)
	{
		lista= array();
		for(i=1;i<=n;i++)
		{
			lista[i]=i;
		}
		return lista;
	}
});
