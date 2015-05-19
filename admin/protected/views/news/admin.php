<?php
$this->pageTitle=Yii::app()->name . ' - İçerik Listesi';
$this->breadcrumbs=array('İçerikler'=>array('index'),'İçerik Listesi');

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.filters').toggle();
	return false;
});");
?>
<h1>İçerik Listesi</h1>
<a href="<?php echo Yii::app()->createUrl('/news/create'); ?>" class="btn btn-primary">İçerik Ekle</a>

<?php echo CHtml::link('Detaylı Arama','#',array('class'=>'search-button')); ?>
<?php

	$this->widget('bootstrap.widgets.TbExtendedGridView', array(
		'type'=>'striped bordered',
		'dataProvider' => $model->search(),
		'filter' => $model,
		'sortableRows'=>true,
		'sortableAttribute'=>'ordering',	
		'sortableAjaxSave'=>true,
		'sortableAction'=>'news/sortable',
	    'afterSortableUpdate' => 'js:function(id, position){window.location.reload()}',
		'columns'=>array(
			array(
			    'header' => 'Sıralama',
			    'value' => '$data->ordering',
			    'id' => 'ordering_id',
			),
			array(
			    'header' => 'Kimlik',
			    'value' => '$data->id',
			    'id' => 'news_id',
			),
			'title',
			'description',
			array( 'name'=>'category_search', 'value'=>'$data->category0->title'),
        	array(
            	'class'=>'bootstrap.widgets.TbToggleColumn',
            	'toggleAction'=>'news/toggle',
            	'name' => 'is_published',
            	'header' => 'Yayında'
        	),
			array(
				'class'=>'bootstrap.widgets.TbButtonColumn',
			),
		),
	));	
?>