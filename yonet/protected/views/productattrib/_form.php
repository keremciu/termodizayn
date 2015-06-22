<h1 class="form-section_title">GENEL</h1>
<div class="form-section_content">
	<?php echo $form->errorSummary($model); ?>
	<div class="row">
		<div class="col-md-6">
			<?php
				echo $form->textFieldGroup($model,'title',array(
						'widgetOptions'=>array('htmlOptions'=>array('maxlength'=>255))
					)
				);
				echo $form->dropDownListGroup($model,'container',
					array(
						'widgetOptions' => array(
							'data' => array('product'=>'Ürüne Özel','model'=>'Modele Özel'),
						)
					)
				);
			?>
		</div>
		<div class="col-md-6">
			<?php
				echo $form->textFieldGroup($model,'prefix',array('widgetOptions'=>array('htmlOptions'=>array('maxlength'=>255))));
				echo $form->switchGroup($model,'is_published');
			?>
		</div>
	</div>
</div>