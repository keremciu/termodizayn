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
$orderdata = CHtml::listData($model->findAll(array('order' => 'ordering')),'updatedorder','orderName');
$orderinglist = CMap::mergeArray(array(1=>'1 -> İlk sıraya'),$orderdata);
$tags = $model->getAllTags();

	echo $form->errorSummary($model); 

?>
<div class="form-section">
	<h1 class="form-section_title">GENEL BİLGİLER</h1>
	<div class="form-section_content">
		<div class="row">
			<div class="col-md-6">
				<?php echo $form->dropDownListGroup($model, 'category',
					array(
						'widgetOptions' => array(
							'data' => $categories,
						)
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
<?php
	// get attribs
	$this->renderPartial('_attribs', array('model'=>$model,'form'=>$form));
	// get image details
	$this->renderPartial('_images', array('model'=>$model,'form'=>$form));
	// get another details
?>
<div class="form-section no-margin">
	<h1 class="form-section_title">DIGER AYARLAR</h1>
	<div class="form-section_content">
		<div class="row">
			<div class="col-md-4">
				<div class="form-group">
					<label class="control-label" for="Tags">Anahtar Kelimeler</label>
					<?php
						$this->widget('booster.widgets.TbSelect2', array(
		        			'asDropDownList' => false,
		        			'name' => 'tags',
		        			'value' => $model->tags->toString(),
		        			'htmlOptions' => array(
		        				'class' => 'form-control'
		        			),
		        			'options' => array(
		            			'tags' => $tags,
		            			'placeholder' => 'Lütfen ürün ile ilgili anahtar kelime girin',
		            			'tokenSeparators' => array(',', ' ')
		        			)
		    			));
		 			?>
		 		</div>
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
		<div class="col-md-4">
				<?php echo $form->switchGroup($model, 'featured'); ?>
		</div>
	</div>
</div>
<?php 
	echo $form->hiddenField($model,'create_data');
	echo $form->hiddenField($model,'hits');
?>
<input name="Product[is_deleted]" id="Product_is_deleted" value="0" type="hidden">