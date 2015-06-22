<!DOCTYPE html>
<html lang="tr-TR">
	<?php // Head calls in components/controller.php - init function ?>
	<head><title><?php echo CHtml::encode($this->pageTitle); ?></title></head>
	<body>
		<div id="page">
			<?php echo $content; ?>
			<div class="clear"></div>
			<!-- page -->
		</div>
	</body>
</html>