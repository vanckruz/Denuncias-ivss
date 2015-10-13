<?php
/**
 * Intreface DAO
 *
 * @author: http://phpdao.com
 * @date: 2015-03-02 17:45
 */
interface FiscalsystemusersDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @Return Fiscalsystemusers 
	 */
	public function load($id);

	/**
	 * Get all records from table
	 */
	public function queryAll();
	
	/**
	 * Get all records from table ordered by field
	 * @Param $orderColumn column name
	 */
	public function queryAllOrderBy($orderColumn);
	
	/**
 	 * Delete record from table
 	 * @param fiscalsystemuser primary key
 	 */
	public function delete($cedula);
	
	/**
 	 * Insert record to table
 	 *
 	 * @param Fiscalsystemusers fiscalsystemuser
 	 */
	public function insert($fiscalsystemuser);
	
	/**
 	 * Update record in table
 	 *
 	 * @param Fiscalsystemusers fiscalsystemuser
 	 */
	public function update($fiscalsystemuser);	

	/**
	 * Delete all rows
	 */
	public function clean();

	public function queryByNombre($value);

	public function queryByApellido($value);

	public function queryByCorreo($value);

	public function queryByFiscalSystemUserPass($value);


	public function deleteByNombre($value);

	public function deleteByApellido($value);

	public function deleteByCorreo($value);

	public function deleteByFiscalSystemUserPass($value);


}
?>