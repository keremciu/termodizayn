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
				'icon'=>'view-carousel',
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
				'icon'=>'view-carousel',
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
						'visible'=>true
					),
					array(
						'chlink'=>Yii::app()->createUrl('news/update',array('category'=>'haberler')),
						'title'=>'Haber Güncelle',
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
						'title'=>'+ Ürün Ekle',
						'visible'=>true
					)
				)
			),
			// Members
			array(
				'link'=>Yii::app()->createUrl('user/admin'),
				'title'=>'Üye/Bayi',
				'icon'=>'user',
				'childs'=> array(
					array(
						'chlink'=>Yii::app()->createUrl('user/admin',array('role'=>'normal')),
						'title'=>'Üye Listesi',
						'visible'=>true
					),
					array(
						'chlink'=>Yii::app()->createUrl('user/admin',array('role'=>'dealer')),
						'title'=>'Bayi Listesi',
						'visible'=>true
					),
					array(
						'chlink'=>Yii::app()->createUrl('user/create'),
						'title'=>'+ Yeni Üye Ekle',
						'visible'=>true
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
						'chlink'=>Yii::app()->createUrl('menu/index',array('role'=>'normal')),
						'title'=>'Sayfa Listesi',
						'visible'=>true
					),
					array(
						'chlink'=>Yii::app()->createUrl('menu/create'),
						'title'=>'+ Yeni Sayfa Ekle',
						'visible'=>true
					)
				)
			),
		);

		$this->renderPartial('/layouts/menulist', array('menu'=>$menu));
		//$this->buildMenu($menu);
	?>
</ul>