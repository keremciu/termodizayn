<?php
	
	$currentLang = Yii::app()->language;
	$languages = Yii::app()->params->languages;

?>
<nav class="col-md-12 menu-tabs">
	<div class="row">
	<?php

		foreach  ($languages as $key=>$lang) {
			$href = "#tabthis".$key;
			if($key!=$currentLang) {
				$class = "menu-tabs_item";
				$icon = '<svg class="td-icon icon--incomplete td-icon-check-box-outline-blank no-bg"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-check-box-outline-blank"></use></svg>';
			} else {
				$class = "menu-tabs_item isActive";
				$icon = '';
			}	
	?>
		<a class="<?php echo $class; ?>" data-toggle="tab" title="<?php echo $lang; ?>" href="<?php echo $href; ?>"><?php echo $lang . ' ' . $icon; ?></a>
	<?php } ?>
	</div>
</nav>
<div class="tab-content">
	<div id="tabthis<?php echo $currentLang; ?>" class="tab-pane fade active in">