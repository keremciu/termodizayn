<?php
$this->pageTitle=Yii::app()->name . ' - Menü Listesi';
$this->breadcrumbs=array('Menüler'=>array('index'),'Menü Listesi')

?>
<h1>Menü Listesi</h1>
<a href="<?php echo Yii::app()->createUrl('/menu/create'); ?>" class="btn btn-primary">Menü Ekle</a>

<?php echo CHtml::link('Detaylı Arama','#',array('class'=>'search-button')); ?>

<?php 

$menutypes = Menutypes::model()->findAll();
$val = $model->menutype;
$form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array('action'=>Yii::app()->createUrl($this->route),'method'=>'get',)); 
?>
	<div class="btn-group btn-raddip" style="margin-top:20px">
		<?php if (count($menutypes) > 1) { 
				foreach ($menutypes as $menutype) { ?>
		<label for="filtermenu<?php echo $menutype->menutype; ?>" class="<?php if ($val==$menutype->menutype) { echo "active "; } ?>btn btn-small"><strong><?php echo $menutype->title; ?></strong> menü öğeleri</label>';
		<input id="filtermenu<?php echo $menutype->menutype; ?>" type="submit" value="<?php echo $menutype->menutype; ?>" name="Menu[menutype]" style="display:none"/>';
		<?php 
				}
			  } 
		?>
	</div>
<?php
 	$this->endWidget();

	$this->widget('bootstrap.widgets.TbExtendedGridView', array(
		'type'=>'striped bordered',
		'dataProvider' => $model->search(),
		'filter' => $model,
		'sortableRows'=>true,
		'sortableAttribute'=>'ordering',
		'sortableAjaxSave'=>true,
		'sortableAction'=>'menu/sortable',
	    'afterSortableUpdate' => 'js:function(id, position){window.location.reload()}',
		'columns'=>array(
			array(
	            'class'=>'bootstrap.widgets.TbRelationalColumn',
	            'name' => 'parent',
				'url' => $this->createUrl('menu/relational'),
	            'value'=> '"alt menülerini getir"',
			),
			array(
			    'header' => 'Sıralama',
			    'value' => '$data->ordering',
			    'id' => 'ordering_id',
			),
			'name',
			'alias',
			'type',
			'menutype',
			array(
            	'class'=>'bootstrap.widgets.TbToggleColumn',
            	'toggleAction'=>'menu/toggle',
            	'name' => 'is_home',
            	'header' => 'Anasayfa'
        	),
        	array(
            	'class'=>'bootstrap.widgets.TbToggleColumn',
            	'toggleAction'=>'menu/toggle',
            	'name' => 'is_published',
            	'header' => 'Yayında'
        	),
			array(
				'class'=>'bootstrap.widgets.TbButtonColumn',
			),
		),
	));	
?>
