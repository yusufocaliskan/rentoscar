<?php
if(!defined('OSCAR_RENT_A_CAR')) exit('<pre>Permission error! Please Go away :) </pre>');

class secure
{

    private static $_msSecretKey = 'Ocar Rent A Car';
    private static $_msHexaIv = 'c7098adc8d6128b5d4b4f7b2fe7f7f05';
    private static $_msCipherAlgorithm = MCRYPT_RIJNDAEL_128;

    public static function Encrypt($plainString)
    {

        $binary_iv = pack('H*', self::$_msHexaIv);

        $binary_encrypted_string = mcrypt_encrypt(
                                   self::$_msCipherAlgorithm,
                                   self::$_msSecretKey,
                                   $plainString,
                                   MCRYPT_MODE_CBC,
                                   $binary_iv);

        return bin2hex($binary_encrypted_string);

    }

    public static function Decrypt($encryptedString)
    {
        $binary_iv = pack('H*', self::$_msHexaIv);
        $binary_encrypted_string = pack('H*', $encryptedString);

        $decrypted_string = mcrypt_decrypt(
                            self::$_msCipherAlgorithm,
                            self::$_msSecretKey,
                            $binary_encrypted_string,
                            MCRYPT_MODE_CBC,
                            $binary_iv);
        return $decrypted_string;
    }




}