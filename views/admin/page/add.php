

<?php echo html::formOpen('Page/Add/',['id'=>'editpageForm']); ?>

    <h1>SAYFA EKLE</h1>
<div class="row">
    <div class="colm left">

        <div class="form_element">
            <div>Başlık</div>
            <input type="text"  style="font-size: 17px; padding: 10px 5px" value="<?php echo input::get('pageTitle','s');?>" name="pageTitle" placeholder="Haberin başlığı">
        </div>

        <div class="form_element">
            <div>İçerik</div>
            <textarea type="text" placeholder="Haberin içeriği" name="pageBody"><?php echo input::get('pageBody','');?></textarea>
        </div>
    </div>

    <div class="colm right">

       <div class="form_element" style="margin-bottom: 20px">
            <div>Üst Sayfa</div>
            <select name="pageParent" id="category">
                <option value="0">--</option>
                <?php foreach($this->allPages as $page): ?>
                    <option <?php if($page->pageId == input::get('pageParent')): echo 'selected="selected"'; endif; ?> value="<?php echo $page->pageId?>"><?php echo $page->pageTitle?></option>
                <?php endforeach;?>
            </select>
        </div>

       <div class="form_element" style="margin-bottom: 20px">
            <div>Side Bar</div>
            <select name="sideBar" id="category">

               <option <?php if('1' == input::get('sideBar')): echo 'selected="selected"'; endif; ?> value="1">Evet Göster</option>
               <option <?php if('0' == input::get('sideBar')): echo 'selected="selected"'; endif; ?> value="0"> Hayır Gösterme</option>
            </select>
        </div>

        <div class="form_element">
            <div>Sayfa Linki</div>
            <input type="text"  style="font-size: 12px; padding: 5px" value="<?php echo  input::get('pageLink','') ;?>" name="pageLink" placeholder="Urlde Gösterilecek link">
            <em>Türkçe harf ve boşluk kullanmayınız. Boş bırakıldığı halde sistem kendisi oluşturcaktır.<br> <strong>Örnek : url-link-ornegi </strong></em>
        </div>





    <div class="clear"></div>


 <div class="form_element" style="margin-top: 20px">
        <input type="submit" class="blue_button form-update btn-plus btn-blue btn-delete" value="Ekle">
        <a class="blue_button btn-delete form-update btn-plus btn-red" href="<?php echo BASEPATH?>page/" value="Güncelle">Iptal</a>
    </div>


    </div>
</div>

<?php echo html::formClose(); ?>
