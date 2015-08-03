<?php

class DeleteUserTempJob extends Job
{
    /**
     * Execute job
     * @return boolean
     */
    protected function _execute() {
        $DateTime = new DateTime();
        $DateTime->modify('-1 hour');
        $result = User::model()->deleteAllByAttributes(array(
                'status' => User::STATUS_TEMP,
            ),
            'create_at < "' . $DateTime->format(DB_DATETIME_FORMAT) . '"'
        );
        if (!empty($result)) { 
            $this->log('Users temp deleted success...');
        } else {
            $this->log('Users temp for delete not found...');
        }
        return true;
    }
}
