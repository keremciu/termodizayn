<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'totelephone-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array('class'=>'well'),
)); ?>

	<?php echo $form->errorSummary($model); ?>
	<p class="help-block"><span class="required">*</span> işaretli alanlar boş bırakılamaz.</p>
	<?php echo $form->textFieldRow($model,'name',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'email',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'telephone',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'inform',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'subscribe',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'active',array('class'=>'span5')); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Ekle' : 'Kaydet',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
