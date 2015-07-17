<?php
?>
<?php echo $form->errorSummary($model); ?>
<div class="row">
	<div class="col-md-6">
		<div class="form-group">
			<?php
				echo $form->textFieldGroup($model,'name',array('class'=>'form-control','maxlength'=>255));
				echo "</div><div>".$form->textFieldGroup($model,'url',array('class'=>'form-control','maxlength'=>255));
		?>
	</div>
</div>
<div class="col-md-6">
	<?php echo $form->textAreaGroup($model,'desc', array('widgetOptions' => array('htmlOptions' => array('rows' => 5,'class'=>'mini')))); ?>
</div>
</div>
<div class="row">
<div class="col-md-6">
	<div class="form-group">
		<?php
			echo $form->hiddenField($model,'min_photo');
			echo $form->fileFieldGroup($model,'image',array('class'=>'form-control','maxlength'=>255));
		echo "</div><div>".
			$form->dropDownListGroup($model, 'gallery',
				array(
					'widgetOptions' => array(
						'data' => $galleries,
						'htmlOptions' => array(),
					)
				)
			);
	?>
</div>
</div>
<div class="col-md-6">
<div class="form-group">
	<?php
			echo $form->dropDownListGroup($model, 'ordering',
				array(
						'widgetOptions' => array(
							'data' => $orderinglist,
							'htmlOptions' => array(),
						)
					)
				);
	echo "</div><div>". $form->switchGroup($model, 'is_published', array('class'=>'form-control'));
?>
</div>
</div>
</div>
<p class="help-block"><span class="required">*</span> işaretli alanlar boş bırakılamaz.</p>