<?php 
$criteria=new CDbCriteria;
$criteria->select='max(ordering) AS ordering';		
$row = $model->find($criteria); 	
$lastorder = $row['ordering']+1;
$gallerydata = CHtml::listData(Gallery::model()->findAll(array('order' => 'id')),'id','name');
$model->min_photo = 0;
$orderdata = CHtml::listData($model->findAll(array('order' => 'ordering')),'ordering','name');
if ($model->isNewRecord) {
	$model->ordering = $lastorder;
}
$orderinglist = CMap::mergeArray(array(0=>'0 İlk sırada'),$orderdata,array($lastorder=>$lastorder.' Son sırada'));
?>

	<?php echo $form->errorSummary($model); ?>
	<div class="row">
		<div class="col-md-6">
			<div class="form-group">
			<?php 
				echo $form->textFieldRow($model,'name',array('class'=>'form-control','maxlength'=>255));
				echo "</div><div>".$form->textFieldRow($model,'url',array('class'=>'form-control','maxlength'=>255));
			?>
			</div>
		</div>
		<div class="col-md-6">
			<div style="width:100%;overflow:hidden">
				<?php echo $form->redactorRow($model, 'desc', array('class'=>'form-control', 'rows'=>5)); ?><br/><br/>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-6">
			<div class="form-group">
				<?php
					echo $form->hiddenField($model,'min_photo');
					echo $form->fileFieldRow($model,'image',array('class'=>'form-control','maxlength'=>255));
					echo "</div><div>".$form->dropDownListRow($model, 'gallery', $gallerydata, array('empty'=>'Lütfen bir galeri seçiniz', 'class'=>'form-control'))
				?>
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
			<?php 
				if ($model->isNewRecord)
					echo $form->dropDownListRow($model, 'ordering', $orderinglist, array('empty'=>'Lütfen bir sıralama seçiniz', 'class'=>'form-control'));
				else 
					echo $form->dropDownListRow($model, 'ordering', $orderinglist, array('empty'=>'Lütfen bir sıralama seçiniz', 'class'=>'form-control'));

				echo "</div><div>". $form->toggleButtonRow($model, 'is_published', array('class'=>'form-control'));
			?>
			</div>
		</div>
	</div>

<p class="help-block"><span class="required">*</span> işaretli alanlar boş bırakılamaz.</p>