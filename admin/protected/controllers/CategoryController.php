<?php

class CategoryController extends Controller
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
				'actions'=>array('index','delete','toggle','sortable','fixcategory'),
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
	        	'modelName' => 'Category',
	        ),
	        'sortable' => array(
                'class'     => 'bootstrap.actions.TbSortableAction',
                'modelName' => 'Category'
            ),
	    );
	}

	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	public function actionFixcategory()
    {
      	$categorytype = (!empty($_GET['categorytype'])) ? $_GET['categorytype']: '0';
      	if ($categorytype == "content") {
      		$data = CHtml::listData(Category::model()->findAll(array('condition'=>'type = "content"','order' => 'ordering')),'id','parentname');
			echo "<option value=''>Bu kategori alt kategorisi olacaksa, bir üst kategorisini seçmelisiniz</option>";
			foreach($data as $value=>$name)
			   echo CHtml::tag('option', array('value'=>$value),CHtml::encode($name),true);
		} else if ($categorytype == "product") {
			$data = CHtml::listData(Category::model()->findAll(array('condition'=>'type = "product"','order' => 'ordering')),'id','parentname');
			echo "<option value=''>Bu kategori alt kategorisi olacaksa, bir üst kategorisini seçmelisiniz</option>";
			foreach($data as $value=>$name)
			   echo CHtml::tag('option', array('value'=>$value),CHtml::encode($name),true);
		}
   }       

	public function actionCreate()
	{
		$model=new Category;

		if(isset($_POST['Category']))
		{
			$model->attributes=$_POST['Category'];

			$image=CUploadedFile::getInstance($model,'image');
			if ($image) {
				$model->image = rand(0,99999999).'-'.rand(0,99999999).'-'.rand(0,99999999).'.jpg';
			}
			if($model->save()) {
				if ($image) {
					$root = Yii::getPathOfAlias('webroot').'/../'.Yii::app()->settings->get("photo","category_path");
					$image->saveAs($root.$model->image);
					$mini_category_photo_sizes = Yii::app()->settings->get("photo","category_mini");
					$photo_size = explode(",", $mini_category_photo_sizes);
					$thumb=Yii::app()->phpThumb->create($root.$model->image)->adaptiveResize($photo_size[0],$photo_size[1])->save($root.'thumbs/min'.$model->image);
				}
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
		$name=$model->image;

		if(isset($_POST['Category']))
		{
			$model->attributes=$_POST['Category'];

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

			if($model->save()) {
				if(isset($image)){
					$category_path = Yii::app()->settings->get("photo","category_path");
					$webroot = Yii::getPathOfAlias('webroot');
					$image->saveAs($webroot.'/../'.$category_path.$model->image);
					$postimage ='/../'.$category_path;
					$mini_category_photo_sizes = Yii::app()->settings->get("photo","category_mini");
					$photo_size = explode(",", $mini_category_photo_sizes);
					$thumb=Yii::app()->phpThumb->create($webroot.$postimage.$model->image)->adaptiveResize($photo_size[0],$photo_size[1])->save($webroot.$postimage.'thumbs/min'.$model->image);
					if (is_file($webroot.$postimage.$name)) {
						unlink($webroot.$postimage.$name);
						unlink($webroot.$postimage."thumbs/min".$name);
					}	
				}
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
			$this->loadModel($id)->delete();
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	public function actionIndex()
	{
		$model=new Category('search');
		$model->unsetAttributes();

		if(isset($_GET['Category']))
			$model->attributes=$_GET['Category'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	public function loadModel($id)
	{
		$model=Category::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='category-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
