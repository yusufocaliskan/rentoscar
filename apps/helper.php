<?php
if(!defined('OSCAR_RENT_A_CAR')) exit('<pre>Permission error! Please Go away :) </pre>');

class helper{

    /**
     * Değerin boş olmadığını kontrol eder
     * @param  mixed  $data kontrol edilecek data
     * @return boolean
     */
    public static function isEmpty( $data )
    {

        //debug::pre($data);
        if(is_array( $data ))
        {
            $empty = false;
            foreach($data as $val)
            {

               if(trim($val) == '')
               {
                    $empty = true;
               }
            }

            return $empty;
        }

        else{

            if( trim ( $data ) == '' )

                return true;

        }
    }

    public static function sendEmail($to,$subject,$message,$from,$headers = false,$parameters = false)
    {

        $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
        $headers .= 'From: İletişim Kutusu <'.$from.'>' . "\r\n";

        $messageTMP  = 'İletişim';
        $messageTMP  .= '<br><strong>From :</strong> <a href="mailto:'.$from.'">'.$from.'</a><br>';
        $messageTMP  .= '<strong>Subject :</strong>'.$subject.'<br><br>';

        $messageTMP  .= $message;
        $messageTMP  .= '<br><br><br>---------- Bu e-mail '.settings::get()->defaultTitle.' Tarafından gönderilmiştir. -----------';
        $sendMail = mail($to,$subject,$messageTMP,$headers);
        if($sendMail)
        {
            return true;
        }

        return false;
    }

    /**
     * Girlen değerin email yapısında olup olmadığını kontrol eder
     * @param string $email Email adresi
     * @return boolean
     */
    public static function isEmail($email)
    {
        $pattern = "/^([_a-z0-9-]+)(\.[_a-z0-9-]+)*@([a-z0-9-]+)(\.[a-z0-9-]+)*(\.[a-z]{2,6})$/";
        $isEmail = false;

        if( is_array($email) )
        {
            foreach($email as $key)
            {
                if( preg_match($pattern, $email) )
                {
                    $isEmail = true;
                }
            }
        }

        else{


            if(preg_match($pattern, $email))
            {
                $isEmail = true;
            }
        }

        return $isEmail;
    }

    /**
     * Girilen değerin integer olup olmadığına bakar
     * @param integere $data kontrol edilecek data
     * @return boolean
     */
    public static function isDigit($data)
    {
        if(ctype_digit($data))
        {
            return true;
        }

        return false;
    }


    /**
     * İstenilen değerler vare mı? String mi yoksa diğit mi?
     * @param  mixed $data    kontrol edilecek değer
     * @param  string $pattern kontrol edilme şekli
     * @return string
     */
    public static function validText($data,$pattern = 's')
    {

        $return =  false;

        #Strin mi?
        if($pattern == 's')
        {
            $return = preg_match('/[a-zA-ZÇçÖöŞşİıÜüĞğ ]/', $data);
        }

        #Numeric mi
        else if($pattern == 'n')
        {
            $return = preg_match('/^[0-9]$/', $data);
        }

        else if($pattern == 'phone')
        {
            $return = preg_match('/[^+\(\)_.0-9 ]/',$data);
        }

        else if($pattern == 'address')
        {
            $return = preg_match('/[^a-zA-ZÇçÖöŞşİıÜüĞğ 0-9:\/]/', $data);
        }

        else{

            $return = preg_match('/'.$pattern.'/',$data);
        }


        return $return;
    }





