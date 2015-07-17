<div class="admin_content col-md-12 main-content main-content--full hide-action">
	<div class="table-area dataTables_wrapper no-footer">
<?php 

$menutypes = Menutypes::model()->findAll();
$val = $model->menutype;
$form=$this->beginWidget('booster.widgets.TbActiveForm',array('action'=>Yii::app()->createUrl($this->route),'method'=>'get',)); 
?>
	<div class="btn-group" style="margin-top:20px">
		<?php if (count($menutypes) > 1) { 
				foreach ($menutypes as $menutype) { ?>
		<label for="filtermenu<?php echo $menutype->menutype; ?>" class="<?php if ($val==$menutype->menutype) { echo "active "; } ?>btn btn-primary"><strong><?php echo $menutype->title; ?></strong> menü öğeleri</label>
		<input id="filtermenu<?php echo $menutype->menutype; ?>" type="submit" value="<?php echo $menutype->menutype; ?>" name="Menu[menutype]" style="display:none"/>
		<?php 
				}
			  } 
		?>
	</div>
<?php
 	$this->endWidget();

	$this->widget('booster.widgets.TbExtendedGridView', array(
		'dataProvider' => $model->search(),
		'sortableRows'=>true,
		'sortableAttribute'=>'ordering',
		'sortableAjaxSave'=>true,
		'sortableAction'=>'menu/sortable',
	    'afterSortableUpdate' => 'js:function(id, position){window.location.reload()}',
		'columns'=>array(
			array(
	            'class'=>'booster.widgets.TbRelationalColumn',
	            'name' => 'parent',
				'url' => $this->createUrl('menu/relational'),
	            'value'=> '"alt menülerini getir"',
			),
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
			'alias',
			'type',
			'menutype',
			array(
            	'class'=>'booster.widgets.TbToggleColumn',
            	'toggleAction'=>'menu/toggle',
            	'name' => 'is_home',
            	'header' => 'Anasayfa'
        	),
        	array(
            	'class'=>'booster.widgets.TbToggleColumn',
            	'toggleAction'=>'menu/toggle',
            	'name' => 'is_published',
            	'header' => 'Yayında'
        	),
			array(
				'class'=>'booster.widgets.TbButtonColumn',
				'template'=>'{update}{delete}',
			),
		),
	));	
?>
<div class="form-actions">
			<a href="<?php echo Yii::app()->createUrl('/menu/create'); ?>" class="btn btn-success" >
				<svg class="td-icon td-icon-add"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-add"></use></svg> Yeni Menü Ekle
			</a>
		</div>
</div>
</div>