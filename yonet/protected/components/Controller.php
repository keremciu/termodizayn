<?php
/**
*
		*	Main Controller
		*	All controller classses should extend from this base class.
*
*/
class Controller extends CController
{
	public $layout='//layouts/base';
	public $menu=array();
	public $breadcrumbs=array();

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
				'actions'=>array('logout','login'),
			),
			array('allow',
				'actions'=>array('view','updateyourself'),
				'roles'=>array('*'),
			),
			array('allow',
				'actions'=>array('create','update'),
				'roles'=>array('dealer'),
			),
			array('allow',
				'actions'=>array('index','admin','sortable','toggle','delete','imagedelete','extraitemdelete','fileupload','attrdelete'),
				'roles'=>array('admin'),
			)
		);
	}

	public function actions() {
		return array(
			'toggle' => array(
				'class'		=> 'booster.actions.TbToggleAction',
				'modelName' => $this->getModel()
			),
			'sortable' => array(
				'class'     => 'booster.actions.TbSortableAction',
				'modelName' => $this->getModel()
			),
		);
	}

	public function getModel() {
		return ucwords($this->getUniqueId());
	}
		
	protected function beforeAction($event) {
    	$action = $this->actionFixer(Yii::app()->controller->action->id);
    	$controller = $this->controllerFixer($this->getUniqueId());
    	$this->pageTitle = $controller . $action . " - " . Yii::app()->name;
    	return true;
	}

	public function controllerFixer($c) {
		if ($c == 'product') {
			return " Ürün";
		} else if ($c == 'productmodel') {
			return " Model";
		} else if ($c == 'category') {
			return " Kategori";
		} else if ($c == 'gallery') {
			return " Galeri";
		} else if ($c == 'news') {
			return " İçerik";
		} else if ($c == 'menu') {
			return " Menü";
		} else if ($c == 'photos') {
			return " Fotoğraf";
		} else if ($c == 'productattrib') {
			return " Özellik";
		} else if ($c == 'passwordchange') {
			return " Sifre";
		} else if ($c == 'mail') {
			return " E-Posta";
		} else if ($c == 'user') {
			return " Uye";
		} else {
			return " Kategori";
		}
	}

	public function actionFixer($a) {
		if ($a == 'create') {
			return " Ekle";
		} else if ($a == 'update') {
			return " Guncelle";
		} else if ($a == 'view') {
			return " Goruntule";
		} else {
			return " Listele";
		}
	}

	public function init() {
		// Build html head calls and variables
		$baseurl = Yii::app()->baseUrl;
		$cs = Yii::app()->getClientScript();
		$cs->registerMetaTag(null, null, null,array('charset'=>'utf-8'));
		$cs->registerMetaTag('tr-TR', 'language');
		$cs->registerLinkTag('shortcut icon','image/x-ico',$baseurl.'/../img/favicon.png');
		$cs->registerLinkTag('author',NULL,'Interacthings & https://kerem.ws');
		$cs->registerLinkTag('stylesheet','text/css','http://fonts.googleapis.com/css?family=Roboto:400,500|Roboto+Condensed:400,300,700&subset=latin,latin-ext');
		$cs->registerMetaTag('yes', 'apple-mobile-web-app-capable');
		$cs->registerMetaTag('width=device-width, initial-scale=1.0', 'viewport');
		$cs->registerCssFile($baseurl.'/stylesheets/default.css');
		$cs->registerCssFile($baseurl.'/stylesheets/exclude.css');

		// Javascript calls
		$scripts = array(
			'vendor/jquery-1.11.1.min.js',
			'plugin.js',
			'main.js'
		);
		$assetFolder = Yii::app()->getAssetManager()->publish('javascripts', false, 1, false);

		//$assetFolder = Yii::app()->getAssetManager()->publish(Yii::getPathOfAlias('reassets'));
		//$script = 'assetUrl = "' . $assetFolder . '";';
		//Yii::app()->getClientScript()->registerScript('_', $script, CClientScript::POS_HEAD);
		foreach ($scripts as $file) {
			Yii::app()->getClientScript()->registerScriptFile($assetFolder . "/".$file, CClientScript::POS_HEAD);
		//Yii::app()->getClientScript()->registerScriptFile($file, CClientScript::POS_END);
		}
	}

	// Attribute delete for model and product
	public function actionAttrdelete($id) {
		if ($this->getUniqueId() == "product") {
			$model = ProductAttribMap::model()->findByPk($id);
		} else {
			$model = ModelAttribMap::model()->findByPk($id);
		}
		$model->delete();
	}

	// Main image delete action for model and product
	public function actionImagedelete($id) {
		if ($this->getUniqueId() == "product") {
			$model = Product::model()->findByPk($id);
			$path = Yii::app()->settings->get("photo","product_path");
		} else {
			$model = Productmodel::model()->findByPk($id);
			$path = Yii::app()->settings->get("photo","model_path");
		}
		
		if (unlink(Yii::getPathOfAlias('webroot').'/../'.$path.$model->image)) {
			$model->image = "";
			$model->save();
			return true;
		} else {
			return false;
		}
	}

	// Extra item(image,document,video) delete action for model and product
	public function actionExtraitemdelete($id) {
		if ($this->getUniqueId() == "product") {
			$model = Pimages::model()->findByPk($id);
			$path = Yii::app()->settings->get("photo","product_path");
		} else {
			$model = Mimages::model()->findByPk($id);
			$path = Yii::app()->settings->get("photo","model_path");
		}

		if ($model->type == "image") {
			$ext = "extras/";
		} else if ($model->type == "file") {
			$ext = "documents/";
		}
		
		if ($model->type == "video") {
			$model->delete();
			return true;
		} else {
			if (unlink(Yii::getPathOfAlias('webroot').'/../'.$path.$ext.$model->path)) {
				$model->delete();
				return true;
			} else {
				$model->delete();
			}
		}
	}


	// File upload action for model and product
	public function actionFileupload() {
		
		include( dirname(__FILE__) . '/helpers/fileapi.php');

		if( !empty($_SERVER['HTTP_ORIGIN']) ){
			// Enable CORS
			header('Access-Control-Allow-Origin: ' . $_SERVER['HTTP_ORIGIN']);
			header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
			header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Range, Content-Disposition, Content-Type');
			header('Access-Control-Allow-Credentials: true');
		}


		if( $_SERVER['REQUEST_METHOD'] == 'OPTIONS' ){
			exit();
		}

		if (isset($_REQUEST['type'])) {
			$type = $_REQUEST['type'];
		} else {
			$type = "normal";
		}

		if ($this->getUniqueId() == "product") {
			$mini = Yii::app()->settings->get("photo","product_mini");
			$path = Yii::app()->settings->get("photo","product_path");
		} else {
			$mini = Yii::app()->settings->get("photo","model_mini");
			$path = Yii::app()->settings->get("photo","model_path");
		}


		if( strtoupper($_SERVER['REQUEST_METHOD']) == 'POST' ){
			$files	= FileAPI::getFiles(); // Retrieve File List
			$images	= array();

			// Fetch all image-info from files list
			$this->fetchImages($files, $images, 'file', $type, $path, $mini);

			// JSONP callback name
			$jsonp	= isset($_REQUEST['callback']) ? trim($_REQUEST['callback']) : null;

			// JSON-data for server response
			$json	= array(
				'images'	=>	$images,
				'data'		=>	array('_REQUEST' => $_REQUEST, '_FILES' => $files)
			);

			// Server response: "HTTP/1.1 200 OK"
			FileAPI::makeResponse(array(
				  'status' => FileAPI::OK
				, 'statusText' => 'OK'
				, 'body' => $json
			), $jsonp);
			exit;
		}

	}

	public function fetchImages($files, &$images, $name = 'file', $type = 'normal', $path, $mini) {
		if( isset($files['tmp_name']) ){
			$filename = $files['tmp_name'];
			list($mime)	= explode(';', @mime_content_type($filename));
			$webroot = Yii::getPathOfAlias('webroot').'/../';
			$thumb = explode(",",$mini);
			if( strpos($mime, 'image') !== false ) {
				$size = getimagesize($filename);
				$ext = pathinfo($files['name'], PATHINFO_EXTENSION);
				$newname = rand(0,99999999).'-'.rand(0,99999999).'-'.rand(0,99999999).'.'.$ext;

				$images[$name] = array(
					  'width'	=> $size[0]
					, 'height'	=> $size[1]
					, 'mime'	=> $mime
					, 'size'	=> filesize($filename)
					, 'name'	=> $newname
				);

				if ($type == "extras") {
					move_uploaded_file($filename, $webroot.$path.'extras/'.$newname);
					Yii::app()->phpThumb->create($webroot.$path.'extras/'.$newname)->adaptiveResize($thumb[0],$thumb[1])->save($webroot.$path.'extras/thumbs/min'.$newname);
				} else {
					move_uploaded_file($filename, $webroot.$path.$newname);
				}
			} else {
				$size = getimagesize($filename);

				$images[$name] = array(
					'width'	=> $size[0]
					, 'height'	=> $size[1]
					, 'mime'	=> $mime
					, 'size'	=> filesize($filename)
					, 'name'	=> $files['name']
				);

				move_uploaded_file($filename, $webroot.$path.'documents/'.$files['name']);
			} 

		} else {
			foreach( $files as $name => $file ){
				$this->fetchImages($file, $images, $name, $type, $path, $mini);
			}
		}
	}

	public function getMenu() {
		$menu = require_once( dirname(__FILE__) . '/helpers/menu.php');
	}

	public function checkChildActive ($data) {
		$url = rawurldecode($_SERVER['REQUEST_URI']);
		for ($i = 1; $i < count($data->childs); $i++) {
			if (($data->childs[$i]["chlink"] == $url) OR (strpos($url,$data->childs[$i]["chlink"]) !== false)) {
				return true;
			}
		}
	}
	public function translateIt($translates,$model,$id) {
		foreach($translates as $key => $translate) {
		    if ($translate != "") {
		        $lang = explode("_", $key);
		        $isset = Translates::model()->find(array(
		            'condition' => '((reference_id=:refid AND reference_field=:field) AND lang_id=:lang) AND reference_table=:table',
		            'params' => array(':refid' => $model-> id,
		                ':field' => $lang[0],
		                ':lang' => $lang[1],
		                ':table' => $model->tableSchema-> name
		            )));
		        if ($isset) {
		        	$isset->original_value=$model->$lang[0];
					$isset->original_text=$model->$lang[0];
		            $isset->value = $translate;
		            $isset->save();;
		        } else {
		            $add = new Translates;
		            $add->lang_id = $lang[1];
		            $add->reference_id = $id;
		            $add->reference_table = $model->tableSchema->name;
		            $add->reference_field = $lang[0];
		            $add->value = $translate;
		            $add->original_value = $model->$lang[0];
		            $add->original_text = $model->$lang[0];
		            $add->modified_by = 1;
		            $add->is_published = 1;
		            $add->save();
		        }
		    }
		}
	}
	public function replace_tr($text) {
		$text = trim($text);
		$search = array('Ç','ç','Ğ','ğ','ı','İ','Ö','ö','Ş','ş','Ü','ü',' ',"'",'!','?',',',';',':');
		$replace = array('c','c','g','g','i','i','o','o','s','s','u','u','-','','','','','','');
		$new_text = strtolower(str_replace($search,$replace,$text));
		return $new_text;
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