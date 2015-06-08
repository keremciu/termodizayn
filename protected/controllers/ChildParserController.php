<?php

class ChildParserController extends Controller
{
	public $layout='//layouts/base';
	public $menu=array();
	public $getcategory;
	public $content;
	public $product;
	public $model;
	public $secondstep;
	public $thirdstep;
	public $fourthstep;

	public function actions()
	{
		return array(
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	public function actionRouter($alias,$slug,$category=NULL,$model=NULL)
	{
		// Find CMS menu with "alias"
		$this->menu = Menu::model()->language(Yii::app()->getLanguage())->find(array(
			'condition'=>'t.alias=:alias OR translates.value=:alias',
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

        // Multistep breadcrumb
		$this->breadcrumbs=array(
			$this->menu->name => Yii::app()->baseUrl . "/" . $this->menu->alias,
		);

        if (isset($category)) {
        	// Get category details
        	$this->getcategory = Category::model()->language(Yii::app()->getLanguage())->find(array('condition'=>'slug=:slug','params'=>array(':slug'=>$category)));
        	$this->secondstep = $this->getcategory->title;
        }

		if (isset($this->secondstep))
			$this->breadcrumbs[$this->secondstep] = Yii::app()->baseUrl . "/" . $this->menu->alias;


        // Get child item's details
        if (isset($slug)) {
        	if ($this->menu->type=="blog") {
        		// get content
        		$this->content = News::model()->language(Yii::app()->getLanguage())->find(array('condition'=>'slug=:slug OR translates.value','params'=>array(':slug'=>$slug)));

        		// content breadcrumb step
        		$this->thirdstep = $this->content->title;
        		array_push($this->breadcrumbs, $this->thirdstep);

        	} else if ($this->menu->type=="categories") {
				// get product
				$this->product = Product::model()->with('productModels')->language(Yii::app()->getLanguage())->find(array('condition'=>'t.slug=:slug','params'=>array(':slug'=>$slug)));

				// product breadcrumb step
				$this->thirdstep = $this->product->title;
				
				if (isset($model)) {
					$this->menu->type = "model";
					// get model
					$this->model = ProductModel::model()->language(Yii::app()->getLanguage())->find(array('condition'=>'t.slug=:model','params'=>array(':model'=>$model)));

					// if it has a model, get full url
					$this->breadcrumbs[$this->thirdstep] = Yii::app()->baseUrl . "/" . $this->menu->alias . "/" . $this->getcategory->slug . "/" . $this->product->slug;
					// model breadcrumb step
					$this->fourthstep = $this->model->name;
				} else {
					// if it hasn't a model, do not set a url
					array_push($this->breadcrumbs, $this->thirdstep);
				}
			} else {
				$this->redirect("site/error");
			}
		}


		// fourth step would be a model name
		if (isset($this->fourthstep))
			array_push($this->breadcrumbs, $this->fourthstep);

        // Change page title
        $this->pageTitle = $this->thirdstep . ' - ' . (isset($this->secondstep) ? $this->secondstep. ' - ' : '') . $menu_title . ' — '. Yii::app()->name;

        // Call the menu type 'page'
        $getFunction = "_parser".ucfirst($this->menu->type);
        $this->$getFunction();
	}

	// Content page: menu type
	public function _parserBlog()
	{
		// if the menu type is "content" run this page
		// blog page has a content view.

		$this->render('news',array(
			'menu'=>$this->menu,
			'content'=>$this->content,
		));
	}

	// Categories page: menu type
	public function _parserCategories()
	{
		// if the menu type is "categories" run this page
		// categories page has a product view.
		$this->render('product',array(
			'menu'=>$this->menu,
			'category'=>$this->getcategory,
			'product'=>$this->product,
		));
	}

	public function _parserModel()
	{
		// if the menu type is "categories" and it has a model slug, run this page
		// this page has a model view.

		$this->render('model',array(
			'menu'=>$this->menu,
			'category'=>$this->getcategory,
			'product'=>$this->product,
			'model'=>$this->model
		));
	}

}