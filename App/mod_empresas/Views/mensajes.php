<!doctype html>
<html lang="ES">
	<head>
    	<meta charset="utf-8">
        <link href="../public_html/css/mensajes.css" rel="stylesheet">
        <link href="../public_html/css/visualizerut.css" rel="stylesheet">
        <script type="text/javascript" src="../public_html/js/jquery-1.11.2.min.js"></script>
        <script type="text/javascript" src="../public_html/js/mostrarContenido.js"></script>
        <script type="text/javascript" src="../public_html/js/emergente.js"></script>
        <script type="text/javascript" src="../public_html/js/enviar.js"></script>
    </head>
	<body>           
		<?php
            /**
             *
             *
            **/
            
            class Mensaje
            {
                private $status;
				
                public function __construct($sts="")
                {
                    $this->status =$sts;	
                }
                
                /**
                 * showMensaje
                 *
                **/
                public function showMensaje()
                {
                    
                    
				//MENSAJES RELACIONADOS CON UT
			   
					if($this->status=='REG_OK')
					{
						echo "
						<section class='container'>
							<img src='../public_html/imagenes/agregar2.png' class='imgsuperior'/>
							<article id='contenedor_mensajes'>
								<span>
									Registro de empresa completado Exitosamente!.
								</span>
							</article>
						</section>";
					}
			
					else if($this->status=='REG_ERR')
					{
						echo " 
						<section>
							<article id='contenedor_mensajes'>
								<span>
									Error en la operación. Intente nuevamente!.
								</span>
							</article>
						</section>";
					}

					else if($this->status=='EXIST')
					{
						echo "
							<section>
								<article id='contenedor_mensajes'>
									<span>
										<p>Ya existe una empresa registrada con alguna de las características
										especificadas.</p>
										<p>Presione el boton <strong>Aceptar</strong> y seleccione la 
										opción <strong>Consultar UT</strong> para verificar las Unidades Tributarias 
										registradas.</p> 
									</span>
								</article>
							</section>";
					}
					
					else if($this->status=='NRF')
					{
						echo " 
							<section>
								<article id='contenedor_mensajes'>
									<span>
										No se encontraron coincidencias. Intente con otra opción de búsqueda.<br>
									</span>
								</article>
							</section>";
					}
					
					elseif($this->status=='UPD_OK')
					{
						echo " 
						<section>
							<article id='contenedor_mensajes'>
								<span>
									Se ha actualizado correctamente el registro!. 
								</span>
							</article>
						</section>";
					}
					elseif($this->status=='UPD_ERR')
					{
						echo " 
						<section>
							<article id='contenedor_mensajes'>
								<span>
									Error!. No Se ha actualizado correctamente el registro. Intente Nuevamente!. 
								</span>
							</article>
						</section>";
					}
					
					echo "<br><input type='button' value='Aceptar' onClick=regresar();>";
					require("bottomView.tpl.php");    
			} // FIN showMensaje()
			
			public function mostrar($empresa)
            {			 
			   	$template = file_get_contents("../Views/view_Empresa.php");
				foreach($empresa as $key)
				{
					$rif = $key->__GET('rif');
      				$npat= $key->__GET('id_empresa');
      				$nombre = $key->__GET('nombre_empresa');
      				$dir = $key->__GET('direccion');
      				$tlf = $key->__GET('telefono_hab');
					require("constants_Empresa.php");
				 	foreach ($constants as $clave=>$valor)
				 	{
						$template= str_replace('{'.$clave.'}', $valor, $template);
					}
				 	$template=$template;
				 print($template);
				}
				  
			   	 require("bottomView.tpl.php");
			   
			   //require("view_Empresa.php");
			   
			}//FIN MOSTRAR
                
            public function showUpdateForm($empresa)
                {
					echo "
						<section class='container'>
                        <form method='post' action='../Controllers/controller.UT.php' name='preupd' id='preupd'>
						<input type='hidden' name='option' value= 'preupd' form = 'preupd'/>
						</form>
						<h3>RESULTADOS DE LA BUSQUEDA</h3>
                        <table class='registros'>
                            <tr>
                                <td class='sup'><span class='reg_item'>RIF</span></td>
                                <td class='sup'><span class='reg-item'>N° Patronal</span></td>
                                <td class='sup'><span class='reg-item'>Nombre</span></td>
                                <td class='sup'><span class='reg-item'>Direccion</span></td>
								<td class='sup'><span class='reg-item'>Telefono</span></td>
								<td></td>
                            </tr>";
                    foreach($empresa as $key)
                { 
					$rif = $key->__GET('rif');
					$npat= $key->__GET('numeroPatronal');
					$nombre = $key->__GET('nombre');
					$dir = $key->__GET('direccion');
					$tlf = $key->__GET('telefono');
					echo 
					"
					 <tr>	
						<td class='sup'><span class='reg_item'>".$rif."</span></td>
						<td class='sup'><span class='reg_item'>".$npat."</span></td>
						<td class='sup'><span class='reg_item'>".$nombre."</span></td>
						<td class='sup'><span class='reg_item'>".$dir."</span></td>
						<td class='sup'><span class='reg_item'>".$tlf."</span></td>
						<td class='sup'><span id='".$key->__GET('id')."' class='submit reg_item updemp'>Editar</span></td>
					 </tr>";
				}
                    echo "<br></table><br>
                          <input type='button' class='boton' value='Cancelar' onClick='regresar();'/>
       					</section>";
						require("bottomView.tpl.php");
                }
       
                public function showDeleteForm($empresa)
                {
                    echo "
						<section class='container'>
                        <form method='post' action='../Controllers/controller.UT.php' name='preupd' id='preupd'>
						<input type='hidden' name='option' value= 'preupd' form = 'preupd'/>
						</form>
						<h3>RESULTADOS DE LA BUSQUEDA</h3>
                        <table class='registros'>
                            <tr>
                                <td class='sup'><span class='reg_item'>RIF</span></td>
                                <td class='sup'><span class='reg-item'>N° Patronal</span></td>
                                <td class='sup'><span class='reg-item'>Nombre</span></td>
                                <td class='sup'><span class='reg-item'>Direccion</span></td>
								<td class='sup'><span class='reg-item'>Telefono</span></td>
								<td class='sup'><span class='reg-item'></span></td>
                            </tr>";
                    foreach($empresa as $key)
                { 
					$rif = $key->__GET('rif');
					$npat= $key->__GET('numeroPatronal');
					$nombre = $key->__GET('nombre');
					$dir = $key->__GET('direccion');
					$tlf = $key->__GET('telefono');
					echo 
					"
					 <tr>	
						<td class='sup'><span class='reg_item'>".$rif."</span></td>
						<td class='sup'><span class='reg_item'>".$npat."</span></td>
						<td class='sup'><span class='reg_item'>".$nombre."</span></td>
						<td class='sup'><span class='reg_item'>".$dir."</span></td>
						<td class='sup'><span class='reg_item'>".$tlf."</span></td>
						<td class='sup'><span id='".$key->__GET('id')."' class='submit reg_item delemp'>Eliminar</span></td>
					 </tr>";
				}
                    echo "<br></table><br>
                          <input type='button' class='boton' value='Cancelar' onClick='regresar();'/>
       					</section>";
						require("bottomView.tpl.php");

            }
			
			/*public function showUpdateForm($ut)
			{
				$id = $ut->__GET('id');
				$inicio = $ut->__GET('inicio');
				$fin = $ut->__GET('fin');
				$valor = $ut->__GET('valor');
				
				echo 
				'
					<form name="actualiza" id="actualiza" method="post" action="../Controllers/Controller.UT.php" ></form>
					<input type="hidden" name="option" value="update" form="actualiza"/>
					<table class="datos">
						<tr>
							<td><label for="id">ID</label></td>
							<td><input type="text" form="actualiza" name="id" value="'.$id.'" disabled/></td>
							<input type="hidden" name="id" value="'.$id.'" form="actualiza"/>
						</tr>
							
						<tr>
							<td><label for="inicio">Inicio</label></td>
							<td><input type="text" form="actualiza" name="inicio" value="'.$inicio.'" required/></td>
						</tr>
						
						<tr>
							<td><label for="fin">Fin</label></td>
							<td><input type="text" name="fin" form="actualiza" value="'.$fin.'" required/></td>
						</tr>
						<tr>
							<td><label for="fecha">Valor</label></td>
							<td><input type="text" name = "valor" form="actualiza" value="'.$valor.'" required/></td>
						</tr>
						
					</table>
					<div>
						<input type="button" class="boton" value="Cancelar" onClick="history.back();"/>
						<input type="submit" class="boton" id="actualizar" value="Actualizar" form="actualiza"/>
						<br><br>
					</div>
					
					
				';
			}*/      
		}
	?>
