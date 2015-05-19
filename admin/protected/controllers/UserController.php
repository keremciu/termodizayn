<?php

class UserController extends Controller
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
				'actions'=>array('admin','view','updateyourself'),
				'roles'=>array('staff'),
			),
			array('allow',
				'actions'=>array('create','delete','update'),
				'roles'=>array('admin'),
			),
			array('deny',  // deny all users
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

	public function actionCreate()
	{
		$model=new User;

		if(isset($_POST['User']))
		{	
			$model->attributes=$_POST['User'];
			$temp;
			if($model->validate()){
				$temp=$model->password;
				$model->password=md5($model->password);
			}
			if($model->save()){

				$content= '<h1>Telgrafım ekibine hoşgeldiniz!</h1><br><p>Merhabalar '.$model->name.' '.$model->lastname.',</p>
				<p>Sizi de yazar ekibimizin arasında görmekten mutluluk duymaktayız. Şimdiden başarılar diliyoruz ve sabırsızlıkla çalışmalarınızı bekliyoruz.</p>
				<br>
				<p>Telgrafım dergimizin yönetim panelini kullanmak için aşağıda size ait bilgileriniz tarafımızca oluşturulmuştur.</p>
				<p style="font-weight:bold">E-Posta : '.$model->email.'</p>
				<p style="font-weight:bold">Şifre : '.$temp.'<br>
				</p><p>Haber ekleyebilmek, ekip içi iletişim kurmak ve telgrafımı takip etmek için telgrafım yönetici paneline <a href="http://www.telgrafim.com/admin">buradan</a> ulaşabilirsiniz.<br></p>
				<hr /><p>Telgrafim.com<br></p><p><br></p>';
				
            	    Yii::app()->mailer->From = 'bilgi@telgrafim.com';
            		Yii::app()->mailer->FromName = 'telgrafim.com';
            		Yii::app()->mailer->AddReplyTo('bilgi@telgrafim.com', 'telgrafim.com');
                	Yii::app()->mailer->AddAddress($model->email,$model->name.' '.$model->lastname);
           			Yii::app()->mailer->Subject = "telgrafim.com'a Hoşgeldiniz!";
           			Yii::app()->mailer->Body = $content;
            		Yii::app()->mailer->Send();
					
				Yii::app()->user->setFlash('success', '<strong>Başarılı!</strong> Yazar ekleme işlemi başarıyla gerçekleşti.');
				$this->redirect(array('admin','id'=>$model->id));
			}
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		if(isset($_POST['User']))
		{
			$model->attributes=$_POST['User'];
			if($model->save()){
				Yii::app()->user->setFlash('success', '<strong>Tebrikler!</strong> Bilgileriniz başarıyla kaydedildi.');
				$this->redirect(array('view','id'=>$model->id));
			}
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	public function actionUpdateyourself($id)
	{

		if ($id!=Yii::app()->user->id){

			throw new CHttpException(403,'Bu işlemi gerçekleştirebilmek için yeterli yetkiniz yok.');
		}

		$model=$this->loadModel($id);

		if(isset($_POST['User']))
		{
			$model->attributes=$_POST['User'];
			if($model->save()){
				$this->redirect(array('view','id'=>$model->id));
			}
		}

		$this->render('updateyourself',array(
			'model'=>$model,
		));
	}

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

	public function actionAdmin()
	{
		$model=new User('search');
		$model->unsetAttributes();
		if(isset($_GET['User']))
			$model->attributes=$_GET['User'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	public function loadModel($id)
	{
		$model=User::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
	
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='user-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}