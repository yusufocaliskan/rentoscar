<?php
if(!defined('OSCAR_RENT_A_CAR')) exit('<pre>Permission error! Please Go away :) </pre>');


class router{



    private static $_urlPath = '';

    private static $_urlBits   = array();

    #Controller
    private static $_controller;

    #Controller Yolu
    private static $_controllerPath;

    #Default Controller
    private static $_defaultController;

    #Controller Name
    private static $_controllerName;

    #Method
    private static $_method;

    #Default Merhod
    private static $_defaultMethod;

    #Parametler
    private static $_params = array();

    /**
     * Construct..
     */
    public function __construct()
    {

        self::$_controllerPath      = Config::get('CONTROLLERS_PATH');
        self::$_defaultController   = Config::get('DEFAULT_CONTROLLER');
        self::$_defaultMethod       = Config::get('DEFAULT_METHOD');


    }


    /**
     * Gelen URL'li all
     * @return void
     */
    public static function getUrlData()
    {


        /**
         * URL Kontrol
         * @var string
         */
        $urlData            = isset($_GET['page']) ? $_GET['page'] : null;

        //Boşlukları al
        $urlData            = trim($urlData);

        //Sağdaki Slash'ları al
        $urlData            = rtrim($urlData,'/');

        #url'i temizle..
        $urlData            = filter_var($urlData, FILTER_SANITIZE_URL);

        //urlBits Değişkenine ata
        self::$_urlBits     = $urlData;

        // Slash ile explode Et.
        $data = helper::explodeData('/',$urlData);


        while( !helper::isEmpty($data) && helper::getLeng( reset( $data ) ) === 0 )
        {
           array_shift($data);
        }

        while( !helper::isEmpty($data) && strlen( end( $data ) )  === 0)
        {
            array_prop($data);
        }

        //Debug::pre($data);


        #****************************************
        # Değişkenleri tanımla
        #****************************************

        self::$_controller       = strtolower( array_shift($data) );
        self::$_controllerName   = strtolower( helper::isEmpty(self::$_controller) ? self::$_defaultController : self::$_controller );

        self::$_method           = strtolower( array_shift($data) );

        self::$_params           = $data;


        #****************************************
        # CONTROLLER
        #****************************************

        //Controller boş ise bunu default olarak gelen
        //controller'a eşitle.
        if(helper::isEmpty(self::$_controller))
        {
            self::$_controller = self::$_defaultController;
        }

        //Method boş ise bunu default olarak gelen
        //Method'a eşitle.
        if(helper::isEmpty(self::$_method))
        {
            self::$_method = self::$_defaultMethod;
        }

        //Controller'ın icinde bulunuğu dosya..
        $path = ROOTPATH.'controllers/'.self::$_controller.'.php';
        $path = strtolower($path);

        //Path var mı? Doğrumu? Okunulabiliyor mu?
        if(!is_readable($path))
        {
            error::_404();
        }


        //Controller Instance
        self::$_controller = registry::setObject( self::$_controller,  'controllers/' );



        //Class var mı? Yoksa Hta var
        //if(!class_exists( self::$_controllerName ))
        //{
            //TODO: Sayfa bulunamadı
        //    die('Çekilen Dosya içerisinde Class yok.');
        //}




        #****************************************
        # Parametreli Methodu çağır
        #****************************************

        //Parametre girilmiş mi?
        if(!helper::isEmpty(self::$_params))
        {

            //Method kontrolü yap.
            self::isMethodExists();

            //fonksiyonu çağır ve parametreleri gönder
            call_user_func_array( array( self::$_controller, self::$_method ), self::$_params);
            exit;
        }

        #****************************************
        # Method
        #****************************************

        //Parametler boş ise..
        if(helper::isEmpty(self::$_params))
        {

            //Gelen method var ise
            self::isMethodExists('Parametresiz method yok');

            call_user_func( array( self::$_controller, self::$_method ) );
            exit;
        }




    }

    /**
     * Methodun var olup olmaduğunu kontrol eder
     * @return boolean
     */
    private static function isMethodExists()
    {
        $text = 'Method Yok! - Sayfa bulunamadı hatası ver';
        $message = is_null($message) ?  $text : $message;



        if(!method_exists(self::$_controller, self::$_method))
        {
            error::_404();
        }


    }


    /**
     * Controller'ı alır
     * @return string [description]
     */
    public static function getController()
    {
        return self::$_controllerName;
    }


    /**
     * Method'u alır
     * @return [type] [description]
     */
    public static function getMethod()
    {
        return self::$_method;
    }


    /**
     * Parametreleri alır
     * @param  True  : integer $indexOf Hangi parametre alınamak isteniyorsa onun indis'ti girilir
     *         False : Tüm parametlerileri array icinde döndürür.
     * @return mixed
     */
    public static function getParam($indexOf = NULL)
    {
            return self::$_params[$indexOf];

    }


}