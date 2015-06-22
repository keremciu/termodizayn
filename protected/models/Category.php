<?php

/**
 * This is the model class for table "category".
 *
 * The followings are the available columns in table 'category':
 * @property integer $id
 * @property string $title
 * @property string $slug
 * @property string $description
 * @property string $image
 * @property string $icon
 * @property integer $is_published
 * @property integer $is_deleted
 *
 * The followings are the available model relations:
 * @property News[] $news
 */
class Category extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Category the static model class
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
		return 'category';
	}

	public function behaviors()
	{
	    return array(
	        'Translatable' => array(
	            'class'                 => 'ext.Translatable',
	            'translationAttributes' => array('title','description'),
	            'translationRelation'   => 'translatecat',
	            'translationTable'   => $this->tableName(),
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
			array('title, slug, description, image, icon, parent, is_published, is_deleted', 'required'),
			array('is_published, is_deleted', 'numerical', 'integerOnly'=>true),
			array('title, slug, image, icon', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, title, slug, description, image, icon, is_published, is_deleted', 'safe', 'on'=>'search'),
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
			'news' => array(self::HAS_MANY, 'News', 'category'),
			'translatecat' => array(self::HAS_MANY, 'Translates', 'reference_id', 'index'=>'reference_field'),
			'product' => array(self::HAS_MANY, 'Product', 'category', 'order'=>'t.ordering ASC, product.ordering ASC'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'title' => 'Title',
			'slug' => 'Slug',
			'description' => 'Description',
			'image' => 'Image',
			'icon' => 'Icon',
			'is_published' => 'Is Published',
			'is_deleted' => 'Is Deleted',
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
		$criteria->compare('slug',$this->slug,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('image',$this->image,true);
		$criteria->compare('icon',$this->icon,true);
		$criteria->compare('is_published',$this->is_published);
		$criteria->compare('is_deleted',$this->is_deleted);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'sort'=>array(
				'defaultOrder'=>'t.ordering DESC',
		        'attributes'=>array(
		            'parentname'=>array(
		                'asc'=>'t.title',
		                'desc'=>'t.title DESC',
		            ),
		            '*',
		        ),
  			),
		));
	}
}