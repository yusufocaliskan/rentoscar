<?php
if(!defined('OSCAR_RENT_A_CAR')) exit('<pre>Permission error! Please Go away :) </pre>');


require '../configs/gn_config.php';
require ROOTPATH . 'apps/debug.php';
require ROOTPATH . 'apps/database.php';
require ROOTPATH . 'libs/rentOscarData.php';

class saveDataToDatabase
{

	# Database Bağlantısı
	public $DB;

	# Oscar Query
	public $oscar;

	public function __construct()
	{
		#Oscar Data
		$this->oscar 	= new rentOscarData();

		$this->DB 	= new database();

	}

	/**
	 * Location'ları database'ye ekle.
	 * @return void
	 */
	public function saveLocations()
	{
		# Location'ları al
		//$locations = $this->oscar->getLocations();

		# Hata Sayıcı
		$errorCount  = 0;
		try {

			$insert = $this->DB->prepare("
				SELECT * FROM locations

			");

			$insert->execute();

				debug::pre($insert->fetchAll(PDO::FETCH_OBJ));

		} catch (PDOException $e) {
			echo $e->getMessage();
		}


		//debug::pre($locations);
		exit;

		#For Döngüsünü oluştur.
		for($i = 0; $i <= count($locations->doldurlokasyonResult->CLALOKASYON); $i++)
		{

			# İndis varsa eklemeye çalış
			if(isset($locations->doldurlokasyonResult->CLALOKASYON[$i]))
			{

				# Ekle
				$insert->execute(array(
					 $locations->doldurlokasyonResult->CLALOKASYON[$i]->pkey,
					 $locations->doldurlokasyonResult->CLALOKASYON[$i]->lokasyonad
				));

				# Eklenmediyse hata ver
				if(!$insert->rowCount())
				{
					$errorCount++;
				}

			}


		}

		echo $errorCount . " Tane Hata Var!";

	}

	public function saveCars()
	{

	}

	public function saveExtras()
	{

	}

}

$data = new saveDataToDatabase();
$data->saveLocations();