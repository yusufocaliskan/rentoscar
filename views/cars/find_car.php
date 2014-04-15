<style>
    .post:last-child{
        background: none !important;
    }
</style>

<div id="main">
    <?php echo html::formOpen('cars/firstStepChooseACar', array('class'=>'main-form','id'=>'slider-form','method'=>'GET'));?>
        <div id="book_car" class="title-form current">
            <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABQAAAAUCAMAAAC6V+0/AAAABGdBTUEAALGPC/xhBQAAAF1QTFRFAAAAQ0tWQ0tWQ0tWQ0tWQ0tWQ0tWQ0tWQ0tWQ0tWQ0tWQ0tWQ0tWQ0tWQ0tWQ0tWQ0tWQ0tWQ0tWQ0tWQ0tWQ0tWQ0tWQ0tWQ0tWQ0tWQ0tWQ0tWQ0tWQ0tWQ0tWuhpF3AAAAB50Uk5TAAADBiEtMDM2OTw/eHuEio2Qk5mfpavY5Oft9vn83J3WTAAAAJhJREFUGNOV0OsOgyAMBWAq3h3epgwHPe//mJsXwG3+2UlImi+kaSvEf6E9F/TJRJk2MDo7IUnlsMapJCiN4L5Iip4xBqzBzVY0jNrjjPaoWsweDdKjSmE8OsijkuDTz70/pVhiT7WO/X4q9qxhq22d0qIKM93BXU55x8AUlpItwyeqyPWCx1xOm36fcNVBXOjz99yDvQnxAv2dCmXkq0q6AAAAAElFTkSuQmCC" alt="" />
            Search for a car:
        </div>

        <div id="book_car_content" class="content-form ">
            <div class="location-block">
                <div class="form-block location">Location</div>
                <!--<div class="form-block airport_codes"><a href="#" title="">Airport codes</a></div>-->

                <select class="select shortcode-select"  name="location">
                    <option value="0">Select a location</option>
                        <?php foreach($this->getLocations as $location): ?>
                            <option <?php echo html::selected('location',$location->pkey); ?> value="<?php echo $location->pkey; ?>"><?php echo $location->lokasyonad; ?></option>
                        <?php endforeach; ?>
                </select>
                <input <?php echo html::checked($_REQUEST['checkbox_location'], 1); ?> id="location-checkbox" type="checkbox" class="styled" name="checkbox_location" value="1" />
                <label for="location-checkbox"> Return at different location</label>
                <div class="location-block return_location"  <?php echo input::get('checkbox_location') ? 'style="display: block !important"' : null ; ?> >
                    <div class="form-block location">Return location</div>
                    <!-- <input class="location" type="text" value="" placeholder="Enter airport, city or zip code" name="return_location" />-->
                    <select class="select shortcode-select"  name="return_location">
                        <option value="0">Select a location</option>
                            <?php foreach($this->getLocations as $location): ?>
                                <option <?php echo html::selected('return_location',$location->pkey); ?> value="<?php echo $location->pkey; ?>"><?php echo $location->lokasyonad; ?></option>
                            <?php endforeach; ?>
                        </select>
                </div>
            </div>
            <div class="form-block pick-up">
                <h4>Pick-up date </h4>
                <input value="<?php echo html::returnElementVal('data_from','Date'); ?>" class="datepicker" type="text" name="data_from" />
                <input value="<?php echo html::returnElementVal('time_from','00:00'); ?>" class="time-select" type="text" size="5" name="time_from" />
            </div>

            <div class="form-block drop-off">
                <h4>Drop-off date</h4>
                <input class="datepicker" type="text" name="data_to"  value="<?php echo html::returnElementVal('data_to','Date'); ?>" />
                <input class="time-select" type="text" size="5" name="time_to" value="<?php echo html::returnElementVal('time_to','00:00'); ?>"  />
            </div>

            <div class="form-block form-submit">
                <input class="orange_button form-update" type="submit" value="Update" />
            </div>

        </div>
        <div class="clear"></div>
    <?php echo html::formClose(); ?>

    <style>

      .location-block .sbHolder{
            margin-top: 24px !important;
            margin-bottom: 20px;
            width: 202px;
        }

        .sbOptions{
            overflow: auto;
        }


    </style>
    <?php if($_GET['location']):  ?>
  <div id="primary">
    <div class="clear"></div>

    <aside id="secondary" class="sidebar-left">

        <div class="widget filter_widget">
            <h3 class="widget-title">
                <?php if(isset($_SESSION['SORT'])): ?>
                    <a href="<?php echo BASEPATH?>Cars/restSort" style="float: right; font-size: 11px">RESET</a>
                <?php endif;?>
                <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABIAAAASCAMAAABhEH5lAAAANlBMVEVDS1ZDS1ZDS1ZDS1ZDS1ZDS1ZDS1ZDS1ZDS1ZDS1ZDS1ZDS1ZDS1ZDS1ZDS1ZDS1ZDS1ZDS1bRy2tyAAAAEXRSTlMABhhCSISHio29xszP2OTn6vSiw04AAABhSURBVBjTfY9RDoAwCEPLdOqc0737X9YPYyZxWRMCLdCA1IHFU4InzmiSlpc+sUiqTG1lomqElFoNv9SR/PDHCSC59g5wOK9QoAS/H3IOoxsrcyMz9f/2Ksm2q0nXZj2nG2D2BS45p96kAAAAAElFTkSuQmCC" alt="" />
                Filter results
            </h3>
            <h4>Sort By Group</h4>
            <div class="widget-content widget-filter" style="padding-bottom: 35px">
            <form method="POST" action="<?php echo BASEPATH.'cars/firstStepChooseACar?location='.input::get('location').'&checkbox_location='.input::get('checkbox_location').'&return_location='.input::get('return_location').'&data_from='.input::get('data_from').'&time_from='.input::get('time_from').'&data_to='.input::get('data_to').'&time_to='.input::get('time_to').'&sPrice='.request::get('sPrice')?>">
                <?php for($i = 0; $i <= count($this->groups); $i++): ?>

                    <?php if($this->groups[$i]->groupName): ?>

                        <div class="filter">
                            <input <?php if($_SESSION['SORT']['byGroups']) { echo in_array($this->groups[$i]->groupName,  $_SESSION['SORT']['byGroups'] ) ? 'checked="checked"' : null;  } ?> id="manufacturers<?php echo ucwords(helper::toLower($this->groups[$i]->groupName)); ?>" type="checkbox" class="styled" name="byGroups[]" value="<?php echo $this->groups[$i]->groupName; ?>" />
                            <label for="manufacturers<?php echo ucwords(helper::toLower($this->groups[$i]->groupName)); ?>"><?php echo ucwords(helper::toLower($this->groups[$i]->groupName)); ?></label>
                        </div>

                    <?php endif;?>
                <?php endfor;?>

                <button style="margin-top: 5px; float: left; margin-left: 0" class="range_btn">Refresh</button>
            </form>

            </div>

            <h4>Price range </h4>
            <div class="widget-content-range">
                <form method="POST" action="<?php echo BASEPATH.'cars/firstStepChooseACar?location='.input::get('location').'&checkbox_location='.input::get('checkbox_location').'&return_location='.input::get('return_location').'&data_from='.input::get('data_from').'&time_from='.input::get('time_from').'&data_to='.input::get('data_to').'&time_to='.input::get('time_to').'&sPrice='.request::get('sPrice')?>">
                    <input class="price_range" value="<?php echo !helper::isEmpty(session::get('SORT','rangeSort')) ? session::get('SORT','rangeSort') : '0;800' ?>" name="price_range" />
                    <button class="range_btn">Refresh</button>
                </form>
            </div>
            <h4>Manufacturers</h4>
            <div class="widget-content widget-filter" style="padding-bottom: 35px">
            <form method="POST" action="<?php echo BASEPATH.'cars/firstStepChooseACar?location='.input::get('location').'&checkbox_location='.input::get('checkbox_location').'&return_location='.input::get('return_location').'&data_from='.input::get('data_from').'&time_from='.input::get('time_from').'&data_to='.input::get('data_to').'&time_to='.input::get('time_to').'&sPrice='.request::get('sPrice')?>">
                <?php for($i = 0; $i <= count($this->carMarks); $i++): ?>

                    <?php if($this->carMarks[$i]->markaad): ?>

                        <div class="filter">
                            <input <?php if($_SESSION['SORT']['manufacturers']) { echo in_array($this->carMarks[$i]->markaad,  $_SESSION['SORT']['manufacturers'] ) ? 'checked="checked"' : null;  } ?> id="manufacturers<?php echo ucwords(helper::toLower($this->carMarks[$i]->markaad)); ?>" type="checkbox" class="styled" name="manufacturers[]" value="<?php echo $this->carMarks[$i]->markaad; ?>" />
                            <label for="manufacturers<?php echo ucwords(helper::toLower($this->carMarks[$i]->markaad)); ?>"><?php echo ucwords(helper::toLower($this->carMarks[$i]->markaad)); ?></label>
                        </div>

                    <?php endif;?>
                <?php endfor;?>

                <button style="margin-top: 5px; float: left; margin-left: 0" class="range_btn">Refresh</button>
            </form>

            </div>

        </div>
    </aside>

    <div id="content" class="sidebar-middle">
    <?php if(!empty($this->getAllCar)): ?>
        <div class="widget main-widget product-widget">
            <div class="content-overlay">
                <img class="ajax-loader" src="<?php echo BASEPATH?>images/ajax-loader.gif" alt="" />
            </div>

                <div class="widget-title">
                    <div>
                        <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQBAMAAADt3eJSAAAAJFBMVEVDS1ZDS1ZDS1ZDS1ZDS1ZDS1ZDS1ZDS1ZDS1ZDS1ZDS1ZDS1bwY3eUAAAAC3RSTlMABkJIhIeKjeTn6vKYHgQAAAA8SURBVAjXYxDp3g0EOxwZoneDwVaG1QoMQMC0i2E3AxjsBkHu3btRGRRJrTYA0cy7YJZuYxCfDaJ3FgIAVMUzVcZqeM4AAAAASUVORK5CYII=" alt="" />
                        Results <span>( <?php echo $this->page*count($this->getAllCar); ?> from  <?php echo $this->model->getAllCar('','',true); ?>)</span>
                    </div>
                    <div class="widget-title-sort"><span class="viev-all">Sort by: </span>
                        <?php echo '<a '.html::setCurrentClass(request::get('sPrice'),'up').'href="'.BASEPATH.'cars/firstStepChooseACar?location='.input::get('location').'&checkbox_location='.input::get('checkbox_location').'&return_location='.input::get('return_location').'&data_from='.input::get('data_from').'&time_from='.input::get('time_from').'&data_to='.input::get('data_to').'&time_to='.input::get('time_to').'&sPrice=up&p='.$this->page.'">Price Up</a>'; ?> |
                        <?php echo '<a '.html::setCurrentClass(request::get('sPrice'),'down').' href="'.BASEPATH.'cars/firstStepChooseACar?location='.input::get('location').'&checkbox_location='.input::get('checkbox_location').'&return_location='.input::get('return_location').'&data_from='.input::get('data_from').'&time_from='.input::get('time_from').'&data_to='.input::get('data_to').'&time_to='.input::get('time_to').'&sPrice=down&p='.$this->page.'" >Price Down</a>'; ?>
                    </div>
                    <div class="clear"></div>
                </div>
                <?php // debug::pre($this->getAllCar);?>

            <?php
            $count  = count($this->getAllCar);
            $i      = 0;
            foreach( $this->getAllCar as $car):
                $i++;
                $lastChild = $i == $count ? 'last_child' : null;
            ?>
                <?php echo html::formOpen('Cars/secondStepChooseExtras/'.$car->carPkey); ?>
                <div class="post">
                    <div class="main-block_container">
                        <div class="additional-block_container">
                            <div class="main-block">
                                <div class="product-img">

                                    <?php
                                        $markImage = helper::isEmpty($car->markaResim)
                                        ? 'default_car.jpg'
                                        : $car->markaResim;

                                     echo html::img(array('src'=>config::get('DEFAULT_IMAGE_FOLDER').$markImage)); ?>
                                </div>
                                <div class="product-info">
                                    <h3 class="entry-format"><?php echo ucwords(helper::toLower($car->markaad)); ?> <span> | &nbsp; <?php echo ucwords(helper::toLower($car->model)); ?></span> <span class="top-seller"><?php echo $car->groupName?></span></h3>
                                    <div class="features">
                                       <!--  <p><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAAABHNCSVQICAgIfAhkiAAAAUtJREFUOI2d0j9IVXEUwPGPr8cDwRAE48oFB5empkCXhJaa3ANBCBpEF0HBSQjBtcG9wCVBWosXTQmhGDgJLm2i+KZQaI0a3rly3g9dPHA4v+/5d8/vd8/Q4dGxJDXe4VnwD6zhNZYSXzQF7VT8GAcYS75XeIFZTBd8Cq2UvBXF+5gJ3Q/fFhYLBkPpClcYxQR64atwiT94GFc8TzwwwWjYXvI155GwFwUPNLiX5AbXYevkq4tYVfBAg69h30diFecmVuFjkTvwiJP4hU4x5V9M6e/CZuKzPEGNT7cUw4OI7WAvcd006KCrvygnmMOj0LnwTeMzlhN30WljFU/wEy/zA+GL/vp+i6I3eB78FCst/R0X3XNxI9cRgwX8xnrDLQwHjN9SrIg1v7F5q6qFDwFd/LtDu5GzE1PccBtvo+N8+kIpPexiG98Tb/wHpNJRBu5mDi8AAAAASUVORK5CYII=" alt="" /> 5 passengers</p> -->
                                        <p><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAAABHNCSVQICAgIfAhkiAAAAKpJREFUOI3t0yEKAkEUxvHfLuIBTCbrwlarR/AEgsmkV/ACnkBBtHoAz2ASw6YFk2AyWa2GHYswKq7RPwzD+5jv4/F4k+wPhTo0InoTU7RDfcEMt+eHaSSgixzLcPKgRTvIwn1FJxieyUIHZ7SCdkz2h2KFEXbYYB7p6sEEA/SwTjF8Y3jFMFUN7FuasSF+zD/gRwGnGv5TA32MVStaqnb/FSW2KLBI6n7nO8vQHaJiqzNrAAAAAElFTkSuQmCC" alt="" /> <?php echo helper::toLower($car->kasaingad); ?></p>
                                        <p><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAMAAAAoLQ9TAAAAaVBMVEXKzNDKzNDKzNDKzNDKzNDKzNDKzNDKzNDKzNDKzNDKzNDKzNDKzNDKzNDKzNDKzNDKzNDKzNDKzNDKzNDKzNDOz9PR09bV1tnY2t3c3eDj5Obm5+nq6+zt7u/x8fL09fb4+Pn7/Pz///+OpB/0AAAAFHRSTlMABicqLXKNkJO3zM/V2Nvw8/b5/DbgOXEAAACGSURBVBjTbY/ZFoMgDESjVXDppom1am2B///IMlF8ae8DM+RMCCGK5KZhbkxOO2UnSlfqNavloM5iwap1YYQYooJhZu8WKJ9SYF38sEUukClMY5jhztRDVifycXA3LQw+gGe0d7riSYx4hJe2VJLSbx8Pu49NcEEaObD/vv6znK7firTb+l/ISBBvthVvpwAAAABJRU5ErkJggg==" alt="" /> <?php echo helper::toLower( $car->vitesingad); ?> transmission</p>
                                        <p><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAAABHNCSVQICAgIfAhkiAAAAWtJREFUOI1900GEVXEUBvDfvJcY3ihDxBCTySQaZYhWZVat36ZFahMtMhGJVrWPGaJtxGjRplWLNi0ytEijYTalFDGKeMQlhsss/t/17uS9dzjuuef+z3e+/znfnfrwcdsEe4wu7o07cGhCcRdnWnE96lBnTPEqvmMx/hkPJgFcxGHcxAs8xwbm4i/xFK9xC9O41Fyhh038wLe8Vyk4lwbPkjuCq3iI4zjayYelAFzBfAq/YhkX8D65eaxgB6dRNUOcxln8DOCn5Ht51snt4G9AZ9szGOBJUO8GpMZ5nEpc4XbYPsKfNkAVkDpsmq41/mEvuWOt8xVMRUjLeBvUQSiOsq00mMNlbDcMdvEGC/F+wNrexwlFXO/wu2HQw6/Q3QrNJUVAa2lwR9nSpqFCu5jp5I43cFLZ90CZ/nVlZSuKwHrKBjYy7GvtGfxvq7hvqP8u1pVNHbBxABRpv0rcN9zEAZv0N+7hSyseafsMGl3vr6omhAAAAABJRU5ErkJggg==" alt="" /> <?php echo helper::toLower($car->renkingad); ?> </p>
                                        <p><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAAABHNCSVQICAgIfAhkiAAAAQdJREFUOI2d079HRWEYwPFPOSLuFFEul8udSkQcIhpaIlqjqbvUEm2NDS0NaUtrFKk/ICKiNQ2XO10i7hQRV01NDec9XDnndE7P9D6/vu/z431Hnp4759iSL8fYz3NGaOEU3Qx/jJmc3HVMRUG5w21G0Bc2M+xLuMbKaF5pf8gRPtD8D6CGRUnbcdrCKuoZwTEa2MY9XjGJNwzQSAG7BTf2sYw9zIYK6jjDTlSQmEoXbXwGfRAqmIayM2iFSoTkGiaqAGJ0wvkbD1irApgfAsANNqoA5n4BHrFQBZCuLpX3YCsN6KM5pNcDRJk1kvR8IHm+PZzgMgX0MF6Q/IIrySAvMCb5fIfwA46eLzPeM/T2AAAAAElFTkSuQmCC" alt="" /> <?php echo helper::toLower($car->yakitingad); ?> </p>
                                    </div>
                                </div>
                            </div>
                            <div class="additional-block">
                                 <?php echo money_format("%10.2n",$car->markagunfiyatsterlin); ?><span style="font-size: 12px; color: #888">/day</span>
                                <p class="span">Unlimited free miles included</p>
                                <input class="continue_button blue_button" type="submit" value="Select" />
                            </div>
                        </div>

                    </div>

                    <div class="clear"></div>
       <?php echo html::formClose(); ?>
                </div> <!-- POST -->

            <?php endforeach;?>



        </div>

    <?php if($this->totalPage > 1): ?>
        <div class="pagination">

            <?php if($this->page > 1): ?>
                <?php echo '<a class="left" href="'.BASEPATH.'cars/firstStepChooseACar?location='.input::get('location').'&checkbox_location='.input::get('checkbox_location').'&return_location='.input::get('return_location').'&data_from='.input::get('data_from').'&time_from='.input::get('time_from').'&data_to='.input::get('data_to').'&time_to='.input::get('time_to').'&p='.$this->prev.'"></a>'; ?>
            <?php endif;?>

        <?php

            for(
                $i = $this->page - $this->forLimit;
                $i < $this->page + $this->forLimit +1;
                $i++
            ):

                if($i > 0 && $i <= $this->totalPage):
                    if($i == $this->page):
                        echo '<a class="current" href="'.BASEPATH.'cars/firstStepChooseACar?location='.input::get('location').'&checkbox_location='.input::get('checkbox_location').'&return_location='.input::get('return_location').'&data_from='.input::get('data_from').'&time_from='.input::get('time_from').'&data_to='.input::get('data_to').'&time_to='.input::get('time_to').'&p='.$i.'">'.$i.'</a>';
                    else:
                        echo '<a href="'.BASEPATH.'cars/firstStepChooseACar?location='.input::get('location').'&checkbox_location='.input::get('checkbox_location').'&return_location='.input::get('return_location').'&data_from='.input::get('data_from').'&time_from='.input::get('time_from').'&data_to='.input::get('data_to').'&time_to='.input::get('time_to').'&p='.$i.'">'.$i.'</a>';
                    endif;
                endif;
            endfor;

        ?>

        <?php if($this->page != $this->totalPage): ?>
            <?php echo '<a class="right" href="'.BASEPATH.'cars/firstStepChooseACar?location='.input::get('location').'&checkbox_location='.input::get('checkbox_location').'&return_location='.input::get('return_location').'&data_from='.input::get('data_from').'&time_from='.input::get('time_from').'&data_to='.input::get('data_to').'&time_to='.input::get('time_to').'&p='.$this->next.'"></a>'; ?>
        <?php endif;?>

            <p class="clear" />
        </div> <!-- end: pagination -->

    <?php endif;?>


    </div>
