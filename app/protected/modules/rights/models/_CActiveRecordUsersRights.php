<?php
abstract class CActiveRecordUsersRights extends CActiveRecord
{
    public function getDbConnection()
    {
        return Yii::app()->db2;
    }
}
