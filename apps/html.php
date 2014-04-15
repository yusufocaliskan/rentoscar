<?php
if(!defined('OSCAR_RENT_A_CAR')) exit('<pre>Permission error! Please Go away :) </pre>');


class html
{

    # Sayfa başlığını tutar
    public static $title;

    # Geçerli sayfa için js dosyalarını tutar
    public static $js = array();

    # Geçerli sayfa için css dosyalarını tutar
    public static $css = array();

    # Geçerli sayfa için meta tagları
    public static $meta = array();

    #token CSRF için !önemli
    private static $token;



    /**
     * Sayfa başlığını belirler.
     * @param  string $title sayfa başlığı
     * @return string
     */
    public static function title()
    {
        $dbTitle = settings::get()->defaultTitle;
        $defaultTitle =  $dbTitle ? $dbTitle : 'OSCARRRRRR';

        return is_null(self::$title)

               ? $defaultTitle

               : self::$title . ' | ' . $defaultTitle;
    }


    /**
     * Meta dag oluşturmak için kullanılır
     * @param  array $data Özellikler array içinde gönderilir
     * @return string
     */
    public static function meta($data = array())
    {
        return "\n\t".'<meta '.self::attr($data).' />';
    }


    /**
     * Link oluşturmak için kullanılır..
     * @param  array  $data özellikler array içinde gönderilir
     * @return [type]       [description]
     */
    public static function link($text, $data = array())
    {

        $data['href'] = BASEPATH.$data['href'];

        return '<a '. self::attr($data) .'>'.$text.'</a>';
    }

    /**
     * Css Dosyası dahil etmek için kullanılır
     * @param  array $data özellikler array için de gönderilie
     * @return string
     */
    public static function style($data)
    {
        $data['href'] = BASEPATH.$data['href'];
        return '<link '.self::attr($data).' />';
    }


    /**
     * Sayfa'ya özel js dosyları için
     * @return string
     */
    public static function displayCustomJsFile()
    {

        if(isset(self::$js) AND !helper::isEmpty(self::$js))
        {
            $controller = router::getController();
            $path = 'views/'.$controller.'/js/';

            $return = '';
            foreach(self::$js as $val)
            {
                $return .= self::script(array('src'=>$path.$val.'.js'));
            }

            return $return;
        }
    }


    /**
     * Sayfa'ya özel ccs dosyları için
     * @return string
     */
    public static function displayCustomCssFile()
    {

        if(isset(self::$css) AND !helper::isEmpty(self::$css))
        {
            $controller = router::getController();
            $path = BASEPATH.'views/'.$controller.'/css/';

            $return = '';
            foreach(self::$js as $val)
            {
                $return .= self::style(array('href'=>$path.$val.'.csss'));
            }

            return $return;
        }
    }


    /**
     * Script tag oluşturmak için kullanılır
     * @param  array  $data Özellikler arry için de gönderilir
     * @return string
     */
    public static function script($data = array())
    {
        $data['src'] = BASEPATH.$data['src'];
        return "\t".'<script type="text/javascript" '.self::attr($data).' /></script>'."\n";
    }


    /**
     * Form açmak için kullanılır..
     * @param  string $url  Gidicek url
     * @param  array  $data Form özellikleri
     * @return string
     */
    public static function formOpen($url = null, $data = array())
    {
        #ACTION
        $data['action'] = BASEPATH.$url;

        #METHOD
        $data['method'] = isset($data['method']) ? $data['method'] : 'POST';


        #Token oluştur.
        self::$token = uniqid(rand(), true);

            #Session'a toke'ni ata.
            session::set('TOKEN',self::$token);

        return '<form '. self::attr($data) .'>';

    }

    /**
     * Açılan formu kapatır
     * @return string
     */
    public static function formClose()
    {
        $return  = '';
        $return .= '<input type="hidden" name="token" value="'.self::$token.'">';
        $return .= '</form>';

        return $return;
    }

    /**
     * Sayfaya resim dahil etmek için kullanılır.
     * @param  array  $attr resim özellikleri
     * @return string
     */
    public static function img($data = array())
    {

        # SOURCE PATH
        $data['src'] = isset($data['src']) ? BASEPATH.$data['src'] : null;

       return  '<img '. self::attr($data) .' />';
    }





