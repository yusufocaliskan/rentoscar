<?php if(!defined('OSCAR_RENT_A_CAR')) exit('<pre>Permission error! Please Go away :) </pre>'); ?>
<h1 style="font-size: 40px; float: right">MARKALAR</h1>
<table class="table table-bordered table-striped" style="margin: 30px 0">
	<thead style="background: #bbb;">
		<tr>
			<th style="width: 80px; text-align: center">Marka ID</th>
			<th>Marka Resim</th>
			<th>Marka Adı</th>
			<th>Kontrol</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($this->carsMark as $mark): ?>
			<tr>
				<td style="width: 80px; text-align: center"><?php echo $mark->markaId?></td>
				<td style="width: 200px"><?php echo html::img(array('style'=>'width: 100px','src'=>'images/'.$mark->markaResim)); ?></td>
				<td><?php echo $mark->markaAdi?></td>
				<td style="width:150px;" >

						<?php if(request::get('uploadFormId') == $mark->markaId): ?>
							<?php echo html::formOpen('cars/markImageUpdate/'.$mark->markaId,array('class'=>'markImageForm','enctype'=>'multipart/form-data')); ?>
								<input id="markImage" type="file" name="markImage">
								<input type="hidden" name="markOldImage" value="<?php echo $mark->markaResim; ?>">
								<button class="btn">Ekle</button>
							<?php echo html::formClose(); ?>
						<?php else: ?>
							<?php echo html::link('Resim Ekle',array('href'=>'cars/listCarsMark?uploadFormId='.$mark->markaId));?>
						<?php endif; ?>

				</td>
			</tr>
		<?php endforeach;?>
	</tbody>
</table>