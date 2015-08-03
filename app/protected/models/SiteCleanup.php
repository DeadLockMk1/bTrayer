<?php

/**
 * Site Cleanup.
 *
 */
class SiteCleanup
{
    protected $operation = "Cleanup";
    protected $opLog = "SITE_CLEANUP";

    /**
     *
     * Starts cleanup process.
     *
     * @param string $siteId
     * @param int $taskType
     *
     * @return bool     true
     */
    public function cleanupSiteInfo($siteId, $taskType = 1)
    {
        Logger::log('CLEANUP: START');
        $susp = Yii::app()->getRequest()->getPost('suspend');
        $historyCleanupParam = Yii::app()->getRequest()->getPost('history');
        $state = Yii::app()->getRequest()->getPost('state');
        // If checked "Suspend site before cleanup"
        // the state of current site will be changed to 3 
        if ($susp != null)
            $this->suspendRunSite($siteId, 3);
        if ($historyCleanupParam != null)
            $historyCleanup = 1;
        else
            $historyCleanup = 0;
        // Create request JSON
        $json = array(
            "id" => $siteId,
            "taskType" => $taskType,
            "delayedType" => 0,
            "saveRootURLs" => 1,
            "moveURLs" => 0,
            "state" => $state,
            "historyCleanUp" => $historyCleanup,
        );
        Logger::log("Opertion ->" . $this->opLog, false);
        $json = CJSON::encode($json);
        Logger::log("Request ->\n" . $json, true);
        // Logger::log('Request->'.$json, true);
        // Create temporary file
        $reqFile = tempnam(Yii::app()->getBasePath() . '/json_temp', '');
        $request = fopen($reqFile, "w");
        fwrite($request, $json);
        fclose($request);
        $this->commandCleanup($reqFile);
        // Remove temporary file
        unlink($reqFile);
//        if ($susp != null)
//            $this->suspendRunSite($siteId, 1);
    }

    /**
     *
     * Suspends site if 'state' = 1 or run if 3.
     *
     * @param string $siteId
     * @param int $state
     *
     * @return none
     */
    public function suspendRunSite($siteId, $state)
    {
        if ($state == 3) {
            $this->operation = "Suspend site";
        } elseif ($state == 1) {
            $this->operation = "Run site";
        }
        // Create request JSON
        $json = array(
            "cDate" => null,
            "description" => null,
            "errorMask" => null,
            "errors" => null,
            "filters" => null,
            "httpTimeout" => null,
            "id" => $siteId,
            "iterations" => null,
            "maxErrors" => null,
            "maxResourceSize" => null,
            "maxResources" => null,
            "maxURLs" => null,
            "priority" => null,
            "properties" => null,
            "requestDelay" => null,
            "resources" => null,
            "state" => $state,
            "tcDate" => null,
            "uDate" => null,
            "updateType" => null,
            "urlType" => null,
            "urls" => null,
            "contents" => null,
            "processingDelay" => null,
            "size" => null,
            "avgSpeed" => null,
            "avgSpeedCounter" => null,
            "maxURLsFromPage" => null,
            "criterions" => array(
                "WHERE" => "`State`<>$state"
            ),
            "userId" => null,
            "recrawlPeriod" => null,
            "recrawlDate" => null,
            "collectedURLs" => null,
            "fetchType" => null
        );
        Logger::log("Operation -> SITE_UPDATE", false);
        Logger::log("Request ->\n" . print_r($json, true), false);
        $json = CJSON::encode($json);
        // Create temporary file
        $reqFile = tempnam(Yii::app()->getBasePath() . '/json_temp', '');
        $request = fopen($reqFile, "w");
        fwrite($request, $json);
        fclose($request);
        // Path to this application
        $api = Yii::app()->params['api'];
        // Path to folder with shell scripts
        $path = Yii::app()->getBasePath() . '/shell/';
        $cmd = "sh " . $path . "rnd_site_update.sh $api $reqFile";
        //Execute bash script, and get response JSON
        $json = shell_exec($cmd);
        $error = Errors::isError($json);
        if ($error !== 0) {
            Yii::app()->user->setFlash('error' . (string)$state, $this->operation . ' ERROR: ' . $error);
        } else {
            Yii::app()->user->setFlash('success' . (string)$state, $this->operation . ': SUCCESS');
        }
        Logger::log("Response ->\n" . $json);
        // Remove temporary file
        unlink($reqFile);
    }

    /**
     *
     * Starts clean-up operation.
     *
     * @param mixed $reqFile
     *
     * @return bool     true
     */
    public function commandCleanup($reqFile)
    {
        $this->operation = "Cleanup";
        // Path to this application
        $api = Yii::app()->params['api'];
        // Path to folder with shell scripts
        $path = Yii::app()->getBasePath() . '/shell/';
        $cmd = "sh " . $path . "rnd_site_cleanup.sh $api $reqFile";
        //Execute bash script, and get response JSON
        $json = shell_exec($cmd);
        $error = Errors::isError($json);
        if ($error !== 0) {
            Yii::app()->user->setFlash('error2', $this->operation . ' ERROR: ' . $error);
        } else {
            Yii::app()->user->setFlash('success2', $this->operation . ': SUCCESS');
        }
        Logger::log("Response ->\n" . $json);
        return true;
    }
}