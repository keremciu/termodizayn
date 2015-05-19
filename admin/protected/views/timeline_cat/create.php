<?php
$this->breadcrumbs=array(
	'CV Aşama Kategorileri'=>array('index'),
	'CV Aşama Kategorisi Ekle',
);
?>

<h1>CV Aşama Kategorisi Ekle</h1>

<?php 

$form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'timeline_cat-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array('class'=>'well', 'enctype'=>'multipart/form-data'),
));

echo $this->renderPartial('_form', array('model'=>$model,'form'=>$form)); 
?>
	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Aşama Kategorisi Ekle' : 'Aşamayı Kategorisi Kaydet',
		)); ?>
	</div>
<?php
$this->endWidget();
?>