<?php

class Product extends CActiveRecord
{
	public $category_search;

	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function tableName()
	{
		return 'product';
	}

	public function behaviors()
	{
	    return array(
	        'Translatable' => array(
	            'class'                 => 'ext.Translatable',
	            'translationAttributes' => array('title','slug','description'),
	            'translationRelation'   => 'translates',
	            'translationTable'   => $this->tableName(),
	            'languageColumn'        => 'lang_id',
	        ),
	    );
	}

	public function rules()
	{
		return array(
			array('title, slug, description, intro, content, category, create_data, is_published, is_deleted', 'required'),
			array('category, ordering, hits, featured, is_published, is_deleted', 'numerical', 'integerOnly'=>true),
			array('title, slug, image', 'length', 'max'=>255),
			array('id, title, slug, description, intro, content, image, category, create_data, ordering, hits, featured, is_published, is_deleted', 'safe', 'on'=>'search'),
		);
	}

	public function relations()
	{
		return array(
			'translates' => array(self::HAS_MANY, 'Translates', 'reference_id','index'=>'reference_field'),
			'category0' => array(self::BELONGS_TO, 'Category', 'category'),
		);
	}

	public function getFullName()
	{
		return $this->ordering. ' ' .$this->title;
	}

	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'title' => 'Başlık',
			'slug' => 'SEO Link',
			'description' => 'Açıklama',
			'content' => 'İçerik',
			'image' => 'Fotoğraf',
			'category' => 'Kategori',
			'create_data' => 'Oluşturulma Tarihi',
			'ordering' => 'Sıralama',
			'hits' => 'Görüntülenme',
			'featured' => 'Manşet',
			'is_published' => 'Yayınlandı',
			'is_deleted' => 'Silindi',
			'category_search' => 'Kategori',
		);
	}

	public function search()
	{

		$criteria=new CDbCriteria;

		$criteria->with = array('category0');
		$criteria->compare('t.id',$this->id);
		$criteria->compare('t.title',$this->title,true);
		$criteria->compare('t.slug',$this->slug,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('content',$this->content,true);
		$criteria->compare('t.image',$this->image,true);
		$criteria->compare('category',$this->category);
		$criteria->compare('create_data',$this->create_data,true);
		$criteria->compare('t.ordering',$this->ordering);
		$criteria->compare('hits',$this->hits);
		$criteria->compare('featured',$this->featured);
		$criteria->compare('t.is_published',$this->is_published);
		$criteria->compare('t.is_deleted',$this->is_deleted);
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