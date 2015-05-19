<?php

/**
 * This is the model class for table "timeline".
 *
 * The followings are the available columns in table 'timeline':
 * @property integer $id
 * @property string $title
 * @property string $detail
 * @property string $info
 * @property string $date
 * @property integer $ordering
 * @property integer $active
 */
class Timeline extends CActiveRecord
{

	public $category_search;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Timeline the static model class
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
		return 'timeline';
	}

	public function behaviors()
	{
	    return array(
	        'Translatable' => array(
	            'class'                 => 'ext.Translatable',
	            'translationAttributes' => array('title','info','detail'),
	            'translationRelation'   => 'translates',
	            'translationTable'   	=> $this->tableName(),
	            'languageColumn'        => 'lang_id',
	        ),
	    );
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title, cat_id, info, date, ordering, active', 'required'),
			array('ordering, active', 'numerical', 'integerOnly'=>true),
			array('title', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, title, detail, info, date, ordering, active', 'safe'),
		);
	}

	public function getFullName()
	{
		return $this->ordering. ' ' .$this->title;
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
			'category0' => array(self::BELONGS_TO, 'Timeline_cat', 'cat_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'cat_id' => 'Kategori',
			'title' => 'Başlık',
			'detail' => 'Link',
			'info' => 'Yer',
			'date' => 'Tarih',
			'ordering' => 'Sıralama',
			'active' => 'Aktiflik',
			'category_search' => 'Kategori',
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
		$criteria->with = array('category0');
		$criteria->compare('id',$this->id);
		$criteria->compare('cat_id',$this->cat_id);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('detail',$this->detail,true);
		$criteria->compare('info',$this->info,true);
		$criteria->compare('date',$this->date,true);
		$criteria->compare('ordering',$this->ordering);
		$criteria->compare('active',$this->active);
		$criteria->compare('category0.title', $this->category_search,true);
		$criteria->order = 't.ordering DESC';

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'sort'=>array(
				'defaultOrder'=>'t.ordering DESC',
		        'attributes'=>array(
		            'category_search'=>array(
		                'asc'=>'category0.title',
		                'desc'=>'category0.title DESC',
		            ),
		            '*',
		        ),
  			),
		));
	}
}