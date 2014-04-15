<?php
if(!defined('OSCAR_RENT_A_CAR')) exit('<pre>Permission error! Please Go away :) </pre>');

class request
{


    /**
     * GET Methodunun içinden veri alır
     * @param  string  $data      İstenilen anahartar
     * @param  boolean $returnAll True gönderildiği halde tüm array'i geri döndürür
     * @return string | array
     */
    public static function get($data, $returnAll = false)
    {
        if($returnAll)
        {
            return $_GET;
        }

        return $_GET[$data];
    }



    /**
     * POST Methodunun içinden veri alır
     * @param  string  $data      İstenilen anahartar
     * @param  boolean $returnAll True gönderildiği halde tüm array'i geri döndürür
     * @return string | array
     */
    public static function post($data, $returnAll = false)
    {

        if(helper::isAjax())
        {
            echo json_decode($_POST[$data]);
        }

        else{

        if ($returnAll)
            {
                return $_POST;
            }
        }
        return $_POST[$data];
    }


    /**
     * REQUEST Methodunun içinden veri alır
     * @param  string  $data      İstenilen anahartar
     * @param  boolean $returnAll True gönderildiği halde tüm array'i geri döndürür
     * @return string | array
     */
    public static function rquest($data, $returnAll = false)
    {
        if($returnAll)
        {
            return $_REQUEST;
        }

        return $_REQUEST[$data];
    }




























}