<?php

$this->pageTitle=Yii::app()->name . ' - Giriş Yap';

?>
<div class="login_form_content col-md-4 col-md-offset-4 col-xs-10 col-xs-offset-1 main-content main-content--full">
    <div class="login_form">
        <h1 class="form-section_title">PANELE GİRİŞ YAP</h1>
        <div class="form-section_content">
<?php 

// Login Form
$form = $this->beginWidget('booster.widgets.TbActiveForm',
    array(
        'id' => 'login-form',
        'type'=>'vertical',
        'enableClientValidation'=>true,
        'clientOptions'=>array(
			'validateOnSubmit'=>true,
		),
        'htmlOptions' => array('class' => 'form-signin'),
    )
);
    
    // name or e-mail input
    echo $form->textFieldGroup($model, 'username', array('class'=>'col-md-12'));

    // password input
	echo $form->passwordFieldGroup($model, 'password', array('class'=>'col-md-12'));

    // remember checkbox
	echo $form->checkboxGroup($model, 'rememberMe');

    // login button
	$this->widget('booster.widgets.TbButton',
        array(
            'buttonType' => 'submit',
            'encodeLabel' => false,
            'context' => 'primary',
            'label' => '<svg class="td-icon td-icon-done"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-done"></use></svg> Giriş Yap'
        )
    );

// form ended
$this->endWidget(); ?>
</div>
<!-- form -->
</div>
<!-- login_form_content -->