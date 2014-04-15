<?php
if(!defined('OSCAR_RENT_A_CAR')) exit('<pre>Permission error! Please Go away :) </pre>');


class cars extends controller
{

    /**
     * Araç seçerken üst trafta bulunan step
     * @var boolean
     */
    public $showStep = false;

    /**
     * Aktif olan step..
     * @var integer
     */
    public $activeStep = false;
    public $doneStep = false;

    /**
     * Tüm lokasyonları Oscar'dan çeker
     * @var object
     */
    public $getLocations;

    /**
     * Location By ID
     */
    public $locationById;

    /**
     * Search Info : Yapılmış arama kaydını tutar
     */
    public $searchInfo;

    /**
     * Tüm araba markalarını tutar
     */
    public $carsMark;

    /**
     * Tüm araçları saklar
     * @var object
     */
    public $getAllCar;

    /**
     * Araçı pkey göre çeker
     */
    public $carByPkey;

    /**
     * Araç pKey'i
     * @var integer
     */
    public $carPkey;

    /**
     * Tüm araba markalarını tutar
     */
    public $allExtra;


    /**
     * Controller'a ayıt Model'i tutar.
     * @var object
     */
    public $model;

    /**
     * Basket'tı içinte tutar
     * @var object
     */
    public $BASKET,
            $extraInBasketFromDatabase;

    /**
     * Cron Kobs
     * @var object
     */
    public $cronjobCars;
    public $cronjobLocations;
    public $cronjobExtras;
    public $cronjobMarks;

    /**
     * pagination settings
     * @var mixed
     */
    public  $pagination,
            $totalItem,
            $totalPage,
            $limit,
            $show,
            $page,
            $forLimit,
            $next,
            $prev;

    #En yükse ve En düşük araba fiyatlarını verir
    public $getCarPrices;

    #Araç markalarını gruplayarak verir
    public $carMarks;

    #THEME
    public $theme;

    #ÖDEME!
    public $PAYMENT;

    /**
     * Post array'i
     * @var array
     */
    public $post;

    /**
     * Grupları listeler
     * @var object
     */
    public $groups;

    public function __construct()
    {
        parent::__construct();

        #Model
        $this->model = registry::get('model')->loadModel('cars');

        #SEPET CLASSINI ÇEK
        $this->BASKET = registry::setObject('Basket', 'libs/');

        # Sayfala
        $page               = intval( request::get('p') );
        $this->page         = empty($page) ? 1 : $page;
        $this->totalItem    = $this->model->getAllCar('','',true);
        $this->limit        = config::get('PER_PAGE');# TODO: İstenilirse Database'den çekilebilir.
        $this->totalPage    = ceil($this->totalItem/$this->limit);
        $this->page         = $page > $this->totalPage ? 1 : $page;
        $this->page         = $page < 1 ? 1 : $page;
        $this->show         = $this->page * $this->limit - $this->limit;
        $this->forLimit     = 2;
        $this->prev         = $this->page-1;
        $this->next         = $this->page+1;

        #En yüksek ve en düşük araba fiyatları
        $this->getCarPrices = $this->model->getCarPrices();

        #Araç markalarını gruplayarak verir
        $this->carMarks = $this->model->getMarkByCount();

    }

    /**
     * CAR ANASAYFA
     */
    public function home()
    {
        #Locations
        $this->getLocations = $this->model->getAllLocations();

        //Bu sayda ise sepeti,info'u ve sort'u sıfırla
        session::remove('BASKET');
        session::remove('SORT');
        session::remove('INFO');

        $this->showStep     = true;
        $this->doneStep     = array(1=>0);
        $this->activeStep   = 1;

        parent::theme('cars/home',_t('FIND_CAR'));
    }

