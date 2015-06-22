<?php

class MailController extends Controller
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
                'actions'=>array('create'),
                'roles'=>array('staff'),
            ),
            array('deny',
                'users'=>array('*'),
            ),
        );
    }
 
    public function actionCreate() {
    
        $model=new Mail;

        if(isset($_POST['Mail'])) {
            $model->attributes=$_POST['Mail'];
            if($model->validate()){
                if ($model->email=="all") {
                    $list = User::model()->findAll();
                } 
                else { 
                    $list = User::model()->findAllByAttributes(array('role'=>$model->email));
                }
			foreach ($list as $person) {
                Yii::app()->mailer->From = 'bilgi@telgrafim.com';
                Yii::app()->mailer->FromName = 'telgrafim.com';
                Yii::app()->mailer->AddReplyTo('bilgi@telgrafim.com', 'telgrafim.com');
                Yii::app()->mailer->AddAddress($person->email);
                Yii::app()->mailer->Subject = $model->subject;
                Yii::app()->mailer->Body = $model->body;
                Yii::app()->mailer->Send();
    			Yii::app()->mailer->ClearAllRecipients();
			}
			Yii::app()->user->setFlash('success', '<strong>Tebrikler!</strong> Mesajınız seçtiğiniz kullanıcı grubuna başarıyla gönderildi.');
            $this->redirect(array('create'));
			}	
        }

        $this->render('create',array('model'=>$model));
        }

}