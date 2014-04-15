<?php
if(!defined('OSCAR_RENT_A_CAR')) exit('<pre>Permission error! Please Go away :) </pre>');


class rentOscarData
{
    # Oscar'a Sorgu gönderir
    private $query;


    public function __construct()
    {
        try {

            #Oscar'a bağlan
            $this->query =  new SoapClient('http://oscar.supernova2.com/yonetim/xmlaltyapi.asmx?WSDL');

        } catch (Exception $e) {
            echo $e->getMessage();
            exit;
        }


    }

    /**
     * Tüm Lokasyonları listeler
     * @return object
     */
    public function getLocations()
    {
        $param = array('kullaniciadi' => 'navion12', 'sifre' => '12345678', 'apikey' => '37edf41edd59');
        return $this->query->doldurlokasyon($param);
    }


    /**
     * tarihe göre araç çeker
     * @param  string $date tarih
     * @return object
     */
    public function getCarsByDate($date)
    {
        $param = array('kullaniciadi'=>'navion12','sifre'=>'12345678','apikey' => '37edf41edd59','tarih'=>$date);
        return $this->query->doldurmusaitarac($param);
    }


    /**
     * Aracın kasa tipi verir..
     * @param  integer $carBoxId kasa tipi ID
     * @return string
     */
    public  function getCarBoxFindByBoxId($carBoxId)
    {
        $param = array('kullaniciadi'=>'navion12','sifre'=>'12345678','pkey '=>$carBoxId);
        debug::pre($this->query->bularackasa_kodagore($param));
    }

    public function getAllCars()
    {
        $param = array('kullaniciadi'=>'navion12','sifre'=>'12345678','apikey' => '37edf41edd59');
        return  $this->query->doldurdonanim($param);
    }

    /**
     * Tüm extraları listeler
     * @return object
     */
    public function getAllExtras()
    {
        $param = array('kullaniciadi'=>'navion12','sifre'=>'12345678','apikey' => '37edf41edd59');
        return  $this->query->doldurdonanim($param);
    }

    /**
     * Tüm araçlları detaylı olarak çek!
     * @return object
     */
    public function getAllCarsDetails()
    {
        $param = array('kullaniciadi'=>'navion12','sifre'=>'12345678','apikey' => '37edf41edd59');
        return  $this->query->dolduraracdetayli($param);
    }

    /**
     * Tüm araç markalarını listeler
     * @return object
     */
    public function getAllMarks()
    {
                $param = array('kullaniciadi'=>'navion12','sifre'=>'12345678','apikey' => '37edf41edd59');
        return  $this->query->dolduraracmarka($param);
    }



}
