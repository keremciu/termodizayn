<?php

/**
 * This is the model class for table "menu".
 *
 * The followings are the available columns in table 'menu':
 * @property integer $id
 * @property string $menutype
 * @property string $name
 * @property string $alias
 * @property string $link
 * @property string $type
 * @property integer $types_id
 * @property string $params
 * @property integer $ordering
 * @property integer $level
 * @property string $access
 * @property integer $browsernav	
 * @property integer $parent
 * @property integer $is_home
 * @property integer $is_published
 */
class Menu extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Menu the static model class
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
		return 'menu';
	}

	public function behaviors()
	{
	    return array(
	        'Translatable' => array(
	            'class'                 => 'ext.Translatable',
	            'translationAttributes' => array('name','alias','link'),
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
			array('menutype, name, alias, type, ordering, parent, browsernav, is_home, is_published', 'required'),
			array('types_id, ordering, level, browsernav, parent, is_home, is_published', 'numerical', 'integerOnly'=>true),
			array('menutype, name, alias, type, access', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, menutype, name, alias, link, type, types_id, params, ordering, level, access, browsernav, parent, is_home, is_published', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'menutype' => 'Menü Tipi',
			'name' => 'Adı',
			'alias' => 'SEO Url',
			'link' => 'Bağlantı',
			'type' => 'Tür',
			'types_id' => 'Türe özel id',
			'params' => 'Params',
			'ordering' => 'Sıralama',
			'level' => 'Menü Seviyesi',
			'access' => 'Erişim Seviyesi',
			'browsernav' => 'Tıklandığında aç',
			'parent' => 'Üst Menü',
			'is_home' => 'Varsayılan(Anasayfa)',
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
		$criteria->compare('menutype',$this->menutype,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('alias',$this->alias,true);
		$criteria->compare('link',$this->link,true);
		$criteria->compare('type',$this->type,true);
		$criteria->compare('types_id',$this->types_id);
		$criteria->compare('params',$this->params,true);
		$criteria->compare('ordering',$this->ordering);
		$criteria->compare('level',$this->level);
		$criteria->compare('access',$this->access,true);
		$criteria->compare('browsernav',$this->browsernav);
		$criteria->compare('parent',$this->parent);
		$criteria->compare('is_home',$this->is_home);
		$criteria->compare('t.is_published',$this->is_published);
		$criteria->order = 'ordering ASC';

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}