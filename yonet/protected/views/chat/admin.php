<?php
$this->breadcrumbs=array('Chats'=>array('index'),'Chat Listesi')
?>
<h1>Chat Listesi</h1>

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'chat-grid',
	'dataProvider'=>$model->search(),
	'columns'=>array(
		'id',
		'user',
		'message',
		'datime',
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>
