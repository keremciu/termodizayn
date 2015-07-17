<?php

/**
 * This is the model class for table "company".
 *
 * The followings are the available columns in table 'company':
 * @property integer $id
 * @property string $name
 * @property string $logo
 * @property string $author
 * @property string $address
 * @property string $phone
 * @property string $fax
 * @property string $email
 * @property string $web
 * @property integer $sicilno
 * @property integer $offer_count
 * @property integer $is_published
 */
class Company extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Company the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'company';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, logo, author, address, phone, fax, email, web, sicilno, offer_count, is_published', 'required'),
			array('sicilno, offer_count, is_published', 'numerical', 'integerOnly'=>true),
			array('name, logo, author, phone, fax, email, web', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, logo, author, address, phone, fax, email, web, sicilno, offer_count, is_published', 'safe', 'on'=>'search'),
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
			'name' => 'Şirket Adı',
			'logo' => 'Logo',
			'author' => 'Sahibi',
			'address' => 'Adres',
			'phone' => 'Telefon',
			'fax' => 'Faks'x,
			'email' => 'E-posta',
			'web' => 'Web',
			'sicilno' => 'Sicilno',
			'offer_count' => 'Offer Count',
			'is_published' => 'Is Published',
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('logo',$this->logo,true);
		$criteria->compare('author',$this->author,true);
		$criteria->compare('address',$this->address,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('fax',$this->fax,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('web',$this->web,true);
		$criteria->compare('sicilno',$this->sicilno);
		$criteria->compare('offer_count',$this->offer_count);
		$criteria->compare('is_published',$this->is_published);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}