<?php

class UserController extends Controller
{
	public function accessRules()
	{
		return array_merge(
			array(),
			// components/controller access rules
			parent::accessRules()
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
		$model=new User;

		if(isset($_POST['User']))
		{	
			$model->attributes=$_POST['User'];
			$temp;
			if($model->validate()){
				$temp=$model->password;
				$model->password=md5($model->password);
			}
			if($model->save()){
				Yii::app()->user->setFlash('success', '<strong>Başarılı!</strong> Yönetici ekleme işlemi başarıyla gerçekleşti.');
				$this->redirect(array('admin','id'=>$model->id));
			}
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		if(isset($_POST['User']))
		{
			$model->attributes=$_POST['User'];
			if($model->save()){
				Yii::app()->user->setFlash('success', '<strong>Tebrikler!</strong> Bilgileriniz başarıyla kaydedildi.');
				$this->redirect(array('view','id'=>$model->id));
			}
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	public function actionUpdateyourself($id)
	{

		if ($id!=Yii::app()->user->id){

			throw new CHttpException(403,'Bu işlemi gerçekleştirebilmek için yeterli yetkiniz yok.');
		}

		$model=$this->loadModel($id);

		if(isset($_POST['User']))
		{
			$model->attributes=$_POST['User'];
			if($model->save()){
				$this->redirect(array('view','id'=>$model->id));
			}
		}

		$this->render('updateyourself',array(
			'model'=>$model,
		));
	}

	public function actionDelete($id)
	{
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$this->loadModel($id)->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	public function actionAdmin()
	{
		$model=new User('search');
		$model->unsetAttributes();
		if(isset($_GET['User']))
			$model->attributes=$_GET['User'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	public function loadModel($id)
	{
		$model=User::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
	
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='user-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}