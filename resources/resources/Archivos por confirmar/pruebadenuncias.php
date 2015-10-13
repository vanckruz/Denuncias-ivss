<?php
	include("../../resources/class.Denuncia.php");
?>
<!doctype html>
<html lang="ES">
<head>
<meta charset="utf-8">
<title>Prueba de la clase Denuncia</title>
</head>

<body>
	<?php
		include("resources/class.BaseDatos.php");
		
		class DenunciaDAO
		{
			private $con;
			private $provider;
			
			public function __construct($dbprovider)
			{
				$this->con = new BaseDatos($provider, $host, $user, $pass, $bd);
			}
			
			private function crearDenuncia($den)
			{
				insert($den);
			}
			
			private function consultarDenuncia($id)
			{
				select($id);
			}
			
			private function actualizarDenuncia($id, $data)
			{
				update($id, $data);
			} 
			
			private function eliminarDenuncia($id)
			{
				delete($id);
			}
			
			private function insert($den)
			{
				}
		}
	?>
</body>
</html>