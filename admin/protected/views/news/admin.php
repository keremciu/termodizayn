<?php
$this->pageTitle=Yii::app()->name . ' - İçerik Listesi';
$this->breadcrumbs=array('İçerikler'=>array('index'),'İçerik Listesi');

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.filters').toggle();
	return false;
});");
?>
<?php

	echo CHtml::link('<div class="icon icon-search icon-white"></div> Detaylı Arama','#',array('class'=>'search-button btn btn-info')); 

	$this->widget('bootstrap.widgets.TbExtendedGridView', array(
		'dataProvider' => $model->search(),
		'filter' => $model,
		'htmlOptions'=>array('class'=>'dataTable table table-hover no-footer'),
		'sortableRows'=>true,
		'sortableAttribute'=>'ordering',	
		'sortableAjaxSave'=>true,
		'sortableAction'=>'news/sortable',
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
			'title',
			array(
				'name'=>'description',
				'htmlOptions'=>array('class'=>'tabledesc')
			),
			array( 'name'=>'category_search', 'value'=>'$data->category0->title'),
        	array(
            	'class'=>'bootstrap.widgets.TbToggleColumn',
            	'toggleAction'=>'news/toggle',
            	'name' => 'is_published',
            	'header' => 'Yayında'
        	),
			array(
				'class'=>'bootstrap.widgets.TbButtonColumn',
				'updateButtonUrl' => 'Yii::app()->controller->createUrl("update",array("category"=>$data->category0->slug,"id"=>$data->primaryKey))',
			),
			
		),
	));	
?>