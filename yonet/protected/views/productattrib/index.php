<?php
$this->breadcrumbs=array(
	'Product Attribs',
);

$this->menu=array(
array('label'=>'Create ProductAttrib','url'=>array('create')),
array('label'=>'Manage ProductAttrib','url'=>array('admin')),
);
?>

<h1>Product Attribs</h1>

<?php $this->widget('booster.widgets.TbListView',array(
'dataProvider'=>$dataProvider,
'itemView'=>'_view',
)); ?>
