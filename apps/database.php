<?php
if(!defined('OSCAR_RENT_A_CAR')) exit('<pre>Permission error! Please Go away :) </pre>');

class database extends PDO
{
	#Database bağlantısını tutar
	public $DB;

	/**
	 * Database bağlantısını başlatır
	 */
	public function __construct()
	{
		global $_DATABASE;
		$host = $_DATABASE['DATABASE_HOST'];
		$user = $_DATABASE['DATABASE_USER'];
		$pass = $_DATABASE['DATABASE_PASSWORD'];
		$name = $_DATABASE['DATABASE_NAME'];

		try {

			$this->DB =  PDO::__construct("mysql:host=".$host.";dbname=".$name,$user,$pass,
				array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",PDO::ATTR_PERSISTENT => true));



		} catch (PDOException $e) {
			echo 'Özgünüz şuanda hizmet veremiyoruz';
			file_put_contents(ROOTPATH.'database_error.txt', $e->getMessage()."\n", FILE_APPEND);
			exit;
		}
	}

	public function __destruct()
	{
		$this->DB = null;
	}


}