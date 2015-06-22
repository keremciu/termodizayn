<?php

/**
 * This is the model class for table "pimages".
 *
 * The followings are the available columns in table 'pimages':
 * @property integer $id
 * @property integer $pid
 * @property string $name
 * @property string $type
 * @property string $path
 * @property integer $size
 * @property integer $ordering
 * @property integer $active
 */
class Pimages extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Pimages the static model class
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
		return 'pimages';
	}

	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('pid', 'required'),
			array('pid, size, ordering, active', 'numerical', 'integerOnly'=>true),
			array('name, type, ext, path', 'length', 'max'=>255),
			array('id, pid, name, type, ext, path, size, ordering, active', 'safe', 'on'=>'search'),
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
			'pid' => 'Ürün Kimliği',
			'name' => 'Açıklama',
			'type' => 'Tipi',
			'ext' => 'Ekstra',
			'path' => 'Dizin Yolu',
			'size' => 'Boyutu',
			'ordering' => 'Sıralama',
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
		$criteria->compare('pid',$this->pid);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('type',$this->type,true);
		$criteria->compare('ext',$this->type,true);
		$criteria->compare('path',$this->path,true);
		$criteria->compare('size',$this->size);
		$criteria->compare('ordering',$this->ordering);
		$criteria->compare('active',$this->active);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}