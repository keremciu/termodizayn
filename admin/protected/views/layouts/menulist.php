<?php

foreach ($menu as $item) {

	$item = $this->arrayto($item);

	if($item->link == $_SERVER['REQUEST_URI'] OR ($this->checkChildActive($item) == true)) {
		$class = "isActive";
	} else {
		$class = "isDefault";
	}
?>
	<li class="<?php echo $class; ?>">
		<a href="<?php echo $item->link; ?>" title="<?php echo $item->title; ?>" class="site-nav_item">
			<svg class="td-icon td-icon-<?php echo $item->icon; ?>"><use xlink:href="#icon-<?php echo $item->icon; ?>"></use></svg>
			<span><?php echo $item->title; ?></span>
		</a>
		<?php if (count($item->childs) > 0) { ?>
		<!-- Sub Menu -->
		<ul class="site-sub-nav">
			<?php foreach ($item->childs as $child) {

				$child = $this->arrayto($child);

				if (($child->chlink == $_SERVER['REQUEST_URI']) OR (strpos($_SERVER['REQUEST_URI'],$child->chlink) !== false)) {
					$iclass = "isActive";
				} else {
					$iclass = "";
				}

			?>
			<li>
				<a href="<?php echo $child->chlink; ?>" title="<?php echo $child->title; ?>" class="site-sub-nav_item <?php echo $iclass . ((!$child->visible) ? ' hiddenfromnav' : ''); ?>"><?php echo $child->title; ?></a>
			</li>
			<?php } ?>
		</ul>
		<?php } ?>
	</li>
<?php
}