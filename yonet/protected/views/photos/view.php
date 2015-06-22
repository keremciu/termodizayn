<?php
$this->breadcrumbs=array(
	'Fotoğraflar'=>array('index'),
	$model->name,
);
?>

<h1>Detaylı Görüntüle</h1>

<?php $this->widget('booster.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'desc',
		'photo',
		'min_photo',
		'gallery',
		'url',
		'is_published',
	),
)); ?>
