<?php

/**
 * This is the model class for table "account_users".
 *
 * The followings are the available columns in table 'account_users':
 *
 * @property string $UserId
 * @property string $AccountTypeId
 */
class AccountUsers extends CActiveRecord
{
    /**
     * Default account type.
     *
     * @var string
     */
    const DEFAULT_ACCOUNT_TYPE = 'default';

    /**
     * Default temp account type.
     *
     * @var string
     */
    const DEFAULT_TEMP_ACCOUNT_TYPE = 'default_temp';

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'account_users';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('UserId, AccountTypeId', 'required'),
            array('UserId, AccountTypeId', 'length', 'max' => 20),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('UserId, AccountTypeId', 'safe', 'on' => 'search'),
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
            'User' => array(self::BELONGS_TO, 'User', 'UserId'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'UserId' => 'User',
            'AccountTypeId' => 'Account Type',
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

        $criteria->compare('UserId', $this->UserId, true);
        $criteria->compare('AccountTypeId', $this->AccountTypeId, true);

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
     * @return AccountUsers the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    /**
     * Set user default account type.
     *
     * @param boolean
     */
    public function setUserDefaultAccountType($userId, $defaultType = self::DEFAULT_ACCOUNT_TYPE)
    {
        if (empty($userId)) {
            return false;
        }

        return $this->setUserAccountType($userId, $defaultType);
    }

    /**
     * Set user account type.
     *
     * @param integer $userId
     * @param string  $accountType
     *
     * @return boolean
     */
    public function setUserAccountType($userId, $accountType)
    {
        if (empty($userId) || empty($accountType)) {
            return false;
        }
        $AccountTypes = AccountTypes::model()->findByAttributes(array(
            'Type' => $accountType,
        ));
        if (empty($AccountTypes)) {
            return false;
        }
        
        $AccountUsers = AccountUsers::model()->findByPk($userId);
        if (empty($AccountUsers)) {
            $AccountUsers = new AccountUsers();
        }

        $AccountUsers->UserId = $userId;
        $AccountUsers->AccountTypeId = $AccountTypes->Id;

        return $AccountUsers->save();
    }

    /**
     * For all users with current account type id set account type to default
     * @param integer $accountTypeId
     */
    public function setAllUsersDefaultAccountTypeByAccountTypeId($accountTypeId)
    {
        $AccountUsers = AccountUsers::model()->findAllByAttributes(array(
            'AccountTypeId' => $accountTypeId,
        ));
        foreach ($AccountUsers as $AccountUser) {
            VarDumper::dump($AccountUser->UserId);
            AccountUsers::model()->setUserDefaultAccountType($AccountUser->UserId);
        }
    }
}
