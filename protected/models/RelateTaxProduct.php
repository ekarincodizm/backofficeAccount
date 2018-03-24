<?php

/**
 * This is the model class for table "relate_tax_product".
 *
 * The followings are the available columns in table 'relate_tax_product':
 * @property integer $relate_tax_productId
 * @property integer $amount
 * @property integer $taxId
 * @property integer $productId
 */
class RelateTaxProduct extends CActiveRecord {

    public function escape_decimal($data) {
        if (is_numeric( $data ) && floor( $data ) != $data) {
            return $data;
        } else {
            return round($data);
        }
    }
    
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'relate_tax_product';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('taxId, productId', 'required'),
            array('pricePerAmount, taxId, productId', 'numerical', 'integerOnly' => true),
            array('amount', 'numerical'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('relate_tax_productId, amount, pricePerAmount, taxId, productId', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        return array(
            'tax' => array(self::BELONGS_TO, 'Tax', 'taxId'),
            'product' => array(self::BELONGS_TO, 'Product', 'productId'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'relate_tax_productId' => 'Relate Tax Product',
            'amount' => 'จำนวน',
            'pricePerAmount' => 'ราคาต่อหน่วย (โหล)',
            'taxId' => 'เลขที่ใบกำกับภาษี',
            'productId' => 'สินค้า',
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

        $criteria->compare('relate_tax_productId', $this->relate_tax_productId);
        $criteria->compare('amount', $this->amount);
        $criteria->compare('pricePerAmount', $this->pricePerAmount);
        $criteria->compare('taxId', $this->taxId);
        $criteria->compare('productId', $this->productId);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

}