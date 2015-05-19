<?php
$this->breadcrumbs=array(
	'Settings',
);
?>

<h1>Settings</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
