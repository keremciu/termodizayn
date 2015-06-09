<?php
$this->pageTitle=Yii::app()->name . ' - Yeni Yönetici Ekle';
$this->breadcrumbs=array(
	'Yöneticiler'=>array('admin'),
	'Yeni Yönetici Ekle',
);
?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>