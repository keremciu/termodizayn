<?php
$this->breadcrumbs=array(
	'Haberler',
);
?>

<h1>Haberler</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
