<?php
$this->breadcrumbs=array(
	'Çeviriler',
);
?>

<h1>Çeviriler</h1>

<a href="<?php echo Yii::app()->createUrl('/translates/getmessages'); ?>" class="btn btn-warning btn-small">Yeni Çevirileri Getir</a>

<?php 
$form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array('action'=>Yii::app()->createUrl($this->route),'method'=>'get',)); 
	echo '<div class="btn-group btn-raddip" style="margin-top:20px">';
	foreach ($languages as $key => $language) {
		if (Yii::app()->language != $key) {
			echo '<label for="'.$key.'lfilter" class="'.(($key==$lang) ? "active" : "").' btn btn-success">'.$language.' diline ait çevirileri göster</label>';
			echo '<input id="'.$key.'lfilter" type="submit" value="'.$key.'" name="lang" style="display:none"/>';
		}
	}
	echo "</div>";
 $this->endWidget(); ?>

<?php

$form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array('action'=>Yii::app()->createUrl($this->route))); 

	foreach ($model as $key => $translate) { 

		echo '<label for="field_'.$key.'" class="required">'.$key.'</label>';
		echo CHtml::textField('field['.$key.']', $translate,array('placeholder'=>$key."'ı ".$languages[$lang]." diline çevirin"));

	}
?>
	<input type="hidden" name="lang" value="<?php echo $lang; ?>" />
		<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>'Çevirileri Kaydet',
		)); ?>
	</div>
<?php
$this->endWidget();