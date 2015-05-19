<?php
$this->pageTitle=Yii::app()->name . ' - Şifre Değiştir';
$this->breadcrumbs=array(
	'Şifre Değiştir',
);
?>

<?php $this->widget('bootstrap.widgets.TbAlert', array(
        'block'=>true, // display a larger alert block?
        'fade'=>true, // use transitions?
        'closeText'=>'&times;', // close link text - if set to false, no close link is displayed
    )); ?>

<h1>Şifre Değiştir</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>