<?php

/**
 * This is the model class for table "offer".
 *
 * The followings are the available columns in table 'offer':
 * @property integer $id
 * @property string $language
 * @property string $document_name
 * @property integer $invoice_no
 * @property integer $company
 * @property string $reference
 * @property integer $author
 * @property integer $price
 * @property integer $stopage
 * @property integer $kdv
 * @property integer $shipping
 * @property integer $delivery_place
 * @property integer $packaged
 * @property integer $insurance
 * @property integer $installation
 * @property integer $payment_type
 * @property string $delivery_time
 * @property integer $warranty
 * @property string $create_date
 * @property integer $is_published
 */
class Offer extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Offer the static model class
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
		return 'offer';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('language, document_name, invoice_no, company, reference, author, price, stopage, kdv, shipping, delivery_place, packaged, insurance, installation, payment_type, delivery_time, warranty, create_date, is_published', 'required'),
			array('invoice_no, company, author, price, stopage, kdv, shipping, delivery_place, packaged, insurance, installation, payment_type, warranty, is_published', 'numerical', 'integerOnly'=>true),
			array('language, document_name, reference', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, language, document_name, invoice_no, company, reference, author, price, stopage, kdv, shipping, delivery_place, packaged, insurance, installation, payment_type, delivery_time, warranty, create_date, is_published', 'safe', 'on'=>'search'),
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
			'id' => 'ID',
			'language' => 'Language',
			'document_name' => 'Document Name',
			'invoice_no' => 'Invoice No',
			'company' => 'Company',
			'reference' => 'Reference',
			'author' => 'Author',
			'price' => 'Price',
			'stopage' => 'Stopage',
			'kdv' => 'Kdv',
			'shipping' => 'Shipping',
			'delivery_place' => 'Delivery Place',
			'packaged' => 'Packaged',
			'insurance' => 'Insurance',
			'installation' => 'Installation',
			'payment_type' => 'Payment Type',
			'delivery_time' => 'Delivery Time',
			'warranty' => 'Warranty',
			'create_date' => 'Create Date',
			'is_published' => 'Is Published',
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
		$criteria->compare('language',$this->language,true);
		$criteria->compare('document_name',$this->document_name,true);
		$criteria->compare('invoice_no',$this->invoice_no);
		$criteria->compare('company',$this->company);
		$criteria->compare('reference',$this->reference,true);
		$criteria->compare('author',$this->author);
		$criteria->compare('price',$this->price);
		$criteria->compare('stopage',$this->stopage);
		$criteria->compare('kdv',$this->kdv);
		$criteria->compare('shipping',$this->shipping);
		$criteria->compare('delivery_place',$this->delivery_place);
		$criteria->compare('packaged',$this->packaged);
		$criteria->compare('insurance',$this->insurance);
		$criteria->compare('installation',$this->installation);
		$criteria->compare('payment_type',$this->payment_type);
		$criteria->compare('delivery_time',$this->delivery_time,true);
		$criteria->compare('warranty',$this->warranty);
		$criteria->compare('create_date',$this->create_date,true);
		$criteria->compare('is_published',$this->is_published);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}