<?php

class ProductController extends Controller
{
	public function accessRules()
	{
		return array_merge(
			array(),
			// components/controller access rules
			parent::accessRules()
		);
	}

	public function actionExtraimagedelete($id) {
		$model = Pimages::model()->findByPk($id);
		$product_path = Yii::app()->settings->get("photo","product_path");
		if (unlink(Yii::getPathOfAlias('webroot').'/../'.$product_path.'extras/'.$model->path)) {
			$model->delete();
			return true;
		} else {
			return false;
		}
	}

	public function actionExtrafiledelete($id) {
		$model = Pimages::model()->findByPk($id);
		$product_path = Yii::app()->settings->get("photo","product_path");
		if (unlink(Yii::getPathOfAlias('webroot').'/../'.$product_path.'documents/'.$model->path)) {
			$model->delete();
			return true;
		} else {
			return false;
		}
	}

	public function actionExtravideodelete($id) {
		$model = Pimages::model()->findByPk($id);
		$model->delete();
	}

	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	public function actionCreate()
	{
		$model=new Product;

		$categories = CHtml::listData(Category::model()->findAll(array('condition'=>'type = "product" AND parent != 0','order'=>'ordering','group'=>'t.id')),'id','title');

		if(isset($_POST['Product']))
		{
			$model->attributes=$_POST['Product'];
			$model->setTags($_POST['tags']);

			$product_path = Yii::app()->settings->get("photo","product_path");

			if($model->save()) {

				// Get and Save Product attribs
				if (isset($_POST['select-specifications'])) {
					$attribs = $_POST['select-specifications'];

					foreach ($attribs as $key => $attr) {
						$split_key = explode("attr_",$key);
						$getinput = 'specification-value-'.$split_key[1];
				       	$input = $_POST[$getinput];
				       	$ordering = 'specification-ordering-'.$split_key[1];
				       	$orderinput = $_POST[$ordering];
						$onthelist = 'show-on-list-'.$split_key[1];
						if (isset($_POST[$onthelist]))
							$listinput = $_POST[$onthelist];
						else
							$listinput = 0;

						$map = New ProductAttribMap;
						$map->product_id = $model->id;
						$map->attrib_id = $attr;
						$map->value = $input;
						$map->ordering = $orderinput;
						$map->on_list = $listinput;
						if (!$map->save()) {

						}
					}
				}

				// Get uploaded extra images
				if (isset($_POST['images'])) {
					$images = $_POST['images'];
						foreach ($images as $key => $pic) {
							$img_add = new Pimages;
	                        $img_add->name = '';
	                        $img_add->path = $pic;
	                        $img_add->type = "image";
	                        $img_add->size = "0";
	                        $img_add->ordering = $key+1;
	                        $img_add->pid = $model->id;
	                        $img_add->active = 1;
	                        if (!$img_add->save()) {
	                        	print_r($img_add->getErrors());
	                        	exit();
							}
						}
				}

				// Get uploaded doo images
				if (isset($_POST['files'])) {
					$files = $_POST['files'];
						foreach ($files as $key => $file) {
							$doc_add = new Pimages;
	                        $doc_add->name = '';
	                        $doc_add->path = $file;
	                        $doc_add->type = "file";
	                        $doc_add->size = "0";
	                        $doc_add->ordering = $key+1;
	                        $doc_add->pid = $model->id;
	                        $doc_add->active = 1;
	                        $doc_add->save();
						}
				}

	         	// Upload videos
				if (isset($_POST['videos'])) {
					$videos = $_POST['videos'];

						foreach ($videos as $key => $video) {
							$exvideodesc = "exvideodesc".($key+1);

							$vid_add = new Pimages;
	                        $vid_add->name = $_POST[$exvideodesc];
	                        $vid_add->path = $video;
	                        $vid_add->type = "video";
	                        $vid_add->size = "0";
	                        $vid_add->ordering = $row["ordering"]+1;
	                        $vid_add->pid = $model->id;
	                        $vid_add->active = 1;
	                        $vid_add->save();
						}
				}
				
				$this->redirect(array('index'));
			}
		}

		$this->render('create',array(
			'model'=>$model,
			'categories'=>$categories
		));
	}

	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		$categories = CHtml::listData(Category::model()->findAll(array('condition'=>'type = "product" AND parent != 0','order'=>'ordering','group'=>'t.id')),'id','title');

