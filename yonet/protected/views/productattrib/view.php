<?php
$this->breadcrumbs=array(
	'Product Attribs'=>array('index'),
	$model->title,
);

$this->menu=array(
array('label'=>'List ProductAttrib','url'=>array('index')),
array('label'=>'Create ProductAttrib','url'=>array('create')),
array('label'=>'Update ProductAttrib','url'=>array('update','id'=>$model->id)),
array('label'=>'Delete ProductAttrib','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
array('label'=>'Manage ProductAttrib','url'=>array('admin')),
);
?>

<h1>View ProductAttrib #<?php echo $model->id; ?></h1>

<?php $this->widget('booster.widgets.TbDetailView',array(
'data'=>$model,
'attributes'=>array(
		'id',
		'prefix',
		'title',
		'ordering',
		'container',
		'is_published',
),
)); ?>
