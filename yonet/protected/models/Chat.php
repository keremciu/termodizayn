<?php

class Chat extends CActiveRecord
{
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function tableName()
	{
		return 'chat';
	}

	public function rules()
	{
		return array(
			array('user, message, datime', 'required'),
			array('user', 'numerical', 'integerOnly'=>true),
			array('id, user, message, datime', 'safe', 'on'=>'search'),
		);
	}

	public function relations()
	{
		return array(
			'user0' => array(self::BELONGS_TO, 'User', 'user'),
		);
	}

	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'user' => 'Yazan',
			'message' => 'Mesaj',
			'datime' => 'Tarih',
		);
	}

	public function search()
	{
		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('user',$this->user);
		$criteria->compare('message',$this->message,true);
		$criteria->compare('datime',$this->datime,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}