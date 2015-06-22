<?php
$currentLang = Yii::app()->language;
$languages = Yii::app()->params->languages;
$i = 0;
foreach($languages as $key=>$lang) {
	if($key!=$currentLang) {
		$clip = $model->language($key)->findByPk($model->id);
?>
<div id="tabthis<?php echo $key; ?>" class="tab-pane fade">
	<div class="main-area col-md-12 main-content main-content--full">
		<div class="form-section margin-reset">
			<h1 class="form-section_title"><?php echo $lang; ?> Diline Çeviri</h1>
			<div class="form-section_content">
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
				<?php echo $form->errorSummary($model); ?>
				<p class="help-block"><small><?php echo $lang; ?> diline çeviri yapmak istiyorsanız, lütfen aşağıdaki içeriğin çevirisini yaparak onaylayınız.</small></p>
				<?php
				foreach ($attrs as $type => $attr) {
					echo '<div class="form-group">';
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
							$this->widget('booster.widgets.TbRedactorJs',['name' => 'translate['.$attr.'_'.$key.']','value' => $value]);
						} else {
							echo '<label for="translate_'.$attr.'_'.$key.'" class="required">'.$clip->getAttributeLabel($attr).'</label>';
							echo Chtml::textField('translate['.$attr.'_'.$key.']', $diff[$key.'_'.$attr],array('class'=>'form-control','placeholder'=>$model->$attr."'ı ". $lang ." diline çevirin"));
						}
					echo '</div>';
				}
					
					echo '<label for="publish_'.$key.'" class="required">Bu çeviriyi onaylıyorum</label><div>';
						$this->widget('booster.widgets.TbSwitch',
							array(
								'name' => 'publish_'.$key,
							)
						);
					echo '</div>';
				?>
			</div>
		</div>
	</div>
</div>
<?php
		$i++;
	}
}