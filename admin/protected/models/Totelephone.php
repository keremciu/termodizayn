<?php

/**
 * This is the model class for table "totelephone".
 *
 * The followings are the available columns in table 'totelephone':
 * @property integer $id
 * @property string $name
 * @property string $email
 * @property string $telephone
 * @property string $inform
 * @property integer $subscribe
 * @property integer $active
 */
class Totelephone extends CActiveRecord
{
	public $name;
	public $email;
	public $telephone;
	public $inform;
	public $project;
	public $subscribe;
	public $active;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Totelephone the static model class
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
		return 'totelephone';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, email, telephone, inform, project, subscribe, active', 'required'),
			array('subscribe, active', 'numerical', 'integerOnly'=>true),
			array('name, email, telephone, inform, project', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, email, telephone, inform, project, subscribe, active', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'Kimlik',
			'name' => 'Adı Soyadı',
			'email' => 'E-Posta Adresi',
			'telephone' => 'Cep Telefon Numarası',
			'inform' => 'Nasıl haberdar olundu?',
			'project' => 'İlgilendiğiniz Proje?',
			'subscribe' => 'Abonelik',
			'active' => 'Arandı mı?',
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('telephone',$this->telephone,true);
		$criteria->compare('inform',$this->inform,true);
		$criteria->compare('project',$this->inform,true);
		$criteria->compare('subscribe',$this->subscribe);
		$criteria->compare('active',$this->active);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}