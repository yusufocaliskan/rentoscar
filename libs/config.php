<?php
if(!defined('OSCAR_RENT_A_CAR')) exit('<pre>Permission error! Please Go away :) </pre>');



class config{



    public static function get($conf)
    {
        global $GN_CONFIG;

        return array_key_exists($conf, $GN_CONFIG)
               ? $GN_CONFIG[$conf]
               : null;

    }




}

