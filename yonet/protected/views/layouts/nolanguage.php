<?php
	
	$currentLang = Yii::app()->language;
	$languages = Yii::app()->params->languages;

?>
<nav class="col-md-12 menu-tabs">
	<div class="row">
	<?php

		foreach  ($languages as $key=>$lang) {
			if($key!=$currentLang) {
				$class = "menu-tabs_item";
				$icon = '<svg class="td-icon icon--incomplete td-icon-check-box-outline-blank no-bg"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-check-box-outline-blank"></use></svg>';
				$href = "javascript:alert('Yabancı dil çevirisi eklemek için önce türkçe içeriği kaydetmelisiniz. Yani bu içeriği kaydettikten sonra listeleme ekranından bu içeriğin düzenleme ekranına geçiş yaparak dil çeviri işlemlerini yapabilirsiniz.');";
			} else {
				$class = "menu-tabs_item isActive";
				$icon = '';
				$href = 'javascript:;';
			}	
	?>
		<a class="<?php echo $class; ?>" title="<?php echo $lang; ?>" href="<?php echo $href; ?>"><?php echo $lang . ' ' . $icon; ?></a>
	<?php } ?>
	</div>
</nav>