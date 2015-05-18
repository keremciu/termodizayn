<?php
$this->pageTitle=ucfirst(strtolower($menu->name)) . ' — '. Yii::app()->name;
$this->breadcrumbs=array(
	'$category->title',
);

?>
<div class="blogarea">
	<div class="clip">
		<div class="cliphead">
			<h1 class="subtitle"><?php echo $menu->name; ?></h1>
			<p><?php echo $category->description; ?></p>
		</div>
	</div>
	<div class="newscont module">
	   	<ul>
	   		<?php
	   		$count = 1;
	   		foreach ($news as $new) { 
	   			$url = Yii::getPathOfAlias('webroot') .'/images/news/'.$new->image;
	   			$link = Yii::app()->baseUrl . '/'. $alias. '/' . $new->slug;
	   		?>
	   		<li <?php if($count % 3 == 0) { echo 'class="last"'; }?>>
	   			<div class="news">
	   				<div class="imagearea">
	   					<a href="<?php echo $link; ?>">
	   						<?php if(is_file($url)){ ?>
	   							<img src="<?php echo Yii::app()->baseUrl.'/images/news/thumbs/min'.$new->image; ?>" alt="<?php echo $new->title; ?>" />
	   						<?php } else { ?>
								<img src="<?php echo Yii::app()->baseUrl.'/images/noimage.png'; ?>" alt="<?php echo $new->title; ?>" />
							<?php } ?>
	                    </a>
	                </div>
	                <div class="titlearea">
	                	<h2><a href="<?php echo $link; ?>"><?php if (strlen($new->title) > 75) { echo mb_substr($new->title, 0, 75,'UTF-8') . "..."; } else { echo $new->title; } ?></a></h2>
	                	<a href="<?php echo $link; ?>" class="leadtitle"><span><?php echo $new->description; ?></a>
	                	<p class="date"><a href="<?php echo $link; ?>"><?php echo mb_strtoupper(Yii::app()->dateFormatter->format("dd MMMM, yyyy EEEE",$new->date),"UTF-8"); ?></a></p>
	   				</div>
	            </div>
	        </li>
			<?php $count++; } ?>
	    </ul>
	</div><!-- News List -1 -->
</div>