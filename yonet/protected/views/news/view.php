<?php
$this->breadcrumbs=array(
	'Haberler'=>array('index'),
	$model->title,
);
?>

<h1>Detaylı Görüntüle</h1>

<?php $this->widget('booster.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'title',
		'slug',
		'description',
		'content',
		'image',
		'category',
		'author_id',
		'date',
		'create_data',
		'is_published',
		'is_deleted',
	),
)); ?>
