<?php
    $attribs = ProductAttrib::model()->findAll(array('condition'=>'container = "model"','order'=>'ordering'));
?>
<div class="form-section">
    <h1 class="form-section_title">TEKNİK BİLGİLER</h1>
    <div class="form-section_content">
        <div class="alert alert-warning">
            Bu ürünün tüm modellerinde aynı olan teknik özellikleri ekleyiniz. Model eklerken bu özellikler otomatik tanımlanacaktır.
        </div>
        <div class="row">
            <div class="col-md-4">
                <label for="">Özellik</label>
            </div>
            <div class="col-md-4">
                <label for="">Değer</label>
            </div>
            <div class="col-md-2">
                <label for="">Listede Göster</label>
            </div>
            <div class="col-md-2">
                <label for="">Kontrol</label>
            </div>
        </div>
        <!-- Sortable -->
        <div id="sortable-tecnical-info" class="sortable sortable--list-show">
            <?php 
                // Check update function
                if (!$model->isNewRecord) {
                    // Get Product Attributes
                    $savedattribs = ModelAttribMap::model()->findAll(array('condition'=>'model_id='.$model->id));

                    if (is_array($savedattribs)) {
                        foreach ($savedattribs as $key => $attrib) {
                            ?>
            <div class="aspecification form-group bordered">
                <div class="row old-specification">
                    <div class="col-md-4">
                        <select name="update-spec[<?php echo $attrib->id; ?>]" class="attrib-select form-control">
                            <?php
                            foreach ($attribs as $key => $attr) {
                                $class = "";
                                if ($attrib->attrib->id == $attr->id)
                                    $class = 'selected="selected"';
                                echo '<option value="'.$attr->id.'" data-prefix="'.$attr->prefix.'" '.$class.'>'.$attr->title.'</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-md-4">
                    <?php
                            if (strlen($attrib->attrib->prefix) > 0) {
                                echo '<div class="input-group"><input type="text" name="update-spec-value-'.$attrib->id.'" class="aspecification-value form-control" value="'.$attrib->value.'"><span class="input-group-addon">'.$attrib->attrib->prefix.'</span></div>';
                            } else if ($key==0) {
                                echo '<input type="text" name="update-spec-value-'.$attrib->id.'" class="aspecification-value form-control" value="'.$attrib->value.'">';
                            }
                    ?>
                    </div>
                    <div class="col-md-2">
                        <input type="checkbox" name="update-show-on-list-<?php echo $attrib->id; ?>" value="1" <?php echo ($attrib->on_list == 1) ? 'checked' : ''; ?>>
                    </div>
                    <div class="col-md-2">
                        <input type="hidden" name="update-specification-ordering-<?php echo $attrib->id; ?>" value="<?php echo $attrib->id; ?>" class="aspecification-order">
                        <div class="sortable-button sortable-button_drag">
                            <svg class="td-icon td-icon-swap-vert"><use xlink:href="#icon-swap-vert"></use></svg>
                        </div>
                        <div class="sortable-button sortable-button_remove savedattrdelete">
                            <a href="<?php echo Yii::app()->createUrl('productmodel/attrdelete'); ?>" rel="<?php echo $attrib->id; ?>" target="_blank">
                                <svg class="td-icon td-icon-cancel"><use xlink:href="#icon-cancel"></use></svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
                            <?php
                        }

                    }

                }
            ?>
            <!-- Template - Specifications -->
            <script id="template-specifications" type="text/x-handlebars-template">
            <div class="aspecification form-group bordered">
                <div class="row new-specification">
                    <div class="col-md-4">
                        <select name="select-specifications[attr_{{key}}]" class="attrib-select form-control">
                            <?php
                            foreach ($attribs as $key => $attrib) {
                                echo '<option value="'.$attrib->id.'" data-prefix="'.$attrib->prefix.'">'.$attrib->title.'</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-md-4">
                    <?php
                            foreach ($attribs as $key => $attrib) {
                                if ($key == 0 AND strlen($attrib->prefix) > 0) {
                                    echo '<div class="input-group"><input type="text" name="specification-value-{{key}}" class="aspecification-value form-control"><span class="input-group-addon">'.$attrib->prefix.'</span></div>';
                                } else if ($key==0) {
                                    echo '<input type="text" name="specification-value-{{key}}" class="aspecification-value form-control">';
                                }
                            }
                    ?>
                    </div>
                    <div class="col-md-2">
                        <input type="checkbox" name="show-on-list-{{key}}" value="1">
                    </div>
                    <div class="col-md-2">
                        <input type="hidden" name="specification-ordering-{{key}}" value="{{ key }}" class="aspecification-order">
                        <div class="sortable-button sortable-button_drag">
                            <svg class="td-icon td-icon-swap-vert"><use xlink:href="#icon-swap-vert"></use></svg>
                        </div>
                        <div class="sortable-button sortable-button_remove">
                            <svg class="td-icon td-icon-cancel"><use xlink:href="#icon-cancel"></use></svg>
                        </div>
                    </div>
                </div>
            </div>
            </script>
        </div>
        <div class="form-group bordered button">
            <button type="button" class="btn btn-default" data-template="specifications">
            <svg class="td-icon td-icon-control-point-duplicate"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-control-point-duplicate"></use></svg>
            </button>
        </div>
        
    </div>
</div>