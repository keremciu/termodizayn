<?php
$this->breadcrumbs=array('Galleriler'=>array('index'),'Galeri Listesi')
?>
<h1>Galeri Listesi</h1>

<a href="<?php echo Yii::app()->createUrl('/gallery/create'); ?>" class="btn btn-primary">Galeri Ekle</a>
<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'gallery-grid',
	'dataProvider'=>$model->search(),
	'columns'=>array(
		'id',
		'name',
		'slug',
		'icon',
		'is_published',
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>
