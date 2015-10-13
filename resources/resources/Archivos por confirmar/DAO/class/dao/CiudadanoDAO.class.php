<?php
/**
 * Intreface DAO
 *
 * @author: http://phpdao.com
 * @date: 2015-03-02 17:45
 */
interface CiudadanoDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @Return Ciudadano 
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
 	 * @param ciudadano primary key
 	 */
	public function delete($id_ciudadano);
	
	/**
 	 * Insert record to table
 	 *
 	 * @param Ciudadano ciudadano
 	 */
	public function insert($ciudadano);
	
	/**
 	 * Update record in table
 	 *
 	 * @param Ciudadano ciudadano
 	 */
	public function update($ciudadano);	

	/**
	 * Delete all rows
	 */
	public function clean();

	public function queryByNacionalidad($value);

	public function queryByCedula($value);

	public function queryByNombreCiudadano($value);

	public function queryByApellidoCiudadano($value);


	public function deleteByNacionalidad($value);

	public function deleteByCedula($value);

	public function deleteByNombreCiudadano($value);

	public function deleteByApellidoCiudadano($value);


}
?>