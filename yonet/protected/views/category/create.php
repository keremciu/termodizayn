<?php
	$this->renderPartial('/layouts/nolanguage');
?>
<div class="main-area col-md-12 main-content main-content--full">
	<div class="form-section">
<?php
	// form area
	$form=$this->beginWidget('booster.widgets.TbActiveForm',array(
		'id'=>$model->tableName().'-form',
		'enableAjaxValidation'=>false,
		'htmlOptions'=>array('class'=>'', 'enctype'=>'multipart/form-data'),
	));

	// get main form inputs
	$this->renderPartial('_form', array('model'=>$model,'form'=>$form,'type'=>$type));
?>
	<div class="form-actions">
		<?php $this->widget('booster.widgets.TbButton', array(
			'buttonType'=>'submit',
			'context'=>'success',
			'encodeLabel'=>false,
			'htmlOptions'=>array(
				'data-form'=>$model->tableName().'-form'
			),
			'label'=> '<svg class="td-icon td-icon-done"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-done"></use></svg> Kategori Ekle'
		)); ?>
	</div>
<?php
$this->endWidget();
?>