<?php
/**
 * Auth item assignment form class file.
 *
 * @author Christoffer Niska <cniska@live.com>
 * @copyright Copyright &copy; 2010 Christoffer Niska
 *
 * @since 0.9
 */
class AssignmentForm extends CFormModel
{
    public $itemname;

    /**
     * Default role type.
     *
     * @var string
     */
    const DEFAULT_ROLE_TYPE = 'default';

    /**
     * Default temp role type.
     *
     * @var string
     */
    const DEFAULT_TEMP_ROLE_TYPE = 'default_temp';

    /**
     * Declares the validation rules.
     */
    public function rules()
    {
        return array(
            array('itemname', 'safe'),
        );
    }

    /**
     * Declares attribute labels.
     */
    public function attributeLabels()
    {
        return array(
            'itemname' => Rights::t('core', 'Authorization item'),
        );
    }

    /**
     * Set default (rights) auth assignment for user.
     *
     * @param string $userId
     *
     * @return boolean
     */
    public static function setDefaultAuthAssignments($userId, $defaultType = self::DEFAULT_ROLE_TYPE)
    {
        if (empty($userId)) {
            return false;
        }
        $defaultUser = User::model()->findByAttributes(array('username' => $defaultType));
        $assignedItems = Rights::getAuthorizer()->getAuthItems(null, $defaultUser->id);
        foreach ($assignedItems as $assignedItem) {
            Rights::getAuthorizer()->authManager->assign(
                $assignedItem->name, $userId
            );
        }

        return true;
    }
}