<?php else:?>
    <div class="widget info_widget">
            <h3 class="widget-title" style="border-radius: 4px !important;">
                <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAMAAAAoLQ9TAAAAbFBMVEVDS1ZDS1ZDS1ZDS1ZDS1ZDS1ZDS1ZDS1ZDS1ZDS1ZDS1ZDS1ZDS1ZDS1ZDS1ZDS1ZDS1ZDS1ZDS1ZDS1ZDS1ZDS1ZDS1ZDS1ZDS1ZDS1ZDS1ZDS1ZDS1ZDS1ZDS1ZDS1ZDS1ZDS1ZDS1ZDS1Yn+HceAAAAI3RSTlMABgweJyotMDk8P2ByeI2Qk6Kut73JzM/V2Nvh5Ofw8/b5/AfSbsMAAACWSURBVBjTZY/LUsMwAMRkCG5jim1IX0BCa+v//5FDPVzY487srATAlM+9n/PEyOGuqvcDAGGx1RRCqs0lAMV1RzqdErvVDLG3CJtuEFt/oViBTb+BaubTGfjQd2D2SjMAb/oKBH9GEfUZePLGl3uAZQHYe6Va+EuxjFuORyC2HqG6xsckrpaBXhLMZaD/kwOmfNHLQ/8Xh8INwiRt17MAAAAASUVORK5CYII=" alt="">
                No car found!
            </h3>
    </div>
<?php endif;?>
    <div class="clear"></div>
</div>

<?php endif;?>