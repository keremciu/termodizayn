<?php
/**
 * ContactForm class.
 * ContactForm is the data structure for keeping
 * contact form data. It is used by the 'contact' action of 'ParserController'.
 */
class ContactForm extends CFormModel
{
	public $name;
	public $email;
	public $subject;
	public $body;

	/**
	 * Declares the validation rules.
	 */
	public function rules()
	{
		return array(
			// name, email, subject and body are required
			array('name, email, body', 'required'),
			array('subject', 'length', 'max'=>255),
			// email has to be a valid email address
			array('email', 'email'),
		);
	}

	/**
	 * Declares customized attribute labels.
	 * If not declared here, an attribute would have a label that is
	 * the same as its name with the first letter in upper case.
	 *
	 * Do not delete above line it has a hack for new twig template language module
	 */
	public function attributeLabels()
	{
		return array(
			'name'=>Yii::t('main','Adınız Soyadınız'),
			'email'=>Yii::t('main','E-Posta Adresiniz'),
			'subject'=>Yii::t('main','Konu'),
			'body'=>Yii::t('main','Mesajınız'),
		);
	}
}