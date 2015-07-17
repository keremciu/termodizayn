<?php 

$criteria=new CDbCriteria;
$criteria->select='max(ordering) AS ordering';
$row = $model->find($criteria);
$lastorder = $row['ordering']+1;
if ($model->isNewRecord) {
	$model->ordering = $lastorder;
}
$orderdata = CHtml::listData($model->findAll(array('order' => 'ordering')),'updatedorder','orderName');
$orderinglist = CMap::mergeArray(array(1=>'1 -> İlk sıraya'),$orderdata);

echo $form->errorSummary($model); ?>
<div class="form-section">
	<h1 class="form-section_title">GENEL BİLGİLER</h1>
	<div class="form-section_content">
		<div class="row">
			<div class="col-md-6">
	<?php echo $form->textFieldGroup($model,'name',array('widgetOptions'=>array('htmlOptions'=>array('maxlength'=>255)))); ?>
			<div>
				<?php echo $form->fileFieldGroup($model,'path',array('widgetOptions'=>array('htmlOptions'=>array('maxlength'=>255)))); ?>
			</div></div>
			<div class="col-md-6">
				<?php echo $form->textAreaGroup($model,'intro', array('widgetOptions'=>array('htmlOptions'=>array('class'=>'mini','rows'=>6, 'cols'=>50)))); ?>
			</div>
		</div>
	</div>
</div>
<div class="form-section no-margin">
	<h1 class="form-section_title">İÇERİK BİLGİLERİ</h1>
	<div class="form-section_content">
		<div class="row">
			<div class="col-md-4">
				<?php echo $form->fileFieldGroup($model,'image',array('widgetOptions'=>array('htmlOptions'=>array('maxlength'=>255)))); ?>
			</div>
			<div class="col-md-4">
				<?php echo $form->dropDownListGroup($model, 'ordering',
						array(
							'widgetOptions' => array(
								'data' => $orderinglist,
							)
						)
					); ?>
			</div>
			<div class="col-md-4">
				<?php echo $form->switchGroup($model, 'active'); ?>
			</div>
		</div>
	</div>
</div>
