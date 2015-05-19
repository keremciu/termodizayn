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
				'roles'=>array('staff'),
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

	public function actions()
	{
	    return array(
	        'toggle' => array(
	        	'class'=>'bootstrap.actions.TbToggleAction',
	        	'modelName' => 'Photos',
	        ),
	        'sortable' => array(
                'class'     => 'bootstrap.actions.TbSortableAction',
                'modelName' => 'Photos'
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
		$model=new Photos;

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
				$this->redirect(array('index'));
			}

		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

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

			$currentLang = Yii::app()->language;
			$languages = Yii::app()->params->languages;

			foreach($languages as $key=>$lang) {
				if($key != $currentLang) {
					if(isset($_POST['publish_'.$key])) {
						$translates = $_POST['translate'];

						foreach ($translates as $key => $translate) {
							if ($translate != "") {
								$lang = explode("_", $key);

								$isset = Translates::model()->find(array('condition'=>'((reference_id=:refid AND reference_field=:field) AND lang_id=:lang) AND reference_table=:table','params'=>array(':refid'=>$model->id,':field'=>$lang[0],':lang'=>$lang[1],':table'=>"photos")));
								if ($isset) {
									$isset->value=$translate;
									$isset->save();;
								} else {
									$add = new Translates;
									$add->lang_id = $lang[1];
									$add->reference_id = $model->id;
									$add->reference_table = "photos";
									$add->reference_field = $lang[0];
									$add->value=$translate;
									$add->original_value=$model->$lang[0];
									$add->original_text=$model->$lang[0];
									$add->modified_by=1;
									$add->is_published=1;
									$add->save();
								}
							}
						}
					}
				}
			}

			if($model->save()) {
				
				$this->redirect(array('index'));
			}
		}

		$this->render('update',array(
			'model'=>$model,
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

	public function actionIndex()
	{
		$model=new Photos('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Photos']))
			$model->attributes=$_GET['Photos'];

		$this->render('admin',array(
			'model'=>$model,
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
