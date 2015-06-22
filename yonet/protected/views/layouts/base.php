<?php
	// main page and svg icons call
	$this->beginContent('//layouts/main');
	$this->renderPartial('/layouts/_svg_icons');
?>
<!-- Header -->
<header class="site-header">
	<!-- Topbar -->
	<div class="site-topbar">
		<div class="container">
			<!-- Logo -->
			<a href="index.php" class="site-logo" title="Termodizayn">
				<img src="../img/site-logo.png" width="217" alt="Termodizayn">
			</a>
			<!-- Userbox -->
			<div class="user-box dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
					<span class="user-box_name">Hoşgeldin, <?php echo Yii::app()->user->name; ?> <svg class="td-icon td-icon-arrow-drop-down"><use xlink:href="#icon-arrow-drop-down"></use></svg></span>
				</a>
				<ul class="dropdown-menu" role="menu">
					<li><a href="<?php echo Yii::app()->request->baseUrl.'/../'; ?>" target="_blank"><i class="icon-check"></i> Siteye Git</a></li>
					<li class="divider"></li>
					<li><a href="<?php echo Yii::app()->createUrl('user/updateyourself',array('id'=>Yii::app()->user->id)); ?>"><i class="icon-user"></i> Bilgileri Güncelle</a></li>
					<li><a href="<?php echo Yii::app()->createUrl('passwordchange/create'); ?>"><i class="icon-cog"></i> Şifre Yenile</a></li>
					<li class="divider"></li>
					<li><a href="<?php echo Yii::app()->createUrl('mail/create'); ?>"><i class="icon-envelope"></i> Toplu E-Posta Gönder</a></li>
					<li class="divider"></li>
					<li><a href="<?php echo Yii::app()->createUrl('site/logout'); ?>"><i class="icon-off"></i> Çıkış Yap</a></li>
				</ul>
			</div>
		</div>
	</div>
	<!-- Navbar -->
	<div class="site-navbar">
		<div class="container">
			<!-- Navigation -->
			<?php $this->getMenu(); ?>
		</div>
	</div>
</header>
<div class="site-content">
	<div class="container">
		<?php if(Yii::app()->user->hasFlash('success')):?>
		<div class="alert-wrapper">
			<div class="alert alert-success error info">
				<?php echo Yii::app()->user->getFlash('success'); ?>
			</div>
		</div>
		<?php endif; ?>
		<div class="main-area">
			<div id="content">
			<?php echo $content; ?>
			</div>
		</div>
		<div class="clear"></div>
	</div>
</div>
</div>
<?php $this->endContent(); ?>