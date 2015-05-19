<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'chat-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array('class'=>'well'),
)); ?>

	<?php echo $form->errorSummary($model); ?>
	<p class="help-block"><span class="required">*</span> işaretli alanlar boş bırakılamaz.</p>
	<?php echo $form->textFieldRow($model,'user',array('class'=>'span5')); ?>

	<?php echo $form->textAreaRow($model,'message',array('rows'=>2, 'cols'=>30, 'class'=>'span8')); ?>

	<?php echo $form->textFieldRow($model,'datime',array('class'=>'span5')); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Ekle' : 'Kaydet',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