		if(isset($_POST['Product']))
		{
			$model->attributes=$_POST['Product'];
			$model->setTags($_POST['tags']);

				// Get and Save Product Variables
				if (isset($_POST['select-specifications'])) {
					$attribs = $_POST['select-specifications'];

					foreach ($attribs as $key => $attr) {
						$split_key = explode("attr_",$key);
						$getinput = 'specification-value-'.$split_key[1];
				       	$input = $_POST[$getinput];
				       	$ordering = 'specification-ordering-'.$split_key[1];
				       	$orderinput = $_POST[$ordering];
						$onthelist = 'show-on-list-'.$split_key[1];
						if (isset($_POST[$onthelist]))
							$listinput = $_POST[$onthelist];
						else
							$listinput = 0;

						$map = New ProductAttribMap;
						$map->product_id = $model->id;
						$map->attrib_id = $attr;
						$map->value = $input;
						$map->ordering = $orderinput;
						$map->on_list = $listinput;
						if (!$map->save()) {

						}
					}
				}


				// Update old attrib data
				if (isset($_POST['update-spec'])) {
					$savedattribs = $_POST['update-spec'];

					foreach ($savedattribs as $key => $attr) {
						$getinput = 'update-spec-value-'.$key;
						$input = $_POST[$getinput];
						$ordering = 'update-specification-ordering-'.$key;
				       	$orderinput = $_POST[$ordering];
						$onthelist = 'update-show-on-list-'.$key;

						if (isset($_POST[$onthelist]))
							$listinput = $_POST[$onthelist];
						else
							$listinput = 0;

						$updateattrib = ProductAttribMap::model()->findByPk($key);
						$updateattrib->attrib_id = $attr;
						$updateattrib->value = $input;
						$updateattrib->ordering = $orderinput;
						$updateattrib->on_list = $listinput;
						$updateattrib->save();

					}
				}

				// Get uploaded extra images
				if (isset($_POST['images'])) {
					$images = $_POST['images'];
						foreach ($images as $key => $pic) {
							$img_add = new Pimages;
	                        $img_add->name = '';
	                        $img_add->path = $pic;
	                        $img_add->type = "image";
	                        $img_add->size = "0";
	                        $img_add->ordering = $key+1;
	                        $img_add->pid = $model->id;
	                        $img_add->active = 1;
	                        $img_add->save();
						}
				}

				// Get uploaded doo images
				if (isset($_POST['files'])) {
					$files = $_POST['files'];
						foreach ($files as $key => $file) {
							$doc_add = new Pimages;
	                        $doc_add->name = '';
	                        $doc_add->path = $file;
	                        $doc_add->type = "file";
	                        $doc_add->size = "0";
	                        $doc_add->ordering = $key+1;
	                        $doc_add->pid = $model->id;
	                        $doc_add->active = 1;
	                        $doc_add->save();
						}
				}

         	// Upload videos
			if (isset($_POST['videos'])) {
				$videos = $_POST['videos'];

					foreach ($videos as $key => $video) {
						$criteria=new CDbCriteria;
						$criteria->select='max(ordering) AS ordering';
						$criteria->condition = "type = 'video' AND pid = ".$model->id;
						$row = Pimages::model()->find($criteria);
						$exvideodesc = "exvideodesc".($key+1);

						$vid_add = new Pimages;
                        $vid_add->name = $_POST[$exvideodesc];
                        $vid_add->path = $video;
                        $vid_add->type = "video";
                        $vid_add->size = "0";
                        $vid_add->ordering = $row["ordering"]+1;
                        $vid_add->pid = $model->id;
                        $vid_add->active = 1;
                        $vid_add->save();
					}
			}

			// update saved video details
			if (isset($_POST['savedvideo'])) {
				$savedvideos = $_POST['savedvideo'];
					foreach ($savedvideos as $key => $video) {
						$titleinput = 'savedvideodesc-'.$key;
						$title = $_POST[$titleinput];
						$exvid = Pimages::model()->findByPk($key);
						$exvid->name = $title;
						$exvid->path = $video;
						$exvid->save();
					}
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
			'categories'=>$categories
		));
	}

	public function actionDelete($id)
	{
		if(Yii::app()->request->isPostRequest)
		{
			$post = $this->loadModel($id);
			$post->removeAllTags()->save();
			$post->delete();

			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	public function actionIndex()
	{

		$model=new Product('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Product']))
			$model->attributes=$_GET['Product'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	public function loadModel($id)
	{
		$model=Product::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='product-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
