<?php
/**
 * This is the model class for table "yii_i18n_source_messages".
 *
 * The followings are the available columns in table 'yii_i18n_source_messages':
 * @property integer $id
 * @property string $category
 * @property string $message
 *
 * The followings are the available model relations:
 * @property I18nMessages[] $i18nMessages
 */
class SourceMessage extends SqliteActiveRecord {
 
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return SourceMessages the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }
 
    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'yii_i18n_source_messages';
    }
 
    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('category', 'length', 'max' => 32),
            array('category', 'filter', 'filter' => 'trim'),
            array('message', 'required'),
            array('message', 'filter', 'filter' => array($obj = new CHtmlPurifier(), 'purify')),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, category, message', 'safe', 'on' => 'search'),
        );
    }
 
    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'Messages' => array(self::HAS_MANY, 'Message', 'id'),
        );
    }
 
    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'category' => Yii::t('App','Translation Category'),
            'message' => Yii::t('App','Message'),
        );
    }
 
    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search() {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.
 
        $sort = new CSort();
        $sort->attributes = array(
            'id',
            'category',
            'message',
        );
 
        $sort->defaultOrder = 'category, message ';
 
        $criteria = new CDbCriteria;
 
        $criteria->compare('id', $this->id);
        $criteria->compare('category', $this->category, true);
        $criteria->compare('message', $this->message, true);
 
        $criteria->with = array('Messages');
 
        return new CActiveDataProvider(get_class($this), array(
            'criteria' => $criteria,
            'sort' => $sort,
        ));
    }
    // Getter and Setter
    // -------------------------------------------------------------------------
 
    /**
     * Get the translation with the current app language
     * @return string
     */
    public function getTranslation() {
        if ($this->Messages) {
            $messages = $this->Messages(array("condition" => "language=\"" . Yii::app()->language . "\""));
            return $messages[0]->translation;
        }
        else
            return '...';
    }
}