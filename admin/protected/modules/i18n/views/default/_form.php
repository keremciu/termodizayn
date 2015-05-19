<div class="form">
    <?php $form = $this->beginWidget('CActiveForm', array('id' => 'source-message-form',)); ?>
    <p class="note"><?php echo Yii::t('App', 'Fields with <span class="required">*</span> are required.'); ?></p>
 
    <?php echo $form->errorSummary($model); ?>
 
    <fieldset>
        <div class="row">
            <div class="span5">
                <?php echo $form->labelEx($model, 'category'); ?>
                <?php echo $form->dropDownList($model, 'category', I18nModule::CategoryList()); ?>
                <?php echo $form->error($model, 'category'); ?>
            </div>
 
            <div class="span5">
                <?php echo $form->labelEx($model, 'message'); ?>
                <?php echo $form->textField($model, 'message', array('maxlength' => 128)); ?>
                <?php echo $form->error($model, 'message'); ?>
            </div>
        </div>
    </fieldset>
    <?php foreach ($messages as $i => $message): ?>
        <fieldset>
            <legend>
                <?php echo CHtml::activeLabelEx($message, "[$i]language"); ?>
                <strong>&nbsp;<?php echo Message::LanguageList($i); ?></strong>
            </legend>
            <div class="row">
                <?php echo $form->labelEx($message, "[$i]translation"); ?>
                <?php echo $form->textArea($message, "[$i]translation", array('rows' => 6, 'cols' => 50)); ?>
                <?php echo $form->error($message, "[$i]translation"); ?>
            </div>
        </fieldset>
    <?php endforeach; // $message     ?>
 
    <div class="row buttons">
        <?php echo CHtml::submitButton(Yii::t('App', 'Save')); ?>
        <?php if (!$model->isNewRecord) : ?>
            <?php
            echo CHtml::link(Yii::t('App', 'Delete'), '#', array(
                'submit' => array('delete', 'id' => $model->id),
                'confirm' => Yii::t('App', 'Are you sure to delete this item?'),
                // if you have enabled CsrfValidation add this line
                'params' => array('reg' => 'new', 'YII_CSRF_TOKEN' => Yii::app()->request->csrfToken),
                'class' => 'right',
                'title' => Yii::t('App', 'Delete'),
            ));
            ?>
        <?php endif; // isNewRecord ?>
    </div>
    <?php $this->endWidget(); ?>
</div><!-- form -->