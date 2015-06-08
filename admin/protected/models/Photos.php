<?php

/**
 * This is the model class for table "photos".
 *
 * The followings are the available columns in table 'photos':
 * @property integer $id
 * @property string $name
 * @property string $desc
 * @property string $photo
 * @property string $min_photo
 * @property integer $gallery
 * @property string $url
 * @property integer $is_published
 */
class Photos extends CActiveRecord
{
	public $gallery_search;
	public $ordering_search;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Photos the static model class
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
		return 'photos';
	}

	public function behaviors()
	{
	    return array(
	        'Translatable' => array(
	            'class'                 => 'ext.Translatable',
	            'translationAttributes' => array('name','url','desc'),
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
			array('name, photo, min_photo, gallery, ordering, is_published', 'required'),
			array('gallery, ordering, is_published', 'numerical', 'integerOnly'=>true),
			array('name, photo, min_photo, url', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, desc, photo, min_photo, gallery, url, ordering, is_published', 'safe', 'on'=>'search'),
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
			'translates' => array(self::HAS_MANY, 'Translates', 'reference_id','index'=>'reference_field'),
			'gallery0' => array(self::BELONGS_TO, 'Gallery', 'gallery'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'Kimlik',
			'name' => 'Adı',
			'desc' => 'Açıklaması',
			'photo' => 'Fotoğraf',
			'min_photo' => 'Küçük Fotoğraf',
			'gallery' => 'Galeri',
			'url' => 'Bağlantı',
			'image' => 'Fotoğraf',
			'ordering' => 'Sıralama',
			'is_published' => 'Yayında',
			'gallery_search' => 'Galeri',
			'ordering_search' => 'Sıra',
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
		$criteria->with = array('gallery0');
		$criteria->compare('id',$this->id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('desc',$this->desc,true);
		$criteria->compare('photo',$this->photo,true);
		$criteria->compare('min_photo',$this->min_photo,true);
		$criteria->compare('gallery',$this->gallery);
		$criteria->compare('url',$this->url,true);
		$criteria->compare('ordering',$this->ordering);
		$criteria->compare('is_published',$this->is_published);
		$criteria->compare('gallery0.name', $this->gallery_search,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'sort'=>array(
				'defaultOrder'=>'ordering DESC',
		        'attributes'=>array(
		            'gallery_search'=>array(
		                'asc'=>'gallery0.name',
		                'desc'=>'gallery0.name DESC',
		            ),
		            'ordering_search'=>array(
		                'asc'=>'t.ordering',
		                'desc'=>'t.ordering DESC',
		            ),
		            '*',
		        ),
  			),
		));
	}
}