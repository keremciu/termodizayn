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
	<p class="help-block"><span class="required">*</span> işaretli alanlar boş bırakılamaz.</p>
	<?php echo $form->textFieldRow($model,'name',array('class'=>'span5','maxlength'=>255)); ?>
	
	<?php echo $form->textFieldRow($model,'url',array('class'=>'span5','maxlength'=>255)); ?>

	<div style="width:100%;overflow:hidden">
	<?php echo $form->redactorRow($model, 'desc', array('class'=>'span8', 'rows'=>5)); ?><br/><br/>
	</div>

	<?php echo $form->fileFieldRow($model,'image',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->hiddenField($model,'min_photo',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->dropDownListRow($model, 'gallery', $gallerydata, array('empty'=>'Lütfen bir galeri seçiniz', 'class'=>'span5')); ?>

	<?php if ($model->isNewRecord)
		echo $form->dropDownListRow($model, 'ordering', $orderinglist, array('empty'=>'Lütfen bir sıralama seçiniz', 'class'=>'span5'));
	else 
		echo $form->dropDownListRow($model, 'ordering', $orderinglist, array('empty'=>'Lütfen bir sıralama seçiniz', 'class'=>'span5'));
	?>

	<?php echo $form->toggleButtonRow($model, 'is_published'); ?>