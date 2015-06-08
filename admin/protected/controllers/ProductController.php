<?php

class ProductController extends Controller
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
				'actions'=>array('index','sortable','toggle','delete','extraimagedelete','extrafiledelete','extravideodelete'),
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
	        	'modelName' => 'Product',
	        ),
	        'sortable' => array(
                'class'     => 'bootstrap.actions.TbSortableAction',
                'modelName' => 'Product'
            ),
	    );
	}

	public function actionExtraimagedelete($id) {
		$model = Pimages::model()->findByPk($id);
		if (unlink(Yii::getPathOfAlias('webroot').'/../images/products/product/extras/'.$model->path)) {
			$model->delete();
			return true;
		} else {
			return false;
		}
	}

	public function actionExtrafiledelete($id) {
		$model = Pimages::model()->findByPk($id);
		if (unlink(Yii::getPathOfAlias('webroot').'/../images/products/product/documents/'.$model->path)) {
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

		if(isset($_POST['Product']))
		{
			$model->attributes=$_POST['Product'];
			$model->setTags($_POST['tags']);

			$product_path = Yii::app()->settings->get("photo","product_path");

			$image=CUploadedFile::getInstance($model,'image');
			if ($image) {
				$ext = pathinfo($image, PATHINFO_EXTENSION);
				$model->image = rand(0,99999999).'-'.rand(0,99999999).'-'.rand(0,99999999).'.'.$ext;
			}

			if($model->save()) {

				// Upload extra images
				$images = CUploadedFile::getInstancesByName('images');
				
				if (isset($images) && count($images) > 0) {
	 				
	                foreach ($images as $key => $pic) {
	                	$criteria=new CDbCriteria;
						$criteria->select='max(ordering) AS ordering';
						$criteria->condition = "type = 'image' AND pid = ".$model->id;
						$row = Pimages::model()->find($criteria);
						$eximagedesc = "eximagedesc".($key+1);
						$newname = rand(0,99999999).'-'.rand(0,99999999).'-'.rand(0,99999999).'.'.$ext;

	                    if ($pic->saveAs(Yii::getPathOfAlias('webroot').'/../'.$product_path.'extras/'.$newname)) {
	                        $img_add = new Pimages;
	                        if (isset($_POST[$eximagedesc])) {
	                        	$img_add->name = $_POST[$eximagedesc];
	                        } else {
	                        	$img_add->name = "";
	                        }
	                        $img_add->path = $newname;
	                        $img_add->type = "image";
	                        $img_add->size = $pic->size;
	                        $img_add->ordering = $row["ordering"]+1;
	                        $img_add->pid = $model->id;
	                        $img_add->active = 1;
	                        $img_add->save();
	                    }
	                }
	           }

	           // Upload extra documents
	           $files = CUploadedFile::getInstancesByName('files');

	          	if (isset($files) && count($files) > 0) {
	 				
	                foreach ($files as $key => $file) {
	                	$criteria=new CDbCriteria;
						$criteria->select='max(ordering) AS ordering';
						$criteria->condition = "type = 'file' AND pid = ".$model->id;
						$row = Pimages::model()->find($criteria);
						$exfiledesc = "exfiledesc".($key+1);

	                    if ($file->saveAs(Yii::getPathOfAlias('webroot').'/../'.$product_path.'documents/'.$file->name)) {
	                        $doc_add = new Pimages;
	                        $doc_add->name = $_POST[$exfiledesc];
	                        $doc_add->path = $file->name;
	                        $doc_add->type = "file";
	                        $doc_add->size = $file->size;
	                        $doc_add->ordering = $row["ordering"]+1;
	                        $doc_add->pid = $model->id;
	                        $doc_add->active = 1;
	                        $doc_add->save();
	                    }
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
				
				if ($image) {
					$root = Yii::getPathOfAlias('webroot').'/../'.$product_path;
					$image->saveAs($root.$model->image);
					$mini_product_photo_sizes = Yii::app()->settings->get("photo","product_mini");
					$photo_size = explode(",", $mini_product_photo_sizes);
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

		if(isset($_POST['Product']))
		{
			$model->attributes=$_POST['Product'];
			$model->setTags($_POST['tags']);

			$image=CUploadedFile::getInstance($model,'image');
			if(isset($image)){
				$model->image = rand(0,99999999).'-'.rand(0,99999999).'-'.rand(0,99999999).'.jpg';
			} else {
				$model->image = $name;
			}

			$product_path = Yii::app()->settings->get("photo","product_path");

			// Upload extra images
			$images = CUploadedFile::getInstancesByName('images');

			if (isset($images) && count($images) > 0) {
 				
                foreach ($images as $key => $pic) {
                	$criteria=new CDbCriteria;
					$criteria->select='max(ordering) AS ordering';
					$criteria->condition = "type = 'image' AND pid = ".$model->id;
					$row = Pimages::model()->find($criteria);
					$eximagedesc = "eximagedesc".($key+1);
					$newname = rand(0,99999999).'-'.rand(0,99999999).'-'.rand(0,99999999).'.jpg';

                    if ($pic->saveAs(Yii::getPathOfAlias('webroot').'/../'.$product_path.'extras/'.$newname)) {
                        $img_add = new Pimages;
                        if (isset($_POST[$eximagedesc])) {
                        	$img_add->name = $_POST[$eximagedesc];
                        } else {
                        	$img_add->name = "";
                        }
                        $img_add->path = $newname;
                        $img_add->type = "image";
                        $img_add->size = $pic->size;
                        $img_add->ordering = $row["ordering"]+1;
                        $img_add->pid = $model->id;
                        $img_add->active = 1;
                        $img_add->save();
                    }
                }
           }

            // Update extra image descs
			if (isset($_POST['Eximagedescs'])) {
				$eximagedesc = $_POST['Eximagedescs'];

				foreach ($eximagedesc as $key => $eximage) {
					$id = str_replace("eximagedesc","",$key);
					$expil = Pimages::model()->findByPk($id);
					$expil->name = $eximage;
					$expil->save();
				}
			}


           // Upload extra documents
           $files = CUploadedFile::getInstancesByName('files');

          	if (isset($files) && count($files) > 0) {
 				
                foreach ($files as $key => $file) {
                	$criteria=new CDbCriteria;
					$criteria->select='max(ordering) AS ordering';
					$criteria->condition = "type = 'file' AND pid = ".$model->id;
					$row = Pimages::model()->find($criteria);
					$exfiledesc = "exfiledesc".($key+1);

                    if ($file->saveAs(Yii::getPathOfAlias('webroot').'/../'.$product_path.'documents/'.$file->name)) {
                        $doc_add = new Pimages;
                        $doc_add->name = $_POST[$exfiledesc];
                        $doc_add->path = $file->name;
                        $doc_add->type = "file";
                        $doc_add->size = $file->size;
                        $doc_add->ordering = $row["ordering"]+1;
                        $doc_add->pid = $model->id;
                        $doc_add->active = 1;
                        $doc_add->save();
                    }
                }
         	}

         	// Update extra document descs
			if (isset($_POST['Exfiledescs'])) {
				$exfiledescs = $_POST['Exfiledescs'];

				foreach ($exfiledescs as $key => $exfile) {
					$id = str_replace("exfiledesc","",$key);
					$exdoc = Pimages::model()->findByPk($id);
					$exdoc->name = $exfile;
					$exdoc->save();
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

			// Update video descs
			if (isset($_POST['Exvideodescs'])) {
				$exvideodescs = $_POST['Exvideodescs'];

				foreach ($exvideodescs as $key => $exvideo) {
					$id = str_replace("exvideodesc","",$key);
					$exvid = Pimages::model()->findByPk($id);
					$exvid->name = $exvideo;
					$exvid->save();
				}
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
									$isset->original_value=$model->$lang[0];
									$isset->original_text=$model->$lang[0];
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

			if($model->save()) { 
				if(isset($image)){
					$webroot = Yii::getPathOfAlias('webroot');
					$image->saveAs($webroot.'/../'.$product_path.$model->image);
					$postimage ='/../'.$product_path;
					$mini_product_photo_sizes = Yii::app()->settings->get("photo","product_mini");
					$photo_size = explode(",", $mini_product_photo_sizes);
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
