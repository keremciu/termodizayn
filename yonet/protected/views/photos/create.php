<?php
$this->breadcrumbs=array(
	'Fotoğraflar'=>array('index'),
	'Fotoğraf Ekle',
);

	$this->renderPartial('/layouts/nolanguage');
?>
<div class="main-area col-md-12 main-content main-content--full">
	<div class="form-section">
<?php 

	$form=$this->beginWidget('booster.widgets.TbActiveForm',array(
		'id'=>$model->tableName().'-form',
		'enableAjaxValidation'=>false,
		'htmlOptions'=>array('class'=>'form-section_content', 'enctype'=>'multipart/form-data'),
	));

	echo $this->renderPartial('_form', array('model'=>$model,'form'=>$form,'galleries'=>$galleries,'orderinglist'=>$orderinglist)); 

?>
	<div class="form-actions">
		<?php $this->widget('booster.widgets.TbButton', array(
			'buttonType'=>'submit',
			'encodeLabel'=>false,
			'htmlOptions'=>array(
				'data-form'=>$model->tableName().'-form'
			),
			'context' => 'success',
			'label'=> '<svg class="td-icon td-icon-done"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-done"></use></svg> Fotoğraf Ekle'
		)); ?>
	</div>
<?php
	$this->endWidget();
?>
	</div>
</div>