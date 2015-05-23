<?php
$this->pageTitle=Yii::app()->name . ' - Site Ayarları';
$this->breadcrumbs=array('Ayarlar'=>array('index'),'Site Ayarları')

?>
<h1>Site Ayarları</h1>
 
<?php 

	echo CHtml::errorSummary($model); 

	$form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array('action'=>Yii::app()->createUrl($this->route),'method'=>'get',)); 
		
		echo '<div class="btn-group btn-raddip" style="margin-top:20px">';
		
		foreach ($languages as $key => $language) {
			echo '<label for="'.$key.'lfilter" class="'.(($key==$lang) ? "active" : "").' btn btn-success">'.$language.' diline ait site ayarlarını göster</label>';
			echo '<input id="'.$key.'lfilter" type="submit" value="'.$key.'" name="lang" style="display:none"/>';
		}
		
		echo "</div>";
 	
 	$this->endWidget(); 

	echo CHtml::beginForm();
?>
<ul class="nav nav-tabs" id="site-settings">
<?php
 
$tabs = array();
$i = 0;
    foreach ($model->attributes as $category => $values):?>
        <li<?php echo !$i?' class="active"':''?>><a href="#<?php echo $category?>" data-toggle="tab"><?php echo ucfirst($category)?></a></li>
    <?php 
    $i ++;
    endforeach;?>
</ul>
    <div class="tab-content">
        <?php 
        $i = 0;
        foreach ($model->attributes as $category => $values):?>
            <div class="tab-pane<?php echo !$i?' active':''?>" id="<?php echo $category?>">
                <?php
                $this->renderPartial(
                        '_system',
                        array('model' => $model, 'values' => $values, 'category' => $category, 'lang' => $lang, 'languages'=>$languages)
                    );
                ?>
            </div>
        <?php 
        $i ++;
        endforeach;?>
    </div>
<?php
echo CHtml::submitButton('Kaydet', array('class' => 'btn'));
echo CHtml::endForm();