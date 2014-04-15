<?php
if(!defined('OSCAR_RENT_A_CAR')) exit('<pre>Permission error! Please Go away :) </pre>');


class input
{

    #Post'tan gelen değerlerin tutulduğu yer
    private static $_postItem = array();

    #Array içine konulanlar
    public static $pushInArray;

    /**
     * Gelen değerleri almak için kullanılır.
     * @param  mixed $post gelecek değer
     * @return array
     */
    public static function set($post, $get = false)
    {

        if(count($post) > 0)
        {
            if(is_array($post))
            {

                foreach($post as $key => $value)
                {

                    if($get)
                    {
                        self::$_postItem[$key] =  helper::safeGetDataInput( request::get($key) ,$value  );
                    }

                    else{

                        if(!is_array($value))
                        {

                            self::$_postItem[$key] = helper::safeGetDataInput( request::post($key) ,$value  );
                        }

                        else{
                            self::$_postItem[$key] = request::post($key);
                        }

                    }
                }

            }

            else{
                    if($get)
                    {
                        self::$_postItem[$post] = helper::addSlash( request::get($post) );
                    }
                    else{

                        self::$_postItem[$post] = helper::addSlash( request::post($post) );
                    }
            }


        }

        return new self;

    }

    /**
     * Postta'ki bir değeri almak için
     * @param  string  $key        Anahtar key
     * @param  string $returnType return edilme şekli
     * @return string
     */
    public static function get($key, $pattern = false)
    {

        if(array_key_exists($key, self::$_postItem))
        {
            $data   = self::$_postItem[$key];

            if($pattern)
            {
                $return = helper::safeDisplayDataInput($data, $pattern);
            }

            else{
                $return = $data;
            }

            return $return;




        }

    }

    /**
     *
     * @return [type] [description]
     */
    public static function getAllAsArray()
    {
        return self::$_postItem;
    }


    /**
     * $_POST içinde Istenilen değerleri bir array içerisinde gönderip array içinde almaak içinde kullanılır.
     * @param  array  $data istenilen değerler
     * @return array
     */
    public static function pushInArray( $data = array() )
    {

        $return = array();

        foreach($data as $key => $val)
        {
            $return[$val] = self::$_postItem[$val];
        }
        self::$pushInArray = $return;
        return self::$pushInArray;
    }

    public static function debug()
    {

        debug::pre(self::$_postItem);

    }



















}