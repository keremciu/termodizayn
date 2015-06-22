<?php

/**
 * This is the model class for table "product_model".
 *
 * The followings are the available columns in table 'product_model':
 * @property integer $id
 * @property integer $product
 * @property string $name
 * @property string $slug
 * @property string $price
 * @property string $content
 * @property string $image
 * @property integer $ordering
 * @property string $create_date
 * @property integer $is_published
 */
class ProductModel extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ProductModel the static model class
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
		return 'product_model';
	}

	public function behaviors()
	{
	    return array(
	        'Translatable' => array(
	            'class'                 => 'ext.Translatable',
	            'translationAttributes' => array('name','slug','content'),
	            'translationRelation'   => 'translatemodel',
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
			array('product, name, slug, price, content, image, ordering, create_date, is_published', 'required'),
			array('product, ordering, is_published', 'numerical', 'integerOnly'=>true),
			array('name, slug, price, image', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, product, name, slug, price, content, image, ordering, create_date, is_published', 'safe', 'on'=>'search'),
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
			'translatemodel' => array(self::HAS_MANY, 'Translates', 'reference_id','index'=>'reference_field'),
			'product0' => array(self::BELONGS_TO, 'Product', 'product'),
			'modelattrib' => array(self::HAS_MANY, 'ModelAttribMap', 'model_id'),
			'modelextras' => array(self::HAS_MANY, 'Mimages', 'mid'),
		);
	}

	public function getFullName()
	{
		return $this->ordering. ' ' .$this->title;
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'product' => 'Ürün',
			'name' => 'Model Adı',
			'slug' => 'Seo Link',
			'price' => 'Fiyat',
			'content' => 'Detay',
			'image' => 'Kapak Fotoğrafı',
			'ordering' => 'Sıralama',
			'create_date' => 'Oluşturulma Tarihi',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('product',$this->product);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('slug',$this->slug,true);
		$criteria->compare('price',$this->price,true);
		$criteria->compare('content',$this->content,true);
		$criteria->compare('image',$this->image,true);
		$criteria->compare('ordering',$this->ordering);
		$criteria->compare('create_date',$this->create_date,true);
		$criteria->compare('is_published',$this->is_published);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}