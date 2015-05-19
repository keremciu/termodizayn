<?php
class DefaultController extends Controller {
 
    /**
     * @return array action filters
     */
    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
        );
    }
 
    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules() {
        return array(
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('index', 'view', 'create', 'update', 'delete'),
                'users' => array('@'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }
 
    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id) {
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }
 
    /**
     * Manages all models.
     */
    public function actionIndex() {
        $this->layout = '//layouts/column2';
        $model = new SourceMessage('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['SourceMessage']))
            $model->attributes = $_GET['SourceMessage'];
 
        $this->render('admin', array(
            'model' => $model,
        ));
    }
 public function actionCreate() {
        $model = new SourceMessage;
        $messages = array();
        // create a Form for each language
        foreach (Message::LanguageList() as $lang => $language) {
            $messages[$lang] = new Message('create');
        }
        if (isset($_POST['SourceMessage']) && isset($_POST['Message'])) {
            $model->attributes = $_POST['SourceMessage'];
            if ($model->save()) {
                $valid = true;
                // validate translations
                foreach ($messages as $i => $item) {
                    if (isset($_POST['Message'][$i]))
                        $item->attributes = $_POST['Message'][$i];
                    $item->id = $model->id;
                    $item->language = $i;
                    $valid = $item->validate() && $valid;
                }
                if ($valid) {
                    foreach ($messages as $item)
                        $item->save();
                    Yii::app()->user->setFlash('success', Yii::t('App', 'Your changes have been saved.'));
                    $this->redirect(array('index'));
                }
            }
        }
 
        $this->render('create', array(
            'model' => $model,
            'messages' => $messages,
        ));
    }
 
    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id) {
        $model = $this->loadModel($id);
        $items = array();
        foreach (Message::LanguageList() as $lang => $language) {
            $_message = $model->Messages(array('condition' => "language=\"{$lang}\""));
            if (!empty($_message))
                $items[$lang] = $_message[0];
            else {
                $items[$lang] = new Message('create');
                $items[$lang]->id = $model->id;
                $items[$lang]->language = $lang;
            }
        }
 
        if (isset($_POST['SourceMessage']) && isset($_POST['Message'])) {
            $model->attributes = $_POST['SourceMessage'];
            if ($model->save()) {
                $valid = true;
                foreach ($items as $i => $item) {
                    if (isset($_POST['Message'][$i]))
                        $item->attributes = $_POST['Message'][$i];
                    $valid = $item->validate() && $valid;
                }
                if ($valid) {
                    foreach ($items as $item)
                        $item->save();
                    Yii::app()->user->setFlash('success', Yii::t('App', 'Your changes have been saved'));
                    $this->redirect(array('index'));
                }
            }
        }
 
        $this->render('update', array(
            'model' => $model,
            'messages' => $items,
        ));
    }
 
    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id) {
        if (Yii::app()->request->isPostRequest) {
            // we only allow deletion via POST request
            $model = $this->loadModel($id);
            foreach ($model->Messages as $message)
                $message->delete();
 
            $model->delete();
            Yii::app()->user->setFlash('success', Yii::t('App', 'Your changes have been saved.'));
            // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
            if (!isset($_GET['ajax']))
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
        }
        else
            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
    }
    
    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */
    public function loadModel($id) {
        $model = SourceMessage::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }
    // default actions so far
}