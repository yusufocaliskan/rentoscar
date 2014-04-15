<?php
if(!defined('OSCAR_RENT_A_CAR')) exit('<pre>Permission error! Please Go away :) </pre>');


class language
{


    /**
     * İstenilen dile göre sayfı çeker var array içinde eşleşen
     * anaharrın değerinin döndürür..
     * @param string  $key      anahtar
     * @param string $langCode çekilecek dil dosyası.
     */
    public static function setLang($key, $langCode = false)
    {

        #TODO : Session'a kayıt edilen dil dosyasını çek.
        require ROOTPATH.'langs/en.php';

        return $_LANG[$key];
    }

}