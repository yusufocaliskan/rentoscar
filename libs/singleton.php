<?php
if(!defined('OSCAR_RENT_A_CAR')) exit('<pre>Permission error! Please Go away :) </pre>');


class singleton
{

    # oluşturulan class instance
    private static $instance        = array();

    # Oluşturşlan class instance sayısı
    private static $countInstance   = 0;


    /**
     * Bir class'ın instance'sını oluşturu.
     * @param void
     */
    public static function set($obj)
    {

        // $obj-> bu class instance array'ın ince instance oluştulmamış ise
        if(!(self::$instance[$obj] instanceof $obj ))
        {

            self::$countInstance++;

            return self::$instance[$obj] = new $obj;

        }

        else{
            trigger_error("Daha önce zaten <strong>$obj</strong> classın instance'ı oluşturulmuş ki.");
            exit;
        }


    }


    /**
     * Oluşturulan toplam classın instance'ını döndürür.
     * @return integer
     */
    public static function getCount()
    {
        return self::$countInstance;
    }

    public static function getTypeObject($object)
    {
        return gettype(self::$instance[$object]);
    }



    /**
     * Instance'ı daha önce oluşturulan bir class oluşturulduğunda bir daha oluşturmamak için hata verir..
     * @return [type] [description]
     */
    public function __clone()
    {

        trigger_error('Oluşturlan class zaten daha önce oluşturulmuş', E_USER_ERROR);
    }











}