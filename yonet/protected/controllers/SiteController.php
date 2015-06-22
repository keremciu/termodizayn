<?php

class SiteController extends Controller
{
	public function accessRules()
	{
		return array_merge(
			array(),
			// components/controller access rules
			parent::accessRules()
		);
	}

	public function actionIndex()
	{
		if (Yii::app()->user->isGuest) 
   			$this->redirect("index.php?r=site/login");
   		
		$model=new Chat;

		if(isset($_POST['Chat']))
		{
			$model->attributes=$_POST['Chat'];
			$model->user=Yii::app()->user->id;
			$model->datime=date("Y-m-d H:i:s");
			if($model->save())
				$this->redirect(array('site/index'));
		}
		
		$dataProvider=new CActiveDataProvider('Chat',array('criteria'=>array('order'=>'datime DESC'),'pagination'=>array('pageSize'=>10,),));
		
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
			'model'=>$model,
		));
		
	}

	/**
	 * This is the action to handle external exceptions.
	 */
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

	public function actionLogin()
	{
		$this->layout='//layouts/homepage';
		$model=new LoginForm;

		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			if($model->validate() && $model->login())
				$this->redirect(array('index'));
		}
		$this->render('login',array('model'=>$model));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
}