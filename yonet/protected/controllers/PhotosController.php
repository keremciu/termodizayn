<?php

class PhotosController extends Controller
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
				'roles'=>array('dealer'),
			),
			array('allow',
				'actions'=>array('index','toggle','sortable','delete'),
				'roles'=>array('admin'),
			),
			array('deny',
				'users'=>array('*'),
			),
		);
	}

	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	public function actionCreate($type=NULL)
	{
		$model=new Photos;
		if (isset($type)) {
			// If we had a type variable
			$item = $gallery = Gallery::model()->findByAttributes(array('slug'=>$type));
			$model->gallery = $item->id;
		}

		$criteria=new CDbCriteria;
		$criteria->select='max(ordering) AS ordering';		
		$row = $model->find($criteria); 	
		$lastorder = $row['ordering']+1;
		$gallerydata = CHtml::listData(Gallery::model()->findAll(array('order' => 'id')),'id','name');
		$model->min_photo = 0;
		$orderdata = CHtml::listData($model->findAll(array('order' => 'ordering')),'ordering','name');
		if ($model->isNewRecord) {
			$model->ordering = $lastorder;
		}
		$orderinglist = CMap::mergeArray(array(0=>'0 İlk sırada'),$orderdata,array($lastorder=>$lastorder.' Son sırada'));

		if(isset($_POST['Photos']))
		{
			$model->attributes=$_POST['Photos'];

 			$image=CUploadedFile::getInstance($model,'image');
 			if (isset($_POST['Photos']["desc"])) {
 				$model->desc = $_POST['Photos']["desc"];
 			}
 			$ext = pathinfo($image, PATHINFO_EXTENSION);

 			$gallery = Gallery::model()->findByPk($model->gallery);

				if ($image) {
					$model->photo = rand(0,99999999).'-'.rand(0,99999999).'-'.rand(0,99999999).'.'.$ext;
					$root = Yii::getPathOfAlias('webroot').'/../img/photos/';
					$image->saveAs($root.$model->photo);
					if (($gallery->icon != 0) OR ($gallery->icon == "")) {
						if(strpos($gallery->icon, 'x') !== false) {
							$xy = explode("x", $gallery->icon);
						} else {
						  	$xy[0] = 220; $xy[1]=124;
						}
						$thumb=Yii::app()->phpThumb->create($root.$model->photo)->adaptiveResize($xy[0],$xy[1])->save($root.'thumbs/min'.$model->photo);
					}

					$model->min_photo = 'min'.$model->photo;
				}

			if($model->save()) {
				$this->redirect(array('index','type'=>$type));
			}
		}

		$this->render('create',array(
			'model'=>$model,
			'galleries'=>$gallerydata,
			'orderinglist'=>$orderinglist
		));
	}

	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);


		$criteria=new CDbCriteria;
		$criteria->select='max(ordering) AS ordering';		
		$row = $model->find($criteria); 	
		$lastorder = $row['ordering']+1;
		$orderdata = CHtml::listData($model->findAll(array('order' => 'ordering')),'ordering','name');
		$orderinglist = CMap::mergeArray(array(0=>'0 İlk sırada'),$orderdata,array($lastorder=>$lastorder.' Son sırada'));

		$gallerydata = CHtml::listData(Gallery::model()->findAll(array('order' => 'id')),'id','name');

		if(isset($_POST['Photos']))
		{
			$model->attributes=$_POST['Photos'];
			$image=CUploadedFile::getInstance($model,'image');
 			$ext = pathinfo($image, PATHINFO_EXTENSION);
 			$model->desc = $_POST['Photos']["desc"];

 			$gallery = Gallery::model()->findByPk($model->gallery);
 				if ($image) {
					$root = Yii::getPathOfAlias('webroot').'/../img/photos/';
					if (file_exists($root.$model->photo)) {
						unlink($root.$model->photo);
					}
					if (file_exists($root.'thumbs/min'.$model->photo)) {
						unlink($root.'thumbs/min'.$model->photo);
					}
					$model->photo = rand(0,99999999).'-'.rand(0,99999999).'-'.rand(0,99999999).'.'.$ext;
					$image->saveAs($root.$model->photo);
					if (($gallery->icon != 0) OR ($gallery->icon == "")) {
						if(strpos($gallery->icon, 'x') !== false) {
							$xy = explode("x", $gallery->icon);
						} else {
						  	$xy[0] = 220; $xy[1]=124;
						}
						$thumb=Yii::app()->phpThumb->create($root.$model->photo)->adaptiveResize($xy[0],$xy[1])->save($root.'thumbs/min'.$model->photo);
					}
					$model->min_photo = 'min'.$model->photo;
				}

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

			if($model->save()) {
				
				$this->redirect(array('index'));
			}
		}

		$this->render('update',array(
			'model'=>$model,
			'galleries'=>$gallerydata,
			'orderinglist'=>$orderinglist
		));
	}

	public function actionDelete($id)
	{
		if(Yii::app()->request->isPostRequest)
		{
			$model = $this->loadModel($id);
			$root = Yii::getPathOfAlias('webroot').'/../img/photos/';
			if (file_exists($root.$model->photo)) {
				unlink($root.$model->photo);
			}
			if (file_exists($root.'thumbs/min'.$model->photo)) {
				unlink($root.'thumbs/min'.$model->photo);
			}
			$model->delete();
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	public function actionIndex($type=NULL)
	{
		$model=new Photos('search');
		$model->unsetAttributes();  // clear any default values
		if ($type) {
			// If we had a type variable
			$type = $gallery = Gallery::model()->findByAttributes(array('slug'=>$type));
			$model->gallery = $type->id;
		}

		$this->breadcrumbs=array('Fotoğraflar'=>array('index'),'Fotoğraf Listesi');

		// Gallery List for selectbox
		$gallerydata = CHtml::listData(Gallery::model()->findAll(array('order' => 'id')),'id','name');

		// Ordering List
		$criteria=new CDbCriteria;
		$criteria->select='max(ordering) AS ordering';
		$row = $model->find($criteria);
		$lastorder = $row['ordering']+1;

		//  quick add a photo
		if(isset($_GET['Photos']))
			$model->attributes=$_GET['Photos'];

		$this->render('admin',array(
			'model'=>$model,
			'type'=>$type,
			'galleries'=>$gallerydata,
			'lastorder'=>$lastorder
		));
	}

	public function loadModel($id)
	{
		$model=Photos::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='photos-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
