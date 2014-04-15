<?php
if(!defined('OSCAR_RENT_A_CAR')) exit('<pre>Permission error! Please Go away :) </pre>');



    # ************************************************************************
    # SITE PATH
    # ************************************************************************

    #Site klasörü
    define('BASEPATH', 'http://test.navion.com.tr/rentoscar/');

    #Gerçek dizin site dizini.
    define('ROOTPATH', dirname(dirname(__FILE__)).'/');


$GN_CONFIG = array(



    # ************************************************************************
    # PATHS
    # ************************************************************************


    #Küthane path'i
    'LIBS'                        => ROOTPATH.'libs/',

    #Controllers path'i
    'CONTROLLERS_PATH'            => ROOTPATH.'controllers/',


    # ************************************************************************
    # DEFAULTS
    # ************************************************************************


    #Default Controller / AnaSayfa
    'DEFAULT_CONTROLLER'         => 'index',

    #Default Method
    'DEFAULT_METHOD'             => 'home',

    #Method Prefix
    'PRIVATE_METHOD_PREFIX'      => '_',

    #Site başlığı
    'PAGE_DEFAULT_TITLE'         => 'Oscar Rent A Car',

    #Default Theme
    'DEFAULT_CURRENT_THEME'      => 'themes/default/',

    #Default View Home Page
    'DEFAULT_VIEW_FOLDER'       => ROOTPATH.'views/',

    #Site Adı
    'SITE_NAME'                 => 'Oscar Rent A Car',

    # Sayfada gösterilecek araç sayısı.
    'PER_PAGE'                  => 5,

    #Geçelerli Resim sayfası
    'DEFAULT_IMAGE_FOLDER'      => 'images/',

    #En küçük yaş sınırı
    'MIN_PAYMENT_AGE'           => 18,

    #En küçük yaş sınırı
    'MAX_PAYMENT_AGE'           => 120,


    # ************************************************************************
    # SESSION
    # ************************************************************************


    #Session Adı
    'SESSION_NAME'              => 'RENT_OSCAR_SESS',

    # Session Kapanma zamanı
    'SESSION_MAX_TIME'          => 800,

    #RECAPTCHA
    'RECAPTCHA_PUBLIC_KEY'      => '6Lcl3vASAAAAAPcxpRoJmybCUic-aa1BPuf3_nFg',
    'RECAPTCHA_PRIVATE_KEY'     => '6Lcl3vASAAAAAKLZ-JYWI0J9GVh0HBwfmZ9gjbc3',

);

    #Resim Dosyası
    define('DEFAULT_IMAGE_PATH', ROOTPATH.'images/');


    # ************************************************************************
    # THEME PATH - DEFAULT
    # ************************************************************************


    #Header Dosyasının olduğu yer
    define('DEFAULT_HEADER_FILE', ROOTPATH.$GN_CONFIG['DEFAULT_CURRENT_THEME'].'header.php');

    #Footer Dosyasının olduğu yer
    define('DEFAULT_FOOTER_FILE', ROOTPATH.$GN_CONFIG['DEFAULT_CURRENT_THEME'].'footer.php');


    # ************************************************************************
    # THEME PATH - LOGIN
    # ************************************************************************


    #Header Dosyasının olduğu yer
    define('DEFAULT_LOGIN_HEADER_FILE', ROOTPATH.$GN_CONFIG['DEFAULT_CURRENT_THEME'].'login/login_header.php');

    #Footer Dosyasının olduğu yer
    define('DEFAULT_LOGIN_FOOTER_FILE', ROOTPATH.$GN_CONFIG['DEFAULT_CURRENT_THEME'].'login/login_footer.php');



    # ************************************************************************
    # THEME PATH - ADMIN
    # ************************************************************************


    #Header Dosyasının olduğu yer
    define('DEFAULT_ADMIN_HEADER_FILE', ROOTPATH.$GN_CONFIG['DEFAULT_CURRENT_THEME'].'admin/admin_header.php');

    #Footer Dosyasının olduğu yer
    define('DEFAULT_ADMIN_FOOTER_FILE', ROOTPATH.$GN_CONFIG['DEFAULT_CURRENT_THEME'].'admin/admin_footer.php');


