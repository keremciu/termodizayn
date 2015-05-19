<?php
$this->breadcrumbs=array('Fotoğraflar'=>array('index'),'Fotoğraf Listesi');
$gallerydata = CHtml::listData(Gallery::model()->findAll(array('order' => 'id')),'id','name');
$criteria=new CDbCriteria;
$criteria->select='max(ordering) AS ordering';		
$row = $model->find($criteria); 	
$lastorder = $row['ordering']+1;
?>
<h1>Fotoğraf Listesi</h1>

<div class="bootstrap-widget">
	<div class="bootstrap-widget-header"><i class="icon-camera"></i><h3>Galeri fotoğrafları yönetme aparatı</h3></div>
	<div class="bootstrap-widget-content" id="yw1">
<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'photo-form',
	'enableAjaxValidation'=>false,
	'action' => Yii::app()->createUrl('photos/create'),
	'htmlOptions'=>array('class'=>'well quickadd', 'enctype'=>'multipart/form-data'),
)); ?>	
		<?php echo $form->textFieldRow($model,'name',array('class'=>'span2','maxlength'=>255)); ?>
		<?php echo $form->fileFieldRow($model,'image',array('class'=>'span2','maxlength'=>255)); ?>
		<?php echo $form->dropDownListRow($model, 'gallery', $gallerydata, array('empty'=>'Lütfen bir galeri seçiniz', 'class'=>'span3')); ?>
		<?php echo $form->hiddenField($model,'ordering',array('value'=>$lastorder)); ?>
		<?php echo $form->hiddenField($model,'is_published',array('value'=>1)); ?>
		<?php echo $form->hiddenField($model,'photo',array('value'=>0)); ?>
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>'Fotoğraf Ekle',
		)); ?>
		<a href="<?php echo Yii::app()->createUrl('/photos/create'); ?>" class="btn btn-info">Detaylı Fotoğraf Ekle</a>
<?php $this->endWidget(); ?>

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
	'htmlOptions'=>array('class'=>'well quickadd', 'enctype'=>'multipart/form-data'),
)); ?>

	<?php echo $form->dropDownListRow($model, 'gallery', $gallerydata, array('empty'=>'Lütfen bir galeri seçiniz', 'class'=>'span3')); ?>

		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType' => 'submit',
			'type'=>'primary',
			'label'=>'Filtrele',
		)); ?>

<?php $this->endWidget(); ?>
<?php
	$this->widget('bootstrap.widgets.TbExtendedGridView',array(
		'id'=>'photos-grid',
		'dataProvider'=>$model->search(),
		'sortableRows'=>true,
		'sortableAttribute'=>'ordering',	
		'sortableAjaxSave'=>true,
		'sortableAction'=>'photos/sortable',
	    'afterSortableUpdate' => 'js:function(id, position){window.location.reload()}',
		'columns'=>array_merge(array(array('class'=>'bootstrap.widgets.TbImageColumn','header'=>'Fotoğraf','imageOptions'=>array('width'=>50),'imagePathExpression'=>'Yii::app()->baseUrl."/../images/photos/"'.'.$data->photo','usePlaceKitten'=>FALSE)),array(
			'name',
			array( 'name'=>'gallery_search', 'value'=>'$data->gallery0->name'),
			array(
			    'header' => 'Sıralama',
			    'value' => '$data->ordering',
			    'id' => 'ordering_id',
			),
			'id',
			'url',
			
			/*
			'url',
			'is_published',
			*/
			array(
				'class'=>'bootstrap.widgets.TbButtonColumn',
			),
		)),
)); ?>
</div></div>