<?php
$this->breadcrumbs=array(
	'Galeriler',
);
?>

<h1>Galeriler</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
