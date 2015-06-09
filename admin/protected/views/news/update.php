<div class="form-section">
<?php
$this->breadcrumbs=array(
	'İçerikler'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Güncelle',
);

$form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'news-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array('class'=>'form-section_content', 'enctype'=>'multipart/form-data'),
));

$tabs = array(
	array('id' => 'tab1', 'label' => 'İçerik Bilgileri', 'content' => $this->renderPartial('_form', array('model'=>$model,'form'=>$form), true), 'active' => true),
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
			'label'=>$model->isNewRecord ? 'İçerik Ekle' : 'İçeriği Kaydet',
		)); ?>
	</div>
<?php
$this->endWidget();
?>
</div>