<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'translates-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array('class'=>'well'),
)); ?>

	<?php echo $form->errorSummary($model); ?>
	<p class="help-block"><span class="required">*</span> işaretli alanlar boş bırakılamaz.</p>
	<?php echo $form->textFieldRow($model,'lang_id',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'reference_id',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'reference_table',array('class'=>'span5','maxlength'=>100)); ?>

	<?php echo $form->textFieldRow($model,'reference_field',array('class'=>'span5','maxlength'=>100)); ?>

	<?php echo $form->textAreaRow($model,'value',array('rows'=>2, 'cols'=>30, 'class'=>'span8')); ?>

	<?php echo $form->textFieldRow($model,'original_value',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textAreaRow($model,'original_text',array('rows'=>2, 'cols'=>30, 'class'=>'span8')); ?>

	<?php echo $form->textFieldRow($model,'modified',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'modified_by',array('class'=>'span5','maxlength'=>11)); ?>

	<?php echo $form->toggleButtonRow($model, 'is_published'); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Ekle' : 'Kaydet',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
