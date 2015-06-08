<?php
$this->breadcrumbs=array(
	'Product Models'=>array('index'),
	$model->name,
);
?>

<h1>Detaylı Görüntüle</h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'product',
		'name',
		'slug',
		'price',
		'content',
		'image',
		'ordering',
		'create_date',
		'is_published',
	),
)); ?>
