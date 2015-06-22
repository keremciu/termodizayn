<?php

/**
 * This is the model class for table "product_attrib_map".
 *
 * The followings are the available columns in table 'product_attrib_map':
 * @property integer $id
 * @property integer $attrib_id
 * @property integer $product_id
 * @property integer $ordering
 * @property integer $on_list
 * @property string $value
 *
 * The followings are the available model relations:
 * @property ProductAttrib $attrib
 * @property Product $product
 */
class ProductAttribMap extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ProductAttribMap the static model class
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
		return 'product_attrib_map';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('attrib_id, product_id, ordering, on_list, value', 'required'),
			array('attrib_id, product_id, ordering, on_list', 'numerical', 'integerOnly'=>true),
			array('id, attrib_id, product_id, ordering, on_list, value', 'safe'),
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
			'product_id' => 'Product',
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
		$criteria->compare('product_id',$this->product_id);
		$criteria->compare('ordering',$this->ordering);
		$criteria->compare('on_list',$this->on_list);
		$criteria->compare('value',$this->value,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}