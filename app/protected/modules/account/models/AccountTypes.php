<?php

/**
 * This is the model class for table "account_types".
 *
 * The followings are the available columns in table 'account_types':
 *
 * @property string $Id
 * @property string $Type
 */
class AccountTypes extends CActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'account_types';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('Type', 'required'),
            array('Type', 'length', 'max' => 150),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('Id, Type', 'safe', 'on' => 'search'),
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
            'Id' => 'ID',
            'Type' => 'Type',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     *
     * Typical usecase:
     * - Initialize the model fields with values from filter form.
     * - Execute this method to get CActiveDataProvider instance which will filter
     * models according to data in model fields.
     * - Pass data provider to CGridView, CListView or any similar widget.
     *
     * @return CActiveDataProvider the data provider that can return the models
     *                             based on the search/filter conditions.
     */
    public function search()
    {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria();

        $criteria->compare('Id', $this->Id, true);
        $criteria->compare('Type', $this->Type, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     *
     * @param string $className active record class name.
     *
     * @return AccountTypes the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    protected function beforeDelete()
    {
        $primaryKey = $this->primaryKey;
        if (!empty($primaryKey)) {
            AccountUsers::model()->setAllUsersDefaultAccountTypeByAccountTypeId($primaryKey);
        }
        return parent::beforeDelete();
    }

    /*
     * Returns available types
     * @return object AccountTypes
     */
    /*public function getAvailableTypes() {
        $accountTypeIds = array();
        $accountTypesLimits = AccountTypesLimits::model()->findAll();
        foreach ($accountTypesLimits as $accountTypeLimit) {
            $accountTypeIds[] = $accountTypeLimit->AccountTypeId;
        }

        $criteria = new CDbCriteria();
        $criteria->addNotInCondition('Id', $accountTypeIds);
        return AccountTypes::model()->findAll($criteria);
    }*/
}
