<?php
$this->breadcrumbs=array('Kategoriler'=>array('index'),'Kategori Listesi');

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.filters').toggle();
	return false;
});");

if (isset($_GET["Category"]["type"])) {
	$type = $_GET["Category"]["type"];
} else {
	$type = "";
}
?>
<h1>Kategori Listesi</h1>
<a href="<?php echo Yii::app()->createUrl('/category/create'); ?>" class="btn btn-primary"><b class="icon icon-plus icon-white"></b> Kategori Ekle</a>

<?php echo CHtml::link('Detaylı Arama','#',array('class'=>'search-button')); ?>


<?php

	$this->widget('bootstrap.widgets.TbExtendedGridView', array(
		'type'=>'striped bordered',
		'dataProvider' => $model->search(),
		'filter' => $model,
		'sortableRows'=>true,
		'sortableAttribute'=>'ordering',	
		'sortableAjaxSave'=>true,
		'sortableAction'=>'category/sortable',
	    'afterSortableUpdate' => 'js:function(id, position){}',
		'columns'=>array(
			array(
			    'header' => 'Sıralama',
			    'value' => '$data->ordering',
			    'id' => 'ordering_id',
			),
			array(
			    'header' => 'Kimlik',
			    'value' => '$data->id',
			    'id' => 'product_id',
			),
			'parentname',
			'type',
        	array(
            	'class'=>'bootstrap.widgets.TbToggleColumn',
            	'toggleAction'=>'category/toggle',
            	'name' => 'is_published',
            	'header' => 'Yayında'
        	),
			array(
				'class'=>'bootstrap.widgets.TbButtonColumn',
			),
		),
	));	
?>