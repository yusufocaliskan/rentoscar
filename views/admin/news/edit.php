<?php if(!defined('OSCAR_RENT_A_CAR')) exit('<pre>Permission error! Please Go away :) </pre>'); ?>

<?php echo html::formOpen('News/Edit/'.$this->newsById->newsId,array('id'=>'editNewsForm','enctype'=>'multipart/form-data')); ?>

    <h1>HABER GÜNCELLE</h1>
<div class="row">
    <div class="colm left">

        <div class="form_element">
            <div>Başlık</div>
            <input type="text"  style="font-size: 17px; padding: 10px 5px" value="<?php echo $this->newsById->newsTitle; ?>" name="newsTitle" placeholder="Haberin başlığı">
        </div>

        <div class="form_element">
            <div>İçerik</div>
            <textarea type="text" placeholder="Haberin içeriği" name="newsBody"><?php echo $this->newsById->newsBody;?></textarea>
        </div>
    </div>

    <div class="colm right">

   <div class="form_element">
        <div>Kategori</div>
        <select name="newsCategory" id="category">
            <?php foreach($this->allCategory as $category): ?>
                <option <?php if($category->categoryId == $this->newsById->newsCategory): echo 'selected="selected"'; endif; ?> value="<?php echo $category->categoryId?>"><?php echo $category->categoryName?></option>
            <?php endforeach;?>
        </select>
        <div class="clear"></div>
    </div>

    <div class="form_element">

        <ul style="margin-left: 0" id="categoriesList">

            <?php foreach($this->allCategory as $category): ?>
             <li style="list-style: none" >
                <a href="<?php echo BASEPATH?>Category/Delete/<?php echo $category->categoryId?>" style="text-decoration: none">
                    <img style="width: 15px; margin-right: 7px" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABIAAAASCAMAAABhEH5lAAAAwFBMVEUAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAC9vb1fX1/Hx8fNzc3IyMjExMSvr6/JycmwsLChoaG2trbQ0NC+vr7Q0NDOzs7Ozs7MzMzGxsbQ0NDLy8vKysrR0dHLy8vR0dHOzs7R0dHQ0NDR0dHQ0NDR0dHR0dHS0tLS0tJDS1ZOVmBiaXJka3TS0tLT09PX2dvZ2dna2trc3d/m5ubr6+vs7Ozw8PHy8vL29vb39/f4+Pj5+fn8/Pz9/f3+/v7///+QUUwjAAAAKXRSTlMAAQIDBAUGCQoUJigpLS8vMjM0T1aOkJOUlZWYmbi9zdPW19nd8fT5/M/kqJoAAADKSURBVBjTZZDpFsEwEEa/tmpfS1Fb7ZQgiKC08/5vJeHY75/MueebnJkBNDnXn899N4cnaZeLUxyfBHfTD1Pt7iO6E+27VW3y6yO9OK6zgNES9IFoGShtY1XtJJHcqSLmBTR0aLNgUrLFRsfqGIXqlcuAsWCpohQOMNN9JFkQMG3oOvlT0RTjy8OoxrsLh2gffr5vwvkZYusg2Tl8jdpJwip/L1S0YNi13nvtXs02ANPOeFycic6Cexnb1KcwE6mK11+t+l4llVDmBk+RNsdw2BgZAAAAAElFTkSuQmCC" alt="">
                </a>
                <a href=""><?php echo $category->categoryName?> </a></li>
            <?php endforeach;?>

        </ul>
        <div class="clear"></div>

    </div>
    <a  class="add_cate_button" style="display: block" href="#">+ Yeni Kategori Ekle</a>
    <a  style="display: block" href="<?php echo BASEPATH?>News/Add">+ Haber Ekle</a>
    <div class="form_element" id="addCategoryForm">

            <input type="text" class="fl" name="categoryName" placeholder="Yeni Kategori Adı" style="margin-top: 7px; margin-right:12px; padding: 2px 5px; width: 130px">
            <img style="margin-top: 12px; margin-right: 12px; float: left; display: none" class="loadding" src="<?php echo BASEPATH?>images/ajax-loader1.gif" alt="">
            <a style="padding: 2px 7px!important" href="#" class="fl add_category_submit btn btn-green">Ekle</a>
            <a style="padding: 2px 7px!important" href="#" class=" fl cancel_category  btn btn-red">Iptal</a>
    </div>

    <style>
        #addCategoryForm{display: none;}
    </style>

    <div class="clear"></div>
    <div class="form_element" >
        <div>İçeriği göster</div>
        <select name="showContent" id="showContent">

            <option <?php if($this->newsById->showContent == 1): echo 'selected="selected"'; endif; ?>  value="1">Göster
            <option <?php if($this->newsById->showContent == 2): echo 'selected="selected"'; endif; ?>  value="2">Gösterme
        </select>
        <em>Eğer bu bir slider haberi ise ve resim üzerinde yeterince bilgi varsa <strong>Gösterme'yi</strong> işaretleyin</em>
    </div>

    <div class="form_element">
        <div>HABER RESİM</div>
        <?php if($this->newsById->newsImage):?>
            <img style="margin: 10px 0" src="<?php echo BASEPATH.'/images/'.$this->newsById->newsImage?>" alt="">
        <?php else:?>
            <br><h3>Haber Resim'i yok.</h3><br>
        <?php endif;?>

        <input value="<?php echo BASEPATH.'/images/'.$this->newsById->newsImage?>" type="file" name="newsImage">
    </div>

    <div class="form_element" style="margin-top: 20px">
        <input type="submit" class="blue_button form-update btn-plus btn-blue btn-delete" value="Güncelle">
        <a class="blue_button btn-delete form-update btn-plus btn-red" href="<?php echo BASEPATH?>News/Delete/<?php echo $this->newsById->newsId?>" value="Güncelle">Sil</a>
    </div>


    </div>
</div>

<?php echo html::formClose(); ?>
