<?php

return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'Termodizayn',
	'language'=>'tr',
	'sourceLanguage'=>'tr',
	'preload'=>array('log'),
	'import'=>array(
		'application.models.*',
		'application.components.*',
	),
	'modules'=>array(
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'123654',
			'ipFilters'=>array('127.0.0.1','::1'),
		),
	),
	'components'=>array(
		'viewRenderer' => array(
		      'class' => 'ext.ETwigViewRenderer',
		      'twigPathAlias' => 'application.vendor.twig.twig.lib.Twig',
		      'fileExtension' => '.htm',
		      'options' => array(
		          'autoescape' => false,
		      ),
		      'globals' => array(
		          'html' => 'CHtml'
		      ),
		      'functions' => array(
		          'rot13' => 'str_rot13',
		      ),
		      'filters' => array(
		          'jencode' => 'CJSON::encode',
		      ),
		  ),
		'cache'=>array( 
	    	'class'=>'system.caching.CFileCache',
		),
		'request'=>array(
	        'enableCookieValidation'=>true,
	        'enableCsrfValidation'=>true,
	    ),
		'user'=>array(
			'allowAutoLogin'=>true,
		),
		'urlManager'=>array(
			'class'=>'application.components.UrlManager',
	        'urlFormat'=>'path',
	        'showScriptName'=>false,
			'caseSensitive'=>false,
			'rules'=>array(
				'<language:(de|tr|en)>/'=>'site/index',
				'<alias:[a-z0-9-]+>'=>'component/router',
				'<alias:[a-z0-9-]+>/<slug:[a-z0-9-]+>'=>'component/cliper',
				'<controller:\w+>/<title:.*?>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
		),
		'db'=>require_once('_db.php'),
		'errorHandler'=>array(
			'errorAction'=>'site/error',
		),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
			),
		),
	),
	'params'=>array(
		'languages'=>require_once('_lang.php'),
		'adminEmail'=>'info@termodizayn.com',
	),
);