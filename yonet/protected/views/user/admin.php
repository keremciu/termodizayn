<?php

function roleFixer($id){
	if($id=='admin')
		return 'Baş Yönetici';
	else if ($id == 'dealer') 
		return 'Bayi';
	else
		return "Kullanıcı";
}

$this->widget('booster.widgets.TbGridView',array(
	'id'=>'user-grid',
	'type'=>'',
	'htmlOptions'=>array('class'=>''),
	'dataProvider'=>$model->search(),
	'columns'=>array(
		'username',
		'name',
		'lastname',
		'email',
		array('name'=>'role','value'=>'roleFixer($data->role)'), 
		array(
			'class'=>'booster.widgets.TbButtonColumn',
			'template'=>'{update}{delete}',
		),
	),
)); ?>
