<?php
$this->breadcrumbs=array(
	'Fotoğraflar'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Güncelle',
);
$form=$this->beginWidget('booster.widgets.TbActiveForm',array(
		'id'=>$model->tableName().'-form',
		'enableAjaxValidation'=>false,
		'htmlOptions'=>array('class'=>'', 'enctype'=>'multipart/form-data'),
	));
	$this->renderPartial('/layouts/getlanguages');
?>
<div class="main-area col-md-12 main-content main-content--full">
	<div class="form-section margin-reset">
		<div class="form-section_content">
			<?php
				echo $this->renderPartial('_form', array('model'=>$model,'form'=>$form,'galleries'=>$galleries,'orderinglist'=>$orderinglist));
			echo "</div></div></div></div>";
			echo $this->renderPartial('/layouts/translate', array('model'=>$model,'form'=>$form), true)
		?>
		<div class="form-actions">
			<?php $this->widget('booster.widgets.TbButton', array(
				'buttonType'=>'submit',
				'htmlOptions'=>array(
					'data-form'=>$model->tableName().'-form'
				),
				'encodeLabel'=>false,
				'context' => 'success',
				'label'=>'<svg data-form="photos-form" class="td-icon td-icon-cloud-done"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-cloud-done"></use></svg> Fotoğrafı Kaydet',
			)); ?>
		</div>
	</div>
</div>
<?php
	$this->endWidget();
?>