    /**
    * Tüm işe yaramaz karterleri siler
    * @param  string $data string
    * @return string
    */
    public static function safeDisplayDataInput($data, $pattern = null)
    {
        $return = strip_tags($data);
        $return = trim($data);
        $return = stripslashes($data);

        #String mi?
        if($pattern == 's')
        {
            $return = preg_replace('/[^a-zA-ZÇçÖöŞşİıÜüĞğ ]/', '', $data);
        }

        #rakkam mı?
        else if($pattern == 'n')
        {
            $return = preg_replace('/[^0-9]/', '', $data);
        }

        else if($pattern == 'address')
        {
            $return = preg_replace('/[^a-zA-ZÇçÖöŞşİıÜüĞğ: \/ \\0-9 ]/', '', $data);
        }

        else if($pattern == 'email')
        {

            $return = preg_replace('/[^a-zA-Z@_.0-9 ]/', '', $data);
        }

        else if($pattern == 'phone')
        {
            $return = preg_replace('/[^+\(\)_.0-9 ]/', '', $data);
        }

        else if($pattern == null)
        {
            $return = $data;
        }

        else{
            $return = preg_replace("/[^$pattern]/", '', $data);
        }


        return $return;
    }


    /**
    * Tüm işe yaramaz karterleri siler
    * @param  string $data string
    * @return string
    */
    public static function safeGetDataInput($data, $pattern = null)
    {
        $return = strip_tags($data);
        $return = trim($data);
        $return = addslashes($data);

        #String mi?
        if($pattern == 's')
        {
            $return = preg_replace('/[^a-zA-ZÇçÖöŞşİıÜüĞğ\/ ]/', '', $data);
        }

        #rakkam mı?
        else if($pattern == 'n')
        {
            $return = preg_replace('/[^0-9:\/]/', '', $data);
        }
        else if($pattern == 'email')
        {

            $return = preg_replace('/[^a-zA-Z@_.0-9 ]/', '', $data);
        }

        else if($pattern == 'phone')
        {
            $return = preg_replace('/[^+\(\)_.0-9 ]/', '', $data);
        }
        else if($pattern == 'address')
        {
            $return = preg_replace('/[^a-zA-ZÇçÖöŞşİıÜüĞğ\/: \\0-9]/', '', $data);
        }

        else if($pattern == null)
        {
            $return =  $data;

        }
        else{
            $return = preg_replace("/[^$pattern]/", '', $data);
        }


        return $return;
    }



    /**
     * yazı içerisinde fazlanda boşlukları alır..
     * @param  string $data data
     * @return string
     */
    public static function repSpace($data)
    {
        $data = preg_match('/\s+/'," ",$data);
        $data = trim($data);

        return $data;
    }


    /**
     * Verilen tarih bu günne eşit mi?
     * Küçük ise Değil ise hata ver
     * @param string $DateData tarih
     * @return boolean
     */
    public static function isDateCorrect($DateData = false)
    {
        $expDate = explode('/',$DateData);
        $today = mktime(0,0,0,date("m"),date("d"),date("Y"));
        $date  = mktime(0,0,0,$expDate[0],$expDate[1],$expDate[2]);

       // echo '---------------------';
       // echo '<br>';
       // echo $date;
       // echo '<br>';
       // echo $today;
       // echo '<br>';
       // echo '---------------------';
        if( $date < $today )
        {
            return true;
        }
        return false;
    }

    /**
     * Gelecekteki zaman aralığı işimdikinden küçük mü?
     * @param  string  $data_from şimdiki tarih
     * @param  string  $data_to   tarhi gelecek
     * @return boolean
     */
    public static function isDateToSmallerThenDateFrom($data_from, $data_to)
    {

        if( strtotime($data_from) <= strtotime($data_to) )
        {
            return true;
        }

        return false;

    }

    /**
     * Sayın
     * @param  [type] $data [description]
     * @return [type]       [description]
     */
    public static function getLeng($data)
    {
        return strlen($data);
    }


    /**
     * Explode işlemi yapar
     * @param  string  $by      ne ile bölünecek?
     * @param  string  $data    bölünecek data
     * @param  integer $indexOf index numarası
     * @return string | array
     */
    public static function explodeData($by, $data, $indexOf = false)
    {


        $explode = explode($by, $data);


        if($indexOf)
        {
            return $explode[$indexOf];
        }

        return $explode;

    }

    /**
     * CSRF için token Kontrolü yapar..
     * @return boolean
     */
    public static function isValidToken()
    {
        if(helper::isPOST() OR helper::isGET())
        {

            if($_REQUEST['token'] == $_SESSION['TOKEN'])
            {
                return true;
            }
        }

        return false;
    }

