<?php
$this->breadcrumbs=array(
	'Kategoriler',
);
?>

<h1>Kategoriler</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
