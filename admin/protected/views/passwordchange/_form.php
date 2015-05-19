<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'passwordchange-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array('class'=>'well'),
)); ?>

	<p class="help-block"><span class="required">*</span> işaretli alanlar boş bırakılamaz.</p>

	<?php echo $form->passwordFieldRow($model,'old_password',array('class'=>'span5','maxlength'=>40,'value'=>'')); ?>
	
	<?php echo $form->passwordFieldRow($model,'new_password',array('class'=>'span5','maxlength'=>40,'value'=>'')); ?>

	<?php echo $form->passwordFieldRow($model,'confirm_password',array('class'=>'span5','maxlength'=>40,'value'=>'')); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'size'=>'large',
			'label'=>'Kaydet',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
