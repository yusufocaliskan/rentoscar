<?php
if(!defined('OSCAR_RENT_A_CAR')) exit('<pre>Permission error! Please Go away :) </pre>');

class news extends controller
{
    /**
     *Haber modülü
     * @var object
     */
    public $model;

    /**
     * Kategori Modülü
     * @var object
     */
    public $categoryModel;

    /**
     * Tüm kaategorileri listeler
     * @var object
     */
    public $allCategory;

    /**
     * Tüm haberler
     * @var object
     */
    public $allNews;

    /**
     * Haber ıd'sine göre haber alır.
     * @var object
     */
    public $newsById;

    /**
     * Haber okuma sayfası için
     * @var object
     */
    public $readNews;

    public function __construct()
    {
        parent::__construct();

        /**
         * News Modülü
         * @var object
         */
        $this->model = registry::get('model')->loadModel('news');

        /**
         * Kategori Modelü
         * @var object
         */
        $this->categoryModel = registry::get('model')->loadModel('category');
    }

    /**
     * Post edilmiş item..
     * @var string
     */
    public $post;

    public function home()
    {
        redirect::to('News/allNews');
    }

    /** =================================== | ALL NEWS | =================================== **/
    public function allNews()
    {
        #Login Control et.
        auth::loginControl();


        $this->theme('admin/news/allNews','Tüm haberler',true);
    }

    public function all()
    {

        #Login Control et.
        auth::loginControl();

        #Haberleri Çek.
        $this->allNews = $this->model->allNews('','',true);

        #THEME
        $this->theme('news/allNews','News');
    }



    /** =================================== | INSERT | =================================== **/

    /**
     * Yeni haber Ekle
     */
    public function add()
    {
        #Login Control et.
        auth::loginControl();


             #Değerleri al.
            input::set(array(
                'newsTitle'=>'',
                'newsBody'=>'',
                'newsCategory'=>'n',
                'showContent'=>'n'
            ));


            extract($this->post = input::pushInArray(array('newsTitle','newsBody','newsCategory','showContent')));

            #Post edil mi mi?
            if(helper::isPOST())
            {

                #Boş alan varmı
                if(helper::isEmpty($newsTitle))
                {
                    error::notice('warning','Bol alan bıraktınız');
                }

                #Daha önce eklendi mi
                else if($this->model->newsCtrlByContent($this->post))
                {
                    error::notice('warning','Daha önce bu haber eklenmiş.');
                }

                else if($this->model->newsCtrlByLink($this->post))
                {
                    error::notice('warning','Daha önce bu haber eklenmiş.');
                }

                #Haberi ekle..
                else if($lastNewsId = $this->model->newsInsert($this->post))
                {

                    #Resim Seçilmiş ise Ekle..
                    if(!helper::isEmpty($_FILES['newsImage']['name']))
                    {
                        #Resim Eklenmedi ise hata ver..
                        $this->setNewsImage($lastNewsId,$_FILES['newsImage']);
                    }

                    error::flash('success','Haber eklendi','News/Edit/'.$lastNewsId);

                }




            }

        $this->allCategory = $this->categoryModel->allCategory();
        $this->theme('admin/news/add','Haber Ekle',true);
    }


     /** =================================== | EDIT | =================================== **/

     /**
      * Haberi güncelle
      * @param  integer $newsId haberin id'si
      * @return void
      */
    public function edit($newsId)
    {

        #Login Control et.
        auth::loginControl();


        #Haberi çek
        $this->newsById = $this->model->getNewsById($newsId);

        #Kategorileri çek
        $this->allCategory = $this->categoryModel->allCategory();

        //debug::pre($this->newsById);

        #Post edildi ise..
        if(helper::isPost('newsTitle'))
        {

            #Değerleri al.
            input::set(array(
                'newsTitle'=>'',
                'newsBody'=>'',
                'newsCategory'=>'n',
                'showContent'=>'n'
            ));

            extract($post = input::pushInArray(array('newsTitle','newsBody','newsCategory','showContent')));
            //input::debug();
            #Boş alan var mı?
            if(helper::isEmpty($newsTitle))
            {
                error::notice('warning','Boş alan bıraktınız');
            }

            #Bu haber var mı?
            else if(!$this->model->newsCtrl($newsId))
            {
                session::remove('','',true);
                redirect::to('');
                exit;
            }

            #Haberi güncelle
            else if($this->model->updateNews($newsId,$post))
            {
                $this->setNewsImage($newsId, $_FILES['newsImage'], true, $this->newsById->newsImage);
                error::flash('success','Haber Güncellendi.','/News/Edit/'.$newsId);

            }



        }

        /**
         * Tema..
         */
        $this->theme('admin/news/edit','Haber Güncelle',true);
    }


