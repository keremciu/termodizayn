<?php
$this->breadcrumbs=array('Telefonlar'=>array('index'),'Biz sizi arayalım Listesi')
?>
<h1>Biz sizi arayalım listesi</h1>

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array('action'=>Yii::app()->createUrl($this->route),'method'=>'get',));  ?>
<div class="btn-group btn-raddip" style="margin-top:20px">
	<label for="filterlistcalled" class="btn btn-small"><strong>Sadece Arananları Göster</strong></label>
	<input id="filterlistcalled" type="submit" value="1" name="Totelephone[active]" style="display:none"/>
	<label for="filterlistcall" class="btn btn-small"><strong>Sadece Aranacakları Göster</strong></label>
	<input id="filterlistcall" type="submit" value="0" name="Totelephone[active]" style="display:none"/>
</div>
<?php $this->endWidget();

$this->widget('bootstrap.widgets.TbExtendedGridView',array(
	'type'=>'striped bordered',
	'id'=>'totelephone-grid',
	'dataProvider'=>$model->search(),
	'columns'=>array(
		'id',
		'project',
		'name',
		'email',
		'telephone',
		'inform',
		array(
            'class'=>'bootstrap.widgets.TbToggleColumn',
            'toggleAction'=>'totelephone/toggle',
            'name' => 'subscribe',
            'header' => 'Abonelik'
        ),
		array(
            'class'=>'bootstrap.widgets.TbToggleColumn',
            'toggleAction'=>'totelephone/toggle',
            'name' => 'active',
            'header' => 'Arandı mı?'
        ),
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>
