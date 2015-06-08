<?php
$this->breadcrumbs=array(
	'Ürün Modelleri'=>array('index'),
	'Ürün Modeli Ekle',
);
?>

<h1>Ürün Modeli Ekle</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>