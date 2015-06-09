<?php 

if ($model->isNewRecord) {
	$model->featured = 0;
	$model->author_id = Yii::app()->user->id;
}
$model->create_data = date("Y-m-d H:i:s");
$tags = $model->getAllTags();

$criteria=new CDbCriteria;
$criteria->select='max(ordering) AS ordering';		
$row = $model->find($criteria); 	
$lastorder = $row['ordering']+1;

if ($model->isNewRecord) {
	$model->ordering = $lastorder;
	$model->date = date("Y-m-d");
}

$olddate = $model->date;
$model->date = Yii::app()->dateFormatter->format("y-MM-dd",strtotime($olddate));
$time = Yii::app()->dateFormatter->format("hh:mm",strtotime($olddate));

$orderdata = CHtml::listData($model->findAll(array('order' => 'ordering')),'ordering','title');
$orderinglist = CMap::mergeArray(array(0=>'0 İlk sırada'),$orderdata,array($lastorder=>$lastorder.' Son sırada'));
?>
<div class="row">
	<?php echo $form->errorSummary($model); ?>
	<div class="col-md-6">
		<div class="form-group">
		<?php 
			echo $form->textFieldRow($model,'title',array('class'=>'form-control','maxlength'=>255)); 
			echo $form->hiddenField($model,'slug',array('class'=>'form-control','maxlength'=>255));
		?>
		</div>
		<div>
			<label for="tags" class="required">Etiket <span class="required">*</span></label>
			<?php 
				$this->widget('bootstrap.widgets.TbSelect2', array(
					'asDropDownList' => false,
					'name' => 'tags',
					'value' => $model->tags->toString(),
					'htmlOptions' => array(
						'class' => 'select2-control'
					),
					'options' => array(
						'tags' => $tags,
						'placeholder' => 'Lütfen haber ile ilgili etiket girin',
						'width' => '100%',
						'tokenSeparators' => array(',')
					)
				));	
			?>
		</div>
	</div>
	<div class="col-md-6">
		<?php echo $form->textAreaRow($model,'description',array('rows'=>2, 'cols'=>10, 'class'=>'form-control')); ?>
	</div>
</div>
	<div style="margin-top:20px;width:100%;overflow:hidden">
		<?php echo $form->redactorRow($model, 'content', array('class'=>'form-control', 'rows'=>5)); ?><br/><br/>
	</div>
<div class="row">
	<div class="col-md-6">
		<div class="form-group">
		<?php 
			echo $form->fileFieldRow($model,'image',array('class'=>'form-control','maxlength'=>255));
			echo "</div><div class='form-group'>".$form->dropDownListRow($model, 'category', CHtml::listData(Category::model()->findAll(array('order' => 'title')),'id','title'), array('empty'=>'Lütfen Bir Kategori Seçiniz', 'class'=>'form-control')); 
			echo "</div><div>";
			if ($model->isNewRecord)
				echo $form->dropDownListRow($model, 'ordering', $orderinglist, array('empty'=>'Lütfen bir sıralama seçiniz', 'class'=>'form-control'));
			else 
				echo $form->dropDownListRow($model, 'ordering', $orderinglist, array('empty'=>'Lütfen bir sıralama seçiniz', 'class'=>'form-control'));
		?>
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<?php echo $form->datepickerRow($model,'date',array('class'=>'span2')); ?>
		</div>
		<div class="form-group">
			<label for="time" class="required">Haber Saati <span class="required">*</span></label>
			<input class="span2" name="time" id="time" type="text" value="<?php echo $time; ?> pm">
		</div>
		<div>
		<?php 

			if (Yii::app()->user->role == "admin") {
				echo $form->toggleButtonRow($model, 'is_published');
			} else { ?>
				<input name="News[is_published]" id="News_is_published" value="0" type="hidden">
			<?php } ?>
		<div>
		<?php echo $form->hiddenField($model,'author_id',array('class'=>'span5')); ?>
		<?php echo $form->hiddenField($model,'create_data',array('class'=>'span5')); ?>
		<input name="News[is_deleted]" id="News_is_deleted" value="0" type="hidden">
	</div>
</div>
</div>
</div>
<p class="help-block"><span class="required">*</span> işaretli alanlar boş bırakılamaz.</p>
<?php 
Yii::app()->bootstrap->registerAssetCss('bootstrap-timepicker.css');
Yii::app()->bootstrap->registerAssetJs('bootstrap.timepicker.js');
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
$("#News_title").attr("disabled","disabled").keyup(
    function(){
        cur_val = slugify($(this).val());
        $("#News_slug").val(cur_val);
    }
).removeAttr("disabled");$(function() {$("#time").timepicker({defaultTime:"'. $time.'"}); });',
  CClientScript::POS_END
);
?>
