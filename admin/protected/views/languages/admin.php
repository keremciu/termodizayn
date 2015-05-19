<?php
$this->breadcrumbs=array('Diller'=>array('index'),'Dil Listesi')
?>
<h1>Dil Listesi</h1>

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'languages-grid',
	'dataProvider'=>$model->search(),
	'columns'=>array(
		'id',
		'name',
		'active',
		'code',
		'shortcode',
		'image',
		/*
		'params',
		'ordering',
		*/
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>
