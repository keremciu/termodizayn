<?php 

$criteria=new CDbCriteria;
$criteria->select='max(ordering) AS ordering';		
$row = $model->find($criteria); 	
$lastorder = $row['ordering']+1;

$orderdata = CHtml::listData($model->findAll(array('order' => 'ordering')),'ordering','fullName');
$orderinglist = CMap::mergeArray(array(0=>'0 İlk sırada'),$orderdata,array($lastorder=>$lastorder.' Son sırada'));

if ($model->isNewRecord) {
	$model->ordering = $lastorder;
}

$parent = array($model->parent=>"Daha önce tanımlanmış üst öğe");
?>

	<?php echo $form->errorSummary($model); ?>
	<p class="help-block"><span class="required">*</span> işaretli alanlar boş bırakılamaz.</p>

	<?php echo $form->dropDownListRow($model, 'type', array('content'=>'Haber Kategorisi','product'=>'Ürün Kategorisi'), array('empty'=>'Bu kategoriye tanımlanacak içeriğe göre içerik tipini seçiniz', 'class'=>'span5','ajax' => array('type'  => 'GET','url' => Yii::app()->createUrl('category/fixcategory'),'update' => '#Category_parent','data' => array('categorytype'=>'js:this.value')))); ?>

	<?php echo $form->dropDownListRow($model, 'parent', $parent, array('empty'=>'Üst öğe tanımlamadan önce İçerik Tipini seçmelisiniz', 'class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'title',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->hiddenField($model,'slug',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textAreaRow($model,'description',array('rows'=>2, 'cols'=>50, 'class'=>'span8')); ?>

	<?php echo $form->fileFieldRow($model,'image',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'icon',array('class'=>'span5','maxlength'=>255)); ?>

	<?php if ($model->isNewRecord)
		echo $form->dropDownListRow($model, 'ordering', $orderinglist, array('empty'=>'Lütfen bir sıralama seçiniz', 'class'=>'span5'));
	else 
		echo $form->dropDownListRow($model, 'ordering', $orderinglist, array('empty'=>'Lütfen bir sıralama seçiniz', 'class'=>'span5'));
	?>

	<?php echo $form->toggleButtonRow($model, 'is_published'); ?>

<?php
Yii::app()->getClientScript()->registerScript(
  'aliasmap',
  '
TURKCE_MAP = {
    "ÅŸ" : "s", "Ä±" : "i", "Ã¼" : "u", "ÄŸ" : "g", "Ã§" : "c", "ş" : "s", "ğ" : "g", "ı" : "i", "ü" : "u", "ö" : "o", "ç" : "c"
}

function slugify(text) {
    text = text.toLowerCase();
    for (var key in TURKCE_MAP) { text = text.replace(new RegExp(key, "g"), TURKCE_MAP[key]); }
    return text.replace(/\s+/g,"-").replace(/[^a-zA-Z0-9\-]/g,"");

}
$("#Category_title").attr("disabled","disabled").keyup(
    function(){
        cur_val = slugify($(this).val());
        $("#Category_slug").val(cur_val);
    }
).removeAttr("disabled")',
  CClientScript::POS_END
);