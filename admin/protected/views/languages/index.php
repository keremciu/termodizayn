<?php
$this->breadcrumbs=array(
	'Languages',
);
?>

<h1>Languages</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
