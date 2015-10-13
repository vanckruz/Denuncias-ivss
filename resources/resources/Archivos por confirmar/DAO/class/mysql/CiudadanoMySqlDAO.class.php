<?php
/**
 * Class that operate on table 'ciudadano'. Database Mysql.
 *
 * @author: http://phpdao.com
 * @date: 2015-03-02 17:45
 */
class CiudadanoMySqlDAO implements CiudadanoDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @return CiudadanoMySql 
	 */
	public function load($id){
		$sql = 'SELECT * FROM ciudadano WHERE id_ciudadano = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($id);
		return $this->getRow($sqlQuery);
	}

	/**
	 * Get all records from table
	 */
	public function queryAll(){
		$sql = 'SELECT * FROM ciudadano';
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
	 * Get all records from table ordered by field
	 *
	 * @param $orderColumn column name
	 */
	public function queryAllOrderBy($orderColumn){
		$sql = 'SELECT * FROM ciudadano ORDER BY '.$orderColumn;
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
 	 * Delete record from table
 	 * @param ciudadano primary key
 	 */
	public function delete($id_ciudadano){
		$sql = 'DELETE FROM ciudadano WHERE id_ciudadano = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($id_ciudadano);
		return $this->executeUpdate($sqlQuery);
	}
	
	/**
 	 * Insert record to table
 	 *
 	 * @param CiudadanoMySql ciudadano
 	 */
	public function insert($ciudadano){
		$sql = 'INSERT INTO ciudadano (nacionalidad, cedula, nombre_ciudadano, apellido_ciudadano) VALUES (?, ?, ?, ?)';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->set($ciudadano->nacionalidad);
		$sqlQuery->setNumber($ciudadano->cedula);
		$sqlQuery->set($ciudadano->nombreCiudadano);
		$sqlQuery->set($ciudadano->apellidoCiudadano);

		$id = $this->executeInsert($sqlQuery);	
		$ciudadano->idCiudadano = $id;
		return $id;
	}
	
	/**
 	 * Update record in table
 	 *
 	 * @param CiudadanoMySql ciudadano
 	 */
	public function update($ciudadano){
		$sql = 'UPDATE ciudadano SET nacionalidad = ?, cedula = ?, nombre_ciudadano = ?, apellido_ciudadano = ? WHERE id_ciudadano = ?';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->set($ciudadano->nacionalidad);
		$sqlQuery->setNumber($ciudadano->cedula);
		$sqlQuery->set($ciudadano->nombreCiudadano);
		$sqlQuery->set($ciudadano->apellidoCiudadano);

		$sqlQuery->setNumber($ciudadano->idCiudadano);
		return $this->executeUpdate($sqlQuery);
	}

	/**
 	 * Delete all rows
 	 */
	public function clean(){
		$sql = 'DELETE FROM ciudadano';
		$sqlQuery = new SqlQuery($sql);
		return $this->executeUpdate($sqlQuery);
	}

	public function queryByNacionalidad($value){
		$sql = 'SELECT * FROM ciudadano WHERE nacionalidad = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByCedula($value){
		$sql = 'SELECT * FROM ciudadano WHERE cedula = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->getList($sqlQuery);
	}

	public function queryByNombreCiudadano($value){
		$sql = 'SELECT * FROM ciudadano WHERE nombre_ciudadano = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByApellidoCiudadano($value){
		$sql = 'SELECT * FROM ciudadano WHERE apellido_ciudadano = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}


	public function deleteByNacionalidad($value){
		$sql = 'DELETE FROM ciudadano WHERE nacionalidad = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByCedula($value){
		$sql = 'DELETE FROM ciudadano WHERE cedula = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByNombreCiudadano($value){
		$sql = 'DELETE FROM ciudadano WHERE nombre_ciudadano = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByApellidoCiudadano($value){
		$sql = 'DELETE FROM ciudadano WHERE apellido_ciudadano = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}


	
	/**
	 * Read row
	 *
	 * @return CiudadanoMySql 
	 */
	protected function readRow($row){
		$ciudadano = new Ciudadano();
		
		$ciudadano->idCiudadano = $row['id_ciudadano'];
		$ciudadano->nacionalidad = $row['nacionalidad'];
		$ciudadano->cedula = $row['cedula'];
		$ciudadano->nombreCiudadano = $row['nombre_ciudadano'];
		$ciudadano->apellidoCiudadano = $row['apellido_ciudadano'];

		return $ciudadano;
	}
	
	protected function getList($sqlQuery){
		$tab = QueryExecutor::execute($sqlQuery);
		$ret = array();
		for($i=0;$i<count($tab);$i++){
			$ret[$i] = $this->readRow($tab[$i]);
		}
		return $ret;
	}
	
	/**
	 * Get row
	 *
	 * @return CiudadanoMySql 
	 */
	protected function getRow($sqlQuery){
		$tab = QueryExecutor::execute($sqlQuery);
		if(count($tab)==0){
			return null;
		}
		return $this->readRow($tab[0]);		
	}
	
	/**
	 * Execute sql query
	 */
	protected function execute($sqlQuery){
		return QueryExecutor::execute($sqlQuery);
	}
	
		
	/**
	 * Execute sql query
	 */
	protected function executeUpdate($sqlQuery){
		return QueryExecutor::executeUpdate($sqlQuery);
	}

	/**
	 * Query for one row and one column
	 */
	protected function querySingleResult($sqlQuery){
		return QueryExecutor::queryForString($sqlQuery);
	}

	/**
	 * Insert row to table
	 */
	protected function executeInsert($sqlQuery){
		return QueryExecutor::executeInsert($sqlQuery);
	}
}
?>