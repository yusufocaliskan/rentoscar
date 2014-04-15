<?php
if(!defined('OSCAR_RENT_A_CAR')) exit('<pre>Permission error! Please Go away :) </pre>');



class payment
{

    public $post;

    /**
     * Kredi kartını kontrol eder.
     * Girilen kard numaraları global kaart numaraları ile eşleişiyor mu?
     * @var object
     */
    private $checkCreditCard;

    public $model;

    public function __construct()
    {

        $this->checkCreditCard = registry::setObject('checkCreditCard','libs/');
    }


    public function formControl()
    {

            input::set(
                [
                'first_name'=>'s',
                'last_name'=>'s',
                'age'=>'n',
                'email_address'=>'email',
                'confirm_email_address'=>'email',
                'phone_number'=>'n',
                 'card_number'=>'n',
                 'expiration_date_month'=>'n',
                 'expiration_date_year'=>'n',
                 'cvv'=>'n',
                 'card_first_name'=>'s',
                 'card_last_name'=>'s',
                 'city'=>'s',
                 'card_country'=>'s',
                 'postal_code'=>'n',
                 'billing_address'=>'address',
                 'billing_address_2'=>'address',
                 'send_email'=>'n',
                 'card_type'=>'s'
                 ]
            );

            extract( $this->post   = input::pushInArray(
                ['first_name','last_name','age','email_address','confirm_email_address','phone_number',
                 'card_number','expiration_date_month','expiration_date_year','cvv','card_first_name','card_last_name',
                 'city','card_country','postal_code','billing_address','billing_address_2',
                 'send_email','card_type'
                 ]
            ) );

            //debug::pre(input::$pushInArray);

            /** =================================== | NAME | =================================== **/
        if(helper::isPost())
        {
            #CSRF ÖNEMLi!
            if(!helper::isValidToken())
            {
                redirect::to('');
            }
            #Adı boş mu
            else if(helper::isEmpty( $first_name) )
            {
                error::notice('warning','Please enter your first name');
            }

            #isim sadece rakamlardan mı oluşuyor?
            else if(helper::validText($first_name,'n'))
            {
                error::notice('warning','First name connot contain numeric number.');
            }

            #İsim içerisinde farklı karakterler varmı?
            else if(!helper::validText($first_name,'s'))
            {
                error::notice('warning','First name cannot contain special character.');
            }

            #Ismın kısalığı : min: 2
            else if( helper::getLeng($first_name) <= 2 )
            {
                error::notice('warning','Your name is too short');
            }

            #Ismın uzunluğu
            else if( helper::getLeng($first_name) >= 60 )
            {
                error::notice('warning','Your name is too long');
            }



            /** =================================== | LAST NAME | =================================== **/

            #Soyadı boş mu
            else if( helper::isEmpty($last_name))
            {
                error::notice('warning','Please enter your last name');
            }

            #isim sadece rakamlardan mı oluşuyor?
            else if(helper::validText($last_name,'n'))
            {
                error::notice('warning','Last name connot contain numeric number.');
            }

            #İsim içerisinde farklı karakterler varmı?
            else if(!helper::validText($last_name,'s'))
            {
                error::notice('warning','Last name cannot contain special character.');
            }

            #Ismın kısalığı : min: 2
            else if( helper::getLeng($last_name) <= 2 )
            {
                error::notice('warning','Your name is too short');
            }

            #Ismın uzunluğu
            else if( helper::getLeng($last_name) >= 60 )
            {
                error::notice('warning','Your name is too long');
            }


            /** =================================== | AGE | =================================== **/


            #Yaşı boş mu
            else if( helper::isEmpty($age))
            {
                error::notice('warning','Please enter your age');
            }

            #Yaş numeric mi?
            else if($age == 0)
            {
                error::notice('warning', 'Please enter valid age');
            }

            #Yaş içerisinde numaradan farklı karakterler varmı?
            else if(helper::validText($age,'n'))
            {
                error::notice('warning','Age cannot contain special character.');
            }

            #Yaş kısalığı : min: 2
            else if( helper::getLeng($age) <= 0 )
            {
                error::notice('warning', 'Please enter valid age');
            }

            #Yaş uzunluğu
            else if( helper::getLeng($age) > 3 )
            {
                error::notice('warning', 'Please enter valid age');
            }

            #18'den küçük mü?
            else if($age < config::get('MIN_PAYMENT_AGE'))
            {
                error::notice('warning','Your age shold be bigger then 18.');
            }

            #120'den büyük mü?
            else if($age > config::get('MAX_PAYMENT_AGE'))
            {
                error::notice('warning','Your age is too old. You cannot be a humman');
            }

            /** =================================== | E-MAIL | =================================== **/


            #emailler dolu mu?
            else if(helper::isEmpty( [$email_address, $confirm_email_address] ))
            {
                error::notice('warning',"E-mail cannot be empty.");
            }

            #email geçer li mi?
            else if( !helper::isEmail( [$email_address,$confirm_email_address] ) ){
                error::notice('warning','E-mail are invalid.');
            }

            #email'ler uyuşuyor mu?
            else if( $email_address != $confirm_email_address)
            {
                error::notice('warning','E-mails do not match. Please try again.');
            }

            /** =================================== | PHONE | =================================== **/

            #Telefon numarası boş mu
            else if(helper::isEmpty($phone_number))
            {
                error::notice('warning','Phone number cannot be empty.');
            }

            #Phone number format doğru mu?
            else if(helper::validText($phone_number,'phone'))
            {
                error::notice('warning','Enter a valid phone number');
            }

            #geçerli bir sayıda mi yazıldı / Pek işe yaramaz ama yine olsun :)
            else if(helper::getLeng($phone_number) < 5 OR helper::getLeng($phone_number) > 20)
            {
                error::notice('warning','Enter a valid phone number');
            }

            /** =================================== | CARD NUMBER | =================================== **/

            #Boş mu?
            else if(helper::isEmpty($card_number))
            {
                error::notice('error','Card Number connot be empty');
            }

            else if(!helper::isDigit($card_number))
            {
                error::notice('error','Please a valid car number!');
            }

            #Geçerli bir şey mi? Yani global kredi kartlarına uyuyor mu?
            else if($checkCreditCardError = $this->checkCreditCard->check($card_number,$card_type,$errornumber, $errortext))
            {
                if($checkCreditCardError != 1)
                error::notice('warning',$checkCreditCardError);
            }

            /** =================================== | expiration_date_month | =================================== **/

            #Card Ayı boş mu
            else if(helper::isEmpty($expiration_date_month))
            {
                error::notice('error','Please select expiration month.');
            }

            #1'den küçük 12'den büyük mü
            else if($expiration_date_month < 1 OR $expiration_date_month > 12)
            {
                error::notice('error','Please select a valid month');
            }

            else if(helper::validText($expiration_date_month,'n'))
            {
                error::notice('error','Please select a valid month');
            }


            /** =================================== | expiration_date_year | =================================== **/

            #Card Ayı boş mu
            else if(helper::isEmpty($expiration_date_year))
            {
                error::notice('error','Please select year.');
            }

            else if(helper::validText($expiration_date_year,'n'))
            {
                error::notice('error','Please select a valid year');
            }


            /** =================================== | CVV | =================================== **/

             #CVV boş mu
            else if( helper::isEmpty($cvv))
            {
                error::notice('warning','Please enter your CVV');
            }

            #CVV numeric mi?
            else if($cvv == 0)
            {
                error::notice('warning', 'Please enter valid CVV');
            }

            #CVV içerisinde numaradan farklı karakterler varmı?
            else if(helper::validText($cvv,'n'))
            {
                error::notice('warning','cvv cannot contain special character.');
            }

            #CVV kısalığı : min: 2
            else if( helper::getLeng($cvv) < 3 )
            {
                error::notice('warning', 'Please enter valid cvv');
            }

            #Yaş uzunluğu
            else if( helper::getLeng($cvv) > 3 )
            {
                error::notice('warning', 'Please enter valid cvv');
            }

            /** =================================== | FIRST_NAME ON CARD | =================================== **/

            #Adı boş mu
            else if(helper::isEmpty( $card_first_name) )
            {
                error::notice('warning','Please enter card first name');
            }

            #isim sadece rakamlardan mı oluşuyor?
            else if(helper::validText($card_first_name,'n'))
            {
                error::notice('warning','Card First name connot contain numeric number.');
            }

            #İsim içerisinde farklı karakterler varmı?
            else if(!helper::validText($card_first_name,'s'))
            {
                error::notice('warning','Card First name cannot contain special character.');
            }

            #Ismın kısalığı : min: 2
            else if( helper::getLeng($card_first_name) <= 2 )
            {
                error::notice('warning','Card name is too short');
            }

            #Ismın uzunluğu
            else if( helper::getLeng($card_first_name) >= 60 )
            {
                error::notice('warning','Card name is too long');
            }



            /** =================================== | CARD LAST NAME | =================================== **/

            #Soyadı boş mu
            else if( helper::isEmpty($card_last_name))
            {
                error::notice('warning','Please enter card last name');
            }

            #isim sadece rakamlardan mı oluşuyor?
            else if(helper::validText($card_last_name,'n'))
            {
                error::notice('warning','Card Last name connot contain numeric number.');
            }

            #İsim içerisinde farklı karakterler varmı?
            else if(!helper::validText($card_last_name,'s'))
            {
                error::notice('warning','Card Last name cannot contain special character.');
            }

            #Ismın kısalığı : min: 2
            else if( helper::getLeng($card_last_name) <= 2 )
            {
                error::notice('warning','Card last name is too short');
            }

            #Ismın uzunluğu
            else if( helper::getLeng($card_last_name) >= 60 )
            {
                error::notice('warning','Card last name is too long');
            }


            /** =================================== | CITY | =================================== **/

            #Şehir boş mu
            else if( helper::isEmpty($city))
            {
                error::notice('warning','Please enter your city');
            }

            #Şehir sadece rakamlardan mı oluşuyor?
            else if(helper::validText($city,'n'))
            {
                error::notice('warning','City name connot contain numeric number.');
            }

            #Şehir içerisinde farklı karakterler varmı?
            else if(!helper::validText($city,'s'))
            {
                error::notice('warning','City name cannot contain special character.');
            }

            #Şehir kısalığı : min: 2
            else if( helper::getLeng($city) <= 2 )
            {
                error::notice('warning','City name is too short');
            }

            #Şehir uzunluğu
            else if( helper::getLeng($city) >= 60 )
            {
                error::notice('warning','City name is too long');
            }
            /** =================================== | COUNTRY | =================================== **/

           else if(helper::isEmpty($card_country))
            {
                error::notice('warning','Please select your country.');
            }

            #Database'de var mı bu ülke?
            else if(!$this->model->countryCtrl($card_country))
            {
                error::notice('error','Please select a valid country');
            }


            /** =================================== | ADDRESS 1| =================================== **/
            else if(helper::isEmpty($billing_address))
            {
                error::notice('warning','Enter an adress please.');
            }

            else if(helper::validText($billing_address,'address'))
            {
                error::notice('warning','Enter a valid adress please.');
            }

            else if(helper::getLeng($billing_address) < 5)
            {
                error::notice('warning','Enter a valid adress please.');
            }

            else if($billing_address == $billing_address_2)
            {
                error::notice('warning','Enter a valid adress please.');
            }


            /** =================================== | ADDRESS 2 | =================================== **/


            else if(helper::validText($billing_address_2,'address'))
            {
                error::notice('warning','Enter a valid adress please.');
            }

            else if(helper::getLeng($billing_address_2) < 5)
            {
                error::notice('warning','Enter a valid adress please.');
            }

            #HER ŞEY YOLUNDA ISE!
            else{

                return true;

            }



        } // is POST






    }



}