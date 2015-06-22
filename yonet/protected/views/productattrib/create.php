<?php

	$this->renderPartial('/layouts/nolanguage');

	$form=$this->beginWidget('booster.widgets.TbActiveForm',array(
		'id'=>$model->tableName().'-form',
		'enableAjaxValidation'=>false,
	)); 
?>
<div class="main-area col-md-12 main-content main-content--full">
	<div class="form-section no-margin">
<?php 
 	echo $this->renderPartial('_form', array('model'=>$model, 'form'=>$form));
 ?>
<div class="form-actions">
	<?php $this->widget('booster.widgets.TbButton', array(
			'buttonType'=>'submit',
			'encodeLabel'=>false,
			'context'=>'success',
			'htmlOptions'=>array(
				'data-form'=>$model->tableName().'-form'
			),
			'label'=> '<svg class="td-icon td-icon-done"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-done"></use></svg> Ozellik Ekle'
		)); ?>
</div>

<?php $this->endWidget(); ?>