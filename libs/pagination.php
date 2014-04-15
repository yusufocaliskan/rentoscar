<?php
if(!defined('OSCAR_RENT_A_CAR')) exit('<pre>Permission error! Please Go away :) </pre>');

class pagination
{

	  /**
     * pagination settings
     * @var mixed
     */
    public  $totalItem,
            $totalPage,
            $limit,
            $show,
            $page,
            $forLimit,
            $next,
            $prev;

    /**
     * Sayfalamayı başlatır
     *
     * @param integer $totalItem Toplam Row Sayısıs
     * @param object  $model 	 Verinin çekileceği model
     * @param string  $funcName  Veriyinin çekildiği fonksiyon adı
     */
	public function create($totalItem, $model, $funcName)
	{
		$page               = intval( request::get('p') );
        $this->page         = empty($page) ? 1 : $page;
        $this->totalItem    = $totalItem;
        $this->limit        = config::get('PER_PAGE');# TODO: Database'den çek.
        $this->totalPage    = ceil($this->totalItem/$this->limit);
        $this->page         = $page > $this->totalPage ? 1 : $page;
        $this->page         = $page < 1 ? 1 : $page;
        $this->show         = $this->page * $this->limit - $this->limit;
        $this->forLimit     = 2;
        $this->prev         = $this->page-1;
        $this->next         = $this->page+1;

        return $model->{$funcName}($this->show, $this->limit);
	}

	public function doHTML()
	{


	?>

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
    </div>


    <?php
	}
}