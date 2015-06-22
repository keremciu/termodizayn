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

	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	public function actionCreate($category='haberler')
	{
		$model=new News;
		$uploadform = "";

		$model->featured = 0;
		$model->author_id = Yii::app()->user->id;
		$model->date = date("Y-m-d");
		$model->create_data = date("Y-m-d H:i:s");
		$olddate = $model->date;
		$model->date = Yii::app()->dateFormatter->format("y-MM-dd",strtotime($olddate));
		$time = Yii::app()->dateFormatter->format("hh:mm",strtotime($olddate));

		// Get ordering list
		$criteria=new CDbCriteria;
		$criteria->select='max(ordering) AS ordering';		
		$row = $model->find($criteria); 	
		$lastorder = $row['ordering']+1;

		// set last order
		$model->ordering = $lastorder;
		$orderdata = CHtml::listData($model->findAll(array('order' => 'ordering')),'ordering','title');
		$orderinglist = CMap::mergeArray(array(0=>'0 İlk sırada'),$orderdata,array($lastorder=>$lastorder.' Son sırada'));

		$categorydata = CHtml::listData(Category::model()->findAll(array('condition'=>'type="content"','order' => 'title')),'id','title');

		if (isset($category)) {
			// If we had a category variable
			$item = Category::model()->findByAttributes(array('slug'=>$category));
			$model->category = $item->id;
		}

		if(isset($_POST['News']))
		{
			$model->attributes=$_POST['News'];
			$model->setTags($_POST['tags']);
			$model->date = $model->date . ' ' . $model->time;
			
			$image=CUploadedFile::getInstance($model,'image');
			if ($image) {
				$model->image = rand(0,99999999).'-'.rand(0,99999999).'-'.rand(0,99999999).'.jpg';
			}
			
			if($model->save()) {
				if ($image) {
					$root = Yii::getPathOfAlias('webroot').'/../img/news/';
					$image->saveAs($root.$model->image);
					
					$mini_news_photo_sizes = Yii::app()->settings->get("photo","news_mini");
					$photo_size = explode(",", $mini_news_photo_sizes);
					$thumb=Yii::app()->phpThumb->create($root.$model->image)->adaptiveResize($photo_size[0],$photo_size[1])->save($root.'thumbs/min'.$model->image);
				}
				$this->redirect(array('index','category'=>$category));
			}
		}

		$this->render('create',array(
			'model'=>$model,
			'uploadform'=>$uploadform,
			'orderinglist'=>$orderinglist,
			'categories'=>$categorydata
		));
	}

	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);
		$name=$model->image;	
		$uploadform = "";

		$categorydata = CHtml::listData(Category::model()->findAll(array('order' => 'title')),'id','title');

		// Get ordering list
		$criteria=new CDbCriteria;
		$criteria->select='max(ordering) AS ordering';		
		$row = $model->find($criteria); 	
		$lastorder = $row['ordering']+1;
		
		// set last order
		$orderdata = CHtml::listData($model->findAll(array('order' => 'ordering')),'ordering','title');
		$orderinglist = CMap::mergeArray(array(0=>'0 İlk sırada'),$orderdata,array($lastorder=>$lastorder.' Son sırada'));

		if(isset($_POST['News']))
		{
			$model->attributes=$_POST['News'];
			$model->setTags($_POST['tags']);
			$model->date = $model->date . ' ' . $model->time;

			$news_path = Yii::app()->settings->get("photo","news_path");

			$image=CUploadedFile::getInstance($model,'image');
			if(isset($image)){
				$model->image = rand(0,99999999).'-'.rand(0,99999999).'-'.rand(0,99999999).'.jpg';
			} else {
				$model->image = $name;
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

			if($model->save()){
				if(isset($image)){
					$image->saveAs(Yii::getPathOfAlias('webroot').'/../'.$news_path.$model->image);
					$webroot = Yii::getPathOfAlias('webroot');
					$postimage ='/../'.$news_path.$name;
					$mini_news_photo_sizes = Yii::app()->settings->get("photo","news_mini");
					$photo_size = explode(",", $mini_news_photo_sizes);
					$thumb=Yii::app()->phpThumb->create($webroot.$postimage)->adaptiveResize($photo_size[0],$photo_size[1])->save($webroot.'/../'.$news_path.'thumbs/min'.$model->image);
					
					if ((file_exists($webroot.$postimage)) AND ((is_dir($webroot.$postimage))==false)) {
						unlink($webroot.$postimage);
					}	
				}
				$this->redirect(array('index','category'=>$model->category0->slug));
			}
		}

		$this->render('update',array(
			'model'=>$model,
			'uploadform'=>$uploadform,
			'categories'=>$categorydata,
			'orderinglist'=>$orderinglist
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

	public function actionIndex($category)
	{
		$model=new News('search');
		$model->unsetAttributes();
		if ($category) {
			// If we had a type variable
			$category = $item = Category::model()->findByAttributes(array('slug'=>$category));
			$model->category = $item->id;
		}

		if(isset($_GET['News']))
			$model->attributes=$_GET['News'];

		$this->render('admin',array(
			'model'=>$model,
			'category'=>$category
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
