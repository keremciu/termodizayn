<?php
$dif = dirname(__FILE__).DIRECTORY_SEPARATOR.'..';

return array(
	'basePath'=>$dif,
	'name'=>'Termo Dizayn - Admin',
	'language'=>'tr',
	'sourceLanguage'=>'tr',
	'preload'=>array('log','bootstrap'),
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
            	'bootstrap.gii',
        	),
		),
	),
	'components'=>array(
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
        	'class'=>'application.extensions.bootstrap.components.Bootstrap',
        	'responsiveCss' => true,
    	),
		'db'=>require($dif.'/../../protected/config/_db.php'),
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
		'languages'=>require($dif.'/../../protected/config/_lang.php'),
	),
);