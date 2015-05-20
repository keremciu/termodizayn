<?php

class Photos extends CActiveRecord
{
	public $gallery_search;

	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function tableName()
	{
		return 'photos';
	}

	public function rules()
	{
		return array(
			array('name, desc, photo, min_photo, gallery, ordering, is_published', 'required'),
			array('gallery, ordering, is_published', 'numerical', 'integerOnly'=>true),
			array('name, photo, min_photo, url', 'length', 'max'=>255),
			array('id, name, desc, photo, min_photo, gallery, url, ordering, is_published', 'safe'),
		);
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

	public function relations()
	{
		return array(
			'translates' => array(self::HAS_MANY, 'Translates', 'reference_id','index'=>'reference_field'),
			'gallery0' => array(self::BELONGS_TO, 'Gallery', 'gallery'),
		);
	}

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
		);
	}

	public function search()
	{

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
		            '*',
		        ),
  			),
		));
	}
}