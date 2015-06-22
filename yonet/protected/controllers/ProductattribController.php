<?php

class ProductattribController extends Controller
{

	public function accessRules()
	{
		return array_merge(
			array(),
			// components/controller
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
		$model=new ProductAttrib;

		// Get ordering list
		$criteria=new CDbCriteria;
		$criteria->select='max(ordering) AS ordering';
		$row = $model->find($criteria); 	
		$lastorder = $row['ordering']+1;
			
		// set last order
		$model->ordering = $lastorder;

		if(isset($_POST['ProductAttrib'])) {
			$model->attributes=$_POST['ProductAttrib'];
			
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

		if(isset($_POST['ProductAttrib'])) {
			$model->attributes=$_POST['ProductAttrib'];

			// translate code here
			$currentLang = Yii::app()->language;
			$languages = Yii::app()->params->languages;
			
			foreach($languages as $key=>$lang) {
				if($key != $currentLang) {
					if(isset($_POST['publish_'.$key])) {
						$this->translateIt($_POST['translate'],$model,$id);
					}
				}
			}
			
			if($model->save())
				$this->redirect(array('index'));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	public function actionDelete($id) {
	
		if(Yii::app()->request->isPostRequest) {
			$this->loadModel($id)->delete();

			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		} else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	public function actionIndex() {
		$model=new ProductAttrib('search');
		$model->unsetAttributes();  // clear any default values
		
		if(isset($_GET['ProductAttrib']))
			$model->attributes=$_GET['ProductAttrib'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	public function loadModel($id) {
		$model=ProductAttrib::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		
		return $model;
	}

	protected function performAjaxValidation($model) {
		if(isset($_POST['ajax']) && $_POST['ajax']==='product-attrib-form') {
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}