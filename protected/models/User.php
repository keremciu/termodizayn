<?php

class User extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return User the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function tableName()
	{
		return 'user';
	}

	public function rules()
	{
		return array(
			array('username, name, company, country, email, password, role, active', 'required'),
			array('active, subscribe', 'numerical', 'integerOnly'=>true),
			array('username', 'length', 'max'=>30),
			array('name, lastname, password', 'length', 'max'=>50),
			array('email', 'length', 'max'=>75),
			array('role', 'length', 'max'=>10),
			array('phone', 'length', 'max'=>14),
			array('id, username, name, lastname, company, country, email, phone, password, role, subscribe, active', 'safe', 'on'=>'search'),
		);
	}

	public function getCountries()
	{
		return require_once('_countries.php');
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'username' => Yii::t('main','Kullanıcı Adı'),
			'name' => Yii::t('main','Ad Soyad'),
			'lastname' => 'Soyad',
			'email' => Yii::t('main','E-Posta'),
			'password' => Yii::t('main','Şifreniz'),
			'role' => Yii::t('main','Rol'),
			'country' => Yii::t('main','Ülke'),
			'company' => Yii::t('main','Firma Adı'),
			'phone' => Yii::t('main','Telefon'),
			'subscribe' => Yii::t('main',"Ücretsiz e-bülten'e abone olmak istiyorum."),
			'active' => 'Aktif',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('lastname',$this->lastname,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('role',$this->role,true);
		$criteria->compare('active',$this->active);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}