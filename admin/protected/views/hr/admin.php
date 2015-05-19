<?php
$this->breadcrumbs=array('İş Başvuruları'=>array('index'),'İş Başvurusu Listesi')
?>
<h1>İş Başvurusu listesi</h1>

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array('action'=>Yii::app()->createUrl($this->route),'method'=>'get',));  ?>
<div class="btn-group btn-raddip" style="margin-top:20px">
	<label for="filterlistcalled" class="btn btn-small"><strong>Sadece Değerlendirilenleri Göster</strong></label>
	<input id="filterlistcalled" type="submit" value="1" name="Hr[active]" style="display:none"/>
	<label for="filterlistcall" class="btn btn-small"><strong>Sadece Değerlendirilecekleri Göster</strong></label>
	<input id="filterlistcall" type="submit" value="0" name="Hr[active]" style="display:none"/>
</div>
<?php $this->endWidget();

$this->widget('bootstrap.widgets.TbExtendedGridView',array(
	'type'=>'striped bordered',
	'id'=>'totelephone-grid',
	'dataProvider'=>$model->search(),
	'columns'=>array(
		'id',
		'name',
		'email',
		'telephone',
		'referencepos',
		array(
            'name' => 'cv',
            'header' => 'CV Dosyası',
            'type' => 'raw',
            'value'=>array($this,'renderCV'), 
        ),
		array(
            'class'=>'bootstrap.widgets.TbToggleColumn',
            'toggleAction'=>'hr/toggle',
            'name' => 'active',
            'header' => 'Değerlendirildi mi?'
        ),
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>
