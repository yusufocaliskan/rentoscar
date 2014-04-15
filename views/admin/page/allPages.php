
<h1 style="font-size: 40px; float: right">SAYFALAR</h1>
<?php echo html::link('Yeni Ekle',array('class'=>'btn-plus btn-blue','href'=>'Page/Add'));?>


<table class="table table-bordered" style="margin-top: 20px">
    <thead style="background: #eee">
        <th>
            <td>Başlık</td>
            <td>Açıklama</td>
            <td style="width: 20% !important" >Üst Sayfa</td>
            <td style="width: 120px">Tarih</td>
        </th>
    </thead>

    <tbody>

    <?php foreach($this->allPages as $pages): ?>
        <tr>
            <td><?php echo $pages->pageId?></td>
            <td><a href="<?php echo BASEPATH?>Page/Read/<?php echo $pages->pageLink?>"><?php echo $pages->pageTitle?></a></td>
            <td><?php echo strip_tags($pages->pageBody)?>...</td>
            <td><?php if($parentTitle = $this->model->allPages($pages->pageParent)->pageTitle){ echo $parentTitle; }else{ echo '---'; }  ?></td>
            <td >
                <a href="<?php echo BASEPATH?>Page/Delete/<?php echo $pages->pageId?>" class="btn-delete">[Sil]</a>  --
                <a href="<?php echo BASEPATH?>Page/Edit/<?php echo $pages->pageId?>">[Düzenle]</a></td>
        </tr>
    <?php endforeach; ?>

    </tbody>
</table>
