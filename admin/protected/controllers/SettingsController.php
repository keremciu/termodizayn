<?php

class SettingsController extends Controller
{
    private  $_frontendApp;

    public function actionIndex($lang = "tr")
    {
        $settings = Yii::app()->settings;
        $languages = Yii::app()->params->languages;
 
        $model = new Settings();
 
        if (isset($_POST['Settings'])) {
            $model->setAttributes($_POST['Settings']);
            foreach($model->attributes as $category => $values){
                $keytitle = array_keys($values)[0];
                $getlang = array_keys($values[$keytitle])[0];

                if (stripos(array_keys($values[$keytitle])[0], "lang_") !== FALSE) {
                    $language = explode("lang_", $getlang);
                    $settings->setWithLang($category, $values, $language[1]);
                }
            }

            Yii::app()->user->setFlash('success', 'Site ayarları güncellendi.');
            
            $geturl = Yii::app()->getBaseUrl(true) . "/../site/deletecache";
            $this->redirect($geturl);
        }

        foreach($model->attributes as $category => $values){
            $cat = $model->$category;

            foreach($values as $key=>$val){
                if (Yii::app()->language == $lang) {
                    $cat[$key] = $settings->get($category, $key);
                } else {
                    $cat[$key] = $settings->getWithLang($category, $key, $lang);
                }
            }
            $model->$category = $cat;
        }

        $this->render('index', 
            array(
                'model' => $model,
                'lang'=>$lang,
                'languages'=>$languages,
            )
        );
    }

    public function actionDeleteAll()
    {
        Yii::app()->settings->delete("system");
        $this->redirect(array('index'));
    }

}