<?php
$this->breadcrumbs=array(
	'Fotoğraflar'=>array('index'),
	'Fotoğraf Ekle',
);
?>

<h1>Fotoğraf Ekle</h1>

<?php 

$form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'news-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array('class'=>'well', 'enctype'=>'multipart/form-data'),
));

echo $this->renderPartial('_form', array('model'=>$model,'form'=>$form)); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Fotoğraf Ekle' : 'Fotoğrafı Kaydet',
		)); ?>
	</div>
<?php
$this->endWidget();
?>