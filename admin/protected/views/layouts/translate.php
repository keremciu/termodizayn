<?php 

$currentLang = Yii::app()->language;
$languages = Yii::app()->params->languages;

?>
<div class="tabs-left">
	<ul class="nav nav-tabs">
<?php
$k = 0;
foreach($languages as $key=>$lang) {
	if($key != $currentLang) {
?>
	<li<?php if ($k == 0) { echo ' class="active"'; } ?>><a data-toggle="tab" href="#tabthis<?php echo $key; ?>"><?php echo $lang; ?></a></li>
<?php
	 $k++;
	}
}
?>
	</ul>
	<div class="tab-content">
<?php
$i = 0;
foreach($languages as $key=>$lang) {
	if($key!=$currentLang) {

		$pri = $model->tableSchema->name;

		$clip = $pri::model()->language($key)->findByPk($model->id);
		
?>
	<div id="tabthis<?php echo $key; ?>" class="tab-pane fade <?php if ($i == 0) { echo "active in"; } ?>">
		<?php 

		$relation = $clip->owner->translationRelation;

		if (isset($clip->$relation)) {
			foreach ($clip->$relation as $es => $click) {
				if ($key == $click->lang_id) {
					$diff[$key.'_'.$es] = $click->value;
				}
			}
		}

		$attrs = $clip->owner->translationAttributes;

		foreach ($attrs as $attr) {
			if (!isset($diff[$key.'_'.$attr])) {
				$diff[$key.'_'.$attr] = "";
			}
		}

		?>
		<h3><?php echo $lang; ?> diline çeviri</h3>
		<?php echo $form->errorSummary($model); ?>
		<p class="help-block"><small><?php echo $lang; ?> diline çeviri yapmak istiyorsanız, lütfen aşağıdaki içeriğin çevirisini yaparak onaylayınız.</small></p>
		<?php

		foreach ($attrs as $type => $attr) {

			if ($attr=="slug") {
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
					$("#'."translate_title_".$key.'").attr("disabled","disabled").keyup(
					    function(){
					        cur_val = slugify($(this).val());
					        $("#'."translate_".$attr."_".$key.'").val(cur_val);
					    }
					).removeAttr("disabled");', CClientScript::POS_END); 
			}
			if (strpos($type,'area') !== false) {
				echo '<label for="translate_'.$attr.'_'.$key.'" class="required">'.$clip->getAttributeLabel($attr).'</label>';
				$value = ($diff[$key.'_'.$attr] == "") ? $model->$attr."'ı ". $lang ." diline çevirin" : $diff[$key.'_'.$attr];
				$this->widget('bootstrap.widgets.TbRedactorJs',['name' => 'translate['.$attr.'_'.$key.']','value' => $value]);
			} else {
				echo '<label for="translate_'.$attr.'_'.$key.'" class="required">'.$clip->getAttributeLabel($attr).'</label>';
				echo Chtml::textField('translate['.$attr.'_'.$key.']', $diff[$key.'_'.$attr],array('class'=>'form-control','placeholder'=>$model->$attr."'ı ". $lang ." diline çevirin"));
			}
		}
		?>
		<?php
		echo '<label for="publish_'.$key.'" class="required">Bu çeviriyi onaylıyorum</label>';
		$this->widget('bootstrap.widgets.TbToggleButton',
		    array(
		        'name' => 'publish_'.$key,
		        'onChange' => 'js:function($el, status, e){console.log($el, status, e);}',
		        'enabledLabel' => 'Evet',
        		'disabledLabel' => 'Hayır',
		    )
		);
	 ?>
	</div>
<?php 
		$i++;
	}
}