<?php
$this->pageTitle=$news->title . ' — ' . ucfirst(strtolower($menu->name)) . ' — '. Yii::app()->name;
$this->breadcrumbs=array(
	'$news->title',
);
$url = Yii::getPathOfAlias('webroot') .'/images/news/'.$news->image;
$baseUrl = Yii::app()->request->hostInfo . Yii::app()->request->baseUrl . "/". Yii::app()->request->pathInfo;

?>
<?php if(is_file($url)){ ?>
<div class="imagecontainer">
	<div class="imagewrap">
		<img class="postimage" alt="<?php echo $news->title; ?>" src="<?php echo Yii::app()->baseUrl.'/images/news/'.$news->image; ?>" />
		<span class="postbg"></span>
	</div>
</div>
<?php } ?>
<div class="newconts">
	<div class="clip scene hidden headline">
		<div class="cliphead">
			<h1><?php echo $news->title; ?></h1>
			<p class="lead"><span><?php echo $news->description; ?></span></p>
			<p class="date"><i class="icon-time"></i><?php echo mb_strtoupper(Yii::app()->dateFormatter->format("dd MMMM, yyyy EEEE",$news->date),"UTF-8"); ?></p>
		</div>
	</div>
	<div class="clip newscontent">
		<div class="contentarea">
			<div class="newscontent newswrapper">
				<span class="readercursor animated"></span>
				<span class="readercursor reverse animated"></span>
				<?php echo $news->content; ?>
			</div>
		</div>
	</div>
</div>