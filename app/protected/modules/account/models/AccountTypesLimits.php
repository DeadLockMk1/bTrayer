<?php

/**
 * This is the model class for table "account_types_limits".
 *
 * The followings are the available columns in table 'account_types_limits':
 *
 * @property string $AccountTypeId
 * @property string $LimitsKey
 * @property string $LimitsList
 */
class AccountTypesLimits extends CActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'account_types_limits';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('Id, AccountTypeId, LimitsKey', 'required'),
            array('Id, AccountTypeId', 'length', 'max' => 20),
            array('LimitsKey', 'length', 'max' => 32),
            array('LimitsList', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('Id, AccountTypeId, LimitsKey, LimitsList', 'safe', 'on' => 'search'),
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
            'AccountTypes' => array(self::BELONGS_TO, 'AccountTypes', 'AccountTypeId'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'Id' => 'ID',
            'AccountTypeId' => 'Account Type',
            'LimitsKey' => 'Limits Key',
            'LimitsList' => 'Limits List',
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
        $criteria->compare('AccountTypeId', $this->AccountTypeId, true);
        $criteria->compare('LimitsKey', $this->LimitsKey, true);
        $criteria->compare('LimitsList', $this->LimitsList, true);

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
     * @return AccountTypesLimits the static model class
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

    /**
     * Returns account types limits list.
     *
     * @param integer $userId
     * @param string  $limitsKey
     * @param boolean $jsonFormat
     *
     * @return array/string
     */
    public function getAccountTypesLimitsList($userId, $limitsKey, $jsonFormat = false)
    {
        if (Rights::getAuthorizer()->isSuperuser($userId)) {
            $accountTypesLimits = json_encode(array());
        } else {
            $AccountTypesLimits = $this->__getAccountTypesLimitsData($userId, $limitsKey);
            $accountTypesLimits = $AccountTypesLimits->LimitsList;
        }
        if (empty($jsonFormat)) {
            $accountTypesLimits = json_decode($accountTypesLimits, true);
        }

        return $accountTypesLimits;
    }

    /**
     * Returns account types limits data.
     *
     * @param integer $userId
     * @param string  $limitsKey
     *
     * @return object AccountTypesLimits
     */
    private function __getAccountTypesLimitsData($userId, $limitsKey)
    {
        if (empty($userId) || empty($limitsKey)) {
            return false;
        }
        $User = AccountUsers::model()->findByAttributes(array(
            'UserId' => $userId,
        ));
        if (empty($User)) {
            return false;
        }

        return $this->findByAttributes(array(
            'AccountTypeId' => $User->AccountTypeId,
            'LimitsKey' => $limitsKey,
        ));
    }
}
