
<!DOCTYPE html>
<html lang="en">
    <head>
        <title><?php echo Html::title(); ?></title>

        <?php echo Html::style(array('rel'=>'shortcut icon', 'type'=>'image/x-icon','href'=>'images/favicon.ico')); ?>
        <?php echo Html::meta(array('name'=>'view','content'=>'width=device-width, initial-scale=1')); ?>
        <meta http-equiv="content-type" content="text/html;charset=utf-8" />
        <?php echo Html::style(array('href'=>Config::get('DEFAULT_CURRENT_THEME') .'css/A.jquery-ui.css.pagespeed.cf.l5rE7WgkMu.css','media'=>'all','type'=>'text/css', 'rel'=>'stylesheet')); ?>
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
            <div id="branding">
                <div id="branding-content">
                    <div class="title-content">


                        <a href="<?php echo BASEPATH; ?>" title="<?php echo config::get('SITE_NAME');?>">
                            <?php echo html::img( array('class'=>'site-logo', 'src'=>'images/logoOscarRentACar.png') ); ?>
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









