<?php
$this->breadcrumbs=array(
	'Menüler'=>array('index'),
	'Menü Ekle',
);
?>

<h1>Menü Ekle</h1>

<?php 

$form=$this->beginWidget('booster.widgets.TbActiveForm',array(
	'id'=>'menu-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array('class'=>'well', 'enctype'=>'multipart/form-data'),
));

echo $this->renderPartial('_form', array('model'=>$model,'form'=>$form));
?>
	<div class="form-actions">
		<?php $this->widget('booster.widgets.TbButton', array(
			'buttonType'=>'submit',
			'context'=>'primary',
			'label'=>$model->isNewRecord ? 'Menü Ekle' : 'Menüyü Kaydet',
		)); ?>
	</div>
<?php
$this->endWidget();

?>