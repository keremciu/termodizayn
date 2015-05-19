<?php
$this->pageTitle=Yii::app()->name . ' - Yönetici Görüntüle';
$this->breadcrumbs=array(
	'Yöneticiler'=>array('admin'),
	$model->name.' '.$model->lastname,
);

function roleFixer($id){
	if($id=='admin')
		return 'Baş Yönetici';
	else
		return 'Editör';
}

?>

<?php $this->widget('bootstrap.widgets.TbAlert', array(
        'block'=>true,
        'fade'=>true,
        'closeText'=>'&times;',
    )); ?>

<h1><?php echo $model->name.' '.$model->lastname; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'type'=>'bordered',
	'data'=>$model,
	'attributes'=>array(
		'name',
		'lastname',
		'email',
		array('name'=>'role','value'=>roleFixer($model->role)),
	),
)); ?>
