<?php
abstract class UsersRights extends CActiveRecord
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
     * Returns a list of behaviors that this model should behave as.
     *
     * @return array
     */
    public function behaviors()
    {
        return array(
            'StatesBinaryField' => array(
                'class' => 'StatesBinaryFieldBehavior',
                'attribute' => 'Rights',
                'data' => $this->getRightsList(),
            ),
        );
    }

    /**
     * Returns rights list.
     *
     * @return array
     */
    public function getRightsList()
    {
        $key = $this->_getRightsKey();

        return UsersRightsDefaults::model()->getRightsList($key);
    }

    /**
     * Set rights list.
     *
     * @param string $rights
     *
     * @return boolean
     */
    public function setRightsList($rights)
    {
        $key = $this->_getRightsKey();
        UsersRightsDefaults::model()->setRightsList($key, $rights);
    }

    /**
     * Returns data by search params.
     *
     * @param array $params
     *
     * @return array
     */
    abstract public function search($params);

    /**
     * Set rights for all record.
     *
     * @param array $records
     * @param array $rights
     *
     * @return boolean
     */
    abstract public function setRightsAllRecords($records, $rights = array());

    /**
     * Set rights for single record.
     *
     * @param array   $params  buildRightsSingleRecordParams
     * @param boolean $autoSet
     *
     * @return boolean
     */
    abstract public function setRightsSingleRecord($params, $autoSet = false);

    /**
     * Build rights single record params.
     *
     * @param array $record
     * @param array $rights
     *
     * @return array
     */
    abstract public function buildRightsSingleRecordParams($record, $rights = array());

    /**
     * Returns rights key.
     *
     * @return string
     */
    abstract protected function _getRightsKey();

    /**
     * Returns value from record by fields.
     *
     * @param array $record
     * @param array $fields
     *
     * @return string
     */
    protected function _getValueFromRecord($record, $fields)
    {
        $value = '';
        if (empty($record) || empty($fields)) {
            return $value;
        }
        foreach ($fields as $field) {
            if (is_array($record)) {
                if (isset($record[$field])) {
                    $value = $record[$field];
                    break;
                }
            } elseif ($record instanceof CActiveRecord) {
                if (isset($record->$field)) {
                    $value = $record->$field;
                    break;
                }
            }
        }

        return $value;
    }
}
