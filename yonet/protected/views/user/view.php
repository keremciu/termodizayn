<?php
function roleFixer($id){
	if($id=='admin')
		return 'Baş Yönetici';
	else
		return 'Bayi';
}

?>

<?php $this->widget('booster.widgets.TbAlert', array(
        'fade'=>true,
        'closeText'=>'&times;',
    )); ?>

<h1><?php echo $model->name.' '.$model->lastname; ?></h1>

<?php $this->widget('booster.widgets.TbDetailView',array(
	'type'=>'bordered',
	'data'=>$model,
	'attributes'=>array(
		'name',
		'lastname',
		'email',
		array('name'=>'role','value'=>roleFixer($model->role)),
	),
)); ?>
