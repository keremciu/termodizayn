<?php
$this->breadcrumbs=array(
	'Product Models',
);
?>

<h1>Product Models</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
