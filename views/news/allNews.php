<div id="main" style="margin-top: 20px">
                <div id="primary">
                    <div class="clear"></div>
                                        <div id="content">

                        <div class="widget main-widget faq-widget">
                            <div class="widget-title">
                                <div style="width: 100%">

                                                                    <span style="float: right; font-size: 12px">
                                        <a href="http://localhost:8888/rentoscar/Page/edit/29">[Düzenle]</a> |
                                        <a class="btn-delete" href="http://localhost:8888/rentoscar/Page/delete/29">[Sil]</a>
                                    </span>

                                    <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQBAMAAADt3eJSAAAAJFBMVEVDS1ZDS1ZDS1ZDS1ZDS1ZDS1ZDS1ZDS1ZDS1ZDS1ZDS1ZDS1bwY3eUAAAAC3RSTlMABkJIhIeKjeTn6vKYHgQAAAA8SURBVAjXYxDp3g0EOxwZoneDwVaG1QoMQMC0i2E3AxjsBkHu3btRGRRJrTYA0cy7YJZuYxCfDaJ3FgIAVMUzVcZqeM4AAAAASUVORK5CYII=" alt="">
                                <?php echo html::$title; ?>
                                </div>
                                <div class="clear"></div>
                            </div>

                            <div class="widget-content widget-note page_body">
      <div id="child_pages">

            <ul>
                <?php foreach($this->allNews as $news): ?>

                    <li class="colm" >

                        <?php $newsImage = helper::isEmpty($news->newsImage) ? 'no_img.jpg' : $news->newsImage;  ?>
                            <div class="page_img"><img src="<?php echo BASEPATH.'images/'.$newsImage; ?>" alt=""></div>


                        <h2 style="margin-bottom: 0"><?php echo $news->newsTitle?></h2>
                        <small style="margin-bottom: 10px; display: inline-block; background: #999; color: white; height: 17px; line-height: 17px; padding: 0 2px; border-radius: 2px"><?php echo $news->categoryName?></small>
                            <p>

                                <?php

                                        $pos = strpos($news->newsBody, ' ', 200);
                                        echo strip_tags(substr( $news->newsBody,0,$pos )).'...';


                                ?>

                            </p>
                           <a href="<?php echo BASEPATH?>News/Read/<?php echo $news->newsLink?>">Read More</a>
                           <div class="clear"></div>
                    </li>
                <?php endforeach; ?>



            </ul>

            <div class="clear"></div>
        </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>