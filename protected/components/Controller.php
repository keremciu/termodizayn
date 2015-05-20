<?php
/**
*
*	Main Controller
*	All controller classses should extend from this base class.
*
*
*/
class Controller extends CController
{
	/**
	 * @var string the default layout for the controller view. Defaults to '//layouts/main',
	 * meaning using a single column layout. See 'protected/views/layouts/main.htm'.
	 */
	public $dynamicmenu;

	public function __construct($id,$module=null){

	    parent::__construct($id,$module);

	    // If there is a post-request, redirect the application to the provided url of the selected language 
	    if(isset($_POST['language'])) {
	        $lang = $_POST['language'];
	        $MultilangReturnUrl = $_POST[$lang];
	        $this->redirect($MultilangReturnUrl);
	    }

	    // Set the application language if provided by GET, session or cookie
	    if(isset($_GET['language'])) {
	        Yii::app()->language = $_GET['language'];
	        Yii::app()->user->setState('language', $_GET['language']); 
	        $cookie = new CHttpCookie('language', $_GET['language']);
	        $cookie->expire = time() + (60*60*24*365); // (1 year)
	        Yii::app()->request->cookies['language'] = $cookie; 
	    }
	    else if (Yii::app()->user->hasState('language'))
	        Yii::app()->language = Yii::app()->user->getState('language');
	    else if(isset(Yii::app()->request->cookies['language']))
	        Yii::app()->language = Yii::app()->request->cookies['language']->value;

	    Yii::app()->name = Yii::app()->settings->get("system","name");

	    $this->dynamicmenu = Menu::model()->language(Yii::app()->getLanguage())->findAll(array('condition'=>'(t.parent=0 AND t.menutype="navigasyon") AND t.is_published=1','order'=>'t.ordering ASC'));
	}

	/*
	 * This function for using turkish characters as normally
	 *
	 */
	public function strto($to, $str) {

		$lang = Yii::app()->getLanguage();

	    if ($to == 'lower') {
	        return mb_strtolower(str_replace(array('I', 'Ğ', 'Ü', 'Ş', 'İ', 'Ö', 'Ç'), array('ı', 'ğ', 'ü', 'ş', 'i', 'ö', 'ç'), $str), 'utf-8');
	    } else if ($to == "capitalize") {
	    	if ($lang == "tr") { 
	    		$ucfirst = ucfirst(mb_strtolower(str_replace(array('I', 'Ğ', 'Ü', 'Ş', 'İ', 'Ö', 'Ç'), array('ı', 'ğ', 'ü', 'ş', 'i', 'ö', 'ç'), $str), 'utf-8'));
	    		return str_replace(array('I', 'Ğ', 'Ü', 'Ş', 'İ', 'Ö', 'Ç'), array('İ', 'Ğ', 'Ü', 'Ş', 'İ', 'Ö', 'Ç'),$ucfirst);
	        } else {
	        	return ucfirst(mb_strtolower($str,'utf-8'));
	        }
	    } elseif ($to == 'upper') {
	    	if ($lang == "tr") { 
	        	return mb_strtoupper(str_replace(array('ı', 'ğ', 'ü', 'ş', 'i', 'ö', 'ç'), array('I', 'Ğ', 'Ü', 'Ş', 'İ', 'Ö', 'Ç'), $str), 'utf-8');
	        } else {
	        	return mb_strtoupper($str,'utf-8');
	        }
	    } else {
	        trigger_error('Lütfen geçerli bir strto() parametresi giriniz.', E_USER_ERROR);
	    }
	}
	
	public function createMultilanguageReturnUrl($lang='en') {

	    if (count($_GET)>0) {
	        $arr = $_GET;

	        if (isset($arr["alias"])) {

	        		$alias = $_GET["alias"];
	        		$item = Menu::model()->with("translates")->find(array('condition'=>'t.alias=:alias OR translates.value=:alias','params'=>array(':alias'=>$alias)));
	        	
	        		if (!$item) {
	        	 		$item = Menu::model()->with("translates")->find(array('condition'=>'t.alias=:alias OR translates.original_value=:alias','params'=>array(':alias'=>$alias)));
	        		}

	        	if (Yii::app()->sourceLanguage==$lang) {
	        		if (isset($item->translates["alias"])) {
	        			$arr['alias'] = $item->translates["alias"]->original_value;
	        		} else {
	        			$arr['alias'] = $item->alias;
	        		}
	        	} else { 
	        		$arr['alias'] = $item->translates["alias"]->original_value;
		        	$solution = Menu::model()->language($lang)->findByPk($item->id);
			        foreach ($solution->translates as $key => $translate) {
				   		if ($key == "alias" AND $lang==$translate->lang_id) {
				   			$arr['alias'] = $translate->value;
				        }
					}
				}
		        
		        if (isset($arr["slug"])) {
		        	$slug = $_GET["slug"];

		        	if ($item->type == "blog" OR $item->type == "project") {
		        		$menu = News::model()->with("translates")->find(array('condition'=>'slug=:slug OR translates.value=:slug','params'=>array(':slug'=>$slug)));

		        		if (Yii::app()->sourceLanguage==$lang) {
							if (isset($item->translates["alias"])) {
			        			$arr['slug'] = $menu->translates["slug"]->original_value;
			        		} else {
			        			$arr['slug'] = $menu->slug;
			        		}
			        	} else { 
			        		$arr['slug'] = $menu->translates["slug"]->original_value;
				        	$solution = News::model()->language($lang)->findByPk($menu->id);
					        foreach ($solution->translates as $key => $translate) {
						   		if ($key == "slug" AND $lang==$translate->lang_id) {
						   			$arr['slug'] = $translate->value;
						        }
							}
						}

		        	} else if ($item->type == "categorylist") {
		        		$product = Product::model()->with("translates")->find(array('condition'=>'slug=:slug OR translates.value=:slug','params'=>array(':slug'=>$slug)));
		        		if (!isset($product)) {$product = Product::model()->with("translates")->find(array('condition'=>'slug=:slug OR translates.original_value=:slug','params'=>array(':slug'=>$slug)));}

						if (Yii::app()->sourceLanguage==$lang) {
							if (isset($item->translates["alias"])) {
			        			$arr['slug'] = $product->translates["slug"]->original_value;
			        		} else {
			        			$arr['slug'] = $product->slug;
			        		}
			        	} else { 
			        		if (isset($product->translates["slug"])) {
			        			$arr['slug'] = $product->translates["slug"]->original_value;
			        		} else {
			        			$arr['slug'] = "";
			        		}
				        	$solution = Product::model()->language($lang)->findByPk($product->id);
					        foreach ($solution->translates as $key => $translate) {
						   		if ($key == "slug" AND $lang==$translate->lang_id) {
						   			$arr['slug'] = $translate->value;
						        }
							}
						}
		        	}
		        }
		    }

	        $arr["q"] =NULL;
	        $arr['language']= $lang;

	    } else {
	        $arr = array('language'=>$lang);
	    }

	    return Yii::app()->createUrl($this->route, $arr);
	}

	public $layout='//layouts/main';

	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu="naber";

	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs=array();
}