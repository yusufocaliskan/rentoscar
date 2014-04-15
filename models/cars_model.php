<?php
if(!defined('OSCAR_RENT_A_CAR')) exit('<pre>Permission error! Please Go away :) </pre>');

class cars_model extends model{

	#Oscar Rent instance
	private $oscar;
	public function __construct()
	{
		parent::__construct();
		$this->oscar = registry::setObject('rentOscarData','libs/');

	}

/* =CONTROL
   ========================================================================== */

	/**
	 * Girilen lokasyon var mı yok mu diye kontrol eder.
	 * @param  integer $locationId Kontrol edilcek id
	 * @return boolean
	 */
	public function locationCtrl($locationId)
	{
		$select = $this->DB->prepare("
			SELECT
				pkey
			FROM
				locations
			WHERE
				pkey = ?
		");

		$select->execute(array($locationId));
		if($select->rowCount() > 0)
		{
			return true;
		}

		return false;
	}

	/**
	 * Araç extralarını kontrol eder.
	 * @param  integer $id extra id'si..
	 * @return boolean
	 */
	public function extrasCtrl($id)
	{

		$select = $this->DB->prepare("
			SELECT
				pkey
			FROM
				cars_extras
			WHERE
				pkey = ?
		");

		$select->execute(array($id));
		if($select->rowCount() > 0)
		{
			return true;
		}

		return false;
	}


	/**
	 * Araba kontrol'ü
	 * @param  object $data araba bilgileri
	 * @return string
	 */
	public function carCntl($pkey)
	{


		$select = $this->DB->prepare("
			SELECT *
			FROM
				cars
			WHERE
				pkey = ?

		");


		$select->execute(array($pkey));

		if($select->rowCount() > 0)
		{
			return true;
		}

		return false;

	}


	/**
	 * Araba kontrol'ü
	 * @param  object $data araba bilgileri
	 * @return string
	 */
	public function markCtrl($pkey)
	{


		$select = $this->DB->prepare("
			SELECT *
			FROM
				marka
			WHERE
				pkey = ?

		");


		$select->execute(array($pkey));

		if($select->rowCount() > 0)
		{
			return true;
		}

		return false;

	}

	/**
	 * Extra id'sine göre extranın varlığını kontrol eder
	 * @param  integer $extraId extra id'si
	 * @return boolean
	 */
	public function ctrlExtraById($extraId)
	{

		$select = $this->DB->prepare("
			SELECT
				pkey
			FROM
				cars_extras
			WHERE
				pkey = ?
		");

		$select->execute(array($extraId));
		if($select->rowCount() > 0)
		{
			return true;
		}

		return false;

	}

	/**
	 * Tüm üülkeleri listeler.
	 * @return object
	 */
	public function getAllCountries()
	{
		$select = $this->DB->prepare("
			SELECT
				*
			FROM
				countries
		");

		$select->execute();
		if($select->rowCount() > 0)
		{
			return $select->fetchAll(PDO::FETCH_OBJ);
		}
	}


	/**
	 * Girilen id'lere göre doanımları çeker
	 * @param  array $data donanım verileri
	 * @return object
	 */
	public function getExtraByIds($data)
	{
		$ids = '';
			foreach($data as $id)
			{
				$ids .= $id['itemId'].',';
			}

		$ids = rtrim($ids,',');

		$select = $this->DB->prepare("
			SELECT
					*
				FROM
					cars_extras
				WHERE
					pkey IN($ids)

		");

		$select->execute();
		if($select->rowCount() > 0)
		{
			return $select->fetchAll(PDO::FETCH_OBJ);
		}

	}

	/**
	 * Araç id'sine göre extranın varlığını kontrol eder
	 * @param  integer $CarId Car id'si
	 * @return boolean
	 */
	public function ctrlCarById($carId)
	{

		$select = $this->DB->prepare("
			SELECT
				pkey
			FROM
				cars
			WHERE
				pkey = ?
		");

		$select->execute(array($carId));
		if($select->rowCount() > 0)
		{
			return true;
		}

		return false;

	}

	/**
	 * Bir ülkeyi kontrol eder. Var mı böyle bir ülke?
	 * @param  string $contryID ülke kodu
	 * @return boolea
	 */
	public function countryCtrl($countryCode)
	{
		$select = $this->DB->prepare("
			SELECT
				country_code
			FROM
				countries
			WHERE
				country_code = ?
		");

		$select->execute(array($countryCode));

		if($select->rowCount() > 0 )
		{
			return true;
		}

		return false;
	}


/* =GET
   ========================================================================== */



   /**
    * Araç pkey'ine gör araçın bilgilerini veirr
    * @param integer araç pkey
    * @return object
    */
   public function carByPkey($pkey)
   {


   		$select = $this->DB->prepare("
			SELECT
				*
			FROM
				cars
				LEFT JOIN marka ON(marka.markaAdi = cars.markaad)
			WHERE
				cars.pkey = ?
   		");

   		$select->execute(array($pkey));

   		if($select->rowCount() > 0)
   		{
   			return $select->fetch(PDO::FETCH_OBJ);
   		}

   		return false;
   }

	/**
	 * Tüm lokasyonları göster!
	 * @return object
	 */
	public function getAllLocations()
	{
		$select = $this->DB->prepare("
			SELECT
				*
			FROM
				locations
		");

		$select->execute();
		if($select->rowCount() > 0)
		{
			return $select->fetchAll(PDO::FETCH_OBJ);
		}

		return false;
	}

	/**
	 * ID'ye göre location'ları çeker
	 * @param integer $location Location ID'si
	 * @return object / bloean
	 */
	public function locationById($locationId)
	{

		$select = $this->DB->prepare("
			SELECT
				lokasyonad
			FROM
				locations
			WHERE
				pkey = ?
		");

		$select->execute(array($locationId));

		if($select->rowCount() > 0)
		{
			return $select->fetch(PDO::FETCH_OBJ);
		}

		return false;

	}

	/**
	 * Tüm araçları listeler!
	 * @return object
	 */
	public function getAllCar($show = false, $limit = false, $returnRowCount = false,$columName = false)
	{

		$columName = $columName ? $columName : 'cars';

		# Araç markalarına göre listele
		if($_POST['manufacturers'])
		{
			$getCarMark 		= input::set($_POST)->get('manufacturers');

			session::set('SORT',array('manufacturers'=>$getCarMark));
		}

		$carMark 		  	= $getCarMark == ''
							? session::get('SORT','manufacturers')
							: $getCarMark;


		if( !empty($carMark) )
		{

			$implodeCarMark	  	= !empty($carMark) ? implode("','", $carMark) : null;
			#Sorgu oluşturuluyor
			$carMarkSQL 		= !empty($carMark) ?  " AND markaad IN('".$implodeCarMark."')" : null;
			//debug::pre($_SESSION);
		}



		#Sort By Price
		$price 				= request::get('sPrice');

		if(!empty($price))
		{
			$order  			= $price == 'up' ? ' ORDER BY markagunfiyatsterlin DESC' : ' ORDER BY markagunfiyatsterlin ASC';
		}

		if($_POST['price_range'])
		{

			#Fiyat Aralığı
		  	$rangeSortPost      	=  input::set('price_range')->get('price_range');
			$rangeSort 			=  $rangeSortPost == false ? session::get('SORT','rangeSort') : $rangeSortPost;

			if(!empty($rangeSort))
			{


					session::set('SORT',array('rangeSort'=>$rangeSort));


				$expRange   		= helper::explodeData(';',$rangeSort);

				#Fiyat Aralığı Sorguyu oluştur
				$rangetSort 		= $rangeSort ? 'AND marka.markagunfiyatsterlin BETWEEN '.$expRange[0].' AND '.$expRange[1].' ' : null;
			}
		}


		#sayfa
		$limit  			= $limit ? 'LIMIT '. $show.','.$limit : null;

		# Araçları Grouba göre listele
		if($_POST['byGroups'])
		{

			$getCarGroup 		= input::set($_POST)->get('byGroups');

			session::set('SORT',array('byGroups'=>$getCarGroup));
		}

		$carGroup 		  	= $getCarGroup == ''
							? session::get('SORT','byGroups')
							: $getCarGroup;

		if( !empty($carGroup) )
		{
			$implodeCarGroup	  	= !empty($carGroup) ? implode("','", $carGroup) : null;

			#Sorgu oluşturuluyor
			$carGroupSQL 		= !empty($carGroup) ?  " AND groups.groupName IN('".$implodeCarGroup."')" : null;
			//debug::pre($_SESSION);
		}

		$select = $this->DB->prepare("
			SELECT
				cars.pkey as carPkey,
				cars.markaad,
				cars.model,
				cars.modelyil,
				cars.kilometre,
				cars.tipturkcead,
				cars.tipingad,
				cars.kasaturkcead,
				cars.kasaingad,
				cars.renkturkcead,
				cars.renkingad,
				cars.yakitturkcead,
				cars.yakitingad,
				cars.vitesturkcead,
				cars.vitesingad,
				cars.car_group,
				marka.markaResim,
				marka.pkey as markaPkey,
				marka.markagunfiyatsterlin,
				groups.groupName,
				groups.groupId
			FROM
				$columName
			LEFT JOIN marka ON (marka.markaAdi = cars.markaad)
			LEFT JOIN groups ON (cars.car_group = groups.groupId)
			WHERE
				cars.pkey != 0
				$carMarkSQL
				$carGroupSQL
				$rangetSort
				$order
				$limit

		");


		//debug::pre($select);

		$select->execute();

		if($select->rowCount() > 0)
		{
			if($returnRowCount)
			{
				return $select->rowCount();
			}

			return $select->fetchAll(PDO::FETCH_OBJ);
		}

		return false;

	}

	/**
	 * Marka adını ve kaç tane arabanın olduğunu
	 * gruplayarak verir.
	 * @return object
	 */
	public function getMarkByCount()
	{
		$select = $this->DB->prepare("
			SELECT
				markaad, count(markaad) as total
			FROM
				cars
			GROUP BY markaad
			ORDER BY total DESC
		");

		$select->execute();

		return $select->fetchAll(PDO::FETCH_OBJ);
	}

	 /**
    * Aaraç gruplarını listeler
    * @return boolean
    */
   public function groups()
   {

   		$select  = $this->DB->prepare("
			SELECT
				*,
				COUNT(cars.car_group) as total
			FROM
				cars
				LEFT JOIN groups ON (groups.groupId = cars.car_group)
			WHERE
				cars.car_group = groups.groupId

			GROUP BY cars.car_group
			ORDER BY total DESC
   		");

   		$select->execute();
   		if($select->rowCount() > 0)
   		{
   			return $select->fetchAll(PDO::FETCH_OBJ);
   		}

   		return false;


   }

	/**
	 * En yüksek fiyat ve en düşük fiyatı verir.
	 * @return integer
	 */
	public function getCarPrices()
	{
		$select = $this->DB->prepare("
			SELECT
				MIN(markagunfiyatsterlin) as min,
				MAX(markagunfiyatsterlin) as max
			FROM
				cars
		");

		$select->execute();
		return $select->fetch(PDO::FETCH_OBJ);
	}

	/**
	 * Toplam araç sayısını verir
	 * @return integer araç sayısı
	 */
	public function countAllCars()
	{
		$select = $this->DB->prepare("
			SELECT
				carsId
			FROM
				cars
		");

		$select->execute();

		return $select->rowCount();
	}

	/**
	 * Tüm araç markalarını listeler
	 * @return object / boolean
	 */
	public function listCarsMark()
	{
		$select = $this->DB->prepare("
			SELECT
				*
			FROM
				marka

		");

		$select->execute();
		if($select->rowCount() > 0)
		{
			return $select->fetchAll(PDO::FETCH_OBJ);
		}

		return false;
	}

	/**
	 * Tüm araç markalarını listeler
	 * @return object / boolean
	 */
	public function listAllExtra()
	{
		$select = $this->DB->prepare("
			SELECT
				*
			FROM
				cars_extras
			ORDER BY cars_extras_id DESC

		");

		$select->execute();
		if($select->rowCount() > 0)
		{
			return $select->fetchAll(PDO::FETCH_OBJ);
		}

		return false;
	}

	/**
	 * ID'ye göre doannımı verir
	 * @param  integer $extraId donanım id'si
	 * @return object
	 */
	public function getExtraById($extraId)
	{
		$select = $this->DB->prepare("
			SELECT
				sterlinfiyat,
				tlfiyat,
				donanimingad
			FROM
				cars_extras
			WHERE
				pkey = ?
		");

		$select->execute(array($extraId));
		if($select->rowCount() > 0)
		{
			return $select->fetch(PDO::FETCH_OBJ);
		}


		return false;

	}


/* =UPDATE
   ========================================================================== */

   /**
    * Aaraç group günceller.
    * @param  integer $carId   araç ID'si
    * @param  integer $groupId Group ID'si
    * @return boolean
    */
   public function updateCarGroup($carId, $groupId)
   {

   		$update = $this->DB->prepare("
			UPDATE
				cars
			SET
				car_group = ?
			WHERE
				pkey = ?
   		");

   		$update->execute(array($groupId, $carId));
   		if($update->rowCount() > 0)
   		{

   			return true;
   		}

   		return false;

   }


   /**
    * Güncelleme başarılı oldu.
    * @param  array $data    extra açıklaması
    * @param  integer $extraId extra id'si
    * @return boolean
    */
   public function updateExtraIfo($data,$extraId)
   {
   		extract($data);

   		debug::pre($data);

   		$update = $this->DB->prepare("
			UPDATE
				cars_extras
			SET
				extraInfo = ?
			WHERE
				cars_extras_id = ?
   		");

   		$update->execute(array($extraInfo, $extraId));
   		if($update)
   		{
   			return true;
   		}

   		return false;
   }

   /**
    * Markaya ayıt resim'sini günceller
    *
    * @param string $imageName resim adı
    * @param string $markId Markanın id'si
    * @return boolean
    */
   public function updateMarkNameOnDB($imageName, $markId)
   {

   		$update = $this->DB->prepare("
			UPDATE
				marka
			SET
				markaResim = ?
			WHERE
				markaId = ?
   		");

   		$update->execute(array($imageName,$markId));
   		if($update->rowCount() > 0)
   		{
   			return true;
   		}

   		return false;
   }

    /**
    * Extraya ayıt resim'sini günceller
    *
    * @param string $imageName resim adı
    * @param string $markId Markanın id'si
    * @return boolean
    */
   public function updateExtraNameOnDB($imageName, $extraId)
   {

   		$update = $this->DB->prepare("
			UPDATE
				cars_extras
			SET
				extraImage = ?
			WHERE
				cars_extras_id = ?
   		");

   		$update->execute(array($imageName,$extraId));
   		if($update->rowCount() > 0)
   		{
   			return true;
   		}

   		return false;
   }

/* =CRON JOBS! ÖNEMLİ! IMPORTANT BEA! :)
   ========================================================================== */

   /** =================================== | OSCAR MARKALAR | =================================== **/
		public function cronjob_saveOscarMarksDataToDatabase()
		{

			$marks 					= $this->oscar->getAllMarks()->dolduraracmarkaResult->CLAARACMARKA;
			$count 	   				= count($marks);
			//debug::pre($marks);
			//exit;
			$updateErrorCountOK 	= 0;
			$updateErrorCountERROR 	= 0;
			$insertErrorCountOK 	= 0;
			$insertErrorCountERROR 	= 0;


			#For
			for($i = 0; $i <= $count; $i++)
			{

				# Bu indist var mı?
				if(isset($marks[$i]))
				{

					# Daha önce var mı database'de? Yok ise ekleme işlemini yap.
					if(!$this->markCtrl($marks[$i]->pkey))
					{
						$insert = $this->cronjob_insertOscarMarksDataToDatabase(
							$marks[$i]->pkey,
							$marks[$i]->markaad,
							$marks[$i]->markagunfiyatsterlin,
							$marks[$i]->markagunfiyatsterlin
						);

						if($insert)
						{
							$insertErrorCountOK++;
						}
						else{
							$insertErrorCountERROR++;
						}
					}

					#Bu bilgiler zaten databasede varsa güncellemelerini yap
					else{

						$update = $this->cronjob_updateOscarMarksDataToDatabase(
							$marks[$i]->pkey,
							$marks[$i]->markaad,
							$marks[$i]->markagunfiyatsterlin,
							$marks[$i]->markagunfiyatsterlin
						);

						if($update)
						{
							$updateErrorCountOK++;
						}
						else{
							$updateErrorCountERROR++;
						}



					}
				}
			}

			#response
			return array('updateOK'=>$updateErrorCountOK,
						 'updateERROR'=>$updateErrorCountERROR,
						 'insertOK'=>$insertErrorCountOK,
						 'insertERROR'=>$insertErrorCountERROR
						);


		}

			private function cronjob_insertOscarMarksDataToDatabase($pkey, $markaad, $markagunfiyatsterlin, $markagunfiyatsterlin)
			{
				//echo "$pkey, $markaad, $markagunfiyatsterlin, $markagunfiyatsterlin <br>";

				$insert = $this->DB->prepare("
					INSERT INTO
						marka
					SET
						pkey = ?,
						markaAdi = ?,
						markagunfiyatsterlin = ?,
						markagunfiyatsterlin = ?
				");

				$insert->execute(array(
							$pkey,
							$markaad,
							$markagunfiyatsterlin,
							$markagunfiyatsterlin
				));

				if($insert->rowCount() > 0)
				{
					return true;
				}

				return false;


			}

			private function cronjob_updateOscarMarksDataToDatabase($pkey, $markaad, $markagunfiyatsterlin, $markagunfiyatsterlin)
			{

				$update = $this->DB->prepare("
					UPDATE
						marka
					SET
						markaAdi = ?,
						markagunfiyatsterlin = ?,
						markagunfiyatsterlin = ?
					WHERE
						pkey = ?
				");

				$update->execute(array(
							$markaad,
							$markagunfiyatsterlin,
							$markagunfiyatsterlin,
							$pkey
				));

				if($update)
				{
					return true;
				}

				return false;
			}





   /** =================================== | OSCAR LOCATIION | =================================== **/

		/**
		 * Oscar'dan tüm verileri alır ve database'ye kaydeder.
		 *  TODO: Günün belirli saatlerinde çalışması lazım.
		 *  TODO: HATALARI EMAIL'E GÖNDER!
		 *
		 * @return void
		 */
		public function cronjob_saveOscarLocationsDataToDatabase()
		{

			$locations = $this->oscar->getLocations();
			$count 	   = count($locations->doldurlokasyonResult->CLALOKASYON);
			$updateErrorCountOK = 0;
			$updateErrorCountERROR = 0;
			$insertErrorCountOK = 0;
			$insertErrorCountERROR = 0;


			#For
			for($i = 0; $i <= $count; $i++)
			{
				# Bu indist var mı?
				if(isset($locations->doldurlokasyonResult->CLALOKASYON[$i]))
				{

					# Daha önce var mı database'de? Yok ise ekleme işlemini yap.
					if(!$this->locationCtrl($locations->doldurlokasyonResult->CLALOKASYON[$i]->pkey))
					{
						$insert = $this->cronjob_insertOscarLocationsDataToDatabase(
							$locations->doldurlokasyonResult->CLALOKASYON[$i]->pkey,
							$locations->doldurlokasyonResult->CLALOKASYON[$i]->lokasyonad
						);

						if($insert)
						{
							$insertErrorCountOK++;
						}
						else{
							$insertErrorCountERROR++;
						}
					}

					#Bu bilgiler zaten databasede varsa güncellemelerini yap
					else{

						$update = $this->cronjob_updateOscarLocationsDataToDatabase(
							$locations->doldurlokasyonResult->CLALOKASYON[$i]->pkey,
							$locations->doldurlokasyonResult->CLALOKASYON[$i]->lokasyonad
						);

						if($update)
						{
							$updateErrorCountOK++;
						}
						else{
							$updateErrorCountERROR++;
						}



					}
				}
			}

			#response
			return array('updateOK'=>$updateErrorCountOK,
						 'updateERROR'=>$updateErrorCountERROR,
						 'insertOK'=>$insertErrorCountOK,
						 'insertERROR'=>$insertErrorCountERROR
						);


		}

			private function cronjob_insertOscarLocationsDataToDatabase($pkey, $lokasyonad)
			{

				$insert = $this->DB->prepare("
					INSERT INTO
						locations
					SET
						pkey = ?,
						lokasyonad = ?
				");

				$insert->execute(array(
					$pkey,
					$lokasyonad
				));

				if($insert->rowCount() > 0)
				{
					return true;
				}

				return false;


			}


			private function cronjob_updateOscarLocationsDataToDatabase($pkey, $lokasyonad)
			{

				$update = $this->DB->prepare("
					UPDATE
						locations
					SET
						lokasyonad = ?
					WHERE
						pkey = ?
				");

				$update->execute(array(
					$lokasyonad,
					$pkey
				));

				if($update)
				{
					return true;
				}

				return false;


			}

	/** =================================== | OSCAR EXTRAS  | =================================== **/

		/**
		 * Araba ekstralarını database ekler.
		 *  TODO: HATALARI EMAIL'E GÖNDER!
		 * @return void
		 */
		public function cronjob_saveOscarCarsExtraDataToDatabase()
		{

			$extras = $this->oscar->getAllExtras()->doldurdonanimResult->CLADONANIM;
			//debug::pre($extras);
			//exit;
			$count  = count($extras);
			$insertErrorCountOK = 0;
			$insertErrorCountERROR = 0;
			$updateErrorCountOK = 0;
			$updateErrorCountERROR = 0;

			# For
			for($i = 0; $i <= $count; $i++)
			{
				# Index var mı?
				if(isset($extras[$i]))
				{

					#Database'de yok ise ekle..
					if(!$this->extrasCtrl($extras[$i]->pkey))
					{

						$insert = $this->cronjob_insertOscarCarExtraToDatabase(
							$extras[$i]->pkey,
							$extras[$i]->donanimturkcead,
							$extras[$i]->donanimingad,
							$extras[$i]->tlfiyat,
							$extras[$i]->sterlinfiyat,
							$extras[$i]->dolarfiyat,
							$extras[$i]->eurofiyat
						);

						if($insert)
						{
							//TODO: HATALARI EMAIL ILE GONDER!
							$insertErrorCountOK++;
						}

						else{
							$insertErrorCountERROR++;
						}

					}

					#Database'de var ise update et
					else{

						$update = $this->cronjob_updateOscarCarsExtraToDatabase(
							$extras[$i]->pkey,
							$extras[$i]->donanimturkcead,
							$extras[$i]->donanimingad,
							$extras[$i]->tlfiyat,
							$extras[$i]->sterlinfiyat,
							$extras[$i]->dolarfiyat,
							$extras[$i]->eurofiyat
						);


						if($update)
						{
							//TODO: HATALARI EMAIL ILE GONDER!
							$updateErrorCountOK++;
						}

						else{
							$updateErrorCountERROR++;
						}

					}
				}

			}

		return array('updateOK'=>$updateErrorCountOK,
					 'updateERROR'=>$updateErrorCountERROR,
					 'insertOK'=>$insertErrorCountOK,
					 'insertERROR'=>$insertErrorCountERROR
					 );


		}

		/**
		 * Extraları ekler
		 * @return
		 */
		private function cronjob_insertOscarCarExtraToDatabase($pkey, $donanimturkcead, $donanimingad, $tlfiyat, $sterlinfiyat, $dolarfiyat, $eurofiyat)
		{
			$insert = $this->DB->prepare("
							INSERT INTO
								cars_extras
							SET
					    		pkey = ?,
					            donanimturkcead = ?,
					            donanimingad = ?,
					            tlfiyat = ?,
					            sterlinfiyat = ?,
					            dolarfiyat = ?,
					            eurofiyat = ?

						");

						$insert->execute(array(
							$pkey,
							$donanimturkcead,
							$donanimingad,
							$tlfiyat,
							$sterlinfiyat,
							$dolarfiyat,
							$eurofiyat

						));

						if($insert->rowCount() > 0)
						{
							return true;
						}

						return false;
		}

		/**
		 * Extraları günceller
		 * @return
		 */
		private function cronjob_updateOscarCarsExtraToDatabase($pkey, $donanimturkcead, $donanimingad, $tlfiyat, $sterlinfiyat, $dolarfiyat, $eurofiyat)
		{
			$update = $this->DB->prepare("
							UPDATE
								cars_extras
							SET
					            donanimturkcead = ?,
					            donanimingad = ?,
					            tlfiyat = ?,
					            sterlinfiyat = ?,
					            dolarfiyat = ?,
					            eurofiyat = ?

					        WHERE
					        	pkey = ?

						");

						$update->execute(array(
							$donanimturkcead,
							$donanimingad,
							$tlfiyat,
							$sterlinfiyat,
							$dolarfiyat,
							$eurofiyat,
							$pkey

						));

						if($update)
						{
							return true;
						}

						return false;
		}

	/** =================================== | OSCAR CARS | =================================== **/

		/**
		 * Oscar'daki tüm arabaları database'ye kaydeder.
		 * 	- Belli aralıklar iile çalışması lazım
		 *  TODO: HATALARI EMAIL'E GÖNDER!
		 * @return void
		 */
		public function cronjob_saveOscarCarsDataToDatabase()
		{
			try {



			$cars 				= $this->oscar->getAllCarsDetails()->dolduraracdetayliResult->CLAARACDETAY;
			$count 				= count($cars);
			$updateErrorCountOK 		= 0;
			$updateErrorCountERROR 		= 0;
			$insertErrorCountOK 		= 0;
			$insertErrorCountERROR 		= 0;



			#for..
			for($i = 0; $i <= $count; $i++)
			{
				#array içinde var mı
				if(isset($cars[$i]))
				{

					#bu araç ekli mi? Değil ise ekle
					$carControl = $this->carCntl($cars[$i]->pkey);

					if(!$carControl)
					{

						$insert = $this->cronjob_insertOscarCarsDataToDatabase(
								$cars[$i]->pkey,
								$cars[$i]->markaad,
								$cars[$i]->markagunfiyatsterlin,
								$cars[$i]->markagunfiyatsterlin,
								$cars[$i]->model,
								$cars[$i]->modelyil,
								$cars[$i]->kilometre,
								$cars[$i]->tipturkcead,
								$cars[$i]->tipingad,
								$cars[$i]->kasaturkcead,
								$cars[$i]->kasaingad,
								$cars[$i]->renkturkcead,
								$cars[$i]->renkingad,
								$cars[$i]->yakitturkcead,
								$cars[$i]->yakitingad,
								$cars[$i]->vitesturkcead,
								$cars[$i]->vitesingad
						);

						if($insert)
						{
							//TODO: Hataları email olarak gönder!
							$insertErrorCountOK++;
						}

						else{

							$insertErrorCountERROR++;
						}


					}

					//Ekli ise güncelle
					else{

						//Güncelle
						$update = $this->cronjob_updateOscarCarsDataToDatabase(
								$cars[$i]->pkey,
								$cars[$i]->markaad,
								$cars[$i]->markagunfiyatsterlin,
								$cars[$i]->markagunfiyatsterlin,
								$cars[$i]->model,
								$cars[$i]->modelyil,
								$cars[$i]->kilometre,
								$cars[$i]->tipturkcead,
								$cars[$i]->tipingad,
								$cars[$i]->kasaturkcead,
								$cars[$i]->kasaingad,
								$cars[$i]->renkturkcead,
								$cars[$i]->renkingad,
								$cars[$i]->yakitturkcead,
								$cars[$i]->yakitingad,
								$cars[$i]->vitesturkcead,
								$cars[$i]->vitesingad
						);


						//Güncelleme hatalı mı?
						if($update)
						{
							//TODO: Hataları email olarak gönder!
							$updateErrorCountOK++;
						}
						else{

							$updateErrorCountERROR++;
						}


					}

				}

			}
			} catch (PDOException $e) {
				echo $e->getMessage();
			}

			return array('updateOK'=>$updateErrorCountOK,
						 'updateERROR'=>$updateErrorCountERROR,
					 	 'insertOK'=>$insertErrorCountOK,
			 			 'insertERROR'=>$insertErrorCountERROR
			 			);





		}

		##ARabaları ekler
		private function cronjob_insertOscarCarsDataToDatabase($pkey,$markaad,$markagunfiyatsterlin,$markagunfiyatsterlin,$model,$modelyil,$kilometre,$tipturkcead,$tipingad,$kasaturkcead,$kasaingad,$renkturkcead,$renkingad,$yakitturkcead,$yakitingad,$vitesturkcead,$vitesingad)
		{



			$insert = $this->DB->prepare("
				INSERT INTO
					cars
				SET
					pkey = ?,
					markaad = ?,
					markagunfiyatsterlin = ?,
					markagunfiyatsterlin = ?,
					model = ?,
					modelyil = ?,
					kilometre = ?,
					tipturkcead = ?,
					tipingad = ?,
					kasaturkcead = ?,
					kasaingad = ?,
					renkturkcead  = ?,
					renkingad = ?,
					yakitturkcead = ?,
					yakitingad = ?,
					vitesturkcead = ?,
					vitesingad = ?

			");

			$insert->execute(array(
				$pkey,
				$markaad,
				$markagunfiyatsterlin,
				$markagunfiyatsterlin,
				$model,
				$modelyil,
				$kilometre,
				$tipturkcead,
				$tipingad,
				$kasaturkcead,
				$kasaingad,
				$renkturkcead,
				$renkingad,
				$yakitturkcead,
				$yakitingad,
				$vitesturkcead,
				$vitesingad
			));

			if($insert->rowCount() > 0)
			{
				//TODO: Hataları email olarak gönder!
				return true;
			}

			return false;
			//redirect::to('');

		}


		#Araç güncelle
		private function cronjob_updateOscarCarsDataToDatabase($pkey,$markaad,$markagunfiyatsterlin,$markagunfiyatsterlin,$model,$modelyil,$kilometre,$tipturkcead,$tipingad,$kasaturkcead,$kasaingad,$renkturkcead,$renkingad,$yakitturkcead,$yakitingad,$vitesturkcead,$vitesingad)
		{



			$update = $this->DB->prepare("
				UPDATE
					cars
				SET
					markaad = :markaad,
					markagunfiyatsterlin = :markagunfiyatsterlin,
					markagunfiyatsterlin = :markagunfiyatsterlin,
					model = :model,
					modelyil = :modelyil,
					kilometre = :kilometre,
					tipturkcead = :tipturkcead,
					tipingad = :tipingad,
					kasaturkcead = :kasaturkcead,
					kasaingad = :kasaingad,
					renkturkcead  = :renkturkcead ,
					renkingad = :renkingad,
					yakitturkcead = :yakitturkcead,
					yakitingad = :yakitingad,
					vitesturkcead = :vitesturkcead,
					vitesingad = :vitesingad
				WHERE
					pkey = :pkey

			");

			$update->execute(array(
				'markaad'=>$markaad,
				'markagunfiyatsterlin'=>$markagunfiyatsterlin,
				'markagunfiyatsterlin'=>$markagunfiyatsterlin,
				'model'=>$model,
				'modelyil'=>$modelyil,
				'kilometre'=>$kilometre,
				'tipturkcead'=>$tipturkcead,
				'tipingad'=>$tipingad,
				'kasaturkcead'=>$kasaturkcead,
				'kasaingad'=>$kasaingad,
				'renkturkcead'=>$renkturkcead,
				'renkingad'=>$renkingad,
				'yakitturkcead'=>$yakitturkcead,
				'yakitingad'=>$yakitingad,
				'vitesturkcead'=>$vitesturkcead,
				'vitesingad'=>$vitesingad,
				'pkey'=>$pkey
			));

			if($update)
			{
				//TODO: Hataları email olarak gönder!
				return true;
			}

			return false;
			//redirect::to('');

		}











}//Class