<?php
$this->breadcrumbs=array(
	'Companiler',
);

$this->menu=array(
array('label'=>'Create Company','url'=>array('create')),
array('label'=>'Manage Company','url'=>array('admin')),
);
?>

<h1>Companiler</h1>

<?php $this->widget('booster.widgets.TbListView',array(
'dataProvider'=>$dataProvider,
'itemView'=>'_view',
)); ?>
