<?php
	class LanguageSelect extends CWidget
	{
		public $layout = "desktop";
	    public function run()
	    {
	        $currentLang = Yii::app()->language;
	        $languages = Yii::app()->params->languages;
	        $this->render('language_'.$this->layout, array('currentLang' => $currentLang, 'languages'=>$languages));
	    }
	}
?>