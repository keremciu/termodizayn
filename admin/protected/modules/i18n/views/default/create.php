<?php
$this->breadcrumbs = array(
    Yii::t('App', 'Templates') => array('index'),
    Yii::t('App', 'Create'),
);
?>
<div class="right">
    <?php echo CHtml::link(Yii::t('App', 'Back to Overview'), array('index')); ?>
</div>
<h1><?php echo Yii::t('App', 'Create Template'); ?></h1>
 
<?php echo $this->renderPartial('_form', array('model' => $model, 'messages' => $messages)); ?>