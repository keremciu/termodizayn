<?php
echo "<?php\n";
$label=$this->pluralize($this->class2name($this->modelClass));
$thisap=$this->class2name($this->modelClass);
echo "\$this->breadcrumbs=array('$label'=>array('index'),'$thisap Listesi')";
echo "\n?>";
?>

<h1><?php echo $thisap; ?> Listesi</h1>

<?php echo "<?php"; ?> $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'<?php echo $this->class2id($this->modelClass); ?>-grid',
	'dataProvider'=>$model->search(),
	'columns'=>array(
<?php
$count=0;
foreach($this->tableSchema->columns as $column)
{
	if(++$count==7)
		echo "\t\t/*\n";
	echo "\t\t'".$column->name."',\n";
}
if($count>=7)
	echo "\t\t*/\n";
?>
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>
