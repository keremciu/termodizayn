<?php

return array(
 	'sourcePath'=>dirname(__FILE__) . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..',
    'messagePath'=>dirname(__FILE__) . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'messages',
 	'autoMerge' => true,
    'languages'=>array('tr','en', 'de'),
    'launchpad' => true,
    'skipUnused' => true,
    'fileTypes' => array('php'),
    'translator'=>'Yii::t',
    'exclude'=>array(
                '.svn',
                '.bzr',
                '/messages',
                '/protected/vendors',
        ),
);