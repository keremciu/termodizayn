<?php
$this->breadcrumbs=array(
	'Projeler'=>array('index'),
	'Proje Ekle',
);

$this->pageTitle = "Proje Ekle - " . Yii::app()->name;
?>

<h1>Proje Ekle</h1>

<?php
$form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'product-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array('class'=>'well', 'enctype'=>'multipart/form-data'),
));

$tabs = array(
	array('id' => 'tab1', 'label' => 'Proje Genel Bilgileri', 'content' => $this->renderPartial('_form', array('model'=>$model,'form'=>$form), true), 'active' => true),
	array('id' => 'tab2', 'label' => 'Fotoğraf / Video / Döküman', 'content' => $this->renderPartial('_images', array('model'=>$model,'form'=>$form), true)),
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
			'label'=>$model->isNewRecord ? 'Projeyi Ekle' : 'Projeyi Kaydet',
		)); ?>
	</div>
<?php
$this->endWidget();
?>