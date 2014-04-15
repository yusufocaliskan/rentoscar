<?php
if(!defined('OSCAR_RENT_A_CAR')) exit('<pre>Permission error! Please Go away :) </pre>');


class session
{



    /**
     * Session atamak için kullanılırçç
     * @param string $key anahatar
     * @param string $val Anahtar değeri
     */
    public static function set( $key, $val = false )
    {


        if(is_array($val))
        {
            foreach($val as $skey=>$sval)
            {

                $_SESSION[$key][$skey] = $sval;
            }
        }
        else{
                $_SESSION[$key] = $val;
        }

        return new self;
    }




   /**
    * Session içideki değeri almak için kullanılır
    * @param  string  $key1 birinki anatar
    * @param  string $key2  ikinci anahtar
    * @return mixed
    */
    public static function get($key1, $key2 = false)
    {
        if($key2)
        {
            if(array_key_exists($key1, $_SESSION))
                return $_SESSION[$key1][$key2];
        }


        else{

            if(array_key_exists($key1, $_SESSION))
                return $_SESSION[$key1];
        }

    }


    /**
     * Tüm sessionu döndürür
     * @return array
     */
    public static function getAll()
    {
        return $_SESSION;
    }


    /**
     * Session ID'sini döndürür..
     * @param  boolean $reGenerate True gönderirse yeniden oluşturur ve gönderir
     * @return string
     */
    public static function sessionId($reGenerate = false)
    {
        if($reGenerate)
        {
            $this->sesRegenerateID();
        }

        return session_id();
    }

    /**
     * Session id'sini yeniden oluşturur.
     * @return string
     */
    public static function sesRegenerateID()
    {
        session_regenerate_id();
    }

    /**
     * Session içinde bir değeri silmek için kullanılır
     * @param  strşng  $key1 birinci anahtar değeri
     * @param  string $key2 ikinci ahahtar değeri
     * @param  boolean $all  tüm sessionları silmek için kullanılır
     * @return void
     */
    public static function remove($key1, $key2 = false, $all = false)
    {

        if($all)
        {

           session_destroy();

        }
        else if($key2)
        {
            if(array_key_exists($key1, $_SESSION))
            {
                unset($_SESSION[$key1][$key2]);
            }
        }

        else{

            if(array_key_exists($key1, $_SESSION))
            {
                unset($_SESSION[$key1]);
            }
        }

    }

    public static function debug()
    {
        debug::pre($_SESSION);
    }























}