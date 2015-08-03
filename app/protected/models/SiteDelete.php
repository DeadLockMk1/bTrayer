<?php

/**
 * Site Cleanup.
 *
 */
class SiteDelete
{
    protected $opLog = 'SITE_DELETE';
    protected $operation = 'Delete';

    /**
     *
     * Starts cleanup process.
     *
     * @param string $id
     * @param int $type
     *
     * @return bool     true
     */
    public function commandDelete($id, $type)
    {
        $this->operation = "Delete";
        $json = array(
            'id' => $id,
            'taskType' => (int)$type
        );
        Logger::log("Opertion ->SITE_DELETE", false);
        Logger::log("Request ->\n" . print_r($json, true), false);
        $json = CJSON::encode($json);
        $resFile = tempnam(Yii::app()->getBasePath() . '/json_temp', '');
        $response = fopen($resFile, "w");
        fwrite($response, $json);
        fclose($response);
        $api = Yii::app()->params['api'];
        $path = Yii::app()->getBasePath() . '/shell/';
        $cmd = "sh " . $path . "site_delete.sh $api $resFile";
        $json = shell_exec($cmd);
        $error = Errors::isError($json);
        if ($error !== 0) {
            Yii::app()->user->setFlash('error1', $this->operation . ' ERROR: ' . $error);
        } else {
            Yii::app()->user->setFlash('success1', $this->operation . ': SUCCESS');
        }
        Logger::log("Response >>>" . $json);
        unlink($resFile);

        $UsersSitesRights = new UsersSitesRights();
        $UsersSitesRights->setRightsSingleRecord(
            array(
                'userId' => Yii::app()->user->id,
                'siteId' => $id,
                'rights' => array()
            )
        );

        return true;
    }
}