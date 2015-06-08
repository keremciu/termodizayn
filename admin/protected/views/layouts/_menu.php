<ul class="site-nav">
	<li class="isActive">
		<a href="<?php echo Yii::app()->createUrl('photos/index',array('type'=>'slider')); ?>" title="Slider" class="site-nav_item">
			<svg class="td-icon td-icon-view-carousel"><use xlink:href="#icon-view-carousel"></use></svg>
			<span>Slider</span>
		</a>
		<!-- Sub Menu -->
		<ul class="site-sub-nav">
			<li>
				<a href="<?php echo Yii::app()->createUrl('photos/index',array('type'=>'slider')); ?>" title="Slider Listesi" class="site-sub-nav_item isActive">Slider Listesi</a>
			</li>
			<li>
				<a href="<?php echo Yii::app()->createUrl('photos/create',array('type'=>'slider')); ?>" title="Detaylı olarak Slide Ekle" class="site-sub-nav_item">Detaylı olarak Slide Ekle</a>
			</li>
		</ul>
	</li>
	<li class="isDefault">
		<a href="#" title="#" class="site-nav_item">
			<svg class="td-icon td-icon-group"><use xlink:href="#icon-group"></use></svg>
			<span>Partner</span>
		</a>
		<!-- Sub Menu -->
		<ul class="site-sub-nav" data-sticky-nav>
			<li>
				<a href="#" title="#" class="site-sub-nav_item">Menu Item 1</a>
			</li>
			<li>
				<a href="#" title="#" class="site-sub-nav_item isActive">Menu Item 2</a>
			</li>
			<li>
				<a href="#" title="#" class="site-sub-nav_item">Menu Item 3</a>
			</li>
			<!-- Action Buttons -->
			<li class="action-buttons">
				<button type="button" class="btn btn-default"><svg class="icon icon-delete"><use xlink:href="#icon-delete"></use></svg> Önizle</button>
				<div class="btn-group">
					<button type="button" class="btn btn-success"><svg class="icon icon-cloud-done"><use xlink:href="#icon-cloud-done"></use></svg> Kaydet</button>
					<button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
					<svg class="icon icon-arrow-drop-down"><use xlink:href="#icon-arrow-drop-down"></use></svg>
					</button>
					<ul class="dropdown-menu" role="menu">
						<li><a href="#">Action</a></li>
						<li><a href="#">Another action</a></li>
						<li class="divider"></li>
						<li><a href="#">Separated link</a></li>
					</ul>
				</div>
			</li>
		</ul>
	</li>
	<li class="isDefault">
		<a href="#" title="#" class="site-nav_item">
			<svg class="icon icon-tag-faces"><use xlink:href="#icon-tag-faces"></use></svg>
			<span>Referans</span>
		</a>
		<!-- Sub Menu -->
		<ul class="site-sub-nav">
			<li>
				<a href="#" title="#" class="site-sub-nav_item">Menu Item 4</a>
			</li>
			<li>
				<a href="#" title="#" class="site-sub-nav_item">Menu Item 5</a>
			</li>
			<li>
				<a href="#" title="#" class="site-sub-nav_item isActive">Menu Item 6</a>
			</li>
		</ul>
	</li>
	<li class="isDefault">
		<a href="#" title="#" class="site-nav_item">
			<svg class="icon icon-edit"><use xlink:href="#icon-edit"></use></svg>
			<span>Haber</span>
		</a>
		<!-- Sub Menu -->
		<ul class="site-sub-nav">
			<li>
				<a href="#" title="#" class="site-sub-nav_item">Menu Item 7</a>
			</li>
			<li>
				<a href="#" title="#" class="site-sub-nav_item">Menu Item 8</a>
			</li>
			<li>
				<a href="#" title="#" class="site-sub-nav_item">Menu Item 9</a>
			</li>
			<li>
				<a href="#" title="#" class="site-sub-nav_item isActive">Menu Item 10</a>
			</li>
		</ul>
	</li>
	<li class="isDefault">
		<a href="#" title="#" class="site-nav_item">
			<svg class="icon icon-insert-drive-file"><use xlink:href="#icon-insert-drive-file"></use></svg>
			<span>Katalog</span>
		</a>
	</li>
	<li class="isDefault">
		<a href="#" title="#" class="site-nav_item">
			<svg class="icon icon-star"><use xlink:href="#icon-star"></use></svg>
			<span>Ürün</span>
		</a>
	</li>
	<li class="isDefault">
		<a href="#" title="#" class="site-nav_item">
			<svg class="icon icon-dashboard"><use xlink:href="#icon-dashboard"></use></svg>
			<span>Firma</span>
		</a>
	</li>
	<li class="isDefault">
		<a href="#" title="#" class="site-nav_item">
			<svg class="icon icon-quick-contacts-mail"><use xlink:href="#icon-quick-contacts-mail"></use></svg>
			<span>Sayfa</span>
		</a>
	</li>
	<li class="isDefault">
		<a href="#" title="#" class="site-nav_item">
			<svg class="icon icon-receipt"><use xlink:href="#icon-receipt"></use></svg>
			<span>Teklif</span>
		</a>
	</li>
	<li class="isDefault">
		<a href="#" title="#" class="site-nav_item">
			<span>
				<svg class="icon icon-user"><use xlink:href="#icon-user"></use></svg>
				<span class="badge">33</span>
			</span>
			<span>Üye</span>
		</a>
	</li>
	<li class="isDefault">
		<a href="#" title="#" class="site-nav_item">
			<span>
				<svg class="icon icon-store-mall-directory"><use xlink:href="#icon-store-mall-directory"></use></svg>
				<span class="badge">1</span>
			</span>
			<span>Bayi</span>
		</a>
	</li>
</ul>