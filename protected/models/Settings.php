<?php


class Settings  extends CActiveRecord
{
    public static function getParams($event) {

    	$lang = array('tr'=>'TR', 'en'=>'EN', 'de'=>'DE');
    	
    	return $lang;
    }
}