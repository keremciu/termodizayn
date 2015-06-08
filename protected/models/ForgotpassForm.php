<?php

class ForgotpassForm extends CFormModel
{
	public $recover_email;

	public function rules()
	{
		return array(
			array('recover_email', 'required'),
			array('recover_email', 'email'),
		);
	}

	public function attributeLabels()
	{
		return array(
			'recover_email'=>Yii::t('main','E-Posta'),
		);
	}
}
