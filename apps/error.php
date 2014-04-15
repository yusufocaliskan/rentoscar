<?php
if(!defined('OSCAR_RENT_A_CAR')) exit('<pre>Permission error! Please Go away :) </pre>');

class error
{

    /**
     * Tüm hatalar burda saklanır.
     * Hata Tipleri : notice, warning, error, success
     * @var array
     */
    public static $err = array();

    public static function trigger($message, $type = 'E_USER_ERROR')
    {
        trigger_error($message );
        exit;
    }

    /**
     * Hata göstermek için kullanılır.
     * @param  string $type    hata tipi :  notice, warning, error, success
     * @param  string $message Mesaj
     * @return string
     */
    public static function notice($type, $message = false)
    {
        if(helper::isAjax())
        {
            if( is_array($type) )
            {
                echo json_encode($type);
            }
            else{
                echo json_encode(array('type'=>"$type",'message'=>"$message"));
            }

        }
        else{
            self::$err[$type] = $message;
        }
    }

    /**
     * Session ile bir mesaj vermek için kullanılır
     * @param string $type mesaj tipi
     * @param string $message verilecek mesaj
     * @param string $redircet Mesajın verileceği yer
     */
    public static function flash($type, $message, $redirect = false)
    {
        session::set('ERROR',array($type=>$message));
        redirect::to($redirect);
    }

    /**
     * Geldiği sayfaya geri gönderir ve mesajı verir.
     * @param string $type mesaj tipi
     * @param string $message verilecek mesaj
     */
    public static function referer($type, $message)
    {
        session::set('ERROR',array($type=>$message));
        redirect::referer();
    }


    /**
     * Var olan hataları göstermek için kullanılır
     * @return string
     */
    public static function displayNotice()
    {
        $errors = empty(self::$err) ? session::get('ERROR') : self::$err;
        if(!helper::isEmpty($errors))
        {

        ?>
            <script type="text/javascript">

                (function(){

                        <?php foreach( $errors as $key=>$val): ?>

                           $().toastmessage('showToast', {
                                text     : '<?php echo $val; ?>',
                                sticky   : false,
                                type     : '<?php echo $key; ?>'
                            });

                        <?php endforeach;?>
                })();
            </script>

        <?php
            session::remove('ERROR');
        }


    }

    /**
     * $err değişkeni var dolu mu diye kontrol eder
     * @return boolean
     */
    public static function issetError()
    {
        if(count(self::$err) > 0)
        {
            return true;
        }

        return false;
    }

    public static function _404()
    {
        require ROOTPATH.'views/error/404.php';
        exit;
    }




}