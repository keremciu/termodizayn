<?php

class ComponentController extends Controller
{
	public function actions()
	{
		return array(
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	public function actionCliper($alias,$slug)
	{
		$menu=Menu::model()->language(Yii::app()->getLanguage())->find(array('condition'=>'t.alias=:alias OR translates.value=:alias','params'=>array(':alias'=>$alias)),'t.is_published=1');

		if (isset($menu->parent)) {
        $childmenus=Menu::model()->findAll(array('condition'=>'parent = :id','params'=>array(':id'=>$menu->parent)));
       	}
		
		if ($menu->type == "blog" OR $menu->type == "project") {
			$pro = News::model()->language(Yii::app()->getLanguage())->find(array('condition'=>'t.slug=:slug OR translates.value=:slug','params'=>array(':slug'=>$slug)),'t.is_published=1');
			$news = News::model()->language(Yii::app()->getLanguage())->findByPk($pro->id);

	        $this->render('news',array(
				'menu'=>$menu,
				'childmenus'=>$childmenus,
				'news'=>$news,
			));
		} else if ($menu->type == "categorylist" OR $menu->type == "subcatlist") {
			$pro = Product::model()->language(Yii::app()->getLanguage())->find(array('condition'=>'slug=:slug OR translates.value=:slug','params'=>array(':slug'=>$slug)));
			if (!$pro) {
				$pro = Translates::model()->find(array('condition'=>'reference_table="product" AND reference_field="slug" AND value=:slug','params'=>array(':slug'=>$slug)));
				$pro->id = $pro->reference_id;
				if (!$pro) {
					$pro = Product::model()->with("translates")->find(array('condition'=>'slug=:slug OR translates.original_value=:slug','params'=>array(':slug'=>$slug)));
				}
			}
			$product = Product::model()->language(Yii::app()->getLanguage())->findByPk($pro->id);
			$images = Pimages::model()->findAll(array('condition' => 'pid = :pid','params'=>array(':pid'=>$product->id)));
			$videos = Pimages::model()->findAll(array('condition' => 'pid = :pid AND type="video"','params'=>array(':pid'=>$product->id)));
			$files = Pimages::model()->findAll(array('condition' => 'pid = :pid AND type="file"','params'=>array(':pid'=>$product->id)));

			$this->render('product',array(
				'menu'=>$menu,
				'childmenus'=>$childmenus,
				'product'=>$product,
				'images'=>$images,
				'videos'=>$videos,
				'files'=>$files,
			));

		} else {
			Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/lightbox.js',CClientScript::POS_END);
			$gallery = Gallery::model()->findByAttributes(array('slug'=>$slug),'is_published=1');
			$photos = Photos::model()->findAll(array('condition' => 'gallery = :gallery','params'=>array(':gallery'=>$gallery->id)));
	        
        	$this->render('gallery',array(
				'menu'=>$menu,
				'childmenus'=>$childmenus,
				'gallery'=>$gallery,
				'photos'=>$photos,
			));
		}
	}

	public function katKontrol($id, $type) {
	
		$result = Category::model()->findAll(array('condition' => 'parent = :parent AND type = "product"','params'=>array(':parent'=>$id)));
		$count = count($result);
		
		if ($count > 0) {
			if ($type == 1) {
			echo '<i class="bicon-chevron-down bicon-white expandit"></i><ul>';
			} else {
			echo '</ul></li>';
			}
		}
	}
	
	public function categorylist($parent, $onek = 1)
	{
	
	$categories = Category::model()->findAll(array('condition' => 'parent = :parent AND type = "product"','params'=>array(':parent'=>$parent)));
    end($categories);
	$endKey = key($categories);

	foreach ($categories as $key => $row) {
		$class = "level".$onek." ";
			//if ($alias)
			echo '<li class="'.$class.'"><a href="#">'.$row->title.'</a>';

			$this->katKontrol($row->id, 1);
			$this->categorylist($row->id, ($onek+1));
			$this->katKontrol($row->id, 2);
		}
	}

	public function actionRouter($alias)
	{
        $menuid=Menu::model()->language(Yii::app()->getLanguage())->find(array('condition'=>'alias=:alias OR translates.value=:alias','params'=>array(':alias'=>$alias)),'t.is_published=1');
        $menu = Menu::model()->language(Yii::app()->getLanguage())->findByPk($menuid->id);
        
        if ($menu->parent == 0) {
        	$childmenus=array();
        } else {
        	$childmenus=Menu::model()->findAll(array('condition'=>'parent = :id','order'=>'t.ordering ASC','params'=>array(':id'=>$menu->parent)));
        }

        if ($menu->type=="content") {
        	$content=News::model()->language(Yii::app()->getLanguage())->findByAttributes(array('id'=>$menu->types_id),'t.is_published=1');	
        	
        	$this->render('content',array(
        		'childmenus'=>$childmenus,
				'menu'=>$menu,
				'content'=>$content,
			));
        } else if ($menu->type=="taglist") {
			
			$alias = Menu::model()->find(array('condition'=>'t.type = :category','params'=>array(':category'=>"categorylist")))->alias;
        	$product_tags = ProductTags::model()->findAll(array('condition'=>'t.tag_id = :tagid','params'=>array(':tagid'=>$menu->types_id)));
        	$ids = array();

        	foreach ($product_tags as $pro) {
        		array_push($ids, $pro->product_id);
        	}

        	$products = Product::model()->findAllByPk($ids);
        	$category = "";
			// this area
        	$this->render('categorylist',array(
        		'alias'=>$alias,
				'menu'=>$menu,
				'childmenus'=>$childmenus,
				'category'=>$category,
				'products'=>$products,
			));
        } else if ($menu->type=="categorylist") {
			
        	$category = Category::model()->language(Yii::app()->getLanguage())->findByAttributes(array('id'=>$menu->types_id));
			$products = Product::model()->language(Yii::app()->getLanguage())->findAll(array('condition'=>'t.category = :typeid','order'=>'t.ordering ASC','params'=>array(':typeid'=>$menu->types_id)));

			// this area
        	$this->render('categorylist',array(
        		'alias'=>$alias,
				'menu'=>$menu,
				'childmenus'=>$childmenus,
				'category'=>$category,
				'products'=>$products,
			));
        } else if ($menu->type=="subcatlist") {
			
        	$category = Category::model()->language(Yii::app()->getLanguage())->findByAttributes(array('id'=>$menu->types_id));
			$products = Product::model()->language(Yii::app()->getLanguage())->findAll(array('order'=>'t.ordering ASC'));

			// this area
        	$this->render('subcatlist',array(
        		'alias'=>$alias,
				'menu'=>$menu,
				'childmenus'=>$childmenus,
				'category'=>$category,
				'products'=>$products,
			));
        } else if ($menu->type=="blog") {
        	$category = Category::model()->findByAttributes(array('id'=>$menu->types_id));
			$news = News::model()->language(Yii::app()->getLanguage())->findAll(array('condition'=>'t.category = :typeid','order'=>'date DESC','params'=>array(':typeid'=>$menu->types_id)));

        	$this->render('blog',array(
        		'alias'=>$alias,
				'menu'=>$menu,
				'childmenus'=>$childmenus,
				'category'=>$category,
				'news'=>$news,
			));
        } else if ($menu->type=="gallery") {
        	Yii::app()->clientScript->registerScriptFile('js/lightbox.js',CClientScript::POS_END);
        	$gallery= Gallery::model()->findByAttributes(array('id'=>$menu->types_id),'is_published=1');
			$photos = Photos::model()->findAll(array('condition' => 'gallery = :gallery','params'=>array(':gallery'=>$gallery->id)));

        	$this->render('gallery',array(
				'menu'=>$menu,
				'childmenus'=>$childmenus,
				'gallery'=>$gallery,
				'photos'=>$photos,
			));
        } else if ($menu->type=="contact") {
        	$model=new ContactForm;

			if(isset($_POST['ContactForm']))
			{
				$model->attributes=$_POST['ContactForm'];
				if($model->validate())
				{	

					$content= '<h2>İletişim sayfası üzerinden yeni bir iletişim e-postası oluşturuldu.</h2>
					<p style="font-size:14px;color:#444">Ad Soyad: <strong>'.$model->name.'</strong></p>
					<p style="font-size:14px;color:#444">E-Posta Adresi: <strong>'.$model->email.'</strong></p>
					<p style="font-size:14px;color:#444">Mesaj Konusu: <strong>'.$model->timeline.' - '.$model->budget.' - '.$model->subject.'</strong></p>
					<p style="font-size:14px;color:#444">Mesajı: </p><p><h3>'.$model->body.'</h3>
					</p>
					<hr/><p><small>Suzhuglevy.com - WebSitesi</small></p>';
				
					Yii::import('application.extensions.phpmailer.JPhpMailer');
					$mail = new JPhpMailer;
					$mail->IsSMTP();
					$mail->IsHTML(true);
					$mail->SetFrom("kerem@reident.com",'Mail');
					$mail->Subject = $model->subject . ' - Web uzerinden';
					$mail->MsgHTML($content);
					$mail->AddAddress('info@keremciu.com', 'Kerem Sevencan');
					
					$mail->AddReplyTo($model->email, $model->name);
					if ($mail->Send()) {
						Yii::app()->user->setFlash('contact',"Thank you for your mail. I'll write response to the e-mail in 48 hours.");
						$this->refresh();
					}
					
				}
			}
        	$this->render('contact',array(
				'menu'=>$menu,
				'model'=>$model,
			));
        }
	}
}