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

    /**
     * Returns rights key.
     *
     * @return string
     */
    protected function __getAccountTypesLimitsKey()
    {
        return $this->__key;
    }
}
