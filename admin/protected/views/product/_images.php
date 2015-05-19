<table class="table table-striped table-bordered table-condensed fieldtypes" id="yw119">
	<thead>
		<tr class="odd"><td><a href="<?php echo Yii::app()->baseUrl.'/../images/products/product/'.$model->image; ?>" target="_blank"><img width="50" height="50" style="height:50px;width:50px" src="<?php echo Yii::app()->baseUrl.'/../images/products/product/'.$model->image; ?>" /></td><th><?php echo $form->fileFieldRow($model,'image',array('class'=>'span3','maxlength'=>255)); ?></th><td><?php echo $form->textFieldRow($model,'imagedesc',array('class'=>'span3','maxlength'=>255)); ?></td></tr>
		<?php

			$images = Pimages::model()->findAll(array('condition' => 'type = "image" AND pid = :pid','params'=>array(':pid'=>$model->id)));

			foreach ($images as $key => $image) { ?>
		<tr class="even extraimage thisfield"><td><a href="<?php echo Yii::app()->baseUrl.'/../images/products/product/'.$model->image; ?>" target="_blank"><img width="50" height="50" style="height:50px;width:50px" src="<?php echo Yii::app()->baseUrl.'/../images/products/product/extras/'.$image->path; ?>" /></td><th><label><a href="<?php echo Yii::app()->baseUrl.'/../images/products/product/extras/'.$image->path;?>" target="_blank" title="Fotoğrafı görüntülemek için tıklayın">Ekstra ürün fotoğrafı</a> <em>- #<?php echo $image->ordering; ?></em></label></th><td><label for="eximagedesc<?php echo $image->id;?>">Eksta ürün fotoğrafı #<?php echo $image->ordering;?> açıklaması</label><input class="span3" maxlength="255" name="Eximagedescs[eximagedesc<?php echo $image->id; ?>]" value="<?php echo $image->name; ?>" id="eximagedesc<?php echo $image->id;?>" type="text"></td><td><a href="<?php echo Yii::app()->createUrl('product/extraimagedelete'); ?>" class="btn btn-mini btn-danger deletefield"  rel="<?php echo $image->id;?>">Sil</a></td></tr>
			<?php } ?>
	</thead>
	<tfoot>
	<?php   $videos = Pimages::model()->findAll(array('condition' => 'type = "video" AND pid = :pid','params'=>array(':pid'=>$model->id)));
			foreach ($videos as $key => $video) { ?>
		<tr class="even extraimage thisfield"><th><label><a href="<?php echo $video->path;?>" target="_blank" title="Videoyu görüntülemek için tıklayın">Ürün videosu</a> <em>- #<?php echo $video->ordering; ?></em></label></th><td><label for="exvideodesc<?php echo $video->id;?>">Ürün videosu #<?php echo $video->ordering;?> açıklaması</label><input class="span3" maxlength="255" name="Exvideodescs[exvideodesc<?php echo $video->id; ?>]" value="<?php echo $video->name; ?>" id="exvideodesc<?php echo $video->id;?>" type="text"></td><td><a href="<?php echo Yii::app()->createUrl('product/extravideodelete'); ?>" class="btn btn-mini btn-danger deletefield"  rel="<?php echo $video->id;?>">Sil</a></td></tr>
	<?php } ?>
	</tfoot>
	<tbody>
	<?php   $files = Pimages::model()->findAll(array('condition' => 'type = "file" AND pid = :pid','params'=>array(':pid'=>$model->id)));
			foreach ($files as $key => $file) { ?>
		<tr class="even extraimage thisfield"><th><label><a href="<?php echo Yii::app()->baseUrl.'/../images/products/product/documents/'.$file->path;?>" target="_blank" title="Fotoğrafı görüntülemek için tıklayın">Ürün dökümanı</a> <em>- #<?php echo $file->ordering; ?></em></label></th><td><label for="exfiledesc<?php echo $file->id;?>">Ürün dökümanı #<?php echo $file->ordering;?> açıklaması</label><input class="span3" maxlength="255" name="Exfiledescs[exfiledesc<?php echo $file->id; ?>]" value="<?php echo $file->name; ?>" id="exfiledesc<?php echo $file->id;?>" type="text"></td><td><a href="<?php echo Yii::app()->createUrl('product/extrafiledelete'); ?>" class="btn btn-mini btn-danger deletefield"  rel="<?php echo $file->id;?>">Sil</a></td></tr>
	<?php } ?>
	</tbody></table>

<a href="javascript:;" class="btn btn-primary btn-small addextraimage"><i class="bootstrapicon icon-white icon-picture"></i> Projeye Fotoğraf Ekle</a>
<a href="javascript:;" class="btn btn-primary btn-small addextradocument"><i class="bootstrapicon icon-white icon-file"></i> Döküman Ekle</a>
<a href="javascript:;" class="btn btn-primary btn-small addextravideo"><i class="bootstrapicon icon-white icon-facetime-video"></i> Video Ekle</a>

<?php

Yii::app()->clientScript->registerScriptFile('files/extrafiles.js',CClientScript::POS_END); 