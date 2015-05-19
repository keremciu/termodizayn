<?php

class HrController extends Controller
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
	        	'modelName' => 'Hr',
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
		$model=new Hr;

		if(isset($_POST['Hr']))
		{
			$model->attributes=$_POST['Hr'];
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

		if(isset($_POST['Hr']))
		{
			$model->attributes=$_POST['Hr'];
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

	protected function renderCV($data,$row)
  	{     
    	return '<a href="'.Yii::app()->baseUrl ."/../images/cvfiles/".$data->cv.'">CV dosyasını görüntüle</a>';
    
  	}

	public function actionIndex()
	{
		$model=new Hr('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Hr']))
			$model->attributes=$_GET['Hr'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	public function loadModel($id)
	{
		$model=Hr::model()->findByPk($id);
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
