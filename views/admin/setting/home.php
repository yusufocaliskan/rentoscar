<?php if(!defined('OSCAR_RENT_A_CAR')) exit('<pre>Permission error! Please Go away :) </pre>'); ?>
<style>
    .form_element{margin-bottom:25px;}
</style>

<?php echo html::formOpen('Setting/Home/',array('id'=>'editpageForm')); ?>

    <h1>SİTE AYARLARI</h1>
<div class="row">
    <div class="colm left" style="width: 900px">

        <div class="form_element">
            <div>Site Başlığı</div>
            <input type="text"  style="font-size: 17px; padding: 10px 5px" value="<?php echo $this->settings->defaultTitle; ?>" name="siteTitle" placeholder="Browser'de yazılacak yer">
        </div>

        <div class="form_element">
            <div>En Küçük ve En büyük Yaş</div>
            <span style="float: left; margin-top: 11px; font-size: 20px; margin-right: 10px">En Küçük</span>
            <input type="text"  style="font-size: 17px; padding: 10px 5px; width: 50px; margin-right: 10px; float: left" value="<?php echo $this->settings->minAge?>" name="minAge" placeholder="Küçük">
            <span style="float: left; margin-top: 11px; font-size: 20px; margin-right: 10px">En Büyük</span>
            <input type="text"  style="font-size: 17px; padding: 10px 5px; width: 50px" value="<?php echo $this->settings->maxAge?>" name="maxAge" placeholder="Büyük">
            <em>Araç kiralaya bilecek en küçük ve en büyük yaş aralığı</em>
        </div>

        <div class="form_element">
            <div>Site E-Mail Adresi</div>
            <input type="text"  style="font-size: 17px; padding: 10px 5px" value="<?php echo $this->settings->siteEmail?>" name="siteEmail" placeholder="info@rentoscar.com">
            <em>Siteden gelecek maillerin, kullanıcıların sizinle iletişime geçebileceği email adresi</em>
        </div>

        <div class="form_element">
            <div>Telefon Numarası</div>
            <input type="text"  style="font-size: 17px; padding: 10px 5px" value="<?php echo $this->settings->defaultPhone?>" name="sitePhone" placeholder="+90 5555 555 55 55">
            <em>Kullanıcıların sizinle iletişime geçebileceği telefon numarası</em>
        </div>

        <div class="form_element">
            <span style="float: left; margin-top: 11px; font-size: 20px; margin-right: 10px">3 Günlük Sterlin : </span>
            <input type="text"  style="font-size: 17px; padding: 10px 5px; width: 100px; float: left" value="<?php echo $this->settings->threeDayPriceRange;?>" name="threeDayPriceRange" placeholder="3 Günlük"> <span style="  display: inline-block; margin-top: 11px; font-size: 20px; margin-left: 10px">Toplam fiyatın üzerine ekle. </span>
            <div class="clear"></div>

            <em>Araç kiralanılırken  3 günlük  fiyatı(<small> Sterlin</small>) üzerine eklenecek yazın</em>
        </div>

        <div class="form_element">
            <div>Slider Bottom</div>
            <textarea style="font-size: 17px; padding: 10px 5px; height: 200px" name="sliderBottom" placeholder="Slider'ın altında yer alan 3 ana başlık"><?php echo $this->settings->sliderBottom?></textarea>
            <em>Slider'ın altında yer alan 3 ana başlık ve içeriklerini girin. Html tag kullanılabilir.</em>
        </div>

        <div class="form_element">
            <div>Facebook</div>
            <i class="facebook"></i><input type="text"  style="font-size: 17px; width: 250px; float: left; padding: 10px 5px" value="<?php echo $this->settings->facebook?>" name="facebook" placeholder="Facebook Linki">
             <p class="clear"></p>
        </div>

        <div class="form_element">
            <div>Twitter</div>
            <i class="twitter"></i><input type="text"  style="font-size: 17px; width: 250px; float: left; padding: 10px 5px" value="<?php echo $this->settings->twitter?>" name="twitter" placeholder="Twitter Linki">
            <p class="clear"></p>
        </div>


     <div class="form_element">
        <input type="submit" class="blue_button form-update btn-plus btn-blue btn-delete" value="Kaydet">
        <a class="blue_button btn-delete form-update btn-plus btn-red" href="<?php echo BASEPATH?>dashboard/" >Iptal</a>
    </div>


    </div>

</div>

<?php echo html::formClose(); ?>








