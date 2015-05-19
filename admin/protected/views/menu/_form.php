<?php

$list = $this->getList();

$criteria=new CDbCriteria;
$criteria->select='max(ordering) AS ordering';		
$row = $model->find($criteria); 	
$lastorder = $row['ordering']+1;

$orderdata = CHtml::listData($model->findAll(array('order' => 'ordering')),'ordering','name');
$menulist = CMap::mergeArray(array(0=>'Alt menü değil'),$list);

$typesid = array($model->types_id=>"Daha önce tanımlanmış özel içerik");
if ($model->isNewRecord) {
	$model->is_home = 0;
	$model->browsernav = 1;
	$model->ordering = $lastorder;
	$typesid=array();
}
$orderinglist = CMap::mergeArray(array(0=>'0 İlk sırada'),$orderdata,array($lastorder=>$lastorder.' Son sırada'));
$menutypes = 
	array(
		'frontpage'=>'Anasayfa',
		'link'=>'Bağlantı',
		'content'=>'Tek Yazı',
		'blog'=>'Yazı Listesi - Blog',
		'project'=>'Yazı Listesi - Proje',
		'subcatlist'=>'Alt Kategoriler altındaki projeler',
		'categorylist'=>'Proje listesi',
		'taglist'=>'Etikete gore projeler',
		'gallery'=>'Tek Galeri',
		'allgallery'=>'Galeri Listesi',
		'hr'=>'İnsan Kaynakları Formu',
		'totelephone'=>'Biz Sizi Arayalım Formu',
		'contact'=>'İletişim'
	);
?>

	<?php echo $form->errorSummary($model); ?>
	<p class="help-block"><span class="required">*</span> işaretli alanlar boş bırakılamaz.</p>
	<?php
	
	echo $form->dropDownListRow($model, 'menutype', CHtml::listData(Menutypes::model()->findAll(array('order' => 'menutype')),'menutype','menutype'), array('empty'=>'Lütfen bir menütipi seçiniz', 'class'=>'span5'));

	echo $form->textFieldRow($model,'name',array('class'=>'span5','maxlength'=>255));

	echo $form->textFieldRow($model,'alias',array('class'=>'span5','maxlength'=>255));

	echo $form->dropDownListRow($model, 'type', $menutypes, array('empty'=>'Lütfen bir tür seçiniz', 'class'=>'span5 typearea','ajax' => array('type'  => 'GET','url' => Yii::app()->createUrl('menu/fixtypeid'),'update' => '#Menu_types_id','data' => array('menutype'=>'js:this.value'))));

	echo $form->dropDownListRow($model, 'types_id', $typesid, array('labelOptions' => array('class' => "typeidlabel typeidarea"),'empty'=>'Öncelikle Menü Türünü seçmelisiniz', 'class'=>'span5 typeidarea'));

	echo $form->textFieldRow($model,'link',array('labelOptions' => array('class' => "linklabel linkarea","style"=>"display:none"),'class'=>'span5 linkarea','style'=>'display:none','maxlength'=>255));

	if ($model->isNewRecord)
		echo $form->dropDownListRow($model, 'ordering', $orderinglist, array('empty'=>'Lütfen bir sıralama seçiniz', 'class'=>'span5'));
	else 
		echo $form->dropDownListRow($model, 'ordering', $orderinglist, array('empty'=>'Lütfen bir sıralama seçiniz', 'class'=>'span5'));
	
	echo $form->dropDownListRow($model, 'parent', $menulist, array('class'=>'span5'));

	echo $form->dropDownListRow($model, 'browsernav', array('1'=>'Direkt sayfaya git','2'=>'Sayfayı ayrı bir sekmede görüntüle','3'=>'Sayfayı popup kullanarak görüntüle'), array('empty'=>'Lütfen bir açılma türü seçiniz','class'=>'span5'));

	echo $form->hiddenField($model,'is_home',array('class'=>'span5'));

	echo $form->toggleButtonRow($model, 'is_published'); ?>


<?php

Yii::app()->clientScript->registerScript('typechange','
	
	$(".typearea").change(function() {
		if ($(this).val() == "link") {
			$(".linkarea").show();
			$(".typeidarea").hide();
		} else {
			$(".linkarea").hide();
			$(".typeidarea").show();
		}

	});
	',CClientScript::POS_END);
?>
