<?php
$this->pageTitle=Yii::app()->name . ' - Yönetici Listesi';
$this->breadcrumbs=array(
	'Yöneticiler'=>array('admin'),
	'Yönetici Listesi',
);

function roleFixer($id){
	if($id=='admin')
		return 'Baş Yönetici';
	else
		return 'Editör';
}
?>

<h1>Yönetici Listesi</h1><a href="<?php echo Yii::app()->createUrl('/user/create'); ?>" class="btn btn-primary">Yönetici Ekle</a>

<?php 
$this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'user-grid',
	'type'=>'striped bordered condensed',
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
