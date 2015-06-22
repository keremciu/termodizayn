<?php
$this->breadcrumbs=array(
	'Offers'=>array('index'),
	$model->id,
);

$this->menu=array(
array('label'=>'List Offer','url'=>array('index')),
array('label'=>'Create Offer','url'=>array('create')),
array('label'=>'Update Offer','url'=>array('update','id'=>$model->id)),
array('label'=>'Delete Offer','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
array('label'=>'Manage Offer','url'=>array('admin')),
);
?>

<h1>View Offer #<?php echo $model->id; ?></h1>

<?php $this->widget('booster.widgets.TbDetailView',array(
'data'=>$model,
'attributes'=>array(
		'id',
		'language',
		'document_name',
		'invoice_no',
		'company',
		'reference',
		'author',
		'price',
		'stopage',
		'kdv',
		'shipping',
		'delivery_place',
		'packaged',
		'insurance',
		'installation',
		'payment_type',
		'delivery_time',
		'warranty',
		'create_date',
		'is_published',
),
)); ?>
