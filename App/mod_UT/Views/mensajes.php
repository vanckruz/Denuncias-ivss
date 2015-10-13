<?php
	class Mensaje{
        private $status;
				
        public function __construct($sts=""){
            $this->status =$sts;	
        }
                
        /**
        * showMensaje
        *
        **/

        public function showMensaje(){
   
			if($this->status=='REG_OK')
			{
				include("ut_reg_ok.php");		
			}
			
			else if($this->status=='REG_ERR')
			{
				include("ut_reg_err.php");
						
			}
			else if($this->status=='EXIST')
			{
				include("ut_exist.php");		
			}
					
			else if($this->status=='NRF')
			{
				include("ut_blank.php");	
			}
					
			elseif($this->status=='UPD_OK')
			{
				include("ut_upd_ok.php");
			}
			elseif($this->status=='UPD_ERR')
			{
				include("ut_upd_err.php");		
			}
			require("bottomView.tpl.php");    
			} // FIN showMensaje()
			
			public function mostrar($ut)
                {
                	require("ut_mostrar.php");
                    require("bottomView.tpl.php");
                }
                
                public function showUpdateUt($ut)
                {
					echo "
						<section class='container'>
                        <form method='post' action='../Controllers/controller.UT.php' name='preupd' id='preupd'>
						<input type='hidden' name='option' value= 'preupd' form = 'preupd'/>
						</form>
						<h3>RESULTADOS DE LA BUSQUEDA</h3>
                        <table class='registros'>
                            <tr>
                                <!--<td class='sup'><span class='reg_item'>ID</span></td>-->
                                <td class='sup'><span class='reg-item'>INICIO</span></td>
                                <td class='sup'><span class='reg-item'>FIN</span></td>
                                <td class='sup'><span class='reg-item'>VALOR</span></td>
								<td></td>
                            </tr>";
                    foreach($ut as $key)
                    {  
						$inicio = $key->__GET('dinicio')."-".$key->__GET('minicio')."-".$key->__GET('yinicio');
						$fin = $key->__GET('dfin')."-".$key->__GET('mfin')."-".$key->__GET('yfin');
						$valor = $key->__GET('valor');
							echo 
                            "
                             <tr>	
                                <td class='sup'><span class='reg_item'>".$inicio."</span></td>
                                <td class='sup'><span class='reg_item'>".$fin."</span></td>
                                <td class='sup'><span class='reg_item'>".$valor." BsF</span></td>
								<td class='sup'><span id='".$key->__GET('id')."' class='submit reg_item updateut'>Editar</span></td>
                             </tr>";
							 
                    }
                    echo "<br></table><br>
                          <input type='button' class='boton' value='Cancelar' onClick='regresar();'/>
       					</section>";
						require("bottomView.tpl.php");
                }
       
                public function showDeleteForm($ut)
                {
                    echo "
						<section class='container'>
						<img class=imgsuperior' src='../public_html/imagenes/search.png'/>
                        <form method='post' action='../Controllers/controller.UT.php' name='preupd' id='preupd'>
						<input type='hidden' name='option' value= 'preupd' form = 'preupd'/>
						</form>
						<h3>RESULTADOS DE LA BUSQUEDA</h3>
                        <table class='registros'>
                            <tr>
                                <td class='sup'><span class='reg-item'>INICIO</span></td>
                                <td class='sup'><span class='reg-item'>FIN</span></td>
                                <td class='sup'><span class='reg-item'>VALOR</span></td>
								<td></td>
                            </tr>";
                    foreach($ut as $key)
                    { 
						$inicio = $key->__GET('dinicio')."-".$key->__GET('minicio')."-".$key->__GET('yinicio');
						$fin = $key->__GET('dfin')."-".$key->__GET('mfin')."-".$key->__GET('yfin');
						$valor = $key->__GET('valor');
							echo 
                            "
                             <tr>	
                                <td class='sup'><span class='reg_item'>".$inicio."</span></td>
                                <td class='sup'><span class='reg_item'>".$fin."</span></td>
                                <td class='sup'><span class='reg_item'>".$valor." BsF</span></td>
								<td class='sup'><span id='".$key->__GET('id')."' class='submit reg_item deleteut'>Eliminar</span></td>
                             </tr>";
                    }
                    echo "<br></table><br>
                          <input type='button' class='boton' value='Cancelar' onClick='regresar();'>
						  </section>";
                    require("bottomView.tpl.php");
                }
			
			public function showUpdateForm($ut)
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
			}      
		}
	?>
