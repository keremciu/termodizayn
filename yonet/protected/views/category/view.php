<?php
$this->breadcrumbs=array(
	'Kategoriler'=>array('index'),
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
		'image',
		'icon',
		'is_published',
		'is_deleted',
	),
)); ?>
