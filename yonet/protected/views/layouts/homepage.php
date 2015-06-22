<?php
	$this->beginContent('//layouts/main');
	$this->renderPartial('/layouts/_svg_icons');
?>
<div class="homepage">
	<!-- Header -->
	<header class="site-header">
		<!-- Topbar -->
		<div class="site-topbar">
			<div class="container">
				<!-- Logo -->
				<a href="index.php" class="site-logo" title="Termodizayn">
					<img src="../img/site-logo.png" width="217" alt="Termodizayn">
				</a>
			</div>
		</div>
		<!-- Navbar -->
	</header>
	<div id="content" class="container">
		<?php echo $content; ?>
	</div>
	<!-- Content -->
	<?php $this->endContent(); ?>
</div>