    /**
     * ARABA SEÇME İLK STEP!
     */
    public function firstStepChooseACar()
    {
        #Locations
        $this->getLocations = $this->model->getAllLocations();


        //Grupları çek.
        $this->groups = $this->model->groups();

        $theme = 'find_car';


        #$_GET Değerlerini al
        $post = input::set(array('location'=>'n','checkbox_location'=>'n','return_location'=>'n','data_from'=>'n','time_from'=>'n','data_to'=>'n','time_to'=>'n'),true);
        extract($post = $post->pushInArray(array('location','return_location','data_from','time_from','data_to','time_to')));

        #Return Location varsa
        $returnLocation = isset($return_location) AND $return_location != 0 ? $return_location : null;

        //input::debug();

    # ************************************************************************
    # FORM KONTROLÜ
    # ************************************************************************

        //Request Var mı?
        if(helper::isPOST() OR helper::isGET())
        {

            #Lokasyon seçili mi
            if(helper::isEmpty($location))
            {
                $theme = 'home';
                error::notice('warning','Please select a location');

            }

            #Boş alan varsa hata ver
            else if(helper::isEmpty($returnLocation) ||
               helper::isEmpty($data_from) ||
               helper::isEmpty($time_from) ||
               helper::isEmpty($data_to) ||
               helper::isEmpty($time_to)
            )
            {
                $theme = 'home';
                error::notice('warning','Please fill all required.');
            }


            #Gerçerli bir tarih mi?
            else if(!helper::validDate($data_from) OR !helper::validDate($data_to))
            {
                error::notice('error','Please select a valid date');
            }

            else if(helper::isDateCorrect($data_from))
            {
                error::notice('error', 'PICK-UP DATE is not valid');
            }

            else if(helper::isDateCorrect($data_to))
            {
                error::notice('error', 'DROP-OFF DATE is not valid');
            }

            #Gelecek tarih bu başlangıç tarihinden küçük mü?
            else if( !helper::isDateToSmallerThenDateFrom($data_from, $data_to) )
            {
                error::notice('error','Drop-off connot be smaller then pic-up');
            }

            #Araç kiralama günü üçü geçiyor mu?
            #Geçiyorsa uyarı ver. En fazla 3 gün seçebileceklerini söyle
            //else if(helper::diffrenceBetweenDates($data_from,$data_to) > 3)
            //{
            //    error::notice('notice','You cannot hire a car more than 3 days');
            //}

            //Araçları en az 3 günlük oalcak.
            else if(helper::diffrenceBetweenDates($data_from,$data_to) < 3)
            {
                error::notice('notice','You cannot hire a car for less than 3 days');
            }

            else if(!helper::isEmpty($checkbox_location) AND helper::isEmpty($returnLocation))
            {
                error::notice('warning','Please select return location.');
            }

            //Her şey tamam ise Bigleri sessiona ata...
            else{


                # Araçlar
                $this->getAllCar    = $this->model->getAllCar($this->show, $this->limit);

                #Bilgileri ata
                session::set('INFO',$post);



            }

        }

        //session::debug();


        #Adımları göster
        $this->showStep = true;
        $this->doneStep = array(1=>1);
        $this->activeStep = 2;

        #Temayı göster
        parent::theme('cars/'.$theme.'',_t('FIND_CAR'));
    }

    public function restSort()
    {
        unset($_SESSION['SORT']);
        error::referer('success','Ok');
    }



    /**
     * ARABA EXTRA SEÇME İKİNCİ STEP!
     *
     * Burada araçları extra ve seçilen araç bilgileri yer alır.
     */
    public function secondStepChooseExtras($carPkey = false)
    {


        $this->carPkey = $carPkey;
       //unset($_SESSION['BASKET']);

        //session::debug();

        #Boş mu? integer mi?
        # TODO : Daha geniş önlenmler alınmalı..
        if(trim(helper::isEmpty($this->carPkey)) OR
           !trim(helper::isDigit($this->carPkey)) OR
           helper::isEmpty(session::get('INFO','location')) OR
           helper::isEmpty(session::get('INFO','data_to')) OR
           helper::isEmpty(session::get('INFO','data_from')) )
        {
            redirect::to('cars');
        }

        #Bu araba gerçekten var mı?
        #Database bak
        else if(!$this->model->carCntl($this->carPkey))
        {
            redirect::to('cars');
        }

        #Her şey tamam ise pKey'e göre araçı çek
        else{

            #extraları listele
            $this->allExtra = $this->model->listAllExtra();

            #Bilgileri Kullanmak üzere değişkene ata.
            $this->searchInfo = session::get('INFO');

            #Id'ye göre araçı çek
            $this->carByPkey = $this->model->carByPkey($this->carPkey);

            #SORT'LARI Kaldır
            session::remove('SORT');
            session::remove('INFO','sPrice');
            session::remove('price_range');

            /** =================================== | ARAÇI SEPETE EKLE | =================================== **/

               $this->BASKET->addCarToBasket($this->carPkey, $this->model);

            /** =================================== | DONANIMI EKLE | =================================== **/

                #Basket'Ta Extrayı Ekle..
                $extraId = request::get('AddExtraToBaske');
                if(request::get('AddExtraToBaske'))
                {
                    if(!helper::isDigit($extraId))
                    {

                        #Sessionu'sil
                        session::remove('','',true);

                        #Sessionlar
                        error::flash('error','Upps! What a man!');
                    }

                    $this->BASKET->addExtraToBasket(request::get('AddExtraToBaske'), $this->model);
                    redirect::to('Cars/secondStepChooseExtras/'.$this->carPkey);
                }

            /** =================================== | DONANIMI SPEETEN KALDIR | =================================== **/

                #Sepetten bir extra çıkartır
                #TODO : id'yi kontol et
                if(request::get('RemoveExtra'))
                {
                    $this->BASKET->removeItemFromBasket(request::get('RemoveExtra'),'EXTRA');
                    redirect::to('Cars/secondStepChooseExtras/'.$this->carPkey);
                }

                #Sepetteki Donanımları database'den çek.
                if(!empty($_SESSION['BASKET']['EXTRA']))
                {
                   $this->extraInBasketFromDatabase =  $this->model->getExtraByIds($_SESSION['BASKET']['EXTRA']);
                }



            //session::remove('BASKET','EXTRA');
            //session::debug();

            //debug::pre($this->carByPkey);
        }


        //Theme
        $this->showStep = true;

        $this->doneStep = array(1=>1,2=>2);
        $this->activeStep = 3;
        $this->theme = 'extras';
        $title = _t('FIND_CAR');
        parent::theme('cars/'.$this->theme,$title);
    }

