<?php
$this->breadcrumbs=array(
	'CV Aşamaları'=>array('index'),
	'CV Aşaması Ekle',
);
?>

<h1>CV Aşaması Ekle</h1>

<?php 

$form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'timeline-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array('class'=>'well', 'enctype'=>'multipart/form-data'),
));

echo $this->renderPartial('_form', array('model'=>$model,'form'=>$form)); 
?>
	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Aşama Ekle' : 'Aşamayı Kaydet',
		)); ?>
	</div>
<?php
$this->endWidget();
?>