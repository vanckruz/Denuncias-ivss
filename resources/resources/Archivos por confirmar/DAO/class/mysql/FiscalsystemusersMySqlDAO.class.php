<?php
/**
 * Class that operate on table 'fiscalsystemusers'. Database Mysql.
 *
 * @author: http://phpdao.com
 * @date: 2015-03-02 17:45
 */
class FiscalsystemusersMySqlDAO implements FiscalsystemusersDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @return FiscalsystemusersMySql 
	 */
	public function load($id){
		$sql = 'SELECT * FROM fiscalsystemusers WHERE cedula = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($id);
		return $this->getRow($sqlQuery);
	}

	/**
	 * Get all records from table
	 */
	public function queryAll(){
		$sql = 'SELECT * FROM fiscalsystemusers';
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
	 * Get all records from table ordered by field
	 *
	 * @param $orderColumn column name
	 */
	public function queryAllOrderBy($orderColumn){
		$sql = 'SELECT * FROM fiscalsystemusers ORDER BY '.$orderColumn;
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
 	 * Delete record from table
 	 * @param fiscalsystemuser primary key
 	 */
	public function delete($cedula){
		$sql = 'DELETE FROM fiscalsystemusers WHERE cedula = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($cedula);
		return $this->executeUpdate($sqlQuery);
	}
	
	/**
 	 * Insert record to table
 	 *
 	 * @param FiscalsystemusersMySql fiscalsystemuser
 	 */
	public function insert($fiscalsystemuser){
		$sql = 'INSERT INTO fiscalsystemusers (nombre, apellido, correo, fiscalSystemUserPass) VALUES (?, ?, ?, ?)';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->set($fiscalsystemuser->nombre);
		$sqlQuery->set($fiscalsystemuser->apellido);
		$sqlQuery->set($fiscalsystemuser->correo);
		$sqlQuery->set($fiscalsystemuser->fiscalSystemUserPass);

		$id = $this->executeInsert($sqlQuery);	
		$fiscalsystemuser->cedula = $id;
		return $id;
	}
	
	/**
 	 * Update record in table
 	 *
 	 * @param FiscalsystemusersMySql fiscalsystemuser
 	 */
	public function update($fiscalsystemuser){
		$sql = 'UPDATE fiscalsystemusers SET nombre = ?, apellido = ?, correo = ?, fiscalSystemUserPass = ? WHERE cedula = ?';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->set($fiscalsystemuser->nombre);
		$sqlQuery->set($fiscalsystemuser->apellido);
		$sqlQuery->set($fiscalsystemuser->correo);
		$sqlQuery->set($fiscalsystemuser->fiscalSystemUserPass);

		$sqlQuery->setNumber($fiscalsystemuser->cedula);
		return $this->executeUpdate($sqlQuery);
	}

	/**
 	 * Delete all rows
 	 */
	public function clean(){
		$sql = 'DELETE FROM fiscalsystemusers';
		$sqlQuery = new SqlQuery($sql);
		return $this->executeUpdate($sqlQuery);
	}

	public function queryByNombre($value){
		$sql = 'SELECT * FROM fiscalsystemusers WHERE nombre = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByApellido($value){
		$sql = 'SELECT * FROM fiscalsystemusers WHERE apellido = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByCorreo($value){
		$sql = 'SELECT * FROM fiscalsystemusers WHERE correo = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByFiscalSystemUserPass($value){
		$sql = 'SELECT * FROM fiscalsystemusers WHERE fiscalSystemUserPass = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}


	public function deleteByNombre($value){
		$sql = 'DELETE FROM fiscalsystemusers WHERE nombre = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByApellido($value){
		$sql = 'DELETE FROM fiscalsystemusers WHERE apellido = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByCorreo($value){
		$sql = 'DELETE FROM fiscalsystemusers WHERE correo = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByFiscalSystemUserPass($value){
		$sql = 'DELETE FROM fiscalsystemusers WHERE fiscalSystemUserPass = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}


	
	/**
	 * Read row
	 *
	 * @return FiscalsystemusersMySql 
	 */
	protected function readRow($row){
		$fiscalsystemuser = new Fiscalsystemuser();
		
		$fiscalsystemuser->cedula = $row['cedula'];
		$fiscalsystemuser->nombre = $row['nombre'];
		$fiscalsystemuser->apellido = $row['apellido'];
		$fiscalsystemuser->correo = $row['correo'];
		$fiscalsystemuser->fiscalSystemUserPass = $row['fiscalSystemUserPass'];

		return $fiscalsystemuser;
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
	 * @return FiscalsystemusersMySql 
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