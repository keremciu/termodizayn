<?php
echo "<?php\n";
$label=$this->pluralize($this->class2name($this->modelClass));
$thisap=$this->class2name($this->modelClass);
echo "\$this->breadcrumbs=array(
	'$label'=>array('index'),
	'$thisap Ekle',
);\n";
?>
?>

<h1><?php echo $thisap; ?> Ekle</h1>

<?php echo "<?php echo \$this->renderPartial('_form', array('model'=>\$model)); ?>"; ?>
