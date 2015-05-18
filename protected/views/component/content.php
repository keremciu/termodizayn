<?php
$this->pageTitle=ucfirst(strtolower($menu->name)) . ' — '. Yii::app()->name;
$this->breadcrumbs=array(
	'$content->title',
);

$cv_cats = Timeline_cat::model()->findAll();
$cv = "";

foreach($cv_cats as $cat) {
	$cv .= "<h3 class='tcat'>".$cat->title."</h3>";
	$cv .= "<ul class='tlist'>";
	foreach ($cat->timeline as $timeline) {
		$cv .= "<li><em class='tdate'>".$timeline->date."</em> <span class='tinfo'>".$timeline->title."</span> <span class='tlocal'>".$timeline->info."</span></li>";
	}
	$cv .= "</ul>";
}

$content->content = str_replace("[%cv%]", $cv, $content->content);
?>
<div class="contentwrap">
<?php if (count($childmenus) > 0) { ?>
<div id="tabs" class="tabarea">
<?php 
foreach ($childmenus as $childmenu) { 
	echo '<a href="'.$childmenu->alias.'" '.(($menu->id==$childmenu->id) ? 'class="active"' : '') .'><span>'.$childmenu->name.'</span></a>';
}

?>
</div>
<?php } ?>
	<div class="clip">
		<div class="cliphead">
			<h1 class="subtitle"><?php echo $menu->name; ?></h1>
		</div>
	</div>
<p class="lead"><?php echo $content->description; ?></p>
<div class="nontitle"><?php echo $content->content; ?></div>