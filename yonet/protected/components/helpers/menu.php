<ul class="site-nav">
	<?php

		$menu = array(
			// Slider
			array(
				'link'=>Yii::app()->createUrl('photos/index',array('type'=>'slider')),
				'title'=>'Slider',
				'icon'=>'view-carousel',
				'childs'=> array(
					array(

						'chlink'=>Yii::app()->createUrl('photos/index',array('type'=>'slider')),
						'title'=>'Slider Listesi',
						'visible'=>true
					),
					array(
						'chlink'=>Yii::app()->createUrl('photos/create',array('type'=>'slider')),
						'title'=>'+ Detaylı olarak Slide Ekle',
						'visible'=>true
					),
					array(
						'chlink'=>Yii::app()->createUrl('photos/update',array('type'=>'slider','id'=>'')),
						'title'=>'Slide Güncelle',
						'visible'=>false
					)
				)
			),
			// Partner
			array(
				'link'=>Yii::app()->createUrl('photos/index',array('type'=>'cozumortaklarimiz')),
				'title'=>'Partner',
				'icon'=>'group',
				'childs'=> array(
					array(
						'chlink'=>Yii::app()->createUrl('photos/index',array('type'=>'cozumortaklarimiz')),
						'title'=>'Partner / Çözüm Ortakları Listesi',
						'visible'=>true,
					),
					array(
						'chlink'=>Yii::app()->createUrl('photos/create',array('type'=>'cozumortaklarimiz')),
						'title'=>'+ Detaylı olarak Partner Ekle',
						'visible'=>true
					),
					array(
						'chlink'=>Yii::app()->createUrl('photos/update',array('type'=>'cozumortaklarimiz')),
						'title'=>'Partner Güncelle',
						'visible'=>false
					)
				)
			),
			// References
			array(
				'link'=>Yii::app()->createUrl('photos/index',array('type'=>'referanslar')),
				'title'=>'Referans',
				'icon'=>'tag-faces',
				'childs'=> array(
					array(
						'chlink'=>Yii::app()->createUrl('photos/index',array('type'=>'referanslar')),
						'title'=>'Referans Listesi',
						'visible'=>true
					),
					array(
						'chlink'=>Yii::app()->createUrl('photos/create',array('type'=>'referanslar')),
						'title'=>'+ Detaylı olarak Referans Ekle',
						'visible'=>true
					),
					array(
						'chlink'=>Yii::app()->createUrl('photos/update',array('type'=>'referanslar')),
						'title'=>'Referans Güncelle',
						'visible'=>false
					)
				)
			),
			// News
			array(
				'link'=>Yii::app()->createUrl('news/index',array('category'=>'haberler')),
				'title'=>'Haber',
				'icon'=>'edit',
				'childs'=> array(
					array(
						'chlink'=>Yii::app()->createUrl('news/index',array('category'=>'haberler')),
						'title'=>'Haber Listesi',
						'visible'=>true
					),
					array(
						'chlink'=>Yii::app()->createUrl('news/create',array('category'=>'haberler')),
						'title'=>'+ Haber Ekle',
						'visible'=>false
					),
					array(
						'chlink'=>Yii::app()->createUrl('news/update',array('category'=>'haberler')),
						'title'=>'Haber Güncelle',
						'visible'=>false
					),
					array(
						'chlink'=>Yii::app()->createUrl('news/index',array('category'=>'')),
						'title'=>'İçerik Listesi',
						'visible'=>true
					),
					array(
						'chlink'=>Yii::app()->createUrl('news/create'),
						'title'=>'+ İçerik Ekle',
						'visible'=>false
					),
					array(
						'chlink'=>Yii::app()->createUrl('news/update',array('category'=>'')),
						'title'=>'İçerik Güncelle',
						'visible'=>false
					),
					array(
						'chlink'=>Yii::app()->createUrl('category/index',array('type'=>'content')),
						'title'=>'İçerik Kategori Listesi',
						'visible'=>true
					),
					array(
						'chlink'=>Yii::app()->createUrl('category/create',array('type'=>'content')),
						'title'=>'+ Ekle',
						'visible'=>false
					),
					array(
						'chlink'=>Yii::app()->createUrl('category/update',array('type'=>'content','id'=>'')),
						'title'=>'~ Güncelle',
						'visible'=>false
					),
				)
			),
			// Catalog
			array(
				'link'=>Yii::app()->createUrl('catalog/index'),
				'title'=>'Katalog',
				'icon'=>'insert-drive-file',
				'childs'=> array(
					array(
						'chlink'=>Yii::app()->createUrl('catalog/index'),
						'title'=>'Katalog Listesi',
						'visible'=>true
					),
					array(
						'chlink'=>Yii::app()->createUrl('catalog/create'),
						'title'=>'+ Katalog Ekle',
						'visible'=>true
					),
					array(
						'chlink'=>Yii::app()->createUrl('catalog/update'),
						'title'=>'Katalog Güncelle',
						'visible'=>false
					)
				)
			),
			// Product
			array(
				'link'=>Yii::app()->createUrl('product/index'),
				'title'=>'Ürün',
				'icon'=>'star',
				'childs'=> array(
					array(
						'chlink'=>Yii::app()->createUrl('product/index'),
						'title'=>'Ürün Listesi',
						'visible'=>true
					),
					array(
						'chlink'=>Yii::app()->createUrl('product/create'),
						'title'=>'+ Ekle',
						'visible'=>false
					),
					array(
						'chlink'=>Yii::app()->createUrl('product/update',array('id'=>'')),
						'title'=>'~ Güncelle',
						'visible'=>false
					),
					array(
						'chlink'=>Yii::app()->createUrl('productmodel/index'),
						'title'=>'Model Listesi',
						'visible'=>true
					),
					array(
						'chlink'=>Yii::app()->createUrl('productmodel/create'),
						'title'=>'+ Ekle',
						'visible'=>false
					),
					array(
						'chlink'=>Yii::app()->createUrl('productmodel/update',array('id'=>'')),
						'title'=>'~ Güncelle',
						'visible'=>false
					),
					array(
						'chlink'=>Yii::app()->createUrl('category/index',array('type'=>'product')),
						'title'=>'Kategori Listesi',
						'visible'=>true
					),
					array(
						'chlink'=>Yii::app()->createUrl('category/create',array('type'=>'product')),
						'title'=>'+ Ekle',
						'visible'=>false
					),
					array(
						'chlink'=>Yii::app()->createUrl('category/update',array('type'=>'product','id'=>'')),
						'title'=>'~ Güncelle',
						'visible'=>false
					),
					array(
						'chlink'=>Yii::app()->createUrl('productattrib/index'),
						'title'=>'Ozellikler',
						'visible'=>true
					),
					array(
						'chlink'=>Yii::app()->createUrl('productattrib/create'),
						'title'=>'+ Ekle',
						'visible'=>false
					),
					array(
						'chlink'=>Yii::app()->createUrl('productattrib/update',array('id'=>'')),
						'title'=>'~ Güncelle',
						'visible'=>false
					),
				)
			),
			// Company
			array(
				'link'=>Yii::app()->createUrl('company/index',array('category'=>'haberler')),
				'title'=>'Firma',
				'icon'=>'dashboard',
				'childs'=> array(
					array(
						'chlink'=>Yii::app()->createUrl('company/index',array('category'=>'haberler')),
						'title'=>'Firma Listesi',
						'visible'=>true
					),
					array(
						'chlink'=>Yii::app()->createUrl('company/create',array('category'=>'haberler')),
						'title'=>'+ Firma Ekle',
						'visible'=>true
					),
					array(
						'chlink'=>Yii::app()->createUrl('company/update',array('category'=>'haberler')),
						'title'=>'Firma Güncelle',
						'visible'=>false
					)
				)
			),
			// Pages
			array(
				'link'=>Yii::app()->createUrl('menu/index'),
				'title'=>'Sayfa',
				'icon'=>'quick-contacts-mail',
				'childs'=> array(
					array(
						'chlink'=>Yii::app()->createUrl('menu/index'),
						'title'=>'Sayfa Listesi',
						'visible'=>true
					),
					array(
						'chlink'=>Yii::app()->createUrl('menu/create'),
						'title'=>'+ Yeni Sayfa Ekle',
						'visible'=>false
					),
					array(
						'chlink'=>Yii::app()->createUrl('menu/update',array('id'=>'')),
						'title'=>'Sayfa Güncelle',
						'visible'=>false
					),
					array(
						'chlink'=>Yii::app()->createUrl('settings/index',array('lang'=>'')),
						'title'=>'Site Ayarları',
						'visible'=>true
					)
				)
			),
			// Offers
			array(
				'link'=>Yii::app()->createUrl('offer/index'),
				'title'=>'Teklif',
				'icon'=>'receipt',
				'childs'=> array(
					array(
						'chlink'=>Yii::app()->createUrl('offer/index'),
						'title'=>'Teklif Listesi',
						'visible'=>true
					),
					array(
						'chlink'=>Yii::app()->createUrl('offer/create'),
						'title'=>'+ Teklif Ekle',
						'visible'=>true
					),
				)
			),
			// Members
			array(
				'link'=>Yii::app()->createUrl('user/admin',array('role'=>'normal')),
				'title'=>'Üye',
				'icon'=>'user',
				'childs'=> array(
					array(
						'chlink'=>Yii::app()->createUrl('user/admin',array('role'=>'normal')),
						'title'=>'Üye Listesi',
						'visible'=>true
					),
					array(
						'chlink'=>Yii::app()->createUrl('user/create'),
						'title'=>'+ Yeni Üye Ekle',
						'visible'=>true
					),
					array(
						'chlink'=>Yii::app()->createUrl('user/update',array('id'=>'')),
						'title'=>'Üye Güncelle',
						'visible'=>false
					)
				)
			),
			// Dealers
			array(
				'link'=>Yii::app()->createUrl('user/admin',array('role'=>'dealer')),
				'title'=>'Bayi',
				'icon'=>'store-mall-directory',
				'childs'=> array(
					array(
						'chlink'=>Yii::app()->createUrl('user/admin',array('role'=>'dealer')),
						'title'=>'Bayi Listesi',
						'visible'=>true
					),
					array(
						'chlink'=>Yii::app()->createUrl('user/create'),
						'title'=>'+ Yeni Bayi Ekle',
						'visible'=>true
					),
					array(
						'chlink'=>Yii::app()->createUrl('user/update',array('id'=>'')),
						'title'=>'Bayi Güncelle',
						'visible'=>false
					)
				)
			),
		);
		// render menu
		foreach ($menu as $item) {

			$item = $this->arrayto($item);
			$url = rawurldecode($_SERVER['REQUEST_URI']);

			if ($item->link == $url OR (strpos($url,$item->link) !== false) OR ($this->checkChildActive($item) == true)) {
				$class = "isActive";
				$stick = "data-sticky-nav";
			} else {
				$class = "isDefault";
				$stick = "";
			}
		?>
			<li class="<?php echo $class; ?>">
				<a href="<?php echo $item->link; ?>" title="<?php echo $item->title; ?>" class="site-nav_item">
					<svg class="td-icon td-icon-<?php echo $item->icon; ?>"><use xlink:href="#icon-<?php echo $item->icon; ?>"></use></svg>
					<span><?php echo $item->title; ?></span>
				</a>
				<?php if (count($item->childs) > 0) { ?>
				<!-- Sub Menu -->
				<ul class="site-sub-nav" <?php echo $stick; ?>>
					<?php foreach ($item->childs as $child) {
						$child = $this->arrayto($child);

						if (($child->chlink == $url) OR (strpos($url,$child->chlink) !== false)) {
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
	?>
</ul>