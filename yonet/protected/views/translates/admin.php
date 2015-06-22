<?php
$this->breadcrumbs=array('Çeviriler'=>array('index'),'Çeviri Listesi')
?>
<h1>Çeviri Listesi</h1>
<a href="<?php echo Yii::app()->createUrl('/translates/create'); ?>" class="btn btn-primary">Çeviri Ekle</a>

<?php $this->widget('booster.widgets.TbGridView',array(
	'id'=>'translates-grid',
	'dataProvider'=>$model->search(),
	'columns'=>array(
		'id',
		'lang_id',
		'reference_id',
		'reference_table',
		'reference_field',
		'value',
		/*
		'original_value',
		'original_text',
		'modified',
		'modified_by',
		'is_published',
		*/
		array(
			'class'=>'booster.widgets.TbButtonColumn',
		),
	),
)); ?>
