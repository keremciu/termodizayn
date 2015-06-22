<?php
$this->breadcrumbs=array(
	'Chats',
);
?>

<h1>Chats</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
