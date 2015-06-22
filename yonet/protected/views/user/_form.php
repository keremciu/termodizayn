<?php $form=$this->beginWidget('booster.widgets.TbActiveForm',array(
	'id'=>'user-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array('class'=>'form-section_content'),
)); ?>

	<?php echo $form->textFieldRow($model,'username',array('class'=>'form-control','maxlength'=>30)); ?>

	<?php echo $form->textFieldRow($model,'name',array('class'=>'form-control','maxlength'=>30)); ?>

	<?php echo $form->textFieldRow($model,'lastname',array('class'=>'form-control','maxlength'=>30)); ?>

	<?php echo $form->textFieldRow($model,'email',array('class'=>'form-control','maxlength'=>75)); ?>

	<?php echo $form->passwordFieldRow($model,'password',array('class'=>'form-control','maxlength'=>40)); ?>

	<?php echo $form->dropDownListGroup($model, 'role',
			array(
				'widgetOptions' => array(
					'data' => array('admin'=>'Baş Yönetici','dealer'=>'Bayi','normal'=>'Standart'),
				)
			));
	?>

	<?php echo $form->toggleButtonRow($model, 'active', array('class'=>'form-control')); ?>

	<p class="help-block"><span class="required">*</span> işaretli alanlar boş bırakılamaz.</p>

	<div class="form-actions">
		<?php $this->widget('booster.widgets.TbButton', array(
			'buttonType'=>'submit',
			'context'=>'success',
			'encodeLabel'=>false,
			'htmlOptions'=>array(
				'data-form'=>$model->tableName().'-form'
			),
			'label'=> '<svg class="td-icon td-icon-done"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-done"></use></svg> Üye Ekle'
		)); ?>
	</div>

<?php $this->endWidget(); ?>
