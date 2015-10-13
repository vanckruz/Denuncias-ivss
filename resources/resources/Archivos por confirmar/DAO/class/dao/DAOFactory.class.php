<?php

/**
 * DAOFactory
 * @author: http://phpdao.com
 * @date: ${date}
 */
class DAOFactory{
	
	/**
	 * @return CiudadanoDAO
	 */
	public static function getCiudadanoDAO(){
		return new CiudadanoMySqlExtDAO();
	}

	/**
	 * @return DenunciasDAO
	 */
	public static function getDenunciasDAO(){
		return new DenunciasMySqlExtDAO();
	}

	/**
	 * @return FiscalsystemusersDAO
	 */
	public static function getFiscalsystemusersDAO(){
		return new FiscalsystemusersMySqlExtDAO();
	}


}
?>