<?php
$this->breadcrumbs=array(
	'İçerikler'=>array('index'),
	'İçerik Ekle',
);

	$this->renderPartial('/layouts/nolanguage');
?>
<div class="main-area col-md-12 main-content main-content--full">
	<div class="form-section">
		<h1 class="form-section_title">GENEL BİLGİLER</h1>
<?php 

$form=$this->beginWidget('booster.widgets.TbActiveForm',array(
	'id'=>$model->tableName().'-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array('class'=>'form-section_content', 'enctype'=>'multipart/form-data'),
));

	echo $this->renderPartial('_form', array('model'=>$model,'form'=>$form,'orderinglist'=>$orderinglist,'categories'=>$categories)); 
?>
	<div class="form-actions">
		<?php $this->widget('booster.widgets.TbButton', array(
			'buttonType'=>'submit',
			'encodeLabel'=>false,
			'context'=>'success',
			'htmlOptions'=>array(
				'data-form'=>$model->tableName().'-form'
			),
			'label'=> '<svg class="td-icon td-icon-done"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-done"></use></svg> Haberi Ekle'
		)); ?>
	</div>
<?php
$this->endWidget();
?>