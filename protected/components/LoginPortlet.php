<?php

Yii::import('zii.widgets.CPortlet');

class LoginPortlet extends CPortlet
{

    /**
     * Initializing portlet
     */
    public function init()
    {
        parent::init();
    }
 
    /**
     * Renders the content of the portlet.
     */
    protected function renderContent()
    {
        $model = new LoginForm; // use LoginForm model that comes after you create new yii app

        // if it is ajax validation request
        if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
        {
                echo CActiveForm::validate($model);
                Yii::app()->end();
        }

        // collect user input data
        if(isset($_POST['LoginForm']))
        {
                $model->attributes=$_POST['LoginForm'];
                // validate user input and redirect to the previous page if valid
                if($model->validate() && $model->login())
                    $this->controller->redirect(Yii::app()->user->returnUrl);
        }

        // display the login form
        $this->render('login',array('model'=>$model));
    }

}