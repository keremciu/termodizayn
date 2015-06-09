<?php

class Category extends CActiveRecord
{
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function tableName()
	{
		return 'category';
	}

	public function rules()
	{
		return array(
			array('title, slug, type, is_published, is_deleted', 'required'),
			array('is_published, is_deleted,ordering,parent', 'numerical', 'integerOnly'=>true),
			array('title, slug, image, icon', 'length', 'max'=>255),
			array('id, title, slug, description, type, image, icon, ordering, parent, is_published, is_deleted', 'safe'),
		);
	}

	public function behaviors()
	{
	    return array(
	        'Translatable' => array(
	            'class'                 => 'ext.Translatable',
	            'translationAttributes' => array('title','slug','description'),
	            'translationRelation'   => 'translatecat',
	            'translationTable'   	=> $this->tableName(),
	            'languageColumn'        => 'lang_id',
	        ),
	    );
	}

	public function relations()
	{
		return array(
			'translatecat' => array(self::HAS_MANY, 'Translates', 'reference_id','index'=>'reference_field'),
			'news' => array(self::HAS_MANY, 'News', 'category'),
			'product' => array(self::HAS_MANY, 'Product', 'category'),
		);
	}

	public function getFullName()
	{
		return $this->ordering. ' ' .$this->title;
	}

	public function getPrefix($parent, $level=0) { 
        $criteria = new CDbCriteria;
        $criteria->condition='parent=:id';
        $criteria->params=array(':id'=>$parent);
        $model = $this->findAll($criteria);
        if ($parent == 0) {
        	return "";
        } else {
	        $parentb = $this->findByPk($parent)->parent;
        	if (($parentb) == 0) {
        		return "- ";
			} else {
        		if (($this->findByPk($parentb)->parent) == 0) {
					return "-- ";
				} else {
					return "--- ";
				}	
        	}
        }
    }

	public function getParentName(){
        return $this->getPrefix($this->parent).  $this->title;
   	}

	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'title' => 'Adı',
			'slug' => 'SEO Link',
			'description' => 'Açıklama',
			'type' => 'İçerik Tipi',
			'image' => 'Fotoğraf',
			'icon' => 'İkon',
			'ordering' => 'Sıralama',
			'parent' => 'Üst öğe',
			'is_published' => 'Yayında',
			'is_deleted' => 'Silindi',
		);
	}

	public function search()
	{

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('slug',$this->slug,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('type',$this->type,true);
		$criteria->compare('image',$this->image,true);
		$criteria->compare('icon',$this->icon,true);
		$criteria->compare('parent',$this->parent);
		$criteria->compare('ordering',$this->ordering);
		$criteria->compare('is_published',$this->is_published);
		$criteria->compare('is_deleted',$this->is_deleted);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}