    /**
     * ÖDEME YAPILIR!
     * ÖNEMLİ!
     */
    public function thirdStepReviewComplete()
    {
        //session::debug();

        #Session'daki bilgileri çek
        $this->searchInfo = session::get('INFO');

        #Araç id'si
        $this->carPkey = $_SESSION['BASKET']['CAR'][0]['itemId'];

        #Session'da var mı bu araç?
        if(helper::isEmpty(session::get('INFO','location')) OR
           helper::isEmpty(session::get('INFO','data_from')) OR
           helper::isEmpty(session::get('INFO','data_to')) OR
           helper::isEmpty($_SESSION['BASKET']['CAR'][0]['itemId'])
            )
        {
            redirect::to('cars');
        }

        #Var mı böyle bir id? 0'ra eşit mi?
        else if( helper::isEmpty($this->carPkey) OR 0 == $this->carPkey)
        {
            redirect::to('cars');
        }

        #Database'de var mı bu araç?
        else if(!$this->model->carCntl($this->carPkey))
        {
            redirect::to('cars');
        }

        #Cart'taki araç database'de var mı
        else if(!$this->model->carCntl($_SESSION['BASKET']['CAR'][0]['itemId']))
        {
            redirect::to('cars');
        }

        #Herşey yolundaysa verileri çek..
        else{


            #Database'den verileri çek
            $this->carByPkey = $this->model->carByPkey($this->carPkey);
            $post = input::set(array($_POST));

            /** =================================== | ÖDEME GERÇEKLEŞECEK! | =================================== **/

            if($_POST)
            {
                $this->PAYMENT          = registry::setObject('payment','libs/','sss');
                $this->PAYMENT->model   = registry::get('cars_model');
                $this->PAYMENT->formControl();
            }


        }

        #Theme'yı çek. Ayarları yap
        $this->showStep = true;
        $this->doneStep = array(1=>1,2=>2,3=>3);
        $this->activeStep = 4;
        html::$js = array('src'=>'mask/lib/jquery.formance.min');
        html::$js = array('src'=>'cars');
        parent::theme('cars/complete',Shipping);
    }



    /* =ARABA MARKALARI - Admin'ler Görebilir
       ========================================================================== */

    /**
     * Tüm araba markalarını listeler
     */
    public function listCarsMark()
    {
        #Login Control et.
        auth::loginControl();


        $this->carsMark = $this->model->listCarsMark();

        #Theme
        $this->theme('admin/cars/cars_marks','Tüm Markaları', true);
    }

