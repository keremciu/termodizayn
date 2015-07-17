<?php
class CatalogController extends Controller
{
/**
* @var string the default layout for the views. Defaults to '//layouts/column2', meaning
* using two-column layout. See 'protected/views/layouts/column2.php'.
*/
/**
* @return array action filters
*/
public function filters()
{
return array(
'accessControl', // perform access control for CRUD operations
);
}
/**
* Specifies the access control rules.
* This method is used by the 'accessControl' filter.
* @return array access control rules
*/
public function accessRules()
{
return array(
array('allow',  // allow all users to perform 'index' and 'view' actions
'actions'=>array('index','view'),
'users'=>array('*'),
),
array('allow', // allow authenticated user to perform 'create' and 'update' actions
'actions'=>array('create','update'),
'users'=>array('@'),
),
array('allow', // allow admin user to perform 'admin' and 'delete' actions
'actions'=>array('admin','delete'),
'users'=>array('admin'),
),
array('deny',  // deny all users
'users'=>array('*'),
),
);
}
/**
* Displays a particular model.
* @param integer $id the ID of the model to be displayed
*/
public function actionView($id)
{
$this->render('view',array(
'model'=>$this->loadModel($id),
));
}
public function actionCreate()
{
	$model=new Catalog;
	
	if(isset($_POST['Catalog'])) {
		$model->attributes=$_POST['Catalog'];
		$path = Yii::app()->settings->get("photo","catalog_path");
		$root = Yii::getPathOfAlias('webroot').'/../'.$path;
		$image=CUploadedFile::getInstance($model,'image');
		$ext = pathinfo($image, PATHINFO_EXTENSION);
			
		if(!empty($image)) {
			$model->image = rand(0,99999999).'-'.rand(0,99999999).'-'.rand(0,99999999).'.'.$ext;
			$image->saveAs($root.$model->image);
		}
		$model->path = CUploadedFile::getInstance($model,'path');
			
		if(!empty($model->path)) {
			$model->path->saveAs($root.$model->path);
		}
				
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
	if(isset($_POST['Catalog'])) {
		$oldimage = $model->image;
		$oldfile = $model->path;
		$model->attributes=$_POST['Catalog'];
		$path = Yii::app()->settings->get("photo","catalog_path");
		$root = Yii::getPathOfAlias('webroot').'/../'.$path;
		$image=CUploadedFile::getInstance($model,'image');
		$ext = pathinfo($image, PATHINFO_EXTENSION);
			
		if(!empty($image) && !($image === null) && $image ) {
			$item = rand(0,99999999).'-'.rand(0,99999999).'-'.rand(0,99999999).'.'.$ext;
			if ($image->saveAs($root.$item)) {
				$model->image = $item;
				if (file_exists($root.$oldimage)) {
					unlink($root.$oldimage);
				}
			}
		} else {
			$model->image = $oldimage;
		}
		
		$file = CUploadedFile::getInstance($model,'path');
		if(!empty($file) && ($file != null) && $file) {
			if ($file->saveAs($root.$file)) {
				$model->path = $file;
				if (file_exists($root.$oldfile)) {
					unlink($root.$oldfile);
				}
			}
		} else {
			$model->path = $oldfile;
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

		if($model->save())
			$this->redirect(array('index'));
	}
		$this->render('update',array(
			'model'=>$model,
		));
}
/**
* Deletes a particular model.
* If deletion is successful, the browser will be redirected to the 'admin' page.
* @param integer $id the ID of the model to be deleted
*/
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
/**
* Manages all models.
*/
public function actionIndex()
{
$model=new Catalog('search');
$model->unsetAttributes();  // clear any default values
if(isset($_GET['Catalog']))
$model->attributes=$_GET['Catalog'];
$this->render('admin',array(
'model'=>$model,
));
}
/**
* Returns the data model based on the primary key given in the GET variable.
* If the data model is not found, an HTTP exception will be raised.
* @param integer the ID of the model to be loaded
*/
public function loadModel($id)
{
$model=Catalog::model()->findByPk($id);
if($model===null)
throw new CHttpException(404,'The requested page does not exist.');
return $model;
}
/**
* Performs the AJAX validation.
* @param CModel the model to be validated
*/
protected function performAjaxValidation($model)
{
if(isset($_POST['ajax']) && $_POST['ajax']==='catalog-form')
{
echo CActiveForm::validate($model);
Yii::app()->end();
}
}
}