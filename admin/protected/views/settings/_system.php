<?php foreach ($values as $key => $val): ?>
    <div class="control-group">
        <?php 

        echo CHtml::label($model->getAttributesLabels($key), $key); 

            if($key === 'ssl')
                echo CHtml::checkBox(get_class($model) . '[' . $category . '][' . $key . ']', $val); 
            else 
                echo CHtml::textField(get_class($model) . '[' . $category . '][' . $key . '][lang_'.$lang.']', $val, array('class'=>'input-xxlarge')); 
 
            echo CHtml::error($model, $category); 
        ?>
    </div>
<?php endforeach; ?>