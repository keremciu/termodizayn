<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<?php echo $form->textField($model,'title',array('class'=>'span2','maxlength'=>255)); ?>

	<?php echo $form->textAreaRow($model,'description',array('rows'=>2, 'cols'=>30, 'class'=>'span8')); ?>

	<?php echo $form->textFieldRow($model,'category',array('class'=>'span5')); ?>

	<?php echo $form->toggleButtonRow($model, 'is_published'); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType' => 'submit',
			'type'=>'primary',
			'label'=>'Search',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
