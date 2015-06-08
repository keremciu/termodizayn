<?php 

$model->create_date = date("Y-m-d H:i:s");

$criteria=new CDbCriteria;
$criteria->select='max(ordering) AS ordering';		
$row = $model->find($criteria); 	
$lastorder = $row['ordering']+1;

if ($model->isNewRecord) {
	$model->ordering = $lastorder;
}

$orderdata = CHtml::listData($model->findAll(array('order' => 'ordering')),'ordering','fullName');
$orderinglist = CMap::mergeArray(array(0=>'0 İlk sırada'),$orderdata,array($lastorder=>$lastorder.' Son sırada'));

$form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'product-model-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array('class'=>'well'),
)); ?>

	<?php echo $form->errorSummary($model); ?>
	<p class="help-block"><span class="required">*</span> işaretli alanlar boş bırakılamaz.</p>

	<?php echo $form->dropDownListRow($model, 'product', CHtml::listData(Product::model()->findAll(),'id','title'), array('empty'=>'Modelin bağlı olduğu ürünü seçiniz', 'class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'name',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'slug',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'price',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textAreaRow($model,'content',array('rows'=>2, 'cols'=>30, 'class'=>'span8')); ?>

	<?php echo $form->fileFieldRow($model,'image',array('class'=>'span5','maxlength'=>255)); ?>

	<?php if ($model->isNewRecord)
		echo $form->dropDownListRow($model, 'ordering', $orderinglist, array('empty'=>'Lütfen bir sıralama seçiniz', 'class'=>'span5'));
	else 
		echo $form->dropDownListRow($model, 'ordering', $orderinglist, array('empty'=>'Lütfen bir sıralama seçiniz', 'class'=>'span5'));
	?>

	<?php echo $form->toggleButtonRow($model, 'is_published'); ?>
	<?php echo $form->hiddenField($model,'create_date'); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Ekle' : 'Kaydet',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
