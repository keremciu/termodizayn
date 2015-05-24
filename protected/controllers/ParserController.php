<?php

class ParserController extends Controller
{
	public $layout='//layouts/base';
	public $menu=array();

	public function actions()
	{
		return array(
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	public function actionRouter($alias)
	{
		// Find CMS menu with "alias"
		$this->menu = Menu::model()->language(Yii::app()->getLanguage())->find(array(
			'condition'=>'alias=:alias OR translates.value=:alias',
			'params'=>array(':alias'=>$alias)
		));

		if (!isset($this->menu))
			$this->redirect("site/error");

		// Check if it has a submenu
		if ($this->menu->parent == 0) {
        	$getchilds=array();
        } else {
        	$getchilds=Menu::model()->findAll(array('condition'=>'parent = :id','params'=>array(':id'=>$this->menu->parent)));
        }

        // Capitalize menu name
        $menu_title = ucfirst(strtolower($this->menu->name));

        $this->breadcrumbs=array(
			$this->menu->name,
		);

        // Change page title
        $this->pageTitle=$menu_title . ' — '. Yii::app()->name;

        // Call the menu type 'page'
        $getFunction = "_parser".ucfirst($this->menu->type);
        $this->$getFunction();
	}

	public function _parserContact()
	{
		// if the menu type is
		$model=new ContactForm;

		if(isset($_POST['ContactForm'])) {
			$model->attributes=$_POST['ContactForm'];

			if($model->validate())
			{
				$content  = '<h2>İletişim Sayfası E-Postası</h2>';
				$content .= '<h5>Web sitesi üzerinden yeni bir iletişim e-postası oluşturuldu.';
				$content .= '<br/>Aşağıda e-posta ile alakalı gerekli bilgileri bulabilirsiniz.</h5>';
				$content .= '<p>Ad Soyad: <strong>'.$model->name.'</strong></p>';
				$content .= '<p>E-Posta Adresi: <strong>'.$model->email.'</strong></p>';
				$content .= '<p>Mesaj Konusu: <strong>'.$model->subject.'</strong></p>';
				$content .= '<p>Mesajı: </p><p><h3>'.$model->body.'</h3></p>';
				$content .= '<hr/><p><small>'.Yii::App()->getBaseUrl(true).' - WebSitesi</small></p>';

				$mail = Yii::app()->mail;
				$mail->IsHTML(true);
				$mail->AddAddress(Yii::app()->settings->get("mail","adminEmail"), Yii::app()->settings->get("system","name"));
				$mail->Subject = 'Iletisim Sayfasi E-Postasi';
				$mail->MsgHTML($content);
				$mail->AddAddress(Yii::app()->settings->get("mail","adminEmail"), Yii::app()->settings->get("system","name"));

				$mail->AddReplyTo($model->email, $model->name);
				if ($mail->Send()) {
					Yii::app()->user->setFlash('contact',Yii::t("main","E-Postanız için teşekkürler. En kısa sürede sizinle irtibata geçeceğiz."));
					/* Dont write above line it has a hack for new twig template language module */
					// {{ lang.t("main","E-Postanız için teşekkürler. En kısa sürede sizinle irtibata geçeceğiz.")}}
					$this->refresh();
				}
			}
		}

		$this->render('contact',array(
			'menu'=>$this->menu,
			'model'=>$model,
		));
	}

	
}