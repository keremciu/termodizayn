<?php
	class LanguageSelect extends CWidget
	{
	    public function run()
	    {
	        $currentLang = Yii::app()->language;
	        $languages = Yii::app()->params->languages;
	        $this->render('LanguageSelect', array('currentLang' => $currentLang, 'languages'=>$languages));
	    }
	}
?>