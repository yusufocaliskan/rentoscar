<?php
if(!defined('OSCAR_RENT_A_CAR')) exit('<pre>Permission error! Please Go away :) </pre>');


//Cyprus
$getChildPage   = settings::getChildPage(29);
?>
<div id="child_pages">

    <ul>
        <?php foreach($getChildPage as $page): ?>
            <li class="colm">
                <?php
                    preg_match_all('/<img src="(.*?)">/',$page->pageBody,$pageImage);

                    if(count($pageImage[1][0]) > 0)
                    {
                        echo '<div class="page_img"><img src="'.BASEPATH.$pageImage[1][0].'" alt=""></div>';
                    }

                ?>

                <h2><?php echo $page->pageTitle?></h2>
                <p>

                    <?php
                        $output = preg_replace('/<img src="(.*?)">/','',$page->pageBody);
                        $pos = strpos($output, ' ', 200);
                        echo strip_tags(substr( $output,0,$pos )).'...';

                    ?>

                </p>
                   <a href="<?php echo BASEPATH?>Page/Read/<?php echo $page->pageLink?>">Learn More</a>
                   <div class="clear"></div>
            </li>
        <?php  endforeach; ?>



    </ul>

    <div class="clear"></div>
</div>