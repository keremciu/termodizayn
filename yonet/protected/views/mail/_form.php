<?php $form=$this->beginWidget('booster.widgets.TbActiveForm',array(
	'id'=>'mail-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array('class'=>''),
)); ?>

	<?php 

		echo $form->dropDownListGroup($model, 'email',
					array(
						'widgetOptions' => array(
							'data' => array('all'=>'Tüm Uyeler', 'admin'=>'Yöneticiler','dealer'=>'Bayiler','user'=>'Uyeler'),
						)
					)
				);
		
		echo $form->textFieldGroup($model,'subject',array('class'=>'span5','maxlength'=>100)); 

		echo $form->redactorGroup($model,'body',
			array(
				'widgetOptions' => array(
					'editorOptions' =>array(
						'class' => 'span4', 
						'rows' => 5, 
						'options' => array('plugins' => array('clips', 'fontfamily'), 'lang' => 'sv')
					)
				)
			)
		); 

	?>

	<div class="form-actions">
		<?php $this->widget('booster.widgets.TbButton', array(
			'buttonType'=>'submit',
			'context'=>'primary',
			'size'=>'large',
			'label'=>'Gönder',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
