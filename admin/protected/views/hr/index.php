<?php
$this->breadcrumbs=array(
	'Totelephones',
);
?>

<h1>Totelephones</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
