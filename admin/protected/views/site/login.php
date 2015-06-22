<?php

$this->pageTitle=Yii::app()->name . ' - Giriş Yap';

?>
<div class="login_form_content">
<h1>Giriş yap</h1>
<div class="form">
<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'login-form',
	'type'=>'vertical',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
	'htmlOptions'=>array('class'=>''),
)); ?>

	<?php echo $form->textFieldRow($model, 'username', array('class'=>'span3')); ?>

	<?php echo $form->passwordFieldRow($model, 'password', array('class'=>'span3')); ?>

	<?php echo $form->checkBoxRow($model, 'rememberMe'); ?>

	<?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'primary', 'label'=>'Giriş')); ?>

<?php $this->endWidget(); ?>
</div><!-- form -->
</div><!-- login_form_content -->