<?php 

$criteria=new CDbCriteria;
$criteria->select='max(ordering) AS ordering';		
$row = $model->find($criteria); 	
$lastorder = $row['ordering']+1;

$orderdata = CHtml::listData($model->findAll(array('order' => 'ordering')),'ordering','fullName');
$orderinglist = CMap::mergeArray(array(0=>'0 İlk sırada'),$orderdata,array($lastorder=>$lastorder.' Son sırada'));

if ($model->isNewRecord) {
	$model->ordering = $lastorder;
}

echo $form->errorSummary($model);

$parents = CHtml::listData(Category::model()->findAll(array('condition'=>'type = :type','params'=>array(':type'=>$type))),'id','parentname');
?>
<div class="form-section">
	<h1 class="form-section_title">GENEL BİLGİLER</h1>
	<div class="form-section_content">
		<div class="row">
			<div class="col-md-6">
				<?php echo $form->dropDownListGroup($model, 'parent',
					array(
						'widgetOptions' => array(
							'data' => $parents,
							'htmlOptions'=> array(
								'empty' => 'Alt kategori ise üst kategorisini seçiniz'
							)
						),
					)
				); ?>
				<div>
					<?php echo $form->textFieldGroup($model,'title',array('class'=>'span5','maxlength'=>255)); ?>
				</div>
			</div>
			<div class="col-md-6">
				<?php echo $form->textAreaGroup(
						$model,
						'description',
						array(
							'widgetOptions'=> array(
								'htmlOptions'=> array(
									'class'=>'mini'
								)
							)
						)
				); ?>
			</div>
		</div>
	</div>
</div>
<div class="form-section no-margin">
	<h1 class="form-section_title">DIGER AYARLAR</h1>
	<div class="form-section_content">
		<div class="row">
			<div class="col-md-4">
				<?php echo $form->fileFieldGroup($model,'image',array('class'=>'span5','maxlength'=>255)); ?>
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
				<?php echo $form->switchGroup($model, 'is_published'); ?>
			</div>
		</div>
	</div>
</div>
<?php
		echo $form->hiddenField($model,'type'); 
		echo $form->hiddenField($model,'is_deleted');
?>