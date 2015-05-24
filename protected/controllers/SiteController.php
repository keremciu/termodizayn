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
		// Get slider items
		$gallery = Gallery::model()->findByAttributes(array('slug'=>'slider'));
		$photos=Photos::model()->language(Yii::app()->getLanguage())->findAll(array('condition'=>'gallery = :gallery','order'=>'t.ordering DESC','params'=>array(':gallery'=>$gallery->id)));

		// Homepage check
		$controller = Yii::app()->getController();
		$this->ishomepage = $controller->getId() === 'site' && $controller->getAction()->getId() === 'index';

		$this->render('index',
			array(
				'gallery'=>$gallery,
				'photos'=>$photos,
			)
		);
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