    /**
     * Marka için resim yükler
     */
    public function markImageUpdate($carMarkId = false)
    {
        #Login Control et.
        auth::loginControl();

        #post edildi mi?
        if(!helper::isPost())
        {
            redirect::to('');
            exit;
        }

        #Değerleri al
        $name   = $_FILES['markImage']['name'];
        $tmp    = $_FILES['markImage']['tmp_name'];
        $type   = $_FILES['markImage']['type'];
        $error  = $_FILES['markImage']['error'];
        $oldImg = input::set('markOldImage')->get('markOldImage');
        $newName = md5(uniqid(mt_rand(),true)).substr($name, -4,4);

        if(helper::isEmpty($name))
        {
            error::flash('notice','Bir resim seçin','cars/listCarsMark?uploadFormId='.$carMarkId);
        }

        #resim yüklenirken hiç hata oluştu mu?
        if($error > 0)
        {
            error::flash('warning','Resim yüklenirken hata oluştu.','cars/listCarsMark?uploadFormId='.$carMarkId);
        }

        #Bu bir resim mi?
        else if(!preg_match('/\.(gif|png|jpg)$/i', $name))
        {
            error::flash('warning','Bu resim değil!','cars/listCarsMark?uploadFormId='.$carMarkId);
        }

        if(!isset($_SESSION['ERROR']))
        {

            #Upload Classını yükle
            #TODO: Resim classını geliştir.
            $upload = registry::setObject('upload','libs/');
            $upload->load($tmp);
            $upload->resize(155,80);

            #Resim Dosyaya Eklendi mi?
            if( $upload->save(DEFAULT_IMAGE_PATH.$newName) )
            {
                #Resim database'de güncellendimi?
                if($this->model->updateMarkNameOnDB($newName,$carMarkId))
                {
                    #Eski resmi sil.
                    @unlink(DEFAULT_IMAGE_PATH.$oldImg);
                    error::flash('success','Resim Yüklendi','cars/listCarsMark?uploadFormId='.$carMarkId);
                }

                else{
                    error::flash('error','Resim Yüklenmedi','cars/listCarsMark?uploadFormId='.$carMarkId);
                }

            }

            else{
                error::flash('error','Resim Yüklenmedi','cars/listCarsMark?uploadFormId='.$carMarkId);
            }

        }

    }


    /* =ARAÇ EXTRA'LARI
       ========================================================================== */
    public function listCarExtras()
    {
        #Login Control et.
        auth::loginControl();

        #extraları listele
        $this->allExtra = $this->model->listAllExtra();

        $this->theme('admin/cars/cars_extra','Araç Ekstraları',true);
    }


     /**
     * Marka için resim yükler
     */
    public function extraImageUpdate($carExtrakId = false)
    {
        #Login Control et.
        auth::loginControl();

        #post edildi mi?
        if(!$_POST)
        {
            //redirect::to('/');
        }

        #Değerleri al
        $name       = $_FILES['extraImage']['name'];
        $tmp        = $_FILES['extraImage']['tmp_name'];
        $type       = $_FILES['extraImage']['type'];
        $error      = $_FILES['extraImage']['error'];
        $oldImg     = input::set('extraOldImage')->get('extraOldImage');
        $newName    = md5(uniqid(mt_rand(),true)).substr($name, -4,4);

        if(helper::isEmpty($name))
        {
            error::flash('notice','Bir resim seçin','cars/listCarExtras?uploadFormId='.$carExtrakId.'#tableTr-'.$carExtrakId);
        }

        #resim yüklenirken hiç hata oluştu mu?
        if($error > 0)
        {
            error::flash('warning','Resim yüklenirken hata oluştu.','cars/listCarExtras?uploadFormId='.$carExtrakId.'#tableTr-'.$carExtrakId);
        }

        #Bu bir resim mi?
        else if(!preg_match('/\.(gif|png|jpg)$/i', $name))
        {
            error::flash('warning','Bu resim değil!','cars/listCarExtras?uploadFormId='.$carExtrakId.'#tableTr-'.$carExtrakId);
        }

        if(!isset($_SESSION['ERROR']))
        {

            #Upload Classını yükle
            #TODO: Resim classını geliştir.
            $upload = registry::setObject('upload','libs/');
            $upload->load($tmp);
            $upload->resize(105,130);

            #Resim Dosyaya Eklendi mi?
            if( $upload->save(DEFAULT_IMAGE_PATH.$newName) )
            {
                #Resim database'de güncellendimi?
                if($this->model->updateExtraNameOnDB($newName,$carExtrakId))
                {
                    #Eski resmi sil.
                    @unlink(DEFAULT_IMAGE_PATH.$oldImg);
                    error::flash('success','Resim Yüklendi','cars/listCarExtras?uploadFormId='.$carExtrakId.'#tableTr-'.$carExtrakId);
                }

                else{
                    error::flash('error','Resim Yüklenmedi','cars/listCarExtras?uploadFormId='.$carExtrakId.'#tableTr-'.$carExtrakId);
                }

            }

            else{
                error::flash('error','Resim Yüklenmedi','cars/listCarExtras?uploadFormId='.$carExtrakId.'#tableTr-'.$carExtrakId);
            }

        }

    }

