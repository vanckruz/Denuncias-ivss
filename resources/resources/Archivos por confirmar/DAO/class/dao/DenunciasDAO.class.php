<?php
/**
 * Intreface DAO
 *
 * @author: http://phpdao.com
 * @date: 2015-03-02 17:45
 */
interface DenunciasDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @Return Denuncias 
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
 	 * @param denuncia primary key
 	 */
	public function delete($id_denuncia);
	
	/**
 	 * Insert record to table
 	 *
 	 * @param Denuncias denuncia
 	 */
	public function insert($denuncia);
	
	/**
 	 * Update record in table
 	 *
 	 * @param Denuncias denuncia
 	 */
	public function update($denuncia);	

	/**
	 * Delete all rows
	 */
	public function clean();

	public function queryByCedula($value);

	public function queryByNumeroDenuncia($value);

	public function queryByNumeroPatronal($value);

	public function queryByMotivoDenuncia($value);

	public function queryByEstatusDenuncia($value);

	public function queryByFechaDenuncia($value);


	public function deleteByCedula($value);

	public function deleteByNumeroDenuncia($value);

	public function deleteByNumeroPatronal($value);

	public function deleteByMotivoDenuncia($value);

	public function deleteByEstatusDenuncia($value);

	public function deleteByFechaDenuncia($value);


}
?>