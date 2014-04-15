<?php if(!defined('OSCAR_RENT_A_CAR')) exit('<pre>Permission error! Please Go away :) </pre>'); ?>
    <style>
    .location-block .sbHolder{
        margin-top: 24px;
        margin-bottom: 20px;
    }

    .sbOptions{
        overflow: auto;
        min-height: 200px !important;
    }
    </style>

    <div id="slider">
                 <div id="slider-img">
                    <ul class="slides">
                        <?php
                            $allNews = $this->newsModel->getAllSliderNews();
                            foreach($allNews as $news):
                        ?>
                            <li>
                    <?php if($news->showContent == 1):?>
                        <div class="post">
                            <div class="entry-header">
                                <h3 class="entry-format"> <?php echo $news->newsTitle;?></h3>
                            </div>
                            <div class="entry-content"><?php echo $news->newsBody?></div>
                            <div class="entry-meta">
                                <a href="<?php echo BASEPATH?>News/Read/<?php echo $news->newsLink?>" title="">Learn more</a>
                            </div>
                        </div>
                    <?php endif;?>
                            <?php if(!helper::isEmpty($news->newsBody)): ?>
                                <a href="<?php echo BASEPATH?>News/Read/<?php echo $news->newsLink?>">
                                    <img src="images/<?php echo $news->newsImage?>" alt="" />
                                </a>
                            <?php else:?>
                                    <img src="images/<?php echo $news->newsImage?>" alt="" />
                            <?php endif;?>
                            </li>

                        <?php endforeach;?>
                    </ul>
                </div>
                <div id="slider-content">

                <?php echo html::formOpen('Cars/firstStepChooseACar', array('class'=>'main-form','id'=>'slider-form','method'=>'GET','style'=>'margin-top:-120px')); ?>
                        <div class="main_form_navigation">
                            <div id="book_car" class="title-form current" style="width: 100%"><a href="#" title="">Book a Car</a></div>
                        </div>
                        <div id="book_car_content" class="content-form">
                            <div class="location-block">
                                <div class="form-block location">Location</div>

                                   <select class="select shortcode-select required"  name="location">
                                     <option value="0"> Select a location </option>
                                        <?php foreach($this->getLocations as $location): ?>
                                            <option value="<?php echo $location->pkey?>"> <?php echo $location->lokasyonad; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                <input id="location-checkbox" type="checkbox" class="styled" name="checkbox_location" value="1" />

                                <label for="location-checkbox"> Return at different location</label>
                                <div class="location-block return_location">
                                    <div class="form-block location">Return location</div>
                                    <select class="select shortcode-select required"  name="return_location">
                                     <option value="0"> Select a location </option>
                                        <?php foreach($this->getLocations as $location): ?>
                                            <option value="<?php echo $location->pkey?>"> <?php echo $location->lokasyonad; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-block pick-up">
                                <h4>Pick-up date</h4>
                                <input class="datepicker" type="text" value="" name="data_from" placeholder="Date"/>
                                <input class="time-select" type="text" size="5" value="" name="time_from" placeholder="Time"/>
                            </div>
                            <div class="form-block drop-off">
                                <h4>Drop-off date</h4>
                                <input class="datepicker" type="text" name="data_to" value="" placeholder="Date"/>
                                <input class="time-select" type="text" size="5" value="" name="time_to" placeholder="Time"/>
                            </div>

                            <div class="form-block form-submit">
                                <input class="orange_button form-continue" type="submit" value="Continue" />
                            </div>
                        </div>
                        <div id="manage_reservation_content" class="content-form hidden">
                            <div class="location-block">
                                <div class="form-block location">Location</div>
                                <div class="form-block airport_codes"><a href="#" title="">Airport codes</a></div>
                                <input class="location" type="text" value="" placeholder="Enter airport, city or zip code" name="location_1" />
                                <input id="location-checkbox-1" type="checkbox" class="styled" name="checkbox_location_1" value="1" />
                                <label for="location-checkbox-1"> Return at different location</label>
                                <div class="location-block return_location">
                                    <div class="form-block location">Return location</div>
                                    <input class="location" type="text" value="" placeholder="Enter airport, city or zip code" name="return_location_1" />
                                </div>
                            </div>
                            <div class="form-block pick-up">
                                <h4>Pick-up date</h4>
                                <input class="datepicker" type="text" value="" name="data_from_1" />
                                <input class="time-select" type="text" size="5" value="" name="time_from_1" />
                            </div>
                            <div class="form-block drop-off">
                                <h4>Drop-off date</h4>
                                <input class="datepicker" type="text" name="data_to_1" />
                                <input class="time-select" type="text" size="5" value="" name="time_to_1" />
                            </div>
                            <div class="form-block car-type">
                                <h4>Car type</h4>
                                <div class="car-type-select">
                                    <select class="select" name="select_cartype_1">
                                        <option selected="selected" />Standard
                                        <option />Mini
                                    </select>
                                </div>
                            </div>
                            <div class="form-block form-submit">
                                <input class="orange_button form-continue" type="submit" value="Continue" />
                            </div>
                        </div>
                        <div class="clear"></div>
        <?php echo html::formClose(); ?>

            <div id="slider-front-img">
                <img style="width: 250px;position: absolute;top: 90px;right: -250px;" src="images/xslider_front_img.png.pagespeed.ic.SXjiVO6hdp.png" alt="" />
            </div>


                </div>
            </div><!-- #slider -->


            <?php
                $sliderBottom = settings::get()->sliderBottom;
            if(!helper::isEmpty($sliderBottom))
            {
                echo $sliderBottom;
            }

            ?>

            <div class="clear"></div>
