<?php
/* 
 * Cierra la sesión como usuario validado
 */

include('class.Login.php'); //incluimos las funciones
Login::logout(); //vacia la session del usuario actual
header('Location: ../index.php'); //saltamos a login.php

?>
