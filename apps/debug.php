<?php
if(!defined('OSCAR_RENT_A_CAR')) exit('<pre>Permission error! Please Go away :) </pre>');


class debug
{


    public static function pre($debug)
    {
        echo '<pre>';

            print_r($debug);

        echo '</pre>';
    }

    public static function dump($data)
    {
        return var_dump($data);
    }
}