<?php 
	error_reporting(E_ALL);
	ini_set("display_errors", 1);
	include('config.orcl.ini.php');
// Create connection to Oracle 
class DataBase{
  public static $conn;
  public function __construct(){
  } 

  public static function getInstance(){
    if(!isset(self::$conn))
    {
     // var_dump(SERVER); exit();

      self::$conn = oci_new_connect(USER, PASS, SERVER."/".SID, CHARTSET); 
      if (!self::$conn)
      {    
        $m = oci_error();    
        echo $m['message'], "n";  
        exit; 
      }
    }
    return self::$conn;
  }
}
?>