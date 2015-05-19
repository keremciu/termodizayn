<?php
$this->breadcrumbs=array(
	'Kategoriler'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Güncelle',
);
?>

<h1>Kategori Güncelle</h1>

<?php
$form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'news-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array('class'=>'well', 'enctype'=>'multipart/form-data'),
));

$tabs = array(
	array('id' => 'tab1', 'label' => 'Kategori Bilgileri', 'content' => $this->renderPartial('_form', array('model'=>$model,'form'=>$form), true), 'active' => true),
	array('id' => 'tab2', 'label' => 'Başka Dile Çevir', 'content' => $this->renderPartial('/layouts/translate', array('model'=>$model,'form'=>$form), true)),
);

$this->widget('bootstrap.widgets.TbTabs', array(
	'type'=>'tabs',
	'tabs'=>$tabs,
));
?>
	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Kategori Ekle' : 'Kategoriyi Kaydet',
		)); ?>
	</div>
<?php
$this->endWidget();
?>