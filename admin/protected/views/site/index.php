<?php
$this->pageTitle=Yii::app()->name; ?>

<div class="bootstrap-widget">
	<div class="bootstrap-widget-header"><i class="icon-home"></i><h3>Yöneticiler arası iletişim için mesajlaşma aparatı</h3></div>
	<div class="bootstrap-widget-content" id="yw1">
<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'chat-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array('class'=>'span3'),
)); ?>

	<?php echo $form->textAreaRow($model,'message',array('rows'=>3, 'cols'=>50, 'class'=>'span3')); ?>
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>'Mesajı Gönder',
		)); ?>
<?php $this->endWidget(); ?>

<?php
 $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
	'htmlOptions'=>array('class'=>'span7'),
)); ?>
</div></div>