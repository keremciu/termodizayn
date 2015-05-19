<?php
$this->breadcrumbs=array(
	'Galeriler'=>array('index'),
	$model->name,
);
?>

<h1>Detaylı Görüntüle</h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'slug',
		'desc',
		'image',
		'icon',
		'is_published',
	),
)); ?>
