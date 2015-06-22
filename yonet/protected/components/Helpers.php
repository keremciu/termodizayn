<?php
/**
*
*	Helpers
*	All helper classes here
*
*/
class Helpers {

	public static function init() {
        return new Helpers();
    }

	public function truncateText($text, $max_len) {
    	$len = strlen($text, 'UTF-8');
    	if ($len <= $max_len)
      		return $text;
    	else
      		return substr($text, 0, $max_len - 1, 'UTF-8') . '...';
  	}
}