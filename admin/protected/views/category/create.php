<?php
$this->breadcrumbs=array(
	'Kategoriler'=>array('index'),
	'Kategori Ekle',
);
$this->pageTitle = "Kategori Ekle - " . Yii::app()->name;
?>

<h1>Kategori Ekle</h1>
<?php
$form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'news-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array('class'=>'well', 'enctype'=>'multipart/form-data'),
));
?>

<?php echo $this->renderPartial('_form', array('model'=>$model,'form'=>$form)); ?>
	<div class="form-actions">
		<input name="Category[is_deleted]" id="Category_is_deleted" value="0" type="hidden">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Kategori Ekle' : 'Kategoriyi Kaydet',
		)); ?>
	</div>

<?php
$this->endWidget();
?>