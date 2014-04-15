

<?php echo html::formOpen('Page/edit/'.$this->pageById->pageId,array('id'=>'editpageForm')); ?>

    <h1>SAYFA GÜNCELLE</h1>
<div class="row">
    <div class="colm left">

        <div class="form_element">
            <div>Başlık</div>
            <input type="text"  style="font-size: 17px; padding: 10px 5px" value="<?php echo $this->pageById->pageTitle; ?>" name="pageTitle" placeholder="Sayfa Başlığı">
        </div>

        <div class="form_element">
            <div>İçerik</div>
            <textarea type="text" placeholder="Sayfanın içeriği" name="pageBody"><?php echo $this->pageById->pageBody ;?></textarea>
        </div>
    </div>

    <div class="colm right">

   <div class="form_element">
        <div>Üst Sayfası</div>
        <select name="pageParent">
            <option value="0">--</option>
            <?php foreach($this->allPages as $page): ?>
                <option <?php if($page->pageId == $this->pageById->pageParent): echo 'selected="selected"'; endif; ?> value="<?php echo $page->pageId?>"><?php echo $page->pageTitle?></option>
            <?php endforeach;?>
        </select>
        <div class="clear"></div>
            <a  class="btn-delete"  href="<?php echo BASEPATH?>Page/Add/">+ Yeni Sayfa Ekle</a> &middot; &middot; &middot; &middot;
            <a  class="btn-delete"  href="<?php echo BASEPATH?>page/read/<?php echo $this->pageById->pageLink?>">+ Sayfayı Görüntüle</a>
    </div>


        <div class="form_element">
            <div>Sayfa Linki</div>
            <input type="text"  style="font-size: 12px; padding: 5px" value="<?php echo helper::sefLink($this->pageById->pageLink) ;?>" name="pageLink" placeholder="Urlde Gösterilecek link">
            <em>Türkçe harf ve boşluk kullanmayınız. Boş bırakıldığı halde sistem kendisi oluşturcaktır.<br> <strong>Örnek : url-link-ornegi </strong></em>
        </div>

        <div class="form_element" style="margin-bottom: 20px">
            <div>Side Bar</div>
            <select name="sideBar" id="category">

               <option <?php if('1' == $this->pageById->sideBar): echo 'selected="selected"'; endif; ?> value="1">Evet Göster</option>
               <option <?php if('0' == $this->pageById->sideBar): echo 'selected="selected"'; endif; ?> value="0"> Hayır Gösterme</option>
            </select>
        </div>

        <div class="form_element" style="margin-bottom: 20px">
            <div>Sayfa Sırası</div>
            <input type="number" name="pageOrder" placeholder="Sıra" min="0"  style="width: 50px" value="<?php echo $this->pageById->pageOrder?>">
        </div>

    <div class="clear"></div>


    <div class="form_element" style="margin-top: 20px">
        <input type="submit" class="blue_button form-update btn-plus btn-blue btn-delete" value="Güncelle">
        <a class="blue_button btn-delete form-update btn-plus btn-red" href="<?php echo BASEPATH?>Page/Delete/<?php echo $this->pageById->pageId?>">Sil</a>
    </div>


    </div>
</div>

<?php echo html::formClose(); ?>
