<?php
$this->breadcrumbs=array(
	'Çeviriler'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Güncelle',
);
?>

<h1>Çeviriyi Güncelle</h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>