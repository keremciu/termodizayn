<?php

/**
 * This is the model class for table "translates".
 *
 * The followings are the available columns in table 'translates':
 * @property string $id
 * @property integer $lang_id
 * @property integer $reference_id
 * @property string $reference_table
 * @property string $reference_field
 * @property string $value
 * @property string $original_value
 * @property string $original_text
 * @property string $modified
 * @property string $modified_by
 * @property integer $is_published
 */
class Translates extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Translates the static model class
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
		return 'translates';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('value', 'required'),
			array('reference_id, is_published', 'numerical', 'integerOnly'=>true),
			array('reference_table, reference_field', 'length', 'max'=>100),
			array('modified_by', 'length', 'max'=>11),
			array('modified', 'safe'),
			array('id, lang_id, reference_id, reference_table, reference_field, value, original_value, original_text, modified, modified_by, is_published', 'safe'),
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
			'lang_id' => 'Dil',
			'reference_id' => 'Referans ID',
			'reference_table' => 'Referans Tablo',
			'reference_field' => 'Referans Alan',
			'value' => 'Değer',
			'original_value' => 'Orjinal Değer',
			'original_text' => 'Orjinal Yazı',
			'modified' => 'Değiştirilme',
			'modified_by' => 'Değiştiren',
			'is_published' => 'Yayında',
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

		$criteria->compare('id',$this->id,true);
		$criteria->compare('lang_id',$this->lang_id);
		$criteria->compare('reference_id',$this->reference_id);
		$criteria->compare('reference_table',$this->reference_table,true);
		$criteria->compare('reference_field',$this->reference_field,true);
		$criteria->compare('value',$this->value,true);
		$criteria->compare('original_value',$this->original_value,true);
		$criteria->compare('original_text',$this->original_text,true);
		$criteria->compare('modified',$this->modified,true);
		$criteria->compare('modified_by',$this->modified_by,true);
		$criteria->compare('is_published',$this->is_published);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}