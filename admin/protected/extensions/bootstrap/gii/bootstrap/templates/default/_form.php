<?php echo "<?php \$form=\$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'".$this->class2id($this->modelClass)."-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array('class'=>'well'),
)); ?>\n"; ?>

	<?php echo "<?php echo \$form->errorSummary(\$model); ?>\n"; ?>
	<p class="help-block"><span class="required">*</span> işaretli alanlar boş bırakılamaz.</p>
<?php
foreach($this->tableSchema->columns as $column)
{
	if($column->autoIncrement)
		continue;
?>
	<?php echo "<?php echo ".$this->generateActiveRow($this->modelClass,$column)."; ?>\n"; ?>

<?php
}
?>
	<div class="form-actions">
		<?php echo "<?php \$this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>\$model->isNewRecord ? 'Ekle' : 'Kaydet',
		)); ?>\n"; ?>
	</div>

<?php echo "<?php \$this->endWidget(); ?>\n"; ?>
