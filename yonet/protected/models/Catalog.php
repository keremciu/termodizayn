<?php

/**
 * This is the model class for table "Catalog".
 *
 * The followings are the available columns in table 'Catalog':
 * @property integer $id
 * @property string $name
 * @property string $intro
 * @property string $image
 * @property string $path
 * @property integer $size
 * @property integer $ordering
 * @property integer $active
 */
class Catalog extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return catalog the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function behaviors()
	{
	    return array(
	        'Translatable' => array(
	            'class'                 => 'ext.Translatable',
	            'translationAttributes' => array('name','intro'),
	            'translationRelation'   => 'translates',
	            'translationTable'   	=> $this->tableName(),
	            'languageColumn'        => 'lang_id',
	        ),
	    );
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'catalog';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, ordering, active', 'required'),
			array('size, ordering, active', 'numerical', 'integerOnly'=>true),
			array('name, image, path', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, intro, image, path, size, ordering, active', 'safe'),
		);
	}

	public function getOrderName()
	{
		return $this->ordering + 1 . ' -> bundan sonraya - ' .$this->name;
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'translates' => array(self::HAS_MANY, 'Translates', 'reference_id','index'=>'reference_field'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Adı',
			'intro' => 'Açıklama',
			'image' => 'Fotoğraf',
			'path' => 'PDF',
			'size' => 'Boyut',
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('intro',$this->intro,true);
		$criteria->compare('image',$this->image,true);
		$criteria->compare('path',$this->path,true);
		$criteria->compare('size',$this->size);
		$criteria->compare('ordering',$this->ordering);
		$criteria->compare('active',$this->active);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}