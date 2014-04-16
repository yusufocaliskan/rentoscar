<?php
if(!defined('OSCAR_RENT_A_CAR')) exit('<pre>Permission error! Please Go away :) </pre>');

class page extends controller
{
    /**
     *Sayfa modülü
     * @var object
     */
    public $model;

    /**
     * Tüm Sayfaler
     * @var object
     */
    public $allPages;

    /**
     * Sayfa ıd'sine göre Sayfa alır.
     * @var object
     */
    public $pageById;

    /**
     * Post elementini tutar
     * @var array
     */
    public $post;

    /**
     * Sayfa detaylari
     * @var object
     */
    public $pageDetail;


    /**
     * Post edilmiş item..
     * @var string
     */
    public function __construct()
    {
        parent::__construct();

        /**
         * pages Modülü
         * @var object
         */
        $this->model = registry::get('model')->loadModel('page');

        #Tüm Sayfalar
        $this->allPages = $this->model->allPages();


    }


    /**
     * Sayfalar ana sayfa
     * @return void
     */
    public function home()
    {
        redirect::to('page/allPages');
    }

    /** =================================== | ALL pages | =================================== **/
    public function allPages()
    {
        $this->theme('admin/page/allPages','Tüm Sayfaler',true);
    }



    /** =================================== | INSERT | =================================== **/

    /**
     * Yeni Sayfa Ekle
     */
    public function add()
    {

      #Login Control et.
        auth::loginControl();



             #Değerleri al.
            input::set(array(
                'pageTitle'=>'',
                'pageBody'=>'',
                'pageParent'=>'n',
                'pageLink'=>'',
                'sideBar'=>'n'
            ));


            extract($this->post = input::pushInArray(array('pageTitle','pageBody','pageParent','pageLink','sideBar')));

            #Post edil mi mi?
            if(helper::isPost())
            {

                #Boş alan varmı
                if(helper::isEmpty($pageTitle))
                {
                    error::notice('warning','Bol alan bıraktınız');
                }

                #Daha önce eklendi mi
                else if($this->model->pageCtrlByContent($this->post))
                {
                    error::notice('warning','Daha önce bu Sayfa eklenmiş.');
                }

                #Sayfai ekle..
                else if($lastPageId = $this->model->pageInsert($this->post))
                {

                    error::flash('success','Sayfa eklendi','Page/Edit/'.$lastPageId);

                }




            }

        $this->theme('admin/page/add','Sayfa Ekle',true);
    }



    /** =================================== | UPDATE | =================================== **/


     /**
      * Sayfai güncelle
      * @param  integer $pagesId Sayfain id'si
      * @return void
      */
    public function edit($pageId)
    {

      #Login Control et.
        auth::loginControl();


        #Sayfai çek
        $this->pageById = $this->model->getPageById($pageId);

        #Kategorileri çek
        //$this->allCategory = $this->categoryModel->allCategory();

        //debug::pre($this->pageById);

        #Post edildi ise..
        if(helper::isPost())
        {

            #Değerleri al.
            input::set(array(
                'pageTitle'=>'',
                'pageBody'=>'',
                'pageParent'=>'n',
                'pageLink'=>'',
                'sideBar'=>'n',
                'pageOrder'=>'n'

            ));

            extract($post = input::pushInArray(array('pageTitle','pageBody','pageParent','pageLink','sideBar','pageOrder')));


            #Boş alan var mı?
            if(helper::isEmpty($pageTitle))
            {
                error::notice('warning','Boş alan bıraktınız');
            }

            #Bu Sayfa var mı?
            else if(!$this->model->pageCtrl($pageId))
            {
                session::remove('','',true);
                redirect::to('');
                exit;
            }

            #Sayfai güncelle
            else if($this->model->updatePage($pageId,$post))
            {

                error::flash('success','Sayfa Güncellendi.','page/Edit/'.$pageId);
            }

        }

        /**
         * Tema..
         */
        $this->theme('admin/page/edit','Sayfa Güncelle',true);
    }



    /** =================================== | DELETE | =================================== **/

    public function delete($pageId)
    {

      #Login Control et.
        auth::loginControl();



        if(!helper::isEmpty($delete))
        {
            session::remove('','',true);
            redirect::to('/');
        }

        if($this->model->deletePage($pageId))
        {
            if(!$this->model->updatePageParents($pageId))
            {
                error::flash('error','Alt Sayfalar güncellenemedi..');
            }
            error::flash('success','Sayfa Silindi','page/Allpages');
        }

        else {
            error::flash('error','Sayfa silinemedi..','page/Allpages');
        }

    }


    /** =================================== | DISPLAY FOR USERS | =================================== **/

    public function read($pageTitle = false)
    {

      if($pageTitle == 'contact-us')
      {
        require ROOTPATH.'libs/recaptcha/recaptchalib.php';
      }

      #Boş mu?
      if(helper::isEmpty($pageTitle) OR $pageTitle == false)
      {
          redirect::referer();
      }

      #Böyle bir sayfa sahiden var mı?
      else if(!$this->model->pageCtrlByLink($pageTitle))
      {
        redirect::referer();
      }

      #Varsa sayfayı göster.
      else{

        #SAyfaya ait Bilgileri çek
        $this->pageDetail  = $this->model->pageDetail($pageTitle);

        $this->theme('page/read',$this->pageDetail->pageTitle,'','',array('cache'=>false,'cacheTime'=>604800));

      }

    }

    /** =================================== | SETTIGS | =================================== **/

    public function sideBar()
    {
        require ROOTPATH.'views/page/side_bar.php';
    }

















}