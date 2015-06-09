<?php
/**
* Controller is the customized base controller class.
* All controller classes for this application should extend from this base class.
*/
class Controller extends CController
{
	/**
	* @var string the default layout for the controller view. Defaults to '//layouts/column1',
	* meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	*/
	public $layout='//layouts/column1';
	/**
	* @var array context menu items. This property will be assigned to {@link CMenu::items}.
	*/
	public $menu=array();
	/**
	* @var array the breadcrumbs of the current page. The value of this property will
	* be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	* for more details on how to specify this property.
	*/
	public $breadcrumbs=array();
	
	public function replace_tr($text) {
		$text = trim($text);
		$search = array('Ç','ç','Ğ','ğ','ı','İ','Ö','ö','Ş','ş','Ü','ü',' ',"'",'!','?',',',';',':');
		$replace = array('c','c','g','g','i','i','o','o','s','s','u','u','-','','','','','','');
		$new_text = strtolower(str_replace($search,$replace,$text));
		return $new_text;
	}
	public function buildMenu($data) {
		// put data on menu
		$this->render('//layouts/menulist',array(
			'menu'=>$data
		));
	}
	public function checkChildActive($data) {

		for ($i = 1; $i < count($data->childs); $i++) {
			if (($data->childs[$i]["chlink"] == $_SERVER['REQUEST_URI']) OR (strpos($_SERVER['REQUEST_URI'],$data->childs[$i]["chlink"]) !== false))
				return true;
		}

		

	}

	public function arrayto($d) {
		if (is_array($d)) {
			/*
			* Return array converted to object
			* Using __FUNCTION__ (Magic constant)
			* for recursive call
			*/
			return (object) array_map(null, $d);
		} else {
			// Return object
			return $d;
		}
	}
}