<?php
$this->breadcrumbs=array(
	'Languages'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Güncelle',
);
?>

<h1>Languages Güncelle</h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>