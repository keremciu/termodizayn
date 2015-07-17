<?php 

$this->widget('booster.widgets.TbExtendedGridView',array(
	'id'=>'data-grid',
	'summaryText'=>'',
	'dataProvider'=>$model->search(),
		'sortableRows'=>true,
		'sortableAttribute'=>'ordering',	
		'sortableAjaxSave'=>true,
		'sortableAction'=>'menu/sortable',
	    'afterSortableUpdate' => 'js:function(id, position){window.location.reload()}',
	'columns'=>array(

		'name',
		'alias',
		'type',
		'menutype',
		'alias',
		array(
			'class'=>'booster.widgets.TbButtonColumn',
		),
	)
)); 


?>