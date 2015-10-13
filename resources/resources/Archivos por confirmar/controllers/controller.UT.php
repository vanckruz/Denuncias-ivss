<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Registro UT</title>
</head>
<body>
	<?php
	    include("../UT/include_ut.php");
		if($_POST["option"]==1)// Insert into ut table
		{ 
			$inicio = addslashes($_POST["inicio"]);
			$fin = addslashes($_POST["fin"]);
			$valor = addslashes($_POST["valor"]);
			$ut = new UT();
			$ut->__SET("inicio",$inicio);
			$ut->__SET("fin",$fin);
			$ut->__SET("valor",$valor);
			$utd = new UTDAO("mysql");
			if($utd->Registrar($ut))
			{echo "Operación exitosa";}
			else echo "Operación Fallida";
		}
		else if($_POST["option"]==2)// Select From ut Table
		{
			//Código para procesar el Select
		}
		else if($_POST["option"]==3)// Update ut Table
		{
			//Código para procesar el Update
		}
		else if($_POST["option"]==4)// Delete From ut Table
	?>
</body>
</html>