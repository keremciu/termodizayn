<?php
$this->breadcrumbs=array(
	'Offers'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

	$this->menu=array(
	array('label'=>'List Offer','url'=>array('index')),
	array('label'=>'Create Offer','url'=>array('create')),
	array('label'=>'View Offer','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage Offer','url'=>array('admin')),
	);
	?>

	<h1>Update Offer <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>