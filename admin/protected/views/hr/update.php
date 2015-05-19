<?php
$this->breadcrumbs=array(
	'Totelephones'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Güncelle',
);
?>

<h1>Totelephone Güncelle</h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>