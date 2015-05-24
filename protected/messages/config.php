<?php

return array(
 	'sourcePath'=>dirname(__FILE__) . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..',
    'messagePath'=>dirname(__FILE__) . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'messages',
 	'autoMerge' => true,
    'languages'=> array_keys(require(dirname(__FILE__) . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'config/_lang.php')),
    'launchpad' => true,
    'skipUnused' => true,
    'fileTypes' => array('php'),
    'translator'=> array('lang.t','Yii::t'),
    'exclude'=>array(
                '.svn',
                '.bzr',
                '/messages',
                '/protected/vendors',
        ),
);