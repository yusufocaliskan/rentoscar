<?php
/**
 * @author  : Yusuf Çalışkan <y.caliskan@navion.com.tr>
 *
 * Navion Consulting
 */
    ob_start();
    header('Content-Type: text/html; charset=utf-8');
    define('OSCAR_RENT_A_CAR', true);


# ************************************************************************
# ******************************* | TODO | *******************************
# ************************************************************************
/**
 *  TODO: Shortcode geliştirilebilir.
 *          - Function'lar ile yapılabilir. Şuanda dosya require ediyor.
 *          - Function'a parametre atılabilir.
 *
 *  TODO: Image'yükleme Controller'ı yapılabilir.
 *          - Şuanda el ile yükleniyor.
 *          - Wordpress'teki Media Mantığı ile yapabilabir.
 *
 *  TODO: Cache Mekanizması daha geliştirilebilir. Şuadan basit mantık ile çalışıyor.
 *          - Tüm işlemi  controllers/theme methodunda yapıyor.
 *          - Cache için dinamik alanlar oluşturulmalı ve tüm sayfalara uygunlanmalı.
 *          - Smarty Önermiyorum
 *
 *  TODO: Çok dil sistemi eklenebilir.
 *          - Şuanki yapı buna müsait değil.
 *          - Sistemdeki başlıkların bir config, array veya .pa dosyasına atılabilir.
 *
 * TODO: SSL Kurulması lazım.
 *
 */
# ************************************************************************
# ******************************* | end : TODO | *******************************
# ************************************************************************



# ************************************************************************
# HATALAR
# ************************************************************************

    error_reporting(E_ALL & ~E_NOTICE);
    ini_set('display_errors', 'On');


# ************************************************************************
# CONFIGs
# ************************************************************************

    # Config dosyası
    require_once 'configs/gn_config.php';
    require_once ROOTPATH.'libs/config.php';
    require_once ROOTPATH.'configs/configSite.php';

    setlocale(LC_MONETARY, 'en_GB');


# ************************************************************************
# SESSION
# ************************************************************************



    #Sessionu başlat
    session_start();

    #Session adnı değiştir..
    session_name(Config::get('SESSION_NAME'));

    #Session zamanı
    ini_set('session.gc_maxliftime',Config::get('SESSION_MAX_TIME'));



# ************************************************************************
# LIBS
# ************************************************************************

    require 'libs/rentOscarData.php';
    require 'libs/getIp.php';


# ************************************************************************
# APPLICATIONS
# ************************************************************************


    require ROOTPATH.'apps/singleton.php';
    require ROOTPATH.'apps/registry.php';
    require ROOTPATH.'apps/debug.php';
    require ROOTPATH.'apps/cache.php';
    require ROOTPATH.'apps/error.php';
    require ROOTPATH.'apps/helper.php';
    require ROOTPATH.'apps/html.php';
    require ROOTPATH.'apps/input.php';
    require ROOTPATH.'apps/redirect.php';
    require ROOTPATH.'apps/secure.php';
    require ROOTPATH.'apps/session.php';
    require ROOTPATH.'apps/request.php';
    require ROOTPATH.'apps/language.php';
    require ROOTPATH.'apps/auth.php';

    registry::setObject( 'controller' );
    registry::setObject( 'database' );
    registry::setObject( 'model' );
    registry::setObject('settings','libs/');


# ************************************************************************
# LANGUAGE
# ************************************************************************
    function _t($key)
    {
        return language::setLang($key);
    }



# ************************************************************************
# CORE INSTANCES
# ************************************************************************

    //Router Objesini çağır. Ve instance'ını oluştur.
    registry::setObject('router')->getUrlData();




    ob_end_flush();