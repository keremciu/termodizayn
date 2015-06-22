<?php

	$this->widget('booster.widgets.TbExtendedGridView', array(
		'dataProvider' => $model->search(),
		'sortableRows'=>true,
		'sortableAttribute'=>'ordering',	
		'sortableAjaxSave'=>true,
		'sortableAction'=>'productmodel/sortable',
	    'afterSortableUpdate' => 'js:function(id, position){window.location.reload()}',
		'columns'=>array(
			array(
				// column title
				'name'=>'ordering_search',
				// column html encode
				'type'=>'raw',
				// column value
				'value'=>
				function($data) {
					return '<div class="sortable-button sortable-button_drag">
					<div class="sortable-count badge">'.$data->ordering.'</div>
					<svg class="td-icon td-icon-swap-vert">
						<use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-swap-vert"></use>
					</svg>
					</div>';
				},
				// column id
				'id'=>'ordering_id'
			),
			'name',
			array( 'name'=>'product_search', 'value'=>'$data->modelproduct->title'),
        	array(
            	'class'=>'booster.widgets.TbToggleColumn',
            	'toggleAction'=>'productmodel/toggle',
            	'name' => 'is_published',
            	'header' => 'Yayında'
        	),
			array(
				'class'=>'booster.widgets.TbButtonColumn',
			),
		),
	));	
