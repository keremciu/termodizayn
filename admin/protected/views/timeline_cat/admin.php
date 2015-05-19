<?php
$this->breadcrumbs=array('Timeline Cats'=>array('index'),'Timeline Cat Listesi')
?>
<h1>Timeline Cat Listesi</h1>

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'timeline-cat-grid',
	'dataProvider'=>$model->search(),
	'columns'=>array(
		'id',
		'title',
		'info',
		'ordering',
		'active',
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>
