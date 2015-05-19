<?php
/**
 * This is the model class for table "yii_i18n_messages".
 *
 * The followings are the available columns in table 'yii_i18n_messages':
 * @property integer $id
 * @property string $language
 * @property string $translation
 *
 * The followings are the available model relations:
 * @property I18nSourceMessages $id0
 */
class Message extends SqliteActiveRecord {
 
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Messages the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }
 
    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'yii_i18n_messages';
    }
 
    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('id, language', 'safe'),
            array('translation', 'filter', 'filter' => array($obj = new CHtmlPurifier(), 'purify')),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, language, translation', 'safe', 'on' => 'search'),
        );
    }
 
    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'SourceMessage' => array(self::BELONGS_TO, 'SourceMessage', 'id'),
        );
    }
 
    public function primaryKey() {
        return array('id', 'language');
    }
 
    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'language' => Yii::t('App', 'Language'),
            'languageName' => Yii::t('App', 'Language'),
            'translation' => Yii::t('App', 'Translation'),
        );
    }
 
    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search() {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.
 
        $criteria = new CDbCriteria;
 
        $criteria->compare('id', $this->id);
        $criteria->compare('language', $this->language, true);
        $criteria->compare('translation', $this->translation, true);
 
        return new CActiveDataProvider($this, array(
                    'criteria' => $criteria,
                ));
    }
 
    // Statics
    // -------------------------------------------------------------------------
 
    /**
     *
     * @param string $key for the lookup 
     * @return array|string the hole lookup array or the match
     */
    public static function LanguageList($key = NULL) {
        // define in protected/config/main.php which languages are supported
        $array = Yii::app()->params['supportedLanguages']; 
        if ($key !== NULL)
            return $array[$key];
        else
            return $array;
    }
 
    // Getter and Setter
    // -------------------------------------------------------------------------
 
    public function getLanguageName() {
        return self::LanguageList($this->language);
    }
}