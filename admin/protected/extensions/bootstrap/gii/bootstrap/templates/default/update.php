<?php
echo "<?php\n";
$nameColumn=$this->guessNameColumn($this->tableSchema->columns);
$label=$this->pluralize($this->class2name($this->modelClass));
echo "\$this->breadcrumbs=array(
	'$label'=>array('index'),
	\$model->{$nameColumn}=>array('view','id'=>\$model->{$this->tableSchema->primaryKey}),
	'Güncelle',
);\n";
?>
?>

<h1><?php echo $this->modelClass; ?> Güncelle</h1>

<?php echo "<?php echo \$this->renderPartial('_form',array('model'=>\$model)); ?>"; ?>