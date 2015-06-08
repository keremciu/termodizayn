<?php

class ParserController extends Controller
{
	public $layout='//layouts/base';
	public $menu=array();

	public function actions()
	{
		return array(
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	public function actionRouter($alias)
	{
		// Find CMS menu with "alias"
		$this->menu = Menu::model()->language(Yii::app()->getLanguage())->find(array(
			'condition'=>'alias=:alias OR translates.value=:alias',
			'params'=>array(':alias'=>$alias)
		));

		// If site is not exist, show error page
		if (!isset($this->menu->id)) {
			throw new CHttpException(404,Yii::t('main','Aradığınız Sayfa bulunamadı. Bu sayfa sistemden silinmiş veya değiştirilmiş olabilir, anasayfaya giderek sistem üzerinden alakalı içeriği bulabilirsiniz.'));
			$this->redirect(array('site/error'));
		}

        // Capitalize menu name
        $menu_title = ucfirst(strtolower($this->menu->name));

        // This menu added to Breadcrumbs
        $this->breadcrumbs=array(
			$this->menu->name,
		);

        // Change page title
        $this->pageTitle=$menu_title . ' — '. Yii::app()->name;

        // Call the menu type 'page'
        $getFunction = "_parser".ucfirst($this->menu->type);

        // Check if method is not exists redirect to error page
        if (!method_exists($this,$getFunction)) {
        	throw new CHttpException(404,Yii::t('main','Aradığınız sayfanın içerik tipi değiştirilmiş veya sayfa sizin erişiminiz dışında olabilir. Anasayfaya giderek sistem üzerinde erişebileceğiniz sayfaları bulabilirsiniz.'));
			$this->redirect(array('site/error'));
        } else {
        	$this->$getFunction();
        }
	}

	// Blog page: menu type
	public function _parserBlog()
	{
		// if the menu type is "blog" run this page
		$base_category = Category::model()->language(Yii::app()->getLanguage())->findByAttributes(array('id'=>$this->menu->types_id));	
		$newslist = News::model()->findAll(array('condition' => 't.category = :parent','params'=>array(':parent'=>$base_category->id)));

		$this->render('blog',array(
			'menu'=>$this->menu,
			'newslist'=>$newslist,
		));
	}

	// Categories page: menu type
	public function _parserCategories()
	{
		// if the menu type is "categories" run this page
		$base_category = Category::model()->language(Yii::app()->getLanguage())->findByAttributes(array('id'=>$this->menu->types_id),'t.is_published=1');	
		$categories = Category::model()->with("product")->findAll(array('condition' => 't.parent = :parent AND t.type = "product"','params'=>array(':parent'=>$base_category->id)));

		$this->render('categories',array(
			'menu'=>$this->menu,
			'categories'=>$categories,
		));
	}

	// Products page: menu type
	public function _parserProducts()
	{
		// if the menu type is "products" run this page
		$content=News::model()->language(Yii::app()->getLanguage())->findByAttributes(array('id'=>$this->menu->types_id),'t.is_published=1');	

		$this->render('content',array(
			'menu'=>$this->menu,
			'content'=>$content,
		));
	}
	

	// Content page: menu type
	public function _parserContent()
	{
		// if the menu type is "content" run this page
		$content=News::model()->language(Yii::app()->getLanguage())->findByAttributes(array('id'=>$this->menu->types_id),'t.is_published=1');	

		$this->render('content',array(
			'menu'=>$this->menu,
			'content'=>$content,
		));
	}

	// Contact page: menu type
	public function _parserContact()
	{
		// if the menu type is "contact" run this page
		$model=new ContactForm;

		if(isset($_POST['ContactForm'])) {
			$model->attributes=$_POST['ContactForm'];

			// Validation of contact form inputs
			if($model->validate())
			{
				// Template for contact mail you can find it in views/contact-mail folder
				$template = $this->renderPartial('mail-templates/_contact',array(
					'name'=>$model->name,
					'email'=>$model->email,
					'subject'=>$model->subject,
					'message'=>$model->body
				),true,false);

				// Mail settings apply from our cms settings
				$mail = Yii::app()->mail;
				$mail->SetFrom(Yii::app()->settings->get("mail","adminEmail"), Yii::app()->settings->get("system","name"));
				$mail->AddAddress(Yii::app()->settings->get("mail","adminEmail"), Yii::app()->settings->get("system","name"));
				$mail->AddReplyTo($model->email, $model->name);

				// Get template and subject title, subject title must be in english characters
				$mail->IsHTML(true);
				$mail->Subject = 'Iletisim Sayfasi E-Postasi';
				$mail->MsgHTML($template);
				
				// Mail send function
				if ($mail->Send()) {
					Yii::app()->user->setFlash('alert',Yii::t("main","E-Postanız için teşekkürler. En kısa sürede sizinle irtibata geçeceğiz."));
					$this->refresh();
				}
			}
		}

		$this->render('contact',array(
			'menu'=>$this->menu,
			'model'=>$model,
		));
	}

	// Forgot Password page: menu type
	public function _parserRegister()
	{
		$model=new User;

		if(isset($_POST['User'])) {
			$model->attributes=$_POST['User'];
			
			// Password hash
			$temp=$model->password;
			$model->password=md5($model->password);

			// Parse name / last name
			$parse_name = explode(" ", $model->name);
			$model->name = $parse_name[0];
			if (isset($parse_name[1])) {
				$model->lastname = $parse_name[1];
			} else {
				$model->lastname = "";
			}
			$model->role = "normal";
			$model->active = 1;

			// Validation of register form inputs
			if($model->validate())
			{
				$check=User::model()->findByAttributes(array('email'=>$model->email));

				if (isset($check)) {
					Yii::app()->user->setFlash('alert', 'Kayıt olmaya çalıştığınız e-posta adresi zaten sistemde kayıtlı.');
					$this->refresh();
				} else {

					if ($model->save()) {
						Yii::app()->user->setFlash('mainalert', '<strong>Başarılı!</strong> Kayıt olma işlemi başarıyla gerçekleşti.');
						$this->redirect("site/index");
						$this->refresh();
					}

				}
			}
		}

		$this->render('register',array(
			'menu'=>$this->menu,
			'model'=>$model
		));
	}

	// Forgot Password page: menu type
	public function _parserForgotpass()
	{
		$model=new ForgotpassForm;

		if(isset($_POST['ForgotpassForm'])) {
			$model->attributes=$_POST['ForgotpassForm'];

			// Validation of contact form inputs
			if($model->validate())
			{
				$user=User::model()->findByAttributes(array('email'=>$model->recover_email));

				if($user===null) {
					Yii::app()->user->setFlash('alert',Yii::t("main","Sistemde girdiğiniz E-Posta adresi kayıtlı değildir."));
					$this->refresh();
				} else {
					$randomtoken=rand(0, 99999);
	                $time=date("H:i:s");
	                $user->token=md5($randomtoken.$time);
					$link=Yii::app()->request->hostInfo . Yii::app()->createUrl('site/resetpassword',array("state"=>"confirmed","token"=>$user->token));
					// Template for contact mail you can find it in views/contact-mail folder
					$template = $this->renderPartial('mail-templates/_forgotpass',array(
						'name'=>$user->name,
						'email'=>$model->recover_email,
						'link'=>$link,
					),true,false);

					// Mail settings apply from our cms settings
					$mail = Yii::app()->mail;
					$mail->SetFrom(Yii::app()->settings->get("mail","adminEmail"), Yii::app()->settings->get("system","name"));
					$mail->AddAddress($model->recover_email, $user->name);

					// Get template and subject title, subject title must be in english characters
					$mail->IsHTML(true);
					$mail->ClearReplyTos();
					$mail->Subject = Yii::app()->settings->get('system','name') .' Sifre Yardimi';
					$mail->MsgHTML($template);
					
					// Mail send function
					if ($mail->Send()) {
						$user->save();
						Yii::app()->user->setFlash('alert',Yii::t("main","Şifre sıfırlama işleminiz için talimatlar E-Posta adresinize gönderilmiştir."));
						$this->refresh();
					}
				}
			}
		}

		$this->render('forgotpass',array(
			'menu'=>$this->menu,
			'model'=>$model
		));
	}
	
}