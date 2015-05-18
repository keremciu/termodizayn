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

		$getim=Menu::model()->findByAttributes(array('alias'=>"sergiler"));
		$alias = $getim->alias;
		$products = Product::model()->language(Yii::app()->getLanguage())->findAll(array('order'=>'t.ordering ASC'));

		$this->render('index',array('products'=>$products,'alias'=>$alias,'getim'=>$getim));
	}

	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			
		}
		$this->render('contact',array('model'=>$model));
	}
}