<?php

if ($menu->type=="taglist") {
	$category->title = $menu->name;
}

$this->pageTitle=ucfirst(strtolower($menu->name)) .' — '. Yii::app()->name;
$this->breadcrumbs=array(
	'$category->title',
);

?>
<div class="categoryarea">
	<div class="clip">
		<div class="cliphead">
			<h1 class="subtitle"><?php echo $category->title; ?></h1>
			<p><?php echo $category->description; ?></p>
		</div>
	</div>
	<div class="portfolio module">
	   	<ul>
	   		<?php
	   		$count = 1;
	   		foreach ($products as $product) {
	   			$url = Yii::getPathOfAlias('webroot') .'/images/products/product/'.$product->image;
	   		?>
	   		<li <?php if($count % 3 == 0) { echo 'class="last"'; }?>>
	   			<div class="item">
	   				<a href="<?php echo $alias. '/' . $product->slug; ?>">
		                <?php if(is_file($url)){ ?>
	   							<img src="<?php echo Yii::app()->baseUrl.'/images/products/product/'.$product->image; ?>" alt="<?php echo $product->title; ?>" />
	   						<?php } else { ?>
								<img src="<?php echo Yii::app()->baseUrl.'/images/noimage.png'; ?>" alt="<?php echo $product->title; ?>" />
							<?php } ?>
		                <div class="overlay">
		                  <summary><h2><?php echo $product->title; ?></h2><h3><?php echo $product->description; ?></h3></summary>
		                </div>
		            </a>
	            </div>
	        </li>
			<?php $count++; } ?>
	    </ul>
	</div><!-- News List -1 -->
</div>