    /**
     * Kaç defa post edildiğine bakar
     * Kullanıcı 10'den fazla post ederse true olarak döndürür
     * Bu sayfade serveri baskı altından kurtarırız
     * @return boolean
     */
    public static function postCount($postTime)
    {
        $i = 0;
        $_SESSION['SESSION_FROM_POST_COUNT']++;
        if($_SESSION['SESSION_FROM_POST_COUNT'] >= $postTime)
        {
            $_SESSION['SESSION_FROM_POST_COUNT'] = 0;
            return true;
        }

        return false;
    }

    public static function reCaptcha()
    {
         $resp = recaptcha_check_answer(config::get('RECAPTCHA_PRIVATE_KEY'),
                                        $_SERVER["REMOTE_ADDR"],
                                        $_POST["recaptcha_challenge_field"],
                                        $_POST["recaptcha_response_field"]);
        if($resp->is_valid)
        {
            return true;
        }

        return false;
    }

    /**
     * Yazıyı küçült.
     * @param  string $data küçültülecek yazı
     * @return string
     */
    public static function toLower($data)
    {
        return strtolower($data);
    }

    /**
     * Gelen değerin string mi olduğuna karar verir.
     * @param  integer $lessThen bu sayı ile
     * @param  integer $moreThen bu sayı arasında bir string içermesi lazım
     * @return boolean
     */
    public static function isString($string, $start = false, $end = false)
    {

       // $regex = $start AND $end ? "/^[a-zA-Z\-\']{$start,$end}$/" : "/^[a-zA-Z\-\]$/";
        return preg_match($regex, $string);

    }

    /**
     * Post edildi mi diye KOntrol eder.
     * @return boolean
     */
    public static function isPOST($data = false)
    {

        if($data)
        {

            if($_POST[$data])
            {
                return true;
            }
        }

        else if($_POST)
        {
            return true;
        }

    }


    /**
     * Post edildi mi diye KOntrol eder.
     * @return boolean
     */
    public static function isGET($data = false)
    {

        if($data)
        {

            if($_GET[$data])
            {
                return true;
            }
        }

        else if($_GET)
        {
            return true;
        }

    }

    /**
     * Ajaş mı değil mi diye kontrol eder
     * @return boolean [description]
     */
    public static function isAjax()
    {
        if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
        {
            return true;
        }

        return false;
    }

    /**
     * Bir dosya çekmek için kullanılır.
     * @param  string $path Dosya yolu
     * @return void
     */
    public static function getFile($path)
    {
        require_once(ROOTPATH.$path);
    }

    /**
     * Kullanici Ip'sini alır
     * @return string
     */
    public static function getIp()
    {
        return getenv('REMOTE_ATTR');
    }

    /**
     * Kullanıcı Browserini alır
     * @return string
     */
    public static function getUserAgent()
    {
        return getenv('HTTP_USER_AGENT');
    }


    /**
     * Tırknakların önüne slaş koyar
     * @param string $data data
     */
    public static function addSlash($data)
    {
        if(!is_array($data))
        {
            return addslashes($data);
        }


    }


    /**
     * Tırknaları kaldırır.
     * @param  string $data data
     * @return string
     */
    public static function removeSlash($data)
    {
        return stripcslashes($data);
    }


    /**
     * Kelimenin yanındaki ve sonundaki boşlukları alır
     * @param  string $data data
     * @return string
     */
    public static function trimData($data)
    {
        return trim($data);
    }

    /**
     * Tarih kkontrolü yapar.
     * @param  string $date tarih
     * @return boolean
     */
    public static function validDate($date)
    {
        $date_regex = '/(0[1-9]|1[012])[- \/.](0[1-9]|[12][0-9]|3[01])[- \/.](19|20)\d\d/';

        if(preg_match($date_regex, $date)) {
            return true;
        }
    }


