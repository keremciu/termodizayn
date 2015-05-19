<?php
$this->breadcrumbs=array('Aşamalar'=>array('index'),'CV Aşama Listesi');

$gallerydata = CHtml::listData(Gallery::model()->findAll(array('order' => 'id')),'id','name');
$criteria=new CDbCriteria;
$criteria->select='max(ordering) AS ordering';		
$row = $model->find($criteria); 	
$lastorder = $row['ordering']+1;
$categories = Timeline_cat::model()->findAll();

$categorylinks=new Timeline_cat('search');
$categorylinks->unsetAttributes(); 
?>
<h1>CV Aşama Listesi</h1>
<div class="bootstrap-widget">
	<div class="bootstrap-widget-header"><i class="icon-camera"></i><h3>Galeri fotoğrafları yönetme aparatı</h3></div>
	<div class="bootstrap-widget-content" id="yw1">
<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'timeline-form',
	'enableAjaxValidation'=>false,
	'action' => Yii::app()->createUrl('timeline/create'),
	'htmlOptions'=>array('class'=>'well quickadd', 'enctype'=>'multipart/form-data'),
)); ?>	
		<?php echo $form->dropDownListRow($model, 'cat_id', CHtml::listData($categories,'id','title'), array('empty'=>'Kategori', 'class'=>'span1')); ?>
		<?php echo $form->textFieldRow($model,'title',array('class'=>'span2','maxlength'=>255)); ?>
		<?php echo $form->textFieldRow($model,'info',array('class'=>'span1','maxlength'=>255)); ?>
		<?php echo $form->textFieldRow($model,'date',array('class'=>'span1')); ?>
		<?php echo $form->textFieldRow($model,'detail',array('class'=>'span2','maxlength'=>255)); ?>
		<?php echo $form->hiddenField($model,'ordering',array('value'=>$lastorder)); ?>
		<?php echo $form->hiddenField($model,'active',array('value'=>1)); ?>
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>'Aşama Ekle',
		)); ?>
<?php $this->endWidget(); ?>
<h5 style="margin-bottom:0;line-height:1">CV Aşamaları</h5>
<?php

	$this->widget('bootstrap.widgets.TbExtendedGridView', array(
		'type'=>'striped bordered',
		'dataProvider' => $model->search(),
		'filter' => $model,
		'sortableRows'=>true,
		'summaryText' => '',
		'sortableAttribute'=>'ordering',	
		'sortableAjaxSave'=>true,
		'sortableAction'=>'timeline/sortable',
	    'afterSortableUpdate' => 'js:function(id, position){window.location.reload()}',
		'columns'=>array(
			array(
			    'header' => 'Sıralama',
			    'value' => '$data->ordering',
			    'id' => 'ordering_id',
			),
			array( 'name'=>'category_search', 'value'=>'$data->category0->title'),
			'title',
			'detail',
			'info',
			'date',
        	array(
            	'class'=>'bootstrap.widgets.TbToggleColumn',
            	'toggleAction'=>'timeline/toggle',
            	'name' => 'active',
            	'header' => 'Yayında'
        	),
			array(
				'class'=>'bootstrap.widgets.TbButtonColumn',
			),
		),
	));	
?>

		<a href="<?php echo Yii::app()->createUrl('/timeline_cat/create'); ?>" class="btn btn-info">Aşama Kategorisi Ekle</a>
		<a href="<?php echo Yii::app()->createUrl('/timeline/create'); ?>" class="btn btn-info">Detaylı Aşama Ekle</a>
	<div class="clearfix">
	<h5 style="margin-top:30px;margin-bottom:0;line-height:1">CV Aşama Kategorileri</h5>
	<div class="span5">
	<?php 
	$this->widget('bootstrap.widgets.TbExtendedGridView', array(
		'type'=>'striped bordered',
		'dataProvider' => $categorylinks->search(),
		'filter' => $categorylinks,
		'sortableRows'=>true,
		'summaryText' => '',
		'sortableAttribute'=>'ordering',	
		'sortableAjaxSave'=>true,
		'sortableAction'=>'timeline_cat/sortable',
	    'afterSortableUpdate' => 'js:function(id, position){window.location.reload()}',
		'columns'=>array(
			array(
			    'header' => 'Sıralama',
			    'value' => '$data->ordering',
			    'id' => 'ordering_id',
			),
			'title',
        	array(
            	'class'=>'bootstrap.widgets.TbToggleColumn',
            	'toggleAction'=>'timeline_cat/toggle',
            	'name' => 'active',
            	'header' => 'Yayında'
        	),
			array(
				'class'=>'bootstrap.widgets.TbButtonColumn',
				'viewButtonUrl'=>'Yii::app()->createUrl(\'timeline_cat/view&id=\'. $data->id)',
          		'updateButtonUrl'=>'Yii::app()->createUrl(\'timeline_cat/update&id=\'. $data->id)',
          		'deleteButtonUrl'=>'Yii::app()->createUrl(\'timeline_cat/delete&id=\'. $data->id)',
			),
		),
	));	
	?>
</div>
</div>