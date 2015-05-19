<?php 

$this->widget('bootstrap.widgets.TbExtendedGridView',array(
	'id'=>'data-grid',
	'type'=>'striped bordered',
	'summaryText'=>'',
	'dataProvider'=>$model->search(),
		'filter' => $model,
		'sortableRows'=>true,
		'sortableAttribute'=>'ordering',	
		'sortableAjaxSave'=>true,
		'sortableAction'=>'menu/sortable',
	    'afterSortableUpdate' => 'js:function(id, position){window.location.reload()}',
	'columns'=>array(

			array(
			    'header' => 'Sıralama',
			    'value' => '$data->ordering',
			    'id' => 'ordering_id',
			),
		'name',
		'alias',
		'type',
		'menutype',
		'alias',
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	)
)); 


?>