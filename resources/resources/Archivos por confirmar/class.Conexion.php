	<?php 
		require("config.ini.php");
		class Conexion
			{
				private $host;
				private $user;
				private $pass;
				private $bd;
				private $link;
				
				public function __construct()
				{
					$this->host=SERVIDOR_MYSQL;
					$this->user=USUARIO_MYSQL;
					$this->pass=PASSWORD_MYSQL;
					$this->bd=BASE_DATOS;
   				}
			
				public function conectar()
				{
					$this->link = mysqli_connect($this->host, $this->user,$this->pass, $this->bd);
					if ($this->link->connect_errno) 
					{			
    			        exit();
					}
					else
					{ 
						mysqli_select_db($this->link,$this->bd); 
						return $this->link;
					}
				}
				
				public function getDB()
				{return $this->bd;}
				
				public function close($link)
				{
					mysqli_close($link);
					$this->link = null;
				}
			}
	?>
