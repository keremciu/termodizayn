<?php
$this->pageTitle=Yii::app()->name . ' - Bilgileri Güncelle';
$this->breadcrumbs=array(
	'Yöneticiler'=>array('admin'),
	$model->name.' '.$model->lastname=>array('view','id'=>$model->id),
	'Bilgileri Güncelle',
);
?>

<h1>Bilgileri Güncelle</h1>

<?php echo $this->renderPartial('_update_yourself_form',array('model'=>$model)); ?>