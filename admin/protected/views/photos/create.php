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

	$form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
		'id'=>'news-form',
		'enableAjaxValidation'=>false,
		'htmlOptions'=>array('class'=>'form-section_content', 'enctype'=>'multipart/form-data'),
	));

	echo $this->renderPartial('_form', array('model'=>$model,'form'=>$form)); 

?>
	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'success',
			'encodeLabel'=>false,
			'label'=>$model->isNewRecord ? '<svg class="td-icon td-icon-cloud-done"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-cloud-done"></use></svg> Fotoğraf Ekle' : 'Fotoğrafı Kaydet',
		)); ?>
	</div>
<?php
	$this->endWidget();
?>
	</div>
</div>