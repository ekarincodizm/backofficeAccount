<?php

/**
 * This is the model class for table "tax".
 *
 * The followings are the available columns in table 'tax':
 * @property integer $taxId
 * @property integer $taxNumber
 * @property integer $customerId
 * @property string $dateCreate
 * @property integer $totalPrice
 */
class Tax extends CActiveRecord {

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'tax';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('customerId, active', 'required'),
            array('customerId, totalPrice, active', 'numerical', 'integerOnly' => true),
            array('taxNumber', 'length', 'max' => 4),
            array('dateCreate', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('taxId, taxNumber, customerId, dateCreate, totalPrice, active', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        return array(
            'customer' => array(self::BELONGS_TO, 'Customer', 'customerId'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'taxId' => 'Tax',
            'taxNumber' => 'เลขที่ใบกำกับภาษี',
            'customerId' => 'บริษัทลูกค้า',
            'dateCreate' => 'วันที่',
            'totalPrice' => 'ราคารวม',
            'active' => 'Active',
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

        $criteria->compare('taxId', $this->taxId);
        $criteria->compare('taxNumber', $this->taxNumber, true);
        $criteria->compare('customerId', $this->customerId);
        //$criteria->compare('dateCreate', $this->dateCreate, true);
        $criteria->compare('totalPrice', $this->totalPrice);
        $criteria->compare('active', 1);
        $criteria->addBetweenCondition('dateCreate', $this->dateCreate . '-01', $this->dateCreate . '-31');
        $criteria->order = 'taxId DESC';

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'pagination' => false,
        ));
    }

}
