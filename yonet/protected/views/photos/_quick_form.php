<div class="admin_content col-md-12 main-content main-content--full">
    <div class="admin_list form-section">
        <h1 class="form-section_title">HIZLI FOTOĞRAF EKLEME</h1>
        <div class="form-section_content">
<?php
	// quick photo add form
	$form = $this->beginWidget('booster.widgets.TbActiveForm',
		array(
			'id'=>'photo-form',
			'enableAjaxValidation'=>false,
			'action' => Yii::app()->createUrl('photos/create'),
			'htmlOptions'=>array('class'=>'admin-form', 'enctype'=>'multipart/form-data'),
		)
	);
	echo '<div class="row">';
		// name -text input
		echo '<div class="col-md-4">';
			echo $form->textFieldGroup($model,'name');
		echo '</div>';

		// image -file input
		echo '<div class="col-md-3">';
			echo $form->fileFieldGroup($model,'image',array('class'=>'col-xs-2','maxlength'=>255));
		echo '</div>';

		// gallery -select
		echo '<div class="col-md-3">';
			echo $form->dropDownListGroup($model,'gallery',
				array(
					'widgetOptions' => array(
						'data' => $galleries,
						'htmlOptions' => array(),
					)
				)
			);
		echo '</div>';
		
		// ordering -hidden input
		echo $form->hiddenField($model,'ordering',array('value'=>$lastorder));
		// is_published -hidden input
		echo $form->hiddenField($model,'is_published',array('value'=>1));
		// photo -hidden input
		echo $form->hiddenField($model,'photo',array('value'=>0));

		// submit -button
		echo '<div class="col-md-2 label-padding">';
			$this->widget('booster.widgets.TbButton',
				array(
					'buttonType'=>'submit',
            		'context' => 'success',
					'encodeLabel'=>false,
					'label'=>'<svg class="td-icon td-icon-cloud-done"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-cloud-done"></use></svg> Fotoğraf Ekle',
				)
			);
		echo '</div>';
	echo '</div>';
	// end quick photo add form
$this->endWidget();
?>
	</div>
</div>