    /**
     * Kredi Kard Format Doğrulama
     * @param  integer $number kredi kartı numarası
     * @param  string $expiry geçerli tarih
     * @return string
     */
    public static function validateCC($number, $expiry)
    {

        $ccnum  = preg_replace('/[^\d]/', '', $number);
        $expiry = preg_replace('/[^\d]/', '', $expiry);

        $left   = substr($ccnum, 0, 4);
        $cclen  = strlen($ccnum);
        $chksum = 0;

        if (($left >= 3000) && ($left <= 3059) ||
        ($left >= 3600) && ($left <= 3699) ||
        ($left >= 3800) && ($left <= 3889))
        if ($cclen != 14) return FALSE;

        if (($left >= 3088) && ($left <= 3094) ||
        ($left >= 3096) && ($left <= 3102) ||
        ($left >= 3112) && ($left <= 3120) ||
        ($left >= 3158) && ($left <= 3159) ||
        ($left >= 3337) && ($left <= 3349) ||
        ($left >= 3528) && ($left <= 3589))

        if ($cclen != 16) return FALSE;

        // American Express
        elseif (($left >= 3400) && ($left <= 3499) ||
        ($left >= 3700) && ($left <= 3799))

        if ($cclen != 15) return FALSE;
        // Carte Blanche

        elseif (($left >= 3890) && ($left <= 3899))
        if ($cclen != 14) return FALSE;

        // Visa
        elseif (($left >= 4000) && ($left <= 4999))
        if ($cclen != 13 && $cclen != 16) return FALSE;

        // MasterCard
        elseif (($left >= 5100) && ($left <= 5599))
        if ($cclen != 16) return FALSE;

        // Australian BankCard
        elseif ($left == 5610)
        if ($cclen != 16) return FALSE;

        // Discover
        elseif ($left == 6011)
        if ($cclen != 16) return FALSE;

        // Unknown
        else return FALSE;
        for ($j = 1 - ($cclen % 2); $j < $cclen; $j += 2)
        $chksum += substr($ccnum, $j, 1);

        for ($j = $cclen % 2; $j < $cclen; $j += 2)
        {
        $d = substr($ccnum, $j, 1) * 2;
        $chksum += $d < 10 ? $d : $d - 9;
        }

        if ($chksum % 10 != 0) return FALSE;

        if (mktime(0, 0, 0, substr($expiry, 0, 2), date("t"),

        substr($expiry, 2, 2)) < time()) return FALSE;
        return TRUE;
    }


    public static function sefLink($string)
    {
        $find = array('Ç', 'Ş', 'Ğ', 'Ü', 'İ', 'Ö', 'ç', 'ş', 'ğ', 'ü', 'ö', 'ı', '+');
        $replace = array('c', 's', 'g', 'u', 'i', 'o', 'c', 's', 'g', 'u', 'o', 'i', 'plus');

        $string = strtolower(str_replace($find, $replace, $string));
        $string = preg_replace("@[^A-Za-z0-9\-_\.\+#]@i", ' ', $string);

        $string = trim(preg_replace('/\s+/', ' ', $string));
        $string = str_replace(' ', '-', $string);

        return $string;
    }



     /**
     * Ikı tarih arsaındaki gün farkını verir
     * @param  string $date1 1. tarih
     * @param  string $date2 2. tarigh
     * @return string
     */
    public static function diffrenceBetweenDates($date1, $date2)
    {

        $datetime1 = new DateTime($date1);
        $datetime2 = new DateTime($date2);


        return $datetime1->diff($datetime2)->days+1;

    }



    /**
     * Yazı içerisindeki sort kodları kaldırır yerine
     * short kod adındaki dosyasyı require eder
     * @param  string $content yazı
     * @return string
     */
    public static function shortCode($content = false)
    {
        preg_match('/\[(.*?)\]/', $content, $outPut);
        $path  = ROOTPATH.'shortcode/'.$outPut[1].'.php';
        if(file_exists($path))
        {
            require $path;
        }

        else{
            return $content;
        }

    }

    /**
     * Tagları düzeltir.
     * @param  string $content yazı
     * @return string
     */
    public static function tagReplace($content)
    {

       $output = preg_replace('/src="(.*?)"/','<img src="'.BASEPATH.'$1"',$content);

       return $output;
    }








}