    /** =================================== | CARS ADMIN | =================================== **/
    public function addCarToGroup()
    {
        #Login Control et.
        auth::loginControl();

        $carId = request::get('CarId');
        $groupId = request::get('GroupId');
        if(helper::isEmpty($carId) OR helper::isEmpty($groupId))
        {
             error::flash('wraning','Lütfen bir group secin.','cars/listAllCars?addCarGroup='.$carId.'#tableTr-'.$carId);
        }

        //Güncelleme Oldu mu
        else if(!$this->model->updateCarGroup($carId,$groupId))
        {
             error::flash('error','Gruba eklenmedi..','cars/listAllCars?addCarGroup='.$carId.'#tableTr-'.$carId);
        }

        else{
             error::flash('success','Eklendi','cars/listAllCars?addCarGroup='.$carId.'#tableTr-'.$carId);
        }
    }

    /** =================================== | ADD EXTRA INFO | =================================== **/

    public function addExtraInfo($extraId = false)
    {
        #Login Control et.
        auth::loginControl();

        if(helper::isEmpty($extraId))
        {
            redirect::to('');
        }

        if(!helper::isPOST())
        {
            redirect::to('');
        }

        else{

            //POST AL
            input::set(array('extraInfo'=>''));
            extract( $this->post = input::pushInArray(array('extraInfo')) );

            if(helper::isEmpty($extraInfo))
            {
                error::flash('warning','Lütfen açıklama giriniz.','cars/listCarExtras?addExtraInfo='.$extraId.'#tableTr-'.$extraId);
            }

            //Güncellendi mi
            else if($this->model->updateExtraIfo($this->post,$extraId))
            {
                error::flash('success','Güncellendi.','cars/listCarExtras?addExtraInfo='.$extraId.'#tableTr-'.$extraId);
            }
            else{
                error::flash('error','Güncellenmedi.','cars/listCarExtras?addExtraInfo='.$extraId.'#tableTr-'.$extraId);
            }
        }

    }

    public function listAllCars()
    {

        #Login Control et.
        auth::loginControl();


        //Araçları listele
        $this->getAllCar = $this->model->getAllCar();

        //Grupları lislte
        $this->groups = $this->model->groups();


        //Theme
        $this->theme('admin/cars/listAllCars','Tüm Araçlar',true);
    }

    /* =SAVE OSCAR DATA TO DATABASE!
       ========================================================================== */

    private function cronjob_saveOscarLocationsDataToDatabase()
    {
        #Login Control et.
        auth::loginControl();

        return $this->model->cronjob_saveOscarLocationsDataToDatabase();
    }

    /**
     * Tüm arabalar..
     * @return void
     */
    private function cronjob_saveOscarCarsDataToDatabase()
    {
        #Login Control et.
        auth::loginControl();
       return $this->model->cronjob_saveOscarCarsDataToDatabase();
    }

    /**
     * Tüm ekstralar.
     * @return void
     */
    private function cronjob_saveOscarCarsExtraDataToDatabase()
    {
        #Login Control et.
        auth::loginControl();
        return $this->model->cronjob_saveOscarCarsExtraDataToDatabase();
    }

    public function cronjob_saveOscarMarksDataToDatabase()
    {

        #Login Control et.
        auth::loginControl();

        return $this->model->cronjob_saveOscarMarksDataToDatabase();
    }


    /**
     * Belirtilen bir saat aralıklları ile çalıştır.
     * @return [type] [description]
     */
    public function cronJobs()
    {

        #Login Control et.
        auth::loginControl();

        #TODO : Daha sonra kaldır..
        die('Yapım aşamasında olduğu için bu bölümü kullandıramıyorum.');

        # Lokasyonları ekle
        $this->cronjobLocations = $this->cronjob_saveOscarLocationsDataToDatabase();

        #Araçları Ekle
        $this->cronjobCars      = $this->cronjob_saveOscarCarsDataToDatabase();

        #Extraları Ekle
        $this->cronjobExtras    = $this->cronjob_saveOscarCarsExtraDataToDatabase();

        #Marks
        $this->cronjobMarks     = $this->cronjob_saveOscarMarksDataToDatabase();

       $this->theme("admin/cars/cronjobs", 'Sistem Güncelleniyor...',true);

    }


}
