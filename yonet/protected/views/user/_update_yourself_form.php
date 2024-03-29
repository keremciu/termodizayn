<?php $form=$this->beginWidget('booster.widgets.TbActiveForm',array(
	'id'=>'user-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array('class'=>''),
)); ?>

	<p class="help-block"><span class="required">*</span> işaretli alanlar boş bırakılamaz.</p>

	<?php echo $form->textFieldGroup($model,'name',array('class'=>'span5','maxlength'=>30)); ?>

	<?php echo $form->textFieldGroup($model,'lastname',array('class'=>'span5','maxlength'=>30)); ?>

	<?php echo $form->textFieldGroup($model,'email',array('class'=>'span5','maxlength'=>75)); ?>

	<div class="form-actions">
		<?php $this->widget('booster.widgets.TbButton', array(
			'buttonType'=>'submit',
			'context'=>'primary',
			'size'=>'large',
			'label'=>'Kaydet',
		)); ?>
	</div>

<?php $this->endWidget(); ?>