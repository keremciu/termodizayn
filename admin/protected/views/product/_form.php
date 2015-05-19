<?php  

$model->create_data = date("Y-m-d H:i:s");

$criteria=new CDbCriteria;
$criteria->select='max(ordering) AS ordering';		
$row = $model->find($criteria); 	
$lastorder = $row['ordering']+1;

if ($model->isNewRecord) {
	$model->featured = 0;
	$model->ordering = $lastorder;
}

$orderdata = CHtml::listData($model->findAll(array('order' => 'ordering')),'ordering','fullName');
$orderinglist = CMap::mergeArray(array(0=>'0 İlk sırada'),$orderdata,array($lastorder=>$lastorder.' Son sırada'));
$tags = $model->getAllTags();
 ?>
	<?php echo $form->errorSummary($model); ?>
	<p class="help-block"><span class="required">*</span> işaretli alanlar boş bırakılamaz.</p>
	<?php echo $form->textFieldRow($model,'title',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->hiddenField($model,'slug'); ?>

	<label for="tags" class="required">Etiket <span class="required">*</span></label>
	<?php 
		$this->widget('bootstrap.widgets.TbSelect2', array(
			'asDropDownList' => false,
			'name' => 'tags',
			'value' => $model->tags->toString(),
			'options' => array(
				'tags' => $tags,
				'placeholder' => 'Lütfen proje ile ilgili etiket girin',
				'width' => '41%',
				'tokenSeparators' => array(',')
		)));	
	?>
	<?php echo $form->textAreaRow($model,'description',array('rows'=>2, 'cols'=>30, 'class'=>'span8')); ?>

	<?php echo $form->textAreaRow($model,'intro',array('rows'=>2, 'cols'=>30, 'class'=>'span8')); ?>

	<div style="width:100%;overflow:hidden">
		<?php echo $form->redactorRow($model, 'content', array('class'=>'span4', 'rows'=>5)); ?><br/><br/>
	</div>

	<?php echo $form->dropDownListRow($model, 'category', CHtml::listData(Category::model()->findAll(array('condition'=>'type = "product"','order'=>'ordering','group'=>'t.id')),'id','parentname'), array('empty'=>'Lütfen Bir Kategori Seçiniz', 'class'=>'span5')); ?>

	<?php echo $form->hiddenField($model,'create_data'); ?>

	<?php if ($model->isNewRecord)
		echo $form->dropDownListRow($model, 'ordering', $orderinglist, array('empty'=>'Lütfen bir sıralama seçiniz', 'class'=>'span5'));
	else 
		echo $form->dropDownListRow($model, 'ordering', $orderinglist, array('empty'=>'Lütfen bir sıralama seçiniz', 'class'=>'span5'));
	?>

	<?php echo $form->hiddenField($model,'hits',array('class'=>'span5')); ?>

	<?php echo $form->hiddenField($model,'featured',array('class'=>'span5')); ?>

	<?php echo $form->toggleButtonRow($model, 'is_published'); ?>
	<input name="Product[is_deleted]" id="Product_is_deleted" value="0" type="hidden">

<?php 

Yii::app()->clientScript->registerScriptFile('files/aliasmap.js',CClientScript::POS_END); 