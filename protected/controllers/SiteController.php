<?php
class SiteController extends Controller
{
	public function actions()
	{
		return array(
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	public function actionIndex()
	{
		// Get news items
		$newsmenu = Menu::model()->findByAttributes(array('alias'=>'haberler'));
		$newslist = News::model()->findAll(array('condition'=>'t.category = :category','params'=>array(':category'=>$newsmenu->types_id)));

		// Get slider items
		$gallery = Gallery::model()->findByAttributes(array('slug'=>'slider'));
		$photos=Photos::model()->language(Yii::app()->getLanguage())->findAll(array('condition'=>'gallery = :gallery','order'=>'t.ordering DESC','params'=>array(':gallery'=>$gallery->id)));

		// Get partner items
		$partner_gallery = Gallery::model()->findByAttributes(array('slug'=>'cozumortaklarimiz'));
		$partners=Photos::model()->language(Yii::app()->getLanguage())->findAll(array('condition'=>'gallery = :gallery','order'=>'t.ordering DESC','params'=>array(':gallery'=>$partner_gallery->id)));

		// Get reference items
		$reference_gallery = Gallery::model()->findByAttributes(array('slug'=>'referanslar'));
		$references=Photos::model()->language(Yii::app()->getLanguage())->findAll(array('condition'=>'gallery = :gallery','order'=>'t.ordering DESC','params'=>array(':gallery'=>$reference_gallery->id)));

		// Get category items
		$product_menu = Menu::model()->findByAttributes(array('types_id'=>12));
		$base_category = Category::model()->language(Yii::app()->getLanguage())->find(array('condition'=>'t.id=:id','params'=>array(':id'=>$product_menu->types_id)));
		$categories = Category::model()->with("product")->findAll(array('condition' => 't.parent = :parent AND t.type = "product"','params'=>array(':parent'=>12)));

		// Homepage check
		$controller = Yii::app()->getController();
		$this->ishomepage = $controller->getId() === 'site' && $controller->getAction()->getId() === 'index';

		$this->render('index',
			array(
				'gallery'=>$gallery,
				'photos'=>$photos,
				'newslist'=>$newslist,
				'newsmenu'=>$newsmenu,
				'partner_gallery'=>$partner_gallery,
				'partners'=>$partners,
				'reference_gallery'=>$reference_gallery,
				'references'=>$references,
				'product_menu'=>$product_menu,
				'base_category'=>$base_category,
				'categories'=>$categories
			)
		);
	}

	// Token for reset password
	public function getToken($token)
    {
        $model=User::model()->findByAttributes(array('token'=>$token));
        if($model===null)
            throw new CHttpException(404,'The requested page does not exist.');
        return $model;
    }

	public function ActionResetpassword($token)
	{
		// Get component layout
		$this->layout='//layouts/base';

		$model=$this->getToken($token);
		
		if(isset($_POST['Resetpass']))
		{
			if($model->token==$_POST['Resetpass']['hiddentoken']) {
				$model->password=md5($_POST['Resetpass']['password']);
				$model->token="null";
				$model->save();
				
				Yii::app()->user->setFlash('mainalert','Şifreniz başarı ile değiştirildi! Yeni şifreniz ile giriş yapabilirsiniz.');
				$this->redirect('index');
				$this->refresh();
			}
		}
		
		$this->render('resetpass',array(
            'model'=>$model,
            'token'=>$token,
        ));
	}

	public function ActionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->request->urlReferrer);
	}

	public function actionDeleteCache()
	{
		// Delete cache function builded for our cms settings on admin panel
		Yii::app()->settings->deleteCache2();
		// Redirect to admin panel after this process
		$this->redirect(Yii::app()->request->urlReferrer);
	}

	public function actionError()
	{
		// Error page handler
		$this->layout='//layouts/base';
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}
	
}