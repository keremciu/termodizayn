<?php
$this->breadcrumbs=array('Ayarlar'=>array('index'),'Genel Ayarlar')
?>
<h1>Genel Ayarlar</h1>

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'settings-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array('class'=>'well'),
)); ?>
<?php 
	foreach ($model as $item) {
?>
	<?php echo $form->textFieldRow($model,'key',array('class'=>'span5','maxlength'=>255)); ?>
<?php
}
?>
<?php $this->endWidget(); ?>
<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'settings-grid',
	'dataProvider'=>$model->search(),
	'columns'=>array(
		'id',
		'category',
		'key',
		'value',
		'cache',
		'active',
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>
