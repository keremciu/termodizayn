<?php
$this->breadcrumbs=array(
	'Timelines',
);
?>

<h1>Timelines</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
