<?php
class News extends CActiveRecord
{
	public $author_search;
	public $category_search;
	public $ordering_search;
	public $time;

	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'news';
	}

	public function behaviors() {
	    return array(
	    	'sluggable' => array(
		      'class'=>'ext.yiiext.behaviors.SluggableBehavior',
		      'columns' => array('title'),
		      'unique' => true,
		      'update' => true,
		    ),
	        'tags' => array(
	            'class' => 'ext.yiiext.behaviors.model.taggable.ETaggableBehavior',
	            'tagTable' => 'tag',
	            'tagBindingTable' => 'news_tags',
	            'modelTableFk' => 'news_id',
	            'tagTablePk' => 'id',
	            'tagTableName' => 'name',
	            'tagTableCount' => 'count',
	            'tagBindingTableTagId' => 'tag_id',
	            'cacheID' => 'cache',
	            'createTagsAutomatically' => true,
	            'insertValues' => array(
	            'user_id' => Yii::app()->user->id,
	            ),
	        ),
	        'Translatable' => array(
	            'class'                 => 'ext.Translatable',
	            'translationAttributes' => array('title','slug','description','area1'=>'content'),
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
			array('title, description, content, category, author_id, date, create_data, is_published, is_deleted', 'required'),
			array('category, author_id, ordering, hits, featured, is_published, is_deleted', 'numerical', 'integerOnly'=>true),
			array('title, slug, image, date', 'length', 'max'=>255),
			array('id, title, slug, description, content, ordering, hits, featured, image, category, author_id, date, create_data, is_published, is_deleted, author_search, category_search', 'safe'),
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
			'author' => array(self::BELONGS_TO, 'User', 'author_id'),
			'category0' => array(self::BELONGS_TO, 'Category', 'category'),
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
			'title' => 'Başlık',
			'slug' => 'SEO Link',
			'description' => 'Spot',
			'content' => 'İçerik',
			'image' => 'Fotoğraf',
			'category' => 'Kategori',
			'author_id' => 'Yazar',
			'date' => 'Haber Tarihi',
			'create_data' => 'Oluşturulma Tarihi',
			'ordering' => 'Sıralama',
			'hits' => 'Görüntülenme',
			'featured' => 'Manşet',
			'is_published' => 'Yayında',
			'is_deleted' => 'Silindi',
			'author_search' => 'Yazar',
			'category_search' => 'Kategori',
			'ordering_search' => 'Sıra',
			'time' => 'Haber Saati'
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

		$criteria->with = array('author','category0');
		$criteria->compare('t.id',$this->id);
		$criteria->compare('t.title',$this->title,true);
		$criteria->compare('t.slug',$this->slug,true);
		$criteria->compare('t.description',$this->description,true);
		$criteria->compare('content',$this->content,true);
		$criteria->compare('image',$this->image);
		$criteria->compare('category',$this->category);
		$criteria->compare('t.author_id',$this->author_id);
		$criteria->compare('date',$this->date,true);
		$criteria->compare('create_data',$this->create_data);
		$criteria->compare('ordering',$this->is_published);
		$criteria->compare('hits',$this->is_published);
		$criteria->compare('featured',$this->is_published);
		$criteria->compare('is_deleted',$this->is_deleted);
		$criteria->compare('author.username', $this->author_search,true);
		$criteria->compare('category0.title', $this->category_search,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'sort'=>array(
				'defaultOrder'=>'t.ordering DESC',
		        'attributes'=>array(
		            'author_search'=>array(
		                'asc'=>'author.username',
		                'desc'=>'author.username DESC',
		            ),
		            'category_search'=>array(
		                'asc'=>'category0.title',
		                'desc'=>'category0.title DESC',
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