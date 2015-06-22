<?php

/**
 * This is the model class for table "model_attrib_map".
 *
 * The followings are the available columns in table 'model_attrib_map':
 * @property integer $id
 * @property integer $attrib_id
 * @property integer $model_id
 * @property integer $ordering
 * @property integer $on_list
 * @property string $value
 *
 * The followings are the available model relations:
 * @property ProductModel $model
 * @property ProductAttrib $attrib
 */
class ModelAttribMap extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ModelAttribMap the static model class
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
		return 'model_attrib_map';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('attrib_id, model_id, ordering, on_list, value', 'required'),
			array('attrib_id, model_id, ordering, on_list', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, attrib_id, model_id, ordering, on_list, value', 'safe'),
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
			'model' => array(self::BELONGS_TO, 'ProductModel', 'model_id'),
			'attrib' => array(self::BELONGS_TO, 'ProductAttrib', 'attrib_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'attrib_id' => 'Attrib',
			'model_id' => 'Model',
			'ordering' => 'Ordering',
			'on_list' => 'On List',
			'value' => 'Value',
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
		$criteria->compare('attrib_id',$this->attrib_id);
		$criteria->compare('model_id',$this->model_id);
		$criteria->compare('ordering',$this->ordering);
		$criteria->compare('on_list',$this->on_list);
		$criteria->compare('value',$this->value,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}