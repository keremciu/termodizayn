<?php

class TranslatesController extends Controller
{
	const PHPHEADER = "<?php
/**
* 
* Translation System
* 
* This file created automatic by CIU CMS System.
* This file must be saved as UTF-8.
* Please be carefull about your translations.
* If you have a problem, get in touch with me on info@kerem.ws.
*
**/

return ";

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
				'actions'=>array('create','update', 'getmessages'),
				'roles'=>array('staff'),
			),
			array('allow',
				'actions'=>array('index','delete'),
				'roles'=>array('admin'),
			),
			array('deny',
				'users'=>array('*'),
			),
		);
	}

	public function actionGetmessages() {

		?>
		<!DOCTYPE html>
		<html lang="">
		<head><meta charset="utf-8" />
		<meta name="language" content="en-GB" />
		</head>
			<h2>
				<a href="<?php echo Yii::app()->createUrl('/translates/index'); ?>" style="text-decoration:none;color:blue;padding:10px;">Çeviriler Oluşturuldu! Geri Dön ></a>
			</h2>
			<br/><br/>
		<?php
		$frontendpath = dirname(__FILE__).DIRECTORY_SEPARATOR.'../../../protected';
	    $commandPath = $frontendpath . DIRECTORY_SEPARATOR . 'commands';
	    $runner = new CConsoleCommandRunner();
	    $runner->addCommands($commandPath);
	    $args = array('protected/yiic', 'emessage', 'message');
	    ob_start();
	    $runner->run($args);
	    echo htmlentities(ob_get_clean(), null, Yii::app()->charset);
	}


	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	public function actionCreate()
	{
		$model=new Translates;

		if(isset($_POST['Translates']))
		{
			$model->attributes=$_POST['Translates'];
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

		if(isset($_POST['Translates']))
		{
			$model->attributes=$_POST['Translates'];
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

	public function actionIndex($lang = "en")
	{

		$dif = dirname(__FILE__).DIRECTORY_SEPARATOR.'..';
		$file = $dif.'/../../protected/messages/'.$lang.'/main.php';
		$languages = Yii::app()->params->languages;
		$model = require($file);

		if(isset($_POST['field'])) {
			$fields = array();
			foreach ($_POST['field'] as $key => $value) {
				$fields[$key] = $value;
			}
			$file = $dif.'/../../protected/messages/'.$_POST['lang'].'/main.php';
			$array = str_replace("\r", '', var_export($fields, true));
			file_put_contents($file, self::PHPHEADER . $array . ';' . PHP_EOL);
			Yii::app()->user->setFlash('success', "Çeviri kayıt işlemi tamamlandı!");
			$this->redirect(array('index'));
		}

		$this->render('index',array(
			'lang'=>$lang,
			'languages'=>$languages,
			'model'=>$model,
		));
	}

	public function actionAdmin()
	{
		$model=new Translates('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Translates']))
			$model->attributes=$_GET['Translates'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	public function loadModel($id)
	{
		$model=Translates::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='translates-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
