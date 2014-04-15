<div class="clear"></div>
 <footer id="footer">
                <div id="footer-menu" class="footer-content">
                    <div class="widget-area">
                        <div class="clear"></div>

                        <div class="footer-widget-single" style="width: 250px; margin-right: 60px !important">
                            <h2 style="font-size: 16px; margin-top: 3px; color: #444c57; letter-spacing:-1.2px; margin-bottom: 10px"><?php echo settings::get()->defaultTitle?></h2>
                            <p>Oscar rentacar was established in 1958 and is the biggest and best and most reputable car hire company on the island, and is well known for very competetive ...<a href="<?php echo BASEPATH?>page/read/about-us"> read more</a> </p>
                        </div>
                        <style>
                        .recent_tweets h3:before{
                            content: '';
                        }
                        </style>
                        <div class="recent_tweets footer-widget-single" style="margin-right: 50px !important">
                            <h3>Recent &nbsp; News</h3>

                            <?php

                            $allNews = settings::allNews(3);
                            if(!helper::isEmpty($allNews)):

                                foreach($allNews as $news): ?>
                                    <div class="recent_tweets_content"><a href="<?php echo BASEPATH?>News/Read/<?php echo $news->newsLink?>" title="<?php echo $news->newsTitle?>"><?php echo $news->newsTitle?></a> - <span><?php echo $news->categoryName?></span> </div>
                                <?php endforeach;?>
                                <a href="<?php echo BASEPATH?>News/All" class="all-news">All News</a>

                            <?php else: ?>
                            <p>Noting found...</p>
                            <?php endif; ?>
                        </div>


                        <div class="support footer-widget-single">

                            <?php echo html::img(array('src'=>'images/xsupport-icon.png.pagespeed.ic.LBTLiJj6aG.png')); ?>

                            <div class="title">Online support</div>
                            <div class="phone"><?php echo settings::get()->defaultPhone; ?></div>
                            <div class="email"><a href="mailto:<?php echo settings::get()->siteEmail?>" title=""><?php echo settings::get()->siteEmail?></a></div>
                        </div>

                        <div class="clear"></div>
                    </div><!-- #footer-content -->
                </div>

            </footer><!--end:footer-->

        </div><!--end:conteiner-->
               <div >
                    <div id="main">
                        <p class="company-name">All rights reserved, &copy; Copyright <?php echo date('Y'); ?> - <?php echo settings::get()->defaultTitle;?></p>
                        <p class="site-title">Powered By <a href="http://navion.com.tr">Navion Consulting</a></p>
                        <div class="clear"></div>
                    </div>
                </div><!-- #footer-content -->
        <div id="overlay_block"></div>


        <?php echo Html::script(array('src'=>Config::get('DEFAULT_CURRENT_THEME').'js/jquery-1.10.1.min.js.pagespeed.jm.hJPIhFzu5k.js')); ?>
        <?php echo Html::script(array('src'=>Config::get('DEFAULT_CURRENT_THEME').'js/jquery-migrate-1.2.1.min.js.pagespeed.jm.mhpNjdU8Wl.js')); ?>
        <?php echo Html::script(array('src'=>Config::get('DEFAULT_CURRENT_THEME').'js/jquery-ui.js.pagespeed.jm.7bkf_uwmVN.js')); ?>


        <!--[if IE]>
        <?php echo Html::script(array('src'=>Config::get('DEFAULT_CURRENT_THEME').'js/placeholder_ie.js')); ?>
        <![endif]-->

        <?php echo Html::script(array('src'=>Config::get('DEFAULT_CURRENT_THEME').'js/jquery.slider.min.js.pagespeed.ce.qegPSaENzl.js')); ?>
        <?php echo Html::script(array('src'=>Config::get('DEFAULT_CURRENT_THEME').'js/jquery.meio.mask.js.pagespeed.jm.Ttl2wyMXUr.js')); ?>
        <?php echo Html::script(array('src'=>Config::get('DEFAULT_CURRENT_THEME').'js/custom-form-elements.js.pagespeed.jm.NHNBHjVvWo.js')); ?>
        <?php echo Html::script(array('src'=>Config::get('DEFAULT_CURRENT_THEME').'js/jquery.selectbox-0.2.min.js.pagespeed.jm.W5xucmszdS.js')); ?>
        <?php echo Html::script(array('src'=>Config::get('DEFAULT_CURRENT_THEME').'js/toastmessage/javascript/jquery.toastmessage.js')); ?>
       <!-- <?php echo Html::script(array('src'=>Config::get('DEFAULT_CURRENT_THEME').'js/default.js')); ?> -->

        <script type="text/javascript">
            //<![CDATA[
                (function($){$.fn.extend({blueberry:function(options){var defaults={interval:5000,duration:500,lineheight:1,height:'auto',hoverpause:false,pager:true,nav:true,keynav:true}
                var options=$.extend(defaults,options);return this.each(function(){var o=options;var obj=$(this);var slides=$('.slides li',obj);var pager=$('.pager li',obj);var current=0;var next=current+1;var imgHeight=slides.eq(current).find('img').height();var imgWidth=slides.eq(current).find('img').width();var imgRatio=imgWidth/imgHeight;var sliderWidth=0;var cropHeight=0;slides.hide().eq(current).fadeIn(o.duration).addClass('active');if(pager.length){pager.eq(current).addClass('active');}else if(o.pager){obj.append('<ul class="pager"></ul>');slides.each(function(index){$('.pager',obj).append('<li><a href="#"><span>'+index+'</span></a></li>')});pager=$('.pager li',obj);pager.eq(current).addClass('active');}
                if(pager){$('a',pager).click(function(){clearTimeout(obj.play);next=$(this).parent().index();rotate();return false;});}
                var rotate=function(){slides.eq(current).fadeOut(o.duration).removeClass('active').end().eq(next).fadeIn(o.duration).addClass('active').queue(function(){clearTimeout(obj.play);rotateTimer();$(this).dequeue()});if(pager){pager.eq(current).removeClass('active').end().eq(next).addClass('active');}
                current=next;next=current>=slides.length-1?0:current+1;};var rotateTimer=function(){obj.play=setTimeout(function(){rotate();},o.interval);};rotateTimer();if(o.hoverpause){slides.hover(function(){clearTimeout(obj.play);},function(){rotateTimer();});}
                var setsize=function(){sliderWidth=$('.slides',obj).width();cropHeight=Math.floor(((sliderWidth/imgRatio)/o.lineheight))*o.lineheight;$('.slides',obj).css({height:cropHeight});};setsize();$(window).resize(function(){setsize();});if(o.keynav){$(document).keyup(function(e){switch(e.which){case 39:case 32:clearTimeout(obj.play);rotate();break;case 37:clearTimeout(obj.play);next=current-1;rotate();break;}});}});}});})(jQuery);
            //]]>
        </script>

        <?php error::displayNotice(); ?>

       <?php echo Html::script(array('src'=>Config::get('DEFAULT_CURRENT_THEME').'js/script.js.pagespeed.jm.ayF2h7n7ni.js')); ?>

       <?php echo html::displayCustomJsFile(); ?>
    <script>
        $(function(){
              $('.btn-delete').click(function() {
                return window.confirm("Are you sure?");
            });
          }())
    </script>
    </body>
</html>