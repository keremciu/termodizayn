<?php
$this->breadcrumbs=array(
	'Menüler'=>array('index'),
	$model->name,
);
?>

<h1>Detaylı Görüntüle</h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'menutype',
		'name',
		'alias',
		'link',
		'type',
		'types_id',
		'ordering',
		'parent',
		'is_home',
		'is_published',
	),
)); ?>
