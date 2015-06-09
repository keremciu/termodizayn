<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'user-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array('class'=>'form-section_content'),
)); ?>

	<?php echo $form->textFieldRow($model,'username',array('class'=>'form-control','maxlength'=>30)); ?>

	<?php echo $form->textFieldRow($model,'name',array('class'=>'form-control','maxlength'=>30)); ?>

	<?php echo $form->textFieldRow($model,'lastname',array('class'=>'form-control','maxlength'=>30)); ?>

	<?php echo $form->textFieldRow($model,'email',array('class'=>'form-control','maxlength'=>75)); ?>

	<?php echo $form->passwordFieldRow($model,'password',array('class'=>'form-control','maxlength'=>40)); ?>

	<?php echo $form->dropDownListRow($model,'role', array('admin'=>'Baş Yönetici','dealer'=>'Bayi','normal'=>'Standart'),array('class'=>'form-control','empty'=>'Lütfen üyelik seviyesini seçiniz')); ?>

	<?php echo $form->toggleButtonRow($model, 'active', array('class'=>'form-control')); ?>

	<p class="help-block"><span class="required">*</span> işaretli alanlar boş bırakılamaz.</p>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'success',
			'size'=>'large',
			'label'=>$model->isNewRecord ? '<svg class="td-icon td-icon-cloud-done"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-cloud-done"></use></svg> Üyelik Ekle' : 'Üyeliği Kaydet',
			'label'=>'Kaydet',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
