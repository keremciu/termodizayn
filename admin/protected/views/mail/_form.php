<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'mail-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array('class'=>'well'),
)); ?>

	<p class="help-block"><span class="required">*</span> işaretli alanlar boş bırakılamaz.</p>

	<?php echo $form->dropDownListRow($model,'email',array('all'=>'Tüm Yöneticiler', 'admin'=>'Baş Yöneticiler','staff'=>'Editörler'),array('empty'=>'Lütfen Bir Kullanıcı Grubu Seçiniz', 'class'=>'span5')); ?>
	
	<?php echo $form->textFieldRow($model,'subject',array('class'=>'span5','maxlength'=>100)); ?>

	<?php echo $form->labelEx($model,'body'); ?>
    <?php $this->widget(
        'ext.redactorjs.Redactor', array( 
            'lang'=>'tr',
            'model' => $model, 
            'attribute' => 'body' )); ?>
    <?php echo $form->error($model,'body'); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'size'=>'large',
			'label'=>'Gönder',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
