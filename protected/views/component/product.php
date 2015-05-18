<?php
$this->pageTitle=ucfirst(strtolower($product->title)) . ' - ' . ucfirst(strtolower($menu->name)) . ' - '. Yii::app()->name;
$this->breadcrumbs=array(
	'$product->title',
);
$baseUrl = Yii::app()->request->hostInfo . Yii::app()->request->baseUrl . "/". Yii::app()->request->pathInfo;
?>
<div class="titlearea">
	<div class="clip scene hidden">
		<div class="cliphead">
			<h1 class="subtitle"><?php echo $product->title; ?></h1>
		</div>
		<div class="lead"><span><?php echo $product->intro; ?></span></div>
	</div>
</div>
<div class="navto clearfix">
	<?php
		$criteria = new CDbCriteria;
		$criteria->condition = 't.ordering < '.$product->ordering;
		$criteria->order = 't.ordering DESC';
		$prev = Product::model()->findByAttributes(array(
		'is_published' => 1,
		), $criteria);
		$criteria->condition = 't.ordering > '.$product->ordering;
		$criteria->order = 't.ordering ASC';
		$next = Product::model()->findByAttributes(array(
		'is_published' => 1,
		), $criteria);
		$menu=Menu::model()->findByAttributes(array('alias'=>"sergiler"));
	?>
	<a href="javascript:;" class="views fullview"><?php echo Yii::t('strings','Dikey Listele'); ?></a>
	<a href="javascript:;" class="views corsetview"><?php echo Yii::t('strings','Yatay Listele'); ?></a>
	<?php if (isset($next)) {?>
	<a href="<?php echo Yii::app()->baseUrl.  "/".$menu->alias."/".$next->slug; ?>" class="nextwork"><?php echo Yii::t('strings','SONRAKİ'); ?> <i class="fa fa-chevron-right"></i><span><?php echo $next->title; ?></span></a>
	<?php } else { ?>
	<a href="javascript:;" class="last disabled nextwork"><?php echo Yii::t('strings','SONRAKİ'); ?> <i class="fa fa-chevron-right"></i></a>
	<?php } ?>
	<?php if (isset($prev)) {?>
	<a href="<?php echo Yii::app()->baseUrl. "/".$menu->alias."/".$prev->slug; ?>" class="prevwork first"><i class="fa fa-chevron-left"></i> 
		<?php echo Yii::t('strings','ÖNCEKİ'); ?><span><?php echo $prev->title; ?></span></a>
	<?php } else { ?>
	<a href="javascript:;" class="prevwork first disabled"><i class="fa fa-chevron-left"></i> <?php echo Yii::t('strings','ÖNCEKİ'); ?></a>
	<?php } ?>
</div>
<div class="categoryarea nontitle">
	<div class="projectarea">
		<div class="descsarea projectinfos">
			<div class="complist">
				<div class="aboutproject">
					<div class="projectcontent"><?php echo trim(preg_replace("#(^(&nbsp;|\s)+|(&nbsp;|\s)+$)#", "", $product->content)); ?></div>
				</div>
				<div class="projectactions">
					<?php foreach ($files as $file) { ?>
					<div class="client-logo">
						<img class="intohtml" src="<?php echo Yii::app()->baseUrl.'/images/products/product/documents/'.$file->path; ?>" />
					</div>
					<?php } ?>
					<?php foreach ($videos as $video) { ?>
					<a href="<?php echo $video->path; ?>" class="primary-link" target="_blank">SEE IT <span>LIVE</span><i class="fa fa-angle-double-right"></i></a>
					<?php } ?>
				</div>
			</div>
			<div class="projectimages">
				<div class="imagelist">
					<?php foreach ($images as $image) {
						if (is_file(Yii::getPathOfAlias('webroot') .'/images/products/product/extras/'.$image->path)) {
							$titles = explode("%%", $image->name);
					?>
					<section class="card">
						<div class="item-prev">
							<h2><?php echo $titles[0]; ?></h2>
							<?php if (isset($titles[1])) { ?>
							<p><?php echo $titles[1]; ?></p>
							<?php } ?>
							<div class="item-image">
								<a href="<?php echo Yii::app()->baseUrl.'/images/products/product/extras/'.$image->path; ?>" class="productimage" rel="gallery<?php echo $product->id; ?>">
									<img src="<?php echo Yii::app()->baseUrl.'/images/products/product/extras/'.$image->path; ?>" alt="<?php echo $image->name; ?>" />
								</a>
							</div>
						</div>
					</section>
					<?php }
					} ?>
				</div>
			</div>
		</div>
		<div class="project-nav">
			<div class="sharearea">
				<p class="sharetitle mintitle"><?php echo Yii::t('strings','Projeyi Paylaş'); ?></p>
				<div class="share-content">
					<div>
						<div class="content-style-social">
							<a class="twitter" target="_blank" href='https://twitter.com/share?url=<?php echo $baseUrl; ?>&related=keremciu&text=<?php echo $product->title . " - " . $product->description . " via suzyhuglevy.com";?>'><i class="fa fa-twitter-square"></i> <span><?php echo Yii::t('strings','Twitterda Paylaş'); ?></span></a>
							<a class="facebook" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $baseUrl; ?>"><i class="fa fa-facebook-square"></i> <span><?php echo Yii::t('strings','Facebookta Paylaş'); ?></span></a>
							<a class="googleplus" target="_blank" href="https://plus.google.com/share?url=<?php echo $baseUrl; ?>"><i class="fa fa-google-plus-square"></i> <span><?php echo Yii::t('strings','Google Plusta Paylaş'); ?></span></a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>