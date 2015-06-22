<?php foreach ($values as $key => $val): ?>
    <div class="col-md-6">
        <div class="form-group">
            <?php 

            echo CHtml::label($model->getAttributesLabels($key), $key); 

            echo "<div>";
                if($key === 'smtpauth')
                    echo CHtml::checkBox(get_class($model) . '[' . $category . '][' . $key . ']', $val); 
                else
                    echo CHtml::textField(get_class($model) . '[' . $category . '][' . $key . '][lang_'.$lang.']', $val, array('class'=>'form-control')); 
     
                echo CHtml::error($model, $category); 
            echo "</div>";
            ?>
        </div>
    </div>
<?php endforeach; ?>