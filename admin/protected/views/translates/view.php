<?php
$this->breadcrumbs=array(
	'Translates'=>array('index'),
	$model->id,
);
?>

<h1>Detaylı Görüntüle</h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'lang_id',
		'reference_id',
		'reference_table',
		'reference_field',
		'value',
		'original_value',
		'original_text',
		'modified',
		'modified_by',
		'is_published',
	),
)); ?>
