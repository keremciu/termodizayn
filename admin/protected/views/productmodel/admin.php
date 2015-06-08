<?php
$this->breadcrumbs=array('Ürün Modelleri'=>array('index'),'Ürün Model Listesi')
?>
<h1>Ürün Model Listesi</h1>

<a href="<?php echo Yii::app()->createUrl('/productmodel/create'); ?>" class="btn btn-primary">Yeni Ürün Modeli Ekle</a>

<?php

	$this->widget('bootstrap.widgets.TbExtendedGridView', array(
		'type'=>'striped bordered',
		'dataProvider' => $model->search(),
		'filter' => $model,
		'sortableRows'=>true,
		'sortableAttribute'=>'ordering',	
		'sortableAjaxSave'=>true,
		'sortableAction'=>'productmodel/sortable',
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
			'name',
			array( 'name'=>'product_search', 'value'=>'$data->product0->title'),
        	array(
            	'class'=>'bootstrap.widgets.TbToggleColumn',
            	'toggleAction'=>'productmodel/toggle',
            	'name' => 'is_published',
            	'header' => 'Yayında'
        	),
			array(
				'class'=>'bootstrap.widgets.TbButtonColumn',
			),
		),
	));	
