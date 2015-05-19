<?php

class TotelephoneController extends Controller
{
	public function filters()
	{
		return array(
			'accessControl',
		);
	}

	public function accessRules()
	{
		return array(
			array('allow',
				'actions'=>array('view'),
				'roles'=>array('*'),
			),
			array('allow',
				'actions'=>array('create','update'),
				'roles'=>array('staff'),
			),
			array('allow',
				'actions'=>array('index','delete','toggle'),
				'roles'=>array('admin'),
			),
			array('deny',
				'users'=>array('*'),
			),
		);
	}

	public function actions()
	{
	    return array(
	        'toggle' => array(
	        	'class'=>'bootstrap.actions.TbToggleAction',
	        	'modelName' => 'Totelephone',
	        ),
	    );
	}

	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	public function actionCreate()
	{
		$model=new Totelephone;

		if(isset($_POST['Totelephone']))
		{
			$model->attributes=$_POST['Totelephone'];
			if($model->save())
				$this->redirect(array('index'));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		if(isset($_POST['Totelephone']))
		{
			$model->attributes=$_POST['Totelephone'];
			if($model->save())
				$this->redirect(array('index'));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	public function actionDelete($id)
	{
		if(Yii::app()->request->isPostRequest)
		{
			$this->loadModel($id)->delete();
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	public function actionIndex()
	{
		$model=new Totelephone('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Totelephone']))
			$model->attributes=$_GET['Totelephone'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	public function loadModel($id)
	{
		$model=Totelephone::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='totelephone-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
