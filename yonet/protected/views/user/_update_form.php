<?php $form=$this->beginWidget('booster.widgets.TbActiveForm',array(
	'id'=>'user-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array('class'=>''),
)); ?>

	<?php echo $form->textFieldGroup($model,'username',array('class'=>'span5','maxlength'=>30)); ?>

	<?php echo $form->textFieldGroup($model,'name',array('class'=>'span5','maxlength'=>30)); ?>

	<?php echo $form->textFieldGroup($model,'lastname',array('class'=>'span5','maxlength'=>30)); ?>

	<?php echo $form->textFieldGroup($model,'email',array('class'=>'span5','maxlength'=>75)); ?>

	<?php echo $form->dropDownListGroup($model, 'role',
			array(
				'widgetOptions' => array(
					'data' => array('admin'=>'Baş Yönetici','dealer'=>'Bayi','normal'=>'Standart'),
				)
			));
	?>

	<p class="help-block"><span class="required">*</span> işaretli alanlar boş bırakılamaz.</p>

	<div class="form-actions">
		<?php $this->widget('booster.widgets.TbButton', array(
			'buttonType'=>'submit',
			'context'=>'primary',
			'encodeLabel'=>false,
			'htmlOptions'=>array(
				'data-form'=>$model->tableName().'-form'
			),
			'label'=> '<svg class="td-icon td-icon-done"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-done"></use></svg> Üye Kaydet'
		)); ?>
	</div>

<?php $this->endWidget(); ?>