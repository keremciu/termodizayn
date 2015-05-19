<?php
$this->breadcrumbs = array(
    Yii::t('App', 'Templates') => array('index'),
    Yii::t('App', 'Manage'),
);
?>
<div class="right">
    <?php
    echo CHtml::link(Yii::t('App', 'New'), array('create'), array(
        'title' => Yii::t('App', 'Create New Item'),
        'id' => 'create-new-item',
    ));
    ?>
</div>
<h1><?php echo Yii::t('App', 'Manage Templates'); ?></h1>
<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'source-message-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
        array(
            'name' => 'category',
            'filter' => I18nModule::CategoryList(),
        ),
        array(
            'name' => 'message',
        ),
        array(
            'name' => 'Messages.translation',
            'value' => '$data->translation',
        ),
        array(
            'class' => 'CButtonColumn',
            'template' => '{update}{delete}',
        ),
    ),
));
?>