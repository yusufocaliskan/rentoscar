<?php
if(!defined('OSCAR_RENT_A_CAR')) exit('<pre>Permission error! Please Go away :) </pre>');


class controller
{

    public $cache;

    public function __construct(){}

    /**
     * Temayı oluştur
     * @param  string  $page  content sayfası
     * @param  string $title sayfa adı
     * @return string
     */
    public function theme($page = null, $title =false, $adminTheme =false, $loginTheme = false, $cache = false)
    {

        #View content yolu gönster
        $viewPath = config::get('DEFAULT_VIEW_FOLDER').$page.'.php';

        #sayfa boşmu
        if(is_null($page))
        {
            #Hata göster
            error::trigger('<strong>'. $page . ' <- </strong>  View içinde bu dosya yok ki! ');
        }

        #Böyle bir content dosyası var mı
        if(!is_readable($viewPath))
        {
            #Hata göster
            error::trigger('Bu dosya bozuk veya yolu yanlış.');
        }
        if(!$cache['cache'])
        {
            #Temayı çağır
            $this->__template($viewPath, $title, $adminTheme, $loginTheme) ;

        }

        else{

            #CACHE
            $cacheTime        =  isset($cache['cacheTime']) ? $cache['cacheTime'] : 15; //15 Saniye

            #Admin giriş yapmış ise admine özel cache Dosyası luştur
            #TODO : Daha sonra bu nu tüm kullanıcılara özel yap. Eğer kullanıcı sistemi olacaksa.
            if( auth::isLoggedIn() AND auth::isAdmin() )
            {
                $cacheFile        =  'admin_'.str_replace('/','_',$page).'_'.router::getParam(0).md5($page).'.html';
            }

            #Sıradan hernagi biris ise.
            else{
                $cacheFile        =  str_replace('/','_',$page).'_'.router::getParam(0).md5($page).'.html';
            }

            $cachePath        =  ROOTPATH.'cache/'.$cacheFile;

            if(file_exists($cachePath) AND time() - $cacheTime < filemtime($cachePath))
            {
                readfile($cachePath);
            }

            else{

                @unlink($cachePath);
                ob_start();

                    #Temayı çağır
                    $this->__template($viewPath, $title, $adminTheme, $loginTheme) ;

                    $open = fopen($cachePath, "w+");
                    fwrite($open, ob_get_contents());
                    fclose($open);

                ob_end_flush();

            }

        }

    }


    /**
     * Tema'yi çağırç
     * @param  string $viewPath content yolu
     * @param  string $title    Site başlığı
     * @return string
     */
    private function __template($viewPath, $title, $adminTheme = false , $loginTheme = false)
    {

        html::$title = $title;

        #Login theme
        if($loginTheme)
        {

            require DEFAULT_LOGIN_HEADER_FILE;
                require $viewPath;
            require DEFAULT_LOGIN_FOOTER_FILE;

        }

        #Admin theme
        else if($adminTheme){
            require DEFAULT_ADMIN_HEADER_FILE;
                require $viewPath;
            require DEFAULT_ADMIN_FOOTER_FILE;
        }

        #Default Theme
        else{

            require DEFAULT_HEADER_FILE;
                require $viewPath;
            require DEFAULT_FOOTER_FILE;
        }


    }








}