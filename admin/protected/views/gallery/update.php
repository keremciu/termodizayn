<?php
$this->breadcrumbs=array(
	'Galeriler'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Güncelle',
);
?>

<h1>Galeri Güncelle</h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>