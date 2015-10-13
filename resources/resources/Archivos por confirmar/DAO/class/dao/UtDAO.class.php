<?php

interface UtDAO{

	public function load($id);

	public function queryAll();
	
	public function queryAllOrderBy($orderColumn);
	
	public function delete($id);
	
	public function insert($ut);
	
	public function update($ut);	

	public function clean();

	public function queryByInicio($value);

	public function queryByFin($value);

	public function queryByValor($value);


	public function deleteByInicio($value);

	public function deleteByFin($value);

	public function deleteByValor($value);

}
?>