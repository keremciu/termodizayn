<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'languages-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array('class'=>'well'),
)); ?>

	<?php echo $form->errorSummary($model); ?>
	<p class="help-block"><span class="required">*</span> işaretli alanlar boş bırakılamaz.</p>
	<?php echo $form->textFieldRow($model,'name',array('class'=>'span5','maxlength'=>100)); ?>

	<?php echo $form->textFieldRow($model,'active',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'code',array('class'=>'span5','maxlength'=>20)); ?>

	<?php echo $form->textFieldRow($model,'shortcode',array('class'=>'span5','maxlength'=>20)); ?>

	<?php echo $form->fileFieldRow($model,'image',array('class'=>'span5','maxlength'=>100)); ?>

	<?php echo $form->textAreaRow($model,'params',array('rows'=>2, 'cols'=>30, 'class'=>'span8')); ?>

	<?php echo $form->textFieldRow($model,'ordering',array('class'=>'span5')); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Ekle' : 'Kaydet',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
