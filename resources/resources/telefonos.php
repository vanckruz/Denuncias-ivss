<?php
$Estados_codigos = array(
	'Amazonas'=>array('1'=>'0248'),
	'Anzoátegui'=>array('1'=>'0281','2'=>'0282','3'=>'0283','4'=>'0285'),
	'Apure'=>array('1'=>'0240','2'=>'0247','3'=>'0278'),
	'Aragua'=>array('1'=>'0243','2'=>'0244','3'=>'0246'),
	'Barinas'=>array('1'=>'0273','2'=>'0278'),
	'Bolívar'=>array('1'=>'0284','2'=>'0285','3'=>'0286','4'=>'0288','5'=>'0289'),
	'Carabobo'=>array('1'=>'0241','2'=>'0242','3'=>'0243','4'=>'0245','5'=>'0249'),
	'Cojedes'=>array('1'=>'0258'),
	'Delta Amacuro'=>array('1'=>'0287'),
	'Distrito Capital'=>array('1'=>'0212'),
	'Falcón'=>array('1'=>'0259','2'=>'0268','3'=>'0269','4'=>'0279'),
	'Guarico'=>array('1'=>'0235','2'=>'0238','3'=>'0246','4'=>'0247'),
	'Lara'=>array('1'=>'0251','2'=>'0252','3'=>'0253'),
	'Mérida'=>array('1'=>'0271','2'=>'0274','3'=>'0275'),
	'Miranda'=>array('1'=>'0212','2'=>'0234','3'=>'0239'),
	'Monagas'=>array('1'=>'0287','2'=>'0291','3'=>'0292'),
	'Nueva Esparta'=>array('1'=>'0295'),
	'Portuguesa'=>array('1'=>'0255','2'=>'0256','3'=>'0257','4'=>'0272'),
	'Sucre'=>array('1'=>'0293','2'=>'0294'),
	'Táchira'=>array('1'=>'0275','2'=>'0276','3'=>'0277','4'=>'0278'),
	'Trujillo'=>array('1'=>'0271','2'=>'0272'),
	'Vargas'=>array('1'=>'0212'),
	'Yaracuy'=>array('1'=>'0251','2'=>'0253','3'=>'0254'),
	'Zulia'=>array('1'=>'0262','2'=>'0263','3'=>'0264','4'=>'0265','5'=>'0266','6'=>'0267','7'=>'0271','8'=>'0275')
	);

$estado = 'Zulia'; //Estado seleccionado
foreach($Estados_codigos[$estado] as $codigo)
{
	echo $codigo.'<br/>';
}

/*
foreach($Estados_codigos as $estado)
{
	foreach ($estado as $codigo) {
		echo $codigo.'<br/>';
	}
}
*/
