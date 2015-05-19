<?php
$this->breadcrumbs=array(
	'Timelines'=>array('index'),
	$model->title,
);
?>

<h1>Detaylı Görüntüle</h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'title',
		'desc',
		'info',
		'date',
		'ordering',
		'active',
	),
)); ?>
