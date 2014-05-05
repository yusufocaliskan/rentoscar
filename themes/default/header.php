<!DOCTYPE html>
<html lang="en">
    <head>
        <title><?php echo Html::title(); ?></title>

        <?php echo Html::style(array('rel'=>'shortcut icon', 'type'=>'image/x-icon','href'=>'images/favicon.ico')); ?>
        <?php echo Html::meta(array('name'=>'view','content'=>'width=device-width, initial-scale=1')); ?>
        <meta http-equiv="content-type" content="text/html;charset=utf-8" />
        <?php echo Html::style(array('href'=>Config::get('DEFAULT_CURRENT_THEME') .'js/js-ui/css/blitzer/jquery-ui-1.10.4.custom.min.css','media'=>'all','type'=>'text/css', 'rel'=>'stylesheet')); ?>
        <?php echo Html::style(array('href'=>Config::get('DEFAULT_CURRENT_THEME') .'js/jquery-timepicker/jquery.timepicker.css','media'=>'all','type'=>'text/css', 'rel'=>'stylesheet')); ?>
        <?php echo Html::style(array('href'=>Config::get('DEFAULT_CURRENT_THEME') .'css/A.style.css.pagespeed.cf.yVD6J361ZW.css','media'=>'all','type'=>'text/css', 'rel'=>'stylesheet')); ?>
        <?php echo Html::style(array('href'=>Config::get('DEFAULT_CURRENT_THEME') .'css/A.jquery.slider.min.css.pagespeed.cf.mLNjgcgeJ6.css','media'=>'all','type'=>'text/css', 'rel'=>'stylesheet')); ?>
        <?php echo Html::style(array('href'=>Config::get('DEFAULT_CURRENT_THEME') .'css/custom.css','media'=>'all','type'=>'text/css', 'rel'=>'stylesheet')); ?>
        <?php echo Html::style(array('href'=>Config::get('DEFAULT_CURRENT_THEME') .'js/toastmessage/resources/css/jquery.toastmessage.css','media'=>'all','type'=>'text/css', 'rel'=>'stylesheet')); ?>

        <!--[if IE]>
        <script type="text/javascript" src="js/html5.js"></script>
        <?php echo Html::style(array('href'=>Config::get('DEFAULT_CURRENT_THEME') .'css/css_ie.css','media'=>'all','type'=>'text/css', 'rel'=>'stylesheet')); ?>
        <![endif]-->

        <?php echo html::displayCustomCssFile(); ?>
        <?php echo Html::meta(array('http-equiv'=>'Content-Type','content'=>'text/html; charset=utf-8')); ?>

</head>
    <body class=" <?php if(router::getController() == 'index' OR router::getController() == '') echo 'center-slider one-column middle-sidebar'; else echo 'page page-two-column'; ?>">
        <div id="conteiner">

            <div id="header_top">
                <div id="main">
                    <ul class="fl">
                        <li><a href="<?php echo BASEPATH?>">Home</a></li>
                        <li class="sp">  </li>
                        <li><a href="http://test.navion.com.tr/rentoscar/page/read/term-conditions">Term & Conditions</a></li>
                        <li class="sp">  </li>
                        <li><a href="http://test.navion.com.tr/rentoscar/page/read/frequently-asked-questions">FAQ</a></li>
                    </ul>
                <?php
                    $mail = settings::get()->siteEmail;
                ?>
                    <ul class="fr">
                        <li><span><?php echo settings::get()->defaultPhone?></span></li>
                        <li class="sp">  </li>
                        <li><a href="mailto:<?php echo $mail?>"><?php echo $mail?></a></li>
                        <li class="sp">  </li>
                        <li><a href="<?php echo settings::get()->facebook?>" class="facebook"></a></li>
                        <li><a href="<?php echo settings::get()->twitter?>" class="twitter"></a></li>
                    </ul>
                <div class="clear"></div>
                </div>
            </div>
            <div class="clear"></div>
            <div id="branding">
                <div id="branding-content">
                    <div class="title-content">


                        <a href="<?php echo BASEPATH; ?>" title="<?php echo settings::get()->defaultTitle?>">
                            <?php echo html::img( array('class'=>'site-logo', 'alt'=>settings::get()->defaultTitle, 'src'=>'images/logo_white.png') ); ?>
                        </a>

                    </div>

                    <div class="access-content">

                        <?php echo settings::getMenu(); ?>
                    </div><!-- .access -->

                    <?php
                        #TODO : auth LoggedIn ile kontrolü yap! Hata veriyor du.
                        if(auth::isLoggedIn()): ?>
                            <?php echo html::link('Admin Paneli',array('href'=>'Dashboard','class'=>'admin_panel'));?>
                        <?php endif;?>
                </div><!-- #branding-content -->
                <div class="clear"></div>


            </div><!-- #branding -->


        <?php if(isset($this->showStep) AND $this->showStep == true): ?>
            <?php echo html::getShopingStepsHtml($this->activeStep, $this->doneStep); ?>
        <?php endif;?>









