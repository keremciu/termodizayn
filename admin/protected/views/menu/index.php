<?php
$this->breadcrumbs=array(
	'Menüler',
);
?>

<h1>Menüler</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
