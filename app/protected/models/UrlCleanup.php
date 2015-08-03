<?php

/**
 * Resource Cleanup.
 *
 */
class UrlCleanup
{
    protected $operation = "Cleanup";
    protected $opLog = "URL_CLEANUP";
    protected $dType = 1;

    /**
     *
     * Starts cleanup process.
     *
     * @param string $siteId
     * @param string $url
     * @param string $urlType
     * @param string $state
     * @param string $status
     *
     * @return none
     */

    public function cleanupUrlInfo($siteId, $url, $urlType, $state, $status)
    {// Create request JSON
        $json = array(
            array(
                "siteId" => $siteId,
                "delayedType" => $this->dType,
                "url" => $url,
                "urlType" => (int)$urlType,
                "state" => (int)$state,
                "status" => (int)$status,
                "criterions" => array(
                    "LIMIT" => 1,
                    "WHERE" => "`URL`=$url",
                    "ORDER BY" => "URL"
                ),
            )
        );
        Logger::log("Opertion ->" . $this->opLog, false);
        $json = CJSON::encode($json);
        Logger::log("Request ->\n" . $json, true);
// Create temporary file
        $reqFile = tempnam(Yii::app()->getBasePath() . '/json_temp', '');
        $request = fopen($reqFile, "w");
        fwrite($request, $json);
        fclose($request);
        $this->commandCleanup($reqFile);
// Remove temporary file
        unlink($reqFile);
    }

    /**
     *
     * Starts clean-up operation.
     *
     * @param mixed $reqFile
     *
     * @return none
     */
    public function commandCleanup($reqFile)
    {
// Path to this application
        $api = Yii::app()->params['api'];
// Path to folder with shell scripts
        $path = Yii::app()->getBasePath() . '/shell/';
        $cmd = "sh " . $path . "url_cleanup.sh $api $reqFile";
//Execute bash script, and get response JSON
        $json = shell_exec($cmd);
        $error = Errors::isError($json);
        if ($error !== 0) {
            Yii::app()->user->setFlash('error1', $this->operation . ' ERROR: ' . $error);
        } else {
            Yii::app()->user->setFlash('success1', $this->operation . ': SUCCESS');
        }
        Logger::log("Response ->\n" . $json);
    }
}