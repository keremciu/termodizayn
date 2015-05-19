<?php
$this->pageTitle=Yii::app()->name . ' - Toplu Mail Gönder';
$this->breadcrumbs=array(
	'Toplu Mail Gönder',
);
?>

<?php $this->widget('bootstrap.widgets.TbAlert', array(
        'block'=>true, // display a larger alert block?
        'fade'=>true, // use transitions?
        'closeText'=>'&times;', // close link text - if set to false, no close link is displayed
    )); ?>

<h1>Toplu Mail Gönder</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>