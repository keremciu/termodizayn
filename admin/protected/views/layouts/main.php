<!DOCTYPE html>
<html lang="tr-TR">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="language" content="tr-TR" />
		<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,500|Roboto+Condensed:400,300,700&subset=latin,latin-ext">
		<!--[if lt IE 8]>
		<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
		<![endif]-->
		<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
		<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title><?php echo CHtml::encode($this->pageTitle); ?></title>
		<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/default.css" />
		<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/exclude.css" />
	</head>
	<body>
	<?php $this->renderPartial('/layouts/_svg_icons'); ?>
		<div id="page">
			<?php if (!Yii::app()->user->isGuest){ ?>
		
			<!-- Header -->
			<header class="site-header">
				<!-- Topbar -->
				<div class="site-topbar">
					<div class="container">
						<!-- Logo -->
						<a href="index.php" class="site-logo" title="Termodizayn">
							<img src="../img/site-logo.png" width="210" alt="Termodizayn">
						</a>
						<!-- Userbox -->
						<div class="user-box dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
								<span class="user-box_name">Hoşgeldin, <?php echo Yii::app()->user->name; ?> <svg class="td-icon td-icon-arrow-drop-down"><use xlink:href="#icon-arrow-drop-down"></use></svg></span>
							</a>
							<ul class="dropdown-menu" role="menu">
								<li><a href="<?php echo Yii::app()->createUrl('user/admin'); ?>"><i class="icon-tasks"></i> Üyeleri Yönet</a></li>
								<li><a href="<?php echo Yii::app()->createUrl('user/updateyourself'); ?>"><i class="icon-user"></i> Bilgileri Güncelle</a></li>
								<li><a href="<?php echo Yii::app()->createUrl('passwordchange/create'); ?>"><i class="icon-cog"></i> Şifre Yenile</a></li>
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
						<?php $this->renderPartial('/layouts/_menu'); ?>
					</div>
				</div>
			</header>
		<?php } ?>
			<div class="site-content">
				<div class="container">
					<div class="breadandalert">
						<?php if(Yii::app()->user->hasFlash('success')):?>
						<div class="alert alert-success error info">
							<?php echo Yii::app()->user->getFlash('success'); ?>
						</div>
						<?php endif; ?>
					</div>
					<?php echo $content; ?>
					<div class="clear"></div>
				</div>
			</div>
		</div>
		<!-- page -->
	</body>
</html>