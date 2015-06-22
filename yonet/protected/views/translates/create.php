<?php
$this->breadcrumbs=array(
	'Çeviriler'=>array('index'),
	'Çeviri Ekle',
);
?>

<h1>Çeviri Ekle</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>