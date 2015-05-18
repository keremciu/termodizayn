<?php
$this->pageTitle=ucfirst(strtolower($menu->name)) . ' — '. Yii::app()->name;
$this->breadcrumbs=array(
	'$menu->name',
);
if (isset($_GET["type"])) {
	$type = $_GET["type"];
} else {
	$type = "";
}
if ($type == "sayhi") {
	$model->subject = "ihaveameet";
} else {
	$model->subject = "ihaveaproject";
}
?>
<div class="clip">
	<div class="cliphead">
		<h1 class="subtitle"><?php echo $this->strto("capitalize",$menu->name); ?></h1>
	</div>
</div>
<?php if(Yii::app()->user->hasFlash('contact')){ ?>
<div class="alertarea">
	<div class="alert alert-success">
		<?php echo Yii::app()->user->getFlash('contact'); ?>
	</div>
</div>
<?php } ?>
<div class="contactarea">
	<div class="infoarea">
		<p>Turkey</span></p>
		<p class="mailtext lead"><a href="mailto:levyhug@gmail.com">levyhug@gmail.com</a> <?php echo Yii::t('strings','veya aşağıdaki formu kullan'); ?></p>
	</div>
</div></div>
<div class="contactform">
	<div class="contacthead">
	</div>
	<div class="contactbill">
		<div class="corset">
			<div class="tab-content">
				<div class="tab-pane active" id="project">
					<div class="contactcontrols clearfix">
						<?php $form=$this->beginWidget('CActiveForm', array(
			'id'=>'contact-form',
			'enableClientValidation'=>false,
		)); ?>

			<div class="control-group">
				<?php echo $form->textField($model,'name',array('size'=>40,'maxlength'=>128,'placeholder'=>Yii::t('strings','Adınız Soyadınız'))); ?>
				<?php echo $form->error($model,'name'); ?>
			</div>

			<div class="control-group">
				<?php echo $form->textField($model,'email',array('size'=>40,'maxlength'=>128,'placeholder'=>Yii::t('strings','E-Posta Adresiniz'))); ?>
				<?php echo $form->error($model,'email'); ?>
			</div>

			<div class="control-group">
				<?php echo $form->textarea($model,'body',array('rows'=>5,'cols'=>35,'placeholder'=>Yii::t('strings','Mesajınız'))); ?>
				<?php echo $form->error($model,'body'); ?>
			</div>

			<div class="control-group contactbutton">
				<?php echo CHtml::submitButton(Yii::t('strings','Gönder'),array('class'=>"btn btn-primary btn-large")); ?>
			</div>
		<?php $this->endWidget(); ?>

				</div>
			</div>
		</div>
	</div></div>