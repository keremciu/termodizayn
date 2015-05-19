<?php
$this->breadcrumbs=array(
	'Totelephones'=>array('index'),
	$model->name,
);
?>

<h1>Detaylı Görüntüle</h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'email',
		'telephone',
		'inform',
		'subscribe',
		'active',
	),
)); ?>
