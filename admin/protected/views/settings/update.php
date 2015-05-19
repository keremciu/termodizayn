<?php
$this->breadcrumbs=array(
	'Settings'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Güncelle',
);
?>

<h1>Settings Güncelle</h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>