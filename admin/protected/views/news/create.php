<?php
$this->breadcrumbs=array(
	'İçerikler'=>array('index'),
	'İçerik Ekle',
);

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
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Haber Ekle' : 'Haber Kaydet',
		)); ?>
	</div>
<?php
$this->endWidget();
?>