<?php

$criteria=new CDbCriteria;
$criteria->select='max(ordering) AS ordering';		
$row = $model->find($criteria); 	
$lastorder = $row['ordering']+1;

if ($model->isNewRecord) {
	$model->ordering = $lastorder;
}

$orderdata = CHtml::listData($model->findAll(array('order' => 'ordering')),'ordering','fullName');
$orderinglist = CMap::mergeArray(array(0=>'0 İlk sırada'),$orderdata,array($lastorder=>$lastorder.' Son sırada'));
?>

	<?php echo $form->errorSummary($model); ?>
	<p class="help-block"><span class="required">*</span> işaretli alanlar boş bırakılamaz.</p>
	<?php echo $form->textFieldRow($model,'title',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textAreaRow($model,'info',array('rows'=>2, 'cols'=>30, 'class'=>'span8')); ?>

	<?php if ($model->isNewRecord)
		echo $form->dropDownListRow($model, 'ordering', $orderinglist, array('empty'=>'Lütfen bir sıralama seçiniz', 'class'=>'span5'));
	else 
		echo $form->dropDownListRow($model, 'ordering', $orderinglist, array('empty'=>'Lütfen bir sıralama seçiniz', 'class'=>'span5'));
	?>

	<?php echo $form->toggleButtonRow($model, 'active'); ?>
