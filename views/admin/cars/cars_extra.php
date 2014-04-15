<?php if(!defined('OSCAR_RENT_A_CAR')) exit('<pre>Permission error! Please Go away :) </pre>'); ?>
<h1 style="font-size: 40px; float: right">DONANIMLAR</h1>
<table class="table table-bordered table-striped" style="margin: 30px 0">
	<thead style="background: #bbb;">
		<tr>
			<th style="width: 80px; text-align: center">Donanım ID</th>
			<th>Donanım Türkçe Adı</th>
			<th>Donanım İnglizce Adı</th>
			<th>Açıklama</th>
			<th>Kontrol</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($this->allExtra as $extras): ?>
			<tr id="tableTr-<?php echo $extras->cars_extras_id ?>">
				<td style="width: 80px; text-align: center"><?php echo $extras->cars_extras_id?></td>
				<td><?php echo $extras->donanimturkcead?></td>
				<td><?php echo $extras->donanimingad?></td>
				<td>
					<?php if(request::get('addExtraInfo') == $extras->cars_extras_id): ?>
						<?php echo html::formOpen('cars/addExtraInfo/'.$extras->cars_extras_id); ?>
							<strong>Açıklama</strong>
							<textarea name="extraInfo" style="width: 91%"><?php echo $extras->extraInfo?></textarea>
							<button class="btn">Açıklama Ekle</button> <a style="display: inline-block; margin: 15px 0px 0 10px" href="<?php echo BASEPATH?>cars/listCarExtras">Ipdal</a>
						<?php echo html::formClose(); ?>
					<?php else: ?>
					<p><?php echo $extras->extraInfo?></p>
						<?php echo html::link('Açıklama Ekle',array('id'=>'tableTr-'.$extras->cars_extras_id,'href'=>'cars/listCarExtras?addExtraInfo='.$extras->cars_extras_id.'#tableTr-'.$extras->cars_extras_id));?>

					<?php endif; ?>

				</td>
				<td style="width:150px;" >

						<?php if(request::get('uploadFormId') == $extras->cars_extras_id): ?>
							<?php echo html::formOpen('cars/extraImageUpdate/'.$extras->cars_extras_id,array('class'=>'extraImageForm','enctype'=>'multipart/form-data')); ?>
								<input id="extraImage" type="file" name="extraImage">
								<input type="hidden" name="extraOldImage" value="<?php echo $extras->extraImage; ?>">
								<button class="btn">Ekle</button>
							<?php echo html::formClose(); ?>
						<?php else: ?>
						<?php echo html::img(array('style'=>'width: 100px','src'=>'images/'.$extras->extraImage)); ?>
							<?php echo html::link('Resim Ekle',array('id'=>'tableTr-'.$extras->cars_extras_id,'href'=>'cars/listCarExtras?uploadFormId='.$extras->cars_extras_id.'#tableTr-'.$extras->cars_extras_id));?>
						<?php endif; ?>

				</td>
			</tr>
		<?php endforeach;?>
	</tbody>
</table>