<?php

class LoginForm extends CFormModel
{
	public $name;
	public $username;
	public $password;
	public $rememberMe;
	private $_identity;

	public function rules()
	{
		return array(
			array('username, password', 'required'),
			array('rememberMe', 'boolean'),
			array('name', 'length', 'max'=>50),
			array('password', 'authenticate'),
		);
	}

	public function authenticate($attribute,$params)
	{
		if(!$this->hasErrors())
		{
			$this->_identity=new UserIdentity($this->username,$this->password);
			if(!$this->_identity->authenticate())
				$this->addError('password',Yii::t('main','Hatalı bir e-mail adresi veya şifre girdiniz.'));
		}
	}

	public function login()
	{
		if($this->_identity===null)
		{
			$this->_identity=new UserIdentity($this->username,$this->password);
			$this->_identity->authenticate();
		}
		if($this->_identity->errorCode===UserIdentity::ERROR_NONE)
		{
			$duration=$this->rememberMe ? 3600*24*30 : 0; // 30 days
			Yii::app()->user->login($this->_identity,$duration);
			return true;
		}
		else
			return false;
	}
}
