
<style>
    .disabled_form_overlay{
        width:645px;

    }
    .subtotal i{
        font-size: 10px;
        font-style: normal;
        color: #888;

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
                                        <p><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAAABHNCSVQICAgIfAhkiAAAAKpJREFUOI3t0yEKAkEUxvHfLuIBTCbrwlarR/AEgsmkV/ACnkBBtHoAz2ASw6YFk2AyWa2GHYswKq7RPwzD+5jv4/F4k+wPhTo0InoTU7RDfcEMt+eHaSSgixzLcPKgRTvIwn1FJxieyUIHZ7SCdkz2h2KFEXbYYB7p6sEEA/SwTjF8Y3jFMFUN7FuasSF+zD/gRwGnGv5TA32MVStaqnb/FSW2KLBI6n7nO8vQHaJiqzNrAAAAAElFTkSuQmCC" alt="" /> <?php echo helper::toLower($this->carByPkey->kasaingad); ?></p>
                                        <p><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAMAAAAoLQ9TAAAAaVBMVEXKzNDKzNDKzNDKzNDKzNDKzNDKzNDKzNDKzNDKzNDKzNDKzNDKzNDKzNDKzNDKzNDKzNDKzNDKzNDKzNDKzNDOz9PR09bV1tnY2t3c3eDj5Obm5+nq6+zt7u/x8fL09fb4+Pn7/Pz///+OpB/0AAAAFHRSTlMABicqLXKNkJO3zM/V2Nvw8/b5/DbgOXEAAACGSURBVBjTbY/ZFoMgDESjVXDppom1am2B///IMlF8ae8DM+RMCCGK5KZhbkxOO2UnSlfqNavloM5iwap1YYQYooJhZu8WKJ9SYF38sEUukClMY5jhztRDVifycXA3LQw+gGe0d7riSYx4hJe2VJLSbx8Pu49NcEEaObD/vv6znK7firTb+l/ISBBvthVvpwAAAABJRU5ErkJggg==" alt="" /> <?php echo helper::toLower( $this->carByPkey->vitesingad); ?> transmission</p>
                                        <p><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAAABHNCSVQICAgIfAhkiAAAAWtJREFUOI1900GEVXEUBvDfvJcY3ihDxBCTySQaZYhWZVat36ZFahMtMhGJVrWPGaJtxGjRplWLNi0ytEijYTalFDGKeMQlhsss/t/17uS9dzjuuef+z3e+/znfnfrwcdsEe4wu7o07cGhCcRdnWnE96lBnTPEqvmMx/hkPJgFcxGHcxAs8xwbm4i/xFK9xC9O41Fyhh038wLe8Vyk4lwbPkjuCq3iI4zjayYelAFzBfAq/YhkX8D65eaxgB6dRNUOcxln8DOCn5Ht51snt4G9AZ9szGOBJUO8GpMZ5nEpc4XbYPsKfNkAVkDpsmq41/mEvuWOt8xVMRUjLeBvUQSiOsq00mMNlbDcMdvEGC/F+wNrexwlFXO/wu2HQw6/Q3QrNJUVAa2lwR9nSpqFCu5jp5I43cFLZ90CZ/nVlZSuKwHrKBjYy7GvtGfxvq7hvqP8u1pVNHbBxABRpv0rcN9zEAZv0N+7hSyseafsMGl3vr6omhAAAAABJRU5ErkJggg==" alt="" /> <?php echo helper::toLower($this->carByPkey->renkingad); ?> </p>
                                        <p><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAAABHNCSVQICAgIfAhkiAAAAQdJREFUOI2d079HRWEYwPFPOSLuFFEul8udSkQcIhpaIlqjqbvUEm2NDS0NaUtrFKk/ICKiNQ2XO10i7hQRV01NDec9XDnndE7P9D6/vu/z431Hnp4759iSL8fYz3NGaOEU3Qx/jJmc3HVMRUG5w21G0Bc2M+xLuMbKaF5pf8gRPtD8D6CGRUnbcdrCKuoZwTEa2MY9XjGJNwzQSAG7BTf2sYw9zIYK6jjDTlSQmEoXbXwGfRAqmIayM2iFSoTkGiaqAGJ0wvkbD1irApgfAsANNqoA5n4BHrFQBZCuLpX3YCsN6KM5pNcDRJk1kvR8IHm+PZzgMgX0MF6Q/IIrySAvMCb5fIfwA46eLzPeM/T2AAAAAElFTkSuQmCC" alt="" /> <?php echo helper::toLower($this->carByPkey->yakitingad); ?> </p>
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


                                            #Database'deki donanım

                                            $allExtras = $this->BASKET->getAllExtra();
                                            $databaseExtra              = $this->model->getExtraById( $allExtras[$i]['itemId'] );

                                            #Donanım miktarı
                                            $quantity = $basketExtra[$i]['quantity'] > 1 ?  '&nbsp;&nbsp;x&nbsp;&nbsp;'.$basketExtra[$i]['quantity'] : '';

                                            #Her bir donanımın toplam fiyatı
                                            $totalEeachExtraPrice       = $this->BASKET->calcExtraQuantityTotal($databaseExtra->sterlinfiyat,$basketExtra[$i]['quantity']);

                                            #Tüm donanımın fiyatı
                                            $totalAllExtraPrice         += $totalEeachExtraPrice;
                                            if($totalEeachExtraPrice == 0)
                                            {
                                                echo '<p> <a  href="'.BASEPATH.'Cars/secondStepChooseExtras/1?RemoveExtra='.$basketExtra[$i]['itemId'].'">x</a> &nbsp; '.$databaseExtra->donanimingad.$quantity.'<span class="price"> Free</span></p>';
                                            }
                                            else{
                                                echo '<p> <a  href="'.BASEPATH.'Cars/secondStepChooseExtras/1?RemoveExtra='.$basketExtra[$i]['itemId'].'">x</a> &nbsp; '.$databaseExtra->donanimingad.$quantity.'<span class="price">'.money_format("%10.2n",$totalEeachExtraPrice).' </span></p>';
                                            }

                                        }

                                        endfor;

                                    }
                                    else{
                                        echo 'No Extra...';
                                    }
                                ?>
                                <div class="clear"></div>
                            </div>
                            <div class="widget-footer widget-footer-total">
                                Total: <span class="price"><?php echo $totalPrice = $this->BASKET->calcTotal($totalAllExtraPrice); ?> </span>

                            </div>
                        </div>
                    </aside>

                    <div id="content" class="sidebar-middle">
                        <form action="<?php echo BASEPATH; ?>Cars/thirdStepReviewComplete" method="POST"/>
                            <div class="widget main-widget product-widget main-widget-3column">
                                <div class="widget-title">
                                    <div>
                                        <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQBAMAAADt3eJSAAAAJFBMVEVDS1ZDS1ZDS1ZDS1ZDS1ZDS1ZDS1ZDS1ZDS1ZDS1ZDS1ZDS1bwY3eUAAAAC3RSTlMABkJIhIeKjeTn6vKYHgQAAAA8SURBVAjXYxDp3g0EOxwZoneDwVaG1QoMQMC0i2E3AxjsBkHu3btRGRRJrTYA0cy7YJZuYxCfDaJ3FgIAVMUzVcZqeM4AAAAASUVORK5CYII=" alt="" />
                                        Available Extras
                                    </div>
                                    <div class="clear"></div>
                                </div>
                        <?php
                        $i = 0;
                        $count = count($this->allExtra);
                        foreach($this->allExtra as $extra):
                            $i++;
                            $lastChild = $i == $count ? 'last_child' : null;
                         ?>
                                <div class="post <?php echo $lastChild; ?>">
                                    <div class="checkbox-block_container">
                                        <div class="main-block_container">
                                            <div class="additional-block_container">
                                                <div class="checkbox-block">
                                                    <a title="Add Card" href="<?php echo BASEPATH?>Cars/secondStepChooseExtras/<?php echo $this->carPkey;?>?AddExtraToBaske=<?php echo $extra->pkey; ?> " style="font-size: 43px; text-decoration: none">+</a>
                                                </div>
                                                <div class="main-block">
                                                    <div class="product-img">
                                                        <img src="<?php echo BASEPATH?>images/<?php echo $extra->extraImage; ?>" alt="" />
                                                    </div>
                                                    <div class="product-info">
                                                        <h3 class="entry-format"><?php echo $extra->donanimingad?> </h3>
                                                        <div><?php echo $extra->extraInfo?></div>
                                                    </div>
                                                </div>
                                                <div class="additional-block">
                                                    <?php if($extra->sterlinfiyat == 0):?>
                                                    FREE
                                                    <?php else:?>
                                                       <?php echo money_format("%10.2n",$extra->sterlinfiyat)?><span style="font-size: 12px; color: #888">/day</span>
                                                    <?php endif;?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="clear"></div>
                                </div>

                        <?php endforeach; ?>
                            </div>
                            <div class="next_page">
                                <input class="continue_button blue_button" type="submit" value="Continue to checkout" />
                            </div>
                        </form>
                    </div>
                    <div class="clear"></div>
                </div>
            </div>