<?php

/**
 * This is the model class for table "timeline_cat".
 *
 * The followings are the available columns in table 'timeline_cat':
 * @property integer $id
 * @property string $title
 * @property string $info
 * @property integer $ordering
 * @property integer $active
 */
class Timeline_cat extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Timeline_cat the static model class
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
		return 'timeline_cat';
	}

	public function behaviors()
	{
	    return array(
	        'Translatable' => array(
	            'class'                 => 'ext.Translatable',
	            'translationAttributes' => array('title','info'),
	            'translationRelation'   => 'translatecat',
	            'translationTable'   	=> $this->tableName(),
	            'languageColumn'        => 'lang_id',
	        ),
	    );
	}

	public function getFullName()
	{
		return $this->ordering. ' ' .$this->title;
	}


	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title, ordering, active', 'required'),
			array('ordering, active', 'numerical', 'integerOnly'=>true),
			array('title', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, title, info, ordering, active', 'safe'),
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
			'translatecat' => array(self::HAS_MANY, 'Translates', 'reference_id','index'=>'reference_field'),
			'timeline' => array(self::HAS_MANY, 'Timeline', 'cat_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'title' => 'Başlık',
			'info' => 'Açıklama',
			'ordering' => 'Sıralama',
			'active' => 'Aktiflik',
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
		$criteria->compare('title',$this->title,true);
		$criteria->compare('info',$this->info,true);
		$criteria->compare('ordering',$this->ordering);
		$criteria->compare('active',$this->active);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}