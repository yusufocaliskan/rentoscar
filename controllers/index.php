<?php
if(!defined('OSCAR_RENT_A_CAR')) exit('<pre>Permission error! Please Go away :) </pre>');

class index extends controller
{

    /**
     * Model Datalarını tutar
     * @var object
     */
    private $model;

    /**
     * Araç Modelini tuattar
     * @var Object
     */
    public $carsModel;

    /**
     * Tüm Lokasyonları listeler
     * @var object
     */
    public $getLocations;

    /**
     * news Model
     * @var object
     */
    public $newsModel;

    public function __construct()
    {
        parent::__construct();

        #Index Model
        $this->model = registry::get('model')->loadModel('index');

        #News Model
        $this->newsModel = registry::get('model')->loadModel('news');

        #Cars
        $this->carsModel = registry::get('model')->loadModel('cars');
    }

    public function home()
    {
        session::remove('BASKET');
        session::remove('SORT');
        session::remove('INFO');


        $this->getLocations = $this->carsModel->getAllLocations();

        #Sayfayı çağır.
        parent::theme('index/home', 'Home Page','','',array('cache'=>false));

    }



}