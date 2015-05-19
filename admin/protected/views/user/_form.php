<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'user-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array('class'=>'well'),
)); ?>

	<p class="help-block"><span class="required">*</span> işaretli alanlar boş bırakılamaz.</p>

	<?php echo $form->textFieldRow($model,'username',array('class'=>'span5','maxlength'=>30)); ?>

	<?php echo $form->textFieldRow($model,'name',array('class'=>'span5','maxlength'=>30)); ?>

	<?php echo $form->textFieldRow($model,'lastname',array('class'=>'span5','maxlength'=>30)); ?>

	<?php echo $form->textFieldRow($model,'email',array('class'=>'span5','maxlength'=>75)); ?>

	<?php echo $form->passwordFieldRow($model,'password',array('class'=>'span5','maxlength'=>40)); ?>

	<?php echo $form->dropDownListRow($model,'role', array('admin'=>'Baş Yönetici','staff'=>'Editör'),array('class'=>'span5','empty'=>'Lütfen yönetici seviyesini seçiniz')); ?>

	<?php echo $form->toggleButtonRow($model, 'active'); ?>
	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'size'=>'large',
			'label'=>'Kaydet',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
