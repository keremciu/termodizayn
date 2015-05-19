<?php
$this->breadcrumbs=array(
	'Fotoğraflar'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Güncelle',
);
?>

<h1>Fotoğraf Güncelle</h1>

<?php
$form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'news-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array('class'=>'well', 'enctype'=>'multipart/form-data'),
));

$tabs = array(
	array('id' => 'tab1', 'label' => 'Fotoğraf Bilgileri', 'content' => $this->renderPartial('_form', array('model'=>$model,'form'=>$form), true), 'active' => true),
	array('id' => 'tab2', 'label' => 'Başka Dile Çevir', 'content' => $this->renderPartial('_translate', array('model'=>$model,'form'=>$form), true)),
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
			'label'=>$model->isNewRecord ? 'Fotoğraf Ekle' : 'Fotoğrafı Kaydet',
		)); ?>
	</div>
<?php
$this->endWidget();
?>