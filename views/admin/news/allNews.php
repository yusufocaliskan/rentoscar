<?php if(!defined('OSCAR_RENT_A_CAR')) exit('<pre>Permission error! Please Go away :) </pre>'); ?>
<h1 style="font-size: 40px; float: right">HABERLER</h1>

<?php echo html::link('Yeni Ekle',array('class'=>'btn-plus btn-blue','href'=>'News/Add'));?>


<table class="table table-bordered" style="margin-top: 20px">
    <thead style="background: #eee">
        <th>
            <td>Başlık</td>
            <td>Kategori</td>
            <td style="width: 5% !important" >Okunma</td>
            <td style="width: 120px">Tarih</td>
            <td style="width: 100px">Görüntüle</td>
        </th>
    </thead>

    <tbody>

            <?php

            $allNews = $this->model->allNews();
            foreach($allNews as $news): ?>

        <tr>
            <td><?php echo $news->newsId?></td>
            <td><a href="<?php echo BASEPATH?>News/Read/<?php echo $news->newsLink?>"><?php echo $news->newsTitle?></a></td>
            <td><a href="<?php echo BASEPATH?>Category/List/<?php echo $news->categoryId?>"><?php echo $news->categoryName?></a></td>
            <td><?php echo $news->newsHit?></td>
            <td><?php echo $news->newsDate; ?></td>
            <td >
                <a href="<?php echo BASEPATH?>News/Delete/<?php echo $news->newsId?>" class="btn-delete">[Sil]</a>  |
                <a href="<?php echo BASEPATH?>News/Edit/<?php echo $news->newsId?>">[Düzenle]</a>
            </td>
        </tr>
            <?php endforeach; ?>

    </tbody>
</table>
