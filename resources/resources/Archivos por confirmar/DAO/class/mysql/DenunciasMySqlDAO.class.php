<?php
/**
 * Class that operate on table 'denuncias'. Database Mysql.
 *
 * @author: http://phpdao.com
 * @date: 2015-03-02 17:45
 */
class DenunciasMySqlDAO implements DenunciasDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @return DenunciasMySql 
	 */
	public function load($id){
		$sql = 'SELECT * FROM denuncias WHERE id_denuncia = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($id);
		return $this->getRow($sqlQuery);
	}

	/**
	 * Get all records from table
	 */
	public function queryAll(){
		$sql = 'SELECT * FROM denuncias';
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
	 * Get all records from table ordered by field
	 *
	 * @param $orderColumn column name
	 */
	public function queryAllOrderBy($orderColumn){
		$sql = 'SELECT * FROM denuncias ORDER BY '.$orderColumn;
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
 	 * Delete record from table
 	 * @param denuncia primary key
 	 */
	public function delete($id_denuncia){
		$sql = 'DELETE FROM denuncias WHERE id_denuncia = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($id_denuncia);
		return $this->executeUpdate($sqlQuery);
	}
	
	/**
 	 * Insert record to table
 	 *
 	 * @param DenunciasMySql denuncia
 	 */
	public function insert($denuncia){
		$sql = 'INSERT INTO denuncias (cedula, numero_denuncia, numero_patronal, motivo_denuncia, estatus_denuncia, fecha_denuncia) VALUES (?, ?, ?, ?, ?, ?)';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->setNumber($denuncia->cedula);
		$sqlQuery->set($denuncia->numeroDenuncia);
		$sqlQuery->set($denuncia->numeroPatronal);
		$sqlQuery->set($denuncia->motivoDenuncia);
		$sqlQuery->set($denuncia->estatusDenuncia);
		$sqlQuery->set($denuncia->fechaDenuncia);

		$id = $this->executeInsert($sqlQuery);	
		$denuncia->idDenuncia = $id;
		return $id;
	}
	
	/**
 	 * Update record in table
 	 *
 	 * @param DenunciasMySql denuncia
 	 */
	public function update($denuncia){
		$sql = 'UPDATE denuncias SET cedula = ?, numero_denuncia = ?, numero_patronal = ?, motivo_denuncia = ?, estatus_denuncia = ?, fecha_denuncia = ? WHERE id_denuncia = ?';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->setNumber($denuncia->cedula);
		$sqlQuery->set($denuncia->numeroDenuncia);
		$sqlQuery->set($denuncia->numeroPatronal);
		$sqlQuery->set($denuncia->motivoDenuncia);
		$sqlQuery->set($denuncia->estatusDenuncia);
		$sqlQuery->set($denuncia->fechaDenuncia);

		$sqlQuery->setNumber($denuncia->idDenuncia);
		return $this->executeUpdate($sqlQuery);
	}

	/**
 	 * Delete all rows
 	 */
	public function clean(){
		$sql = 'DELETE FROM denuncias';
		$sqlQuery = new SqlQuery($sql);
		return $this->executeUpdate($sqlQuery);
	}

	public function queryByCedula($value){
		$sql = 'SELECT * FROM denuncias WHERE cedula = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->getList($sqlQuery);
	}

	public function queryByNumeroDenuncia($value){
		$sql = 'SELECT * FROM denuncias WHERE numero_denuncia = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByNumeroPatronal($value){
		$sql = 'SELECT * FROM denuncias WHERE numero_patronal = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByMotivoDenuncia($value){
		$sql = 'SELECT * FROM denuncias WHERE motivo_denuncia = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByEstatusDenuncia($value){
		$sql = 'SELECT * FROM denuncias WHERE estatus_denuncia = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByFechaDenuncia($value){
		$sql = 'SELECT * FROM denuncias WHERE fecha_denuncia = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}


	public function deleteByCedula($value){
		$sql = 'DELETE FROM denuncias WHERE cedula = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByNumeroDenuncia($value){
		$sql = 'DELETE FROM denuncias WHERE numero_denuncia = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByNumeroPatronal($value){
		$sql = 'DELETE FROM denuncias WHERE numero_patronal = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByMotivoDenuncia($value){
		$sql = 'DELETE FROM denuncias WHERE motivo_denuncia = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByEstatusDenuncia($value){
		$sql = 'DELETE FROM denuncias WHERE estatus_denuncia = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByFechaDenuncia($value){
		$sql = 'DELETE FROM denuncias WHERE fecha_denuncia = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}


	
	/**
	 * Read row
	 *
	 * @return DenunciasMySql 
	 */
	protected function readRow($row){
		$denuncia = new Denuncia();
		
		$denuncia->idDenuncia = $row['id_denuncia'];
		$denuncia->cedula = $row['cedula'];
		$denuncia->numeroDenuncia = $row['numero_denuncia'];
		$denuncia->numeroPatronal = $row['numero_patronal'];
		$denuncia->motivoDenuncia = $row['motivo_denuncia'];
		$denuncia->estatusDenuncia = $row['estatus_denuncia'];
		$denuncia->fechaDenuncia = $row['fecha_denuncia'];

		return $denuncia;
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
	 * @return DenunciasMySql 
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