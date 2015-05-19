<?php
$this->breadcrumbs=array(
	'Menüler'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Güncelle',
);
?>

<h1>Menü Güncelle</h1>

<?php
$form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'menu-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array('class'=>'well', 'enctype'=>'multipart/form-data'),
));

$tabs = array(
	array('id' => 'tab1', 'label' => 'Menü Bilgileri', 'content' => $this->renderPartial('_form', array('model'=>$model,'form'=>$form), true), 'active' => true),
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
			'label'=>$model->isNewRecord ? 'Menü Ekle' : 'Menüyü Kaydet',
		)); ?>
	</div>
<?php
$this->endWidget();
?>