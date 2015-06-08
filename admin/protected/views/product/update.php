<?php
$this->breadcrumbs=array(
	'Ürünler'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Güncelle',
);
?>

<h1>Ürün Güncelle</h1>

<?php
$form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'product-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array('class'=>'well', 'enctype'=>'multipart/form-data'),
));

$tabs = array(
	array('id' => 'tab1', 'label' => 'Ürün Genel Bilgileri', 'content' => $this->renderPartial('_form', array('model'=>$model,'form'=>$form), true), 'active' => true),
	array('id' => 'tab2', 'label' => 'Fotoğraf / Video / Döküman', 'content' => $this->renderPartial('_images', array('model'=>$model,'form'=>$form), true)),
	array('id' => 'tab3', 'label' => 'Başka Dile Çevir', 'content' => $this->renderPartial('/layouts/translate', array('model'=>$model,'form'=>$form), true)),
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
			'label'=>$model->isNewRecord ? 'Ürünü Ekle' : 'Ürünü Kaydet',
		)); ?>
	</div>
<?php
$this->endWidget();
?>