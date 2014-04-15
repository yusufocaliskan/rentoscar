<?php
if(!defined('OSCAR_RENT_A_CAR')) exit('<pre>Permission error! Please Go away :) </pre>');


class redirect
{


    public static function to($url = null)
    {

        # Base Path
        $basePath = BASEPATH;

        $url = is_null($url)
               ? $basePath
               : $basePath.$url;


        header('location:'. $url);
        exit;

    }

    /**
     * Geldiği sayfaya geri döndürür..
     * @return void
     */
    public static function referer()
    {
        $ref = empty($_SERVER['HTTP_REFERER']) ? BASEPATH : $_SERVER['HTTP_REFERER'];
        header('location:'.$ref);
        exit;

    }

    /**
     * Bir yöne belirli bir saniye sonra yönlendirmek için kullanılır.
     * @param  string $url  gidilecek yön
     * @param  integer $time Bekleyecek saniye.
     * @return string
     */
    public static function re($url, $time)
    {
        # Base Path
        $basePath = BASEPATH;

        $url = is_null($url)
               ? $basePath
               : $basePath.$url;
        header('refresh:'.$time.';url='. $url);

    }

}