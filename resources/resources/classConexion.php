<?php

/**
 * @author Ing. Pedro Arredondo
 * @copyright 2015
 */
 require_once 'config.ini.php';
class Conexion
{	
	//private static $dns = DNS;         
	//private static $username = USERNAME; 
	//private static $password = PASSWORD;    
	//private $dbh;
	private static $instancia;
	private $database_types = array("sqlite2", "mysql", "sqlsrv", "odbc", "oracle");
	private $db_type=DB_DRIVER;
	private $d=DB_NAME;
	private $server=DB_SERVER;
	private $password=DB_PWD;
	private $user=DB_USER;
	private $port=DB_PORT;
  	private static $Cn;
  	private $Err="";
    
	private function __construct() {
			
		}
	
	
	
 	/*
    private function __construct()
    {
        try {
 
            $this->dbh = new PDO(self::$dns, self::$username, self::$password);
			$this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->dbh->exec("SET CHARACTER SET utf8");
 
        } catch (PDOException $e) {
 
            print "Error!: " . $e->getMessage();
 
            die();
        }
    }
 	*/

	
    public function prepare($sql)
    {
 
        return $this->Cn->prepare($sql);
 
    }
	
    public static function getInstance()
    {
 
        if (!isset(self::$Cn)) {
          if (in_array($this->db_type, $this->database_types)){
      			try {
        			switch ($this->db_type) {
          				case "mysql":
			            	self::$Cn = new PDO("mysql:host=$server;port=$port;dbname=$db", $user, $password);
			            	break;          
			          	case "sqlite2":
				            self::$Cn = new PDO("sqllite: $db");
				            break;
			          	case "sqlsrv":
				            //$this->Cn = new PDO("sqlsrv:server=$server:$port;database=$db", $user ,$password);
				            self::$Cn = new PDO("sqlsrv:server=$server;database=$db", $user ,$password);
				            break;
				        case "odbc":
				            self::$Cn = new PDO("odbc:Driver={Microsoft Access Driver (*.mdb)};Dbq=$db;Uid=$user");
				            break;
				        case "oracle":
				            self::$Cn = new PDO("OCI:dbname=$db;charset=UTF-8", $user, $password);
				            break;
			        }
        
        			self::$Cn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
					self::$Cn->exec("SET CHARACTER SET utf8");
      			} catch (PDOException $exc) {
			        $this->Err = "Error: (" . $exc->getCode() . ") - " . $exc->getMessage();
			        return false;
      			}
    		} else {
		      $this->Err = "Error: The Type of database not is supported in this moments";
		      return false;
    		}
        }
 
        return self::$Cn;  
    }
 
     // Evita que el objeto se pueda clonar
    public function __clone()
    {
 
        trigger_error('La clonación de este objeto no está permitida', E_USER_ERROR);
 
    }
}
?>