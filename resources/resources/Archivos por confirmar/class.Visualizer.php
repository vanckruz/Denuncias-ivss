<html lang="ES">
	<head>
    	<meta charset="utf-8">
        <link href="../public_html/css/visualizerut.css" rel="stylesheet">
    </head>
	<body>
		<div>
        	<header>
            	<figure>
					<img src="../public_html/imagenes/top.jpg"/>
				</figure>
            </header>
            
            <section>
            	<h3>Resultados de la busqueda</h3>
                <article class="registros">
                	<span class="sup">INICIO</span>
                	<span class="sup">FIN</span>
                	<span class="sup">VALOR</span>
                </article>
                <?php
				
					class UtVisualizer
					{
						private $ut;
							
						public function __construct($ut)
						{
							$this->ut=$ut;
						}
		
						public function show()
						{
							echo "<span class='sup'>INICIO</span><span class='sup'>FIN</span><span class='sup'>VALOR</span>";
							foreach($this->ut as $key)
							{ 
								echo 
									"<article class='registros'>
										<span><input type='radio'>	
										<span>".$key->__GET('inicio')."</span>
										<span>".$key->__GET('fin')."</span>
										<span>".$key->__GET('valor')."</span><br>
									 </article>";
							}
							echo "<br><input type='button' value='Aceptar' onClick='regresar();'>";
						}
						
					}
				?>
            </section>
            <footer>
        		<address>
                	<p>IVSS La Seguridad Social es tu Derecho</p>
            		&copy; 2015 IVSS
           		</address>
        	</footer>
		</div>
        <script type="text/javascript">
			function regresar()
			{		  
				var pagina = "../public_html/mod_UT/unidadt.php";
	    		location.href=pagina
			}
		</script>
	</body>
</html>

