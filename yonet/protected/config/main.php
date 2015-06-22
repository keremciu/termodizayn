<?php
$root = dirname(__FILE__).DIRECTORY_SEPARATOR.'..';
return array(
	'basePath'=>$root,
	'name'=>'Termo Dizayn - Admin',
	'language'=>'tr',
	'sourceLanguage'=>'tr',
	'preload'=>array(
			'log',
			'bootstrap'
	),
	'import'=>array(
		'application.models.*',
		'application.components.*',
		'ext.yiiext.behaviors.model.taggable.*',
	),
	'behaviors'=>array(
        'onBeginRequest' => array(
            'class' => 'application.components.behaviors.BeginRequest'
        ),
    ),
	'modules'=>array(
		'i18n',
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'123654',
			'ipFilters'=>array('127.0.0.1',$_SERVER['REMOTE_ADDR']),
			'generatorPaths'=>array(
            	'booster.gii',
        	),
		),
	),
	'components'=>array(
		'assetManager' => [
			'excludeFiles' =>array(
				'jquery.js','jquery.min.js','jquery.history.js',
				'treeview','yiitab','rating',
			),
		],
		'clientScript'=>array(
			'scriptMap' => array(
				'jquery.js' => false,
				'jquery-ui-no-conflict.min.js' => false
			),
            'coreScriptPosition'=>CClientScript::POS_END,
            'defaultScriptPosition'=>CClientScript::POS_END,
            'defaultScriptFilePosition'=>CClientScript::POS_END
        ),
		'cache'=>array( 
	    	'class'=>'system.caching.CFileCache',
		),
		'settings'=>array(
	        'class'             => 'CmsSettings',
	        'cacheTime'         => 84000,
	        'tableName'     	=> 'settings',
	        'dbEngine'      	=> 'InnoDB',
        ),
        'i18n' => array(
            'class' => 'CDbMessageSource',
            'connectionID' => 'i18n_db',
            'sourceMessageTable' => 'yii_i18n_source_messages',
            'translatedMessageTable' => 'yii_i18n_messages',
        ),
		'mailer' => array(
      		'class' => 'application.extensions.EMailer',
      	),
		'user'=>array(
			'allowAutoLogin'=>true,
			'class' => 'WebUser',
		),
		'phpThumb'=>array(
		    'class'=>'application.extensions.EPhpThumb.EPhpThumb',
		    'options'=>array()
		),
		'bootstrap'=>array(
        	'class'=>'application.extensions.bootstrap.components.Booster',
        	'bootstrapCss'=>false,
        	'jqueryCss'=>false,
        	'enableJS'=>false
    	),
		'db'=>require($root.'/../../protected/config/_db.php'),
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
		'languages'=>require($root.'/../../protected/config/_lang.php'),
	),
);