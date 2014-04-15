            <div id="main" style="margin-top: 20px">
                <div id="primary">
                    <div class="clear"></div>
                    <?php if($this->pageDetail->sideBar == 1): ?>
                        <?php $this->sideBar(); ?>
                        <div id="content" class="sidebar-middle">

                    <?php else:?>
                    <div id="content">
                    <?php endif;?>

                        <div class="widget main-widget faq-widget">
                            <div class="widget-title">
                                <div style="width: 100%">

                                <?php if(auth::isLoggedIn()): ?>
                                    <span style="float: right; font-size: 12px">
                                        <a href="<?php echo BASEPATH?>Page/edit/<?php echo $this->pageDetail->pageId?>">[Düzenle]</a> |
                                        <a class="btn-delete" href="<?php echo BASEPATH?>Page/delete/<?php echo $this->pageDetail->pageId?>">[Sil]</a>
                                    </span>
                                <?php endif;?>

                                    <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQBAMAAADt3eJSAAAAJFBMVEVDS1ZDS1ZDS1ZDS1ZDS1ZDS1ZDS1ZDS1ZDS1ZDS1ZDS1ZDS1bwY3eUAAAAC3RSTlMABkJIhIeKjeTn6vKYHgQAAAA8SURBVAjXYxDp3g0EOxwZoneDwVaG1QoMQMC0i2E3AxjsBkHu3btRGRRJrTYA0cy7YJZuYxCfDaJ3FgIAVMUzVcZqeM4AAAAASUVORK5CYII=" alt="" />
                                <?php echo $this->pageDetail->pageTitle; ?>

                                </div>
                                <div class="clear"></div>
                            </div>

                            <div class="widget-content widget-note page_body">
                                <?php echo helper::shortCode( helper::tagReplace( $this->pageDetail->pageBody ) ); ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>