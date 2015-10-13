<?php
/* 
 * Asegura la página en la que se incluya este script.
 */

include_once('class.Login.php'); //incluimos las funciones

if (!Login::estoy_logeado()) { // si no estoy logeado
    header('Location: http://desarrollofiscalizacion.ivss.int/index.php'); //saltamos a la página de login
	die('Acceso no autorizado'); // por si falla el header (solo se pueden mandar las cabeceras si no se ha impreso nada)
}
//si esta logeado el usuario continua con el script.
?>
