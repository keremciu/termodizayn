<?php
$this->breadcrumbs=array(
	'Offers',
);

$this->menu=array(
array('label'=>'Create Offer','url'=>array('create')),
array('label'=>'Manage Offer','url'=>array('admin')),
);
?>

<h1>Offers</h1>

<?php $this->widget('booster.widgets.TbListView',array(
'dataProvider'=>$dataProvider,
'itemView'=>'_view',
)); ?>
