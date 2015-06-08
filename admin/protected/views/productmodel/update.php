<?php
$this->breadcrumbs=array(
	'Ürün Modelleri'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Güncelle',
);
?>

<h1>Ürün Modelini Güncelle</h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>