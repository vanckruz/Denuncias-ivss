<?php
/*
 * Class return connection to database
 *
 * @author: http://phpdao.com
 * @date: 27.11.2007
 */
class ConnectionFactory{
	
	/**
	 * Zwrocenie polaczenia
	 *
	 * @return polaczenie
	 */
	static public function getConnection(){
		$conn = mysqli_connect(ConnectionProperty::getHost(), ConnectionProperty::getUser(), ConnectionProperty::getPassword(),ConnectionProperty::getDatabase());
		//mysqli_select_db($conn, ConnectionProperty::getDatabase());
		if(!$conn){
			throw new Exception('could not connect to database');
		}
		return $conn;
	}

	/**
	 * Zamkniecie polaczenia
	 *
	 * @param connection polaczenie do bazy
	 */
	static public function close($connection){
		mysqli_close($connection);
	}
}
?>