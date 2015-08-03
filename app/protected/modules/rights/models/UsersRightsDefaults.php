<?php
class UsersRightsDefaults extends CActiveRecord
{
    /**
     * Returns the static model of the specified AR class.
     *
     * @return CActiveRecord the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    /**
     * Table name.
     *
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'users_rights_defaults';
    }

    /**
     * Returns a list of behaviors that this model should behave as.
     *
     * @return array
     */
    public function behaviors()
    {
        return array(
            'CBase64SerializeBehavior' => array(
               'class' => 'CBase64SerializeBehavior',
               'serialAttributes' => array('RightsList'),
            ),
        );
    }

    /**
     * Returns rights list.
     *
     * @param string $key
     *
     * @return array
     */
    public function getRightsList($key)
    {
        $model = $this->findByAttributes(array('Key' => $key));

        return $model->RightsList;
    }

    /**
     * Set rights list.
     *
     * @param string $key
     * @param array  $rights
     */
    public function setRightsList($key, $rights = array())
    {
        $rightsList = array();
        if (empty($key)) {
            return $rightsList;
        }
        if (!empty($rights)) {
            foreach ($rights as $right) {
                $rightsList[$right.$key] = $right;
            }
        }
        $model = UsersRightsDefaults::model()->findByPk($key);
        if (empty($model)) {
            $model = new UsersRightsDefaults();
        }
        $model->Key = $key;
        $model->RightsList = $rightsList;

        return $model->save();
    }
}
