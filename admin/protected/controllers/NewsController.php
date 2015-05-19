<?php
class NewsController extends Controller
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
	        	'modelName' => 'News',
	        ),
	        'sortable' => array(
                'class'     => 'bootstrap.actions.TbSortableAction',
                'modelName' => 'News'
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
		$model=new News;
		$uploadform = "";

		if(isset($_POST['News']))
		{
			$model->attributes=$_POST['News'];
			$model->setTags($_POST['tags']);
			$time = $_POST['time'];
			$model->date = $model->date . ' ' . $time;
			
			$image=CUploadedFile::getInstance($model,'image');
			if ($image) {
				$model->image = rand(0,99999999).'-'.rand(0,99999999).'-'.rand(0,99999999).'.jpg';
			}
			
			if($model->save()) {
				if ($image) {
					$root = Yii::getPathOfAlias('webroot').'/../images/news/';
					$image->saveAs($root.$model->image);
					$thumb=Yii::app()->phpThumb->create($root.$model->image)->adaptiveResize(360,150)->save($root.'thumbs/min'.$model->image);
				}
				$this->redirect(array('index'));
			}
		}

		$this->render('create',array(
			'model'=>$model,
			'uploadform'=>$uploadform
		));
	}

	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);
		$name=$model->image;	
		$uploadform = "";

		if(isset($_POST['News']))
		{
			$model->attributes=$_POST['News'];
			$model->setTags($_POST['tags']);
			$time = $_POST['time'];
			$model->date = $model->date . ' ' . $time;

			$image=CUploadedFile::getInstance($model,'image');
			if(isset($image)){
				$model->image = rand(0,99999999).'-'.rand(0,99999999).'-'.rand(0,99999999).'.jpg';
			} else {
				$model->image = $name;
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

								$isset = Translates::model()->find(array(
									'condition'=>'((reference_id=:refid AND reference_field=:field) AND lang_id=:lang) AND reference_table=:table',
									'params'=>array(':refid'=>$model->id,
									':field'=>$lang[0],
									':lang'=>$lang[1],
									':table'=>$model->tableSchema->name
								)));

								if ($isset) {
									$isset->value=$translate;
									$isset->save();;
								} else {
									$add = new Translates;
									$add->lang_id = $lang[1];
									$add->reference_id = $id;
									$add->reference_table = $model->tableSchema->name;
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

			if($model->save()){
				if(isset($image)){
					$image->saveAs(Yii::getPathOfAlias('webroot').'/../images/news/'.$model->image);
					$webroot = Yii::getPathOfAlias('webroot');
					$postimage ='/../images/news/'.$name;
					$thumb=Yii::app()->phpThumb->create($webroot.$postimage)->adaptiveResize(360,150)->save($webroot.'/../images/news/thumbs/min'.$model->image);
					
					if ((file_exists($webroot.$postimage)) AND ((is_dir($webroot.$postimage))==false)) {
						unlink($webroot.$postimage);
					}	
				}
				$this->redirect(array('index'));
			}
		}

		$this->render('update',array(
			'model'=>$model,
			'uploadform'=>$uploadform
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
		$model=new News('search');
		$model->unsetAttributes();
		if(isset($_GET['News']))
			$model->attributes=$_GET['News'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	public function loadModel($id)
	{
		$model=News::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='news-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}