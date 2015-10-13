<?php
	/*
	require_once("../../resources/DataBase.php");
	require_once("../../Models/Ciudadanos/include_ciudadano.php");
	require_once("../../Models/Denuncias/include_denuncia.php");
	require_once("../../Models/Empresa/include_empresa.php");
	//require_once("../mensajes.php");
	
	//$clave =$_POST['popselect'];
	//$valor = $_POST['popvalor'];			
	$empresa = new Empresa();
	$empresad = new EmpresaDAO();
	//$empresa = $empresad->obtenerBy($clave, $valor);
	
	$nac = unserialize(urldecode($_GET['n']));
	$ced = unserialize(urldecode($_GET['c']));
	$perd = new CiudadanoDAO();
	$per = $perd->obtener($nac, $ced);
	$idc = $per->__GET('id');
	$dend = new DenunciaDAO();
	$den = $dend->getByIC($idc);
	$num= count($den)+1;
	$numDen = generateNum($ced,$num);
	
	function generateNum($c, $n)
	{
		if($n<10)
		$numero = "D-DGF-".date('Ymd')."-".$c."-00".$n;
		elseif($n>=10 && $n<100)
		$numero = "D-DGF-".date('Ymd')."-".$c."-0".$n;
		elseif($n>=100)
		$numero = "D-DGF-".date('Ymd')."-".$c."-".$n;
		return $numero;
	}
	*/

    include("../../config/config.php");
