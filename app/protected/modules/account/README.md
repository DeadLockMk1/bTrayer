Account Installation
=====================

Git clone
---------

    clone git ...

Configure
---------

Change your config main:

    return array(
        #...
        'import'=>array(
            'application.modules.account.*',
            'application.modules.account.models.*',
        ),
        #...
        'modules'=>array(
            #...
            'account'=>array(),
            #...
        ),
    );

Dependences
-----------
Modules:
    Users: http://www.yiiframework.com/extension/yii-user/
    Rights: http://www.yiiframework.com/extension/rights/
Helpers:
    GRI

Install
-------
    Example
    --------

    1. You need to extend your models (for validation fields - based on account types and account limitations) from abstract class:
    <?php
    abstract class AccountTypesLimitsSite extends CFormModel
    {
        /**
         * Fields for validation.
         *
         * @var integer
         */
        public $priority;
        public $maxURLs;
        public $maxResources;
        public $maxURLsFromPage;
        public $maxErrors;
        public $maxResourceSize;
        public $processingDelay;
        public $requestDelay;

        /**
         * Rights key.
         *
         * @var string
         */
        private $__key = 'Site';

        /**
         * Returns rights key.
         *
         * @return string
         */
        protected function __getAccountTypesLimitsKey()
        {
            return $this->__key;
        }

        /**
         * Validate site.
         *
         * @return boolean
         */
        public function validateSite()
        {
            if (isset($_POST)) {
                $attributes = $_POST;
            } elseif (isset($_GET)) {
                $attributes = $_GET;
            }
            if (empty($attributes)) {
                return false;
            }
            $this->attributes = $attributes;
            if (!$this->validate()) {
                return false;
            }
            return true;
        }

        /**
         * Returns rules.
         *
         * @return array
         */
        public function rules()
        {
            $userId = Yii::app()->user->id;
            $key = $this->__getAccountTypesLimitsKey();
            $rules = AccountTypesLimits::model()->getAccountTypesLimitsList($userId, $key);
            return $rules;
        }
    }

    2. Create scheme for your DB: data/schema.mysql.sql - it contains data for this example for validation fields
?>
...
