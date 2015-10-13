    <?php 
    /*
     ******Configuraciones classConexion********/
	define('DB_DRIVER','mysql'); //CAMBIAR PARA USO CON OTRAS DB
	define('DB_SERVER','10.11.8.160'); //servidor de la base de datos
	define('DB_PORT','3306'); //Puerto de la Base de Datos
	define('DB_NAME','sistemafiscal'); // indica el nombre de la base de datos
	define('DB_USER','root'); //usuario de la base de datos
	define('DB_PWD','1234567'); //la clave para conectar
	
	/*********Configuraciones DataBase***********/
	define('DRIVER','mysql');
	//define('SERVER','localhost');
	define('SERVER','desarrollophp.ivss.int');
	//define('SERVER','localhost');
	define('DATABASE','sistemafiscal');
	define('USERNAME','root');
	define('PASSWORD','1234567');
	define('PORT','3306');
    //define('DNS','mysql:host=localhost;dbname=fiscalsystem'); // DNS para conexion  a base de datos
    define('DNS',DRIVER.':host='.SERVER.';port='.PORT.';dbname='.DATABASE.';charset=utf8');
	

	?>  
