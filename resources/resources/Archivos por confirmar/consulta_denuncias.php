<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Documento sin título</title>
</head>
<body>
	<?Php
		include("../../resources/DAO/include_dao.php");
		if(get_magic_quotes_gpc())
			{
				$nacionalidad=$_POST["nac"];
				$cedula=$_POST ["cedula"];
			} 
			else 
			{
				$nacionalidad = addslashes($_POST["nac"]);
				$cedula = addslashes($_POST["cedula"]);
			}
			
			 
			$dd = new DenunciasMySqlDAO();
			$d = $dd->queryByCedula($cedula);
			if(count($d)==0)
			{echo "Este usuario no tiene denuncias registradas";}
			else
			{
				echo $cedula."</br> Pedro Arredondo </br>";
				
				echo "<table border='1'>
					 	<tr colspan ='5' align='center'>Denuncias Registradas</tr>
						<tr>
							<td>N° Denuncia</td>
							<td>N° Patronal</td>
							<td>Empresa</td>
							<td>Motivo</td>
							<td>Estatus</td>
						</tr>";
				for($i=0;$i<count($d);$i++)
				{
					echo "<tr><td>".$d[$i]->getNumero();"</td>";
						echo "<td>".$d[$i]->getPatrono();"</td>";
						echo "<td>".$d[$i]->getFecha();"</td>";
						echo "<td>".$d[$i]->getMotivo();"</td>";
						echo "<td>".$d[$i]->getEstatus();"</td>";
						"</tr>";
				}
				echo "</table>";
			}
			//print_r($d);
	?>
</body>
</html>