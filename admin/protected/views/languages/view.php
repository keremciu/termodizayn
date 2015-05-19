<?php
$this->breadcrumbs=array(
	'Languages'=>array('index'),
	$model->name,
);
?>

<h1>Detaylı Görüntüle</h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'active',
		'code',
		'shortcode',
		'image',
		'params',
		'ordering',
	),
)); ?>
