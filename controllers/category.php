<?php
if(!defined('OSCAR_RENT_A_CAR')) exit('<pre>Permission error! Please Go away :) </pre>');

class category extends controller
{
    /**
     * Kategori modülü
     * @var object
     */
    public $model;

    public function __construct()
    {
        parent::__construct();

        $this->model = registry::get('model')->loadModel('category');

        #Login Control et.
        auth::loginControl();


    }

    public function home()
    {
        redirect::to('News');
    }

    public function add()
    {
        input::set(array('categoryName'=>'s'));
        extract( $post = input::pushInArray(array('categoryName')));

        if(helper::isEmpty($categoryName))
        {
            error::notice('warning','Boş alan bıraktınız');
        }

        #Daha önce var mı
        else if($this->model->categoryNameCtrl($categoryName))
        {
            error::notice('warning',$categoryName.' Daha önce eklenmiş.');
        }

        #Eklendi mi?
        #TODO : ID'yi geri gönder..
        else if($lastId = $this->model->insert($categoryName))
        {
            error::notice(array('type'=>'success','message'=>'Kategori Eklendi','categoryId'=>$lastId));

        }
        else{
            error::notice('error','Kategori Eklenmedi');

        }
    }


    /**
     * Kategoriyi silmek için kullanılır..
     * @param  integer $categoryId kategori id'si
     * @return string
     */
    public function delete($categoryId)
    {

        if(helper::isEmpty($categoryId))
        {
            session::remove('','',true);
            redirect::to('');
            exit;
        }

        #Kategoriye ait içerik var mı?
        else if($this->model->categoryCtrl($categoryId))
        {
            error::referer('warning','Bu kategoriye ait haberler var. Silinemez.');
        }

        else if(!$this->model->delete($categoryId))
        {

            error::referer('error','Kategori Silinmedi.');

        }

        else{
            error::referer('success','Kategori Silindi.');
        }

    }
}