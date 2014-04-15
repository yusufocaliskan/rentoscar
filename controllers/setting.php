<?php
if(!defined('OSCAR_RENT_A_CAR')) exit('<pre>Permission error! Please Go away :) </pre>');

class  setting extends controller
{
    public $post;

    public $model;

    public $settings;

    public function __construct()
    {
        parent::__construct();

        $this->model = registry::get('model')->loadModel('setting');
    }


    public function home()
    {

        #Login Control et.
        auth::loginControl();



        input::set(array(
            'siteTitle' =>'s',
            'minAge'=>'n',
            'maxAge'=>'n',
            'siteEmail'=>'email',
            'sitePhone'=>'phone',
            'threeDayPriceRange'=>'',
            'sliderBottom' =>''

        ));

        extract( $this->post = input::pushInArray(array('siteTitle','minAge','maxAge','siteEmail','sitePhone','threeDayPriceRange','sliderBottom')) );

        if($_POST)
        {

            #güncellendi mi?
            if($this->model->updateSettings($this->post))
            {
                error::notice('success','Kaydedildi');
            }

            else{
                error::notice('error','Hata oluştu!');
            }

        }

        #Kayıtlı ayarları al
        $this->settings = $this->model->getSettings();

        #Theme
        $this->theme('admin/setting/home','Ayarlar',true);
    }

}