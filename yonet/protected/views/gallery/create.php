<?php
$this->breadcrumbs=array(
	'Galeriler'=>array('index'),
	'Galeri Ekle',
);
?>

<h1>Galeri Ekle</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>