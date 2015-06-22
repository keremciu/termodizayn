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
			array('username, name, lastname, email, password, role, active', 'required'),
			array('active', 'numerical', 'integerOnly'=>true),
			array('username', 'length', 'max'=>30),
			array('name, lastname, password', 'length', 'max'=>50),
			array('email', 'length', 'max'=>75),
			array('role', 'length', 'max'=>10),
			array('id, username, name, lastname, email, password, role, active', 'safe', 'on'=>'search'),
		);
	}

	public function relations()
	{
		return array(
			'news' => array(self::HAS_MANY, 'News', 'author_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'username' => 'Kullanıcı Adı',
			'name' => 'Ad',
			'lastname' => 'Soyad',
			'email' => 'E-Posta',
			'password' => 'Şifre',
			'role' => 'Rol',
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