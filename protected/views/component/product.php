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
				<div class="share-content">
					<div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>