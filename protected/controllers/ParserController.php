<?php

class ParserController extends Controller
{
	public $layout='//layouts/base';
	public $menu=array();

	public function actions()
	{
		return array(
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	public function actionRouter($alias)
	{
		// Find CMS menu with "alias"
		$this->menu = Menu::model()->language(Yii::app()->getLanguage())->find(array(
			'condition'=>'alias=:alias OR translates.value=:alias',
			'params'=>array(':alias'=>$alias)
		));

		if (!isset($this->menu))
			$this->redirect("site/error");

		// Check if it has a submenu
		if ($this->menu->parent == 0) {
        	$getchilds=array();
        } else {
        	$getchilds=Menu::model()->findAll(array('condition'=>'parent = :id','params'=>array(':id'=>$this->menu->parent)));
        }

        // Capitalize menu name
        $menu_title = ucfirst(strtolower($this->menu->name));

        $this->breadcrumbs=array(
			'asasdf',
		);

        // Change page title
        $this->pageTitle=$menu_title . ' — '. Yii::app()->name;

        // Call the menu type 'page'
        $getFunction = "_parser".ucfirst($this->menu->type);
        $this->$getFunction();
	}

	public function _parserContact()
	{
		// if the menu type is 
		$model=new ContactForm;

		if(isset($_POST['ContactForm'])) {


		}

		$this->render('contact',array(
			'menu'=>$this->menu,
			'model'=>$model,
		));
	}

	
}