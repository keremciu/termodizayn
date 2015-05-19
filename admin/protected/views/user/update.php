<?php
$this->pageTitle=Yii::app()->name . ' - Yönetici Güncelle';
$this->breadcrumbs=array(
	'Yöneticiler'=>array('admin'),
	$model->name.' '.$model->lastname=>array('view','id'=>$model->id),
	'Yönetici Güncelle',
);
?>

<h1>Yönetici Güncelle</h1>

<?php echo $this->renderPartial('_update_form',array('model'=>$model)); ?>