<?php
$this->breadcrumbs=array(
	'Chats'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Güncelle',
);
?>

<h1>Chat Güncelle</h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>