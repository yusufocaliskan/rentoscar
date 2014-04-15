<?php
if(!defined('OSCAR_RENT_A_CAR')) exit('<pre>Permission error! Please Go away :) </pre>');

class basket
{
    /**
     * Toplam araç fiyatı
     * @var float
     */
    public $carSubTotalPrice;

    /**
     * toplam her bir donanımın mitarıy ile çarpımı
     * @var float
     */
    public $extraTotalPrice;

    /**
     * Toplam sepet fiyatı
     * @var float
     */
    public $totalPrice;

    /**
     * Alma ve İade Tarihleri arasındaki gün sayısı
     * @var object
     */
    public $diffDay;

    /**
     * Istenilen 2gun kadar araç fiyatını hesaplar
     * @param  float $carPrice  araç fiayatı
     * @param  date $data_from başlangıç günü
     * @param  date $data_to   bitiş günü
     * @return float            fiyat
     */
    public function calcSubTotal($carPrice, $data_from, $data_to)
    {


        #Tarihler arasındaki gun farkı
        $this->diffDay          = helper::diffrenceBetweenDates($data_from, $data_to);
        $this->diffDay          = $this->diffDay <= 0 ? 1 : $this->diffDay;

        //3 Günlük olursa üzerine eklenecek fiyat. Database'den çeker.
        $carPrice               = $carPrice + settings::get()->threeDayPriceRange;

        #Araçcın 1 günlük ise
        #Database'de belirtilen miktar ile toplar
        $this->carSubTotalPrice = ($carPrice * $this->diffDay);



        return  money_format("%10.2n",$this->carSubTotalPrice);
    }

    /**
     * toplam her bir donanımın mitarıy ile çarpımı
     * @return float
     */
    public function calcExtraQuantityTotal($eachPrice,$quantity)
    {

        //Donanımın fiyatı ÇARPI ADETİ ÇARPI ARAÇ GÜNÜ
        $this->extraTotalPrice = $eachPrice*$quantity*$this->diffDay;
        return $this->extraTotalPrice;
    }


    /**
     * Tüm alışverişin toplam fiyatı
     * @return float
     */
    public function calcTotal($extraTotal)
    {
        return $this->totalPrice = money_format("%10.2n",$this->carSubTotalPrice+$extraTotal);
    }




    /**
     * Extrayı Spete Ekleme için kullanılır
     * @param integer $extraId Sepete eklenecek extra
     * @param object $model Kontrol için CAR Model
     */
    public function addExtraToBasket($extraId,  model $model)
    {

        #Boş veya integer değil mi?
        if(helper::isEmpty($extraId) AND helper::isDigit($extraId))
        {

            redirect::to('');
            exit;
        }

        #Gerçekten var mı bu extra database de?
        if(!$model->ctrlExtraById($extraId))
        {


            redirect::to('');
            exit;
        }

        #Her şey yolunda gitmiş ise car'ta extrayı ekle
        $this->addItemToBasket($extraId,'EXTRA');
    }


    /**
     * Araçı Spete Ekleme için kullanılır
     * @param integer $carId Sepete eklenecek extra
     * @param object $model Kontrol için CAR Model
     */
    public function addCarToBasket($carId, model $model)
    {

        #Boş veya integer değil mi?
        if(helper::isEmpty($carId) AND helper::isDigit($carId))
        {
            redirect::to('');
            exit;
        }

        #Gerçekten var mı bu extra database de?
        if(!$model->ctrlCarById($carId))
        {
            redirect::to('');
            exit;
        }

        #Her şey yolunda gitmiş ise car'ta extrayı ekle
        $this->addItemToBasket($carId,'CAR');
    }


    /**
     * Basket içerisine araba veye donanım eklemek için kullanılır
     * @param integer $itemId   araç veya item'in id'si
     * @param string $basketType Eklenen nedir? Araç mı? Donanım mı
     */
    public function addItemToBasket($itemId, $basketType)
    {
        #unset($_SESSION['BASKET']); exit;

        #Slice işleminin başlayacağı yer
        #Daha sonra -1 geriye gidip kesmeye başlayacağız
        $i        = 0;

        #Eğer false ise yeni bir tane ekle..
        $wasFound = false;

        #Sepet Oluşturulmamış ise yeni sepeti oluştur.
        if(!isset( $_SESSION['BASKET'][$basketType] ) OR count( $_SESSION['BASKET'][$basketType] ) < 1)
        {
            $this->createBasket($itemId, 1, $basketType);
        }

        #Aynı ürün sepette var ise bu ürünün miktarını +1 yap
        else{

            if($basketType == 'EXTRA')
            {
                foreach($_SESSION['BASKET'][$basketType] as $basket)
                {
                    $i++;

                    while( list($key,$value) = each($basket) )
                    {
                        #session'daki itemId  $itemId'ye uyuşuyor mu?
                        if($key == 'itemId' AND $value == $itemId )
                        {
                            #uyuşuyor mu : OK! quantity'yi +1 yap
                            array_splice($_SESSION['BASKET'][$basketType], $i-1, 1, array( array( 'itemId'=> $itemId, 'quantity' => $basket['quantity']+1 ) ) );
                            $wasFound = true;
                        }
                    }
                }

                #Spet varsa ve sepetin içinde eklenen ürün yok ise ürünğ spete ekle.
                if($wasFound == false)
                {
                    #yeni bir tane ekle
                    $this->itemPushBasket($basketType, $itemId);
                }

            }

        }


    }

    /**
     * Sepet oluşturur
     * @param  integer $itemId     ürünün id'si
     * @param  integer $quantity   ürün mitktarı
     * @param  string $basketType sepet tipi
     * @return void
     */
    public function createBasket($itemId, $quantity, $basketType)
    {
        $_SESSION['BASKET'][$basketType] = array(array('itemId'=>$itemId,'quantity'=>$quantity ) );
    }


    /**
     * Sepete yeni bir tane ekler
     * @param  string $basketType sepet tiipi
     * @param  integer $itemId     item'in tipi
     * @return void
     */
    public function itemPushBasket($basketType, $itemId)
    {
         array_push( $_SESSION['BASKET'][$basketType], array('itemId'=>$itemId,'quantity'=>1) );
    }

    /**
     * Tüm sepeti boşaltır..
     * @return void
     */
    public function emptyBasket()
    {
        if(isset($_SESSION['BASKET']))
        {
            unset($_SESSION['BASKET']);
        }
    }

    /**
     * Sepeeten bir tane ürün çıkarmak için kullanılır..
     * @param  integer $itemId çıkarılacak ürünün id'si
     * @param  string $basketType sepet tipi
     * @return boolean
     */
    public function removeItemFromBasket($itemId, $basketType)
    {


        $allExtra = $this->getAllExtra();
        $count = count($this->getAllExtra());

        for( $i = 0; $i<=$count; $i++)
        {
            if($allExtra[$i]['itemId'] == $itemId)
            {
                 unset($_SESSION['BASKET'][$basketType][$i]);
                 sort($_SESSION['BASKET'][$basketType]);
            }
        }


    }

    /**
     * Tüm extraları geri döndürür
     * @return array
     */
    public function getAllExtra()
    {
        //session::debug();
        if(is_array($_SESSION['BASKET']['EXTRA']))
        {
            return array_filter($_SESSION['BASKET']['EXTRA']);
        }

    }





















}