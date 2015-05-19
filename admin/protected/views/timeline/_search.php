<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<?php echo $form->textFieldRow($model,'id',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'title',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textAreaRow($model,'desc',array('rows'=>2, 'cols'=>30, 'class'=>'span8')); ?>

	<?php echo $form->textAreaRow($model,'info',array('rows'=>2, 'cols'=>30, 'class'=>'span8')); ?>

	<?php echo $form->textFieldRow($model,'date',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'ordering',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'active',array('class'=>'span5')); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType' => 'submit',
			'type'=>'primary',
			'label'=>'Search',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