?> 
<!doctype html>
<html lang="ES">
	<head>
		<meta charset="utf-8">
		<title>Registro de Denuncia</title>
        <link rel="stylesheet" href="<?=$base_url;?>public_html/css/normalize.css">
        <link rel="stylesheet" href="<?=$base_url;?>public_html/css/stylesr.css" >
        <link rel="stylesheet" href="<?=$base_url;?>public_html/css/form.css">
        
        <link rel="shortcut icon" href="../public_html/imagenes/logo.png" type="image/x-icon">
		<script type="text/javascript" src="<?=$base_url;?>public_html/js/jquery-1.11.2.min.js"></script>
		<script type="text/javascript" src="<?=$base_url;?>public_html/js/form.js"></script>
        <script type="text/javascript" src="<?=$base_url;?>public_html/js/emergente.js"></script>
		<script type="text/javascript" src="<?=$base_url;?>public_html/js/modernizr.custom.75139.js"></script>
        <script type="text/javascript" src="<?=$base_url;?>public_html/js/consultaEmergente.js"></script>
	</head>
	<body>
    <section class="principal">
        	<section class="wrapper">
    			<!--<header class="banner">
         			<figure>
                		<img src="../../public_html/imagenes/top.jpg"/>
               	 	</figure>
        		</header>-->
                <h2>Registro de Denuncia</h2>	
    			<ul class="tabs">
      				<li><a href="#tab1">Datos Trabajador</a></li>
                    <li><a href="#tab2">Datos Empresa</a></li>
                    <li><a href="#tab3">Datos Denuncia</a></li>
                    <li><a href="#tab4">Documentación</a></li>
                </ul>
    			<section class="clr"></section>
    		<section class="block">
            		<article id="tab1">
            				<form name="registrarDenuncia" id="rd" action="registrarDenuncia.php" method="post"></form>
                				<fieldset form="rd">
                				<legend>Datos del Trabajador</legend>
                    			<section class="elemento">
                    				<label for="cedula">Cedula</label>
                    				<!--<input type="text" id="nac" class="nac" contenteditable="false" value="V o E">-->
                    				<input type="text" id="cedula" name="cedula" value=<?=$ced?> 
                                    placeholder="Cédula Trabajador" disabled form="rd">
                    			</section>
                    			<div class="elemento">
                    				<label for="nombre">Nombres:</label>
                    				<input type="text" id="nombre" name="nombre" value=<?=$nom?>
                                    placeholder="Nombre Trabajador" disabled form="rd">
                    			</div>
                    			<div class="elemento">
                    				<label for="apellido">Apellidos:</label>
                    				<input type="text" id="apellido" name="apellido" value=<?=$ape?>
									placeholder="Apellido Trabajador" disabled form="rd">
                    			</div>
                    <div class="elemento">
                    <label for="direccion">Dirección</label>
                    <select id="estado_empleado" name="estado" form="rd">
                    	<option>Estado</option>
                    </select>
                    <select id="municipio" name="municipio" form="rd">
                    	<option>Municipio</option>
                    </select>
                    <select id="parroquia" name="parroquia" form="rd">
                    	<option>Parroquia</option>
                    </select>
                    </div>
                    <div class="elemento">
                    	<label for="Calle">Calle/Avenida</label>
                    	<input type="text" id="t_calle" name="t_calle" form="rd">
                    </div>
                    <div class="elemento">
                    	<label for="casa">Nombre Casa/Edificio</label>
                    	<input type="text" id="t_casa" name="t_casa" form="rd">
                    </div>
                    <div class="elemento">
                    	<label for="ncasa">N° Casa/Apto</label>
                    	<input type="text" id="t_ncasa" name="t_ncasa" form="rd">
                    </div>
                </fieldset>
            </article>
            
            <article id="tab2">
            	<fieldset>
                	<legend>Datos de la Empresa</legend>     
                    <!------ Modal Consultar empresa----->

                    <div class="row-fluid">
                        <div class="span12">
                            <div class="modal">
                                <div class="modal-header">header</div>
                                <div class="modal-body">body</div>
                                <div class="modal-footer">footer</div>
                            </div>
                        </div>
                    </div>
                    <div id="popup" style="display: none;">
    					<div class="content-popup">
        					<div>
            					<!--<img src="../../public_html/imagenes/search.png"  class="banner-pop">-->
            					<h1>Sistema de Fiscalización del IVSS</h1>
        					</div>
        					<div class="contenido"> 
                                <h2>Consultar Empresa</h2>
                                <form name="form_consultar" id="form_consultar"></form>
                                <!--<input type="hidden" name="option" value="consultar"/>-->
                                    <label for="Selec">Seleccione una opción de búsqueda</label>
                                    <div class="elemento">
                                    	<select name="opciones" id="opciones" class="sel">
                                        	<option value="default" selected>Seleccione</option>
                                            <option value="npat">N° Patronal</option>
                                        	<option value="rif">RIF</option>
                                        	<option value="nombre">Nombre</option>
                                         </select>
                                    </div>
                                    <div id="contenido_emergente"></div>
                                    <div id="elemento">
                                    <input type="submit" value="Consultar" name="consultar" id="consultar" form="form_consultar" style="display:none"/>
                                    <input type="button" value="Cancelar" name="cancelar" id="close" style="display:none"/>
                                        </div>
                             </div>
                            </div>
                    	</div>
                    
                    <!----- END popup consultar empresa ----->
                    
                    <div class="elemento">
                    <input type="button" value="Consultar Empresa" id="open">
                    </div>
                    <div class="elemento">
                    	<label for="npat">N° Patronal</label>
                    	<input type="text" id="npat" name="npat" contenteditable="false" value="" placeholder="N° Patronal" form="rd">
                    </div>
                    <div class="elemento">
                    	<label for="razon">Nombre o Razón Social:</label>
                    	<input type="text" id="razon" name="razon" contenteditable="false" value="" placeholder="Nombre o razón social de la empresa" form="rd">
                    </div>
                    <div class="elemento"> 
                    	<label for="rif">RIF:</label>
                    	<input type="text" id="rif" name="rif" contenteditable="false" value="" placeholder="Rif de la Empresa" form="rd">
                    </div>
                    <div class="elemento">
                    	<label for="dirfis">Dirección Fiscal Registrada</label>
                    	<input type="text" id="dirfis" name="dirfis" contenteditable="false" value="" placeholder="dirección fiscal de la empresa" form="rd">
                    </div>
                    <div class="elemento">
                    	<label for="dirrep">Dirección Fiscal reportada por el Denunciante</label>
                   		<select id="estado_empresa" form="rd">
                    		<option selected>Estado</option>
                        	<option>Miranda</option>
                        	<option>Monagas</option>
                    	</select>
                    	<select id="municipio" form="rd">
                    		<option selected>Municipio</option>
                    	</select>
                    	<select id="parroquia" form="rd">
                    		<option selected>Parróquia</option>
                    	</select>
                    </div>
                    <div class="elemento">
                    	 <label for="Calle">Calle/Avenida</label>
                    	<input type="text" form="rd">
                    </div>
                    <div class="elemento">
                    	<label for="casa">Nombre Casa/Edificio</label>
                    	<input type="text" form="rd">
                    </div>
                    <div class="elemento">
                    	<label for="ncasa">N° Casa/Apto</label>
                    	<input type="text" form="rd">
                    </div>
                    <div class="elemento">
                    	<label for="telefonohabitacion">Telefono de Habitación</label>
                    	<select id="cod1" form="rd">
                        	<option>0212</option>
                    	</select>
                    	<input type="tel" placeholder="Telefono de habitación" required form="rd">
                    </div>
                    <div class="elemento">
                    	<label for="telefonomovil">Telefono Celular</label>
                    	<select id="cod2" form="rd">
                        	<option selected>0412</option>
                        	<option>0414</option>
                            <option>0424</option>
                            <option>0416</option>
                            <option>0426</option>
                    	</select>
                    	<input type="tel" placeholder="Telefono Celular" form="rd">
                    </div>
                </fieldset>
            </article>
            
            <article id="tab3">
            	<fieldset>
                	<legend>Datos de la Denuncia</legend>
                    <div class="elemento">
                    	<label for="numero">Número de Denuncia</label>
                    	<input type="text" name="num_den" id="num_den" value="<?=$num_den?>" disabled>
                    </div>
                    <div class="elemento">
                    	<label for="fecha">Fecha</label>
                    	<input type="text" name="fecha" id="fecha" value="<?=date('Y-m-d')?>" disabled>
                    </div>
                    <div class="elemento">
                    	<label for="motivo">Motivo:</label>
                    	<select id="motivo" form="rd">
                    		<option>Trabajador no aparece inscrito en el IVSS.</option>
                            <option>Cotizaciones no reportadas por el Empleador en el IVSS.</option>
                            <option>Descuento de la alícuota correspondiente al Seguro Social
                            está fuera de lo establecido por la Ley y el Reglamento del Seguro Social.</option>
                            <option>Fecha de ingreso del asegurado(a) errada en la cuenta individual.</option>
                            <option>Fecha de inicio posterior al inicio real de la relación de trabajo.</option>
                            <option>Error en Nombre(s) y Apellido(s).</option>
                            <option>Número de cédula y fecha de nacimiento errados.</option>
                            <option>Trabajador no aparece inscrito en el IVSS.</option>
                            <option>Otros motivos</option>
                    	</select>
                    </div>
                    <div class="elemento">
                    	<label for="descripcion">Descripción</label>
                    	<textarea id="descripcion" class="text_area" cols="60" rows="1"></textarea>
                    </div>
                    <div class="elemento">
                    	<label for="estatus">Estatus</label>
                    	<input type="text" value="En proceso" disabled>
                    </div>
                </fieldset>
            </article>
            	
            <article id="tab4">
            	<fieldset>
                	<legend>Documentos Probatorios a Consignar</legend>
                    <ul class="lista">
                    	<li>
                    		<span><input type="checkbox" value="1" form="rd"/>Cédula de Identida y/o pasaporte</span>
                        </li>
                        <li>
                        	<span><input type="checkbox" value="2" form="rd"/>Constancia de trabajo para el ivss (F:14-100) o Constancia 
                           	de inscripción emitida por el Sistema de Gestión y Autoliquidación de Empresas TIUNA (Opcional)</span>
                        </li>
                        <li>
                        	<span><input type="checkbox" value="3" form="rd"/>Registro de Asegurado (F:14-02) o Constancia 
                            de ingreso emitida por el Sistema de Gestión y Autoliquidación de Empresas TIUNA (Opcional)</span>
                        </li>
                        <li>
                        	<span><input type="checkbox" value="4" form="rd"/>Participación de retiro del trabajador (F:14-03) o 
                            Constancia de egreso emitida por el Sistema de Gestión y Autoliquidación de Empresas TIUNA (Opcional)</span>
                        </li>
                        <li>
                        	<span><input type="checkbox" value="5" form="rd"/>Recibos de pago que indique la retención 
                            por concepto de pago de cotizaciones al IVSS</span>
                        </li>
                    	<li>
                        	<span><input type="checkbox" value="6" form="rd"/>Otra documentación que acredite la relacón 
                             de dependencia con el(la) empleador(a)</span>
                        </li>
                    </ul>
                </fieldset>
                <div class="elemento">
                	<input type="submit" value="Guardar" form="rd" class="boton">
                    <a href="../public_html/mod_denuncias/denuncias.php" class="boton">Cancelar</a>
                </div>
            </article>
            </section>
            </section>
            </div>
            </section>
	</body>
</html>
