<?php

if ($menu->type=="taglist") {
	$category->title = $menu->name;
}

$this->pageTitle=ucfirst(strtolower($menu->name)) .' — '. Yii::app()->name;
$this->breadcrumbs=array(
	'$category->title',
);

?>
<div id="exhibits" class="scene hidden">
		<div class="tabarea">
			<h3 class="top-lines"><?php echo $category->title; ?></h3>
			<ul class="exhibithistories">
				<li class="active"><a href="javascript:;" data-filter="0"><?php echo Yii::t('strings','Tümü'); ?></a></li>
				<?php

					$cats = Category::model()->findAll(array('condition'=>'parent = :id','params'=>array(':id'=>$menu->types_id)));
					foreach ($cats as $key => $cat) {

				?>
				<li><a href="javascript:;" data-filter="<?php echo $cat->title; ?>"><?php echo $cat->title; ?></a></li>
				<?php } ?>
			</ul>
			<div class="exlist"></div>
		</div
</div>
<div id="content" class="worklist">
	<div class="scene hidden">
		<div class="works">
			<?php
			$i = 1;
				foreach ($products as $key => $product) {
					$url = Yii::getPathOfAlias('webroot') .'/images/products/product/'.$product->image;
				?>
				<div class="item <?php echo $product->category0->title; if ($i % 4 == 2){ echo "last"; } ?>">
					<div class="itempic">
						<a href="<?php echo $alias. '/' . $product->slug; ?>">
							<?php if(is_file($url)){ ?>
							<img src="<?php echo Yii::app()->baseUrl.'/images/products/product/'.$product->image; ?>" alt="<?php echo $product->title; ?>" />
							<?php } else { ?>
							<img src="<?php echo Yii::app()->baseUrl.'/images/noimage.png'; ?>" alt="<?php echo $product->title; ?>" />
							<?php } ?>
						</a>
					</div>
					<div class="itemtitle">
						<h3><a href="<?php echo $alias. '/' . $product->slug; ?>"><?php echo $product->title; ?></h2></a></h3>
						<p class="top-lines"><a href="<?php echo $alias. '/' . $product->slug; ?>"><?php echo $product->description; ?></a></p>
					</div>
				</div>
			<?php $i++; } ?>
		</div>
	</div>
</div>