<?php
if(!defined('OSCAR_RENT_A_CAR')) exit('<pre>Permission error! Please Go away :) </pre>');


class registry{


    /**
     * Classların tutulduğu array
     * @var array
     */
    private static $_objects   = array();


    /**
     * Değişkenleri tutar
     * @var array
     */
    private static $_variable  = array();


    /**
     * # Kullanımı
     * Registry::setObject('helper')->hi();
     * Registry::setObject('test_model','models/')->silav();
     *
     *
     *
     * Yeni bir class atarken kullanılır.
     * @param object  $object class adı
     * @param string  $path   classın bulunduğu dosya/yer
     */
    public static function setObject($object, $path = null)
    {

        $rootPath =  dirname(dirname(__FILE__)).'/';

        #Path var mı?
        isset($path)
        ? $path =  $rootPath . $path.$object.'.php'
        : $path =  $rootPath . 'apps/' . $object . '.php';

        //echo $path."<br>";
        //Verilen dosya olu var mı?
        if(file_exists($path))
        {
            require_once($path);

            self::$_objects[$object] = singleton::set($object);
            return self::$_objects[$object];
        }

        else{
            die( '<strong>' . $object . '</strong> <-- Bu class yok! Hata yeri: <strong>' . __CLASS__ . '</strong>');
        }


    }

    /**
     * Çağtılmış bir değişkeni almak için kullanılır.
     * @param  string $object çağrılacak object'in adı
     * @return object
     */
    public static function get($object)
    {
        if(is_object( self::$_objects[$object] ) )
        {
            return self::$_objects[$object];
        }

        else{

            trigger_error('<strong> '. $object . '</strong> Oluşturulmuş bir <strong>instance</strong> yok!');
        }

    }


    /**
     * Array değişkenine değer atamak için kullanılır.
     * @param mixed $key anahar değeri
     * @param mixed $val Değer
     */
    public static function setVar($key, $val)
    {

        if(!array_key_exists($key, self::$_variable))

            self::$_variable[$key] = $val;

        return self::$_variable;

    }

    /**
     * Array içinde Tüm classları listeler
     * @return [type] [description]
     */
    public static function allObj()
    {
        return self::$_objects;
    }

    /**
     * Tüm değişken arrayinin döndürür.
     * @return array
     */
    public static function allVar()
    {
        return self::$_variable;
    }


    /**
     * Objeleri gösterir.
     * @return void
     */
    public static function debug()
    {
        echo '<pre>';
        print_r(self::$_objects);
        echo '</pre>';
    }


}