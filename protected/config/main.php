<?php

$langs = require_once('_lang.php');
$langlist = implode("|",array_keys($langs));

return array(
	'name'=>"Termodizayn",
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
		'clientScript'=>array(
            'coreScriptPosition'=>CClientScript::POS_END,
            'defaultScriptPosition'=>CClientScript::POS_END,
            'defaultScriptFilePosition'=>CClientScript::POS_END
        ),
        'settings'=>array(
	        'class'             => 'CmsSettings',
	        'cacheTime'         => 84000,
	        'tableName'     	=> 'settings',
	        'dbEngine'      	=> 'InnoDB',
        ),
		'mail' => array(
			'class'=>'application.extensions.phpmail.Mailer',
        ),
		'viewRenderer' => array(
		      'class'=>'application.extensions.twig',
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
				// Language Subdomain router
				// 'http://<language:('.$langlist.')>.localhost:8080/termodizayn/' => 'site/index',
				'<language:('.$langlist.')>/'=>'site/index',
				'site/<action:\w+>'=>'site/<action>',
				'<alias:[a-z0-9-]+>'=>'parser/router',
				'<alias:[a-z0-9-]+>/<slug:[a-z0-9-]+>'=>'childparser/router',
				'<alias:[a-z0-9-]+>/<category:[a-z0-9-]+>/<slug:[a-z0-9-]+>'=>'childparser/router',
				'<alias:[a-z0-9-]+>/<category:[a-z0-9-]+>/<slug:[a-z0-9-]+>/<model:[a-z0-9-]+>'=>'childparser/router',
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
		'languages'=>$langs,
		'adminEmail'=>'info@termodizayn.com',
	),
);