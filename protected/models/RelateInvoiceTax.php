<?php

/**
 * This is the model class for table "relate_invoice_tax".
 *
 * The followings are the available columns in table 'relate_invoice_tax':
 * @property integer $relate_invoice_taxId
 * @property integer $taxId
 * @property integer $invoiceId
 */
class RelateInvoiceTax extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return RelateInvoiceTax the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'relate_invoice_tax';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('taxId, invoiceId', 'required'),
            array('taxId, invoiceId', 'numerical', 'integerOnly' => true),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('relate_invoice_taxId, taxId, invoiceId', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        return array(
            'tax' => array(self::BELONGS_TO, 'Tax', 'taxId'),
            'invoice' => array(self::BELONGS_TO, 'Invoice', 'invoiceId'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'relate_invoice_taxId' => 'Relate Invoice Tax',
            'taxId' => 'เลขที่ใบกำกับภาษี',
            'invoiceId' => 'เลขที่ใบเสร็จรับเงิน',
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

        $criteria->compare('relate_invoice_taxId', $this->relate_invoice_taxId);
        $criteria->compare('taxId', $this->taxId);
        $criteria->compare('invoiceId', $this->invoiceId);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

}