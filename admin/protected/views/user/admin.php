<?php
$this->pageTitle=Yii::app()->name . ' - Yönetici Listesi';
$this->breadcrumbs=array(
	'Yöneticiler'=>array('admin'),
	'Yönetici Listesi',
);

function roleFixer($id){
	if($id=='admin')
		return 'Baş Yönetici';
	else if ($id == 'dealer') 
		return 'Bayi';
	else
		return "Kullanıcı";
}

$this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'user-grid',
	'type'=>'',
	'htmlOptions'=>array('class'=>'dataTable table table-hover no-footer'),
	'dataProvider'=>$model->search(),
	'columns'=>array(
		'username',
		'name',
		'lastname',
		'email',
		array('name'=>'role','value'=>'roleFixer($data->role)'), 
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>
