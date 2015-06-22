<div class="row">
	<?php echo $form->errorSummary($model); ?>
	<div class="col-md-6">
		<div class="form-group">
			<?php
				echo $form->textFieldGroup($model,'title');
				echo $form->hiddenField($model,'slug');
			?>
		</div>
		<div>
			<label for="tags" class="required">Etiket <span class="required">*</span></label>
			<?php
				$this->widget('booster.widgets.TbSelect2', array(
					'asDropDownList' => false,
					'name' => 'tags',
					'value' => $model->tags->toString(),
					'options' => array(
						'tags' => $model->getAllTags(),
						'placeholder' => 'Lütfen haber ile ilgili etiket girin',
						'width' => '100%',
						'tokenSeparators' => array(',')
					)
					));
			?>
		</div>
	</div>
	<div class="col-md-6">
		<?php echo $form->textAreaGroup($model,'description',
				array(
					'widgetOptions' => array(
						'htmlOptions' => array('rows' => 5,'class'=>'auto-height'),
					)
				));
		?>
	</div>
</div>
<div class="form-group">
	<?php echo $form->redactorGroup($model, 'content', array('class'=>'form-control', 'rows'=>3)); ?>
</div>
<div class="row">
	<div class="col-md-6">
		<div class="form-group">
			<?php
				echo $form->fileFieldGroup($model,'image',array('class'=>'form-control','maxlength'=>255));
			echo "</div><div class='form-group'>".
				$form->dropDownListGroup($model, 'category',
					array(
						'widgetOptions' => array(
							'data' => $categories,
							'htmlOptions' => array(),
						)
					)
				);
		echo "</div><div>";
		echo $form->dropDownListGroup($model, 'ordering',
			array(
				'widgetOptions' => array(
					'data' => $orderinglist,
					'htmlOptions' => array(),
				)
			)
		);
	?>
</div>
</div>
<div class="col-md-6">
<div class="form-group">
	<?php echo $form->datepickerGroup($model,'date'); ?>
</div>
<div class="form-group">
	<?php echo $form->timePickerGroup($model,'time'); ?>
</div>
<div>
	<?php
		if (Yii::app()->user->role == "admin") {
			echo $form->switchGroup($model, 'is_published');
	} else { ?>
	<input name="News[is_published]" id="News_is_published" value="0" type="hidden">
	<?php } ?>
	<div>
		<?php echo $form->hiddenField($model,'author_id',array('class'=>'span5')); ?>
		<?php echo $form->hiddenField($model,'create_data',array('class'=>'span5')); ?>
		<input name="News[is_deleted]" id="News_is_deleted" value="0" type="hidden">
	</div>
</div>
</div>
</div>
<p class="help-block"><span class="required">*</span> işaretli alanlar boş bırakılamaz.</p>