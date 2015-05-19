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

		$gallery = Gallery::model()->findByAttributes(array('slug'=>'slider'));
		$photos=Photos::model()->findAll(array('condition'=>'gallery = :gallery','order'=>'t.ordering DESC','params'=>array(':gallery'=>$gallery->id)));

		$this->render('index',
			array(
				'gallery'=>$gallery,
				'photos'=>$photos,
			));
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
	
}