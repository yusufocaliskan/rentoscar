<style>
    .widget-content img{
        width: 100% !important;
        margin-bottom: 10px;
    }

    .news-title{
        padding: 10px 0 0px 0
    }

    .news-info{
        padding: 10px 0 20px 0;
        display: block;
        color: #999;
    }

    .list-all-news a{
        display: block;
        padding: 8px;
    }

</style>
            <div id="main" style="margin-top: 20px">
                <div id="primary">
                    <div class="clear"></div>

                       <aside id="secondary" class="sidebar-left">
                        <div class="widget faq_nav">
                            <h3 class="widget-title">
                                <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABEAAAARCAMAAAAMs7fIAAAAQlBMVEUAAAA4VFRMTEw/VVU6Tk48S1pGRlRDUFBBSFdBR1Q/TFI+SFg+TFY/SlU/SlVASlY/S1VASlVAS1Y/SlY/S1ZAS1Z5kdOqAAAAFXRSTlMACQoMDRESEyMnKDE10NTa3OLm7PDDjyevAAAAUklEQVQY07WQNxKAMBDERDAYnMP9/6tUxlfQom41o2bhgyPLSz6BFd+H6J4FgtWBDSBFmyIgAqMa68tM5N+q6qoKxFubK8KGa6Nqjh0wab6RDA9aFQtTX9V0wAAAAABJRU5ErkJggg==" alt="" />
                                All News
                            </h3>
                            <div class="list-all-news">
                                <?php foreach($this->allNews as $news): ?>
                                    <a href="<?php echo BASEPATH?>News/Read/<?php echo $news->newsLink?>"><?php echo $news->newsTitle?></a>
                                <?php endforeach;?>
                            </div>

                        </div>

                    </aside>



                        <div id="content" class="sidebar-middle">
                        <div class="widget main-widget faq-widget">


                            <div class="widget-content widget-note">

                                <h1 class="news-title"><?php echo $this->readNews->newsTitle; ?></h1>
                                <span class="news-info">
                                    Category &nbsp;
                                     <?php echo $this->readNews->categoryName?> &nbsp; &middot;&nbsp; &nbsp;
                                    Date &nbsp;
                                     <?php
                                        $date = explode(' ', $this->readNews->newsDate);
                                        echo $date[0];
                                     ?> &nbsp; &middot; &nbsp; View &nbsp;
                                     <?php echo $this->readNews->newsHit?>
                                </span>

                                    <?php if(!helper::isEmpty($this->readNews->newsImage)):?>
                                        <img src="<?php echo BASEPATH?>images/<?php echo $this->readNews->newsImage; ?>" alt="">
                                    <?php endif; ?>

                                <?php if(auth::isLoggedIn()): ?>
                                    <span style="font-size: 12px; margin-bottom: 10px; display: block">
                                        <a href="<?php echo BASEPATH?>News/Edit/<?php echo $this->readNews->newsId?>">[Düzenle]</a> |
                                        <a class="btn-delete" href="<?php echo BASEPATH?>News/Edit/<?php echo $this->readNews->newsId?>">[Sil]</a>
                                    </span>
                                <?php endif;?>


                                <?php echo $this->readNews->newsBody; ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>