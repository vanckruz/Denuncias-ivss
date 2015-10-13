<?php
	//include all DAO files
	require_once('class/sql/Connection.class.php');
	require_once('class/sql/ConnectionFactory.class.php');
	require_once('class/sql/ConnectionProperty.class.php');
	require_once('class/sql/QueryExecutor.class.php');
	require_once('class/sql/Transaction.class.php');
	require_once('class/sql/SqlQuery.class.php');
	require_once('class/core/ArrayList.class.php');
	require_once('class/dao/DAOFactory.class.php');
 	
	require_once('class/dao/CiudadanoDAO.class.php');
	require_once('class/dto/Ciudadano.class.php');
	require_once('class/mysql/CiudadanoMySqlDAO.class.php');
	require_once('class/mysql/ext/CiudadanoMySqlExtDAO.class.php');
	require_once('class/dao/DenunciasDAO.class.php');
	require_once('class/dto/Denuncia.class.php');
	require_once('class/mysql/DenunciasMySqlDAO.class.php');
	require_once('class/mysql/ext/DenunciasMySqlExtDAO.class.php');
	require_once('class/dao/FiscalsystemusersDAO.class.php');
	require_once('class/dto/Fiscalsystemuser.class.php');
	require_once('class/mysql/FiscalsystemusersMySqlDAO.class.php');
	require_once('class/mysql/ext/FiscalsystemusersMySqlExtDAO.class.php');
	require_once('class/dao/UtDAO.class.php');
	require_once('class/dto/Ut.class.php');
	require_once('class/mysql/UtMySqlDAO.class.php');
	require_once('class/mysql/ext/UtMySqlExtDAO.class.php');

?>