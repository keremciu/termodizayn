<?php 

$model->create_date = date("Y-m-d H:i:s");

$criteria=new CDbCriteria;
$criteria->select='max(ordering) AS ordering';		
$row = $model->find($criteria); 	
$lastorder = $row['ordering']+1;

if ($model->isNewRecord) {
	$model->ordering = $lastorder;
}

$orderdata = CHtml::listData($model->findAll(array('order' => 'ordering')),'ordering','fullName');
$orderinglist = CMap::mergeArray(array(0=>'0 İlk sırada'),$orderdata,array($lastorder=>$lastorder.' Son sırada'));

$products = CHtml::listData(Product::model()->findAll(),'id','title');

	echo $form->errorSummary($model);
?>
<div class="form-section">
	<h1 class="form-section_title">GENEL BİLGİLER</h1>
	<div class="form-section_content">
		<div class="row">
			<div class="col-md-6">
			<?php
				
				echo $form->dropDownListGroup($model, 'product',
					array(
						'widgetOptions' => array(
							'data' => $products,
						)
					)
				); 
			
				echo $form->textFieldGroup($model,'name');

				echo $form->textFieldGroup($model,'price',array('class'=>'span5','maxlength'=>255));
			?>
			</div>
			<div class="col-md-6">
			<?php
				
				echo $form->textAreaGroup($model,'content',array('rows'=>2, 'cols'=>30, 'class'=>'span8'));
			?>
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
				<?php
					echo $form->switchGroup($model, 'is_published'); 
					echo $form->hiddenField($model,'create_date'); 
				?>
			</div>
		</div>
	</div>
</div>
