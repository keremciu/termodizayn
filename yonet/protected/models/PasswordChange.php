<?php

/**
 * This is the model class for table "user".
 *
 * The followings are the available columns in table 'user':
 * @property integer $id
 * @property string $name
 * @property string $lname
 * @property string $email
 * @property string $password
 * @property string $role
 */
class PasswordChange extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return User the static model class
	 */

	public $old_password;
    public $confirm_password;
    public $new_password;

	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'user';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('old_password, new_password, confirm_password, password', 'required'),
			array('new_password,confirm_password,old_password', 'length', 'min'=>6,'max'=>40),
			array('old_password', 'compare', 'compareAttribute' => 'password', 'message'=>'Eski şifrenizi hatalı girdiniz.'),
			array('new_password', 'compare', 'compareAttribute' => 'confirm_password'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, old_password, new_password, confirm_password, password', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'old_password' => 'Eski Şifre',
			'new_password' => 'Yeni Şifre',
			'confirm_password' => 'Yeni Şifrenin Tekrarı',
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
		$criteria->compare('old_password',$this->old_password,true);
		$criteria->compare('new_password',$this->new_password,true);
		$criteria->compare('confirm_password',$this->confirm_password,true);
		$criteria->compare('password',$this->password,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}