<?php if(!defined('OSCAR_RENT_A_CAR')) exit('<pre>Permission error! Please Go away :) </pre>'); ?>
<style>
    .disabled_form_overlay{
        width:645px;

    }
    .subtotal i{
        font-size: 10px;
        font-style: normal;
        color: #888;

    }

    .sbOptions{
        overflow: auto;
    }
</style>
<div id="main">
                <form action="<?php echo BASEPATH.'Cars/'; ?>" class="main-form disabled_form" />
                    <div id="book_car" class="title-form current">
                        <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAMAAAAoLQ9TAAAAdVBMVEVDS1ZDS1ZDS1ZDS1ZDS1ZDS1ZDS1ZDS1ZDS1ZDS1ZDS1ZDS1ZDS1ZDS1ZDS1ZDS1ZDS1ZDS1ZDS1ZDS1ZDS1ZDS1ZDS1ZDS1ZDS1ZDS1ZDS1ZDS1ZDS1ZDS1ZDS1ZDS1ZDS1ZDS1ZDS1ZDS1ZDS1ZDS1ZDS1YRm3lyAAAAJnRSTlMABgwYGycqLTA2OTxIUYSHio2WmZyfoqirrrG3vcDh5Ofq7fDz/JwIDlYAAAB+SURBVBjTVchJFoIwAATRDokiyOyAihCCUvc/ohsfQ+3qyxRDKtd63zqlQ2FUctVhApiOulAqEOtBnyQ9T8UEgfTBSpavBAJpxEmOsMCNztqO+wIJAJwX0AvgrRXiGebTBtRAoy1E3kc7UJ5rD/9AgWz9jKCSXZVMPa471uYHQAgTgWUcvWgAAAAASUVORK5CYII=" alt="" />
                        Edit Location &amp; Date
                    </div>
                    <div id="book_car_content" class="content-form ">
                        <div class="disabled_form_overlay"></div>
                        <div class="location-block">
                            <div class="form-block location">Location</div>
                            <input class="location" type="text" value="<?php echo $this->model->locationById($this->searchInfo['location'])->lokasyonad?>"  name="select_time_from" disabled="disabled" />
                        </div>
                        <div class="form-block pick-up">
                            <h4>Pick-up date</h4>
                            <input class="datepicker" type="text" value="<?php echo $this->searchInfo['data_from']; ?>" name="data_from" disabled="disabled" />
                            <input class="time-select" type="text" size="5" value="<?php echo $this->searchInfo['time_from']?>" name="time_from" disabled="disabled" />
                        </div>
                        <div class="form-block drop-off">
                            <h4>Drop-off date</h4>
                            <input class="datepicker" type="text" name="data_to" value="<?php echo $this->searchInfo['data_to']; ?>" disabled="disabled" />
                            <input class="time-select" type="text" size="5" value="<?php echo $this->searchInfo['time_to']; ?>" name="time_to" disabled="disabled" />
                        </div>

                        <div class="form-block form-submit">
                            <input class="form-edit orange_button" type="submit" value="Edit" />
                        </div>
                    </div>
                    <div class="clear"></div>
                </form>
                <div id="primary">
                    <div class="clear"></div>
                    <aside id="secondary" class="sidebar-left">
                        <div class="widget">
                            <h3 class="widget-title">
                                <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAMAAAAoLQ9TAAAAclBMVEVDS1ZDS1ZDS1ZDS1ZDS1ZDS1ZDS1ZDS1ZDS1ZDS1ZDS1ZDS1ZDS1ZDS1ZDS1ZDS1ZDS1ZDS1ZDS1ZDS1ZDS1ZDS1ZDS1ZDS1ZDS1ZDS1ZDS1ZDS1ZDS1ZDS1ZDS1ZDS1ZDS1ZDS1ZDS1ZDS1ZDS1ZDS1YW7IDIAAAAJXRSTlMAAwYMJyotMDk8P0hOcn6NkJOlq663ur3GzM/V2Nve5PDz9vn8HGFGjwAAAJxJREFUGNNlj1tCwjAAwEKdhY1HW8YbZUqb+1/Rj+3PXCAJAF26t3ZPHQv7t6q+9wCEs7UMIQyleg5AdlrDMMB6MkFsNQLXKxBr+yRbgF57oJj4st9dXqqvy673STWEcbaMIfhDNbA6qZ5WfPjLtxs4qB5g45NihtHbzRGyedYet7A9EmuLUJzivBAn85KeB+jzkv5vDujSQx/z/h/p6hC8DcfSvwAAAABJRU5ErkJggg==" alt="" />
                                Order Info
                            </h3>
                            <h4>
                                Car
                                <a href="<?php echo BASEPATH?>Cars/" title="">Edit</a>
                            </h4>
                            <div class="widget-content main-block product-widget-mini">

                                <div class="product-info">
                                    <div class="entry-format">
                                        <div><?php echo ucwords(helper::toLower($this->carByPkey->markaad)); ?></div>
                                        <span style="font-size: 14px"> <?php echo ucwords(helper::toLower($this->carByPkey->model)); ?></span>
                                    </div>
                                    <div class="features">
                                        <p><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAAABHNCSVQICAgIfAhkiAAAAKpJREFUOI3t0yEKAkEUxvHfLuIBTCbrwlarR/AEgsmkV/ACnkBBtHoAz2ASw6YFk2AyWa2GHYswKq7RPwzD+5jv4/F4k+wPhTo0InoTU7RDfcEMt+eHaSSgixzLcPKgRTvIwn1FJxieyUIHZ7SCdkz2h2KFEXbYYB7p6sEEA/SwTjF8Y3jFMFUN7FuasSF+zD/gRwGnGv5TA32MVStaqnb/FSW2KLBI6n7nO8vQHaJiqzNrAAAAAElFTkSuQmCC" alt="" />
                                            <?php echo helper::toLower($this->carByPkey->kasaingad); ?></p>
                                        <p><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAMAAAAoLQ9TAAAAaVBMVEXKzNDKzNDKzNDKzNDKzNDKzNDKzNDKzNDKzNDKzNDKzNDKzNDKzNDKzNDKzNDKzNDKzNDKzNDKzNDKzNDKzNDOz9PR09bV1tnY2t3c3eDj5Obm5+nq6+zt7u/x8fL09fb4+Pn7/Pz///+OpB/0AAAAFHRSTlMABicqLXKNkJO3zM/V2Nvw8/b5/DbgOXEAAACGSURBVBjTbY/ZFoMgDESjVXDppom1am2B///IMlF8ae8DM+RMCCGK5KZhbkxOO2UnSlfqNavloM5iwap1YYQYooJhZu8WKJ9SYF38sEUukClMY5jhztRDVifycXA3LQw+gGe0d7riSYx4hJe2VJLSbx8Pu49NcEEaObD/vv6znK7firTb+l/ISBBvthVvpwAAAABJRU5ErkJggg==" alt="" />
                                         <?php echo helper::toLower( $this->carByPkey->vitesingad); ?> transmission</p>
                                        <p><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAAABHNCSVQICAgIfAhkiAAAAWtJREFUOI1900GEVXEUBvDfvJcY3ihDxBCTySQaZYhWZVat36ZFahMtMhGJVrWPGaJtxGjRplWLNi0ytEijYTalFDGKeMQlhsss/t/17uS9dzjuuef+z3e+/znfnfrwcdsEe4wu7o07cGhCcRdnWnE96lBnTPEqvmMx/hkPJgFcxGHcxAs8xwbm4i/xFK9xC9O41Fyhh038wLe8Vyk4lwbPkjuCq3iI4zjayYelAFzBfAq/YhkX8D65eaxgB6dRNUOcxln8DOCn5Ht51snt4G9AZ9szGOBJUO8GpMZ5nEpc4XbYPsKfNkAVkDpsmq41/mEvuWOt8xVMRUjLeBvUQSiOsq00mMNlbDcMdvEGC/F+wNrexwlFXO/wu2HQw6/Q3QrNJUVAa2lwR9nSpqFCu5jp5I43cFLZ90CZ/nVlZSuKwHrKBjYy7GvtGfxvq7hvqP8u1pVNHbBxABRpv0rcN9zEAZv0N+7hSyseafsMGl3vr6omhAAAAABJRU5ErkJggg==" alt="" />
                                            <?php echo helper::toLower($this->carByPkey->renkingad); ?> </p>
                                        <p><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAAABHNCSVQICAgIfAhkiAAAAQdJREFUOI2d079HRWEYwPFPOSLuFFEul8udSkQcIhpaIlqjqbvUEm2NDS0NaUtrFKk/ICKiNQ2XO10i7hQRV01NDec9XDnndE7P9D6/vu/z431Hnp4759iSL8fYz3NGaOEU3Qx/jJmc3HVMRUG5w21G0Bc2M+xLuMbKaF5pf8gRPtD8D6CGRUnbcdrCKuoZwTEa2MY9XjGJNwzQSAG7BTf2sYw9zIYK6jjDTlSQmEoXbXwGfRAqmIayM2iFSoTkGiaqAGJ0wvkbD1irApgfAsANNqoA5n4BHrFQBZCuLpX3YCsN6KM5pNcDRJk1kvR8IHm+PZzgMgX0MF6Q/IIrySAvMCb5fIfwA46eLzPeM/T2AAAAAElFTkSuQmCC" alt="" />
                                            <?php echo helper::toLower($this->carByPkey->yakitingad); ?> </p>
                                    </div>
                                </div>
                                </div>
                            <h4 style="margin-top: 10px">
                                Date &amp; Location
                                 <a href="<?php echo BASEPATH?>Cars/" title="">Edit</a>
                            </h4>
                            <div class="widget-content widget-info">
                                <h4>Pick Up time</h4>
                                <p><?php echo $this->searchInfo['data_from']?> at <?php echo $this->searchInfo['time_from']?></p>
                                <h4>Return time</h4>
                                <p><?php echo $this->searchInfo['data_to']?> at <?php echo $this->searchInfo['time_to']?></p>
                                <h4>Pickup and Return Location</h4>
                                <p><?php
                                        echo $this->model->locationById($this->searchInfo['location'])->lokasyonad;
                                        $return = $this->model->locationById($this->searchInfo['return_location'])->lokasyonad;
                                        if($return)
                                        {
                                            echo ' &rarr; '.$return;
                                        }

                                    ?>
                                </p>
                                <div class="subtotal_content">
                                    <div class="subtotal">

                                        Subtotal: <span class="price">
                                            <?php echo $this->BASKET->calcSubTotal($this->carByPkey->markagunfiyatsterlin, $this->searchInfo['data_from'],$this->searchInfo['data_to'])?>

                                        </span>
                                    </div>
                                </div>
                            </div>
                            <h4 class="extras">Extras</h4>
                            <div class="widget-content widget-extras">
                                <?php
                                    $totalAllExtraPrice=0;

                                        #Sepetteki tüm donanımlar
                                        $basketExtra            = $this->BASKET->getAllExtra();

                                        #Doannımları hesapla
                                        $countExtra = count($basketExtra);

                                    if($countExtra > 0)
                                    {


                                       for($i = 0; $i < $countExtra; $i++):

                                        if(!empty($basketExtra[$i]['quantity']) OR !empty($basketExtra[$i]['itemId']))
                                        {

                                            $allExtras = $this->BASKET->getAllExtra();
                                            #Database'deki donanım
                                            $databaseExtra              = $this->model->getExtraById( $allExtras[$i]['itemId'] );

                                            #Donanım miktarı
                                            $quantity = $basketExtra[$i]['quantity'] > 1 ?  '&nbsp;&nbsp;x&nbsp;&nbsp;'.$basketExtra[$i]['quantity'] : '';

                                            #Her bir donanımın toplam fiyatı
                                            $totalEeachExtraPrice       = $this->BASKET->calcExtraQuantityTotal($databaseExtra->sterlinfiyat,$basketExtra[$i]['quantity']);

                                            #Tüm donanımın fiyatı
                                            $totalAllExtraPrice         += $totalEeachExtraPrice;

                                                echo '<p> <a href="'.BASEPATH.'Cars/secondStepChooseExtras/1?RemoveExtra='.$basketExtra[$i]['itemId'].'">x</a> &nbsp; '.$databaseExtra->donanimingad.$quantity.'<span class="price">'.money_format("%10.2n",$totalEeachExtraPrice).' </span></p>';
                                        }

                                        endfor;
                                        //$this->BASKET->removeItemFromBasket(6,'EXTRA');
                                    }
                                    else{
                                        echo 'No Extra...';
                                    }
                                ?>
                                <div class="clear"></div>
                            </div>
                            <div class="widget-footer widget-footer-total">
                                Total: <span class="price"><?php echo $this->BASKET->calcTotal($totalAllExtraPrice); ?> </span>

                            </div>
                        </div>
                    </aside>

                    <div id="content" class="sidebar-middle">
                        <form action="<?php echo BASEPATH?>Cars/thirdStepReviewComplete" method="POST" id="complete_reservation" />
                            <div class="widget main-widget main-widget-3column">
                                <div class="widget-title">
                                    <div>
                                        <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQBAMAAADt3eJSAAAAJFBMVEVDS1ZDS1ZDS1ZDS1ZDS1ZDS1ZDS1ZDS1ZDS1ZDS1ZDS1ZDS1bwY3eUAAAAC3RSTlMABkJIhIeKjeTn6vKYHgQAAAA8SURBVAjXYxDp3g0EOxwZoneDwVaG1QoMQMC0i2E3AxjsBkHu3btRGRRJrTYA0cy7YJZuYxCfDaJ3FgIAVMUzVcZqeM4AAAAASUVORK5CYII=" alt="" />
                                        Complete reservation form
                                    </div>
                                    <div class="clear"></div>
                                </div>
                                <!-- <h4>Note</h4>
                                <div class="widget-content widget-note">
                                    <h4>Upon completing this reservation, you will receive:</h4>
                                    <ul>
                                        <li>Your rental voucher to produce on arrival at the rental desk</li>
                                        <li>A toll-free customer support number</li>
                                    </ul>
                                </div> -->
                                <h4>Personal information</h4>
                                <div class="widget-content">
                                        <div class="form_element">
                                            <div>First name</div>
                                            <input type="text" autocomplete="off" value="<?php echo input::get('first_name','s')?>" placeholder="Enter your first name" name="first_name" />
                                        </div>
                                        <div class="form_element">
                                            <div>Last name</div>
                                            <input type="text" autocomplete="off" value="<?php echo input::get('last_name','s')?>" placeholder="Enter your last name" name="last_name" />
                                        </div>
                                        <div class="form_element">
                                            <div>Age</div>
                                            <input style="width: 50px" type="text" value="<?php echo input::get('age','n')?>" placeholder="Age" name="age" />
                                        </div>
                                        <div class="clear"></div>
                                        <div class="form_element">
                                            <div>Email address</div>
                                            <input type="text" autocomplete="off" value="<?php echo input::get('email_address','email')?>" placeholder="Enter your email address" name="email_address" />
                                        </div>
                                        <div class="form_element">
                                            <div>Confirm email address</div>
                                            <input type="text" autocomplete="off" value="<?php echo input::get('confirm_email_address','email')?>" placeholder="Confirm your email address" name="confirm_email_address" />
                                        </div>
                                        <div class="clear"></div>
                                        <div class="form_element">
                                            <div>Phone number</div>
                                            <input type="text" autocomplete="off" value="<?php echo input::get('phone_number','phone')?>" placeholder="Enter your phone number" name="phone_number" />
                                        </div>
                                        <div class="clear"></div>
                                        <div class="form_element form_element_checkbox">
                                            <input id="location-checkbox" <?php if(input::get('send_email') == 1): echo 'checked="checked"'; endif;?> type="checkbox" class="styled" name="send_email" value="1" />
                                            <label for="location-checkbox"> Send me latest news &amp; updates</label>
                                        </div>
                                        <div class="clear"></div>
                                </div>
                                <h4>Credit card information</h4>
                                <div class="widget-content personal_info">
                                    <div class="form_element">
                                        <div>Card Type</div>
                                            <select class="select" name="card_type">
                                            <?php
                                                $cards = registry::get('checkCreditCard')->cards;
                                                $count = count($cards);
                                                for($i = 0; $i < $count; $i++)
                                                {
                                                    echo '<option'; ?> <?php if(input::get('card_type') == $cards[$i]['name']){echo 'selected="selected"'; }?> <?php echo 'value="'.$cards[$i]['name'].'" >'.$cards[$i]['name'].'</option>';
                                                }
                                            ?>


                                            </select>
                                    </div>
                                    <div class="clear"></div>
                                    <div class="form_element">
                                        <div>Card number</div>
                                        <input type="text" autocomplete="off" value="<?php echo input::get('card_number','n')?>" placeholder="XXXX-XXXX-XXXX-XXXX" name="card_number" />
                                    </div>
                                    <div class="form_element">
                                        <div>Expiration date</div>
                                        <div class="product-select-count">
                                            <select class="select" name="expiration_date_month">
                                                <?php for($i = 1; $i<=12; $i++): ?>
                                                    <option <?php if(input::get('expiration_date_month') == $i): echo 'selected="selected"'; endif; ?>value="<?php echo $i?>" /><?php echo $i?>
                                                <?php endfor; ?>
                                            </select>
                                        </div>
                                        <div class="product-select-count expiration_date_year">
                                            <select class="select" name="expiration_date_year">
                                            <?php $year = date('y');  for($i = $year; $i<$year+10; $i++){?>
                                                <option <?php if(input::get('expiration_date_year') == $i): echo 'selected="selected"'; endif; ?> value="<?php echo $i; ?>"/>20<?php echo $i ?>
                                            <?php }  ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form_element">
                                        <div>CVV</div>
                                        <input class="cvv" type="text" value="<?php echo input::get('cvv')?>" placeholder="XXX" name="cvv" />
                                    </div>
                                    <div class="clear"></div>
                                    <div class="form_element">
                                        <div>Name on card</div>
                                        <input type="text" autocomplete="off" value="<?php echo input::get('card_first_name')?>" placeholder="First name" name="card_first_name" />
                                    </div>
                                    <div class="form_element">
                                        <div>Last Name on card</div>
                                        <input  type="text" value="<?php echo input::get('card_last_name')?>" placeholder="Last name" name="card_last_name" />
                                    </div>
                                    <div class="clear"></div>
                                </div>
                                <h4>Billing address</h4>
                                <div class="widget-content personal_info">
                                    <div class="form_element">
                                        <div>City</div>
                                        <input type="text" autocomplete="off" value="<?php echo input::get('city')?>" placeholder="Enter city name" name="city" />
                                    </div>
                                    <div class="form_element" >
                                        <div>Country</div>
                                        <div class="card_country" >
                                            <select class="select" name="card_country">
                                                <option value="0">Select a country</option>
                                                <?php
                                                    $countries = $this->model->getAllCountries();
                                                    foreach($countries as $country):
                                                    ?>
                                                        <option <?php if(input::get('card_country') == $country->country_code): echo 'selected="selected"'; endif; ?> value="<?php echo $country->country_code; ?>"/><?php echo $country->country_name ?>
                                                <?php
                                                    endforeach;
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form_element">
                                        <div>Postal code</div>
                                        <input class="postal_code" type="text" value="<?php echo input::get('postal_code','n')?>" placeholder="XXXXX" name="postal_code" />
                                    </div>
                                    <div class="clear"></div>
                                    <div class="form_element">
                                        <div>Billing address</div>
                                        <input class="billing_address" type="text" value="<?php echo input::get('billing_address','address')?>" placeholder="Enter billing address" name="billing_address" />
                                    </div>
                                    <div class="form_element">
                                        <div>Billing address 2 <span>(Optional)</span></div>
                                        <input class="billing_address" type="text" value="<?php echo input::get('billing_address_2','address')?>" placeholder="Enter billing address" name="billing_address_2" />
                                    </div>
                                    <div class="clear"></div>
                                </div>
                            </div>
                            <div class="next_page">
                                <input class="continue_button blue_button" type="submit" value="Book Now" />
                            </div>
                        </form>
                    </div>
                    <div class="clear"></div>
                </div>
            </div>

            <script>

            $(function(){

                function emptyVal()
                {
                    var form    = document.complete_reservation;
                    var leng    = form.length;


                    return false;
                }

            }());

            </script>










