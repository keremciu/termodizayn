<?php
$this->breadcrumbs=array(
	'Diller'=>array('index'),
	'Dil Ekle',
);
?>

<h1>Dil Ekle</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>