    /** =================================== | UPDATE | =================================== **/


    /**
     * Haberin resmini ekler..
     * @param  integer $newsId haber ID'si
     * @return boolean
     */
    private function setNewsImage($newsId, $image, $update = false, $oldImage = false)
    {
        #Login Control et.
        auth::loginControl();



        $name           = $image['name'];
        $tmp_name       = $image['tmp_name'];
        $error          = $image['error'];
        $type           = $image['type'];
        $reNamed        = md5(uniqid(mt_rand(),true)).substr($name, -4,4);

        $errorMessages  = array(
            1   => 'Resim çok büyük',
            2   => 'Resim eksik yüklendi',
            3   => 'Resim yüklenmedi'
        );

        #Resim yüklenirken bir hata mı oluştu?
        if($error > 0)
        {
            error::notice('warning',$errorMessages[$error]);
        }

        #Bu bir resim mi
        else if(!preg_match('/\.(gif|png|jpg)$/i', $name))
        {
            error::notice('error', 'Bu bir resim değil.');
        }

        #Hata yok ise Resim iyükle..
        else
        {

            $upload = registry::setObject('upload','libs/');
            $upload->load($tmp_name);

            if(!$upload->save(DEFAULT_IMAGE_PATH.$reNamed))
            {
                error::notice('error','Resim yüklenemedi..');
            }

            #Resim yüklendi ise. DatabaseDe güncelle
            else{

                #database'de güncellendi mi?
                if(!$this->model->updateNewsImage($newsId,$reNamed))
                {
                    error::notice('error','Resim Veritabanına yüklenmedi.');
                }

                #Güncellendi ise.. true olarak gönder
                else{

                    if($update)
                    {
                        if(!@unlink(DEFAULT_IMAGE_PATH.$oldImage))
                        {
                            error::notice('notice','Eski Resim silinemedi');
                        }
                    }

                    error::notice('success','Resim yüklendi');
                }

            }

        }

    }




    /** =================================== | DELETE | =================================== **/

    public function delete($newsId)
    {
        #Login Control et.
        auth::loginControl();



        if(!helper::isEmpty($delete))
        {
            session::remove('','',true);
            redirect::to('/');
        }

        if($this->model->deleteNews($newsId))
        {
            error::flash('success','Haber Silindi','News/AllNews');
        }

        else {
            error::flash('error','Haber silinemedi..','News/AllNews');
        }

    }


    /**
     * Haber oku
     * @param  string $newsLink haberin linki
     * @return void
     */
    public function read($newsLink = false)
    {

        #Boş alan varmı
        if(helper::isEmpty($newsLink))
        {
            error::flash('error','Invalid URL!','');
        }

        #bu haber gerçekten var mı
        else if(!$this->model->newsControlByLink($newsLink))
        {
            error::flash('error','Invalid URL!','');
        }

        //Haber varsa tamam.. okut hgaberi...
        else {

            #Haberi çek.
            $this->readNews  = $this->model->getNewByLink($newsLink);

            #Haberin okunma sayısını 1 arttır.
            $this->model->updateNewsHit($newsLink);

            #Tüm haberleri çek
            $this->allNews = $this->model->allNews(20);

            #Theme
            $this->theme('news/read',$this->readNews->newsTitle);
        }

    }


    public function sideBar()
    {
        require ROOTPATH.'views/news/allnews_sidebar.php';
    }














}