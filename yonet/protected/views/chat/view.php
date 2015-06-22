<?php
$this->breadcrumbs=array(
	'Chats'=>array('index'),
	$model->id,
);
?>

<h1>Detaylı Görüntüle</h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'user',
		'message',
		'datime',
	),
)); ?>
