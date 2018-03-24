<?php

/**
 * This is the model class for table "invoice".
 *
 * The followings are the available columns in table 'invoice':
 * @property integer $invoiceId
 * @property integer $customerId
 * @property string $dateCreate
 */
class Invoice extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Invoice the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'invoice';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('customerId, invoiceNumber, active', 'required'),
            array('customerId, invoiceNumber, active', 'numerical', 'integerOnly' => true),
            array('dateCreate', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('invoiceId, customerId, dateCreate, invoiceNumber, active', 'safe', 'on' => 'search'),
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
            'invoiceId' => 'Invoice',
            'customerId' => 'บริษัทลูกค้า',
            'dateCreate' => 'วันที่',
            'invoiceNumber' => 'เลขที่ใบเสร็จรับเงิน',
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

        $criteria->compare('invoiceId', $this->invoiceId);
        $criteria->compare('customerId', $this->customerId);
        $criteria->compare('dateCreate', $this->dateCreate, true);
        $criteria->compare('invoiceNumber', $this->invoiceNumber);
        $criteria->compare('active', 1);
        $criteria->addBetweenCondition('dateCreate', $this->dateCreate.'-01', $this->dateCreate.'-31');
        $criteria->order = 'invoiceId DESC';

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'pagination'=>false,
        ));
    }

}