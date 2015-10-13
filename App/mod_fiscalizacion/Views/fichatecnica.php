<!DOCTYPE html>
<html lang="ES">
<head>
	<meta charset="utf-8">
    <title>Ficha Técnica</title>
	<link rel="stylesheet" type="text/css" href="../../public_html/css/desplegable.css">
	<script type="text/javascript" src="../../public_html/js/jquery-1.11.2.min.js"></script>
	<script type="text/javascript" src="../../public_html/js/desplegable.js"></script>

</head>

<body>
  	<section class="accordion">
    	<header class="banner">
    		<figure>
        		<img src="../../public_html/imagenes/top.jpg"/>
        	</figure>
    	</header>
        <h1>Ficha Técnica de Registro</h1>
    	<h5>(Haga Click sobre los encabezados para desplegar el contenido)</h5>
    	<article>
      		<h2>Datos informativos de la empresa privada u organismo público, ente o empresa del estado</h2>
      		<div class="block">
        		<div class="elemento">
        			<label for="nombre">Razón Social de la empresa</label>
            		<input type="text" name="nombre" id="nombre"/>
        		</div>
        
        	<div class="elemento">
            	<label for="rif">RIF</label>
            	<select id="tipo" name="tipo" form="ft">
            		<option value="J" selected="selected">J</option>
                	<option value=""></option>
            	</select>
            	<input type="text" form="ft"/>
        	</div>
        
        	<div class="elemento">
            	<label for="representante">Representante legal</label>
            	<input type="text" form="ft" name="representante" id="representante"/>
        	</div>
        
        	<div class="elemento"> 
            	<label for="cedula">Cédula</label>
            	<select id="nacionalidad" name="nacionalidad" form="ft">
            		<option value="V">V</option>
                	<option value="E">E</option>
            	</select>
            	<input type="number" form="ft" name="cedula" id="cedula"/>
       		</div>
       
           <div class="elemento"> 
                <label for="npatronal">N°. Patronal</label>
                <input type="text" form="ft" name="npat" id="npat"/>
           </div>
           
           <div class="elemento">  
                <label for="oficina">Oficina</label>
                <input type="text" form="ft" name="oficina" id="oficina"/>
           </div>
           
           <div class="elemento">  
                <label for="fecha">Fecha</label>
                <input type="text"  placeholder="DD/MM/AA" form="ft" name="fecha" id="fecha"/>
           </div>
           
           <div class="elemento">  
                <label for="n">N°:</label>
                <input type="text" form="ft" name="numero" id="numero"/>
           </div>
           
           <div class="elemento">  
                <label for="tomo">Tomo</label>
                <input type="text" form="ft" name="tomo" id="tomo"/>
           </div>
           
           <div class="elemento">  
                <label for="folio">Folio</label>
                <input type="text" form="ft" name="folio" id="folio"/>
           </div>
           
           <div class="elemento">  
                <label for="estatus">Cambio de Estatus</label>
                <input type="text"  placeholder="DD/MM/AA" form="ft" name="estatus" id="estatus"/>
           </div>
           
           <div class="elemento">
                <label for="denominacion">Denominación Comercial</label>
                <input type="text" form="ft" name="denominacion" id="denominacion"/>
           </div>
           
           <div class="elemento">
                <label for="direccion">Dirección de la Razón Social</label>
                <input type="text" form="ft" name="direccion" id="direccion"/>
           </div>
           
           <div class="elemento">     
                <label for="sucursales">Sucursales o Agencias:</label>
                <span>No</span><input type="radio" value="No" id="sucursales" name="sucursales" form="ft"/>
                <span>Si</span><input type="radio" value="Si" id="sucursales" name="sucursales" form="ft"/>
                Cuantas:<input type="text" form="ft" name="nsucursales" id="nsucursales"/>
                <div id="ubicaciones">
                <!--Generar campos automaticamente según numero de sucursales-->
                </div>
           </div>
                
           <div class="elemento">
                <label for="email">Correo electrónico</label>
                <input type="email" form="ft" name="email" id="imail"/>
           </div>
           
           <div class="elemento">
                <label for="telefono">Teléfono</label>
                <select id="codtlf" name="codtlf" form="ft"> 
                    <option></option>
                    <option></option>
                </select>
                <input type="text" form="ft" name="telefono" id="telefono"/>
          </div>
          
          <div class="elemento">
                <label for="contacto">Persona Contacto</label>
                <input type="text" form="ft" name="contacto" id="contacto"/>
          </div>
      
      </div>
    </article>
    <article>
      <h2>Condiciones Actuales de la Nómina de Trabajadores (Empresa Vs. IVSS)</h2>
      <div class="block">
        <div class="elemento">
        	<label>Registro:</label>
        	<table id="registro">
                <tr>
                	<td>IVSS</td>
                    <td>TIUNA</td>
                </tr>
                
                <tr>
                	<td><input type="text"</td>
                    <td><input type="text"</td>
                </tr>
            </table>
        	<label>Riesgo:</label>
            <table id="riesgo">
                <tr>
                	<td>Nivel</td>
                    <td>% de Retención</td>
                </tr>
                
                <tr>
                	<td></td>
                    <td></td>
                </tr>
            </table>
        
            <label for="actividad">Actividad</label>
            <input type="text" form="ft" name="actividad" id="actividad"/>
        </div>
        
        <div class="elemento">
            <table id="trabajadores">
                <tr>
                	<td>Trabajadores Activos</td>
                    <td>Trabajadores en el IVSS</td>
                    <td>Diferencia</td>
                </tr>
                <tr>
                	<td></td>
                    <td></td>
                    <td></td>
                </tr>
            </table>
        </div>
        
        <div class="elemento">
            <table id="formas">
                <tr>
                	<td>Forma 14-02</td>
                    <td>Forma 14-03</td>
                    <td>Cambio de salarios</td>
                    <td>Morosidad según estado de cuenta</td>
                </tr>
                <tr>
                	<td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            </table>
        </div>  
      
      </div>
    </article>
    <article>
      <h2>Documentos revisados</h2>
      <div class="block">
        <p>
        	<ul>
            	<li>
					<input type="checkbox" form="ft" name="rif" id="rif" value="rif"><span>Registro de Información Fiscal RIF.</span>
                </li>
                
                <li>
                	<input type="checkbox" form="ft" name="f1401" id="f1401" value="f1401"><span>Forma 14-01 Cédula del Patrono o Empresa y/o Registro al Sistema de Gestión y Autoliquidación de Empresas Tiuna.</span>
                </li>
                
                <li>
                    <input type="checkbox" form="ft" name="f1400" id="f1402" value="f1402"><span>Forma 14-02 Registro de asegurado y/o constancia de ingresos del trabajador emitido por el Sistema Tiuna.</span>
                </li>
                <li>
                	<input type="checkbox" form="ft" name="f1403" id="f1403" value="f1403"><span>Forma 14-03 Participación de retiro y/o constancia de egreso del trabajador emitido por el Sistema Tiuna.</span>
                </li>
                <li>
                    <input type="checkbox" form="ft" name="ordenpago" id="ordenpago" value="ordenpago"><span>Tres (03) últimas órdenes de pago emitidas por el IVSS y depósitos bancarios debidamente cancelados.</span>
                </li>
                <li>
                   	<input type="checkbox" form="ft" name="nomina" id="nomina" value="nomina"><span>Nómina de los trabajadores de los últimos tres (03) años.</span>
                </li>
                <li>
                   	<input type="checkbox" form="ft" name="declaracion" id="declaracion" value="declaracion"><span>Copia de las declaraciones de impuestos sobre la renta de los últimos tres (03) ejercicios fiscales.</span>
                </li>
                
                <li>
                   	<input type="checkbox" form="ft" name="acta" id="acta" value="acta"><span>Acta Constitutiva más últimas actas de asamblea estatutaria (Modificaciones)</span>
                </li>
                
                </li>
                
                <li>
                   	<input type="checkbox" form="ft" name="regpat" id="regpat" value="regpat"><span>Registro patronal de asegurados</span>
                </li>
                
                </li>
                
                <li>
                   	<input type="checkbox" form="ft" name="dectra" id="dectra" value="dectra">Declaración trimestral de trabajadores ante el Ministerio del Poder Popular para el Trabajo y Seguridad Social del último ejercicio fiscal.
                </li>


            </ul>
        </p>  
      </div>
    </article>
    <article>
      <h2>Observaciones y/o comentarios</h2>
      <div class="block">
        <label>Observaciones</label>
        <input type="text" maxlength="5" form="ft" name="observaciones" id="observaciones">
      </div>
    </article>
  </section>
</body>
</html>