<?php
$this->breadcrumbs=array(
	'Settings'=>array('index'),
	$model->id,
);
?>

<h1>Detaylı Görüntüle</h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'category',
		'key',
		'value',
		'cache',
		'active',
	),
)); ?>
