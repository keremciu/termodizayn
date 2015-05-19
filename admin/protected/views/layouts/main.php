<!DOCTYPE html>
<html lang="tr-TR">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="tr-TR" />
	<!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/custom.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>
<body>
<div class="container" id="page">
	<?php
	if (!Yii::app()->user->isGuest){
		$menutypes = Menutypes::model()->findAll();
		$items = array();
		foreach ($menutypes as $item) {
			$new = array();
			$new["label"]=$item->title;
			$new["url"]=array('/menu/index','Menu[menutype]'=>$item->menutype);
			array_push($items,$new);
		}

		$totelephone = Totelephone::model()->findAll(array('condition'=>'active=0'));
		if (count($totelephone) > 0) {
			$telephonesays = " (".count($totelephone).")";
		} else {
			$telephonesays = "";
		}

		$hr = Hr::model()->findAll(array('condition'=>'active=0'));
		if (count($hr) > 0) {
			$hrsays = " (".count($hr).")";
		} else {
			$hrsays = "";
		}

	 $this->widget('bootstrap.widgets.TbNavbar', array(
	    'type'=>'inverse',
	    'brand'=>'TD',
	    'brandUrl'=>array('/site/index'),
	    'collapse'=>true,
	    'items'=>array(
	        array(
	            'class'=>'bootstrap.widgets.TbMenu',
	            'items'=>array(
	            	array('label'=>'Slider', 'url'=>array('/photos/index')),
	            	array('label'=>'Partner', 'url'=>array('/photos/index')),
	            	array('label'=>'Referans', 'url'=>array('/photos/index')),
	            	array('label'=>'Haber', 'url'=>array('/news/index')),
	            	array('label'=>'Katalog', 'url'=>array('/category/index')),
	            	array('label'=>'Ürün', 'url'=>array('/product/index')),
	            	array('label'=>'Firma', 'url'=>array('/photos/index')),
	            	array('label'=>'Sayfa', 'url'=>array('/menu/index'),
	                	'items'=>$items,
	                ),
	            	array('label'=>'Çeviri', 'url'=>array('/translates/index')),
	            	array('label'=>'Teklif', 'url'=>array('/photos/index')),
	            	array('label'=>'Üye', 'url'=>array('/user/index')),
	            	array('label'=>'Bayi', 'url'=>array('/user/index')),
	            ),
	        ),
	        array(
	            'class'=>'bootstrap.widgets.TbMenu',
	            'htmlOptions'=>array('class'=>'pull-right'),
	            'items'=>array(
	            		array('label'=>'Siteye Git', 'icon'=>'check', 'url'=>Yii::app()->request->baseUrl.'/../','linkOptions' => array('target'=>'_blank')),
						array('label'=>'Hoşgeldin, '.Yii::app()->user->name, 'url'=>'#', 'items'=>array(
							array('label'=>'Kullanıcıları Yönet', 'icon'=>'tasks', 'url'=>array('/user/admin')),
							array('label'=>'Bilgileri Güncelle', 'icon'=>'user', 'url'=>array('/user/updateyourself','id'=>Yii::app()->user->id)),
							array('label'=>'Şifre Değiştir', 'icon'=>'cog', 'url'=>array('/passwordchange/create')),
							array('label'=>'Toplu Mail Gönder', 'icon'=>'icon-envelope', 'url'=>array('/mail/create')),
							'---',
							array('label'=>'Çıkış', 'icon'=>'icon-off', 'url'=>array('/site/logout')),
	                ), 'visible'=>!Yii::app()->user->isGuest ),
	            ),
	        ),
	    ),
));
}
?>
	<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('bootstrap.widgets.TbBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif?>
	<?php if(Yii::app()->user->hasFlash('success')):?>
    <div class="alert alert-success error info">
        <?php echo Yii::app()->user->getFlash('success'); ?>
    </div>
<?php endif; ?>
	<?php echo $content; ?>
	<div class="clear"></div>
</div><!-- page -->
</body>
</html>