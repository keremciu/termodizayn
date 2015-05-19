<?php
$this->breadcrumbs=array(
	'Timeline Cats',
);
?>

<h1>Timeline Cats</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
