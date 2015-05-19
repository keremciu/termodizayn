<?php
$this->breadcrumbs=array(
	'Settings'=>array('index'),
	'Settings Ekle',
);
?>

<h1>Settings Ekle</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>