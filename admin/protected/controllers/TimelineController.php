<?php

class TimelineController extends Controller
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
				'actions'=>array('index','delete','toggle','sortable'),
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
	        	'modelName' => 'Timeline',
	        ),
	        'sortable' => array(
                'class'     => 'bootstrap.actions.TbSortableAction',
                'modelName' => 'Timeline'
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
		$model=new Timeline;

		if(isset($_POST['Timeline']))
		{
			$model->attributes=$_POST['Timeline'];
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

		if(isset($_POST['Timeline']))
		{
			$model->attributes=$_POST['Timeline'];


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
									$add->reference_id = $model->id;
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
		$model=new Timeline('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Timeline']))
			$model->attributes=$_GET['Timeline'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	public function loadModel($id)
	{
		$model=Timeline::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='timeline-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
