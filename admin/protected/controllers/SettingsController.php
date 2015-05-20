<?php

class SettingsController extends Controller
{
    private  $_frontendApp;
    public function actionIndex()
    {
        $settings = Yii::app()->settings;
 
        $model = new Settings();
 
        if (isset($_POST['Settings'])) {
            $model->setAttributes($_POST['Settings']);
            foreach($model->attributes as $category => $values){
                $settings->set($category, $values);
            }
            Yii::app()->user->setFlash('success', 'Site ayarları güncellendi.');
            
            $geturl = Yii::app()->getBaseUrl(true) . "/../site/deletecache";
            $this->redirect($geturl);
        }

        foreach($model->attributes as $category => $values){
            $cat = $model->$category;

            foreach($values as $key=>$val){
                $cat[$key] = $settings->get($category, $key);
            }
            $model->$category = $cat;
        }

        $this->render('index', array('model' => $model));
    }

    public function actionDeleteAll()
    {
        Yii::app()->settings->delete("system");
        $this->redirect(array('index'));
    }

}