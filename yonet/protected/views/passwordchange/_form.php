<?php $form=$this->beginWidget('booster.widgets.TbActiveForm',array(
	'id'=>'passwordchange-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array('class'=>''),
)); ?>

	<p class="help-block"><span class="required">*</span> işaretli alanlar boş bırakılamaz.</p>

	<?php echo $form->passwordFieldGroup($model,'old_password',array('class'=>'span5','maxlength'=>40,'value'=>'')); ?>
	
	<?php echo $form->passwordFieldGroup($model,'new_password',array('class'=>'span5','maxlength'=>40,'value'=>'')); ?>

	<?php echo $form->passwordFieldGroup($model,'confirm_password',array('class'=>'span5','maxlength'=>40,'value'=>'')); ?>

	<div class="form-actions">
		<?php $this->widget('booster.widgets.TbButton', array(
			'buttonType'=>'submit',
			'context'=>'primary',
			'size'=>'large',
			'label'=>'Kaydet',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
