<?php
$this->pageTitle=$menu->name . ' - '. Yii::app()->name;
$this->breadcrumbs=array(
	'$gallery->name',
);

?>
<div id="tabs" class="tabarea">
<?php 
foreach ($childmenus as $childmenu) { 
   echo '<a href="'.$childmenu->alias.'" '.(($menu->id==$childmenu->id) ? 'class="active"' : '') .'><span>'.$childmenu->name.'</span></a>';
}?>
</div>
   	<h2><?php echo $menu->name; ?></h2>
   	<p class="lead"><?php echo $gallery->desc; ?></p>
   	<div class="gallery">
   		<div class="pad">
   			<?php foreach($photos as $photo) { ?>
   			<a class="fancybox-thumb" rel="fancybox-thumb" href="<?php echo Yii::app()->baseUrl.'/images/photos/'.$photo->photo; ?>" title="<?php echo $photo->name; ?>">
   				<img src="<?php echo Yii::app()->baseUrl.'/images/photos/thumbs/min'.$photo->photo; ?>" alt="" />
   				<span><?php echo $photo->name; ?></span>
			   </a>
   			<?php } ?>
   		</div>
   		
   	</div>