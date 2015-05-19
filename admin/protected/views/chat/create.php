<?php
$this->breadcrumbs=array(
	'Chats'=>array('index'),
	'Chat Ekle',
);
?>

<h1>Chat Ekle</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>