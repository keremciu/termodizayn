<?php

class Hr extends CActiveRecord
{
	public $name;
	public $email;
	public $telephone;
	public $referencepos;
	public $cv;
	public $active;

	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'hr';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, email, telephone, referencepos, cv, active', 'required'),
			array('cv, active', 'numerical', 'integerOnly'=>true),
			array('name, email, telephone, referencepos', 'length', 'max'=>255),
			array('pimg', 'file','types'=>'doc,docx,word','on'=>'create'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, email, telephone, referencepos, cv, active', 'safe', 'on'=>'search'),
		);
	}

	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}
	/**
	 * Declares customized attribute labels.
	 * If not declared here, an attribute would have a label that is
	 * the same as its name with the first letter in upper case.
	 */
	public function attributeLabels()
	{
		return array(
			'id'=>Yii::t('strings','Kimlik'),
			'name'=>Yii::t('strings','Adınız Soyadınız'),
			'email'=>Yii::t('strings','E-Posta Adresiniz'),
			'telephone'=>Yii::t('strings','Cep Telefon Numaranız'),
			'referencepos'=>Yii::t('strings','Başvurduğunuz Pozisyon'),
			'cv'=>Yii::t('strings','Özgeçmiş Ekle'),
			'active'=>Yii::t('strings','Değerlendirildi mi?'),
		);
	}

	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('telephone',$this->telephone,true);
		$criteria->compare('referencepos',$this->referencepos,true);
		$criteria->compare('cv',$this->cv);
		$criteria->compare('active',$this->active);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}