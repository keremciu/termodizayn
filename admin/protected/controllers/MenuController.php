<?php

class MenuController extends Controller
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
				'actions'=>array('create','update','relational'),
				'roles'=>array('staff'),
			),
			array('allow',
				'actions'=>array('index','fixtypeid','toggle','sortable','delete'),
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
	        	'modelName' => 'Menu',
	        ),
	        'sortable' => array(
                'class'     => 'bootstrap.actions.TbSortableAction',
                'modelName' => 'Menu'
            ),
	    );
	}

	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	public function actionFixtypeid()
    {
      	$menutype = (!empty($_GET['menutype'])) ? $_GET['menutype']: '0';
      	if ($menutype == "contact") {
			echo CHtml::tag('option', array('value'=>1),'İletişim Formu',true);
		} else if ($menutype == "blog") {
			$Criteria = new CDbCriteria();
            $Criteria->condition = "type = 'content'";
			$data=Category::model()->findAll($Criteria);
			$data=CHtml::listData($data,'id','title');
			echo "<option value=''>Lütfen menünüze bir kategori tanımlayın</option>";
			foreach($data as $value=>$title)
			   echo CHtml::tag('option', array('value'=>$value),CHtml::encode($title),true);
		} else if ($menutype == "categories") {
			$Criteria = new CDbCriteria();
            $Criteria->condition = "type = 'product'";
			$data=Category::model()->findAll($Criteria);
			$data=CHtml::listData($data,'id','title');
			echo "<option value=''>Lütfen menünüze bir kategori tanımlayın</option>";
			foreach($data as $value=>$title)
			   echo CHtml::tag('option', array('value'=>$value),CHtml::encode($title),true);
		} else if ($menutype == "content") {
			$data=News::model()->findAll();
			$data=CHtml::listData($data,'id','title');
			echo "<option value=''>Lütfen menünüze bir haber tanımlayın</option>";
			foreach($data as $value=>$title)
			   echo CHtml::tag('option', array('value'=>$value),CHtml::encode($title),true);
		} else {
			echo CHtml::tag('option', array('value'=>1),'Seçilebilecek tek içerik var',true);
		}
   }       

	public function actionCreate()
	{
		$model=new Menu;

		if(isset($_POST['Menu']))
		{
			$model->attributes=$_POST['Menu'];
			if ($model->parent != 0) {
				$parent = Menu::model()->findByPk($model->parent);
				$parent->level = 1;
				$parent->save();
				$model->level = 2;
			}
			if($model->save())
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	private function getPrefix($pre=0) {
		$prefix = "-";
		$pre = $pre-1;
		for ($i=0; $i<=$pre; $i++) {
		  $prefix = $prefix."-";
		}
		return $prefix;
	}

	public function getList($id=0,$prefix="") {
	    $list = array();
	    $Criteria = new CDbCriteria();
		$Criteria->condition = "parent = $id";
		$models = Menu::model()->findAll($Criteria);
	    foreach ($models as $model) {
	        $childList = $this->getList($model->id,$this->getPrefix($model->level));
	        $list = CMap::mergeArray($list,array($model->id => $prefix.$model->name." -/".$model->menutype),$childList);
	    }
	    return $list;
	}


	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		if(isset($_POST['Menu']))
		{
			$model->attributes=$_POST['Menu'];

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
									$add->reference_id = $id;
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

	public function actionRelational()
	{
		$id = Yii::app()->getRequest()->getParam('id');
		$model=new Menu('search');
		$model->unsetAttributes();
		$model->parent = $id;
		$this->renderPartial('_relational', array(
			'id' => $id,
			'model' => $model,
		));
	}

	public function actionIndex()
	{
		$model=new Menu('search');
		$model->unsetAttributes();
		$model->parent = 0;
		if(isset($_GET['Menu']))
			$model->attributes=$_GET['Menu'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	public function loadModel($id)
	{
		$model=Menu::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='menu-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
