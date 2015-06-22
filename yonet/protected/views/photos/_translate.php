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

		$clip = Photos::model()->language($key)->findByPk($model->id);
		
?>
	<div id="tabthis<?php echo $key; ?>" class="tab-pane fade <?php if ($i == 0) { echo "active in"; } ?>">
		<?php 

			foreach ($clip->translates as $es => $click) {
				if ($key == $click->lang_id) {
					$diff[$key.'_'.$es] = $click->value;
				}
			}

			if (!isset($diff[$key.'_name'])) {
				$diff[$key.'_name'] = "";
			}
			if (!isset($diff[$key.'_url'])) {
				$diff[$key.'_url'] = "";
			}
			if (!isset($diff[$key.'_desc'])) {
				$diff[$key.'_desc'] = "";
			}

			Yii::app()->clientScript->registerScript('types'.$key,'
				jQuery("#translate_desc_'.$key.'").redactor({"lang":"tr"});
			');

		?>
		<h3><?php echo $lang; ?> diline çeviri</h3>
		<?php echo $form->errorSummary($model); ?>
		<p class="help-block"><small><?php echo $lang; ?> diline çeviri yapmak istiyorsanız, lütfen aşağıdaki içeriğin çevirisini yaparak onaylayınız.</small></p>
		<?php
		echo '<label for="translate_name_'.$key.'" class="required">Adı</label>';
		echo Chtml::textField('translate[name_'.$key.']', $diff[$key.'_name'],array('placeholder'=>$model->name."'ı ". $lang ." diline çevirin"));
		echo '<label for="translate_url_'.$key.'" class="required">Bağlantı</label>';
		echo Chtml::textField('translate[url_'.$key.']', $diff[$key.'_url'],array('placeholder'=>$model->url."'ı ". $lang ." diline çevirin"));
		echo '<label for="translate_desc_'.$key.'" class="required">İçerik</label>';
		?>	
		<div style="width:100%;overflow:hidden">
		<?php echo Chtml::textArea('translate[desc_'.$key.']',$diff[$key.'_desc'],array('placeholder'=>$model->desc." içeriğini ".$lang." diline çevirin","rows"=>5,"cols"=>5)); ?>
		</div>
		<?php
		echo '<label for="Menu_name" class="required">Bu çeviriyi onaylıyorum</label>';
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

	echo "</div>";
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
