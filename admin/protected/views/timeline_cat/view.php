<?php
$this->breadcrumbs=array(
	'Timeline Cats'=>array('index'),
	$model->title,
);
?>

<h1>Detaylı Görüntüle</h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'title',
		'info',
		'ordering',
		'active',
	),
)); ?>
