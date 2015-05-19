<?php
$this->breadcrumbs=array(
	'Products'=>array('index'),
	$model->title,
);
?>

<h1>Detaylı Görüntüle</h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'title',
		'slug',
		'description',
		'content',
		'image',
		'category',
		'create_data',
		'ordering',
		'hits',
		'featured',
		'is_published',
		'is_deleted',
	),
)); ?>
