
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

                <input id="location-checkbox" type="checkbox" class="styled" name="checkbox_location" value="1" />
                <label for="location-checkbox"> Return at different location</label>
                <div class="location-block return_location">
                    <div class="form-block location">Return location</div>
                    <!-- <input class="location" type="text" value="" placeholder="Enter airport, city or zip code" name="return_location" />-->
                    <select class="select shortcode-select"  name="return_location">
                        <option value="0">Select a location</option>
                            <?php foreach($this->getLocations as $location): ?>
                                <option <?php echo html::selected('location',$location->pkey); ?> value="<?php echo $location->pkey; ?>"><?php echo $location->lokasyonad; ?></option>
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
    <div class="wrapper" style="width: ">
    <div class="widget info_widget">
            <h3 class="widget-title" style="border-radius: 4px !important; border-radius: 4px !important; width: 800px; margin: 50px auto">
                <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAMAAAAoLQ9TAAAAbFBMVEVDS1ZDS1ZDS1ZDS1ZDS1ZDS1ZDS1ZDS1ZDS1ZDS1ZDS1ZDS1ZDS1ZDS1ZDS1ZDS1ZDS1ZDS1ZDS1ZDS1ZDS1ZDS1ZDS1ZDS1ZDS1ZDS1ZDS1ZDS1ZDS1ZDS1ZDS1ZDS1ZDS1ZDS1ZDS1ZDS1Yn+HceAAAAI3RSTlMABgweJyotMDk8P2ByeI2Qk6Kut73JzM/V2Nvh5Ofw8/b5/AfSbsMAAACWSURBVBjTZY/LUsMwAMRkCG5jim1IX0BCa+v//5FDPVzY487srATAlM+9n/PEyOGuqvcDAGGx1RRCqs0lAMV1RzqdErvVDLG3CJtuEFt/oViBTb+BaubTGfjQd2D2SjMAb/oKBH9GEfUZePLGl3uAZQHYe6Va+EuxjFuORyC2HqG6xsckrpaBXhLMZaD/kwOmfNHLQ/8Xh8INwiRt17MAAAAASUVORK5CYII=" alt="">
                Please create a request
            </h3>
    </div>
    </div>
</div>