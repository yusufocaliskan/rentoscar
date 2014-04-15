<?php
if(!defined('OSCAR_RENT_A_CAR')) exit('<pre>Permission error! Please Go away :) </pre>');

class cache
{

    /**
     * Cache Süresi
     * @var integer
     */
    protected $cacheTime;

    /**
     * Cache Dizininii
     * @var string
     */
    protected $cachePath;

    /**
     * Cache Dosyası
     * @var string
     */
    protected $cacheFile;

    /**
     * Cache'lemeye başla.
     * @var boolean
     */
    protected $cacheStart;


    /**
     * Cache'lenecek dosya
     * @param boolean $file [description]
     */
    public function set()
    {


        if(file_exists($this->cachePath))
        {
            if( time() - $this->cacheTime < filemtime($this->cachePath) )
            {

                $this->cacheStart    = true;
            }

            else{

                $this->cacheStart    = true;

            }


        }


    }

    public function read()
    {
        readfile($this->cachePath);
    }

    public function start()
    {
        return $this->cacheStart;
    }



}