    /**
     * Girilen değerileri html özellerikleri için ayarlar
     * Yardımcı bir function
     * @param  array  $attr özellik
     * @return string
     */
    public static function attr($attr = array())
    {

        $html = '';

        foreach($attr as $key=>$val)
        {
            $html .= $key.'="'.$val.'" ';
        }

        return $html;
    }

    /**
     * Aktif menüye class atar
     * @param string  $currentMenu Geçerli sayfa
     * @param string $method      method
     */
    public static function setCurrentMenu($currentMenu = false, $currentMethod = false, $currentParam = false, $sideBar = false)
    {
        $controller = strtolower(router::getController());
        $method     = strtolower(router::getMethod());
        $param      = strtolower(router::getParam(0));

        $class      = $sideBar == TRUE ? 'class="current"' : 'class="current_page_item"';


        $currentMenu = is_array($currentMenu) ? array_map(strtolower, $currentMenu): strtolower($currentMenu);
        $currentMethod = strtolower($currentMethod);

        if($param)
        {
            if($currentParam == $param)
            {
                return $class;
            }
        }else
        if(is_array($currentMenu))
        {
            if(in_array($method, $currentMenu))
            {
                return $class;
            }
        }else

        //Method True ise : Yani bu bir alt sayfa ise
        if($currentMethod)
        {

            if($method == $currentMethod)
            {
                return $class;
            }

        }

        #Değil ise
        else{

            #Controller menuye eşit veya boş ise
            if($controller == $currentMenu OR helper::isEmpty($controller))
            {
                return $class;
            }

        }

    }

    /**
     * Alışveriş
     * @param  boolean $active [description]
     * @return [type]          [description]
     */
    public static function getShopingStepsHtml($active = false, $doneStep = array())
    {


         $steps = array(1=>'Create request', 2=>'Choose a car', 3=>'Choose extras',4=>'Review &amp; Book');
    ?>
        <div id="progress-bar">
                <div id="progress-bar-steps">

                    <?php for($i = 1; $i<=count($steps); $i++):?>
                        <div class="progress-bar-step   <?php echo $i == $active ? 'current' : null; ?> <?php echo $i == 4 ? 'last' : null; ?> <?php echo $i == $doneStep[$i] ? 'done' : null; ?> ">
                            <div class="step_number"><?php echo $i?></div>
                            <div class="step_name"><?php echo $steps[$i]; ?></div>
                        </div>
                    <?php endfor;?>
                </div>
            <div class="clear"></div>
        </div>

    <?php

    }


    /**
     * Select box değerini selected olarak atar
     * @param  string $a koşul 1
     * @param  string $b koşul 2
     * @return string
     */
    public static function selected($elementName, $b)
    {
        if($_REQUEST[$elementName] == $b)
        {
            return 'selected="selected"';
        }
    }

    /**
     * Select box değerini checked olarak atar
     * @param  string $a koşul 1
     * @param  string $b koşul 2
     * @return string
     */
    public static function checked($a, $b)
    {
        $a =  trim("'",$a);
        $b =  trim("'",$b);
        if($_REQUEST['return_location'])
            if($a == $b)
            {
                return 'checked="checked"';
            }
    }

    public static function setCurrentClass($a, $b)
    {
        if($a == $b)
        {

            return 'class="current"';

        }
    }

    public static function setActiveCheckbox($a, $b)
    {
        $a = strtolower(ucwords($a));
        $b = strtolower(ucwords($b));
        if($a AND $b)
        {

            if($a == $b)
            {
                return 'active-checkbox';
            }

        }
    }

    /**
     * Post'taki değeri gönderir
     * @param  string $elementName element name
     * @return string
     */
    public static function returnElementVal($elementName, $defaultVal = false)
    {


        if($_REQUEST)
            if($_REQUEST[$elementName])
            {
                return trim(stripslashes($_REQUEST[$elementName]));
            }
            else{
                return $defaultVal;
            }
    }



















}