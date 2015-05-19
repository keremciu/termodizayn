<?php
$this->breadcrumbs=array(
	'Fotoğraflar',
);
?>

<h1>Fotoğraflar</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
