<?php
if(!defined('OSCAR_RENT_A_CAR')) exit('<pre>Permission error! Please Go away :) </pre>');

class index_model extends model{

	/**
	 * Tüm arabaları listeler
	 * @return object
	 */
	public function getAllCars()
	{
		echo 'SELAM';
		$select = $this->DB->prepare('SELECT * FROM cars');
		$select->execute();
		return $select;
	}

}