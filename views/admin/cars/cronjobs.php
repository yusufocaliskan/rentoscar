<?php if(!defined('OSCAR_RENT_A_CAR')) exit('<pre>Permission error! Please Go away :) </pre>'); ?>
<style>
    h5{
        border-bottom: 1px dashed green;
        color: #777;
        font-size: 13px;
        text-align: center;
        position: relative;
        margin: 30px 0;
    }

    h5 span{
        position: absolute;
        top: -9px;
        left: 20px;
        background: green;
        color: #111;
        padding: 0 14px;
        font-weight: bold;
    }

    ul{
        list-style: none;
    }
    ul li{
        padding: 5px 10px;
        color: #555;

    }

    i{
        border-bottom: 1px dashed #1A51E0;
        color: green;

    }
    .cronjobs{
        width: 500px;
        border: 3px solid green;
        margin: 0 auto;
        background: #111;
    }

    p{
        color: green;
    }

</style>

<div class="cronjobs">

<p style="padding: 10px;  text-align: center">Sistemdeki <strong>araçları, doanımları, markaları, lokasyonları</strong> güncellemek için sağ üsteki <strong>Robotları Gönder</strong> linkini tıklayın.</p>

<h5><span>Araçlar</span></h5>
    <ul>
        <li><i>Güncellenen</i> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  &rarr;  &nbsp;  &nbsp;  &nbsp;  <span style="color: green"> &nbsp;<?php echo $this->cronjobCars['updateOK']; ?> YES &nbsp;<span> | <span style="color: rgb(165, 53, 53)">&nbsp;<?php echo $this->cronjobCars['updateERROR']; ?> NO &nbsp;<span> </li>
        <li><i>Eklenen</i> &nbsp; &nbsp;  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &rarr;  &nbsp;  &nbsp;  &nbsp; <span style="color: green">&nbsp;<?php echo $this->cronjobCars['insertOK']; ?> YES &nbsp;<span> | <span style="color: rgb(165, 53, 53)">&nbsp;<?php echo $this->cronjobCars['insertERROR']; ?> NO&nbsp;<span> </li>
    </ul>

<h5><span>Donanımlar</span></h5>
    <ul>
        <li><i>Güncellenen</i> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  &rarr;  &nbsp;  &nbsp;  &nbsp;  <span style="color: green"> &nbsp;<?php echo $this->cronjobExtras['updateOK']; ?> YES &nbsp;<span> | <span style="color: rgb(165, 53, 53)">&nbsp;<?php echo $this->cronjobExtras['updateERROR']; ?> NO &nbsp;<span> </li>
        <li><i>Eklenen</i> &nbsp; &nbsp;  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &rarr;  &nbsp;  &nbsp;  &nbsp; <span style="color: green">&nbsp;<?php echo $this->cronjobExtras['insertOK']; ?> YES &nbsp;<span> | <span style="color: rgb(165, 53, 53)">&nbsp;<?php echo $this->cronjobExtras['insertERROR']; ?> NO&nbsp;<span> </li>
    </ul>

<h5><span>Lokasyonlar</span></h5>

    <ul>
        <li><i>Güncellenen</i> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  &rarr;  &nbsp;  &nbsp;  &nbsp;  <span style="color: green"> &nbsp;<?php echo $this->cronjobLocations['updateOK']; ?> YES &nbsp;<span> | <span style="color: rgb(165, 53, 53)">&nbsp;<?php echo $this->cronjobLocations['updateERROR']; ?> NO &nbsp;<span> </li>
        <li><i>Eklenen</i> &nbsp; &nbsp;  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &rarr;  &nbsp;  &nbsp;  &nbsp; <span style="color: green">&nbsp;<?php echo $this->cronjobLocations['insertOK']; ?> YES &nbsp;<span> | <span style="color: rgb(165, 53, 53)">&nbsp;<?php echo $this->cronjobLocations['insertERROR']; ?> NO&nbsp;<span> </li>
    </ul>

<h5><span>Marks</span></h5>

    <ul>
        <li><i>Güncellenen</i> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  &rarr;  &nbsp;  &nbsp;  &nbsp;  <span style="color: green"> &nbsp;<?php echo $this->cronjobMarks['updateOK']; ?> YES &nbsp;<span> | <span style="color: rgb(165, 53, 53)">&nbsp;<?php echo $this->cronjobMarks['updateERROR']; ?> NO &nbsp;<span> </li>
        <li><i>Eklenen</i> &nbsp; &nbsp;  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &rarr;  &nbsp;  &nbsp;  &nbsp; <span style="color: green">&nbsp;<?php echo $this->cronjobMarks['insertOK']; ?> YES &nbsp;<span> | <span style="color: rgb(165, 53, 53)">&nbsp;<?php echo $this->cronjobMarks['insertERROR']; ?> NO&nbsp;<span> </li>
    </ul>


</div>