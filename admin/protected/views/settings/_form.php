<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'settings-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array('class'=>'well'),
)); ?>

	<?php echo $form->errorSummary($model); ?>
	<p class="help-block"><span class="required">*</span> işaretli alanlar boş bırakılamaz.</p>
	<?php echo $form->textFieldRow($model,'category',array('class'=>'span5','maxlength'=>64)); ?>

	<?php echo $form->textFieldRow($model,'key',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textAreaRow($model,'value',array('rows'=>2, 'cols'=>30, 'class'=>'span8')); ?>

	<?php echo $form->textFieldRow($model,'cache',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'active',array('class'=>'span5','maxlength'=>1)); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Ekle' : 'Kaydet',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
