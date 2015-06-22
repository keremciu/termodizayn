<nav class="col-md-12 menu-tabs">
    <div class="row">
        <?php
        $form=$this->beginWidget('booster.widgets.TbActiveForm',array('action'=>Yii::app()->createUrl($this->route),'method'=>'get',));
        foreach ($languages as $key => $language) {
        ?>
        <label for="<?php echo $key; ?>lfilter" class="<?php echo (($key==$lang) ? 'isActive ' : ''); ?>menu-tabs_item"><?php echo $language; ?></label>
        <input id="<?php echo $key; ?>lfilter" type="submit" value="<?php echo $key; ?>" name="lang" style="display:none"/>
        <?php
        }
        $this->endWidget();
        ?>
    </div>
</nav>
<div class="main-area col-md-12 main-content main-content--full">
    <div class="form-section margin-reset">
        <?php
        echo CHtml::errorSummary($model);
        $form=$this->beginWidget('booster.widgets.TbActiveForm',array(
        'id'=>$model->tableName().'-form',
        'enableAjaxValidation'=>false,
        'htmlOptions'=>array('class'=>'', 'enctype'=>'multipart/form-data'),
    ));
        ?>
        <h1 class="form-section_title">SİTE AYARLARI</h1>
        <div class="form-section_content">
            <div class="clearfix">
                <ul class="menu-tabs" id="site-settings">
                    <?php
                    
                    $tabs = array();
                    $i = 0;
                    foreach ($model->attributes as $category => $values):?>
                    <a href="#<?php echo $category?>" class="menu-tabs_item<?php echo !$i?' isActive':''?>" data-toggle="tab"><?php echo ucfirst($category)?></a>
                    <?php
                    $i ++;
                    endforeach;?>
                </ul>
                <div class="tab-content main-area col-md-12 main-content main-content--full">
                    <?php
                    $i = 0;
                    foreach ($model->attributes as $category => $values):?>
                    <div class="tab-pane<?php echo !$i?' active':''?>" id="<?php echo $category?>">
                        <?php
                        $this->renderPartial('_system',array(
                            'model' => $model,
                            'values' => $values,
                            'category' => $category,
                            'lang' => $lang,
                            'languages'=>$languages
                        ));
                        ?>
                    </div>
                    <?php
                    $i ++;
                    endforeach;?>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="form-actions">
<?php 
    $this->widget('booster.widgets.TbButton', array(
            'buttonType'=>'submit',
            'encodeLabel'=>false,
            'context'=>'success',
            'htmlOptions'=>array(
                'data-form'=>$model->tableName().'-form'
            ),
            'label'=> '<svg class="td-icon td-icon-done"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-done"></use></svg> Ayarları Kaydet',
    ));
?>
</div>
<?php
    $this->endWidget();